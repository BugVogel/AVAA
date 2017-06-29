-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: 29-Jun-2017 às 03:30
=======
-- Generation Time: 20-Jun-2017 às 15:47
>>>>>>> origin/master
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
  `Nome` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Curso` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Semestre` int(2) NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Senha` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`Nome`, `Curso`, `Semestre`, `Email`, `Senha`) VALUES
('Rafael da Silva Mac?do', 'Engenharia', 9, '3011rafael@gmail.com', '123456'),
('Bruno Gonzaga de Mattos Vogel', 'Engenharia de ComputaÃ§Ã£o', 3, 'bugvogel@gmail.com', '123456'),
('Gabriel', 'Engenharia', 10, 'gsm_fsa2008@hotmail.com', '123'),
('teste', 'tt', 1, 't@gmail.com', '11'),
('f', 'ds', 0, 'teste@gmail.com', '123'),
('teste', 'teste', 1, 'teste@teste.com', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade`
--

CREATE TABLE `atividade` (
  `ID` int(3) NOT NULL,
  `Descricao` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Nivel` int(2) NOT NULL,
  `N_Blocos` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `atividade`
--

INSERT INTO `atividade` (`ID`, `Descricao`, `Nivel`, `N_Blocos`) VALUES
(15, 'Testando', 1, 3),
(16, 'O algoritmo abaixo serÃ¡ para testar o funcionamento do banco de dados em relaÃ§Ã£o a esta funcional', 1, 3),
(17, 'testttttttttteeeeeeeeeeee', 1, 3);
<<<<<<< HEAD

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade_aluno`
--

CREATE TABLE `atividade_aluno` (
  `ID_Atividade` int(4) NOT NULL,
  `ID_Aluno` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Status` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `atividade_aluno`
--

INSERT INTO `atividade_aluno` (`ID_Atividade`, `ID_Aluno`, `Status`) VALUES
(17, '3011rafael@gmail.com', 'NaoTentou'),
(15, '3011rafael@gmail.com', 'NaoTentou'),
(17, 'gsm_fsa2008@hotmail.com', 'NaoTentou'),
(15, 'gsm_fsa2008@hotmail.com', 'NaoTentou'),
(17, 'teste@gmail.com', 'NaoTentou'),
(16, 'teste@gmail.com', 'NaoTentou');
=======
>>>>>>> origin/master

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
(16, 10),
(17, 7),
(17, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aviso`
--

CREATE TABLE `aviso` (
  `ID` int(20) NOT NULL,
  `Titulo` varchar(150) CHARACTER SET utf8 NOT NULL,
  `Texto` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `Data` varchar(20) CHARACTER SET utf8 NOT NULL,
  `ID_Turma` int(20) NOT NULL,
  `Nome_Professor` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aviso`
--

INSERT INTO `aviso` (`ID`, `Titulo`, `Texto`, `Data`, `ID_Turma`, `Nome_Professor`) VALUES
(3, 'teste', ' teste', '23/05/2017', 7, 'Professor'),
(4, 'Teste', ' Teste1', '23/05/2017', 8, 'Professor'),
(5, 'Teste', ' Teste1', '23/05/2017', 10, 'Professor'),
(6, 'Uefs paralisada', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend tortor nec dui posuere, eu ', '01/06/2017', 7, 'Professor'),
(9, 'aa', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend tortor nec dui posuere, eu vulputate sapien blandit. Suspendisse imperdiet, elit nec mollis vestibulum, odio elit efficitur mi, sed fringilla magna metus sed turpis. Mauris a diam convallis erat consectetur porttitor varius id velit. Duis laoreet tincidunt lorem, ut auctor urna pellentesque in. Proin sed odio et dolor scelerisque elementum. ', '04/06/2017', 10, 'Professor'),
<<<<<<< HEAD
(10, 'Lorem Ipsum', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend tortor nec dui posuere, eu vulputate sapien blandit. Suspendisse imperdiet, elit nec mollis vestibulum, odio elit efficitur mi, sed fringilla magna metus sed turpis. Mauris a diam convallis erat consectetur porttitor varius id velit. Duis laoreet tincidunt lorem, ut auctor urna pellentesque in. Proin sed odio et dolor scelerisque elementum.', '04/06/2017', 8, 'Professor'),
(11, 'Uefs de Volta', ' A uefs esta de volta ao funcionamento', '20/06/2017', 8, 'Professor');
=======
(10, 'Lorem Ipsum', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend tortor nec dui posuere, eu vulputate sapien blandit. Suspendisse imperdiet, elit nec mollis vestibulum, odio elit efficitur mi, sed fringilla magna metus sed turpis. Mauris a diam convallis erat consectetur porttitor varius id velit. Duis laoreet tincidunt lorem, ut auctor urna pellentesque in. Proin sed odio et dolor scelerisque elementum.', '04/06/2017', 8, 'Professor');
>>>>>>> origin/master

-- --------------------------------------------------------

--
-- Estrutura da tabela `bloco_linhas`
--

CREATE TABLE `bloco_linhas` (
  `ID_atividade` int(10) NOT NULL,
  `Bloco` int(10) NOT NULL,
  `texto` varchar(10000) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bloco_linhas`
--

INSERT INTO `bloco_linhas` (`ID_atividade`, `Bloco`, `texto`) VALUES
(15, 1, 'teste'),
(15, 2, 'testando'),
(15, 3, 'finalizando'),
(16, 1, 'int num1=5;\r\nint num2=4;\r\nint soma =0;'),
(16, 2, 'soma = num1+num2;'),
(16, 3, 'printf(soma);'),
(17, 1, 'asdaf'),
(17, 2, 'vefffw'),
(17, 3, '12312xasd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `Nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Senha` varchar(50) CHARACTER SET utf8 NOT NULL,
  `HashCode` int(50) NOT NULL,
  `Email Confirmado` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`Nome`, `Email`, `Senha`, `HashCode`, `Email Confirmado`) VALUES
('Professor 2', 'professor2@gmail.com', '123456', 0, 1),
('Professor', 'professor@gmail.com', '123456', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `ID` int(20) NOT NULL,
  `Disciplina` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Professor` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Escola` varchar(50) CHARACTER SET utf8 NOT NULL
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
<<<<<<< HEAD
  `ID_aluno` varchar(50) CHARACTER SET utf8 NOT NULL
=======
  `ID_aluno` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Atividade` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Resolvido` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Erradas` varchar(50) CHARACTER SET utf8 NOT NULL
>>>>>>> origin/master
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma_alunos`
--

<<<<<<< HEAD
INSERT INTO `turma_alunos` (`ID_turma`, `ID_aluno`) VALUES
(7, '3011rafael@gmail.com'),
(7, 'gsm_fsa2008@hotmail.com'),
(8, '3011rafael@gmail.com'),
(8, 'gsm_fsa2008@hotmail.com'),
(10, 'teste@gmail.com'),
(11, '3011rafael@gmail.com'),
(11, 'gsm_fsa2008@hotmail.com');
=======
INSERT INTO `turma_alunos` (`ID_turma`, `ID_aluno`, `Atividade`, `Resolvido`, `Erradas`) VALUES
(7, '3011rafael@gmail.com', '17', '', ''),
(7, 'gsm_fsa2008@hotmail.com', '17', '', ''),
(8, '3011rafael@gmail.com', '15', '', ''),
(8, 'gsm_fsa2008@hotmail.com', '15', '', ''),
(10, 'teste@gmail.com', '16,17', '', ''),
(11, '3011rafael@gmail.com', '', '', ''),
(11, 'gsm_fsa2008@hotmail.com', '', '', '');
>>>>>>> origin/master

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
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `aviso`
--
ALTER TABLE `aviso`
<<<<<<< HEAD
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
=======
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
>>>>>>> origin/master
--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
