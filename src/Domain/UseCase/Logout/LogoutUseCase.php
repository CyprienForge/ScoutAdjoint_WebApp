<?php

namespace Domain\UseCase\Logout;

use Domain\Request\Logout\LogoutRequest;
use Domain\Response\Logout\LogoutResponse;
use Domain\Service\Logout\LogoutService;

class LogoutUseCase
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
