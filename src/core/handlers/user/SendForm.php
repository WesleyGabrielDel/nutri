<?php

class SendFormHandler {

    public function handle($data, $mysqli) {

        if(!isset($data["will_eat"])){
            die("Dados incorretos");
        }

        Database::request("INSERT INTO lista_refeicao (vai_comer) VALUES (?)", $data["will_eat"], $mysqli);

        return json_encode([
            "status" => "success",
            "message" => "Formulário enviado com sucesso!"
        ]);

    }

}