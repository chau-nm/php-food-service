<?php

namespace app\exception;

use app\enum\HttpResponseCode;
use Throwable;

class BadRequestException extends AbstractException
{
    public function __construct(
        string $message = "",
        int $code = 0,
        ?Throwable $previous = null
    )
    {
        parent::__construct(
            $message,
            HttpResponseCode::BAD_REQUEST,
            $code,
            $previous
        );
    }
}