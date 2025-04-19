<?php

namespace app\model\dto;

class UserDTO
{
    public function __construct(
        public string $uuid,
        public string $email,
        public string $firstName,
        public string $lastName,
        public string $phone,
        public string $address,
        public ?string $avatar,
    )
    {
    }
}