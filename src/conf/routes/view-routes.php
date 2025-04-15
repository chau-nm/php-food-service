<?php

use app\enum\HttpMethod;

return [
    [
        "url" => "/",
        "method" => HttpMethod::GET,
        "controller" => "HomeController::view",
    ]
];