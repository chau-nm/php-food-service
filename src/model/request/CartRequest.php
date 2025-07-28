<?php

namespace app\model\request;

class CartRequest
{
    public string $food_uuid;
    public int $quantity;

    public function __construct(string $food_uuid, int $quantity)
    {
        $this->food_uuid = $food_uuid;
        $this->quantity = $quantity;
    }

    public static function load(Request $request): CartRequest
    {
        $method = $request->getMethod();
        $headers = $request->getHeaders();

        if ($method === 'POST' && isset($headers['Content-Type']) && str_contains($headers['Content-Type'], 'application/json')) {
            $raw = $request->getContent();
            $data = json_decode($raw, true);
        } else {
            $data = $request->getPost();
        }

        $food_uuid = $data['food_uuid'] ?? '';
        $quantity = (int)($data['quantity'] ?? 0);

        return new CartRequest($food_uuid, $quantity);
    }
}
