<?php

    namespace victor\composer3\Controllers;


    class Controller{
        public function index(){
            $file_path = __DIR__ . "/../Views/form.html";
            
            if(file_exists($file_path)){
                echo file_get_contents($file_path);
            } else {
                echo "<h1>Victor, te has confundido.</h1>";
            }
        }

    }