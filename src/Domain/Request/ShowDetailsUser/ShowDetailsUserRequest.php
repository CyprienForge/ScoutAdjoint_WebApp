<?php

namespace Domain\Request\ShowDetailsUser;

class ShowDetailsUserRequest
{

    public function __construct(
        public int $idUser
    ){}

}
