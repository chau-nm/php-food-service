<?php

namespace app\model\response;

use app\model\serializable\AbstractSerializable;

class JsonResponse extends AbstractSerializable
{
    private mixed $data;
    private int $status;
    private array $headers;

    public function __construct(mixed $data, int $status = 200, array $headers = [])
    {
        $this->data = $data;
        $this->status = $status;
        $this->headers = array_merge([
            'Content-Type' => 'application/json'
        ], $headers);
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function send(): void
    {
        http_response_code($this->status);

        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }

        echo json_encode($this->data, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
