<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\effect_shop;

use bbo51dog\bboform\element\Label;
use bbo51dog\bboform\form\CustomForm;
use lazyperson0710\folivora\features\electronic_money\currency\Money;
use lazyperson0710\folivora\features\shop\database\effectShopAPI;
use lazyperson0710\folivora\features\shop\event\EffectShopBuyEvent;
use lazyperson0710\folivora\util\message\send_message\SendMessage;
use pocketmine\entity\effect\Effect;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\player\Player;

class EffectBuyForm extends CustomForm {

    private int $level;
    private int $time;
    private Effect $effect;
    private string $effectName;

    public function __construct(Player $player, int $level, Effect $effect, string $effectName, int $time) {
        $this->level = $level;
        $this->time = $time;
        $this->effect = $effect;
        $this->effectName = $effectName;
        $api = EffectShopAPI::getInstance();
        $this
            ->setTitle('Effect Form')
            ->addElements(
                new Label('現在の所持金 -> ' . Money::getInstance()->getFunction($player)->getCurrency() . "円\n"),
                new Label('購入価格 -> ' . $this->time * $api->getBuy($effectName) + ($this->level * $api->getAmplifiedMoney($effectName)) . '円'),
                new Label("{$effectName}を{$level}レベルで{$this->time}分付与しますか？\n"),
                new Label('§c注意 : エフェクト時間は加算されず、上書きされます(30分を二度付与しても60分にはならず30分になります)§r'),
            );
    }

    public function handleSubmit(Player $player): void {
        $price = $this->time * EffectShopAPI::getInstance()->getBuy($this->effectName) + ($this->level * EffectShopAPI::getInstance()->getAmplifiedMoney($this->effectName));
        if (Money::getInstance()->getFunction($player)->getCurrency() <= $price) {
            SendMessage::Send($player, "所持金が足りない為処理が中断されました。要求価格 -> {$price}円", 'Effect', false, 'dig.chain');
            return;
        }
        Money::getInstance()->getFunction($player)->reduceCurrency($price);
        $player->getEffects()->add(new EffectInstance($this->effect, $this->time * 20 * 60, $this->level - 1, false));
        SendMessage::Send($player, "{$this->effectName}を{$this->level}レベルで{$this->time}分付与し、{$price}円消費しました", 'Effect', true, 'break.amethyst_block');
        $event = new EffectShopBuyEvent($player, $this->effect, $this->effectName, $this->level, $this->time, $price);
        $event->call();
    }

}
