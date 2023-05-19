<?php

namespace lazyperson0710\folivora\features\settings;

use pocketmine\player\Player;

interface IPlayerSetting {

    /**
     * 設定の名前を取得します。
     * 表記上の名前として利用してください。
     *
     * @return string
     */
    public function getName() : string;

    /***
     * defaultの値を取得します。
     *
     * @return mixed
     */
    public function getDefaultValue() : mixed;

    /**
     * 値を変更する際に実行してください。
     *
     * @param Player $player
     * @param mixed $value
     * @return void
     */
    public function setValue(Player $player, mixed $value) : void;

    /**
     * setValueの前に実行してください。
     *
     * @param mixed $value
     * @return bool
     */
    public function checkValue(mixed $value) : bool;
}