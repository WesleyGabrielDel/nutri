<?php

class GetDataHandler {

    public function handle($data, $mysqli) {

        $fields = [];

        // Pegando as quantidades de cada um no banco
        $student_qtd = sizeof(Database::request("SELECT * FROM lista_refeicao", null, $mysqli));
        $student_not = sizeof(Database::request("SELECT * FROM lista_refeicao WHERE vai_comer = ?", false, $mysqli));
        $student_yes = sizeof(Database::request("SELECT * FROM lista_refeicao WHERE vai_comer = ?", true, $mysqli));

        // Fazendo as contas
        $percentage_yes = $student_qtd > 0 ? round(($student_yes / $student_qtd) * 100, 1) : 0;
        $percentage_not = $student_qtd > 0 ? round(($student_not / $student_qtd) * 100, 1) : 0;
        
        $peso_por_refeicao_kg = 0.400;
        $custo_por_refeicao_brl = 6.50;

        $previsao_comida_kg = $student_yes * $peso_por_refeicao_kg;
        $previsao_custo_brl = $student_yes * $custo_por_refeicao_brl;

        // Retornando o valor formatado
        return json_encode([
            "quantity" => $student_qtd,
            "not" => $student_not,
            "yes" => $student_yes,
            "percentage_yes" => (string) $percentage_yes . "%",
            "percentage_not" => (string) $percentage_not . "%",
            "predicted_food_kg" => (string) $previsao_comida_kg . "kg",
            "predicted_cost" => (string) "R$" .$previsao_custo_brl
        ]);
        
    }

}