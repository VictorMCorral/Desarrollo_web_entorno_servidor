<?php
    namespace victor\Listanombres\Routes;

    class Router{
        private $routes = [];

        public function __construct(){
            $this ->cargarRutas();
        }

        public function cargarRutas(){
            $this ->routes["/"] = ["controller" => "ListController", "action" => "index"];
            $this ->routes["/crearUsuario"] = ["controller" => "ListController", "action" => "crearUsuario"];
            $this ->routes["/delUser"] = ["controller" => "ListController", "action" => "delUser"];
        }

        public function peticion(){
            //$ruta = $_SERVER['REQUEST_URI'];
            // parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)  -- limpia la url para poder entrar en las rutas
            $ruta = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $method = $_SERVER['REQUEST_METHOD'];

            if (isset($this->routes[$ruta])){
                $route = $this->routes[$ruta];
                $controllerClass = 'victor\\Listanombres\\Controllers\\' . $route['controller'];
                $accion = $route["action"];
                
                
                if(!class_exists($controllerClass)) {
                    echo "No existe la clase <br>";
                    echo $controllerClass;
                }
                

                if(class_exists($controllerClass) && method_exists($controllerClass, $accion)){
                    $controller = new $controllerClass();

                    if($method == "GET"){
                        $controller ->$accion($_GET);
                    } else {
                        $controller ->$accion($_REQUEST);
                    }
                    
                } else {
                    echo "NO existe el controlador o el metodo";
                }
            } else {
                echo "NO existe la ruta";
            }
        }
    
    }

    $instancia = new Router();
    $instancia->peticion();