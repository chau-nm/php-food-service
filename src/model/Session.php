<?php

namespace app\model;

class Session
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance(): Session
    {
        if (!isset(self::$instance)) {
            self::$instance = new Session();
        }
        return self::$instance;
    }

    public function set(string $key, $value): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null): ?string
    {
        if (session_status() == PHP_SESSION_NONE) {
            return null;
        }
        return $_SESSION[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function delete(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function destroy(): void
    {
        $_SESSION = [];
        if (session_id() !== '' || isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        session_destroy();
    }

    public function all(): array
    {
        return $_SESSION;
    }
}