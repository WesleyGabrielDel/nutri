<?php 

// Dependências
require_once "../core/services/_autoloader.php";
require_once "../utils/_autoloader.php";

// Pegando as informações enviadas
$data = json_decode(file_get_contents("php://input"), true);
$data["route"] = "send-form";

switch($data["route"]) {

    case "send-form":
        UserService::SendForm($data);
    break;
    

}