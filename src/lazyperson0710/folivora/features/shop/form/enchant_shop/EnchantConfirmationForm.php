<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\enchant_shop;

use bbo51dog\bboform\element\Label;
use bbo51dog\bboform\element\Slider;
use bbo51dog\bboform\form\CustomForm;
use lazyperson0710\folivora\features\electronic_money\currency\Money;
use lazyperson0710\folivora\features\shop\database\EnchantShopAPI;
use lazyperson0710\folivora\util\packet\SendForm;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\Server;

class EnchantConfirmationForm extends CustomForm {

    private Slider $level;
    private string $enchantName;
    private Enchantment $enchantment;

    public function __construct(Player $player, Enchantment $enchantment) {
        $enchantName = $enchantment->getName();
        if ($enchantName instanceof Translatable) {
            $enchantName = Server::getInstance()->getLanguage()->translate($enchantName);
        }
        $this->level = new Slider('付与したいレベルにスライドして下さい', 1, EnchantShopAPI::getInstance()->getLevelLimit($enchantName));
        $this->enchantment = $enchantment;
        $this->enchantName = $enchantName;
        $api = EnchantShopAPI::getInstance();
        $this
            ->setTitle('Enchant Form')
            ->addElements(
                new Label("{$enchantName}を付与しようとしています"),
                new Label("{$enchantName}は1レベルごとに{$api->getBuy($enchantName)}円かかります"),
                new Label("\n現在の所持金 -> " . Money::getInstance()->getFunction($player)->getCurrency() . "円"),
                $this->level,
            );
    }

    public function handleSubmit(Player $player) : void {
        $level = (int) $this->level->getValue();
        SendForm::Send($player, (new EnchantBuyForm($player, $level, $this->enchantment, $this->enchantName)));
    }
}
