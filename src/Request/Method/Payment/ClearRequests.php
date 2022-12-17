<?php

namespace Electrum\Request\Method\Payment;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;

class ClearRequests extends AbstractMethod implements MethodInterface
{

    private string $method = 'clearrequests';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): bool
    {
        $this->getClient()->execute($this->method, $optional);

        // Electrum just returns a NULL, so we will never know if we succeeded
        return true;
    }
}
