<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\effect_shop;

use bbo51dog\bboform\element\Input;
use bbo51dog\bboform\element\Label;
use bbo51dog\bboform\element\Slider;
use bbo51dog\bboform\form\CustomForm;
use lazyperson0710\folivora\features\electronic_money\currency\Money;
use lazyperson0710\folivora\features\shop\database\EffectShopAPI;
use lazyperson0710\folivora\util\message\send_message\SendMessage;
use lazyperson0710\folivora\util\packet\SendForm;
use pocketmine\entity\effect\Effect;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\Server;

class EffectConfirmationForm extends CustomForm {

    private Slider $level;
    private Input $time;
    private string $effectName;
    private Effect $effect;

    public function __construct(Player $player, Effect $effect) {
        $api = EffectShopAPI::getInstance();
        $effectName = $effect->getName();
        if ($effectName instanceof Translatable) {
            $effectName = Server::getInstance()->getLanguage()->translate($effectName);
        }
        $this->level = new Slider('付与したいレベルにスライドして下さい', 1, EffectShopAPI::getInstance()->getLevelLimit($effectName));
        $this->time = new Input("付与したい時間を入力して下さい / 単位 : 分\n付与時間上限 {$api->getTimeRestriction($effectName)}分", '100');
        $this->effect = $effect;
        $this->effectName = $effectName;
        $total = 3 * $api->getBuy($effectName) + (2 * $api->getAmplifiedMoney($effectName));
        $this
            ->setTitle('Effect Form')
            ->addElements(
                new Label("{$effectName}を付与しようとしています"),
                new Label("{$effectName}は1分ごとに{$api->getBuy($effectName)}円かかります"),
                new Label("また、1レベルにつき{$api->getAmplifiedMoney($effectName)}円増幅します"),
                new Label("例 : 2lvのエフェクトを3分購入した場、3 x {$api->getBuy($effectName)} + (2 x {$api->getAmplifiedMoney($effectName)})で{$total}円になります"),
                new Label('現在の所持金 -> ' . Money::getInstance()->getFunction($player)->getCurrency()),
                $this->level,
                $this->time,
            );
    }

    public function handleSubmit(Player $player) : void {
        if (is_numeric($this->time->getValue())) {
            $time = (int) $this->time->getValue();
        } else {
            SendMessage::Send($player, '時間は数字で入力してください', 'Effect', false, 'dig.chain');
            return;
        }
        if ($time > EffectShopAPI::getInstance()->getTimeRestriction($this->effectName)) {
            SendMessage::Send($player, '付与時間が上限を超えているため処理が中断されました', 'Effect', false, 'dig.chain');
            return;
        }
        if ($time < 1) {
            SendMessage::Send($player, '付与時間が1分未満です', 'Effect', false, 'dig.chain');
            return;
        }
        $level = (int) $this->level->getValue();
        SendForm::Send($player, (new EffectBuyForm($player, $level, $this->effect, $this->effectName, $time)));
    }
}
