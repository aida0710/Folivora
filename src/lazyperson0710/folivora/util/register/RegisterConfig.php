<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\register;

use JsonException;
use lazyperson0710\folivora\util\config\IConfig;
use lazyperson0710\folivora\util\exception\ConfigDataPathNotSetException;
use lazyperson0710\folivora\util\exception\ConfigSaveException;
use pocketmine\utils\Config;

class RegisterConfig {

    /** @var Config[] */
    private static array $configList = [];
    private static string $dataPath;

    /**
     * Configを保存するデータフォルダのパスを取得します。
     *
     * @return string
     */
    public static function getDataPath() : string {
        if (!isset(self::$dataPath)) {
            throw new ConfigDataPathNotSetException('Path is not set.');
        }
        return self::$dataPath;
    }

    /**
     * プラグイン起動時に一度だけ実行してください。
     *
     * @param string $path
     * @return void
     */
    public static function setDataPath(string $path) : void {
        self::$dataPath = $path;
    }

    /**
     * 最初に必ずconfigをすべて登録してください。
     *
     * @param Config $config
     * @return void
     */
    public static function registerConfig(Config $config) : void {
        self::$configList = [];
    }

    /**
     * 一括セーブなどにご利用ください。
     *
     * @return Config[]
     */
    public static function getRegisterConfig() : array {
        return self::$configList;
    }

    /**
     * @return void
     * @throws JsonException
     */
    public static function saveAllConfig() : void {
        foreach (self::$configList as $config) {
            try {
                $config->save();
            } catch (ConfigSaveException $error) {
                throw new ConfigSaveException($error->getMessage());
            }
        }
    }
}
