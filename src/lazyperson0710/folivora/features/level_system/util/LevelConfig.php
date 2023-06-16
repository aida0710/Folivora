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

    /** @var Config[] */
    private static array $config;
    /** @var array[] */
    private static array $cache;

    /**
     * @param string $path
     * @param ILevel $iLevelClass
     */
    public function __construct(
        private readonly string $path,
        private readonly ILevel $iLevelClass,
    ) {
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function createConfigFile() : void {
        try {
            self::$config[get_class($this->iLevelClass)] = ConfigFoundation::createConfigFile($this->path);
            self::$cache[get_class($this->iLevelClass)] = self::$config[get_class($this->iLevelClass)]->getAll();
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
        self::$config[get_class($this->iLevelClass)]->setAll(self::$cache);
        self::$config[get_class($this->iLevelClass)]->save();
    }

    public function getFunction(Player $player) : LevelFoundation {
        return new LevelFoundation($player, self::$cache, $this->iLevelClass);
    }

}