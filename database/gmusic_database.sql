-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/02/2024 às 05:09
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gmusic`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `id_artista` int(11) NOT NULL,
  `nome_artista` varchar(50) NOT NULL,
  `rota_foto` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fav_musica`
--

CREATE TABLE `fav_musica` (
  `id_musica` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `follow`
--

CREATE TABLE `follow` (
  `id_ouvinte` int(11) NOT NULL,
  `id_artista` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `musica`
--

CREATE TABLE `musica` (
  `id` int(11) NOT NULL,
  `id_album` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `rota_musica` varchar(100) NOT NULL,
  `add_playlist` int(11) NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `data` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `rota_foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `playlist_song`
--

CREATE TABLE `playlist_song` (
  `id_playlist` int(11) NOT NULL,
  `id_musica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `icone` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_artista` (`id_artista`);

--
-- Índices de tabela `fav_musica`
--
ALTER TABLE `fav_musica`
  ADD KEY `id_musica` (`id_musica`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `follow`
--
ALTER TABLE `follow`
  ADD KEY `id_artista` (`id_artista`),
  ADD KEY `id_ouvinte` (`id_ouvinte`);

--
-- Índices de tabela `musica`
--
ALTER TABLE `musica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_album` (`id_album`);

--
-- Índices de tabela `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `playlist_song`
--
ALTER TABLE `playlist_song`
  ADD KEY `id_musica` (`id_musica`),
  ADD KEY `id_playlist` (`id_playlist`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `musica`
--
ALTER TABLE `musica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `fav_musica`
--
ALTER TABLE `fav_musica`
  ADD CONSTRAINT `fav_musica_ibfk_1` FOREIGN KEY (`id_musica`) REFERENCES `musica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fav_musica_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`id_ouvinte`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `musica`
--
ALTER TABLE `musica`
  ADD CONSTRAINT `musica_ibfk_1` FOREIGN KEY (`id_album`) REFERENCES `album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `playlist_song`
--
ALTER TABLE `playlist_song`
  ADD CONSTRAINT `playlist_song_ibfk_1` FOREIGN KEY (`id_musica`) REFERENCES `musica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `playlist_song_ibfk_2` FOREIGN KEY (`id_playlist`) REFERENCES `playlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
