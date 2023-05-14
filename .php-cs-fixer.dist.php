<?php

declare(strict_types = 1);
include_once __DIR__ . '/vendor/autoload.php';
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__);
return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        //declare(strict_types = 1);の付け忘れを防止するためだけに存在してます・・・。
        'declare_strict_types' => true,
    ])
    ->setFinder($finder);