# NutriFlow 🍽️

Sistema de apoio às merendeiras para planejamento de refeições e redução de desperdício de alimentos em escolas.

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat&logo=php&logoColor=white)
![Python](https://img.shields.io/badge/Python-3.x-3776AB?style=flat&logo=python&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-10.4-003545?style=flat&logo=mariadb&logoColor=white)
![FastAPI](https://img.shields.io/badge/FastAPI-0.x-009688?style=flat&logo=fastapi&logoColor=white)

---

## Sumário

- [Visão Geral](#visão-geral)
- [Funcionalidades](#funcionalidades)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Equipe](#equipe)
- [Licença](#licença)

---

## Visão Geral

O **NutriFlow** é uma aplicação web desenvolvida para auxiliar escolas no controle de refeições e na redução do desperdício alimentar. O sistema permite que merendeiras planejem cardápios, registrem quantidades preparadas e acompanhem sobras em tempo real, enquanto alunos confirmam suas presenças nas refeições do dia.

### O problema que resolve

- Desperdício de alimentos por falta de planejamento de demanda
- Dificuldade em acompanhar quantas refeições serão solicitadas
- Falta de dados históricos para otimizar preparação
- Comunicação ineficiente entre cozinha e alunos

### Como resolve

- Alunos confirmam presença nas refeições do dia (manhã, tarde ou noite)
- Instituições visualizam demanda em tempo real via dashboard
- Semáforo visual indica status de desperdício (OK / Atenção / Alto)
- Cardápio semanal gerenciável pela instituição

---

## Funcionalidades

| Módulo | Descrição |
|--------|-----------|
| **Autenticação** | Login e cadastro separados para alunos e instituições |
| **Confirmação de Refeição** | Aluno indica se vai comer no dia (sim/não) |
| **Cardápio Semanal** | Instituição cadastra refeições para cada dia da semana |
| **Dashboard** | Visualização de dados consolidados de consumo e sobras |
| **Atualização em Tempo Real** | Dados atualizados automaticamente |
| **Semáforo de Desperdício** | Indicador visual verde/âmbar/vermelho |

---

## Tecnologias Utilizadas

| Tecnologia | Uso |
|------------|-----|
| **PHP 8.2** | Backend e API |
| **Python** | Servidor WebSocket |
| **MariaDB** | Banco de dados |
| **FastAPI** | Serviço de tempo real |
| **HTML/CSS/JS** | Frontend |

---

## Equipe

Desenvolvido por estudantes do programa **EnergySave**.

---

## Licença

Este projeto é destinado para fins educacionais.

---

<p align="center">
  <strong>NutriFlow</strong><br>
  Menos desperdício, mais refeições certas.
</p>
