<?php

use app\enum\HttpMethod;

return [
    [
        "url" => "/health",
        "method" => HttpMethod::GET,
        "controller" => "HealthController::index",
    ],
    [
        "url" => "/api/auth/login",
        "method" => HttpMethod::POST,
        "controller" => "AuthController::login",
    ],
    [
        "url" => "/api/auth/register",
        "method" => HttpMethod::POST,
        "controller" => "AuthController::register",
    ],
    [
        "url" => "/api/auth/logout",
        "method" => HttpMethod::POST,
        "controller" => "AuthController::logout",
    ],
    [
        "url" => "/api/food",
        "method" => HttpMethod::GET,
        "controller" => "ProductController::list",
    ],
    [
        "url" => "/api/cart/add",
        "method" => HttpMethod::POST,
        "controller" => "CartController::add",
    ],
    [
        "url" => "/api/cart/update",
        "method" => HttpMethod::POST,
        "controller" => "CartController::update",
    ],
    [
        "url" => "/api/cart/remove",
        "method" => HttpMethod::POST,
        "controller" => "CartController::remove",
    ],
];
