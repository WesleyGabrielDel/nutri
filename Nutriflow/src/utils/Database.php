<?php

class Database {

    public static function Connect() {

        $mysqli = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBNAME);

        if($mysqli->connect_error){
            die("Erro ao se conectar ao banco de dados: " . $mysqli->connect_error).
        }

        return $mysqli;
    }

}