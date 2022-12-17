<?php

namespace Electrum\Request\Method\Wallet;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Model\Wallet\Transaction;
use Electrum\Response\Exception\BadResponseException;

class GetHistory extends AbstractMethod implements MethodInterface
{

    private string $method = 'history';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): array
    {
        $data = $this->getClient()->execute($this->method, $optional);
        if (!is_array($data)) {
            $data = json_decode($data, true);
            if (isset($data['transactions'])) {
                $data = $data['transactions'];
            } else {
                throw new BadResponseException('Cannot get history');
            }
        }
        $transactions = [];
        foreach ($data as $transaction) {
            $transactions[] = $this->hydrate(new Transaction(), $transaction);
        }
        return $transactions;
    }
}
