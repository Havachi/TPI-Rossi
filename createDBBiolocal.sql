-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           8.0.11 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Export de la structure de la base pour bio-local
CREATE DATABASE IF NOT EXISTS `naqq_bio-local`
USE `naqq_bio-local`;

-- Export de la structure de la table bio-local. orders
CREATE TABLE IF NOT EXISTS `orders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `orderPrice` float NOT NULL COMMENT 'The total of all product price at order date',
  `orderDate` timestamp NOT NULL,
  `orderStatus` int(11) DEFAULT '0' COMMENT '0 = In Progress; 1 = Delivered',
  PRIMARY KEY (`orderID`),
  KEY `users_orders_fk` (`userID`),
  CONSTRAINT `users_orders_fk` FOREIGN KEY (`userID`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Export de données de la table bio-local.orders : ~4 rows (environ)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`orderID`, `userID`, `orderPrice`, `orderDate`, `orderStatus`) VALUES
	(2, 21, 5, '2021-05-27 13:32:01', 0),
	(3, 18, 14.4, '2021-05-31 14:14:08', 0),
	(4, 19, 20.2, '2021-06-01 06:14:29', 0),
	(5, 19, 0.5, '2021-06-01 06:57:45', 0);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Export de la structure de la table bio-local. order_products
CREATE TABLE IF NOT EXISTS `order_products` (
  `orderProductID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `orderProductQuantity` int(11) NOT NULL,
  `orderProductPrice` int(11) DEFAULT NULL,
  PRIMARY KEY (`orderProductID`),
  KEY `product_ordered` (`productID`),
  KEY `order_products` (`orderID`),
  CONSTRAINT `orders_ordered_products_fk` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_ordered_products_fk` FOREIGN KEY (`productID`) REFERENCES `products` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Export de données de la table bio-local.order_products : ~11 rows (environ)
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
INSERT INTO `order_products` (`orderProductID`, `productID`, `orderID`, `orderProductQuantity`, `orderProductPrice`) VALUES
	(3, 5, 2, 6, 0),
	(4, 6, 2, 2, 1),
	(5, 3, 3, 5, 1),
	(6, 4, 3, 1, 1),
	(7, 2, 3, 1, 1),
	(8, 1, 3, 20, 0),
	(9, 2, 4, 22, 1),
	(10, 1, 4, 2, 0),
	(11, 4, 4, 8, 1),
	(12, 3, 4, 1, 1),
	(13, 2, 5, 1, 1);
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;

-- Export de la structure de la table bio-local. products
CREATE TABLE IF NOT EXISTS `products` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `supplyerID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` float NOT NULL,
  `productStock` int(11) NOT NULL,
  `productImagePath` varchar(50) NOT NULL,
  PRIMARY KEY (`productID`),
  KEY `supplyers_products_fk` (`supplyerID`),
  CONSTRAINT `supplyers_products_fk` FOREIGN KEY (`supplyerID`) REFERENCES `supplyers` (`supplyerid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Export de données de la table bio-local.products : ~7 rows (environ)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`productID`, `supplyerID`, `productName`, `productPrice`, `productStock`, `productImagePath`) VALUES
	(1, 1, 'Pomme Gala', 0.3, 100, '/fruits/pommes/gala'),
	(2, 1, 'Pomme de terre', 0.5, 150, '/racines/patates/pdt'),
	(3, 1, 'Patate Douce', 1.4, 40, '/racines/patates/douce'),
	(4, 1, 'Poireau vert', 0.9, 230, '/legumes/poireaux/vert'),
	(5, 2, 'Pomme Gala', 0.4, 150, '/fruits/pommes/gala'),
	(6, 3, 'Patate Douce', 1.3, 80, '/racines/patates/douce'),
	(7, 4, 'Tomates Cerise', 1, 100, '/legumes/tomates/cerise');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Export de la structure de la table bio-local. supplyers
CREATE TABLE IF NOT EXISTS `supplyers` (
  `supplyerID` int(11) NOT NULL AUTO_INCREMENT,
  `supplyerName` varchar(100) NOT NULL,
  `supplyerCP` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`supplyerID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Export de données de la table bio-local.supplyers : ~8 rows (environ)
/*!40000 ALTER TABLE `supplyers` DISABLE KEYS */;
INSERT INTO `supplyers` (`supplyerID`, `supplyerName`, `supplyerCP`) VALUES
	(1, 'Jean-Marc Quennoz', '1994'),
	(2, 'Frank Fruits & Légumes', '1450'),
	(3, 'S.A. Jerome', '1373'),
	(4, 'Jacque Fruit ', '1066'),
	(5, 'UsuFruit', '1860'),
	(6, 'Yverdon Fruit', '1400'),
	(7, 'SaxoFruit', '1907'),
	(8, 'Fruit d\'en-haut', '1996');
/*!40000 ALTER TABLE `supplyers` ENABLE KEYS */;

-- Export de la structure de la table bio-local. users
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userFirstname` varchar(50) NOT NULL,
  `userLastname` varchar(50) NOT NULL,
  `userAddressRoad` varchar(255) NOT NULL,
  `userAddressRoadNumber` tinyint(4) NOT NULL,
  `userAddressPostalCode` varchar(10) NOT NULL,
  `userPhoneNumber` varchar(20) DEFAULT NULL,
  `userEmailAddress` varchar(100) NOT NULL,
  `userIsAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `userPassword` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Export de données de la table bio-local.users : ~4 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`userID`, `userFirstname`, `userLastname`, `userAddressRoad`, `userAddressRoadNumber`, `userAddressPostalCode`, `userPhoneNumber`, `userEmailAddress`, `userIsAdmin`, `userPassword`) VALUES
	(18, 'Alessandro', 'Rossi', 'Rue des pommes', 1, '1994', '0774615634', 'Test@test.ch', 0, '$2y$11$br09mp2J.FbZq8Ay6Zvqt.JbDEF0L/al9ztQhbBYgiHsV6U3l095K'),
	(19, 'Machiatto', 'Pedroletti', 'Rue des pommes', 9, '1950', '0774615634', 'michael@pedroletti.ch', 0, '$2y$11$2EksbkSAIRbAhiCR7pc/J.oDqYZG7Gb8loV3PptgTRN5dL1whpAru'),
	(20, 'Alessandro', 'Rossi', 'Rue des pommes', 0, '1450', '0774615634', 'test', 0, '$2y$11$nF9IwHjp7k1MNiuyujtuk.tw.a9Ge71T439UfYla6PkMkXOWH2/w.'),
	(21, 'Alessandro', 'Rossi', 'Rue des pommes', 1, '1450', '0774615634', 'alessandro.rossi7610@gmail.com', 0, '$2y$11$CBOaX/tAa3AkoA.UHoQ/i.wpdrEcu4MsVMVY1BSXATgUgpDUIiYuG');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
