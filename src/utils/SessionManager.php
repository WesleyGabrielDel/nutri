<?php

class SessionManager {

    public static function verify($token = null) {

        if ($token === null) {
            if (!isset($_COOKIE["auth_token"])) {
                self::redirectToLogin();
                return false;
            }

            $token = $_COOKIE["auth_token"];
        }

        $mysqli = Database::Connect();
        $result = Database::request("SELECT * FROM tokens WHERE token = ?", [$token], $mysqli);

        if (!empty($result)) {
            $mysqli->close();
            return true;
        }

        self::clearToken();
        $mysqli->close();
        self::redirectToLogin();

        return false;
    }

    public static function verifyAdmin($token = null) {

        if ($token === null) {
            if (!isset($_COOKIE["auth_token"])) {
                self::redirectToLogin();
                return false;
            }

            $token = $_COOKIE["auth_token"];
        }

        $mysqli = Database::Connect();
        $tokenResult = Database::request("SELECT user_id FROM tokens WHERE token = ?", [$token], $mysqli);

        if (empty($tokenResult)) {
            self::clearToken();
            $mysqli->close();
            self::redirectToLogin();
            return false;
        }

        $userId = $tokenResult[0]["user_id"];
        $userResult = Database::request("SELECT cpf FROM users WHERE id = ?", [$userId], $mysqli);
        $isAdmin = !empty($userResult) && !empty($userResult[0]["cpf"]);

        $mysqli->close();

        if ($isAdmin) {
            return true;
        }

        self::redirectToLogin();
        return false;
    }

    public static function getCurrentUserName($token = null) {
        if ($token === null) {
            if (!isset($_COOKIE["auth_token"])) {
                return null;
            }

            $token = $_COOKIE["auth_token"];
        }

        $mysqli = Database::Connect();
        $tokenResult = Database::request("SELECT user_id FROM tokens WHERE token = ?", [$token], $mysqli);

        if (empty($tokenResult)) {
            self::clearToken();
            $mysqli->close();
            return null;
        }

        $userId = $tokenResult[0]["user_id"];
        $userResult = Database::request("SELECT nome FROM users WHERE id = ?", [$userId], $mysqli);
        $mysqli->close();

        if (empty($userResult)) {
            return null;
        }

        return trim($userResult[0]["nome"]);
    }

    public static function clearToken() {

        if (isset($_COOKIE["auth_token"])) {
            setcookie("auth_token", "", time() - 3600, "/");
            unset($_COOKIE["auth_token"]);
        }

    }

    private static function redirectToLogin() {
        if (headers_sent()) {
            return;
        }

        header("Location: /Nutriflow/public/index.php");
        exit;
    }

}