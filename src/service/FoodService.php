<?php

namespace app\service;

use app\repository\FoodRepository;

class FoodService
{
    private FoodRepository $foodRepository;

    public function __construct()
    {
        $this->foodRepository = FoodRepository::getInstance();
    }

    public function getAllFoods(): array
    {
        $foods = $this->foodRepository->findAll();
        return array_map(fn($food) => $food->toDTO(), $foods);
    }
}
