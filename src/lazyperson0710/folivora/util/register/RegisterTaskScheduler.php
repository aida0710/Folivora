<?php

namespace lazyperson0710\folivora\util\register;

use pocketmine\scheduler\TaskScheduler;

class RegisterTaskScheduler {

    private static TaskScheduler $scheduler;

    /**
     * プラグイン起動時に一度だけ実行してください。
     *
     * @param TaskScheduler $scheduler
     * @return void
     */
    public static function init(TaskScheduler $scheduler) : void {
        self::$scheduler = $scheduler;
    }

    /**
     * TaskSchedulerオブジェクトを取得します。
     * Taskを実行させたい場合はこの関数を使用してください。
     *
     * @return TaskScheduler
     */
    public static function getScheduler() : TaskScheduler {
        return self::$scheduler;
    }

}