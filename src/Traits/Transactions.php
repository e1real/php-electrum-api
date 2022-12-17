<?php

namespace Electrum\Traits;

/**
 * Trait Transactions
 * @package Electrum\Response\Traits
 */
trait Transactions
{
    protected array $transactions = [];

    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function setTransactions(array $transactions): static
    {
        $this->transactions = $transactions;

        return $this;
    }
}
