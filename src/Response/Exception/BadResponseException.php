<?php

namespace Electrum\Response\Exception;

use Exception;

class BadResponseException extends Exception
{
    public static function createFromElectrumResponse(array $response): self
    {
        $message = '';
        $code = 0;

        if (isset($response['error']['message'])) {
            $message = vsprintf(
                'Electrum API returned error: `%s`',
                $response['error']['message']
            );
        }

        if (isset($response['error']['code'])) {
            $code = $response['error']['code'];
        }

        return new self($message, $code);
    }
}
