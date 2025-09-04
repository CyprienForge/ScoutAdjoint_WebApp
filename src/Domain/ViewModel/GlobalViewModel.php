<?php

namespace Domain\ViewModel;

class GlobalViewModel
{
    public function __construct(
        public bool $isAuthenticated,
        public ?string $identifier
    ){}
}
