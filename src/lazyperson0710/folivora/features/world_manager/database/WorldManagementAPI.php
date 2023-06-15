<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager\database;

use pocketmine\Server;
use pocketmine\utils\SingletonTrait;

class WorldManagementAPI {

    use SingletonTrait;

    protected array $heightLimit = [];
    protected array $miningLevelLimit = [];
    protected array $flyLimit = [];
    protected array $x1 = [];
    protected array $x2 = [];
    protected array $z1 = [];
    protected array $z2 = [];

    public function init() : void {
        #public
        $this->register('lobby', 255, 0, 0, 320, 280, 230, 80);
        $this->register('tos', 255, 0, 0, 260, 260, 200, 230);
        $this->register('athletic', 255, 10, 0);
        $this->register('pvp', 255, 30, 0, 330, 268, 224, 162);
        #event
        $this->register('event-1', 255, 0, 0);
        $this->register('event-2', 255, 0, 0);
        $this->register('event-3', 255, 0, 0);
        $this->register('event-4', 255, 0, 0);
        $this->register('event-5', 255, 0, 0);
        #nature
        $this->register('nature-1', 180, 0, 200, 8000, 8000, -8000, -8000);
        $this->register('nature-2', 180, 150, 200, 35000, 35000, -35000, -35000);
        $this->register('nature-3', 180, 350, 200, 85000, 85000, -85000, -85000);
        $this->register('MiningWorld', 120, 30, 130, 8000, 8000, -8000, -8000);
        #nether
        $this->register('nether-1', 255, 15, 255, 15000, 15000, -15000, -15000);
        $this->register('nether-2', 255, 20, 255, 25000, 25000, -25000, -25000);
        $this->register('nether-3', 255, 20, 255, 45000, 45000, -45000, -45000);
        #end
        $this->register('end-1', 120, 200, 130, 1000, 1000, -1000, -1000);
        $this->register('end-2', 120, 200, 130, 1000, 1000, -1000, -1000);
        $this->register('end-3', 120, 200, 130, 1000, 1000, -1000, -1000);
        #resource
        $this->register('resource', 51, 30, 65, 96, 260, 260, 423);
        #生活ワールド
        $this->register('生物市-c', 51, 10, 120, 410, 412, 198, 200);
        $this->register('船橋市-c', 255, 10, 255, 497, 497, -498, -498);
        $this->register('名古屋市-c', 250, 50, 250, 8000, 8000, -8000, -8000);
        $this->register('横浜市-c', 250, 50, 250, 500, 498, 12, 10);
        #農業ワールド
        $this->register('浜松市-f', 15, 20, 50, 555, 555, 251, 251);
        $this->register('八街市-f', 255, 80, 90, 822, 321, 257, -334);
    }

    public function register(string $worldName, int $heightLimit, int $miningLevelLimit, ?int $flyLimit = 300, ?int $x1 = 15000, ?int $z1 = 15000, ?int $x2 = -15000, ?int $z2 = -15000) : void {
        if (Server::getInstance()->getWorldManager()->getWorldByName($worldName) === null) {
            Server::getInstance()->getLogger()->error('WorldManagementAPI: World ' . $worldName . ' not found.');
        }
        $this->heightLimit[$worldName] = $heightLimit;
        $this->miningLevelLimit[$worldName] = $miningLevelLimit;
        $this->flyLimit[$worldName] = $flyLimit;
        $this->x1[$worldName] = $x1;
        $this->x2[$worldName] = $x2;
        $this->z1[$worldName] = $z1;
        $this->z2[$worldName] = $z2;
    }

    public function getHeightLimit(string $worldFolderName) : int {
        if (array_key_exists($worldFolderName, $this->heightLimit)) {
            return $this->heightLimit[$worldFolderName];
        }
        return 255;
    }

    public function getMiningLevelLimit(string $worldFolderName) : int {
        if (array_key_exists($worldFolderName, $this->miningLevelLimit)) {
            return $this->miningLevelLimit[$worldFolderName];
        }
        return 0;
    }

    public function getFlyLimit(string $worldFolderName) : int {
        if (array_key_exists($worldFolderName, $this->flyLimit)) {
            return $this->flyLimit[$worldFolderName];
        }
        return 300;
    }

    public function getWorldLimitX_1(string $worldFolderName) : int {
        if (array_key_exists($worldFolderName, $this->x1)) {
            return $this->x1[$worldFolderName];
        }
        return 15000;
    }

    public function getWorldLimitX_2(string $worldFolderName) : int {
        if (array_key_exists($worldFolderName, $this->x2)) {
            return $this->x2[$worldFolderName];
        }
        return -15000;
    }

    public function getWorldLimitZ_1(string $worldFolderName) : int {
        if (array_key_exists($worldFolderName, $this->z1)) {
            return $this->z1[$worldFolderName];
        }
        return 15000;
    }

    public function getWorldLimitZ_2(string $worldFolderName) : int {
        if (array_key_exists($worldFolderName, $this->z2)) {
            return $this->z2[$worldFolderName];
        }
        return -15000;
    }

}
