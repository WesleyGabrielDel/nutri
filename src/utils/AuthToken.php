<?php

class AuthToken {

    public static function generate(){
        return bin2hex(random_bytes(32));
    }

    public static function bindToken($user_id, $token, $mysqli){ 
        Database::request("INSERT INTO tokens (user_id, token) VALUES (?, ?)", [$user_id, $token], $mysqli);
        return $token;
    }

    public static function setNavigatorToken($token, $mysqli) {
        setcookie(
            "auth_token",
            $token,
            [
                "expires" => time() + (30 * 24 * 60 * 60),
                "path" => "/",
                "httponly" => true,
                "secure" => isset($_SERVER["HTTP"]),
                "samesite" => "Lax"
            ]
        );
    }

    public static function findTokenByEmail($email, $mysqli) {
        $result = Database::request("SELECT t.token FROM tokens t JOIN users u ON t.user_id = u.id WHERE u.email = ?", $email, $mysqli);
        return !empty($result) ? $result[0]['token'] : null;
    }

    public static function getUserIdByToken($token, $mysqli) {
        $result = Database::request("SELECT user_id FROM tokens WHERE token = ?", $token, $mysqli);
        return !empty($result) ? $result[0]['user_id'] : null;
    }

}