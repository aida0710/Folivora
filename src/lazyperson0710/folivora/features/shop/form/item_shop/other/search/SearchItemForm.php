<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\other\search;

use bbo51dog\bboform\element\Input;
use bbo51dog\bboform\form\CustomForm;
use lazyperson0710\folivora\features\shop\database\ItemShopAPI;
use lazyperson0710\folivora\features\shop\form\item_shop\future\FormText;
use lazyperson0710\folivora\features\shop\object\ItemShopObject;
use lazyperson0710\folivora\util\packet\SendForm;
use lazyperson0710\folivora\util\packet\SoundPacket;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class SearchItemForm extends CustomForm {

    private Input $itemName;

    public function __construct(?string $msg = null) {
        $this->itemName = new Input(
            $msg . '調べたいアイテムの名前を入力してください' . PHP_EOL .
            '入力した値が含まれている名前のアイテムがすべて表示されます',
            '石');
        $this
            ->setTitle(FormText::TITLE)
            ->addElements(
                $this->itemName,
            );
    }

    public function handleSubmit(Player $player): void {
        $items = [];
        if (!preg_match('/[ぁ-ん]+|[ァ-ヴー]+|[一-龠]/u', $this->itemName->getValue())) {
            SendForm::Send($player, (new SearchItemForm(
                TextFormat::RED . '例外が発生しました' . PHP_EOL .
                'ItemNameの入力欄には日本語(ひらがな/カタカナ/漢字)を含める必要があります' . PHP_EOL
            )));
            SoundPacket::Send($player, 'dig.chain');
            return;
        }
        foreach (ItemShopAPI::getInstance()->getDisplayName() as $displayName) {
            if (str_contains($displayName, $this->itemName->getValue())) {
                $item = ItemShopAPI::getInstance()->getItemByDisplayName($displayName);
                if ($item instanceof ItemShopObject) $items[] = $item;
            }
        }
        if (empty($items)) {
            SendForm::Send($player, (new SearchItemForm(
                TextFormat::RED . '例外が発生しました' . PHP_EOL .
                '入力した値が含まれている名前のアイテムが見つかりませんでした' . PHP_EOL
            )));
            SoundPacket::Send($player, 'dig.chain');
            return;
        }
        /** @var array<ItemShopObject> $items */
        SendForm::Send($player, new SearchResultForm($player, $items));
    }
}
