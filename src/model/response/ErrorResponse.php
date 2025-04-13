<?php

namespace app\model\response;

use app\model\serializable\AbstractSerializable;

class ErrorResponse extends AbstractSerializable
{
    private string $message;
    private string $isError;

    public function __construct(
        string $message,
        bool   $isError = true,
    )
    {
        $this->message = $message;
        $this->isError = $isError;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;
        return $this;
    }

    public function isError(): bool
    {
        return $this->isError;
    }

    public function setError(bool $isError): static
    {
        $this->isError = $isError;
        return $this;
    }
}