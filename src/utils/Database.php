<?php

class Database {

    public static function Connect() {

        $mysqli = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBNAME);

        if($mysqli->connect_error){
            die("Erro ao se conectar ao banco de dados: " . $mysqli->connect_error);
        }

        return $mysqli;
    }

    public static function request($sql, $params, $mysqli) {
        $stmt = $mysqli->prepare($sql);

        if (!$stmt) {
            return false;
        }

        if ($params !== null && ($params === 0 || $params === false || !empty($params))) {
            $params = is_array($params) ? $params : [$params];
            $types = '';
            $values = [];

            foreach ($params as $param) {
                if (is_bool($param)) {
                    $types .= 'i';
                    $values[] = $param ? 1 : 0;
                } elseif (is_int($param)) {
                    $types .= 'i';
                    $values[] = $param;
                } elseif (is_float($param)) {
                    $types .= 'd';
                    $values[] = $param;
                } else {
                    $types .= 's';
                    $values[] = $param;
                }
            }

            $stmt->bind_param($types, ...$values);
        }

        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }

        $result = $stmt->get_result();

        if ($result) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $data;
        }

        $affected = $stmt->affected_rows;
        $insertId = $mysqli->insert_id;

        $stmt->close();

        // Se for um INSERT, retorna o ID do registro inserido
        if (stripos(ltrim($sql), "INSERT") === 0) {
            return $insertId;
        }

        // UPDATE, DELETE, etc.
        return $affected;
    }

}