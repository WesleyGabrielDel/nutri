-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/07/2026 às 18:34
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `nutriflow`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cardapio`
--

CREATE TABLE `cardapio` (
  `id` int(11) NOT NULL,
  `day` varchar(30) NOT NULL,
  `nome` varchar(70) DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista_refeicao`
--

CREATE TABLE `lista_refeicao` (
  `id` int(11) NOT NULL,
  `vai_comer` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lista_refeicao`
--

INSERT INTO `lista_refeicao` (`id`, `vai_comer`, `user_id`) VALUES
(3, 0, 5),
(4, 1, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `user_id`) VALUES
(5, '16b5f59878dc9f2a3cfa9f05a3ebb95d43c3743de41e984af806714d6c0d6ebc', 5),
(6, '037b3b1427f3d112ec156ca97bc56942f8105cce87e7ff874e6f6b9c9b46a0ed', 6),
(7, '2f7bf5b877ba0f07a635dc9e51aa6dbaa5faeddf806e55688b34232943f37917', 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `turno` varchar(20) DEFAULT NULL,
  `senha` varchar(100) NOT NULL,
  `cpf` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `turno`, `senha`, `cpf`) VALUES
(5, 'Prof. Giovanni', 'guidoarzua@gmail.com', NULL, '$2y$10$MHbjuB5mW4E7bo3yZR1hTONUd5CHwqe6Axr5lJF9gfkXZp0mKUVSK', '13801696901'),
(6, 'Wesley Gabriel', 'teamenergysave.contact@escola.pr.gov.br', 'manha', '$2y$10$5e1Vf8FealGBxH41v/CSIuH7zGFXzaEPPHst6GTSCyTKVuOSGWdP.', NULL),
(7, 'EnergySave Team', 'teamenergysave.contact@gmail.com', NULL, '$2y$10$YH5IbIN3WvPc2Ss7u.4JtOm8PLYaQTVdSlgcnDGjFe0mt2P12l9G2', '13801696901');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cardapio`
--
ALTER TABLE `cardapio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `lista_refeicao`
--
ALTER TABLE `lista_refeicao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lista_refeicao_user` (`user_id`);

--
-- Índices de tabela `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cardapio`
--
ALTER TABLE `cardapio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lista_refeicao`
--
ALTER TABLE `lista_refeicao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `lista_refeicao`
--
ALTER TABLE `lista_refeicao`
  ADD CONSTRAINT `fk_lista_refeicao_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
