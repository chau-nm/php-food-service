<?php

namespace app\controller;

use app\model\framework\AbstractController;
use app\model\request\Request;
use app\model\response\ViewResponse;
use app\repository\FoodRepository;
use app\model\response\Response;
use app\model\response\ErrorResponse;
use app\model\request\FoodRequest;
use app\model\entity\Food;

class ProductController extends AbstractController
{
    public function view(Request $request): ViewResponse
    {
        return $this->render("product");
    }

    public function list(Request $request): Response
    {
        $foods = FoodRepository::getInstance()->findAll();

        $foodDTOs = array_map(
            fn($food) => $food->toDTO(),
            $foods
        );

        $response = new Response($foodDTOs);
        $response->setHeaders(['Content-Type' => 'application/json']);
        return $response;
    }

    public function detail(Request $request): Response|ErrorResponse
    {
        $uuid = $_GET['uuid'] ?? $_POST['uuid'] ?? null;
        if (!$uuid) {
            return new ErrorResponse('Thiếu mã sản phẩm', true);
        }

        $food = FoodRepository::getInstance()->findByKey($uuid);

        if (!$food) {
            return new ErrorResponse('Không tìm thấy sản phẩm', true);
        }

        $response = new Response($food->toDTO());
        $response->setHeaders(['Content-Type' => 'application/json']);
        return $response;
    }

    
    // Thêm mới sản phẩm
    public function create(Request $request): Response|ErrorResponse
    {
        $foodRequest = FoodRequest::load($request);

        $food = new Food(
            $foodRequest->uuid ?? uniqid(),
            $foodRequest->name,
            $foodRequest->description,
            $foodRequest->image,
            $foodRequest->price,
            new \DateTimeImmutable(),
            null,
            null,
            null
        );

        $result = FoodRepository::getInstance()->save($food);

        if (!$result) {
            return new ErrorResponse('Không thể lưu sản phẩm', true);
        }

        $response = new Response($food->toDTO());
        $response->setHeaders(['Content-Type' => 'application/json']);
        return $response;
    }

    // Xóa sản phẩm
    public function delete(Request $request): Response|ErrorResponse
    {
        $uuid = $_GET['uuid'] ?? $_POST['uuid'] ?? null;
        if (!$uuid) {
            return new ErrorResponse('Thiếu mã sản phẩm', true);
        }

        $deleted = FoodRepository::getInstance()->deleteByKey($uuid);

        if (!$deleted) {
            return new ErrorResponse('Xóa sản phẩm thất bại', true);
        }

        $response = new Response(['success' => true]);
        $response->setHeaders(['Content-Type' => 'application/json']);
        return $response;
    }
    
    // Cập nhật sản phẩm
    public function update(Request $request): Response|ErrorResponse
    {
        $foodRequest = FoodRequest::load($request);

        if (!$foodRequest->uuid) {
            return new ErrorResponse('Thiếu mã sản phẩm', true);
        }

        $food = new Food(
            $foodRequest->uuid,
            $foodRequest->name,
            $foodRequest->description,
            $foodRequest->image,
            $foodRequest->price,
            new \DateTimeImmutable(),
            null,
            null,
            null
        );

        $result = FoodRepository::getInstance()->save($food);

        if (!$result) {
            return new ErrorResponse('Cập nhật sản phẩm thất bại', true);
        }

        $response = new Response($food->toDTO());
        $response->setHeaders(['Content-Type' => 'application/json']);
        return $response;
    }
}