<?php


    class Persona {
        public $nombre;
        protected $edad;
        private $password;

        public function __construct($nombre, $edad, $password){
            $this ->nombre = $nombre;
            $this ->edad = $edad;
            $this ->password = $password;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this ->password = $password;
        }

        public function getEdad(){
            return $this ->edad;
        }

        public function setEdad($edad){
            $this ->edad = $edad;
        }

        
    }

    $persona = new Persona("Juan", 31, "1234");

    $persona ->setEdad(50);

    echo "Nombre: " . $persona ->nombre . "; Edad: " . $persona ->getEdad() . "; Password: " . $persona ->getPassword();


