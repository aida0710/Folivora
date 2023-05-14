<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\temp;

use bbo51dog\bboform\form\SimpleForm;
use deceitya\MiningLevel\MiningLevelAPI;
use lazyperson0710\ShopSystem\database\LevelShopAPI;
use lazyperson0710\ShopSystem\form\element\ShopMainCategoryFormButton;
use lazyperson0710\ShopSystem\form\levelShop\other\OtherShopFunctionSelectForm;
use lazyperson0710\ShopSystem\form\levelShop\temp\shop1\Shop1Form;
use lazyperson0710\ShopSystem\form\levelShop\temp\shop2\Shop2Form;
use lazyperson0710\ShopSystem\form\levelShop\temp\shop3\Shop3Form;
use lazyperson0710\ShopSystem\form\levelShop\temp\shop4\Shop4Form;
use lazyperson0710\ShopSystem\form\levelShop\temp\shop5\Shop5Form;
use lazyperson0710\ShopSystem\form\levelShop\temp\shop6\Shop6Form;
use lazyperson0710\ShopSystem\form\levelShop\temp\shop7\Shop7Form;
use pocketmine\player\Player;

class MainLevelShopForm extends SimpleForm {

    public function __construct(Player $player, ?string $error = null) {
        $levelShopList = [
            LevelShopAPI::RESTRICTION_LEVEL_OTHER_SHOP => new OtherShopFunctionSelectForm(),
            LevelShopAPI::RESTRICTION_LEVEL_SHOP_1 => new Shop1Form(),
            LevelShopAPI::RESTRICTION_LEVEL_SHOP_2 => new Shop2Form(),
            LevelShopAPI::RESTRICTION_LEVEL_SHOP_3 => new Shop3Form(),
            LevelShopAPI::RESTRICTION_LEVEL_SHOP_4 => new Shop4Form(),
            LevelShopAPI::RESTRICTION_LEVEL_SHOP_5 => new Shop5Form(),
            LevelShopAPI::RESTRICTION_LEVEL_SHOP_6 => new Shop6Form(),
            LevelShopAPI::RESTRICTION_LEVEL_SHOP_7 => new Shop7Form(),
        ];
        $this
            ->setTitle('Level Shop')
            ->setText("見たいコンテンツを選択してください\n{$error}");
        foreach ($levelShopList as $restrictionLevel => $levelShop) {
            $content = match ($levelShop::class) {
                OtherShopFunctionSelectForm::class => 'Other - 一括売却 & 検索',
                Shop1Form::class => 'Level Shop - 1',
                Shop2Form::class => 'Level Shop - 2',
                Shop3Form::class => 'Level Shop - 3',
                Shop4Form::class => 'Level Shop - 4',
                Shop5Form::class => 'Level Shop - 5',
                Shop6Form::class => 'Level Shop - 6',
                Shop7Form::class => 'Level Shop - 7',
                default => 'Unknown',
            };
            if (MiningLevelAPI::getInstance()->getLevel($player) >= $restrictionLevel) {
                $restrictionLevelMessage = "§a解放済み / 要求レベル -> lv.{$restrictionLevel}";
            } else {
                $restrictionLevelMessage = "§c{$restrictionLevel}レベル以上で開放されます";
            }
            $this->addElements(
                new ShopMainCategoryFormButton("{$content}\n{$restrictionLevelMessage}", $levelShop),
            );
        }
    }
}
