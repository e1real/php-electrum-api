<?php
declare(strict_types=1);

namespace Electrum\Request\Method\Address;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;
use Electrum\Response\Model\Address\History as HistoryResponse;
use Electrum\Response\ResponseInterface;
use Electrum\Traits\Address;

class GetAddressHistory extends AbstractMethod implements MethodInterface
{
    use Address;

    private string $method = 'getaddresshistory';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): ResponseInterface
    {
        $data = $this->getClient()->execute($this->method, array_merge($optional, [
            'address' => $this->getAddress(),
        ]));

        return $this->hydrate(new HistoryResponse(), $data);
    }
}
