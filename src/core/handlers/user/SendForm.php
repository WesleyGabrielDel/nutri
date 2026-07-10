<?php

class SendFormHandler {

    public function handle($data, $mysqli) {

        if (!isset($data["will_eat"])) {
            return json_encode([
                "status" => "error",
                "message" => "Dados incorretos."
            ]);
        }

        $willEat = $data["will_eat"];
        if ($willEat === true || $willEat === 1 || $willEat === "1" || strtolower((string) $willEat) === "sim" || strtolower((string) $willEat) === "true") {
            $willEat = 1;
        } else {
            $willEat = 0;
        }

        $token = $_COOKIE["auth_token"] ?? null;

        if (!$token) {
            return json_encode([
                "status" => "error",
                "message" => "Token inválido."
            ]);
        }

        $user_id = AuthToken::getUserIdByToken($token, $mysqli);
        if (!$user_id) {
            return json_encode([
                "status" => "error",
                "message" => "Usuário inválido."
            ]);
        }

        $existing = Database::request("SELECT id FROM lista_refeicao WHERE user_id = ?", $user_id, $mysqli);
        if (!empty($existing)) {
            return json_encode([
                "status" => "error",
                "message" => "Você já enviou o formulário."
            ]);
        }

        Database::request("INSERT INTO lista_refeicao (vai_comer, user_id) VALUES (?, ?)", [$willEat, $user_id], $mysqli);

        return json_encode([
            "status" => "success",
            "message" => "Formulário enviado com sucesso!"
        ]);

    }

}