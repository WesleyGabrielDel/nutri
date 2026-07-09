# Documento de Design de Software (DESIGN.md)
## Sistema de Controle de Economia de Merenda Escolar (NutriEconomia)

Este documento descreve a arquitetura, o design de interface e a estrutura de dados para o sistema **NutriEconomia**, uma ferramenta projetada para otimizar os gastos, reduzir o desperdício e gerenciar o estoque da merenda escolar de forma simples e eficiente.

---

## 1. Visão Geral do Sistema

O objetivo principal do sistema é dar visibilidade financeira e operacional sobre o uso dos recursos destinados à alimentação escolar. Ele atende desde o almoxarife que recebe os alimentos até a secretaria de educação que analisa os relatórios de economia.

### Benefícios Chave:
* **Redução de Desperdício:** Controle rigoroso de datas de validade e consumo médio.
* **Transparência Financeira:** Gráficos claros de economia gerada em relação ao orçamento.
* **Facilidade de Uso:** Interface limpa e adaptada para funcionários de diferentes níveis de familiaridade com tecnologia.

---

## 2. Identidade Visual e Interface (UI)

O design foi pensado para ser acolhedor (remetendo à alimentação/escola) e altamente profissional (remetendo ao controle financeiro).

### Paleta de Cores

* **Primária (Ações e Sucesso):** `Verde Sálvia (#4A7C59)` — Usado em botões de salvar, indicadores de economia e saldo positivo. Transmite saúde e equilíbrio.
* **Secundária (Estrutura e Texto):** `Azul Profundo (#2C3E50)` — Usado em menus, cabeçalhos e textos principais. Transmite confiança e segurança de dados.
* **Destaque (Alertas e Atenção):** `Amarelo Mostarda (#F4A261)` — Usado para avisos de itens perto do vencimento ou estoque mínimo atingido.
* **Fundo Geral:** `Cinza Claro (#F8F9FA)` — Reduz a fadiga visual em tabelas e listas longas.
* **Fundo de Blocos:** `Branco (#FFFFFF)` — Usado em cards, tabelas e gráficos para destacar as informações sobre o fundo cinza.

### Tipografia
* **Títulos:** *Inter* ou *Roboto* (Peso: 600) — Excelente legibilidade na tela.
* **Texto Corpo:** *Inter* (Peso: 400) — Espaçamento limpo, confortável para leitura de relatórios.

---

## 3. Arquitetura do Sistema

O sistema utiliza uma arquitetura baseada em serviços simples (Monolítico Modular ou Cliente-Servidor) para garantir facilidade de manutenção e baixo custo de hospedagem.

```
+-------------------------------------------------------+
|                    Camada de UI                       |
|          (Painel Web / Mobile Responsivo)            |
+---------------------------+---------------------------+
                            | (Requisições HTTP/JSON)
                            v
+-------------------------------------------------------+
|                  Camada de Negócio                    |
|       (Módulo de Estoque, Finanças e Alertas)         |
+---------------------------+---------------------------+
                            | (ORM / SQL)
                            v
+-------------------------------------------------------+
|                  Banco de Dados                       |
|           (PostgreSQL / SQLite p/ Escolas)            |
+-------------------------------------------------------+
```

---

## 4. Estrutura do Banco de Dados (Simplificado)

Para garantir o controle de economia, o banco de dados foca na relação entre compras, estoque e consumo diário.

### Tabela: `Alimentos`
* `id` (UUID, Chave Primária)
* `nome` (Texto) — Ex: Arroz Agulhinha Tipo 1
* `unidade_medida` (Texto) — Ex: KG, Litro, Pacote
* `estoque_minimo` (Decimal) — Para disparar alertas

### Tabela: `Lotes_Estoque`
* `id` (UUID, Chave Primária)
* `alimento_id` (Chave Estrangeira para Alimentos)
* `quantidade_atual` (Decimal)
* `preco_unitario` (Decimal) — Essencial para o cálculo de economia
* `data_validade` (Data)

### Tabela: `Consumo_Diario`
* `id` (UUID, Chave Primária)
* `alimento_id` (Chave Estrangeira)
* `quantidade_utilizada` (Decimal)
* `data_consumo` (Data)
* `numero_alunos_servidos` (Inteiro) — Ajuda a calcular o custo per capita

---

## 5. Fluxos Principais de Telas

### Tela 1: Dashboard de Economia (Tela Principal)
* **Topo:** 3 Cards de Resumo:
    1.  *Orçamento Disponível* (Texto em Azul Profundo)
    2.  *Economia Gerada no Mês* (Texto em Verde Sálvia)
    3.  *Alertas Críticos* (Texto em Amarelo Mostarda — Ex: "3 itens vencendo esta semana")
* **Centro:** Gráfico de linha mostrando a evolução do gasto real versus o orçamento planejado ao longo dos meses.

### Tela 2: Registro de Consumo Diário
* Formulário simples onde a cozinheira ou responsável insere o que foi gasto no dia.
* **Campos:** Seleção do Alimento, Quantidade Usada, Número de Alunos.
* **Inteligência do Sistema:** O sistema abate automaticamente do lote mais antigo (método PEPS - Primeiro que Entra, Primeiro que Sai) para evitar desperdício por vencimento.

### Tela 3: Relatório de Economia e Desperdício
* Tabela interativa com filtros por data.
* Exibe o quanto a escola economizou ao reutilizar ingredientes de forma eficiente ou otimizar as porções com base no número real de alunos presentes.

---

## 6. Regras de Negócio para Economia

1.  **Cálculo de Desperdício Evitado:** Se um item está a menos de 15 dias do vencimento e o sistema alerta o gestor para remanejá-lo ou priorizá-lo no cardápio, o valor financeiro total desse item é contabilizado no painel como "Economia Potencial Salva".
2.  **Custo Per Capita:** O sistema calcula automaticamente: `(Quantidade Utilizada × Preço Unitário) ÷ Número de Alunos`. Se o valor ficar abaixo da meta estipulada pelo governo/município sem perder a qualidade nutricional, a diferença é somada à "Economia Realizada".
