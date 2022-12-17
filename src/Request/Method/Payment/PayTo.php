<?php

namespace Electrum\Request\Method\Payment;

use Electrum\Client;
use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;
use Electrum\Traits\Amount;

class PayTo extends AbstractMethod implements MethodInterface
{
    use Amount;

    private string $method = 'payto';

    private string $destination = '';

    public function __construct(Client $client = null)
    {
        parent::__construct($client);

        $this->amount = '!';
    }

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): mixed
    {
        return $this->getClient()->execute($this->method, array_merge([
            'destination' => $this->getDestination(),
            'amount'      => $this->getAmount()
        ], $optional));
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function setDestination($destination): static
    {
        $this->destination = $destination;

        return $this;
    }

}
