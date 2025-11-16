<?php
    namespace App\Routes;

    class Router{
        private $routes = [];

        public function __construct(){
            $this ->cargarRutas();
        }

        public function cargarRutas(){
            $this ->routes["GET"]["/departs"] = ["controller" => "HomeControllers", "action" => "getAll"];
            $this ->routes["GET"]["/departs/{id}"] = ["controller" => "HomeControllers", "action" => "getId"];
            $this ->routes["POST"]["/departs/create"] = ["controller" => "HomeControllers", "action" => "create"];
            $this ->routes["PUT"]["/departs/{id}"] = ["controller" => "HomeControllers", "action" => "update"];
            $this ->routes["DELETE"]["/departs/{id}"] = ["controller" => "HomeControllers", "action" => "delete"];
        }

        public function handleRequest(){
            $method = $_SERVER["REQUEST_METHOD"];
            $parsedUrl = parse_url($_SERVER["REQUEST_URI"]);

            $path =rtrim($parsedUrl, "/");
            $originalPath = $path;

            $parts = explode("/", trim($path, "/"));

            $paramValue = null;

            if(is_numeric(end($parts))){
                $paramValue = array_pop($parts);
                $path = "/" . implode("/", $parts) . "/{id}";
            }

            if(isset($this->routes[$method][$path])){
                $route= $this->routes[$method][$path];
                $controllerClass = "\\App\\Controllers\\" . $route["controller"];
                $action = $route["action"];

                error_log("ruta: " . $controllerClass . " action: " . $action);

                if(class_exists($controllerClass) && method_exists($controllerClass, $action))
                {
                    $controller = new $controllerClass;

                    if($paramValue !== null){
                        $controller->$action($paramValue);
                    } else {
                        $controller->$action();
                    }
                } else {
                    http_response_code(404);
                    echo json_encode(["error" => "Recurso no encontrado"]);
                }
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Recurso no encontrado"]);
            }
        }
    
    }

    $instancia = new Router();
    $instancia->peticion();