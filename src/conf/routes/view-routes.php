<?php

use app\enum\HttpMethod;

return [
    [
        "url" => "/hello",
        "method" => HttpMethod::GET,
        "controller" => "HelloController::sayHello",
    ]
];