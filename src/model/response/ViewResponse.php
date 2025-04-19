<?php

namespace app\model\response;

class ViewResponse
{
    public function __construct(
        private readonly string $view,
        private array $data = []
    )
    {
    }

    public function render(): void {
        $viewPath = PROJECT_ROOT . "/templates/" . $this->view . ".php";
        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo "View not found: $viewPath";
        }
        extract($this->data);
        include $viewPath;
    }
}