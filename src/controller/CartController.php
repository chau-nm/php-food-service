<?php

namespace app\controller;

use app\model\framework\AbstractController;
use app\model\request\Request;
use app\model\request\CartRequest;
use app\model\response\Response;
use app\model\response\ViewResponse;
use app\model\Session;
use app\service\CartService;

class CartController extends AbstractController
{
    public function view(Request $request): ViewResponse
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("/login");
        }

        $session = Session::getInstance();
        $cart = $session->get("cart") ?? [];

        return new ViewResponse("cart", ["cart" => $cart]);
    }

    public function add(Request $request): Response
    {
        if (!$this->isLoggedIn()) {
            header("Content-Type: application/json");
            http_response_code(401);
            echo json_encode(["success" => false, "message" => "Chưa đăng nhập"]);
            exit;
        }

        $cartRequest = CartRequest::load($request);
        $cartService = new CartService();
        $success = $cartService->addToCart($cartRequest->food_uuid, $cartRequest->quantity);

        header("Content-Type: application/json");
        if ($success) {
            $count = $cartService->getTotalQuantity();
            echo json_encode(["success" => true, "count" => $count]);
        } else {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Không thêm được món ăn"]);
        }
        exit;
    }

    public function update(Request $request): Response
    {
        if (!$this->isLoggedIn()) {
            header("Content-Type: application/json");
            http_response_code(401);
            echo json_encode(["success" => false, "message" => "Chưa đăng nhập"]);
            exit;
        }

        $cartRequest = CartRequest::load($request);
        $cartService = new CartService();
        $cartService->updateQuantity($cartRequest->food_uuid, max(1, $cartRequest->quantity));

        Session::getInstance()->set('cart_count', $cartService->getTotalQuantity());
        header("Content-Type: application/json");
        echo json_encode(["success" => true]);
        exit;
    }


    public function remove(Request $request): Response
    {
        $raw = $request->getContent();
        $data = json_decode($raw, true);

        $uuid = $data['food_uuid'] ?? null;

        if (!$uuid) {
            return new Response("Missing food_uuid", 400);
        }
        $session = Session::getInstance();
        $cart = $session->get("cart") ?? [];

        unset($cart[$uuid]);
        $session->set("cart", $cart);

        return new Response(json_encode([
            "count" => count($cart),
        ]), 200, ["Content-Type" => "application/json"]);
    }
    public function clear()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("/login");
        }

        $cartService = new CartService();
        $cartService->clearCart();

        $this->redirect("/cart");
    }
}
