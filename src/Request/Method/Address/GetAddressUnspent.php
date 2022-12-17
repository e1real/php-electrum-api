<?php
declare(strict_types=1);

namespace Electrum\Request\Method\Address;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;
use Electrum\Response\Model\Address\Unspent as UnspentResponse;
use Electrum\Response\ResponseInterface;
use Electrum\Traits\Address;

class GetAddressUnspent extends AbstractMethod implements MethodInterface
{
    use Address;

    private string $method = 'getaddressunspent';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): ResponseInterface
    {
        $data = $this->getClient()->execute($this->method, array_merge($optional, [
            'address' => $this->getAddress(),
        ]));

        return $this->hydrate(new UnspentResponse(), $data);
    }
}
