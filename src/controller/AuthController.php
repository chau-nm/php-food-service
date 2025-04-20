<?php

namespace app\controller;

use app\exception\BadRequestException;
use app\exception\UnauthorizedException;
use app\model\request\LoginRequest;
use app\model\request\RegisterRequest;
use app\model\request\Request;
use app\model\response\Response;
use app\service\AuthService;

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = AuthService::getInstance();
    }

    /**
     * @throws UnauthorizedException
     */
    public function login(Request $request): Response
    {
        $loginRequest = LoginRequest::load($request);
        $logged = $this->authService->login($loginRequest);
        return new Response($logged);
    }

    /**
     * @throws BadRequestException
     */
    public function register(Request $request): Response
    {
        $registerRequest = RegisterRequest::load($request);
        $registered =  $this->authService->register($registerRequest);
        return new Response($registered);
    }

    public function logout(Request $request): Response
    {
        $this->authService->logout();
        return new Response("OK");
    }
}