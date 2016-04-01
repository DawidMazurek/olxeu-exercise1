<?php

namespace naspersclassifieds\olxeu\app;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Psr\Http\Message\ResponseInterface;
use stdClass;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Diactoros\ServerRequestFactory;
use function FastRoute\simpleDispatcher;

class Application
{
    private $request;
    private $dispatcher;

    public function __construct($config)
    {
        $this->request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
        $this->dispatcher = simpleDispatcher(function (RouteCollector $routeCollector) use ($config) {
            foreach ($config['routing'] as $route) {
                $routeCollector->addRoute($route[0], $route[1], $route[2]);
            }
        });
    }

    public function run()
    {
        $routeInfo = $this->dispatcher->dispatch($this->request->getMethod(), $this->request->getUri()->getPath());
        $response = '';
        try {
            $response = $this->handleRoute($routeInfo);
        }
        catch(Exception $ex) {
            $errorInfo = new stdClass();

            switch($ex->getStatusCode())
            {
                case 404:
                case 401:
                    $errorInfo->code = $ex->getStatusCode();
                    $errorInfo->message = $ex->getMessage();
                    break;

                default:
                    $errorInfo->code = 0;
                    $errorInfo->message = 'Error occured';
            }
            $response = new Response\JsonResponse($errorInfo);
        }
        catch(\Exception $ex) {
            $errorInfo = new stdClass();
            $errorInfo->code = 0;
            $errorInfo->message = 'Error occured';
            $response = new Response\JsonResponse($errorInfo);

            error_log(
                "Unhandled exception " . get_class($ex).
                " occured in {$ex->getFile()}:{$ex->getLine()}." .
                " Message: {$ex->getMessage()}, code: {$ex->getCode()}"
            );
        }
        finally {
            $this->output($response ?: new EmptyResponse());
        }
    }

    private function baseAuthenticated()
    {
        return isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])
            && $_SERVER['PHP_AUTH_USER'] === 'admin'
            && $_SERVER['PHP_AUTH_PW'] === 'password';
    }

    private function handleRoute(array $routeInfo)
    {
        if (!$this->baseAuthenticated())
        {
            throw new Exception(401, "Unauthorized");
        }
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                throw new Exception(404, "Not found");
                break;
            case Dispatcher::FOUND:
                $handlerClass = $routeInfo[1][0];
                $handlerAction = $routeInfo[1][1];
                $pathVariables = $routeInfo[2];
                $pathVariables[] = $this->request;
                $handler = new $handlerClass();
                return call_user_func_array([$handler, $handlerAction], $pathVariables);
                break;
            default:
                throw new Exception("Unexpected state");
        }
    }

    public function output(ResponseInterface $response)
    {
        header("HTTP/" . $response->getProtocolVersion() . ' ' . $response->getStatusCode() . ' ' . $response->getReasonPhrase());
        foreach ($response->getHeaders() as $headerName => $headerValue) {
            $headerValue = $headerValue[0];
            header("$headerName: $headerValue");
        }
        echo $response->getBody();
    }
}