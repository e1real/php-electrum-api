<?php

namespace Electrum\Response\Model\Payment;

class Amount
{
    private float $bitcoins = 0;

    private float $litecoins = 0;

    private int|float $satoshis = 0;

    public function getBitcoins(): float
    {
        return $this->bitcoins;
    }

    public function setBitcoins(float $bitcoins): static
    {
        $this->bitcoins = $bitcoins;

        return $this;
    }

    public function getLitecoins(): float
    {
        return $this->litecoins;
    }

    public function setLitecoins(float $litecoins): static
    {
        $this->litecoins = $litecoins;

        return $this;
    }

    public function getSatoshis(): int|float
    {
        return $this->satoshis;
    }

    public function setSatoshis(int|float $satoshis): static
    {
        $this->satoshis = $satoshis;

        return $this;
    }
}
