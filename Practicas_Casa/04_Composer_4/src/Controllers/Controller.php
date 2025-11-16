<?php

namespace Victor\Composer4\Controllers;


class Controller
{
    public function index()
    {
        $file_path = __DIR__ . "/../Views/form.html";

        if (file_exists($file_path)) {
            echo file_get_contents($file_path);
        } else {
            echo "<h1>Victor, te has confundido.</h1>";
        }
    }

    public function datos($data)
    {
        if (isset($data['usuario']) && !empty($data['usuario'])) {
            $usuario = $data['usuario'];
            $regexName = '/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,40}$/';
            if (preg_match($regexName, $usuario)) {
                echo "<h1>Nombre: $usuario</h1>";
            } else {
                echo "<h2>El nombre no cumple los requisitos</h2>";
            }
        } else {
            echo "<h1>No has introducido una password valida</h1>";
        }

        if (isset($data['password']) && !empty($data['password'])) {
            $password = $data['password'];
            $regexpass = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
            // Tenga al menos 8 caracteres. Incluya una letra mayúscula. Incluya una letra minúscula. Incluya un número. Incluya un carácter especial.
            if (preg_match($regexpass, $password)) {
                echo "<h1>Password: $password</h1>";
            } else {
                echo "<h2>La password no cumple los requisitos</h2>";
            }



            if (isset($data['email']) && !empty($data['email'])) {
                $email = $data['email'];
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<h1>Email: $email</h1>";
                } else {
                    echo "<h2>El email no cumple los requisitos</h2>";
                }
            } else {
                echo "<h1>No has introducido un email valido</h1>";
            }
        } else {
            echo "<h1>No has introducido un nombre valido</h1>";
        }
    }
}
