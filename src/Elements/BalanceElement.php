<?php

namespace Medboubazine\Moogold\Elements;

use Medboubazine\Moogold\Abstracts\ElementsAbstract;
use Medboubazine\Moogold\Interfaces\ElementsInterface;

class BalanceElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $amount,
        string $currency
    ) {
        $this->setAmount($amount);
        $this->setCurrency($currency);
    }
}
