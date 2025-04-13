<?php

namespace app\model\framework;

use app\model\response\ViewResponse;

abstract class AbstractController
{
    protected function render(string $view, array $data = []): ViewResponse
    {
        return new ViewResponse($view, $data);
    }
}