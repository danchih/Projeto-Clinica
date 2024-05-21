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

-- Preenchendo a tabela de clientes
INSERT INTO `pacientes` (`nome`, `email`, `cep`, `endereco`, `bairro`, `cidade`, `estado`, `telefone`)
VALUES
    ('João Silva', 'joao@example.com', '13340750', 'Alameda Ezequiel Mantoanelli', 'Jardim Juliana', 'Indaiatuba', 'São Paulo', '123456789'),
    ('Maria Santos', 'maria@example.com', '87654321', 'Rua B', 'Bairro B', 'Cidade B', 'Estado B', '987654321'),
    ('Pedro Oliveira', 'pedro@example.com', '13579246', 'Rua C', 'Bairro C', 'Cidade C', 'Estado C', '987123654');
COMMIT;
