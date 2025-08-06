<?php

namespace app\model\request;

class CheckoutRequest
{
    public function __construct(
        public string $fullname,
        public string $phone,
        public string $address,
        public ?string $note = null,
        public string $paymentMethod
    ) {
    }
}
