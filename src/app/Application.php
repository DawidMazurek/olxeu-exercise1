<?php

namespace naspersclassifieds\olxeu\app;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Psr\Http\Message\ResponseInterface;
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
                $response = call_user_func_array([$handler, $handlerAction], $pathVariables);
                break;
            default:
                throw new Exception("Unexpected state");
        }

        $this->output($response ?: new EmptyResponse());
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