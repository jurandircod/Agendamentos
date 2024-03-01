-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/02/2024 às 23:59
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbagendamentos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbequipamento`
--

CREATE TABLE `tbequipamento` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `patrimonio` int(11) DEFAULT NULL,
  `condicao` int(11) NOT NULL,
  `disponibilidade` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbequipamento`
--

INSERT INTO `tbequipamento` (`codigo`, `nome`, `marca`, `patrimonio`, `condicao`, `disponibilidade`) VALUES
(13, 'Impressora ', 'EPSON L350', 50432, 1, 1),
(14, 'Projetor', 'EPSON', 56200, 3, 1),
(15, 'Notebook', '543003', 32423, 2, 1),
(16, 'notebook', 'lenovo', 55685, 2, 1),
(17, 'Notebook', 'Nitro5', 54933, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tblocal`
--

CREATE TABLE `tblocal` (
  `codigo` int(11) NOT NULL,
  `nomeLocal` varchar(255) NOT NULL,
  `lotacaoMaxima` int(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tblocal`
--

INSERT INTO `tblocal` (`codigo`, `nomeLocal`, `lotacaoMaxima`, `endereco`, `descricao`, `telefone`) VALUES
(14, 'Fundação Cultural', 50, ' Zona I, Umuarama - PR, 87501-130 Av. Rio Branco 3633', '', '(44) 3621-4112'),
(15, 'Anfiteatro', 20, 'Centro Civico, Umuarama - PR, 87501-130 Av. Rio Branco 3717', '', '(44) 3621-4141');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbreserva`
--

CREATE TABLE `tbreserva` (
  `codigo` int(11) NOT NULL,
  `dataHorarioInicio` datetime NOT NULL,
  `dataHorarioFim` datetime NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `codigoUsuario` int(11) NOT NULL,
  `codigoLocal` int(11) NOT NULL,
  `nomeEvento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbreserva`
--

INSERT INTO `tbreserva` (`codigo`, `dataHorarioInicio`, `dataHorarioFim`, `descricao`, `codigoUsuario`, `codigoLocal`, `nomeEvento`) VALUES
(4, '2024-02-10 17:38:00', '2024-02-10 15:41:00', '                        ', 11, 14, 'Reunião'),
(13, '2024-02-17 13:35:00', '2024-02-17 13:37:00', '                        ', 11, 14, 'Reunião');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbreservaequipamento`
--

CREATE TABLE `tbreservaequipamento` (
  `codigo` int(11) NOT NULL,
  `dataEmprestimo` datetime NOT NULL,
  `dataDevolucao` datetime NOT NULL,
  `codigoReserva` int(11) NOT NULL,
  `codigoEquipamento` int(11) NOT NULL,
  `responsavelEquip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbsecretaria`
--

CREATE TABLE `tbsecretaria` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbsecretaria`
--

INSERT INTO `tbsecretaria` (`codigo`, `nome`, `status`) VALUES
(7, 'Secretaria de Administração', 1),
(36, 'Secretaria de Educação', 1),
(37, 'Secretaria de Saúde', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbsetor`
--

CREATE TABLE `tbsetor` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `codigoSecretaria` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbsetor`
--

INSERT INTO `tbsetor` (`codigo`, `nome`, `codigoSecretaria`, `status`) VALUES
(11, 'Diretoria de TI', 7, 1),
(21, 'Controle interno', 37, 1),
(22, 'RH', 7, 1),
(23, 'dividativa', 7, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivelPermissao` int(11) NOT NULL DEFAULT 1,
  `codigoSetor` int(11) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbusuario`
--

INSERT INTO `tbusuario` (`codigo`, `nome`, `email`, `telefone`, `senha`, `nivelPermissao`, `codigoSetor`, `ativo`) VALUES
(11, 'jurandir', 'jurandir@gmail.com', '4499668815', '$2y$10$7rNSS5sOD.YOXQzEEOoE7uIPax0.fNnthUCDDaV.qEqH/Y3X.GVBq', 2, 11, 1),
(13, 'Jurandir Aparecido dos Santos Sobrinho', 'jurandir@gmail.com1234', '4499668815', '$2y$10$RbBkr4p9EHIQS7OOBT4BnOrQdA7BI2xrxHw2uC.SzBkI79WyL.Kvi', 1, 11, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbequipamento`
--
ALTER TABLE `tbequipamento`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `tblocal`
--
ALTER TABLE `tblocal`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `tbreserva`
--
ALTER TABLE `tbreserva`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigoUsuario` (`codigoUsuario`),
  ADD KEY `codigoLocal` (`codigoLocal`);

--
-- Índices de tabela `tbreservaequipamento`
--
ALTER TABLE `tbreservaequipamento`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigoReserva` (`codigoReserva`),
  ADD KEY `codigoEquipamento` (`codigoEquipamento`);

--
-- Índices de tabela `tbsecretaria`
--
ALTER TABLE `tbsecretaria`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `tbsetor`
--
ALTER TABLE `tbsetor`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigoSecretaria` (`codigoSecretaria`);

--
-- Índices de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigoSetor` (`codigoSetor`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbequipamento`
--
ALTER TABLE `tbequipamento`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `tblocal`
--
ALTER TABLE `tblocal`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `tbreserva`
--
ALTER TABLE `tbreserva`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tbreservaequipamento`
--
ALTER TABLE `tbreservaequipamento`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbsecretaria`
--
ALTER TABLE `tbsecretaria`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `tbsetor`
--
ALTER TABLE `tbsetor`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbreserva`
--
ALTER TABLE `tbreserva`
  ADD CONSTRAINT `tbreserva_ibfk_1` FOREIGN KEY (`codigoUsuario`) REFERENCES `tbusuario` (`codigo`),
  ADD CONSTRAINT `tbreserva_ibfk_2` FOREIGN KEY (`codigoLocal`) REFERENCES `tblocal` (`codigo`);

--
-- Restrições para tabelas `tbreservaequipamento`
--
ALTER TABLE `tbreservaequipamento`
  ADD CONSTRAINT `tbreservaequipamento_ibfk_1` FOREIGN KEY (`codigoReserva`) REFERENCES `tbreserva` (`codigo`),
  ADD CONSTRAINT `tbreservaequipamento_ibfk_2` FOREIGN KEY (`codigoEquipamento`) REFERENCES `tbequipamento` (`codigo`);

--
-- Restrições para tabelas `tbsetor`
--
ALTER TABLE `tbsetor`
  ADD CONSTRAINT `tbsetor_ibfk_1` FOREIGN KEY (`codigoSecretaria`) REFERENCES `tbsecretaria` (`codigo`);

--
-- Restrições para tabelas `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD CONSTRAINT `tbusuario_ibfk_1` FOREIGN KEY (`codigoSetor`) REFERENCES `tbsetor` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
