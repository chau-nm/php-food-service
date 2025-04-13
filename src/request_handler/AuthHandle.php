<?php

namespace app\request_handler;

use app\model\request\Request;
use app\model\response\Response;

class AuthHandle
{
    public static function handle(Request $request): Request|Response {
        return $request;
    }
}