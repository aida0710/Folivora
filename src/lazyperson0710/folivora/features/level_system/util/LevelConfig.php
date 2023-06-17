<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\util;

use JsonException;
use lazyperson0710\folivora\features\level_system\levels\ILevel;
use lazyperson0710\folivora\util\config\ConfigFoundation;
use lazyperson0710\folivora\util\config\exception\ConfigSaveException;
use lazyperson0710\folivora\util\config\IConfig;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class LevelConfig implements IConfig {

    /**
     * @param ILevel $ILevel
     * @param string $path
     * @param Config $config
     * @param array  $cache
     */
    public function __construct(
        private readonly Ilevel $ILevel,
        private readonly string $path,
        private readonly Config $config,
        private array $cache,
    ) {
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function createConfigFile() : void {
        try {
            $this->config = ConfigFoundation::createConfigFile($this->path);
            $this->cache = $this->config->getAll();
            $this->ILevel->setConfig($this->config);
        } catch (ConfigSaveException $exception) {
            throw new ConfigSaveException($exception->getMessage());
        }
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function registerConfigClass() : void {
        ConfigFoundation::registerConfigClass($this);
        $this->createConfigFile();
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function runSave() : void {
        $this->config->setAll($this->cache);
        $this->config->save();
    }

    public function getFunction(Player $player) : LevelFoundation {
        return new LevelFoundation($player, self::$cache, $this->iLevelClass);
    }

}