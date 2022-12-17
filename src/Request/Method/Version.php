<?php

namespace Electrum\Request\Method;

use Electrum\Request\AbstractMethod;
use Electrum\Request\Exception\BadRequestException;
use Electrum\Request\MethodInterface;
use Electrum\Response\Exception\BadResponseException;
use Electrum\Response\Model\Version as VersionResponse;

class Version extends AbstractMethod implements MethodInterface
{

    private string $method = 'version';


    /**
     * @throws BadRequestException
     * @throws BadResponseException
     */
    public function execute(array $optional = []): mixed
    {
        $data = $this->getClient()->execute($this->method, $optional);
        if(is_string($data)) {
            $version = new VersionResponse();
            $version->setVersion($data);

            return $version;
        }

        return $this->hydrate(new VersionResponse(), $data);
    }
}
