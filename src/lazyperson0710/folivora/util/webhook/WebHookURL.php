<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\webhook;

use pocketmine\utils\SingletonTrait;

class WebHookURL {

    use SingletonTrait;

    private static array $cache;
    private static bool $startUpFlag = false;
    public const PATH = 'webhook.json';

    /**
     * @param array $cache
     * @return void
     */
    public function setCache(array $cache): void {
        if (isset(self::$cache)) throw new \RuntimeException('cacheに二重書き込みが行われました');
        self::$cache = $cache;
    }

    /**
     * @param string $webHookName
     * @return string
     */
    public function getURL(string $webHookName): string {
        $this->startUp();
        if (!isset(self::$cache[$webHookName])) throw new \RuntimeException('存在しないwebHookNameが指定されました');
        return self::$cache[$webHookName];
    }

    /**
     * @return array
     */
    public function getAllURL(): array {
        $this->startUp();
        return self::$cache;
    }

    /**
     * @return void
     */
    private function startUp(): void {
        if (!self::$startUpFlag) {
            self::$startUpFlag = true;
            try {
                WebHookConfig::init();
            } catch (\JsonException $exception) {
                throw new \RuntimeException($exception->getMessage());
            }
        }
    }
}