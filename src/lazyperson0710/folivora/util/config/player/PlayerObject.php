<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\config\player;

use pocketmine\player\Player;

class PlayerObject {

    public const DEFAULT_MONEY = 1500;
    public const DEFAULT_TICKET = 10;
    public const DEFAULT_MINING_LEVEL = 1;
    public const DEFAULT_MINING_EXP = 0;
    public const DEFAULT_MINING_UP_EXP = 80;
    public const DEFAULT_TAG = '§b初心者';

    public function __construct(
        private Player $player,
        private int $money,
        private int $ticket,
        private int $miningLevel,
        private int $miningExp,
        private int $miningUpExp,
        private string $tag,
    ) {
    }

    public static function createDefault(Player $player) : self {
        return new self(
            $player,
            self::DEFAULT_MONEY,
            self::DEFAULT_TICKET,
            self::DEFAULT_MINING_LEVEL,
            self::DEFAULT_MINING_EXP,
            self::DEFAULT_MINING_UP_EXP,
            self::DEFAULT_TAG,
        );
    }

    public function getPlayer() : Player {
        return $this->player;
    }

    public function setMoney(int $money) : void {
        $this->money = $money;
    }

    public function getMoney() : int {
        return $this->money;
    }

    public function setTicket(int $ticket) : void {
        $this->ticket = $ticket;
    }

    public function getTicket() : int {
        return $this->ticket;
    }

    public function setMiningLevel(int $miningLevel) : void {
        $this->miningLevel = $miningLevel;
    }

    public function getMiningLevel() : int {
        return $this->miningLevel;
    }

    public function setMiningExp(int $miningExp) : void {
        $this->miningExp = $miningExp;
    }

    public function getMiningExp() : int {
        return $this->miningExp;
    }

    public function setMiningUpExp(int $miningUpExp) : void {
        $this->miningUpExp = $miningUpExp;
    }

    public function getMiningUpExp() : int {
        return $this->miningUpExp;
    }

    public function setTag(string $tag) : void {
        $this->tag = $tag;
    }

    public function getTag() : string {
        return $this->tag;
    }

    public function setAchievement(array $achievement) : void {
        $this->achievement = $achievement;
    }

    public function getAchievement() : array {
        return $this->achievement;
    }
}