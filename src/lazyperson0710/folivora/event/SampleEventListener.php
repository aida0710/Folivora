<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\event;

use lazyperson0710\folivora\event\listeners\block\BlockEventListener;
use lazyperson0710\folivora\utils\ListenerList;

class SampleEventListener extends ListenerList {

	public function __construct() {
		$this->registerListeners(
			new BlockEventListener(),
		);
	}
}
