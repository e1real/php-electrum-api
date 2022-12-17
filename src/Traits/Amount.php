<?php
declare(strict_types=1);

namespace Electrum\Traits;

trait Amount
{
    private float|string $amount = 0;

    public function getAmount(): float|string
    {
        return $this->amount;
    }

    public function setAmount(float|string $amount): static
    {
        $this->amount = $amount;

        return $this;
    }
}
