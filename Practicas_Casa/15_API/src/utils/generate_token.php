<?php

require_once __DIR__  . "/../../vendor/autoload.php";

use Firebase\JWT\JWT;

use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__ . "/../..");
$dotenv->load();
$secretKey = $_ENV["KEY"];

$payload = [
    "iss" => "http://localhost:8000",
    "aud" => "http://localhost:8000",
    "iat" => time(),
    "exp" => time() +3600,
    "user_id" => "Victor M."
];

$jwt = JWT::encode($payload, $secretKey, "HS256");

echo json_encode(["token" => $jwt]);