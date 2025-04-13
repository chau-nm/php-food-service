<?php

namespace app\model\framework;

use app\enum\HttpResponseCode;
use app\model\request\Request;
use app\model\response\ErrorResponse;
use app\model\response\Response;
use app\model\response\ViewResponse;

class ControllerHandler
{
    public static function handle(Request $request): Response|ViewResponse
    {
        $apiRoutes = include PROJECT_ROUTE . "/routes/api-routes.php";
        $viewRoutes = include PROJECT_ROUTE . "/routes/view-routes.php";
        $routes = array_merge($apiRoutes, $viewRoutes);

        $requestUrl = $request->getURL();
        $requestMethod = $request->getMethod();
        foreach ($routes as $route) {
            $url = $route["url"];
            $method = $route["method"];
            $controller = "app\controller\\" . $route["controller"];
            if ($requestUrl === $url) {
                if ($requestMethod !== $method) {
                    return new Response(
                        new ErrorResponse("Unknown method"),
                        HttpResponseCode::METHOD_NOT_ALLOWED
                    );
                } else {
                    return self::handleRequest($request, $controller);
                }
            }
        }
        return new Response(
            new ErrorResponse("Unknown request url"),
            HttpResponseCode::NOT_FOUND
        );
    }

    private static function handleRequest(Request $request, string $controller): Response|ViewResponse
    {
        if (str_contains($controller, '::')) {
            [$class, $method] = explode('::', $controller);
            $instance = new ($class)();

            if (method_exists($instance, $method)) {
                return call_user_func([$instance, $method], $request);
            }
        }
        return new Response(
            new ErrorResponse("Unknown controller"),
            HttpResponseCode::NOT_FOUND
        );
    }
}