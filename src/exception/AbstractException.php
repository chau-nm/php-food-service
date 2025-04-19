<?php

namespace app\exception;

use app\enum\HttpResponseCode;
use Throwable;

class AbstractException extends \Exception
{

    protected int $httpCode;

    public function __construct(
        string    $message = "",
        int $httpCode = HttpResponseCode::INTERNAL_SERVER_ERROR,
        int       $code = 0,
        Throwable $previous = null
    )
    {
        $this->httpCode = $httpCode;
        parent::__construct($message, $code, $previous);
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    public function setHttpCode(int $httpCode): static
    {
        $this->httpCode = $httpCode;
        return $this;
    }
}