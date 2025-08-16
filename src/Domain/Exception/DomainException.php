<?php

namespace Domain\Exception;

class DomainException extends \Exception
{
    protected string $errorMessage;

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

}
