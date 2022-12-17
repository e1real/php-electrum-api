<?php

namespace Electrum\Response\Model\Address;

use Electrum\Response\ResponseInterface;
use Electrum\Traits\Balance as BalanceTrait;

class Balance implements ResponseInterface
{
    use BalanceTrait;
}
