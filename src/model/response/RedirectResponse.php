<?php

namespace app\model\response;

class RedirectResponse
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function redirect(): void
    {
        header("Location: $this->url");
        exit;
    }
}