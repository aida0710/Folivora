<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\config\exception;

use RuntimeException;

class ConfigDataPathNotSetException extends RuntimeException {

    public const MESSAGE = 'ConfigDataPathが設定されていません';
}