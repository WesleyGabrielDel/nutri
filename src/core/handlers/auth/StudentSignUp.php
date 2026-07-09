<?php 

class StudentSignUpHandler() {

    public function handle($email, $password, $name, $mysqli){

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        if(!empty(Database::request("SELECT * FROM user WHERE email = ?", $email, $mysqli))){
            die("Usuário já cadastrado.");
        }

        Database::request("INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)", [$name, $email, $password], $mysqli);

    }

}