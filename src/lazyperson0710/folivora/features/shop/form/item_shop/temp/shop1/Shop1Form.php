<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\temp\shop1;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\element\ShopItemFormButton;
use lazyperson0710\ShopSystem\form\levelShop\element\FirstBackFormButton;
use lazyperson0710\ShopSystem\form\levelShop\temp\MainLevelShopForm;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\player\Player;

class Shop1Form extends SimpleForm {

    public function __construct() {
        $contents = [
            '石材類' => 'Stones',
            '原木類' => 'Logs',
            '鉱石類' => 'Ores',
            'ツール' => 'Tools',
            '食料アイテム' => 'Foods',
            'その他アイテム' => 'Others',
            '通貨アイテム' => 'Currency',
        ];
        $this
            ->setTitle('Level Shop')
            ->setText('§7選択してください');
        foreach ($contents as $key => $value) {
            $class = __NAMESPACE__ . "\\" . $value;
            $this->addElements(new ShopItemFormButton($key, $class));
        }
        $this->addElements(new FirstBackFormButton('ホームに戻る'));
    }

    public function handleClosed(Player $player) : void {
        SoundPacket::Send($player, 'mob.shulker.close');
        SendForm::Send($player, (new MainLevelShopForm($player)));
    }
}
