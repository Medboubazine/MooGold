<?php

namespace Medboubazine\Moogold\Interfaces;

use Medboubazine\Moogold\Auth\Credentials;

interface HttpRequestInterface
{
    public function __construct(Credentials $credentials);
}
