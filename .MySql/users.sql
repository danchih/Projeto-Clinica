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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `paciente_id`) 
VALUES
(1, 'João Silva', 'joao@example.com', NULL, '$2y$10$8hr4XDyU8Agt94L6z7luIurK9rvhcPdGrLEyQqRpg6g/j7l/58UZa', NULL, '2024-05-20 21:28:40', '2024-05-20 21:28:40', 1),
(2, 'Pedro Oliveira', 'pedro@example.com', NULL, '$2y$10$z3fpJk0RG4BaHKmQmTk4j.RWv9m0efMMWoPUNcKTKVtsoATCcnVz.', NULL, '2024-05-20 21:37:53', '2024-05-20 21:37:53', 3);
COMMIT;
