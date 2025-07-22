<?php

namespace app\service;

use app\model\request\FoodRequest;
use app\model\entity\Food;
use app\repository\FoodRepository;

class ProductService
{
    private static ?ProductService $instance = null;

    public static function getInstance(): ProductService
    {
        if (self::$instance === null) {
            self::$instance = new ProductService();
        }
        return self::$instance;
    }

    public function getAll(): array
    {
        return FoodRepository::getInstance()->findAll();
    }

    public function findByUUID(string $uuid): ?Food
    {
        return FoodRepository::getInstance()->findByKey($uuid);
    }

    public function create(FoodRequest $foodRequest): ?Food
    {
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

        return FoodRepository::getInstance()->save($food) ? $food : null;
    }

    public function update(FoodRequest $foodRequest): ?Food
    {
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

        return FoodRepository::getInstance()->save($food) ? $food : null;
    }

    public function deleteByUUID(string $uuid): bool
    {
        return FoodRepository::getInstance()->deleteByKey($uuid);
    }
}
