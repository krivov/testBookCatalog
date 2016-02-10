# ************************************************************
# Sequel Pro SQL dump
# Версия 4500
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: 127.0.0.1 (MySQL 5.6.21)
# Схема: booktest
# Время создания: 2016-02-10 10:15:34 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы author
# ------------------------------------------------------------

DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;

INSERT INTO `author` (`id`, `firstname`, `middlename`, `lastname`)
VALUES
	(1,'Сергей','Александрович','Кривов'),
	(2,'Светлана','Валерьевна','Ласточкина'),
	(4,'Марина','Станиславна','Тигорская'),
	(5,'Зинар','Алказарович','Знак'),
	(6,'Алказар','Карлович','Сила'),
	(7,'Дмитрий','Сергеевич','Лазарь');

/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы book
# ------------------------------------------------------------

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;

INSERT INTO `book` (`id`, `name`, `date`, `picture`)
VALUES
	(2,'книга 2',NULL,''),
	(3,'книга 3',NULL,NULL),
	(4,'тут длинное название книги - текст',NULL,''),
	(7,'Интересная книжка','1986-02-19',''),
	(8,'Еще одна книжка','1986-02-19','8a71eb37fbcb846539d3e75ef81dcbde.jpeg'),
	(9,'Супер блокбастер','2016-02-01','fc16522b1ec83d88978ea5acd33afbce.jpeg'),
	(10,'Читать всем',NULL,NULL),
	(11,'Книга жизни',NULL,NULL),
	(12,'Интересно почитать',NULL,NULL);

/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы book_author
# ------------------------------------------------------------

DROP TABLE IF EXISTS `book_author`;

CREATE TABLE `book_author` (
  `id_book` int(11) unsigned NOT NULL,
  `id_author` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_book`,`id_author`),
  KEY `frn_author` (`id_author`),
  CONSTRAINT `frn_author` FOREIGN KEY (`id_author`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `frn_book` FOREIGN KEY (`id_book`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `book_author` WRITE;
/*!40000 ALTER TABLE `book_author` DISABLE KEYS */;

INSERT INTO `book_author` (`id_book`, `id_author`)
VALUES
	(2,1),
	(2,2),
	(4,4),
	(7,4),
	(8,4),
	(4,5),
	(9,5),
	(7,6),
	(8,6),
	(9,6);

/*!40000 ALTER TABLE `book_author` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
