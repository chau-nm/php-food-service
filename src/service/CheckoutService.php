<?php

namespace app\service;

use app\model\Session;
use app\repository\OrderRepository;
use app\model\entity\Order;
use app\model\request\CheckoutRequest;

class CheckoutService
{
    private static ?CheckoutService $instance = null;
    private OrderRepository $orderRepo;
    private Session $session;

    public static function getInstance(): CheckoutService
    {
        if (self::$instance === null) {
            self::$instance = new CheckoutService();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->orderRepo = OrderRepository::getInstance();
        $this->session = Session::getInstance();
    }

    public function createOrder(string $userUuid, CheckoutRequest $request): ?Order
    {
        $cart = $this->session->get("cart", []);

        if (empty($cart)) {
            return null;
        }

        $orderId = time(); 

        $order = new Order(
            id: $orderId,
            userUuid: $userUuid,
            status: "PENDING",
            address: $request->address,
            phone: $request->phone,
            orderDate: new \DateTimeImmutable(),
            createdAt: new \DateTimeImmutable(),
            updatedAt: null,
            createdBy: $userUuid,
            updatedBy: null
        );

        $savedOrder = $this->orderRepo->save($order);

        if ($savedOrder) {
            $this->session->delete("cart"); 
        }

        return $savedOrder;
    }
}
