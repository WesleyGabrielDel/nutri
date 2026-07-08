<?php

// Dependências
require_once __DIR__ . '/../../bootstrap.php';

Database::Connect();
exit;

// Pegando as informações enviadas
$data = json_decode(file_get_contents('php://input'), true);

switch ($data['route']) {

    case 'send-form':
        UserService::SendForm($data);
        break;

    default:
        echo "Rota não existente";
        break;
        
}
