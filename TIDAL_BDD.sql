SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database name: TIDAL_BDD
--

-- --------------------------------------------------------

--
-- Struct of table: 'orders'
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int(3) NOT NULL AUTO_INCREMENT,
  `id_member` int(3) DEFAULT NULL,
  `amount` int(3) NOT NULL,
  `registration_date` datetime NOT NULL,
  `state` enum('being processed','sent','delivered') NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Content of table: 'orders'
--

INSERT INTO `orders` (`id_order`, `id_member`, `amount`, `registration_date`, `state`) VALUES
(1, 1, 299, '2020-11-08 14:44:46', 'sent');

-- --------------------------------------------------------

--
-- Struct of table: 'order_detail'
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `id_order_detail` int(3) NOT NULL AUTO_INCREMENT,
  `id_order` int(3) DEFAULT NULL,
  `id_product` int(3) DEFAULT NULL,
  `quantity` int(3) NOT NULL,
  `price` int(3) NOT NULL,
  PRIMARY KEY (`id_order_detail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Content of table: 'product_detail'
--

INSERT INTO `order_detail` (`id_order_detail`, `id_order`, `id_product`, `quantity`, `price`) VALUES
(1, 1, 2, 1, 15),
(2, 1, 6, 1, 49),
(3, 1, 8, 3, 79);

-- --------------------------------------------------------

--
-- Struct of table: 'member'
--  0 is lambda user, 1 is admin

CREATE TABLE IF NOT EXISTS `member` (
  `id_member` int(3) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `name` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civility` enum('m','f') NOT NULL,
  `city` varchar(20) NOT NULL,
  `postal_code` int(5) unsigned zerofill NOT NULL,
  `address` varchar(50) NOT NULL,
  `state` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_member`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Content of table: 'member'
--

INSERT INTO `member` (`id_member`, `pseudo`, `pwd`, `name`, `firstname`, `email`, `civility`, `city`, `postal_code`, `address`, `state`) VALUES
(1, 'Aiveo', 'GregoryMorel', 'Morandet', 'Louis', 'louis.morandet@hotmail.fr', 'm', 'Tournus', 71100, '4 rue de France', 1),
(2, 'NapoleonVII', 'Jaimeleprofdetidal', 'Laurent', 'Jeremy', 'Jeremy.laurent97@orange.fr', 'm', 'Macon', 69100, '17 rue de bourgogne', 1),
(3, 'leon', 'notroot', 'leon', 'lebuisson', 'Jeremy.laurent@cpe.fr', 'm', 'Macon', 69100, '17 rue de france', 0);

-- --------------------------------------------------------

--
-- Struct of table: 'product'
--

CREATE TABLE IF NOT EXISTS `product` (
  `id_product` int(3) NOT NULL AUTO_INCREMENT,
  `reference` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `color` varchar(20) NOT NULL,
  `size` varchar(5) NOT NULL,
  `public` enum('m','f','mixte') NOT NULL,
  `photo_path` varchar(250) NOT NULL,
  `price` int(3) NOT NULL,
  `stock` int(3) NOT NULL,
  PRIMARY KEY (`id_product`),
  UNIQUE KEY `reference` (`reference`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Content of table: 'product'
--

INSERT INTO `product` (`id_product`, `reference`, `category`, `title`, `description`, `color`, `size`, `public`, `photo_path`, `price`, `stock`) VALUES
(1, '11-d-23', 'tshirt', 'Tshirt Col V', 'Tee-shirt en coton flammé liseré contrastant', 'bleu', 'M', 'm', '11-d-23_bleu.jpg', 20, 53),
(2, '66-f-15', 'tshirt', 'Tshirt Col V rouge', 'c''est vraiment un super tshirt en soir&eacute;e !', 'rouge', 'L', 'm', '66-f-15_rouge.png', 15, 230),
(3, '88-g-77', 'tshirt', 'Tshirt Col rond vert', 'Il vous faut ce tshirt Made In France !!!', 'vert', 'L', 'm', '88-g-77_vert.png', 29, 63),
(4, '55-b-38', 'tshirt', 'Tshirt jaune', 'le jaune reviens &agrave; la mode, non? :-)', 'jaune', 'S', 'm', '55-b-38_jaune.png', 20, 3),
(5, '31-p-33', 'tshirt', 'Tshirt noir original', 'voici un tshirt noir tr&egrave;s original :p', 'noir', 'XL', 'm', '31-p-33_noir.jpg', 25, 80),
(6, '56-a-65', 'chemise', 'Chemise Blanche', 'Les chemises c''est bien mieux que les tshirts', 'blanc', 'L', 'm', '56-a-65_chemiseblanchem.jpg', 49, 73),
(7, '63-s-63', 'chemise', 'Chemise Noir', 'Comme vous pouvez le voir c''est une chemise noir...', 'noir', 'M', 'm', '63-s-63_chemisenoirm.jpg', 59, 120),
(8, '77-p-79', 'pull', 'Pull gris', 'Pull gris pour l''hiver', 'gris', 'XL', 'f', '77-p-79_pullgrism2.jpg', 79, 99);
