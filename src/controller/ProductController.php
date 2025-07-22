<?php

namespace app\controller;

use app\model\framework\AbstractController;
use app\model\request\Request;
use app\model\response\ViewResponse;
use app\model\response\ErrorResponse;
use app\model\response\Response;
use app\model\request\FoodRequest;
use app\service\ProductService;

class ProductController extends AbstractController
{
    public function view(Request $request): ViewResponse
    {
        $uuid = $_GET['uuid'] ?? null;
        $food = null;

        if ($uuid) {
            $food = ProductService::getInstance()->findByUUID($uuid);
        }

        return $this->render("product", ['food' => $food]);
    }
    //danh sách sp
    public function list(Request $request): Response
    {
        $foods = ProductService::getInstance()->getAll();

        $foodDTOs = array_map(
            fn($food) => $food->toDTO(),
            $foods
        );

        $response = new Response($foodDTOs);
        $response->setHeaders(['Content-Type' => 'application/json']);
        return $response;
    }
    //chi tiết sp
    public function detail(Request $request): Response|ErrorResponse
    {
        $uuid = $_GET['uuid'] ?? $_POST['uuid'] ?? null;
        if (!$uuid) {
            return new ErrorResponse('!chưa nhập mã sản phầm', true);
        }

        $food = ProductService::getInstance()->findByUUID($uuid);

        if (!$food) {
            return new ErrorResponse('Không tìm thấy sản phẩm', true);
        }

        $response = new Response($food->toDTO());
        $response->setHeaders(['Content-Type' => 'application/json']);
        return $response;
    }
    //tạo sp
    public function create(Request $request): Response|ErrorResponse
    {
        $foodRequest = FoodRequest::load($request);
        $food = ProductService::getInstance()->create($foodRequest);

        if (!$food) {
            return new ErrorResponse('Không thể lưu sản phẩm', true);
        }

        $response = new Response($food->toDTO());
        $response->setHeaders(['Content-Type' => 'application/json']);
        return $response;
    }
    //xóa sp
    public function delete(Request $request): Response|ErrorResponse
    {
        $uuid = $_GET['uuid'] ?? $_POST['uuid'] ?? null;
        if (!$uuid) {
            return new ErrorResponse('!chưa nhập mã sản phầm', true);
        }

        $deleted = ProductService::getInstance()->deleteByUUID($uuid);

        if (!$deleted) {
            return new ErrorResponse('Xóa sản phẩm thất bại', true);
        }

        $response = new Response(['success' => true]);
        $response->setHeaders(['Content-Type' => 'application/json']);
        return $response;
    }
    //sủa sp
    public function update(Request $request): Response|ErrorResponse
    {
        $foodRequest = FoodRequest::load($request);

        if (!$foodRequest->uuid) {
            return new ErrorResponse('!chưa nhập mã sản phầm', true);
        }

        $food = ProductService::getInstance()->update($foodRequest);

        if (!$food) {
            return new ErrorResponse('Cập nhật sản phẩm thất bại', true);
        }

        $response = new Response($food->toDTO());
        $response->setHeaders(['Content-Type' => 'application/json']);
        return $response;
    }
}
