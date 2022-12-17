<?php

namespace Electrum\Response\Model\Address;

use Electrum\Response\ResponseInterface;
use Electrum\Traits\Balance;
use Electrum\Traits\Transactions;

class History implements ResponseInterface
{
    use Balance;
    use Transactions;
}
