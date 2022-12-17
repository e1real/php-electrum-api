<?php

namespace Electrum\Request\Method\Payment;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;
use Electrum\Traits\Address;

class RemoveRequest extends AbstractMethod implements MethodInterface
{

    use Address;

    private string $method = 'rmrequest';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): bool
    {
        return $this->getClient()->execute($this->method,
            array_merge(
                [
                    'address' => $this->getAddress()
                ],
                $optional
            )
        );
    }
}
