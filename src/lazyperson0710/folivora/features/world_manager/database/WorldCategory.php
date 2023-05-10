<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager\database;

class WorldCategory {

    public const PublicWorld = [
        'lobby',
        'tos',
        'athletic',
    ];

    public const PVP = [
        'pvp',
    ];

    public const PublicEventWorld = [
        'event-1',
        'event-2',
    ];

    public const ResourceWorld = [
        'resource',
    ];

    public const Nature = [
        'nature-1',
        'nature-2',
        'nature-3',
    ];

    public const MiningWorld = [
        'MiningWorld',
    ];

    public const Nether = [
        'nether-1',
        'nether-2',
        'nether-3',
    ];

    public const End = [
        'end-1',
        'end-2',
        'end-3',
    ];

    public const LifeWorld = [
        '生物市-c',
        '船橋市-c',
        '横浜市-c',
        '名古屋市-c',
    ];

    public const AgricultureWorld = [
        '浜松市-f',
        '八街市-f',
    ];

    public const UniqueAgricultureWorld = [
        '八街市-f',
    ];

    public const PublicWorldAll = [
        ...self::PublicWorld,
        ...self::PVP,
        ...self::PublicEventWorld,
    ];

    public const NatureAll = [
        ...self::Nature,
        ...self::Nether,
        ...self::End,
        ...self::MiningWorld,
    ];

    public const LifeWorldAll = [
        ...self::LifeWorld,
        ...self::AgricultureWorld,
    ];

}
