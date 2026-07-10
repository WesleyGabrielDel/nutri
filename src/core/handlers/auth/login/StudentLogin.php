<?php 

class StudentLoginHandler {

    public function handle($email, $password, $mysqli){

        $result = Database::request("SELECT * FROM users WHERE email = ?", $email, $mysqli);

        if (empty($result)) {
            return json_encode([
                "status" => "error",
                "message" => "Usuário não encontrado."
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

        AuthToken::setNavigatorToken($token, $mysqli);

        return json_encode([
            "status" => "success",
            "message" => "Login realizado com sucesso."
        ]);
    }

}