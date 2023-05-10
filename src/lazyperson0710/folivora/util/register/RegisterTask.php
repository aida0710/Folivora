<?php

namespace lazyperson0710\folivora\util\register;

use pocketmine\scheduler\TaskScheduler;

class RegisterTask {

    private static TaskScheduler $scheduler;

    public static function init(TaskScheduler $scheduler) : void {
        self::$scheduler = $scheduler;
    }

    public static function register() : TaskScheduler {
        return self::$scheduler;
    }

}