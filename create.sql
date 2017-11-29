-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Stř 29. lis 2017, 16:21
-- Verze MySQL: 5.6.33
-- Verze PHP: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `xleont01`
--
CREATE DATABASE `xleont01` DEFAULT CHARACTER SET latin2 COLLATE latin2_czech_cs;
USE `xleont01`;

-- --------------------------------------------------------

--
-- Struktura tabulky `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id_course` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE latin2_czech_cs NOT NULL,
  `lector` text COLLATE latin2_czech_cs NOT NULL,
  `max_capacity` int(11) NOT NULL,
  `price_person` int(11) NOT NULL,
  `price_firm` int(11) NOT NULL,
  `cost_course` int(11) NOT NULL,
  `information` text COLLATE latin2_czech_cs NOT NULL,
  PRIMARY KEY (`id_course`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=14 ;

--
-- Vypisuji data pro tabulku `course`
--

INSERT INTO `course` (`id_course`, `name`, `lector`, `max_capacity`, `price_person`, `price_firm`, `cost_course`, `information`) VALUES
(1, 'Základní kurz PC pro začátečníky', 'Eliška Gruberová', 25, 800, 20000, 15000, 'Kurz pro zájemce, kteří doposud nemají s počítačem žádné zkušenosti. Probírá se ovládaní počítače, základní principy práce s operačním systémem MS Windows. Organizace dat na disku - soubory a složky. Práce s prohlížečem a vyhledávání na Internetu.'),
(2, 'Kurz operačního systému Linux', 'Jirka Polášek', 10, 1500, 15000, 10000, 'Předpokladem je znalost práce na počítači. V kurzu se proberou rozdíly operačního systému MS Windows a Linux, organizace složek a aplikací, základní příkazy v terminálu.'),
(3, 'Základní kurz HTML', 'Anna Svobodová', 10, 3000, 30000, 20000, 'Předpokladem je pokročilá znalost práce na počítači. Seznámení s HTML, tagy, vytváření základních stránek, rozložení stránek, vkládání obrázků a prvků.'),
(4, 'Kurz pro mírně pokročilé', 'Petr Vondrus', 25, 800, 20000, 15000, 'Předpokladem je základní znalost práce s počítačem. Probírá se podrobněji nastavenní počítače a práce s daty, MS Word a textové prohlížeče, základy MS Excel.'),
(5, 'Kurz MS Excel', 'Michal Král', 15, 2000, 30000, 20000, 'Předpokladem je základní znalost práce na počítači. Seznámení s programem MS Excel, pokročilé funkce, tabulky, grafy. Práce převážně pro kancelářské potřeby.'),
(6, 'Kurz MS PowerPoint', 'Martin Březina', 15, 2000, 30000, 20000, 'Předpokladem je základní znalost práce na počítači. Seznámení s programem MS PowerPoint, vytváření prezentací, pokročilé funkce, motivy, animace, tipy.');

-- --------------------------------------------------------

--
-- Struktura tabulky `listed_course`
--

CREATE TABLE IF NOT EXISTS `listed_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_course` int(11) NOT NULL,
  `city` varchar(50) COLLATE latin2_czech_cs NOT NULL,
  `number_logged` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=14 ;

--
-- Vypisuji data pro tabulku `listed_course`
--

INSERT INTO `listed_course` (`id`, `id_course`, `city`, `number_logged`, `date`) VALUES
(1, 1, 'Brno', 0, '2018-01-04'),
(2, 4, 'Praha', 10, '2017-12-14'),
(3, 4, 'Olomouc', 25, '2017-12-10'),
(4, 6, 'Brno', 1, '2018-01-11');

-- --------------------------------------------------------

--
-- Struktura tabulky `member_of_course`
--

CREATE TABLE IF NOT EXISTS `member_of_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `id_l_course` int(11) NOT NULL,
  `f_name` varchar(30) COLLATE latin2_czech_cs DEFAULT NULL,
  `l_name` varchar(30) COLLATE latin2_czech_cs DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=33 ;

--
-- Vypisuji data pro tabulku `member_of_course`
--

INSERT INTO `member_of_course` (`id`, `id_member`, `id_l_course`, `f_name`, `l_name`) VALUES
(4, 3, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_course` int(11) NOT NULL,
  `id_firm` int(11) NOT NULL,
  `city` varchar(50) COLLATE latin2_czech_cs NOT NULL,
  `dates` date NOT NULL,
  `accept` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=21 ;

--
-- Vypisuji data pro tabulku `order`
--

INSERT INTO `order` (`id`, `id_course`, `id_firm`, `city`, `dates`, `accept`) VALUES
(4, 1, 2, 'Bn', '2015-05-05', 1),
(5, 3, 2, 'Praha', '2017-11-29', 1),
(6, 1, 2, 'Bn', '2015-05-05', 1),
(7, 5, 2, 'Brno', '2017-11-30', 1),
(16, 3, 2, 'Ufa', '2017-11-23', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) COLLATE latin2_czech_cs NOT NULL,
  `password` varchar(20) COLLATE latin2_czech_cs NOT NULL,
  `first_name` varchar(30) COLLATE latin2_czech_cs NOT NULL,
  `last_name` varchar(50) COLLATE latin2_czech_cs NOT NULL,
  `firm` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=59 ;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `firm`) VALUES
(1, 'admin@vector.com', 'admin123', 'Petr', 'Kovar', 3),
(2, 'firma@praha.com', 'firma123', 'Jan', 'Novák', 1),
(3, 'member@brno.com', 'member123', 'Dana', 'Poláková', 0),
(56, 'asd@asd.asd', 'asdasd', 'asd', 'asd', 0),
(57, 'asdasd@asd.asd', 'asdasd', 'asd', 'asdasd', 1),
(58, 'adsasd@asd.asd', 'asdasd', 'asdasd', 'asd', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
