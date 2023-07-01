<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\webhook;

use JsonException;
use lazyperson0710\folivora\util\config\ConfigFoundation;
use lazyperson0710\folivora\util\config\exception\ConfigSaveException;
use lazyperson0710\folivora\util\config\IConfig;

class WebHookConfig implements IConfig {

    /**
     * @return void
     * @throws JsonException
     */
    public static function init(): void {
        $webHookConfig = new WebHookConfig();
        $webHookConfig->createConfigFile();
        $webHookConfig->registerConfigClass();
    }

    /**
     * 基本的には特殊なことがない限り一度しか呼び出されない
     * Configクラスは保存する必要がない為、キャッシュのみ作成しています。
     *
     * @return void
     * @throws JsonException
     */
    public function createConfigFile(): void {
        try {
            WebHookURL::getInstance()->setCache(ConfigFoundation::createConfigFile(WebHookURL::PATH)->getAll());
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
     * webHookはデータの書き込みが存在しない為、即returnを行っています。
     *
     * @return void
     */
    public function runSave(): void {
        return;
    }

    /**
     * 基本的に使用しないでください。
     * 全て取得したいときはWebHook::getInstance()->getCache()を使用してください。
     *
     * @return array
     */
    public function getAllData(): array {
        return WebHookURL::getInstance()->getAllURL();
    }

}