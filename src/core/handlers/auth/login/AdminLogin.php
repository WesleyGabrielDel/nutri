<?php

class AdminLoginHandler {

    public function handle($cpf, $email, $password, $mysqli) {

        $result = Database::request("SELECT * FROM users WHERE cpf = ? AND email = ?", [$cpf, $email], $mysqli);

        if (empty($result)) {
            return json_encode([
                "status" => "error",
                "message" => "Instituição não encontrada."
            ]);
        }

        $user = $result[0];

        if (!password_verify($password, $user["senha"])) {
            return json_encode([
                "status" => "error",
                "message" => "Senha incorreta."
            ]);
        }

        $token = AuthToken::findTokenByEmail($email, $mysqli);

        if (!$token) {
            $token = AuthToken::generate();
            AuthToken::bindToken($user["id"], $token, $mysqli);
        }
        
        if(isset($_COOKIE["auth_token"])) {
            SessionManager::clearToken();
        }

        AuthToken::setNavigatorToken($token, $mysqli);

        return json_encode([
            "status" => "success",
            "message" => "Login de instituição realizado com sucesso."
        ]);
    }
        
}