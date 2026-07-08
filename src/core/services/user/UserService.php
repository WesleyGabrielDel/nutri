<?php

// Dependências
require_once HANDLERS_PATH . '/user/SendForm.php';

class UserService {

    public static function SendForm($data) {

        $mysqli = Database::Connect();
        $status = (new SendFormHandler)->handle($mysqli);
        $mysqli->close();

        return $status;

    }

}