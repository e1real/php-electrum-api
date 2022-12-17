<?php

namespace Electrum\Response\Model\Address;

use Electrum\Response\ResponseInterface;

class IsMine implements ResponseInterface
{

    private bool $isMine = false;

    public function isMine(): bool
    {
        return $this->isMine;
    }

    public function setIsMine(bool $isMine): static
    {
        $this->isMine = $isMine;

        return $this;
    }

}
