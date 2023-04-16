<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\electronic_money;

interface IMoney {

	public function setName(string $name) : void;

	public function setSuffix(string $suffix) : void;

	public function setDefaultMoney(int $quantity) : void;

	public function getName() : string;

	public function getSuffix() : string;

	public function getDefaultMoney() : int;
}
