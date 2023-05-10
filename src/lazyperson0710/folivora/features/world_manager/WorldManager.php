<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager;

use lazyperson0710\folivora\util\plugin_base\IPluginBase;
use lazyperson0710\folivora\util\register\RegisterListener;
use lazyperson0710\folivora\util\register\RegisterTaskScheduler;
use lazyperson0710\world_manager\blocks\FarmlandBlock;
use lazyperson0710\world_manager\command\WpCommand;
use lazyperson0710\world_manager\database\world_managerAPI;
use lazyperson0710\world_manager\EventListener\CancelItemUseEvent;
use lazyperson0710\world_manager\EventListener\PlayerDamageEvent;
use lazyperson0710\world_manager\EventListener\PlayerTeleportEvent;
use lazyperson0710\world_manager\EventListener\ResourceWorldProtect;
use lazyperson0710\world_manager\EventListener\StopHunger;
use lazyperson0710\world_manager\EventListener\WorldProtect;
use lazyperson0710\world_manager\EventListener\YachimataCityWorldProtect;
use lazyperson0710\world_manager\task\WorldLevelCheckTask;
use lazyperson0710\world_manager\task\WorldTimeScheduler;
use lazyperson0710\world_manager\WorldLimit\task\CheckLifeWorldTask;
use lazyperson0710\world_manager\WorldLimit\task\CheckPositionTask;
use lazyperson0710\world_manager\WorldLimit\WorldProperty;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\VanillaBlocks;
use pocketmine\Server;
use function is_dir;
use function scandir;

class WorldManager implements IPluginBase {

    public const CHECK_INTERVAL = 20;
    public const TELEPORT_INTERVAL = 15;

    public function onDisable(Server $server) : void {
    }

    public function onEnable(Server $server) : void {
        foreach (scandir('worlds/') as $value) {
            if (is_dir('worlds/' . $value) && ($value !== '.' && $value !== '..')) {
                Server::getInstance()->getWorldManager()->loadWorld($value, true);
            }
        }
        world_managerAPI::getInstance()->init();
        RegisterListener::register(new CancelItemUseEvent());
        RegisterListener::register(new PlayerDamageEvent());
        RegisterListener::register(new PlayerTeleportEvent());
        RegisterListener::register(new ResourceWorldProtect());
        RegisterListener::register(new StopHunger());
        RegisterListener::register(new WorldProtect());
        RegisterListener::register(new YachimataCityWorldProtect());
        BlockFactory::getInstance()->register(new FarmlandBlock(new BlockIdentifier(VanillaBlocks::FARMLAND()->getId(), 0), 'Farmland', new BlockBreakInfo(0.6, BlockToolType::SHOVEL)), true);
        $server->getCommandMap()->registerAll('world_manager', [
            new WpCommand(),
        ]);
        $worlds = [];
        $worldApi = world_managerAPI::getInstance();
        foreach (Server::getInstance()->getWorldManager()->getWorlds() as $world) {
            $world = $world->getFolderName();
            $worlds[] = new WorldProperty($world, $worldApi->getWorldLimitX_1($world), $worldApi->getWorldLimitX_2($world), $worldApi->getWorldLimitZ_1($world), $worldApi->getWorldLimitZ_2($world));
        }
        RegisterTaskScheduler::getScheduler()->scheduleDelayedTask(new WorldTimeScheduler(), 60);
        RegisterTaskScheduler::getScheduler()->scheduleRepeatingTask(new CheckPositionTask(RegisterTaskScheduler::getScheduler(), $worlds), self::CHECK_INTERVAL * 20);
        RegisterTaskScheduler::getScheduler()->scheduleRepeatingTask(new CheckLifeWorldTask($worlds), 60);
        RegisterTaskScheduler::getScheduler()->scheduleRepeatingTask(new WorldLevelCheckTask(), 60);
    }

}
