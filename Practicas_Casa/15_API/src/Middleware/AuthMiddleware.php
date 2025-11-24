<?php
namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use Dotenv\Dotenv;

class AuthMiddleware{
    private $secretKey;

    public function __construct(){
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
        $dotenv -> load();
        $this->secretKey = $_ENV["KEY"];
    }

    public function handle($headers){
        $authHeader = $headers["Authorization"] ?? $headers["authorization"] ?? null;
        if(!$authHeader){
            error_log(json_encode($authHeader));
            http_response_code(401);
            echo json_encode(["error" => "Token no proporcionado"]);
            exit;
        }

        $token = str_replace("Bearer ", "", $authHeader);

        try{
            $decoded = JWT::decode($token, new Key($this->secretKey, "HS256"));
            return (array) $decoded;
        } catch (\Exception $e){
            http_response_code(401);
            echo json_encode(["Error" => "Token invalido"]);
            exit;
        }
    }

}
