<?php

require_once HANDLERS_PATH . '/auth/login/StudentLogin.php';
require_once HANDLERS_PATH . '/auth/login/AdminLogin.php';
require_once HANDLERS_PATH . '/auth/signup/StudentSignUp.php';
require_once HANDLERS_PATH . '/auth/signup/AdminSignUp.php';

class AuthService {

    public static function Login($data){
        $login_up_type =  $data["type"];
        $email = "";
        $password = "";
        $cpf = "";

        $mysqli = Database::Connect();

        if($login_up_type === "student") {
            $email = $data["email"];
            $password = $data["password"];

            $status = (new StudentLoginHandler)->handle($email, $password, $mysqli);
            return $status;
        }

        else if($login_up_type === "admin") {
            $email = $data["email"];
            $password = $data["password"];
            $cpf = $data["cpf"];
            
            $status = (new AdminLoginHandler)->handle($cpf, $email, $password, $mysqli);
            return $status;
        }

        else {
            $mysqli->close();

            return json_encode([
                "status" => "error",
                "message" => "Tipo de cadastro inválido."
            ]);
        }

    }

    public static function SignUp($data){
        $login_up_type =  $data["type"];
        $email = "";
        $password = "";
        $name = "";
        $cpf = "";

        $mysqli = Database::Connect();

        if($login_up_type === "student") {
            $email = $data["email"];
            $name = $data["nome"];
            $turn = $data["turn"];
            $password = $data["password"];

            $status = (new StudentSignUpHandler)->handle($email, $password, $name, $turn, $mysqli);
            return $status;

        }

        else if($login_up_type === "admin") {
            $email = $data["email"];
            $password = $data["password"];
            $name = $data["name"];
            $cpf = $data["cpf"];

            $status = (new AdminSignUpHandler)->handle($cpf, $email, $password, $name, $mysqli);
            return $status;
        }

        else {
            $mysqli->close();

            return json_encode([
                "status" => "error",
                "message" => "Tipo de cadastro inválido."
            ]);
        }

    }


}