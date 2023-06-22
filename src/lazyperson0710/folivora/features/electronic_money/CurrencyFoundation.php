<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\electronic_money;

use lazyperson0710\folivora\util\config\ConfigFoundation;
use pocketmine\player\Player;

class CurrencyFoundation {

    public function __construct(
        private readonly Player $player,
        private array &$configCache,
    ) {
    }

    /**
     * @param int $money
     * @return void
     */
    public function setCurrency(int $money): void {
        $player_name = $this->player->getName();
        if (!ConfigFoundation::isAccountExist($this->player, $this->configCache)) return;
        $this->configCache[$player_name] = $money;
    }

    /**
     * @param int $money
     * @return void
     */
    public function addCurrency(int $money): void {
        $player_name = $this->player->getName();
        if (!ConfigFoundation::isAccountExist($this->player, $this->configCache)) return;
        $money = $this->getCurrency() + $money;
        $this->configCache[$player_name] = $money;
    }

    /**
     * @return int
     */
    public function getCurrency(): int {
        $player_name = $this->player->getName();
        if (!ConfigFoundation::isAccountExist($this->player, $this->configCache)) return 0;
        return $this->configCache[$player_name];
    }

    /**
     * @param int $reduce
     * @return void
     */
    public function reduceCurrency(int $reduce): void {
        if (!ConfigFoundation::isAccountExist($this->player, $this->configCache)) return;
        if ($reduce <= 0) return;
        $int = $this->configCache[$this->player->getName()];
        $result = $int - $reduce;
        if ($result < 0) {
            $this->configCache[$this->player->getName()] = 0;
            return;
        }
        $this->configCache[$this->player->getName()] = $result;
    }

}