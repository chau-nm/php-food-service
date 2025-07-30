<?php

namespace app\model\request;

class CheckoutRequest
{
    public function __construct(
        public string $fullname,
        public string $phone,
        public string $address,
        public ?string $note,
        public string $paymentMethod
    ) {}

    public static function load(Request $request): static
    {
        $data = json_decode($request->getContent(), true) ?: $request->getPost();

        return new self(
            fullname: trim($data['fullname'] ?? ''),
            phone: trim($data['phone'] ?? ''),
            address: trim($data['address'] ?? ''),
            note: isset($data['note']) ? trim($data['note']) : null,
            paymentMethod: trim($data['payment_method'] ?? '')
        );
    }

    public function isValid(): bool
    {
        return !empty($this->fullname) &&
            !empty($this->phone) &&
            !empty($this->address) &&
            !empty($this->paymentMethod) &&
            preg_match('/^0\d{9}$/', $this->phone);
    }

    public function toArray(): array
    {
        return [
            'fullname' => $this->fullname,
            'phone' => $this->phone,
            'address' => $this->address,
            'note' => $this->note,
            'payment_method' => $this->paymentMethod,
        ];
    }
}
