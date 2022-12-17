<?php

namespace Electrum\Request\Method\Payment;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;
use Electrum\Response\Model\Payment\PaymentRequest;
use Electrum\Response\Model\Payment\PaymentRequest as PaymentRequestResponse;
use Electrum\Traits\Address;

class GetRequest extends AbstractMethod implements MethodInterface
{
    use Address;

    private string $method = 'getrequest';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): PaymentRequestResponse|null
    {
        try {

            // Yes, key instead of address. Because fuck consistency - Electrum Dev, 2016
            $data = $this->getClient()->execute($this->method, array_merge(['key' => $this->getAddress()], $optional));

        } catch(BadResponseException $exception) {

            if($exception->getCode() == -32603) {
                return null;
            } else {
                throw $exception;
            }

        }

        return PaymentRequest::createFromArray($data);
    }
}
