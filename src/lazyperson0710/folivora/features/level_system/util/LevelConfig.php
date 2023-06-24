<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\util;

use JsonException;
use lazyperson0710\folivora\util\config\ConfigFoundation;
use lazyperson0710\folivora\util\config\exception\ConfigSaveException;
use lazyperson0710\folivora\util\config\IConfig;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class LevelConfig implements IConfig {

    /** @var Config[] */
    private static array $config;
    private static array $cache;

    /**
     * @param Levels $Level
     * @param string $path
     */
    public function __construct(
        private readonly Levels $Level,
        private readonly string $path,
    ) {
    }

    /**
     * 基本的には特殊なことがない限り一度しか呼び出されない
     *
     * @return void
     * @throws JsonException
     * @see LevelConfig::registerConfigClass()
     *
     */
    public function createConfigFile(): void {
        if (isset(self::$config[$this->Level->value])) return;
        try {
            self::$config[$this->Level->value] = ConfigFoundation::createConfigFile($this->path);
            self::$cache[$this->Level->value] = self::$config[$this->Level->value]->getAll();
        } catch (ConfigSaveException $exception) {
            throw new ConfigSaveException($exception->getMessage());
        }
    }

    /**
     * 起動時に一度呼び出してください
     *
     * @return void
     */
    public function registerConfigClass(): void {
        ConfigFoundation::registerConfigClass($this);
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function runSave(): void {
        self::$config[$this->Level->value]->setAll(self::$cache[$this->Level->value]);
        self::$config[$this->Level->value]->save();
    }

    /**
     * @param Player $player
     * @return LevelFoundation
     */
    public function getFunction(Player $player): LevelFoundation {
        return new LevelFoundation($player, self::$cache[$this->Level->value], $this->Level);
    }

    /**
     * @return array
     */
    public function getAllPlayerData(): array {
        return self::$cache[$this->Level->value];
    }

}