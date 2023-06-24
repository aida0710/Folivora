<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\secret_commnad;

class CommandsList {

    public const DISABLE = [
        'ban',
        'ban-ip',
        'banlist',
        'defaultgamemode',
        'difficulty',
        'extraactplugin',
        'genplugin',
        'pardon',
        'pardon-ip',
        'pkreload',
        'save-off',
        'seed',
        'title',
        'transferserver',
        'unban',
        'unban-ip',
        ## CSkull
        'showskulls',
        'showheads',
        ## EconomyAPI
        'mymoney',
        'mystatus',
        'setlang',
        'topmoney',
        ## InvSee
        'invseegrant',
        'invseereq',
        ## Others
    ];

    public const OP_ONLY = [
        ##DefaultCommand
        'about',
        'checkperm',
        'clear',
        'kill',
        'suicide',
        'ver',
        'version',
        ##WorldWarpSystem
        'wtp',
        ##InvSee
        'invsee',
        'enderinvsee',
        ##MiningLevelAPI
        'level',
        ##MultiWorld
        'multiworld',
        'mw',
        ##EconomyAPI
        'seemoney',
        ##XP
        'xp',
        ##WorldEdit
        '/bi',
        '/blockinfo',
        '/pos1',
        '/pos2',
        '/extend',
        '/set',
        '/replace',
        '/naturalize',
        '/smooth',
        '/center',
        '/walls',
        '/sides',
        '/move',
        '/stack',
        '/istack',
        '/count',
        '/extinguish',
        '/undo',
        '/redo',
        '/copy',
        '/cut',
        '/paste',
        '/insert',
        '/rotate',
        '/flip',
        '/loadschematic',
        '/saveschematic',
        '/sphere',
        '/hsphere',
        '/cylinder',
        '/hcylinder',
        '/noise',
        '/brush',
        '/status',
        '/cancel',
        '/benchmark',
        '/builderrod',
        '/builderwand',
        '/cmd',
        '/commands',
        '/drain',
        '/fill',
        '/h',
        '/line',
        '/overlay',
        '/pastestates',
        '/rod',
        '/show',
        '/view',
        '/wand',
    ];

    public const SECRET = [
        ##LockSystem
        'lockc',
        'lockfr',
        'unlockfr',
        ##PassSystem
        'pass',
        ##EditEnchant
        'endelete',
        'enreduce',
        ##WarpSystem
        'warp',
    ];

}