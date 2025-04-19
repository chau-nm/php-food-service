<?php

use app\enum\HttpMethod;

return [
    [
        "url" => "/health",
        "method" => HttpMethod::GET,
        "controller" => "HealthController::index",
    ],
];