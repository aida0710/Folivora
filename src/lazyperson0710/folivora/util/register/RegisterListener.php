<?php

namespace lazyperson0710\folivora\util\register;

use pocketmine\event\Listener;
use pocketmine\plugin\Plugin;

class RegisterListener {

    private static Plugin $plugin;

    public static function setPlugin(Plugin $plugin) : void {
        self::$plugin = $plugin;
    }

    public static function getPlugin() : Plugin {
        return self::$plugin;
    }

    public static function register(Listener $listener) : void {
        self::getPlugin()->getServer()->getPluginManager()->registerEvents($listener, self::getPlugin());
    }

}