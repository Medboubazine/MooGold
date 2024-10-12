<?php

namespace Medboubazine\Moogold\Abstracts;

use Medboubazine\Moogold\Auth\Credentials;

abstract class ApiAbstract
{
    /**
     * Credentials
     *
     * @var Credentials
     */
    protected Credentials $credentials;
    /**
     * Constructor
     *
     * @param [type] $credentials
     */
    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }
}
