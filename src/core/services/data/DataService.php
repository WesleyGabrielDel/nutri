<?php

require_once HANDLERS_PATH . '/data/GetData.php';
require_once HANDLERS_PATH . '/data/SendMenu.php';
require_once HANDLERS_PATH . '/data/SetMenu.php';

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

    public static function SetMenu($data){

        $mysqli = Database::Connect();

        $status = (new SetMenuHandler)->handle($data, $mysqli);
        $mysqli->close();

        return $status;

    }

}