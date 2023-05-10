<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\config\features;

use JsonException;
use lazyperson0710\folivora\features\electronic_money\Money;
use lazyperson0710\folivora\features\electronic_money\Ticket;
use lazyperson0710\folivora\util\config\ConfigDataPath;
use pocketmine\data\SavedDataLoadingException;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;
use function array_key_exists;

class PlayerData {

    use SingletonTrait;

    protected const FILE_NAME = 'PlayerData.json';
    private const DEFAULT_DATA = [
        Money::NAME => Money::DEFAULT_CURRENCY,
        Ticket::NAME => Ticket::DEFAULT_CURRENCY,
        'Tag' => '初心者',
        'LastLoginTimeStamp' => 0,
        'LoginDay' => 0,
        'LoginTime' => 0,
    ];
    private Config $config;
    private array $cache;

    public function setCache() : void {
        $this->config = new Config(
            ConfigDataPath::getInstance()->getPath() . self::FILE_NAME,
            Config::JSON,
            ['player' => self::DEFAULT_DATA]
        );
        $this->cache = $this->config->getAll();
    }

    public function createData(Player $player) : bool {
        if ($this->dataExists($player) === false) {
            $this->cache += [$player->getName() => self::DEFAULT_DATA];
            return true;
        } else return false;
    }

    public function getAllData() : array {
        return $this->cache;
    }

    public function getPlayerData(Player $player) {
        return $this->cache[$player->getName()];
    }

    public function setData(Player $player, string $key, string|int $value) : void {
        if ($this->dataExists($player) === false) {
            $this->cache += [$player->getName() => self::DEFAULT_DATA];
        }
        $this->cache[$player->getName()][$key] = $value;
    }

    public function dataExists(Player $player) : bool {
        return array_key_exists($player->getName(), $this->cache);
    }

    public function dataSave() : bool {
        try {
            $this->config->setAll($this->cache);
            $this->config->save();
            return true;
        } catch (JsonException $e) {
            throw new SavedDataLoadingException($e->getMessage());
        }
    }

}
