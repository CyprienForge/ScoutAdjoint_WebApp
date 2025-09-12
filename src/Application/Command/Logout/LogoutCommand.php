<?php

namespace Application\Command\Logout;

use Domain\Request\Logout\LogoutRequest;
use Domain\Response\Logout\LogoutResponse;
use Domain\Service\Logout\LogoutService;

class LogoutCommand
{
    public function __construct(
        private LogoutService $logoutService
    ){}

    public function execute(LogoutRequest $request): LogoutResponse
    {
        $this->logoutService->logout();
        return new LogoutResponse();
    }
}
