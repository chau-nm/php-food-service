<?php

namespace app\model\framework;

use app\model\response\Response;

class ResponseHandler
{
    public static function handle(Response $response): void
    {
        $header = $response->getHeaders();
        foreach ($header as $name => $value) {
            header("$name: $value");
        }
        http_response_code($response->getStatus());
        echo json_encode($response->getContent());
    }
}