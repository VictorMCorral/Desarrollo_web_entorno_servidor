<?php 
    namespace Victor\Composer2\Routes;

    use Victor\Composer2\Controllers\HomeController;


    $requestUri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    $controller = new HomeController();

    error_log($requestUri);

    switch($requestUri){
        case "/":
            echo $controller -> index();
            break;

        case "/form":
            $controller ->form();
            break;    

        case "/about":
            $controller -> about();
            break;
            
        case "/procesar":
            $controller -> procesar($_POST);
            break;

        case "/ips":
            $controller -> ips();
            break;

        default:
            http_response_code(404);
            echo "404 Not Found";
            break;

    }

