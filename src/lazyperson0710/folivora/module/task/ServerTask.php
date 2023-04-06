<?php

namespace lazyperson0710\folivora\module\task;

use pocketmine\scheduler\Task;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\utils\SingletonTrait;

class ServerTask {

	use SingletonTrait;

	private TaskScheduler $scheduler;

	public function init(TaskScheduler $scheduler) : void {
		$this->scheduler = $scheduler;
	}

	public function setRepeatingTask(Task $class, int $tick) : void {
		$this->scheduler->scheduleRepeatingTask($class, $tick);
	}

	public function setDelayedTask(Task $class, int $tick) : void {
		$this->scheduler->scheduleDelayedTask($class, $tick);
	}

	public function setDelayedRepeatingTask(Task $class, int $tick, int $delay) : void {
		$this->scheduler->scheduleDelayedRepeatingTask($class, $tick, $delay);
	}
}