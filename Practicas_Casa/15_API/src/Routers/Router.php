<?php
    namespace App\Routes;

use App\Middleware\AuthMiddleware;
use App\Middleware\RegistrMiddleware;

    class Router{
        private $routes = [];
        private $registro;
        private $headers;


        public function __construct(){
            $this ->cargarRutas();
            $this ->registro = new RegistrMiddleware ();
            $this->headers = getallheaders();
        }

        public function cargarRutas(){
            $this ->routes["GET"]["/index"] = ["controller" => "HomeControllers", "action" => "index"];
            $this ->routes["GET"]["/departs"] = ["controller" => "HomeControllers", "action" => "getAll"];
            $this ->routes["GET"]["/departs/{id}"] = ["controller" => "HomeControllers", "action" => "getId"];
            $this ->routes["POST"]["/departs/create"] = ["controller" => "HomeControllers", "action" => "create", "auth" => true];
            $this ->routes["PUT"]["/departs/{id}"] = ["controller" => "HomeControllers", "action" => "update", "auth" => true];
            $this ->routes["DELETE"]["/departs/{id}"] = ["controller" => "HomeControllers", "action" => "delete", "auth" => true];
        }
        
        public function handleRequest(){
            $method = $_SERVER["REQUEST_METHOD"];
            $parsedUrl = parse_url($_SERVER["REQUEST_URI"]);
            
            $path =rtrim($parsedUrl["path"], "/");
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
                
                if(isset($route["auth"])){
                    $authMiddleware = new AuthMiddleware();
                    $headers = getallheaders();
                    
                    $userData = $authMiddleware->handle($headers);
                }
                
                $this->registro ->handle($method, $originalPath, $userData ?? ["user_id" => "Sin autorizacion"]);
                
                
                
                if(class_exists($controllerClass) && method_exists($controllerClass, $action))
                {
                    $controller = new $controllerClass;
                    
                    if(isset($userData)){
                        if($paramValue !== null){
                            $controller->$action($paramValue, $userData);
                        } else {
                            $controller->$action($userData);
                        }
                    } else {
                        if($paramValue !== null){
                            $controller->$action($paramValue);
                        } else {
                            $controller->$action();
                        }
                    }


                } else {
                    http_response_code(404);
                    echo json_encode(["error" => "Recurso no encontrado aaa"]);
                }
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Recurso no encontrado"]);
            }
        }
    
    }

    $instancia = new Router();
    $instancia->handleRequest();