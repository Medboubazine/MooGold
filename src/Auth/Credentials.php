<?php

namespace Medboubazine\Moogold\Auth;

class Credentials
{
    /**
     * Credentials
     *
     * @param string $user_id
     * @param string $partner_id
     * @param string $secret_key
     */
    public function __construct(
        public string $user_id,
        public string $partner_id,
        public string $secret_key,

    ) {}
}
