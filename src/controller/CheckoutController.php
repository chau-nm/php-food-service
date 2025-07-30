<?php

namespace app\controller;

use app\model\framework\AbstractController;
use app\model\request\Request;
use app\model\response\ViewResponse;
use app\model\response\Response;
use app\model\request\CheckoutRequest;
use app\model\Session;

class CheckoutController extends AbstractController
{
    public function view(Request $request): ViewResponse
    {
        if (!$this->isLoggedIn()) {
            $this->redirect("/login");
        }

        return $this->render("checkout");
    }

    public function process(Request $request): Response
    {
        if (!$this->isLoggedIn()) {
            return new Response(json_encode([
                "success" => false,
                "message" => "Vui lòng đăng nhập để thanh toán!"
            ]), 401, ["Content-Type" => "application/json"]);
        }

        $session = Session::getInstance();
        $user = $session->get('user');

        if (!$user || !isset($user['uuid'])) {
            return new Response(json_encode([
                "success" => false,
                "message" => "Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại!"
            ]), 401, ["Content-Type" => "application/json"]);
        }

        $checkoutRequest = CheckoutRequest::load($request);
        if (!$checkoutRequest->isValid()) {
            return new Response(json_encode([
                "success" => false,
                "message" => "Dữ liệu không hợp lệ!"
            ]), 400, ["Content-Type" => "application/json"]);
        }

        $order = \app\service\CheckoutService::getInstance()->createOrder($user['uuid'], $checkoutRequest);
        if (!$order) {
            return new Response(json_encode([
                "success" => false,
                "message" => "Giỏ hàng trống hoặc không thể tạo đơn hàng!"
            ]), 400, ["Content-Type" => "application/json"]);
        }

        return new Response(json_encode([
            "success" => true,
            "message" => "Đặt hàng thành công!",
            "order_id" => $order->id
        ]), 200, ["Content-Type" => "application/json"]);
    }
}
