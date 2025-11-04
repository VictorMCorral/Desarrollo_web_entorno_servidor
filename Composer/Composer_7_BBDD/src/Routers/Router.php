<?php
    namespace App\Routes;

    class Router{
        private $routes = [];

        public function __construct(){
            $this ->cargarRutas();
        }

        public function cargarRutas(){
            $this ->routes["/"] = ["controller" => "HomeControllers", "action" => "index"];
            $this ->routes["/listDepart"] = ["controller" => "HomeControllers", "action" => "listDepart"];
            $this ->routes["/listEmple"] = ["controller" => "HomeControllers", "action" => "listEmple"];
            $this ->routes["/eliminarDept"] = ["controller" => "HomeControllers", "action" => "eliminarDept"];
            $this ->routes["/modificarDept"] = ["controller" => "HomeControllers", "action" => "modificarDept"];
            $this ->routes["/modificarDept2"] = ["controller" => "HomeControllers", "action" => "modificarDept2"];
            $this ->routes["/addDepart"] = ["controller" => "HomeControllers", "action" => "addDepart"];
            $this ->routes["/addDepart2"] = ["controller" => "HomeControllers", "action" => "addDepart2"];
        }

        public function peticion(){
            //$ruta = $_SERVER['REQUEST_URI'];
            // parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)  -- limpia la url para poder entrar en las rutas
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