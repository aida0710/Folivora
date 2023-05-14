<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\config;

use JsonException;
use lazyperson0710\folivora\util\exception\ConfigSaveException;
use lazyperson0710\folivora\util\register\RegisterConfig;
use pocketmine\utils\Config;

abstract class ConfigFoundation {

    /**
     * Configオブジェクトを生成します。
     * ディレクトリ階層は自動で生成されるため$path = ' dir1/dir2/file.txt 'のように指定してください。
     * また、この静的関数を使用した場合はRegisterConfig::registerConfig()に自動で登録されます。
     *
     * @param string   $path
     * @param int|null $fileType
     * @return Config
     * @throws JsonException
     *
     * @see RegisterConfig::registerConfig()
     *
     */
    protected function createConfigFile(string $path, ?int $fileType = Config::JSON) : Config {
        $pathArray = explode('/', $path);
        $fileName = array_pop($pathArray);
        $directoryPath = null;
        foreach ($pathArray as $value) {
            if (file_exists($directoryPath . $value) === false) mkdir($directoryPath . $value, 0777, true);
            $directoryPath .= $value . '/';
        }
        $config = new Config(RegisterConfig::getDataPath() . $directoryPath . $fileName, $fileType);
        try {
            $config->save();
        } catch (ConfigSaveException $error) {
            throw new ConfigSaveException($error->getMessage());
        }
        RegisterConfig::registerConfig($config);
        return $config;
    }

    /**
     * データをセーブするときは必ず使ってください。
     * また、この関数を実行する直前にキャッシュを削除しデータの重複を避けてください。
     *
     * @param array  $data
     * @param Config $config
     * @return bool
     * @throws JsonException
     */
    public function saveConfig(array $data, Config $config) : bool {
        $config->setAll($data);
        try {
            $config->save();
        } catch (ConfigSaveException $error) {
            return false;
        }
        return true;
    }
}