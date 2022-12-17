<?php

namespace Electrum\Response\Model\Wallet;

use Electrum\Response\ResponseInterface;
use Electrum\Traits\Balance as BalanceTrait;

class Balance implements ResponseInterface
{
    use BalanceTrait;
}
