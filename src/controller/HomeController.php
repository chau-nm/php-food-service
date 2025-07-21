<?php

namespace app\controller;

use app\model\framework\AbstractController;
use app\model\request\Request;
use app\model\response\ViewResponse;
use app\service\FoodService;

class HomeController extends AbstractController
{
    private FoodService $foodService;
    
    public function __construct()
    {
        $this->foodService = new FoodService();
    }
    
    public function view(Request $request): ViewResponse
    {
        $foodDTOs = $this->foodService->getAllFoods();
        return $this->render("home", ['foods' => $foodDTOs ]);
    }
}
