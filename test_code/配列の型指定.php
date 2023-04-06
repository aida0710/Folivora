<?php

/**
 * @return array<class-string<\pocketmine\item\Item>, array<int, string>>
 */
function getStrList() : array {
	return [
		\pocketmine\item\Item::class => [
			"bbb",
			"ccc",
		],
	];
}

class Hoge {

	static function bar() : void {
		echo "kasu";
	}
}

$a = Hoge::class;
$a::bar();
$fn = function (?\pocketmine\plugin\Plugin $plugin = null) : void {
	static $loadedPlugin = null;
	$loadedPlugin ??= $plugin;
	echo $plugin->getDataFolder();
};
$fn(new \pmmp\TesterPlugin\Main()); // plugin_data/Folivora
$fn(); // plugin_data/Folivora
$task->register($fn);