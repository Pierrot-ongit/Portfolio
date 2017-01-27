-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 03 Janvier 2017 à 23:47
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `resto`
--

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `bookingDate` datetime NOT NULL,
  `covers` int(11) NOT NULL,
  `creationTimeBooking` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `booking`
--

INSERT INTO `booking` (`id`, `customerId`, `bookingDate`, `covers`, `creationTimeBooking`) VALUES
(1, 1, '2016-11-24 00:00:00', 2, '2016-11-23 11:02:48'),
(2, 4, '2016-01-01 11:00:00', 17, '2016-11-24 15:07:32');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `lastName` varchar(60) NOT NULL,
  `firstName` varchar(60) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(60) NOT NULL,
  `postalCode` int(11) NOT NULL,
  `country` varchar(60) NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationTimeCustomer` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `customers`
--

INSERT INTO `customers` (`id`, `lastName`, `firstName`, `address`, `city`, `postalCode`, `country`, `birthday`, `phone`, `email`, `password`, `creationTimeCustomer`, `role`) VALUES
(1, 'pierre', 'noel', 'fqsfsqfqsf', 'sqfqsfqs', 7500, 'Bazingua', '2016-11-02', '000000000000', 'toto@toto.com', 'legrospassword', '2016-11-09 23:00:00', ''),
(2, 'dfzef', 'ezgezgze', 'zegezg', 'zegzeg', 75000, 'zegezg', '1940-01-11', 'dzgezgezg', 'admin', 'admin', '2016-11-23 16:36:43', ''),
(3, 'dfhrehr', 'h''(hu(''ju''(u''(u', 'ert"eryt"y', 'ryhery', 75000, 'tert"zt', '1952-04-18', 'regreyhre', 'pierrot', 'pierrot', '2016-11-23 16:41:47', ''),
(4, 'pierre', 'noel', 'azfzegezg', 'Paris', 75000, 'Bazingua', '1940-01-01', '000000000', 'admintest', '$2y$11$943dfb5104914a8774c86uLXWDir84iOofcpU0ht0jIjdG7Ot.Wiy', '2016-11-24 14:09:16', 'administrateur'),
(5, 'John', 'Doe', 'Adresse de test', 'Zamzibar', 75000, 'Le pays Imaginaire', '1940-01-01', '00-00-00-00-00', 'testresto', '$2y$11$aba27971892043e643e31Oru7P6L2OYif2C1RaNg8685TkLDo9RBS', '2016-12-15 11:30:48', 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `creationTimeOrder` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statuts` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`id`, `customerId`, `creationTimeOrder`, `statuts`) VALUES
(16, 4, '2016-11-30 12:43:10', 'checked'),
(17, 4, '2016-11-30 13:00:41', 'checked'),
(18, 4, '2016-11-30 13:02:45', 'pending');

-- --------------------------------------------------------

--
-- Structure de la table `ordersdetails`
--

CREATE TABLE `ordersdetails` (
  `id` int(11) NOT NULL,
  `orderNum` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `orderQuty` int(11) NOT NULL,
  `productName` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ordersdetails`
--

INSERT INTO `ordersdetails` (`id`, `orderNum`, `productId`, `orderQuty`, `productName`) VALUES
(30, 16, 1, 1, 'Coca-Cola'),
(31, 16, 4, 3, 'Carrot Cake'),
(32, 17, 1, 1, 'Coca-Cola'),
(33, 17, 4, 3, 'Carrot Cake'),
(34, 17, 3, 1, 'Bacon Cheeseburger'),
(35, 18, 1, 1, 'Coca-Cola'),
(36, 18, 4, 3, 'Carrot Cake'),
(37, 18, 3, 1, 'Bacon Cheeseburger');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `nameProduct` varchar(60) NOT NULL,
  `image` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `quantityInStock` int(11) NOT NULL,
  `buyPrice` double(11,2) NOT NULL,
  `salePrice` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `nameProduct`, `image`, `description`, `quantityInStock`, `buyPrice`, `salePrice`) VALUES
(1, 'Coca-Cola', 'coca.jpg', 'Mmmm, le Coca-Cola avec 10 morceaux de sucres et tout plein de caféine !', 71, 0.60, 3.00),
(2, 'Bagel Thon', 'bagel_thon.jpg', 'Notre bagel est constitué d''un pain moelleux avec des grains de sésame et du thon albacore, accompagné de feuilles de salade fraîche du jour  et d''une sauce renversante :-)', 20, 2.75, 5.50),
(3, 'Bacon Cheeseburger', 'bacon_cheeseburger.jpg', 'Ce délicieux cheeseburger contient un steak haché viande française de 150g ainsi que d''un buns grillé juste comme il faut, le tout accompagné de frites fraîches maison !', 11, 6.00, 12.50),
(4, 'Carrot Cake', 'carrot_cake.jpg', 'Le carrot cake maison ravira les plus gourmands et les puristes : tous les ingrédients sont naturels !\\r\\nÀ consommer sans modération', 3, 3.00, 6.75),
(5, 'Donut Chocolat', 'chocolate_donut.jpg', 'Les donuts sont fabriqués le matin même et sont recouvert d''une délicieuse sauce au chocolat !', 17, 3.00, 6.20),
(6, 'Dr. Pepper', 'drpepper.jpg', 'Son goût sucré avec de l''amande vous ravira !', 4, 0.50, 2.90),
(7, 'Milkshake', 'milkshake.jpg', 'Notre milkshake bien crémeux contient des morceaux d''Oréos et est accompagné de crème chantilly et de smarties en guise de topping. Il éblouira vos papilles !', 12, 2.00, 5.35),
(8, 'Frites', 'frites.jpg', 'Aaaaaah ces merveilleux bâtonnets de pomme de terre qui nous régalent depuis qu''on est petit. Venez déguster les notres, elles sont faites maison !', 127, 0.50, 2.50),
(9, 'Hot-dog', 'hotdog.jpeg', 'Le typique sandwitch américain avec sa saucisse cuite accompagnée de ketchup, moutarde, oignons ou encore une bonne mayonnaise dont nous avons le secret.', 55, 0.70, 3.50);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`);

--
-- Index pour la table `ordersdetails`
--
ALTER TABLE `ordersdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderNum` (`orderNum`,`productId`),
  ADD KEY `productId` (`productId`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `ordersdetails`
--
ALTER TABLE `ordersdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`id`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`id`);

--
-- Contraintes pour la table `ordersdetails`
--
ALTER TABLE `ordersdetails`
  ADD CONSTRAINT `ordersDetails_ibfk_1` FOREIGN KEY (`orderNum`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `ordersDetails_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
