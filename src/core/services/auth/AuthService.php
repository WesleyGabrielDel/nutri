<?php

require_once HANDLERS_PATH . '/auth/StudentLogin.php';
require_once HANDLERS_PATH . '/auth/AdminLogin.php';

class AuthService {

    public static function Login($data){

        $login_up_type =  $data["type"];
        $email = "";
        $password = "";
        $cpf = "";

        $mysqli = Database::Connect();

        if($login_up_type === "student") {

            $email = $data["email"];
            $nome = $data["nome"];
            $password = $data["password"];

            $status = (new StudentLoginHandler)->handle($email, $password, $mysqli);
            return $status;

        }

        else if($login_up_type === "admin") {

            $email = $data["email"];
            $password = $data["password"];
            $cpf = $data["cpf"]

            $status = (new AdminLoginHandler)->handle($cpf, $email, $password, $mysqli);
            return $status;

        }

        else {

            die("Tipo de cadastro inválido.")
            $mysqli->close();

        }

        $mysqli->close();

    }


}