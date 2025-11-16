<?php
    namespace App\Routes;

    class Router{
        private $routes = [];

        public function __construct(){
            $this ->cargarRutas();
        }

        public function cargarRutas(){
            $this ->routes["/"] = ["controller" => "HomeControllers", "action" => "index"];
            $this ->routes["/log"] = ["controller" => "HomeControllers", "action" => "log"];
            $this ->routes["/logDat"] = ["controller" => "HomeControllers", "action" => "logDat"];
        }

        public function peticion(){
            $ruta = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $method = $_SERVER['REQUEST_METHOD'];

            if (isset($this->routes[$ruta])){
                $route = $this->routes[$ruta];
                $controllerClass = 'App\\Controllers\\' . $route['controller'];
                $accion = $route["action"];
                
                
                if(!class_exists($controllerClass)) {
                    echo "No existe la clase <br>";
                    echo $controllerClass . "<br>";
                }
                

                if(class_exists($controllerClass) && method_exists($controllerClass, $accion)){
                    $controller = new $controllerClass();

                    if($method == "GET"){
                        $controller ->$accion($_GET);
                    } else {
                        $controller ->$accion($_POST);
                    }
                    
                } else {
                    echo "NO existe el controlador o el metodo <br>";
                }
            } else {
                echo "NO existe la ruta";
            }
        }
    
    }

    $instancia = new Router();
    $instancia->peticion();