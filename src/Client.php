<?php

namespace Electrum;

use Electrum\Request\Exception\BadRequestException;
use Electrum\Response\Exception\BadResponseException;

class Client
{
    private string $host = '';

    private int $port = 0;
    private string|null $rpcUsername = null;
    private string|null $rpcPassword = null;

    private int $id = 0;

    public function __construct(
        string $host = 'http://127.0.0.1',
        int $port = 7777,
        int $id = 0,
        string|null $rpcUsername = null,
        string|null $rpcPassword = null
    ) {
        $this->setHost($host);
        $this->setPort($port);
        $this->setId($id);
        $this->setRpcUsername($rpcUsername);
        $this->setRpcPassword($rpcPassword);
    }

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute($method, $params = [])
    {
        // Create request payload
        $request = $this->createRequest($method, $params);

        // Retrieve electrum api response
        $response = $this->executeCurlRequest($request);

        // Check if an error occured
        if(isset($response['error'])) {
            throw new BadResponseException($response);
        }

        return $response['result'];
    }

    private function createRequest(mixed $method, array $params): string
    {
        $request = json_encode([
            'method' => $method,
            'params' => $params,
            'id'     => $this->getNextId(),
        ]);

        return str_replace(['[{', '}]'], ['{', '}'], $request);
    }

    private function executeCurlRequest($request): mixed
    {
        // Create CURL instance
        $curl = curl_init(vsprintf(
            '%s:%s', [$this->getHost(), $this->getPort()]
        ));

        // Set some options we need
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $request,
        ]);

        // Authorization
        if ($this->getRpcUsername() && $this->getRpcPassword()) {
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_USERPWD, $this->getRpcUsername() . ":" . $this->getRpcPassword());
        }

        // Execute request & convert data to array
        $response = curl_exec($curl);

        // Catch error if occured
        $error = curl_error($curl);

        // Check if request was successfull
        if ($error) {

            // Set last error, so user can catch it
            throw new BadRequestException($error);
        }

        // Return Data converted to an array
        return json_decode($response, true);
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): static
    {
        $this->host = $host;

        return $this;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function setPort(int $port): static
    {
        $this->port = $port;

        return $this;
    }

    public function getRpcUsername(): string
    {
        return $this->rpcUsername;
    }

    public function setRpcUsername(string $rpcUsername): static
    {
        $this->rpcUsername = $rpcUsername;

        return $this;
    }

    public function getRpcPassword(): string
    {
        return $this->rpcPassword;
    }

    public function setRpcPassword(string $rpcPassword): static
    {
        $this->rpcPassword = $rpcPassword;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNextId(): int
    {
        return $this->id++;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }
}
