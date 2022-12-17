<?php
declare(strict_types=1);

namespace Electrum\Request\Method;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;
use Electrum\Response\Model\Address\IsMine as IsMineResponse;
use Electrum\Response\ResponseInterface;
use Electrum\Traits\Address;

class IsAddressMine extends AbstractMethod implements MethodInterface
{
    use Address;

    private string $method = 'ismine';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): ResponseInterface
    {
        $data = $this->getClient()->execute($this->method, array_merge($optional, [
            'address' => $this->getAddress(),
        ]));

        return $this->hydrate(new IsMineResponse(), $data);
    }
}
