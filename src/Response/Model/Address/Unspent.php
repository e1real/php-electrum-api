<?php

namespace Electrum\Response\Model\Address;

use Electrum\Response\ResponseInterface;

class Unspent implements ResponseInterface
{

    private array $utx = [];

    public function getUtx(): array
    {
        return $this->utx;
    }

    public function setUtx(array $utx): static
    {
        $this->utx = $utx;

        return $this;
    }

}
