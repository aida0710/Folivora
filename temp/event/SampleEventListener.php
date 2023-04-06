<?php

declare(strict_types = 1);

namespace temp\event;

use lazyperson0710\folivora\utils\ListenerList;
use temp\event\listeners\block\BlockEventListener;

class SampleEventListener extends ListenerList {

	public function __construct() {
		$this->registerListeners(
			new BlockEventListener(),
		);
	}
}
