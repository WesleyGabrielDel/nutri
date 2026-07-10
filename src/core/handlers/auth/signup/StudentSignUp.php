<?php 

class StudentSignUpHandler {

    public function handle($email, $password, $name, $turn, $mysqli){
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        if(!empty(Database::request("SELECT * FROM users WHERE email = ?", $email, $mysqli))){
            return json_encode([
                "status" => "error",
                "message" => "Usuario já cadastrado."
            ]);
        }

        $user_id = Database::request(
            "INSERT INTO users (nome, email, senha, turno) VALUES (?, ?, ?, ?)",
            [$name, $email, $password_hash, $turn],
            $mysqli
        );

        if(isset($_COOKIE["auth_token"])) {
            SessionManager::clearToken();
        }

        $token = AuthToken::generate();
        AuthToken::bindToken($user_id, $token, $mysqli);
        AuthToken::setNavigatorToken($token, $mysqli);

        return json_encode([
            "status" => "success",
            "message" => "Usuario cadastrado com sucesso."
        ]);
    }

}