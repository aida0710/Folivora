<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\database;

use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\SingletonTrait;

class EnchantShopAPI {

    use SingletonTrait;

    protected array $buy = [];
    protected array $levelLimit = [];
    protected array $miningLevel = [];

    public function init(): void {
        $this->register(VanillaEnchantments::SHARPNESS(), 3000, 5, 30);
        $this->register(VanillaEnchantments::EFFICIENCY(), 5000, 5, 15);
        $this->register(VanillaEnchantments::SILK_TOUCH(), 15000, 1, 15);
        $this->register(EnchantmentIdMap::getInstance()->fromId(EnchantmentIds::FORTUNE), 30000, 3, 25);
        $this->register(VanillaEnchantments::UNBREAKING(), 10000, 3, 5);
        $this->register(VanillaEnchantments::POWER(), 30000, 5, 30);
    }

    public function register(Enchantment $enchantment, int $buy, int $limit, int $miningLevel): void {
        $enchantName = $enchantment->getName();
        if ($enchantName instanceof Translatable) {
            $enchantName = Server::getInstance()->getLanguage()->translate($enchantName);
            //$player->getLanguage()->translate($enchantName);
            //$enchantName = $enchantName->getText();
        }
        $this->buy[$enchantName] = $buy;
        $this->levelLimit[$enchantName] = $limit;
        $this->miningLevel[$enchantName] = $miningLevel;
    }

    public function getBuy(string $enchantmentName): ?int {
        return $this->buy[$enchantmentName];
    }

    public function checkLevel(Player $player, string $enchantmentName): bool {
        $miningLevel = MiningLevelAPI::getInstance();
        if (!($this->getMiningLevel($enchantmentName) < $miningLevel->getLevel($player->getName()))) {
            return false;
        }
        return true;
    }

    public function getMiningLevel(string $enchantmentName): ?int {
        return $this->miningLevel[$enchantmentName];
    }

    public function getLevelLimit(string $enchantmentName): ?int {
        return $this->levelLimit[$enchantmentName];
    }

}
