<?php

namespace app\model\framework;

use app\model\dto\UserDTO;
use app\model\response\RedirectResponse;
use app\model\response\ViewResponse;
use app\model\Session;
use app\service\AuthService;

abstract class AbstractController
{
    protected ?UserDTO $currentUser;

    public function __construct() {
        $this->auth();
    }

    private function auth(): void
    {
        $this->currentUser = AuthService::getInstance()->getLoggedInUser();
    }

    protected function isLoggedIn(): bool
    {
        return $this->currentUser !== null;
    }

    protected function render(string $view, array $data = []): ViewResponse
    {
        return new ViewResponse($view, $data);
    }

    protected function redirect(string $url): void
    {
        $driver = new RedirectResponse($url);
        $driver->redirect();
    }
}