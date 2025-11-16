<?php 
    require_once __DIR__  . "/../vendor/autoload.php";
    
    require_once __DIR__ . "/../src/Models/Database.php";
    new \App\Models\Database();

    require_once __DIR__ .  "/../src/Routers/Router.php";