<?php

namespace Infrastructure\Symfony\Twig;

use Infrastructure\Symfony\ViewModel\GlobalViewModelProvider;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class GlobalViewModelExtension extends AbstractExtension
{
    public function __construct(private GlobalViewModelProvider $provider) {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('global_vm', fn() => $this->provider->getGlobalViewModel())
        ];
    }
}
