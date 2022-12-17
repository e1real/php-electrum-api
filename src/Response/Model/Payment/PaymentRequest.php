<?php

namespace Electrum\Response\Model\Payment;

use Electrum\Response\ResponseInterface;
use Electrum\Response\Hydrator\Payment\PaymentRequest as PaymentRequestHydrator;

class PaymentRequest implements ResponseInterface
{
    const STATUS_UNPAID = 'Pending';

    const STATUS_EXPIRED = 'Expired';

    /**
     * sent but not propagated
     */
    const STATUS_UNKNOWN = 'Unknown';

    const STATUS_PAID = 'Paid';

    private string $id = '';

    private string $status = '';

    private Amount|null $amount = null;

    private string $memo = '';

    private string $address = '';

    private string $uri = '';

    private int $expires = 0;

    private int $time = 0;

    private int|null $confirmations = null;

    public static function createFromArray(array $data): PaymentRequest
    {
        $amountHydrator = new \Electrum\Response\Hydrator\Payment\Amount();
        $amount = $amountHydrator->hydrate($data, new Amount());

        $paymentRequestHydrator = new PaymentRequestHydrator();

        return $paymentRequestHydrator->hydrate(
            array_merge(
                $data, [
                'amount' => $amount
            ]),
            new self
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAmount(): Amount|null
    {
        return $this->amount;
    }

    public function setAmount(Amount|null $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getMemo(): string
    {
        return $this->memo;
    }

    public function setMemo(string $memo): static
    {
        $this->memo = $memo;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $uri): static
    {
        $this->uri = $uri;

        return $this;
    }

    public function getExpires(): int
    {
        return $this->expires;
    }

    public function setExpires(int $expires): static
    {
        $this->expires = $expires;

        return $this;
    }

    public function getTime(): int
    {
        return $this->time;
    }

    public function setTime(int $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getConfirmations(): int
    {
        return $this->confirmations;
    }

    public function setConfirmations(int|null $confirmations): static
    {
        $this->confirmations = $confirmations;

        return $this;
    }

}
