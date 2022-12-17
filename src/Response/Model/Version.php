<?php

namespace Electrum\Response\Model;

use Electrum\Response\ResponseInterface;

class Version implements ResponseInterface
{

    protected string $version = '';

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): static
    {
        $this->version = $version;

        return $this;
    }
}
