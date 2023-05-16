<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\task;

use lazyperson0710\folivora\util\register\RegisterTaskScheduler;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;

class IntervalTask {

    /** @var array<string, array<string, bool>> */
    public static array $WaitingTaskList = [];

    /**
     * 数秒間無効化する。というタスクが容易に実装出来ます。
     * また、check関数から現在実行中かどうかを確認することが可能です。@param Player $player
     *
     * @param string $intervalName
     * @param int $tick
     * @return void
     * @see check
     *
     */
    public static function onRun(Player $player, string $intervalName, int $tick) : void {
        self::$WaitingTaskList[$player->getName()][$intervalName] = true;
        RegisterTaskScheduler::getScheduler()->scheduleDelayedTask(new ClosureTask(
            function () use ($player, $intervalName) : void {
                self::unset($player, $intervalName);
            }
        ), $tick);
    }

    /**
     * 配列から登録を削除することで実質的にタスクを削除します。
     * 基本的にはonRun関数から呼び出してください。
     *
     * @param Player $player
     * @param string $intervalName
     * @return void
     */
    public static function unset(Player $player, string $intervalName) : void {
        unset(self::$WaitingTaskList[$player->getName()][$intervalName]);
    }

    /**
     * 現在タスクを実行中かどうかを確認できます。
     *
     * @param Player $player
     * @param string $intervalName
     * @return bool
     */
    public static function check(Player $player, string $intervalName) : bool {
        return isset(self::$WaitingTaskList[$player->getName()][$intervalName]);
    }

}
