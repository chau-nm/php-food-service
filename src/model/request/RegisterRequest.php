<?php

namespace app\model\request;

class RegisterRequest
{
    public function __construct(
        public string $username,
        public string $password,
        public string $email,
        public string $firstName,
        public string $lastName,
        public string $phone,
        public string $address,
    )
    {
    }

    public static function load(Request $request): RegisterRequest
    {
        $post = $request->getPost();
        return new self(
            $post['username'],
            $post['password'],
            $post['email'],
            $post['firstName'],
            $post['lastName'],
            $post['phone'],
            $post['address'],
        );
    }
}