<?php

namespace app\model\framework;

use app\model\request\Request;
use app\model\response\Response;

class RequestHandler
{
    public static function handle(Request $request): Request|Response
    {
        return $request;
    }
}