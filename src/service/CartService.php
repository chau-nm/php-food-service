<?php

namespace app\service;

use app\model\Session;
use app\repository\FoodRepository;

class CartService
{
    private Session $session;
    private FoodRepository $foodRepo;

    public function __construct()
    {
        $this->session = Session::getInstance();
        $this->foodRepo = FoodRepository::getInstance();
    }

    public function addToCart(string $foodUuid, int $quantity): bool
    {
        $cart = $this->session->get('cart', []);

        $food = $this->foodRepo->findByKey($foodUuid);
        if (!$food) return false;

        if (isset($cart[$foodUuid])) {
            $cart[$foodUuid]['quantity'] += $quantity;
        } else {
            $cart[$foodUuid] = [
                'uuid' => $food->uuid,
                'name' => $food->name,
                'price' => (int) $food->price,
                'image' => $food->image,
                'quantity' => $quantity,
            ];
        }

        $this->session->set('cart', $cart);
        return true;
    }

    public function getCart(): array
    {
        return $this->session->get('cart', []);
    }

    public function removeFromCart(string $foodUuid): void
    {
        $cart = $this->session->get('cart', []);
        unset($cart[$foodUuid]);
        $this->session->set('cart', $cart);
    }

    public function clearCart(): void
    {
        $this->session->delete('cart');
    }

    public function getTotalQuantity(): int
    {
        $cart = $this->getCart();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'];
        }
        return $total;
    }

    public function updateQuantity(string $foodUuid, int $quantity): void
    {
        $cart = $this->session->get('cart', []);
        if (isset($cart[$foodUuid])) {
            $cart[$foodUuid]['quantity'] = $quantity;
        }
        $this->session->set('cart', $cart);
    }
}
