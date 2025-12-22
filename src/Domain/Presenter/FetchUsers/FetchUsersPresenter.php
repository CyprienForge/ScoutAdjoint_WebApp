<?php

namespace Domain\Presenter\FetchUsers;

use Domain\Response\FetchUsers\FetchUsersResponse;

interface FetchUsersPresenter
{

    public function present(FetchUsersResponse $response);
    public function getPresentation();

}
