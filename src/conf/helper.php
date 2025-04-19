<?php

/**
 * Get env from .env file and os
 *
 * @param string $key
 * @return string|null
 */
function env(string $key): string|null
{
    if (isset($_ENV[$key])) {
        return $_ENV[$key];
    } else if (isset($_SERVER[$key])) {
        return $_SERVER[$key];
    }
    return null;
}