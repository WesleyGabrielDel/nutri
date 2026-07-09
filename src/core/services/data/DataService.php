<?php

require_once HANDLERS_PATH . '/data/GetData.php';

class DataService {

    public static function GetData($data){

        $mysqli = Database::Connect();

        $status = (new GetDataHandler)->handle($data, $mysqli);
        $mysqli->close();

        return $status;

    }

}