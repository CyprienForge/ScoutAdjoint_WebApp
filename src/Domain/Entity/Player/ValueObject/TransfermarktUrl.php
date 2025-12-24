<?php

namespace Domain\Entity\Player\ValueObject;

use Domain\Exception\Entity\Player\InvalidTransfermarktUrlException;

class TransfermarktUrl
{

    public function __construct(
        private ?string $url = ""
    ){
        if (!filter_var($url, FILTER_VALIDATE_URL) && $url !== "" && $url !== null) {
            throw new InvalidTransfermarktUrlException('Invalid Transfermarkt URL');
        }
    }

    public function value() : string
    {
        return $this->url;
    }

    public function withUrl(string $url) : TransfermarktUrl
    {
        return new TransfermarktUrl($url);
    }
}
