<?php

    namespace victor\composer3\Routes;

    class Router{
        private $routes = [];

        public function __Construct(){
            $this ->cargarRutas();
        }

        public function cargarRutas(){
            $this ->routes["/"] = ["controller" => "Controller", "action" => "index"];
            $this ->routes["/procesar"] = ["controller" => "Controller", "action" => "datos"];
        }

        public function peticion(){
            $ruta = $_SERVER['REQUEST_URI'];

            if (isset($this->routes[$ruta])){
                $route = $this->routes[$ruta];
                $controllerClass = '\\victor\\composer3\\Controllers\\' . $route['controller'];
                $accion = $route["action"];
                
                
                if(!class_exists($controllerClass)) {
                    echo "No existe la clase <br>";
                    echo $controllerClass;
                }
                

                if(class_exists($controllerClass) && method_exists($controllerClass, $accion)){
                    $controller = new $controllerClass();
                    $controller ->$accion($_REQUEST);
                } else {
                    //echo "NO existe el controlador o el metodo";
                }
            } else {
                echo "NO existe la ruta";
            }
        }
    }

    $instancia = new Router();
    $instancia->peticion();



