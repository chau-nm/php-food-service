<?php

namespace app\controller;

use app\model\response\Response;

class HealthController
{
    public function index(): Response
    {
        return new Response("OK");
    }
}