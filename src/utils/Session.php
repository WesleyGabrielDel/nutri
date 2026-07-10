<?php

class Session {

    public static function verify($token = null) {

        if ($token === null) {
            if (!isset($_COOKIE["auth_token"])) {
                return false;
            }

            $token = $_COOKIE["auth_token"];
        }
    
        $mysqli = Database::connect();
        $result = Database::request("SELECT * FROM tokens WHERE token = ?", $token, $mysqli);

        if (empty($result)) {
            return false;
        }

        return true;
    }

}