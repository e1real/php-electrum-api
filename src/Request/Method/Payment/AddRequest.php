<?php
declare(strict_types=1);

namespace Electrum\Request\Method\Payment;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;
use Electrum\Response\Model\Payment\PaymentRequest;
use Electrum\Response\Model\Payment\PaymentRequest as PaymentRequestResponse;
use Electrum\Traits\Amount;
use Electrum\Traits\Memo;

class AddRequest extends AbstractMethod implements MethodInterface
{
    use Amount;
    use Memo;

    private string $method = 'add_request';

    private $expiration = null;

    private bool $force = false;


    public function getExpiration()
    {
        return $this->expiration;
    }

    public function setExpiration(mixed $expiration): static
    {
        $this->expiration = $expiration;

        return $this;
    }

    public function isForced(): bool
    {
        return $this->force;
    }

    public function setForced(bool $force): static
    {
        $this->force = $force;

        return $this;
    }

    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): PaymentRequestResponse|null
    {
        $params = [
            'amount' => $this->getAmount(),
            'force' => $this->isForced(),
        ];

        if($this->getMemo() !== null) {
            $params['memo'] = $this->getMemo();
        }

        if($this->getExpiration()) {
            $params['expiration'] = $this->getExpiration();
        }

        $data = $this->getClient()->execute($this->method, array_merge($optional, $params));

        // Just return null when no unused addresses are available
        if($data === false) {
            return null;
        }

        return PaymentRequest::createFromArray($data);
    }
}
