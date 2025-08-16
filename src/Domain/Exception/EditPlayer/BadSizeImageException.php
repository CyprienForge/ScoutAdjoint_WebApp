<?php

namespace Domain\Exception\EditPlayer;

use Domain\Exception\DomainException;

class BadSizeImageException extends DomainException
{

    public function __construct(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

}
