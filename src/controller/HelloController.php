<?php

namespace app\controller;

use app\enum\HttpResponseCode;
use app\model\framework\AbstractController;
use app\model\request\Request;
use app\model\response\ErrorResponse;
use app\model\response\Response;
use app\model\response\ViewResponse;

class HelloController extends AbstractController
{
    public function sayHello(Request $request): ViewResponse
    {
        $response = new ErrorResponse("aaaaa");
        return $this->render("hello", [
            "rp" => $response
        ]);
    }
}