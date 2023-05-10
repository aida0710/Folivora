<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\config\features;

use JsonException;
use lazyperson0710\folivora\util\config\ConfigDataPath;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use function array_key_exists;
use function array_merge;
use const JSON_UNESCAPED_UNICODE;

class AchievementData {

    protected const FILE_NAME = 'AchievementData.yml';
    private const DEFAULT_DATA = [];
    private Config $config;
    private array $cache;

    public function __construct() {
        $this->checkCacheData();
    }

    public function checkCacheData() : void {
        if (!isset($this->cache)) {
            $this->config = new Config(
                ConfigDataPath::getInstance()->getPath() . self::FILE_NAME,
                Config::JSON
            );
            $this->config->enableJsonOption(JSON_UNESCAPED_UNICODE);
            $this->cache = $this->config->getAll();
        }
    }

    public function setPlayerData(Player $player, array $data) : void {
        $this->checkPlayerData($player, self::DEFAULT_DATA);
        $editData = array_merge($this->cache[$player->getName()], $data);
        $this->cache[$player->getName()] = $editData;
    }

    public function getPlayerData(Player $player) : array {
        $this->checkPlayerData($player, self::DEFAULT_DATA);
        return $this->cache[$player->getName()];
    }

    public function checkPlayerData(Player $player, array $defaultData) : bool {
        if (!array_key_exists($player->getName(), $this->cache)) {
            $this->cache[$player->getName()] = $defaultData;
            return false;
        }
        return true;
    }

    public function save() : void {
        if (!isset($this->config)) $this->checkCacheData();
        try {
            $this->config->setAll($this->cache);
            $this->config->save();
        } catch (JsonException $e) {
            Server::getInstance()->getLogger()->error($e->getMessage());
        }
    }
}
