-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Tempo de geração: 22-Nov-2022 às 23:53
-- Versão do servidor: 8.0.30
-- versão do PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `laravel`

--

INSERT INTO `consultas` (`id`, `data`, `horario_inicio`, `horario_fim`, `created_at`, `updated_at`, `paciente_id`, `psicologo_id`) 
VALUES
(1, '2024-05-23', '10:30:00', '11:20:00', '2024-05-20 21:30:31', '2024-05-20 21:30:31', 1, 1),
(2, '2024-05-14', '10:30:00', '11:20:00', '2024-05-20 21:31:17', '2024-05-20 21:31:17', 1, 2),
(3, '2024-05-16', '09:30:00', '10:20:00', '2024-05-20 21:35:18', '2024-05-20 21:35:18', 1, 2),
(4, '2024-05-06', '15:30:00', '16:20:00', '2024-05-20 21:36:13', '2024-05-20 21:36:13', 1, 3);
COMMIT;
