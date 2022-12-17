<?php

namespace Electrum\Request\Method\Wallet;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;
use Electrum\Response\Model\Wallet\Balance as BalanceResponse;
use Electrum\Response\ResponseInterface;

class GetBalance extends AbstractMethod implements MethodInterface
{

    private string $method = 'getbalance';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): ResponseInterface
    {
        $data = $this->getClient()->execute($this->method, $optional);
        return $this->hydrate(new BalanceResponse(), $data);
    }
}
