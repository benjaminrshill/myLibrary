# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.31)
# Database: myLibrary
# Generation Time: 2020-10-16 14:11:06 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table books
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `author` varchar(50) NOT NULL DEFAULT '',
  `year` smallint(4) NOT NULL,
  `category` varchar(20) NOT NULL DEFAULT '',
  `rating` smallint(1) DEFAULT NULL,
  `series` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;

INSERT INTO `books` (`id`, `title`, `author`, `year`, `category`, `rating`, `series`)
VALUES
	(1,'On the Road','Kerouac, Jack',1957,'Fiction',5,NULL),
	(2,'River Town','Hessler, Peter',2001,'Non-fiction',4,NULL),
	(3,'Paradise Lost','Milton, John',1667,'Fiction',3,NULL),
	(5,'Jurassic Park','Crichton, Michael',1990,'Fiction',5,NULL),
	(6,'Eye of the World','Jordan, Robert',1990,'Fiction',5,NULL),
	(7,'Small Gods','Pratchett, Terry',1992,'Fiction',4,NULL),
	(9,'Memoirs of a Geisha','Golden, Arthur',1997,'Fiction',5,NULL),
	(10,'Iliad, The','Homer',-800,'Fiction',3,NULL),
	(11,'Dance of the Voodoo Handbag, The','Rankin, Robert',1998,'Fiction',4,NULL),
	(12,'On Liberty','Mill, John Stuart',1859,'Non-fiction',4,NULL),
	(14,'Jungle Book, The','Kipling, Rudyard',1894,'Fiction',4,NULL),
	(15,'Sapiens','Harari, Yuval Noah',2011,'Non-fiction',5,NULL),
	(16,'Children of Time','Tchaikovsky, Adrian',2015,'Fiction',4,NULL),
	(17,'Blade Itself, The','Abercrombie, Joe',2006,'Fiction',5,NULL),
	(18,'Lies of Locke Lamora, The','Lynch, Scott',2006,'Fiction',5,NULL),
	(24,'Grapes of Wrath, The','Steinbeck, John',1939,'Fiction',5,NULL),
	(26,'Catch-22','Heller, Joseph',1961,'Fiction',5,NULL),
	(27,'Existentialism is a Humanism','Sartre, Jean-Paul',1946,'Non-fiction',4,NULL);

/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
