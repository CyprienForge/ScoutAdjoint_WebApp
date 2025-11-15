<?php

namespace Domain\Service;

interface Serializer
{

    public function serialize($object) : string;

}
