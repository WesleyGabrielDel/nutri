<?php

class SetMenuHandler {

    private function normalizeDay($day) {
        $value = trim(mb_strtolower((string) $day, 'UTF-8'));

        $map = [
            'segunda' => 'Segunda-feira',
            'segunda-feira' => 'Segunda-feira',
            'terca' => 'Terça-feira',
            'terça' => 'Terça-feira',
            'terça-feira' => 'Terça-feira',
            'quarta' => 'Quarta-feira',
            'quarta-feira' => 'Quarta-feira',
            'quinta' => 'Quinta-feira',
            'quinta-feira' => 'Quinta-feira',
            'sexta' => 'Sexta-feira',
            'sexta-feira' => 'Sexta-feira',
        ];

        return $map[$value] ?? null;
    }

    private function detectMenuTable($mysqli) {
        $possibleTables = [
            'cardaoio',
            'cardapio',
            'menu',
            'cardapio_semana',
            'weekly_menu',
            'weekly_cardapio'
        ];

        foreach ($possibleTables as $table) {
            $escapedTable = $mysqli->real_escape_string($table);
            $result = Database::request("SHOW TABLES LIKE '{$escapedTable}'", null, $mysqli);
            if ($result && count($result) > 0) {
                return $table;
            }
        }

        return null;
    }

    private function tableHasColumns($table, $mysqli) {
        $required = ['day', 'nome', 'image', 'description'];
        $columns = Database::request("SHOW COLUMNS FROM {$table}", null, $mysqli);
        if ($columns === false) {
            return false;
        }

        $names = array_map(function ($column) {
            return strtolower($column['Field']);
        }, $columns);

        foreach ($required as $field) {
            if (!in_array($field, $names, true)) {
                return false;
            }
        }

        return true;
    }

    private function ensureWeekdays($table, $mysqli) {
        $weekDays = [
            'Segunda-feira',
            'Terça-feira',
            'Quarta-feira',
            'Quinta-feira',
            'Sexta-feira'
        ];

        $existing = Database::request("SELECT day FROM {$table}", null, $mysqli);
        if ($existing === false) {
            return false;
        }

        $existingDays = array_map(function ($row) {
            return trim($row['day']);
        }, $existing);

        foreach ($weekDays as $day) {
            if (!in_array($day, $existingDays, true)) {
                Database::request(
                    "INSERT INTO {$table} (day, nome, image, description) VALUES (?, ?, ?, ?)",
                    [$day, '', null, ''],
                    $mysqli
                );
            }
        }

        return true;
    }

    private function decodeImage($image) {
        if ($image === null) {
            return null;
        }

        if (!is_string($image)) {
            return $image;
        }

        if (preg_match('/^data:\w+\/[-+.\w]+;base64,/', $image)) {
            $parts = explode(',', $image, 2);
            return base64_decode($parts[1]);
        }

        return $image;
    }

    private function getDefaultImageData() {
        $defaultPath = ROOT_PATH . '/public/static/imgs/refeitorio.png';
        if (!file_exists($defaultPath)) {
            return null;
        }

        return file_get_contents($defaultPath);
    }

    public function handle($data, $mysqli) {
        $day = $this->normalizeDay($data['day'] ?? '');
        $item = $data['item'] ?? null;
        $image = $data['image'] ?? null;
        $description = $data['description'] ?? null;

        if ($day === null || $item === null || $description === null) {
            return json_encode([
                'status' => 'error',
                'message' => 'Dados incompletos para envio do cardápio.'
            ]);
        }

        $table = $this->detectMenuTable($mysqli);
        if ($table === null) {
            return json_encode([
                'status' => 'error',
                'message' => 'Tabela de cardápio não encontrada no banco de dados.'
            ]);
        }

        if (!$this->tableHasColumns($table, $mysqli)) {
            return json_encode([
                'status' => 'error',
                'message' => 'A tabela de cardápio encontrada não tem os campos necessários.'
            ]);
        }

        if (!$this->ensureWeekdays($table, $mysqli)) {
            return json_encode([
                'status' => 'error',
                'message' => 'Falha ao verificar/garantir os dias da semana no banco.'
            ]);
        }

        $imageData = $this->decodeImage($image);
        if ($imageData === null) {
            $imageData = $this->getDefaultImageData();
        }

        $updateResult = Database::request(
            "UPDATE {$table} SET nome = ?, image = ?, description = ? WHERE day = ?",
            [$item, $imageData, $description, $day],
            $mysqli
        );

        if ($updateResult === false) {
            return json_encode([
                'status' => 'error',
                'message' => 'Erro ao atualizar o cardápio para ' . $day . '.'
            ]);
        }

        if ($updateResult === 0) {
            $insertResult = Database::request(
                "INSERT INTO {$table} (day, nome, image, description) VALUES (?, ?, ?, ?)",
                [$day, $item, $imageData, $description],
                $mysqli
            );

            if ($insertResult === false) {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Erro ao inserir o cardápio para ' . $day . '.'
                ]);
            }
        }

        return json_encode([
            'status' => 'success',
            'message' => 'Cardápio atualizado para ' . $day . ' com sucesso.'
        ]);
    }
}
