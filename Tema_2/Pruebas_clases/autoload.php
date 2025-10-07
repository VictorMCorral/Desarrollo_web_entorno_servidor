<?php
    spl_autoload_register(function ($className){
        $filepath = __DIR__ . DIRECTORY_SEPARATOR . $className . ".php";
        if (file_exists($filepath)){
            require $filepath;
        }
    });