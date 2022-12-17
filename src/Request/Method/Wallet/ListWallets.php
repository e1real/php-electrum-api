<?php


namespace Electrum\Request\Method\Wallet;


use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;

class ListWallets extends AbstractMethod implements MethodInterface
{

    private string $method = 'list_wallets';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(): mixed
    {
        return $this->getClient()->execute($this->method);
    }
}
