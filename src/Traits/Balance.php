<?php

namespace Electrum\Traits;

trait Balance
{
    protected float $confirmed = 0;

    protected float $unconfirmed = 0;

    public function getConfirmed(): float
    {
        return $this->confirmed;
    }

    public function setConfirmed(float $confirmed): static
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    public function getUnconfirmed(): float
    {
        return $this->unconfirmed;
    }

    public function setUnconfirmed(float $unconfirmed): static
    {
        $this->unconfirmed = $unconfirmed;

        return $this;
    }

    public function getTotal(): float
    {
        return $this->confirmed + $this->unconfirmed;
    }
}
