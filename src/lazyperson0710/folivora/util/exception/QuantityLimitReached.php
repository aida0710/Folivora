<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\exception;

use RuntimeException;

class QuantityLimitReached extends RuntimeException {

    /**
     * 基本的にこちらの定数を利用してください。
     */
    public const MESSAGE = '64bit整数の最大値を超えたためサーバーを停止しました';

}