<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\register;

use lazyperson0710\folivora\util\exception\ConfigDataPathNotSetException;

class RegisterConfig {

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
}
