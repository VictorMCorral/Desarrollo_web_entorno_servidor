<?php
    namespace App\Routes;

    class Router{
        private $routes = [];

        public function __construct(){
            $this ->cargarRutas();
        }

        public function cargarRutas(){
            //$this ->routes["/"] = ["controller" => "HomeControllers", "action" => "loadDeps"];
            $this ->routes["/eliminarDept"] = ["controller" => "HomeControllers", "action" => "delDeps"];
            $this ->routes["/modificarDept"] = ["controller" => "HomeControllers", "action" => "updateDeps"];
            //$this ->routes["/modificarDept2"] = ["controller" => "HomeControllers", "action" => "updateDeps2"];
            $this ->routes["/crear"] = ["controller" => "HomeControllers", "action" => "addDep"];
            //$this ->routes["/crear2"] = ["controller" => "HomeControllers", "action" => "addDep2"];
            //Proyecto dos
            //$this ->routes["/"] = ["controller" => "HomeControllers2", "action" => "index"];
            $this ->routes["/about"] = ["controller" => "HomeControllers2", "action" => "about"];
            $this ->routes["/listDept_2"] = ["controller" => "HomeControllers2", "action" => "listDept_2"];
            $this ->routes["/modificarDept"] = ["controller" => "HomeControllers2", "action" => "actualizar"];
            $this ->routes["/modificarDept2"] = ["controller" => "HomeControllers2", "action" => "modificarDept2"];
            //$this ->routes["/eliminarDept"] = ["controller" => "HomeControllers2", "action" => "delDeps"];
            $this ->routes["/crear_2"] = ["controller" => "HomeControllers2", "action" => "crear_2"];
            $this ->routes["/crear2"] = ["controller" => "HomeControllers2", "action" => "crear_2b"];

            //Twig
            $this ->routes["/"] = ["controller" => "HomeControllers3", "action" => "index"];
            $this ->routes["/index_ejemplo"] = ["controller" => "HomeControllers3", "action" => "index_ejemplo"];
            $this ->routes["/about"] = ["controller" => "HomeControllers3", "action" => "about"];
            $this ->routes["/eliminarDept"] = ["controller" => "HomeControllers3", "action" => "delDeps"];
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