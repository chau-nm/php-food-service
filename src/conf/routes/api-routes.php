<?php

use app\enum\HttpMethod;

return [
    [
        "url" => "/health",
        "method" => HttpMethod::GET,
        "controller" => "HealthController::index",
    ],
    [
        "url" => "/auth/login",
        "method" => HttpMethod::POST,
        "controller" => "AuthController::login",
    ],
    [
        "url" => "/auth/register",
        "method" => HttpMethod::POST,
        "controller" => "AuthController::register",
    ],
    [
        "url" => "/auth/logout",
        "method" => HttpMethod::POST,
        "controller" => "AuthController::logout",
    ],
];