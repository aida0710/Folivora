<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\exception;

use RuntimeException;

class AbnormalValueEnteredException extends RuntimeException {

    public const MESSAGE = '異常値が入力されました';

}