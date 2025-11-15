<?php

namespace Infrastructure\Service\Symfony;

use Domain\Service\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class SymfonySerializer implements Serializer
{
    public function __construct(
        private SerializerInterface $serializer
    ){}
    public function serialize($object) : string
    {
        return $this->serializer->serialize($object, 'json');
    }
}
