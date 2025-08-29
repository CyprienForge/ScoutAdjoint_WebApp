<?php

namespace Domain\UseCase\EditGlobalInfosMatch;

use Domain\Response\EditGlobalInfosMatch\EditGlobalInfosMatchResponse;

interface EditGlobalInfosMatchOutputBoundary
{
    public function present(EditGlobalInfosMatchResponse $response);
}
