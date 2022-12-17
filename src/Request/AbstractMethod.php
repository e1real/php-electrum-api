<?php

namespace Electrum\Request;

use Electrum\Client;
use Electrum\Response\ResponseInterface;
use Laminas\Hydrator\ReflectionHydrator;

abstract class AbstractMethod
{

    private string $method = '';

    private array $params = [];

    private Client|null $client = null;

    public function __construct(Client $client = null)
    {
        if($client instanceof Client) {
            $this->setClient($client);
        } else {
            $this->setClient(new Client());
        }
    }

    public function hydrate(ResponseInterface $object, array $data, ReflectionHydrator|null $hydrator = null): ResponseInterface
    {
        if(!$hydrator instanceof ReflectionHydrator) {
            $hydrator = new ReflectionHydrator();
        }

        return $hydrator->hydrate(
            $data,
            $object
        );
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): static
    {
        $this->client = $client;

        return $this;
    }

}
