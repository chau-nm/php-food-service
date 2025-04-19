<?php

namespace app;

use app\conf\Database;
use app\enum\HttpResponseCode;
use app\exception\AbstractException;
use app\model\framework\ControllerHandler;
use app\model\framework\RequestHandler;
use app\model\framework\ResponseHandler;
use app\model\request\Request;
use app\model\response\ErrorResponse;
use app\model\response\Response;
use app\model\response\ViewResponse;

/**
 * @copyright chau-nm
 */
class App
{
    public static function handle(Request $request): void
    {
        try {
            $requestHandled = RequestHandler::handle($request);
            if ($requestHandled instanceof Request) {
                $response = ControllerHandler::handle($requestHandled);

                if ($response instanceof Response) {
                    ResponseHandler::handle($response);
                }
                if ($response instanceof ViewResponse) {
                    $response->render();
                }
            } else if ($requestHandled instanceof Response) {
                ResponseHandler::handle($requestHandled);
            } else {
                ResponseHandler::handle(
                    new Response(
                        new ErrorResponse("unknown request"),
                        HttpResponseCode::NOT_FOUND
                    )
                );
            }
        } catch (AbstractException $e) {
            ResponseHandler::handle(
                new Response(
                    new ErrorResponse($e->getMessage()),
                    $e->getHttpCode()
                )
            );
        }
    }
}