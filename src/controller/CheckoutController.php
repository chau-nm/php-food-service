<?php

namespace app\controller;

use app\service\CheckoutService;
use app\model\request\CheckoutRequest;
use app\model\Session;

class CheckoutController
{
    private CheckoutService $checkoutService;
    private Session $session;

    public function __construct()
    {
        $this->checkoutService = CheckoutService::getInstance();
        $this->session = Session::getInstance();
    }

    public function process()
    {
        header('Content-Type: application/json'); 

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(["success" => false, "message" => "Phương thức không được phép"]);
            return;
        }

        $input = json_decode(file_get_contents("php://input"), true) ?? $_POST;

        $fullname = trim($input['fullname'] ?? '');
        $phone = trim($input['phone'] ?? '');
        $address = trim($input['address'] ?? '');
        $note = trim($input['note'] ?? '');
        $paymentMethod = trim($input['payment_method'] ?? '');

        $user = $this->session->get("user");
        if (!$user) {
            http_response_code(401);
            echo json_encode(["success" => false, "message" => "Chưa đăng nhập hoặc phiên hết hạn"]);
            return;
        }

        if (!$fullname || !$phone || !$address || !$paymentMethod) {
            echo json_encode(["success" => false, "message" => "Vui lòng nhập đầy đủ thông tin!"]);
            return;
        }

        $request = new CheckoutRequest(
            fullname: $fullname,
            phone: $phone,
            address: $address,
            note: $note,
            paymentMethod: $paymentMethod
        );

        $order = $this->checkoutService->createOrder($user['uuid'], $request);

        if ($order) {
            echo json_encode([
                "success" => true,
                "message" => "Đặt hàng thành công!",
                "order_id" => $order->id
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Giỏ hàng trống hoặc có lỗi xảy ra khi đặt hàng"
            ]);
        }
    }
}
