<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\config;

use JsonException;
use lazyperson0710\folivora\util\config\exception\ConfigDataPathNotSetException;
use lazyperson0710\folivora\util\config\exception\ConfigSaveException;
use lazyperson0710\folivora\util\register\RegisterTaskScheduler;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\Config;

class ConfigFoundation {

    /** @var IConfig[] $iConfigs */
    private static array $iConfigs;
    private static string $dataPath;

    /**
     * 最初に一度だけ実行してください。
     *
     * @param string $path
     * @return void
     */
    public static function init(string $path) : void {
        self::$dataPath = $path;
        RegisterTaskScheduler::getScheduler()->scheduleRepeatingTask(
            new ClosureTask(
                function () : void {
                    self::runAllSave();
                    var_dump('saveされました');
                }
            ), 20 * 30,
        );
    }

    /**
     * 基本的にこちらから3分ごとに自動で全ての記録データが保存されます。
     * 非同期処理には対応していません。
     *
     * @return void
     */
    public static function runAllSave() : void {
        foreach (self::$iConfigs as $iConfig) {
            $iConfig->runSave();
        }
    }

    /**
     * Configオブジェクトを生成します。
     * ディレクトリ階層は自動で生成されるため$path = ' dir1/dir2/file.txt 'のように指定してください。
     * また、この静的関数を使用した場合はRegisterConfig::registerConfig()に自動で登録されます。
     *
     * @param string   $path
     * @param int|null $fileType
     * @return Config
     * @throws JsonException
     * @see ConfigFoundation::registerConfig()
     */
    public static function createConfigFile(string $path, ?int $fileType = Config::JSON) : Config {
        $pathArray = explode('/', $path);
        $fileName = array_pop($pathArray);
        $directoryPath = null;
        foreach ($pathArray as $value) {
            if (file_exists(ConfigFoundation::getDataPath() . $directoryPath . $value) === false) mkdir(ConfigFoundation::getDataPath() . $directoryPath . $value, 0777, true);
            $directoryPath .= $value . '/';
        }
        $config = new Config(ConfigFoundation::getDataPath() . $directoryPath . $fileName, $fileType);
        try {
            $config->save();
        } catch (ConfigSaveException $exception) {
            throw new ConfigSaveException($exception->getMessage());
        }
        return $config;
    }

    /**
     * Configを保存するデータフォルダのパスを取得します。
     *
     * @return string
     */
    public static function getDataPath() : string {
        if (!isset(self::$dataPath)) {
            throw new ConfigDataPathNotSetException(ConfigDataPathNotSetException::MESSAGE);
        }
        return self::$dataPath;
    }

    /**
     * Configを使用するクラスは絶対に登録してください。
     * セーブされません。
     *
     * @param IConfig $iConfig
     * @return void
     */
    public static function registerConfigClass(IConfig $iConfig) : void {
        self::$iConfigs[] = $iConfig;
    }

    /**
     * @param Player $player
     * @param array  $configCache
     * @return bool
     */
    public static function isAccountExist(Player $player, array $configCache) : bool {
        if (!array_key_exists($player->getName(), $configCache)) {
            return false;
        }
        return true;
    }

}
