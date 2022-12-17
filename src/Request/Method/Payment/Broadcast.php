<?php

namespace Electrum\Request\Method\Payment;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;
use Electrum\Response\Model\Payment\PaymentRequest;

class Broadcast extends AbstractMethod implements MethodInterface
{

    private string $method = 'broadcast';

    private string $transaction = '';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): mixed
    {
        $data = $this->getClient()->execute($this->method, array_merge([
            'tx' => $this->getTransaction()
        ], $optional));

        return is_array($data) && isset($data[1]) ? $data[1] : $data;
    }

    public function getTransaction(): string
    {
        return $this->transaction;
    }

    public function setTransaction(string $transaction): static
    {
        $this->transaction = $transaction;

        return $this;
    }

}
