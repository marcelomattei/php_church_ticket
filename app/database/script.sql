-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Jul-2020 às 02:31
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ibr_event_ticket`
--

CREATE DATABASE `ibr_event_ticket` COLLATE = 'utf8_general_ci';

-- --------------------------------------------------------

--
-- Estrutura da tabela `worship`
--

CREATE TABLE `worship` (
  `id` int(11) NOT NULL,
  `description` varchar(35) NOT NULL,
  `hour` time NOT NULL,
  `date` date NOT NULL,
  `places` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `worship_registration`
--

CREATE TABLE `worship_registration` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `tax_id` varchar(15) NOT NULL,
  `quantity` int(11) NOT NULL,
  `worship_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `worship`
--
ALTER TABLE `worship`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `worship_registration`
--
ALTER TABLE `worship_registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worship_id` (`worship_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `worship`
--
ALTER TABLE `worship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `worship_registration`
--
ALTER TABLE `worship_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `worship_registration`
--
ALTER TABLE `worship_registration`
  ADD CONSTRAINT `worship_registration_ibfk_1` FOREIGN KEY (`worship_id`) REFERENCES `worship` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
