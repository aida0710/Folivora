<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\element;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\element\ButtonImage;
use lazyperson0710\folivora\features\shop\form\item_shop\future\LevelCheck;
use lazyperson0710\folivora\features\shop\form\item_shop\future\RestrictionShop;
use lazyperson0710\folivora\features\shop\form\item_shop\ItemSelectForm;
use lazyperson0710\folivora\features\shop\object\ItemShopObject;
use lazyperson0710\folivora\util\packet\SoundPacket;
use pocketmine\player\Player;

class ItemSelectBackFormButton extends Button {

    public function __construct(
        string $text,
        private readonly ItemShopObject $item,
        ?ButtonImage $image = null,
    ) {
        parent::__construct($text, $image);
    }

    public function handleSubmit(Player $player) : void {
        SoundPacket::Send($player, 'mob.shulker.close');
        LevelCheck::sendForm($player, new ItemSelectForm($player, $this->item->getShopId(), $this->item->getItemCategory()), RestrictionShop::getInstance()->getRestrictionByShopNumber($this->item->getShopId()));
    }
}
