<?php

namespace Electrum\Request\Method\Wallet;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;

class CreateWallet extends AbstractMethod implements MethodInterface
{

    private string $method = 'create';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $attributes = []): mixed
    {
        return $this->getClient()->execute($this->method, $attributes);
    }
}
