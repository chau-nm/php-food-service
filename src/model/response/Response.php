<?php

namespace app\model\response;

use app\model\serializable\AbstractSerializable;

class Response extends AbstractSerializable
{
    public function __construct(
        private mixed $content,
        private int $status = 200,
        private array $headers = [],
    )
    {

    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): static
    {
        $this->headers = $headers;
        return $this;
    }

    public function getContent(): mixed
    {
        return $this->content;
    }

    public function setContent(mixed $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;
        return $this;
    }
}