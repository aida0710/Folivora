<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\electronic_money\currency;

use JsonException;
use lazyperson0710\folivora\features\electronic_money\CurrencyFoundation;
use lazyperson0710\folivora\util\config\ConfigFoundation;
use lazyperson0710\folivora\util\config\exception\ConfigSaveException;
use lazyperson0710\folivora\util\config\IConfig;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Money implements IConfig, ICurrency {

    use SingletonTrait;

    public const PREFIX = 'Money';
    public const SUFFIX = '円';
    public const DEFAULT_CURRENCY = 1500;
    public const PATH = 'player/money.json';
    private Config $config;
    private array $cache = [];

    /**
     * @return void
     * @throws JsonException
     */
    public function createConfigFile() : void {
        try {
            $this->config = ConfigFoundation::createConfigFile(self::PATH);
            $this->cache = $this->config->getAll();
        } catch (ConfigSaveException $exception) {
            throw new ConfigSaveException($exception->getMessage());
        }
    }

    /**
     * @return void
     */
    public function registerConfigClass() : void {
        ConfigFoundation::registerConfigClass($this);
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function runSave() : void {
        $this->config->setAll($this->cache);
        $this->config->save();
    }

    /**
     * @param Player $player
     * @return void
     */
    public function createAccount(Player $player) : void {
        if (!ConfigFoundation::isAccountExist($player, $this->cache)) {
            $this->cache += [$player->getName() => self::DEFAULT_CURRENCY];
        }
    }

    public function getCurrency(Player $player) : CurrencyFoundation {
        return new CurrencyFoundation($player, $this->cache);
    }

}
