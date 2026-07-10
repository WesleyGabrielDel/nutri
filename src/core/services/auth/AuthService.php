<?php

require_once HANDLERS_PATH . '/auth/login/StudentLogin.php';
require_once HANDLERS_PATH . '/auth/login/AdminLogin.php';
require_once HANDLERS_PATH . '/auth/signup/StudentSignUp.php';
require_once HANDLERS_PATH . '/auth/signup/AdminSignUp.php';

class AuthService {

    public static function Login($data){
        $login_up_type = $data["type"] ?? null;
        $mysqli = Database::Connect();

        if($login_up_type === "student") {
            $email = trim($data["email"] ?? "");
            $password = $data["password"] ?? "";

            $validation = self::validateStudentLogin();
            if ($validation !== true) {
                $mysqli->close();
                return json_encode([
                    "status" => "error",
                    "message" => $validation
                ]);
            }

            $status = (new StudentLoginHandler)->handle($email, $password, $mysqli);
            return $status;
        }

        else if($login_up_type === "admin") {
            $email = trim($data["email"] ?? "");
            $password = $data["password"] ?? "";
            $cpf = preg_replace('/\D/', '', $data["cpf"] ?? "");

            $validation = self::validateAdminLogin();
            if ($validation !== true) {
                $mysqli->close();
                return json_encode([
                    "status" => "error",
                    "message" => $validation
                ]);
            }

            $status = (new AdminLoginHandler)->handle($cpf, $email, $password, $mysqli);
            return $status;
        }

        else {
            $mysqli->close();

            return json_encode([
                "status" => "error",
                "message" => "Tipo de cadastro inválido."
            ]);
        }

    }

    public static function SignUp($data){
        $login_up_type = $data["type"] ?? null;
        $mysqli = Database::Connect();

        if($login_up_type === "student") {
            $email = trim($data["email"] ?? "");
            $name = trim($data["nome"] ?? "");
            $turn = trim($data["turn"] ?? "");
            $password = $data["password"] ?? "";

            $validation = self::validateStudentSignUp($email, $password, $name, $turn);
            if ($validation !== true) {
                $mysqli->close();
                return json_encode([
                    "status" => "error",
                    "message" => $validation
                ]);
            }

            $status = (new StudentSignUpHandler)->handle($email, $password, $name, $turn, $mysqli);
            return $status;

        }

        else if($login_up_type === "admin") {
            $email = trim($data["email"] ?? "");
            $password = $data["password"] ?? "";
            $name = trim($data["name"] ?? "");
            $cpf = preg_replace('/\D/', '', $data["cpf"] ?? "");

            $validation = self::validateAdminSignUp($cpf, $email, $password, $name);
            if ($validation !== true) {
                $mysqli->close();
                return json_encode([
                    "status" => "error",
                    "message" => $validation
                ]);
            }

            $status = (new AdminSignUpHandler)->handle($cpf, $email, $password, $name, $mysqli);
            return $status;
        }

        else {
            $mysqli->close();

            return json_encode([
                "status" => "error",
                "message" => "Tipo de cadastro inválido."
            ]);
        }

    }

    public static function Logout() {
        SessionManager::clearToken();
        return json_encode([
            "status" => "success",
            "message" => "Logout realizado com sucesso."
        ]);
    }

    #region Funções privadas

    private static function validateStudentLogin() {
        return true;
    }

    private static function validateAdminLogin() {
        return true;
    }

    private static function validateStudentSignUp($email, $password, $name, $turn) {
        if (trim($name) === "") {
            return "Informe o nome do estudante.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Informe um email válido.";
        }

        if (!str_ends_with(strtolower($email), "@escola.pr.gov.br")) {
            return "O email do estudante ser @escola.pr.gov.br.";
        }

        if (strlen($password) < 8) {
            return "A senha deve ter no mínimo 8 caracteres.";
        }

        if (trim($turn) === "") {
            return "Selecione um turno.";
        }

        return true;
    }

    private static function validateAdminSignUp($cpf, $email, $password, $name) {
        if (trim($name) === "") {
            return "Informe o nome.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Informe um email válido.";
        }

        if (strlen($password) < 8) {
            return "A senha deve ter no mínimo 8 caracteres.";
        }

        if (!self::isValidCpf($cpf)) {
            return "CPF inválido.";
        }

        return true;
    }

    private static function isValidCpf($cpf) {
        $cpf = preg_replace('/\D/', '', (string) $cpf);

        if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += intval($cpf[$i]) * (10 - $i);
        }

        $firstDigit = 11 - ($sum % 11);
        $firstDigit = $firstDigit >= 10 ? 0 : $firstDigit;

        if ($firstDigit !== intval($cpf[9])) {
            return false;
        }

        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += intval($cpf[$i]) * (11 - $i);
        }

        $secondDigit = 11 - ($sum % 11);
        $secondDigit = $secondDigit >= 10 ? 0 : $secondDigit;

        return $secondDigit === intval($cpf[10]);
    }

    #endregion

}