<?php

namespace Domain\UseCase\FetchUsers;

use Domain\Response\FetchUsers\FetchUsersResponse;

interface FetchUsersOutputBoundary
{

    public function present(FetchUsersResponse $response);
    public function getViewModel();

}
