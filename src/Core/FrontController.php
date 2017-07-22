<?php
namespace Exam\Core;

use Exam\Site\Views\View;

class FrontController
{
    private $view;
    private $controller = MVC_DEFAULT_CONTROLLER . "Controller";
    private $action = MVC_INDEX_ACTION;
    private $params = [];

    /**
     * FrontController constructor.
     */
    public function __construct()
    {
        $this->view = new View();
    }

    public function run()
    {
        $this->parseUri();
        call_user_func_array([new $this->controller, $this->action], $this->params);
    }

    private function parseUri(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->action = MVC_CREATE_ACTION;
        }

        $request_uri_info = parse_url($_SERVER['REQUEST_URI']);
        $requestPaths = explode('/', $request_uri_info['path']);
        // Get Controllers name
        if (!empty($requestPaths[1])) {
            $this->setController($requestPaths[1]);
        }
        // Get action name
        if (!empty($requestPaths[2])) {
            $this->setAction(strtolower($requestPaths[2]));
        }
        // Get Path params
        if (count($requestPaths) >= 3) {
            $this->setParams(array_slice($requestPaths, 3));
        }
    }

    private function setController($controllerName)
    {
        $controller = '\Exam\Site\Controllers\\'.ucfirst(strtolower($controllerName)) . "Controller";
        if (!class_exists($controller)) {
            $this->view->render('404');
            exit();
        }
        $this->controller = $controller;
    }

    private function setAction($action)
    {
        $reflector = new \ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            $this->view->render('404');
            exit();
        }
        $this->action = $action;
        return $this;
    }

    private function setParams(array $params)
    {
        $this->params = $params;
    }
}