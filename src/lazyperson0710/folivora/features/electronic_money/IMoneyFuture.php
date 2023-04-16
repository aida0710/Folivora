<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\electronic_money;

use pocketmine\player\Player;

interface IMoneyFuture {

	public function __construct(Player $player);

	public function setMoney(int $quantity) : void;

	public function getMoney() : int;

	public function addMoney(int $quantity) : void;

	public function reduceMoney(int $quantity) : void;

	public function haveMoney() : int;

}
