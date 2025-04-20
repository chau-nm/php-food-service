<?php

namespace app\model\request;

class Request 
{
    public function getURL(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getHeaders()
    {
        return getallheaders();
    }

    public function getContent()
    {
        return file_get_contents('php://input');
    }

    public function getParams(): array
    {
        return $_GET;
    }

    public function getPost(): array
    {
        return $_POST;
    }
}