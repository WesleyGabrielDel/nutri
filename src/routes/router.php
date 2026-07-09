<?php

// Dependências
require_once __DIR__ . '/../../bootstrap.php';

// Pegando as informações enviadas
$data = json_decode(file_get_contents('php://input'), true);
$data["route"] = "get-data";

if(!isset($data["route"])){
    die("Rota não selecionada.");
}

switch ($data['route']) {

    case "send-form":
        echo UserService::SendForm($data);
        break;

    case "get-data":
        echo DataService::GetData($data);
        break;

    default:
        die("Rota não encontrada.");
        break;
        
}

