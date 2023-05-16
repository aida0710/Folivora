<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\electronic_money;

use JsonException;
use lazyperson0710\folivora\util\config\ConfigFoundation;
use lazyperson0710\folivora\util\config\exception\ConfigSaveException;
use lazyperson0710\folivora\util\config\IConfig;
use lazyperson0710\folivora\util\exception\QuantityLimitReached;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Money implements IConfig {

    use SingletonTrait;

    private Config $config;

    public const PREFIX = "Money";
    public const SUFFIX = '円';
    public const DEFAULT_CURRENCY = 1500;
    public const PATH = 'player/money.json';

    /**
     * @return void
     * @throws JsonException
     */
    public function createConfigFile() : void {
        try {
            $this->config = ConfigFoundation::createConfigFile(self::PATH);
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
        $this->config->save();
    }

    /**
     * @param Player $player
     * @return void
     */
    public function createAccount(Player $player) : void {
        $player_name = $player->getName();
        if ($this->config->get($player_name)) return;
        $this->config->set($player_name, self::DEFAULT_CURRENCY);
    }

    public function getMoney(Player $player) : int {
        $player_name = $player->getName();
        if (!ConfigFoundation::isAccountExist($player, $this->config)) return 0;
        return $this->config->get($player_name);
    }

    public function setMoney(Player $player, int $money) : void {
        $player_name = $player->getName();
        if (!ConfigFoundation::isAccountExist($player, $this->config)) return;
        if (PHP_INT_MAX < $money) throw new QuantityLimitReached(QuantityLimitReached::MESSAGE);
        $this->config->set($player_name, $money);
    }

    public function addMoney(Player $player, int $money) : void {
        $player_name = $player->getName();
        if (!ConfigFoundation::isAccountExist($player, $this->config)) return;
        $money = $this->getMoney($player) + $money;
        if (PHP_INT_MAX < $money) throw new QuantityLimitReached(QuantityLimitReached::MESSAGE);
        $this->config->set($player_name, $money);
    }

    public function reduceMoney(Player $player, int $money) : void {
        $player_name = $player->getName();
        if (!ConfigFoundation::isAccountExist($player, $this->config)) return;
        $money = $this->getMoney($player) - $money;
        if (0 >= $money) {
            var_dump("0以下のため、0に設定しました。");
            $money = 0;
        }
        $this->config->set($player_name, $money);
    }

}
