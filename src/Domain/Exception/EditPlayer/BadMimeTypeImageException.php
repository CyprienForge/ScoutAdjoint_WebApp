<?php

namespace Domain\Exception\EditPlayer;

use Domain\Exception\DomainException;

class BadMimeTypeImageException extends DomainException
{

    public function __construct(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

}
