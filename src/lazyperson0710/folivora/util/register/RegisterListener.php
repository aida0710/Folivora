<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\register;

use pocketmine\event\Listener;
use pocketmine\plugin\Plugin;

class RegisterListener {

    /** @var Plugin */
    private static Plugin $plugin;

    /**
     * プラグイン起動時に一度だけ実行してください。
     *
     * @param Plugin $plugin
     * @return void
     */
    public static function setPlugin(Plugin $plugin): void {
        self::$plugin = $plugin;
    }

    /**
     * イベントListenerを登録します。
     * 起動時に読み込まれるクラスに記述するようにしてください。@param Listener $listener
     *
     * @return void
     * @see RegisterFeatures::enableFeatures()
     *
     */
    public static function register(Listener $listener): void {
        $registerListener = new RegisterListener();
        $plugin = $registerListener->getPlugin();
        $plugin->getServer()->getPluginManager()->registerEvents($listener, $plugin);
    }

    /**
     * Pluginオブジェクトを取得します。
     *
     * @return Plugin
     */
    private function getPlugin(): Plugin {
        return self::$plugin;
    }

}