<?php

return [
    "dsn" => "mysql:host=" . env("DB_HOST") . ";port=" . env("DB_PORT") . ";dbname=" . env("DB_DATABASE") . ";charset=" . env("DB_CHARSET"),
    "username" => env("DB_USERNAME"),
    "password" => env("DB_PASSWORD"),
];