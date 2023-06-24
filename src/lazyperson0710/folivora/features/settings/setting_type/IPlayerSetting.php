<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\settings\setting_type;

interface IPlayerSetting {

    /**
     * 設定の名前を取得します。
     * 表記上の名前として利用してください。
     *
     * @return string
     */
    public function getName(): string;

    /***
     * defaultの値を取得します。
     *
     * @return mixed
     */
    public function getDefaultValue(): mixed;

    /**
     * @return array
     * @see SettingFoundation::checkSettingData() で使用します。
     */
    public function normalValue(): array;
}