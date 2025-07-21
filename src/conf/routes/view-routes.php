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
    ],
    [
        "url" => "/login",
        "method" => HttpMethod::GET,
        "controller" => "LoginController::view",
    ],
    [
        "url" => "/signup",
        "method" => HttpMethod::GET,
        "controller" => "SignupController::view",
    ],
    [
        "url" => "/about",
        "method" => HttpMethod::GET,
        "controller" => "AboutController::view",
    ]
];
