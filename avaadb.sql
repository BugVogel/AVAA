-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07-Maio-2017 às 20:28
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avaadb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `Nome` varchar(50) NOT NULL,
  `Curso` varchar(50) NOT NULL,
  `Semestre` int(2) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Senha` varchar(20) NOT NULL,
  `HashCode` int(50) NOT NULL,
  `Email Confirmado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`Nome`, `Curso`, `Semestre`, `Email`, `Senha`, `HashCode`, `Email Confirmado`) VALUES
('Rafael da Silva Macêdo', 'Engenharia', 9, '3011rafael@gmail.com', '123456', 0, 1),
('Gabriel', 'Engenharia', 10, 'gsm_fsa2008@hotmail.com', '123', 0, 1),
('teste', 'tt', 1, 't@gmail.com', '11', 0, 1),
('f', 'ds', 0, 'teste@gmail.com', '123', 0, 0),
('teste', 'teste', 1, 'teste@teste.com', '123', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade`
--

CREATE TABLE `atividade` (
  `ID` int(3) NOT NULL,
  `Descricao` varchar(100) NOT NULL,
  `Nivel` int(2) NOT NULL,
  `N_Blocos` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `atividade`
--

INSERT INTO `atividade` (`ID`, `Descricao`, `Nivel`, `N_Blocos`) VALUES
(11, 'Primeiro desafio', 1, 3),
(12, 'Segundo desafio', 1, 3),
(13, 'Segundo desafio', 1, 3),
(14, 'Terceiro desafio', 1, 3),
(15, 'Testando', 1, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade_turma`
--

CREATE TABLE `atividade_turma` (
  `ID_atividade` int(11) NOT NULL,
  `ID_turma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `atividade_turma`
--

INSERT INTO `atividade_turma` (`ID_atividade`, `ID_turma`) VALUES
(15, 8),
(15, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aviso`
--

CREATE TABLE `aviso` (
  `ID` int(20) NOT NULL,
  `Título` varchar(50) NOT NULL,
  `Texto` varchar(100) NOT NULL,
  `Data` varchar(20) NOT NULL,
  `ID_Turma` int(20) NOT NULL,
  `Nome_Professor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bloco_linhas`
--

CREATE TABLE `bloco_linhas` (
  `ID_atividade` int(10) NOT NULL,
  `Bloco` int(10) NOT NULL,
  `texto` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bloco_linhas`
--

INSERT INTO `bloco_linhas` (`ID_atividade`, `Bloco`, `texto`) VALUES
(11, 1, 'leia a;\r\nleia b;\r\nleia c;'),
(11, 2, 'soma = a + b+ c;'),
(11, 3, 'escreva c;'),
(12, 1, 'leia a;\r\nleia b;\r\nleia c;'),
(12, 2, 'soma = a + b+ c;'),
(12, 3, 'escreva c;'),
(13, 1, 'leia a;\r\nleia b;\r\nleia c;'),
(13, 2, 'soma = a + b+ c;'),
(13, 3, 'escreva c;'),
(14, 1, 'teste'),
(14, 2, 'teste'),
(14, 3, 'teste'),
(15, 1, 'teste'),
(15, 2, 'testando'),
(15, 3, 'finalizando');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `Nome` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Senha` varchar(50) NOT NULL,
  `HashCode` int(50) NOT NULL,
  `Email Confirmado` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`Nome`, `Email`, `Senha`, `HashCode`, `Email Confirmado`) VALUES
('Professor 2', 'professor2@gmail.com', '123456', 0, 0),
('Professor', 'professor@gmail.com', '123456', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `ID` int(20) NOT NULL,
  `Disciplina` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Professor` varchar(50) NOT NULL,
  `Escola` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`ID`, `Disciplina`, `Professor`, `Escola`) VALUES
(7, 'ProgramaÃ§Ã£o e Estrutura de dados', 'professor@gmail.com', 'UNIFACS'),
(8, 'ProgramaÃ§Ã£o 2', 'professor@gmail.com', 'FTC'),
(10, 'ProgramaÃ§Ã£o e algoritmos', 'professor@gmail.com', 'UNIFACS'),
(11, 'CÃ¡lculo', 'professor2@gmail.com', 'UEFS'),
(12, 'Algoritmos 1', 'professor2@gmail.com', 'UEFS'),
(13, 'Algoritmos e ProgramaÃ§Ã£o 2', 'professor2@gmail.com', 'FT');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_alunos`
--

CREATE TABLE `turma_alunos` (
  `ID_turma` int(20) NOT NULL,
  `ID_aluno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma_alunos`
--

INSERT INTO `turma_alunos` (`ID_turma`, `ID_aluno`) VALUES
(0, 'teste@gmail.com'),
(7, '3011rafael@gmail.com'),
(7, 'gsm_fsa2008@hotmail.com'),
(8, '3011rafael@gmail.com'),
(8, 'gsm_fsa2008@hotmail.com'),
(11, '3011rafael@gmail.com'),
(11, 'gsm_fsa2008@hotmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`Email`),
  ADD KEY `Email` (`Email`);

--
-- Indexes for table `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `aviso`
--
ALTER TABLE `aviso`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `turma_alunos`
--
ALTER TABLE `turma_alunos`
  ADD PRIMARY KEY (`ID_turma`,`ID_aluno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atividade`
--
ALTER TABLE `atividade`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `aviso`
--
ALTER TABLE `aviso`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
