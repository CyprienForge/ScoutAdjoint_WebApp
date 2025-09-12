<?php

namespace Application\Command\EditGlobalInfosMatch;

use Domain\Response\EditGlobalInfosMatch\EditGlobalInfosMatchResponse;

interface EditGlobalInfosMatchOutputBoundary
{
    public function present(EditGlobalInfosMatchResponse $response);
}
