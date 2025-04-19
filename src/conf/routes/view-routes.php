<?php

use app\enum\HttpMethod;

return [
    [
        "url" => "/",
        "method" => HttpMethod::GET,
        "controller" => "HomeController::view",
    ],
    [
        "url" => "/cart",
        "method" => HttpMethod::GET,
        "controller" => "CartController::view",
    ],
    [
        "url" => "/product",
        "method" => HttpMethod::GET,
        "controller" => "ProductController::view",
    ]
];