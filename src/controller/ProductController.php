<?php

namespace app\controller;

use app\model\framework\AbstractController;
use app\model\request\Request;
use app\model\response\ViewResponse;

class ProductController extends AbstractController
{
    public function view(Request $request): ViewResponse
    {
        return $this->render("product");
    }
}