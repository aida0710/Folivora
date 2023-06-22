<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\command;

interface ISubCommand {

    /**
     * @return void
     */
    public function execute(): void;

}