<?php

namespace app\controller;

use app\model\framework\AbstractController;
use app\model\request\Request;
use app\model\response\ViewResponse;
use app\repository\FoodRepository;

class HomeController extends AbstractController
{
    public function view(Request $request): ViewResponse
    {
        $foods = FoodRepository::getInstance()->findAll();
        $foodDTOs = array_map(fn($food) => $food->toDTO(), $foods);

        return $this->render("home", [
            'foods' => $foodDTOs
        ]);
    }
}
