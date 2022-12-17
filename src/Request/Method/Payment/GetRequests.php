<?php

namespace Electrum\Request\Method\Payment;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;
use Electrum\Response\Model\Payment\PaymentRequest;

class GetRequests extends AbstractMethod implements MethodInterface
{

    private string $method = 'listrequests';

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): array
    {
        $data = $this->getClient()->execute($this->method, $optional);

        $requests = [];
        foreach($data as $request) {
            $requests[] = PaymentRequest::createFromArray($request);
        }

        return $requests;
    }
}
