<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\effect_shop;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\folivora\features\shop\database\EffectShopAPI;
use lazyperson0710\folivora\features\shop\form\effect_shop\element\EffectSelectFormButton;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\lang\Translatable;
use pocketmine\Server;

class EffectSelectForm extends SimpleForm {

    public function __construct(?string $error = '') {
        $effects = [
            VanillaEffects::HASTE(),
            VanillaEffects::SPEED(),
            VanillaEffects::REGENERATION(),
            VanillaEffects::NIGHT_VISION(),
            VanillaEffects::JUMP_BOOST(),
            VanillaEffects::WATER_BREATHING(),
        ];
        $api = EffectShopAPI::getInstance();
        $this
            ->setTitle('effect Form')
            ->setText("付与したい効果を選択してください\n{$error}");
        foreach ($effects as $effect) {
            $effectName = $effect->getName();
            if ($effectName instanceof Translatable) {
                $effectName = Server::getInstance()->getLanguage()->translate($effectName);
            }
            $this->addElement(new EffectSelectFormButton("{$effectName} 価格 - 毎lv.{$api->getBuy($effectName)}\nレベル増加時価格{$api->getAmplifiedMoney($effectName)} | 付与レベル制限 - {$api->getLevelLimit($effectName)}以下", $effect));
        }
    }

}
