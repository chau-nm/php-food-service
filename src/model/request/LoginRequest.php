<?php

namespace app\model\request;

class LoginRequest
{
    public function __construct(
        public string $username,
        public string $password
    )
    {
    }

    public static function load(Request $request): static
    {
        $post = json_decode($request->getContent());
        $username = $post->username ?? '';
        $password = $post->password ?? '';
        return new self($username, $password);
    }
}