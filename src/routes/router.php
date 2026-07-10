<?php

// Dependências
require_once __DIR__ . '/../../bootstrap.php';

// Pegando as informações enviadas
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data["route"])) {
    die("Rota não selecionada.");
}

switch ($data['route']) {

    case "send-form":
        echo UserService::SendForm($data);
        break;

    case "get-data":
        echo DataService::GetData($data);
        break;

    case "login":
        echo AuthService::Login($data);
        break;

    case "signup":
        echo AuthService::SignUp($data);
        break;

    case "menu-send":
        echo DataService::SendMenu($data);
        break;

    case "set-menu":
        echo DataService::SetMenu($data);
        break;

    case "logout":
        echo AuthService::Logout();
        break;

    default:
        die("Rota não encontrada.");
        break;

}

