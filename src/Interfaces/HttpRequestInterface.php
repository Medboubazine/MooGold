<?php

namespace Medboubazine\Moogold\Interfaces;

interface HttpRequestInterface
{
    public function handle(array $args = []): ?ElementsInterface;
}
