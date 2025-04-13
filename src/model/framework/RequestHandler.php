<?php

namespace app\model\framework;

use app\model\request\Request;
use app\model\response\Response;
use app\request_handler\AuthHandle;

class RequestHandler
{
    public static function handle(Request $request): Request|Response
    {
        $authHandled = AuthHandle::handle($request);
        if ($authHandled instanceof Response) {
            return $authHandled;
        }
        return $request;
    }
}