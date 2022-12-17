<?php

declare(strict_types=1);

namespace Electrum\Request\Method\Address;


use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;

class CreateNewAddress extends AbstractMethod implements MethodInterface
{

    private string $method = 'createnewaddress';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $attributes = []): mixed
    {
        return $this->getClient()->execute($this->method, $attributes);
    }
}
