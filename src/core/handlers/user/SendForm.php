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

        $this->notifyWebsocket();

        return json_encode([
            "status" => "success",
            "message" => "Formulário enviado com sucesso!"
        ]);
    }

    private function notifyWebsocket() {
        $url = 'http://127.0.0.1:8000/atualizar-dados';
        $payload = json_encode([
            'type' => 'update',
            'source' => 'send-form'
        ]);

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => $payload,
                'timeout' => 2
            ]
        ];

        try {
            if (function_exists('curl_init')) {
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
                curl_setopt($ch, CURLOPT_TIMEOUT, 2);
                curl_exec($ch);
                curl_close($ch);
            } else {
                $context = stream_context_create($options);
                @file_get_contents($url, false, $context);
            }
        } catch (Throwable $e) {
            // Não interrompe o envio do formulário se o websocket falhar.
        }
    }
}
