<?php

require_once HANDLERS_PATH . '/data/GetData.php';
require_once HANDLERS_PATH . '/data/SendMenu.php';

class DataService {

    public static function GetData($data){

        $mysqli = Database::Connect();

        $status = (new GetDataHandler)->handle($data, $mysqli);
        $mysqli->close();

        return $status;

    }

    public static function SendMenu($data){

        $mysqli = Database::Connect();

        $status = (new SendMenuHandler)->handle($data, $mysqli);
        $mysqli->close();

        return $status;

    }

}