<?php
    namespace Victor\Composer2\Routes;

    class Router2{
        private $routes = [];

        public function __Construct(){
            $this ->loadRoutes();
        }

        public function loadRoutes(){
            $this -> routes ['/'] = ['controller' => 'HomeController', 'action' => 'index'];
            $this -> routes ['/about'] = ['controller' => 'HomeController', 'action' => 'about'];
            $this -> routes ['/form'] = ['controller' => 'HomeController', 'action' => 'form'];
            $this -> routes ['/ips'] = ['controller' => 'HomeController', 'action' => 'ips'];
            $this -> routes ['/procesar'] = ['controller' => 'HomeController', 'action' => 'procesar'];
            $this -> routes ['/nueva'] = ['controller' => 'HomeController', 'action' => 'nueva'];
        }

        public function handleRequest(){
            $path = $_SERVER['REQUEST_URI'];
            error_log("path: " . $path);
            if (isset($this->routes[$path])){
                $route = $this->routes[$path];
                $controllerClass = '\\Victor\\Composer2\\Controllers\\' . $route['controller'];
                $action = $route['action'];


                //Falta el metodo para el /procesar
                $method = $_SERVER['REQUEST_METHOD'];

                error_log("ruta: " . $route['controller'] . "   action:  " . $action);

                if(class_exists($controllerClass) && method_exists($controllerClass, $action)){
                    $controller = new $controllerClass();

                    //Lo meto para controlar que el metodo es /procesar
                    /* if ($path === '/procesar' && $method === 'POST') {
                        $controller->$action($_POST);
                    } else {
                        $controller->$action();
                    }*/
                    $controller->$action($_REQUEST);

                } else {
                    http_response_code(404);
                    echo "404 Not Found";
                }
            } else {
                http_response_code(404);
                echo "404 Not Found";
            }
        }
    }

    $router = new Router2();
    $router ->handleRequest();