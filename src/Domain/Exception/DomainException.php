<?php

namespace Domain\Exception;

class DomainException extends \Exception
{
    protected string $errorMessage;

    public function __construct(string $errorMessage)
    {
        parent::__construct($errorMessage);
        $this->errorMessage = $errorMessage;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

}
