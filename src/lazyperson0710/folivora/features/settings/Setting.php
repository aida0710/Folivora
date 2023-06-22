<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\settings;

use JsonException;
use lazyperson0710\folivora\features\settings\setting_type\IPlayerSetting;
use lazyperson0710\folivora\util\config\ConfigFoundation;
use lazyperson0710\folivora\util\config\exception\ConfigSaveException;
use lazyperson0710\folivora\util\config\IConfig;
use lazyperson0710\folivora\util\exception\AbnormalValueEnteredException;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Setting implements IConfig {

    use SingletonTrait;

    public const PREFIX = 'Setting';
    public const PATH = 'player/setting';
    private Config $config;
    private array $cache = [];

    /**
     * 値を変更する際はこちらを使用してください。
     *
     * @param Player         $player
     * @param IPlayerSetting $setting
     * @param mixed          $value
     * @return void
     */
    public function editSettingData(Player $player, IPlayerSetting $setting, mixed $value): void {
        $this->checkSettingData($player, $setting);
        foreach ($setting->normalValue() as $normalValue) {
            if ($normalValue === $value) {
                $this->cache[$player->getName()][$setting->getName()] = $value;
                return;
            }
        }
        throw new AbnormalValueEnteredException(AbnormalValueEnteredException::MESSAGE);
    }

    /**
     * @param Player         $player
     * @param IPlayerSetting $setting
     * @return mixed
     */
    private function checkSettingData(Player $player, IPlayerSetting $setting): mixed {
        if (!ConfigFoundation::isAccountExist($player, $this->cache)) {
            $this->cache += [$player->getName()];
        }
        $this->cache[$player->getName()][$setting->getName()] = $setting->getDefaultValue();
        return $this->cache[$player->getName()][$setting->getName()];
    }

    public function getSettingData(Player $player, IPlayerSetting $setting): mixed {
        $this->checkSettingData($player, $setting);
        return $this->cache[$player->getName()][$setting->getName()];
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function createConfigFile(): void {
        try {
            $this->config = ConfigFoundation::createConfigFile(self::PATH);
            $this->cache = $this->config->getAll();
        } catch (ConfigSaveException $exception) {
            Server::getInstance()->getLogger()->warning($exception);
        }
    }

    /**
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
        $this->config->setAll($this->cache);
        try {
            $this->config->save();
        } catch (ConfigSaveException $exception) {
            Server::getInstance()->getLogger()->warning($exception);
        }
    }
}