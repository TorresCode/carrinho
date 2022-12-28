-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Dez-2022 às 11:03
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cart`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cart_temporary`
--

CREATE TABLE `cart_temporary` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_cover` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `cart_value` decimal(10,2) NOT NULL,
  `cart_quantity` int(11) NOT NULL,
  `cart_total` decimal(10,2) NOT NULL,
  `cart_status` int(11) NOT NULL,
  `cart_session` varchar(255) NOT NULL,
  `phone_number` decimal(10,0) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `forma_pagamento` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cart_temporary`
--

INSERT INTO `cart_temporary` (`cart_id`, `product_id`, `product_cover`, `product_name`, `product_stock`, `cart_value`, `cart_quantity`, `cart_total`, `cart_status`, `cart_session`, `phone_number`, `valor_total`, `forma_pagamento`, `create_at`) VALUES
(410, 40, 'upload/6363783e8cdaa.png', 'Vestido', 177, '12000.00', 1, '12000.00', 1, '293213912', '293213912', '2.00', '293213912', '2022-12-28 10:01:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_cover` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_headline` varchar(255) NOT NULL,
  `product_link` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_status` int(11) NOT NULL,
  `modelo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`product_id`, `product_cover`, `product_name`, `product_headline`, `product_link`, `product_price`, `product_stock`, `product_status`, `modelo`) VALUES
(40, 'upload/6363783e8cdaa.png', 'Vestido', 'Vestido', '6362d46d98df1', '12000.00', 177, 1, 'Calcas');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cart_temporary`
--
ALTER TABLE `cart_temporary`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `Cart_ProdId` (`product_id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `ProdtId` (`product_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cart_temporary`
--
ALTER TABLE `cart_temporary`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cart_temporary`
--
ALTER TABLE `cart_temporary`
  ADD CONSTRAINT `fk_cart_prod` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
