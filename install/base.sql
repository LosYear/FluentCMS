-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 19 2013 г., 23:27
-- Версия сервера: 5.5.30-log
-- Версия PHP: 5.4.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `fluent`
--

-- --------------------------------------------------------

--
-- Структура таблицы `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `comment` text,
  `subject` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `action`
--

INSERT INTO `action` (`id`, `title`, `comment`, `subject`) VALUES
(1, 'message_write', NULL, NULL),
(2, 'message_receive', NULL, NULL),
(3, 'user_create', NULL, NULL),
(4, 'user_update', NULL, NULL),
(5, 'user_remove', NULL, NULL),
(6, 'user_admin', NULL, NULL),
(7, 'action_test', 'Test', 'Test');

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `node_id` int(11) NOT NULL,
  `title_eng` text NOT NULL,
  `issue_id` int(11) NOT NULL,
  `tags_rus` text NOT NULL,
  `tags_eng` text NOT NULL,
  `aditional_authors` text NOT NULL,
  `annotation_rus` text NOT NULL,
  `annotation_eng` text NOT NULL,
  PRIMARY KEY (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`node_id`, `title_eng`, `issue_id`, `tags_rus`, `tags_eng`, `aditional_authors`, `annotation_rus`, `annotation_eng`) VALUES
(20, 'Article 1', 4, 'tag, tag, tag', 'tag, tag, tag', 'Вася, Петя', 'Описание', 'Annotation'),
(21, 'KDE Plasma Active запустили на Nexus 7', 4, 'tag', 'tag', 'habra, frol', 'KDE Plasma Active запустили на Nexus 7', 'KDE Plasma Active запустили на Nexus 7'),
(25, 'Office 2013 привязывается к одному компьютеру навсегда', 4, 'rat', 'er', 'ge', 'Office 2013 привязывается к одному компьютеру навсегда', 'Office 2013 привязывается к одному компьютеру навсегда');

-- --------------------------------------------------------

--
-- Структура таблицы `author_profile`
--

CREATE TABLE IF NOT EXISTS `author_profile` (
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `academic` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `author_profile`
--

INSERT INTO `author_profile` (`user_id`, `name`, `email`, `academic`) VALUES
(1, 'Лосев Ярослав', 'flexo.o@yandex.ru', 'Профессор государственного университета г. Мухосранска');

-- --------------------------------------------------------

--
-- Структура таблицы `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `author` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updater` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `block`
--

INSERT INTO `block` (`id`, `type`, `title`, `content`, `name`, `author`, `created`, `updated`, `updater`, `status`) VALUES
(2, 'html', 'Test Block', '<p>\r\n	ContenTetbt</p>\r\n', 'test', 1, '2012-08-30 14:57:36', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(2, 'Физ.тех направление'),
(3, 'Гуманитарное направление');

-- --------------------------------------------------------

--
-- Структура таблицы `certificate`
--

CREATE TABLE IF NOT EXISTS `certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `certificate`
--

INSERT INTO `certificate` (`id`, `title`, `user_id`, `file_name`) VALUES
(4, 'here', 1, 'certificate_1_1688111052.png'),
(5, 'Сертификат', 1, 'certificate_1_1033049408.png');

-- --------------------------------------------------------

--
-- Структура таблицы `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `year` date NOT NULL,
  `cover` text,
  `isOpened` int(11) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `issue`
--

INSERT INTO `issue` (`id`, `number`, `year`, `cover`, `isOpened`, `created`) VALUES
(4, 1, '2012-01-01', '', 1, '2013-02-17'),
(5, 2, '2013-02-01', '', 1, '2013-02-21'),
(6, 3, '2013-03-01', '', 1, '2013-02-22');

-- --------------------------------------------------------

--
-- Структура таблицы `mailbox_conversation`
--

CREATE TABLE IF NOT EXISTS `mailbox_conversation` (
  `conversation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `initiator_id` int(10) NOT NULL,
  `interlocutor_id` int(10) NOT NULL,
  `subject` varchar(100) NOT NULL DEFAULT '',
  `bm_read` tinyint(3) NOT NULL DEFAULT '0',
  `bm_deleted` tinyint(3) NOT NULL DEFAULT '0',
  `modified` int(10) unsigned NOT NULL,
  `is_system` enum('yes','no') NOT NULL DEFAULT 'no',
  `initiator_del` tinyint(1) unsigned DEFAULT '0',
  `interlocutor_del` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`conversation_id`),
  KEY `initiator_id` (`initiator_id`),
  KEY `interlocutor_id` (`interlocutor_id`),
  KEY `conversation_ts` (`modified`),
  KEY `subject` (`subject`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `mailbox_conversation`
--

INSERT INTO `mailbox_conversation` (`conversation_id`, `initiator_id`, `interlocutor_id`, `subject`, `bm_read`, `bm_deleted`, `modified`, `is_system`, `initiator_del`, `interlocutor_del`) VALUES
(1, 1, 2, '123', 3, 0, 1363542968, 'no', 0, 0),
(2, 1, 4, '123', 1, 0, 1363546122, 'no', 0, 0),
(3, 1, 2, '123', 1, 0, 1363545339, 'no', 0, 0),
(4, 1, 2, 'Test', 1, 0, 1363547398, 'no', 0, 0),
(5, 1, 2, 'Хэй', 1, 0, 1363547468, 'no', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `mailbox_message`
--

CREATE TABLE IF NOT EXISTS `mailbox_message` (
  `message_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` int(10) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  `sender_id` int(10) unsigned NOT NULL DEFAULT '0',
  `recipient_id` int(10) unsigned NOT NULL DEFAULT '0',
  `text` mediumtext NOT NULL,
  `crc64` bigint(20) NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `sender_profile_id` (`sender_id`),
  KEY `recipient_profile_id` (`recipient_id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `timestamp` (`created`),
  KEY `crc64` (`crc64`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `mailbox_message`
--

INSERT INTO `mailbox_message` (`message_id`, `conversation_id`, `created`, `sender_id`, `recipient_id`, `text`, `crc64`) VALUES
(1, 1, 1363299655, 1, 2, '124e', 144),
(2, 1, 1363299682, 1, 2, 'Haha you are asshole', 0),
(3, 2, 1363464042, 1, 4, '314e', 6324577),
(4, 2, 1363540763, 1, 4, 'heehe', 0),
(5, 2, 1363540772, 1, 4, 'hehe ', 416134),
(6, 1, 1363542968, 2, 1, 'Hi! How are you? I''m fine :DD', 356860384848),
(7, 3, 1363545339, 1, 2, '123rge', 632),
(8, 2, 1363546122, 1, 4, 'хехе', 538448),
(9, 4, 1363547398, 1, 2, 'Уе', 21568),
(10, 5, 1363547468, 1, 2, 'упк', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `title`, `name`, `description`, `status`) VALUES
(1, 'Title', 'Name', 'DDesc', 1),
(2, 'Test menu', 'test-menu', 'Test description', 0),
(3, 'Mudrenok Menu', 'mudrenok', 'Меню для мудренка', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `menu_item`
--

CREATE TABLE IF NOT EXISTS `menu_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `href` text NOT NULL,
  `type` text NOT NULL,
  `condition_name` text,
  `condition_denial` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `menu_item`
--

INSERT INTO `menu_item` (`id`, `parent_id`, `menu_id`, `title`, `href`, `type`, `condition_name`, `condition_denial`, `order`, `status`) VALUES
(2, 0, 2, 'Itemdgf', 'itemrer', 'internalgew', 'nonegr', 0, 1, 1),
(8, 0, 1, 'Новости', '#', 'internal', NULL, NULL, 0, 1),
(9, 0, 1, 'Проекты и анонсы', '#', 'internal', NULL, NULL, 0, 1),
(10, 0, 1, 'Авторам', '#', 'internal', NULL, NULL, 0, 1),
(11, 0, 1, 'Редакция', '#', 'internal', NULL, NULL, 0, 1),
(12, 0, 1, 'Обратная связь', '#', 'internal', NULL, NULL, 0, 1),
(13, 0, 3, 'Главная', '/', 'internal', NULL, NULL, 0, 1),
(14, 0, 3, 'О проекте', 'about.html', 'internal', NULL, NULL, 1, 1),
(15, 0, 3, 'Документы', 'documents.html', 'internal', NULL, NULL, 2, 1),
(16, 0, 3, 'Направления', 'categories.html', 'internal', NULL, NULL, 3, 1),
(17, 0, 3, 'Туры', 'tours.html', 'internal', NULL, NULL, 4, 1),
(18, 0, 3, 'Помощь', 'help.html', 'internal', NULL, NULL, 5, 1),
(19, 0, 3, 'Команды', 'profiles.html', 'internal', NULL, NULL, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(256) NOT NULL DEFAULT '',
  `body` text,
  `is_read` enum('0','1') NOT NULL DEFAULT '0',
  `deleted_by` enum('sender','receiver') DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender` (`sender_id`),
  KEY `reciever` (`receiver_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `subject`, `body`, `is_read`, `deleted_by`, `created_at`) VALUES
(1, 1, 2, '123', 'aefw', '0', NULL, '2012-11-06 13:31:14'),
(2, 1, 1, '123', '123', '1', NULL, '2012-11-06 14:41:31'),
(3, 1, -1, 'Minus', 'Minus', '0', NULL, '2012-11-06 14:49:37');

-- --------------------------------------------------------

--
-- Структура таблицы `node`
--

CREATE TABLE IF NOT EXISTS `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `author` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` int(11) DEFAULT NULL,
  `url` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `node`
--

INSERT INTO `node` (`id`, `type`, `title`, `content`, `author`, `created`, `updated`, `updater`, `url`, `status`) VALUES
(19, 'author/article', 'SuperTest123', '<p>\r\n	SuperTest123цау</p>\r\n', 1, '2012-10-30 13:17:23', '2012-10-30 10:15:47', 1, 'SuperTest123', '0'),
(20, 'author/article', 'Статья 1', '<p>\r\n	La la la</p>\r\n', 1, '2013-02-17 16:59:19', '2013-02-17 12:59:19', NULL, 'test1', '1'),
(21, 'author/article', 'KDE Plasma Active запустили на Nexus 7', '<p>\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;">Если вам интересна тема Ubuntu Phone, то вы просто обязаны знать о всех возможностях Linux-сообщества!</span><br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;">Ruediger Gad &mdash; Linux разработчик &mdash; опубликовал видео (под катом), на котором демонстрирует работу KDE Plasma Active на Nexus 7. Сейчас вы наверно подумали, очередной линукс, в очередной раз запустили, а тормозит ужасно и ничего не работает&hellip; А вот и нет! Демонстрируется поддержка 3D ускорителя в тесте попугаев glmark2-es2, аппаратное ускорение видео на примере 1080p ролика, играбельность в марио в эмуляторе, поддержку Bluetooth, QZeeControl в качестве беспроводного манипулятора.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<a name="habracut" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; vertical-align: baseline; outline: 0px; color: rgb(109, 163, 189); font-family: Verdana, sans-serif; line-height: 20px; background-color: rgb(255, 255, 255);"></a><br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;">Plasma Active &mdash; это проект KDE, предоставляющий модульную UX платформу для устройств различных форм-факторов (планшеты, смартфоны, трансформеры и т.д.).</span><br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;">Для тех, кто успел забыть что находится внутри&nbsp;</span><a href="https://www.google.com/nexus/7/specs/" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; vertical-align: baseline; outline: 0px; color: rgb(153, 0, 153); font-family: Verdana, sans-serif; line-height: 20px;">Google Nexus 7</a><span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;">:</span></p>\r\n<p>\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<ul style="margin: 0px 0px 0px 20px; padding-right: 0px; padding-left: 0px; border: 0px; font-size: 13px; vertical-align: baseline; outline: 0px; list-style-position: outside; list-style-image: initial; color: rgb(0, 0, 0); font-family: Verdana, sans-serif; line-height: 20px;">\r\n		<li style="margin: 0px 0px 0px 20px; padding: 0px; border: 0px; vertical-align: baseline; outline: 0px; list-style: disc outside;">\r\n			7&rdquo; 1280x800 (216ppi)</li>\r\n		<li style="margin: 0px 0px 0px 20px; padding: 0px; border: 0px; vertical-align: baseline; outline: 0px; list-style: disc outside;">\r\n			NVIDIA Tegra 3, quad-core ARM Cortex-A9</li>\r\n		<li style="margin: 0px 0px 0px 20px; padding: 0px; border: 0px; vertical-align: baseline; outline: 0px; list-style: disc outside;">\r\n			1GB RAM</li>\r\n		<li style="margin: 0px 0px 0px 20px; padding: 0px; border: 0px; vertical-align: baseline; outline: 0px; list-style: disc outside;">\r\n			16GB или 32GB ROM</li>\r\n		<li>\r\n			&nbsp;</li>\r\n	</ul>\r\n</p>\r\n', 1, '2013-02-17 17:03:55', '2013-02-17 13:03:55', NULL, 'kde-plasma', '1'),
(25, 'author/article', 'Office 2013 привязывается к одному компьютеру навсегда', '<p>\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;">Несмотря на то, что для большинства программ мы можем пролистывать пользовательские соглашения без особых последствий, есть смысл прочитать условия, которые ставит Microsoft для розничных копий Office 2013, перед тем, как потратить на него от 100 до 500 долларов, т.к. по сравнению с предыдущими версиями в них изменились две ключевых части.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;">Если вы приобрели розничную редакцию Office 2010, EULA (end-user license agreement, лицензионное соглашение конечного пользователя) разрешает вам устанавливать его одновременно на два компьютера (настольный и ноутбук). При этом, если вы заменяете один из них, то лицензия переносится на новый.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<a name="habracut" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; vertical-align: baseline; outline: 0px; color: rgb(109, 163, 189); font-family: Verdana, sans-serif; line-height: 20px; background-color: rgb(255, 255, 255);"></a><br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;">Для Office 2013 не разрешено ни то, ни другое: изменённая версия EULA фирмы Microsoft разрешает вам устанавливать коробочные версии на один компьютер, и только на именно этот компьютер &mdash; навсегда. Если я правильно понял условия (по-моему, они предельно ясны), вам не разрешается переносить свою лицензию:</span></p>\r\n<p>\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<blockquote style="margin: 0.83em 0px; padding: 0px 0px 0px 15px; border-width: 0px 0px 0px 2px; border-left-style: solid; border-left-color: rgb(187, 187, 187); font-size: 13px; vertical-align: baseline; outline: 0px; quotes: none; clear: both; color: rgb(0, 0, 0); font-family: Verdana, sans-serif; line-height: 20px;">\r\n		<i style="margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; outline: 0px;">Can I transfer the software to another computer or user?</i>&nbsp;You may not transfer the software to another computer or user. You may transfer the software directly to a third party only as installed on the licensed computer, with the Certificate of Authenticity label and this agreement. Before the transfer, that party must agree that this agreement applies to the transfer and use of the software. You may not retain any copies.</blockquote>\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;">Не уверен, насколько новая эта новость, но она явно не получила того внимания, которого заслуживает. Ведь изменённая версия EULA фактически понижает статус розничных версий до статуса OEM, т.к. она до смешного урезана, принимая во внимание цену Office &mdash; особенно профессиональной редакции. Вы ведь не собираетесь потратить ещё 500 баксов на новую копию, если, скажем, компьютер сломается?</span><br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<img align="left" src="http://habrastorage.org/storage2/753/939/bae/753939baebbe96da0478c2fca56fbf7e.jpg" style="margin: 5px 30px 5px 0px; padding: 0px; border: 0px; font-size: 13px; vertical-align: middle; outline: 0px; max-width: 100%; color: rgb(0, 0, 0); font-family: Verdana, sans-serif; line-height: 20px;" /><span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;">Процитрованный выше текст EULA предполагает именно это, но&nbsp;</span><a href="http://www.theage.com.au/technology/technology-news/does-your-copy-of-office-2013-die-with-your-computer-20130208-2e3a1.html" style="margin: 0px; padding: 0px; border: 0px; font-size: 13px; vertical-align: baseline; outline: 0px; color: rgb(153, 0, 153); font-family: Verdana, sans-serif; line-height: 20px;">Adam Turner из The Age</a><span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;">&nbsp;намеревается получить конкретное разъяснение прямо от Microsoft. После нескольких разочаровывающих разговоров с PR-отделом и техподдержкой компании (последняя оказалась полностью не в курсе новых условий), Turner получил честный ответ: &laquo;Нет, пользователь не может переносить свою лицензию с одного компьютера на другой&raquo;.</span><br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<br style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;" />\r\n	<span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13px; line-height: 20px;">Это оставляет неясным, как эта политика может быть претворена в жизнь, но Turner предполагает, что это может быть сделано через ваш облачный аккаунт Microsoft. Также неясно, как Office 2013 определяет, что считать новым компьютером. Накроется ли ваша лицензия после апгрейда памяти? Turner говорит, что он всё ещё ждёт ответов на эти вопросы, но даже получение комментария, приведенного выше, заняло несколько дней общения с Microsoft.</span></p>\r\n', 1, '2013-02-17 17:15:10', '2013-02-17 13:15:10', NULL, 'office', '1'),
(26, 'news', 'Title', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>\r\n', 1, '2013-03-13 23:09:30', '2013-03-13 19:09:30', NULL, 'article1', '1'),
(27, 'news', 'Title', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>', 1, '2013-03-13 23:09:52', '2013-03-13 19:09:52', NULL, 'article2', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `principal_id` int(11) NOT NULL,
  `subordinate_id` int(11) NOT NULL DEFAULT '0',
  `type` enum('user','role') NOT NULL,
  `action` int(11) NOT NULL,
  `template` tinyint(1) NOT NULL,
  `comment` text,
  PRIMARY KEY (`principal_id`,`subordinate_id`,`type`,`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `permission`
--

INSERT INTO `permission` (`principal_id`, `subordinate_id`, `type`, `action`, `template`, `comment`) VALUES
(1, 0, 'user', 1, 0, ''),
(1, 0, 'user', 6, 0, ''),
(1, 0, 'role', 4, 0, ''),
(1, 0, 'role', 5, 0, ''),
(1, 0, 'role', 6, 0, ''),
(1, 0, 'role', 7, 0, ''),
(2, 0, 'role', 1, 0, 'Users can write messagse'),
(2, 0, 'role', 2, 0, 'Users can receive messagse'),
(2, 0, 'role', 3, 0, 'Users are able to view visits of his profile'),
(5, 0, 'role', 1, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `privacysetting`
--

CREATE TABLE IF NOT EXISTS `privacysetting` (
  `user_id` int(10) unsigned NOT NULL,
  `message_new_friendship` tinyint(1) NOT NULL DEFAULT '1',
  `message_new_message` tinyint(1) NOT NULL DEFAULT '1',
  `message_new_profilecomment` tinyint(1) NOT NULL DEFAULT '1',
  `appear_in_search` tinyint(1) NOT NULL DEFAULT '1',
  `show_online_status` tinyint(1) NOT NULL DEFAULT '1',
  `log_profile_visits` tinyint(1) NOT NULL DEFAULT '1',
  `ignore_users` varchar(255) DEFAULT NULL,
  `public_profile_fields` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `privacysetting`
--

INSERT INTO `privacysetting` (`user_id`, `message_new_friendship`, `message_new_message`, `message_new_profilecomment`, `appear_in_search`, `show_online_status`, `log_profile_visits`, `ignore_users`, `public_profile_fields`) VALUES
(1, 1, 1, 1, 1, 1, 1, '', NULL),
(2, 1, 1, 1, 1, 1, 1, NULL, NULL),
(4, 1, 1, 1, 1, 1, 1, '', NULL),
(5, 1, 1, 1, 1, 1, 1, '', NULL),
(6, 1, 1, 1, 1, 1, 1, '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `privacy` enum('protected','private','public') NOT NULL,
  `show_friends` tinyint(1) DEFAULT '1',
  `allow_comments` tinyint(1) DEFAULT '1',
  `about` text,
  `name` varchar(255) DEFAULT NULL,
  `teacher` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `timestamp`, `privacy`, `show_friends`, `allow_comments`, `about`, `name`, `teacher`, `city`, `school`, `email`) VALUES
(1, 1, '2013-03-12 18:51:57', 'protected', 1, 1, 'About text', 'Название', 'Иванов И.И', 'Москва', 'Школа 1800', 'a@a.ru'),
(2, 2, '2012-08-13 08:08:13', 'protected', 1, 1, NULL, '', '', '', '', ''),
(3, 3, '2012-08-20 19:49:12', 'protected', 1, 1, NULL, '', '', '', '', ''),
(4, 4, '2012-08-20 19:50:05', 'protected', 1, 1, NULL, '', '', '', '', ''),
(5, 6, '2013-02-03 18:04:54', 'protected', 1, 1, '', '', '', '', '', ''),
(6, 7, '0000-00-00 00:00:00', 'protected', 1, 1, '', '', '', '', '', 'moderator@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `profile_comment`
--

CREATE TABLE IF NOT EXISTS `profile_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `profile_field`
--

CREATE TABLE IF NOT EXISTS `profile_field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `hint` text NOT NULL,
  `field_type` varchar(50) NOT NULL DEFAULT '',
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(255) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  `related_field_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `profile_field`
--

INSERT INTO `profile_field` (`id`, `varname`, `title`, `hint`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `position`, `visible`, `related_field_name`) VALUES
(6, 'about', 'О команде', '', 'TEXT', 255, 0, 0, '', '', '', '', '', 5, 4, ''),
(7, 'name', 'Название команды', '', 'VARCHAR', 255, 0, 0, '', '', '', '', '', 1, 4, ''),
(8, 'teacher', 'Руководитель', '', 'VARCHAR', 255, 0, 0, '', '', '', '', '', 2, 4, ''),
(9, 'city', 'Город', '', 'VARCHAR', 255, 0, 0, '', '', '', '', '', 3, 4, ''),
(10, 'school', 'Школа', '', 'VARCHAR', 255, 0, 0, '', '', '', '', '', 4, 4, ''),
(12, 'email', 'Email', '', 'VARCHAR', 255, 0, 1, '', '', '', 'CEmailValidator', '', 0, 4, '');

-- --------------------------------------------------------

--
-- Структура таблицы `profile_visit`
--

CREATE TABLE IF NOT EXISTS `profile_visit` (
  `visitor_id` int(11) NOT NULL,
  `visited_id` int(11) NOT NULL,
  `timestamp_first_visit` int(11) NOT NULL,
  `timestamp_last_visit` int(11) NOT NULL,
  `num_of_visits` int(11) NOT NULL,
  PRIMARY KEY (`visitor_id`,`visited_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `profile_visit`
--

INSERT INTO `profile_visit` (`visitor_id`, `visited_id`, `timestamp_first_visit`, `timestamp_last_visit`, `num_of_visits`) VALUES
(1, 2, 1363108037, 1363108037, 1),
(1, 3, 1362774633, 1363115571, 3),
(1, 4, 1362909824, 1362909824, 1),
(1, 5, 1362909829, 1362909829, 1),
(2, 1, 1362422598, 1363721121, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `json` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `results`
--

INSERT INTO `results` (`id`, `user_id`, `tour_id`, `points`, `json`) VALUES
(2, 2, 2, 2, ''),
(3, 1, 2, -1, ''),
(4, 1, 2, -1, ''),
(5, 1, 3, -1, '{"file":"answer3_1.txt"}'),
(6, 1, 1, 2, '{"points":2,"requests":6,"current":7,"answers":{"1":{"answer":"undef","status":"-"},"2":{"answer":"undef","status":"-"},"3":{"answer":"undef","status":"-"},"4":{"answer":"1","status":"-"},"5":{"answer":"3","status":"+"},"6":{"answer":"1","status":"+"}}}');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_membership_possible` tinyint(1) NOT NULL DEFAULT '0',
  `price` double DEFAULT NULL COMMENT 'Price (when using membership module)',
  `duration` int(11) DEFAULT NULL COMMENT 'How long a membership is valid',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `title`, `description`, `is_membership_possible`, `price`, `duration`) VALUES
(1, 'UserManager', 'This users can manage Users', 0, 0, 0),
(2, 'Demo', 'Users having the demo role', 0, 0, 0),
(3, 'Business', 'Example Business account', 0, 9.99, 7),
(4, 'Premium', 'Example Premium account', 0, 19.99, 28),
(5, 'TestRole', 'Here is test role for test proposes', 0, NULL, NULL),
(6, 'Moderator', 'Модераторы. Проверяющие. Имеют доступ к личному кабинету участника', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `key` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `task` text NOT NULL,
  `advanced` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `tour_id`, `type`, `task`, `advanced`) VALUES
(8, 1, 'question', '<p>\r\n	1+1</p>\r\n', '{"answers":["2","3","4","5"],"points":"1","time":"20","right_answer":"1"}'),
(9, 1, 'question', '<p>\r\n	2+2</p>\r\n', '{"answers":["1","4","3","2"],"points":"1","time":"20","right_answer":"2"}'),
(10, 1, 'question', '<p>\r\n	3+3</p>\r\n', '{"answers":["%u0428%u0435%u0441%u0442%u044C","%u0421%u0435%u043C%u044C","%u0412%u043E%u0441%u0435%u043C%u044C","%u041D%u043E%u043B%u044C"],"points":"1","time":"20","right_answer":"1"}'),
(11, 1, 'question', '<p>\r\n	4+4</p>\r\n', '{"answers":["Ноль","Восемь","Девять","Сто"],"points":"1","time":"20","right_answer":"2"}'),
(12, 1, 'question', '<p>\r\n	5+5</p>\r\n', '{"answers":["Ноль","Девять","Десять"],"points":"1","time":"30","right_answer":"3"}'),
(13, 1, 'question', '<p>\r\n	Ты сможешь сломать мой движок? &#39; &quot; &quot; &#39;&#39;&#39;&#39;&quot;&quot;&quot; \\ / &lt; &gt; &quot;&quot;</p>\r\n', '{"answers":["%27","%22","%3C","%3E","%5C/%20%27%27%27%20%22%22%22%20%3C%3C%3C%3E%3E"],"points":"1","time":"70","right_answer":"1"}'),
(19, 3, 'file', 'task_3_18446.txt', '-'),
(20, 3, 'file', 'task_3_20188.txt', '-'),
(21, 3, 'file', 'task_3_19429.txt', '-'),
(22, 3, 'file', 'task_3_29730.txt', '{"title":"\\u0417\\u0430\\u0433\\u043e\\u043b\\u043e\\u0432\\u043e\\u0447\\u0435\\u043a"}');

-- --------------------------------------------------------

--
-- Структура таблицы `tmp_results`
--

CREATE TABLE IF NOT EXISTS `tmp_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `json` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `tmp_results`
--

INSERT INTO `tmp_results` (`id`, `user_id`, `tour_id`, `json`) VALUES
(5, 1, 1, '{"points":2,"requests":6,"current":7,"answers":{"1":{"answer":"undef","status":"-"},"2":{"answer":"undef","status":"-"},"3":{"answer":"undef","status":"-"},"4":{"answer":"1","status":"-"},"5":{"answer":"3","status":"+"},"6":{"answer":"1","status":"+"}}}');

-- --------------------------------------------------------

--
-- Структура таблицы `tour`
--

CREATE TABLE IF NOT EXISTS `tour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `from` datetime NOT NULL,
  `till` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tour`
--

INSERT INTO `tour` (`id`, `name`, `description`, `category_id`, `type`, `from`, `till`) VALUES
(1, 'Test tour', 'Тестируем систему', 3, 'test', '2013-02-26 12:50:00', '2014-02-28 11:50:00'),
(2, 'Tes2', 'Test Description', 3, 'full', '2013-02-26 12:29:00', '2013-02-26 18:41:00'),
(3, 'Полный тур', 'Длительность год. ', 2, 'full', '2013-03-04 18:15:00', '2014-03-04 18:15:00');

-- --------------------------------------------------------

--
-- Структура таблицы `translation`
--

CREATE TABLE IF NOT EXISTS `translation` (
  `message` varbinary(255) NOT NULL,
  `translation` varchar(255) NOT NULL,
  `language` varchar(5) NOT NULL,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`message`,`language`,`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `translation`
--

INSERT INTO `translation` (`message`, `translation`, `language`, `category`) VALUES
('Active', 'ÐÐºÑ‚Ð¸Ð²Ð¸Ñ€Ð¾Ð²Ð°Ð½', 'ru', 'yum'),
('Allowed lowercase letters and digits.', 'Ð”Ð¾Ð¿ÑƒÑÐºÐ°ÑŽÑ‚ÑÑ ÑÑ‚Ñ€Ð¾Ñ‡Ð½Ñ‹Ðµ Ð±ÑƒÐºÐ²Ñ‹ Ð¸ Ñ†Ð¸Ñ„Ñ€Ñ‹.', 'ru', 'yum'),
('Already exists.', 'Ð£Ð¶Ðµ ÑÑƒÑ‰ÐµÑÑ‚Ð²ÑƒÐµÑ‚.', 'ru', 'yum'),
('Are you sure to delete this item?', 'Ð’Ñ‹ Ð´ÐµÐ¹ÑÑ‚Ð²Ð¸Ñ‚ÐµÐ»ÑŒÐ½Ð¾ Ñ…Ð¾Ñ‚Ð¸Ñ‚Ðµ ÑƒÐ´Ð°Ð»Ð¸Ñ‚ÑŒ Ð¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»Ñ?', 'ru', 'yum'),
('Banned', 'Ð—Ð°Ð±Ð»Ð¾ÐºÐ¸Ñ€Ð¾Ð²Ð°Ð½', 'ru', 'yum'),
('Change Password', 'Ð˜Ð·Ð¼ÐµÐ½Ð¸Ñ‚ÑŒ Ð¿Ð°Ñ€Ð¾Ð»ÑŒ', 'ru', 'yum'),
('Changes is saved.', 'Ð˜Ð·Ð¼ÐµÐ½ÐµÐ½Ð¸Ñ ÑÐ¾Ñ…Ñ€Ð°Ð½ÐµÐ½Ñ‹.', 'ru', 'yum'),
('Create', 'ÐÐ¾Ð²Ñ‹Ð¹', 'ru', 'yum'),
('Create Profile Field', 'Ð”Ð¾Ð±Ð°Ð²Ð¸Ñ‚ÑŒ', 'ru', 'yum'),
('Create User', 'ÐÐ¾Ð²Ñ‹Ð¹', 'ru', 'yum'),
('Default', 'ÐŸÐ¾ ÑƒÐ¼Ð¾Ð»Ñ‡Ð°Ð½Ð¸ÑŽ', 'ru', 'yum'),
('Delete Profile Field', 'Ð£Ð´Ð°Ð»Ð¸Ñ‚ÑŒ', 'ru', 'yum'),
('Delete User', 'Ð£Ð´Ð°Ð»Ð¸Ñ‚ÑŒ', 'ru', 'yum'),
('Display order of fields.', 'ÐŸÐ¾Ñ€ÑÐ´Ð¾Ðº Ð¾Ñ‚Ð¾Ð±Ñ€Ð°Ð¶ÐµÐ½Ð¸Ñ Ð¿Ð¾Ð»ÐµÐ¹.', 'ru', 'yum'),
('E-mail', 'Ð­Ð»ÐµÐºÑ‚Ñ€Ð¾Ð½Ð½Ð°Ñ Ð¿Ð¾Ñ‡Ñ‚Ð°', 'ru', 'yum'),
('Edit', 'Ð ÐµÐ´Ð°ÐºÑ‚Ð¸Ñ€Ð¾Ð²Ð°Ñ‚ÑŒ', 'ru', 'yum'),
('Edit profile', 'Ð ÐµÐ´Ð°ÐºÑ‚Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð¸Ðµ Ð¿Ñ€Ð¾Ñ„Ð¸Ð»Ñ', 'ru', 'yum'),
('Email is incorrect.', 'ÐŸÐ¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»ÑŒ Ñ Ñ‚Ð°ÐºÐ¸Ð¼ ÑÐ»ÐµÐºÑ‚Ñ€Ð¾Ð½Ñ‹Ð¼ Ð°Ð´Ñ€ÐµÑÐ¾Ð¼ Ð½Ðµ Ð·Ð°Ñ€ÐµÐ³Ð¸ÑÑ‚Ñ€Ð¸Ñ€Ð¾Ð²Ð°Ð½.', 'ru', 'yum'),
('Error Message', 'Ð¡Ð¾Ð¾Ð±Ñ‰ÐµÐ½Ð¸Ðµ Ð¾Ð± Ð¾ÑˆÐ¸Ð±ÐºÐµ', 'ru', 'yum'),
('Error message when you validate the form.', 'Ð¡Ð¾Ð¾Ð±Ñ‰ÐµÐ½Ð¸Ðµ Ð¾Ð± Ð¾ÑˆÐ¸Ð±ÐºÐµ Ð¿Ñ€Ð¸ Ð¿Ñ€Ð¾Ð²ÐµÑ€ÐºÐµ Ñ„Ð¾Ñ€Ð¼Ñ‹.', 'ru', 'yum'),
('Field Size', 'Ð Ð°Ð·Ð¼ÐµÑ€ Ð¿Ð¾Ð»Ñ', 'ru', 'yum'),
('Field Size min', 'ÐœÐ¸Ð½Ð¸Ð¼Ð°Ð»ÑŒÐ½Ð¾Ðµ Ð·Ð½Ð°Ñ‡ÐµÐ½Ð¸Ðµ', 'ru', 'yum'),
('Field Type', 'Ð¢Ð¸Ð¿ Ð¿Ð¾Ð»Ñ', 'ru', 'yum'),
('Field name on the language of "sourceLanguage".', 'ÐÐ°Ð·Ð²Ð°Ð½Ð¸Ðµ Ð¿Ð¾Ð»Ñ Ð½Ð° ÑÐ·Ñ‹ÐºÐµ "sourceLanguage".', 'ru', 'yum'),
('Field size column in the database.', 'Ð Ð°Ð·Ð¼ÐµÑ€ Ð¿Ð¾Ð»Ñ ÐºÐ¾Ð»Ð¾Ð½ÐºÐ¸ Ð² Ð±Ð°Ð·Ðµ Ð´Ð°Ð½Ð½Ñ‹Ñ…', 'ru', 'yum'),
('Field type column in the database.', 'Ð¢Ð¸Ð¿ Ð¿Ð¾Ð»Ñ ÐºÐ¾Ð»Ð¾Ð½ÐºÐ¸ Ð² Ð±Ð°Ð·Ðµ Ð´Ð°Ð½Ð½Ñ‹Ñ….', 'ru', 'yum'),
('First Name', 'Ð˜Ð¼Ñ', 'ru', 'yum'),
('For all', 'Ð”Ð»Ñ Ð²ÑÐµÑ…', 'ru', 'yum'),
('Hidden', 'Ð¡ÐºÑ€Ñ‹Ñ‚', 'ru', 'yum'),
('Incorrect activation URL.', 'ÐÐµÐ¿Ñ€Ð°Ð²Ð¸Ð»ÑŒÐ½Ð°Ñ ÑÑÑ‹Ð»ÐºÐ° Ð°ÐºÑ‚Ð¸Ð²Ð°Ñ†Ð¸Ð¸ ÑƒÑ‡ÐµÑ‚Ð½Ð¾Ð¹ Ð·Ð°Ð¿Ð¸ÑÐ¸.', 'ru', 'yum'),
('Incorrect password (minimal length 4 symbols).', 'ÐœÐ¸Ð½Ð¸Ð¼Ð°Ð»ÑŒÐ½Ð°Ñ Ð´Ð»Ð¸Ð½Ð° Ð¿Ð°Ñ€Ð¾Ð»Ñ 4 ÑÐ¸Ð¼Ð²Ð¾Ð»Ð°.', 'ru', 'yum'),
('Incorrect recovery link.', 'ÐÐµÐ¿Ñ€Ð°Ð²Ð¸Ð»ÑŒÐ½Ð°Ñ ÑÑÑ‹Ð»ÐºÐ° Ð²Ð¾ÑÑ‚Ð°Ð½Ð¾Ð²Ð»ÐµÐ½Ð¸Ñ Ð¿Ð°Ñ€Ð¾Ð»Ñ.', 'ru', 'yum'),
('Incorrect symbol''s. (A-z0-9)', 'Ð’ Ð¸Ð¼ÐµÐ½Ð¸ Ð¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»Ñ Ð´Ð¾Ð¿ÑƒÑÐºÐ°ÑŽÑ‚ÑÑ Ñ‚Ð¾Ð»ÑŒÐºÐ¾ Ð»Ð°Ñ‚Ð¸Ð½ÑÐºÐ¸Ðµ Ð±ÑƒÐºÐ²Ñ‹ Ð¸ Ñ†Ð¸Ñ„Ñ€Ñ‹.', 'ru', 'yum'),
('Incorrect username (length between 3 and 20 characters).', 'Ð”Ð»Ð¸Ð½Ð° Ð¸Ð¼ÐµÐ½Ð¸ Ð¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»Ñ Ð¾Ñ‚ 3 Ð´Ð¾ 20 ÑÐ¸Ð¼Ð²Ð¾Ð»Ð¾Ð².', 'ru', 'yum'),
('Last Name', 'Ð¤Ð°Ð¼Ð¸Ð»Ð¸Ñ', 'ru', 'yum'),
('Last visit', 'ÐŸÐ¾ÑÐ»ÐµÐ´Ð½Ð¸Ð¹ Ð²Ð¸Ð·Ð¸Ñ‚', 'ru', 'yum'),
('Letters are not case-sensitive.', 'Ð ÐµÐ³Ð¸ÑÑ‚Ñ€ Ð·Ð½Ð°Ñ‡ÐµÐ½Ð¸Ðµ Ð½Ðµ Ð¸Ð¼ÐµÐµÑ‚.', 'ru', 'yum'),
('List Profile Field', 'Ð¡Ð¿Ð¸ÑÐ¾Ðº', 'ru', 'yum'),
('List User', 'Ð¡Ð¿Ð¸ÑÐ¾Ðº Ð¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»ÐµÐ¹', 'ru', 'yum'),
('Login', 'Ð’Ñ…Ð¾Ð´', 'ru', 'yum'),
('Logout', 'Ð’Ñ‹Ð¹Ñ‚Ð¸', 'ru', 'yum'),
('Lost Password?', 'Ð—Ð°Ð±Ñ‹Ð»Ð¸ Ð¿Ð°Ñ€Ð¾Ð»ÑŒ?', 'ru', 'yum'),
('Manage', 'Ð£Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ', 'ru', 'yum'),
('Manage Profile Field', 'ÐÐ°ÑÑ‚Ñ€Ð¾Ð¹ÐºÐ° Ð¿Ð¾Ð»ÐµÐ¹', 'ru', 'yum'),
('Manage Profile Fields', 'ÐÐ°ÑÑ‚Ñ€Ð¾Ð¹ÐºÐ° Ð¿Ð¾Ð»ÐµÐ¹', 'ru', 'yum'),
('Manage User', 'Ð£Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¸Ðµ Ð¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»ÑÐ¼Ð¸', 'ru', 'yum'),
('Match', 'Ð¡Ð¾Ð²Ð¿Ð°Ð´ÐµÐ½Ð¸Ðµ (RegExp)', 'ru', 'yum'),
('Minimal password length 4 symbols.', 'ÐœÐ¸Ð½Ð¸Ð¼Ð°Ð»ÑŒÐ½Ð°Ñ Ð´Ð»Ð¸Ð½Ð° Ð¿Ð°Ñ€Ð¾Ð»Ñ 4 ÑÐ¸Ð¼Ð²Ð¾Ð»Ð°.', 'ru', 'yum'),
('New password is saved.', 'ÐÐ¾Ð²Ñ‹Ð¹ Ð¿Ð°Ñ€Ð¾Ð»ÑŒ ÑÐ¾Ñ…Ñ€Ð°Ð½ÐµÐ½.', 'ru', 'yum'),
('No', 'ÐÐµÑ‚', 'ru', 'yum'),
('No, but show on registration form', 'ÐÐµÑ‚, Ð½Ð¾ Ð¿Ð¾ÐºÐ°Ð·Ð°Ñ‚ÑŒ Ð¿Ñ€Ð¸ Ñ€ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ð¸', 'ru', 'yum'),
('Not active', 'ÐÐµ Ð°ÐºÑ‚Ð¸Ð²Ð¸Ñ€Ð¾Ð²Ð°Ð½', 'ru', 'yum'),
('Ok', 'Ok', 'ru', 'yum'),
('Only owner', 'Ð¢Ð¾Ð»ÑŒÐºÐ¾ Ð²Ð»Ð°Ð´ÐµÐ»ÐµÑ†', 'ru', 'yum'),
('Other Validator', 'Ð”Ñ€ÑƒÐ³Ð¾Ð¹ Ð²Ð°Ð»Ð¸Ð´Ð°Ñ‚Ð¾Ñ€', 'ru', 'yum'),
('Password is incorrect.', 'ÐÐµÐ²ÐµÑ€Ð½Ñ‹Ð¹ Ð¿Ð°Ñ€Ð¾Ð»ÑŒ.', 'ru', 'yum'),
('Please check your email. An instructions was sent to your email address.', 'ÐÐ° Ð’Ð°Ñˆ Ð°Ð´Ñ€ÐµÑ ÑÐ»ÐµÐºÑ‚Ñ€Ð¾Ð½Ð½Ð¾Ð¹ Ð¿Ð¾Ñ‡Ñ‚Ñ‹ Ð±Ñ‹Ð»Ð¾ Ð¾Ñ‚Ð¿Ñ€Ð°Ð²Ð»ÐµÐ½Ð¾ Ð¿Ð¸ÑÑŒÐ¼Ð¾ Ñ Ð¸Ð½ÑÑ‚Ñ€ÑƒÐºÑ†Ð¸ÑÐ¼Ð¸.', 'ru', 'yum'),
('Please enter the letters as they are shown in the image above.', 'ÐŸÐ¾Ð¶Ð°Ð»ÑƒÐ¹ÑÑ‚Ð°, Ð²Ð²ÐµÐ´Ð¸Ñ‚Ðµ Ð±ÑƒÐºÐ²Ñ‹, Ð¿Ð¾ÐºÐ°Ð·Ð°Ð½Ð½Ñ‹Ðµ Ð½Ð° ÐºÐ°Ñ€Ñ‚Ð¸Ð½ÐºÐµ Ð²Ñ‹ÑˆÐµ.', 'ru', 'yum'),
('Please enter your login or email addres.', 'ÐŸÐ¾Ð¶Ð°Ð»ÑƒÐ¹ÑÑ‚Ð°, Ð²Ð²ÐµÐ´Ð¸Ñ‚Ðµ Ð’Ð°Ñˆ Ð»Ð¾Ð³Ð¸Ð½ Ð¸Ð»Ð¸ Ð°Ð´Ñ€ÐµÑ ÑÐ»ÐµÐºÑ‚Ñ€Ð¾Ð½Ð½Ð¾Ð¹ Ð¿Ð¾Ñ‡Ñ‚Ñ‹.', 'ru', 'yum'),
('Please fill out the following form with your login credentials:', 'ÐŸÐ¾Ð¶Ð°Ð»ÑƒÐ¹ÑÑ‚Ð°, Ð·Ð°Ð¿Ð¾Ð»Ð½Ð¸Ñ‚Ðµ ÑÐ»ÐµÐ´ÑƒÑŽÑ‰ÑƒÑŽ Ñ„Ð¾Ñ€Ð¼Ñƒ Ñ Ð²Ð°ÑˆÐ¸Ð¼Ð¸ Ð›Ð¾Ð³Ð¸Ð½ Ð¸ Ð¿Ð°Ñ€Ð¾Ð»ÐµÐ¼:', 'ru', 'yum'),
('Position', 'ÐŸÐ¾Ð·Ð¸Ñ†Ð¸Ñ', 'ru', 'yum'),
('Predefined values (example: 1, 2, 3, 4, 5;).', 'ÐŸÑ€ÐµÐ´Ð¾Ð¿Ñ€ÐµÐ´ÐµÐ»ÐµÐ½Ð½Ñ‹Ðµ Ð·Ð½Ð°Ñ‡ÐµÐ½Ð¸Ñ (Ð¿Ñ€Ð¸Ð¼ÐµÑ€: 1;2;3;4;5;).', 'ru', 'yum'),
('Profile', 'ÐŸÑ€Ð¾Ñ„Ð¸Ð»ÑŒ', 'ru', 'yum'),
('Profile Fields', 'ÐŸÐ¾Ð»Ñ Ð¿Ñ€Ð¾Ñ„Ð¸Ð»Ñ', 'ru', 'yum'),
('Range', 'Ð ÑÐ´ Ð·Ð½Ð°Ñ‡ÐµÐ½Ð¸Ð¹', 'ru', 'yum'),
('Registered users', 'Ð—Ð°Ñ€ÐµÐ³Ð¸ÑÑ‚Ñ€Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð½Ñ‹Ðµ Ð¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»Ð¸', 'ru', 'yum'),
('Registration', 'Ð ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ñ', 'ru', 'yum'),
('Registration date', 'Ð”Ð°Ñ‚Ð° Ñ€ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ð¸', 'ru', 'yum'),
('Regular expression (example: ''/^[A-Za-z0-9s,]+$/u'').', 'Ð ÐµÐ³ÑƒÐ»ÑÑ€Ð½Ñ‹Ðµ Ð²Ñ‹Ñ€Ð°Ð¶ÐµÐ½Ð¸Ñ (Ð¿Ñ€Ð¸Ð¼ÐµÑ€: ''/^[A-Za-z0-9s,]+$/u'')', 'ru', 'yum'),
('Remember me next time', 'Ð—Ð°Ð¿Ð¾Ð¼Ð½Ð¸Ñ‚ÑŒ Ð¼ÐµÐ½Ñ', 'ru', 'yum'),
('Required', 'ÐžÐ±ÑÐ·Ð°Ñ‚ÐµÐ»ÑŒÐ½Ð¾ÑÑ‚ÑŒ', 'ru', 'yum'),
('Required field (form validator).', 'ÐžÐ±ÑÐ·Ð°Ñ‚ÐµÐ»ÑŒÐ½Ð¾Ðµ Ð¿Ð¾Ð»Ðµ (Ð¿Ñ€Ð¾Ð²ÐµÑ€ÐºÐ° Ñ„Ð¾Ñ€Ð¼Ñ‹).', 'ru', 'yum'),
('Restore', 'Ð’Ð¾ÑÑÑ‚Ð°Ð½Ð¾Ð²Ð¸Ñ‚ÑŒ', 'ru', 'yum'),
('Retype Password', 'ÐŸÐ¾Ð²Ñ‚Ð¾Ñ€Ð¸Ñ‚Ðµ Ð¿Ð°Ñ€Ð¾Ð»ÑŒ', 'ru', 'yum'),
('Retype Password is incorrect.', 'ÐŸÐ°Ñ€Ð¾Ð»Ð¸ Ð½Ðµ ÑÐ¾Ð²Ð¿Ð°Ð´Ð°ÑŽÑ‚.', 'ru', 'yum'),
('Save', 'Ð¡Ð¾Ñ…Ñ€Ð°Ð½Ð¸Ñ‚ÑŒ', 'ru', 'yum'),
('Status', 'Ð¡Ñ‚Ð°Ñ‚ÑƒÑ', 'ru', 'yum'),
('Superuser', 'Ð¡ÑƒÐ¿ÐµÑ€ Ð¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»ÑŒ', 'ru', 'yum'),
('Thank you for your registration. Please check your email or login.', 'Ð ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ñ Ð·Ð°Ð²ÐµÑ€ÑˆÐµÐ½Ð°. ÐŸÐ¾Ð¶Ð°Ð»ÑƒÐ¹ÑÑ‚Ð° Ð¿Ñ€Ð¾Ð²ÐµÑ€ÑŒÑ‚Ðµ ÑÐ²Ð¾Ð¹ ÑÐ»ÐµÐºÑ‚Ñ€Ð¾Ð½Ð½Ñ‹Ð¹ ÑÑ‰Ð¸Ðº Ð¸Ð»Ð¸ Ð²Ñ‹Ð¿Ð¾Ð»Ð½Ð¸Ñ‚Ðµ Ð²Ñ…Ð¾Ð´.', 'ru', 'yum'),
('Thank you for your registration. Please check your email.', 'Ð ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ñ Ð·Ð°Ð²ÐµÑ€ÑˆÐµÐ½Ð°. ÐŸÐ¾Ð¶Ð°Ð»ÑƒÐ¹ÑÑ‚Ð° Ð¿Ñ€Ð¾Ð²ÐµÑ€ÑŒÑ‚Ðµ ÑÐ²Ð¾Ð¹ ÑÐ»ÐµÐºÑ‚Ñ€Ð¾Ð½Ð½Ñ‹Ð¹ ÑÑ‰Ð¸Ðº.', 'ru', 'yum'),
('The minimum value of the field (form validator).', 'ÐœÐ¸Ð½Ð¸Ð¼Ð°Ð»ÑŒÐ½Ð¾Ðµ Ð·Ð½Ð°Ñ‡ÐµÐ½Ð¸Ðµ Ð¿Ð¾Ð»Ñ (Ð¿Ñ€Ð¾Ð²ÐµÑ€ÐºÐ° Ñ„Ð¾Ñ€Ð¼Ñ‹).', 'ru', 'yum'),
('The value of the default field (database).', 'Ð—Ð½Ð°Ñ‡ÐµÐ½Ð¸Ðµ Ð¿Ð¾Ð»Ñ Ð¿Ð¾ ÑƒÐ¼Ð¾Ð»Ñ‡Ð°Ð½Ð¸ÑŽ (Ð±Ð°Ð·Ð° Ð´Ð°Ð½Ð½Ñ‹Ñ…).', 'ru', 'yum'),
('This user''s email adress already exists.', 'ÐŸÐ¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»ÑŒ Ñ Ñ‚Ð°ÐºÐ¸Ð¼ ÑÐ»ÐµÐºÑ‚Ñ€Ð¾Ð½Ð½Ñ‹Ð¼ Ð°Ð´Ñ€ÐµÑÐ¾Ð¼ ÑƒÐ¶Ðµ ÑÑƒÑ‰ÐµÑÑ‚Ð²ÑƒÐµÑ‚.', 'ru', 'yum'),
('This user''s name already exists.', 'ÐŸÐ¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»ÑŒ Ñ Ñ‚Ð°ÐºÐ¸Ð¼ Ð¸Ð¼ÐµÐ½ÐµÐ¼ ÑƒÐ¶Ðµ ÑÑƒÑ‰ÐµÑÑ‚Ð²ÑƒÐµÑ‚.', 'ru', 'yum'),
('Title', 'ÐÐ°Ð·Ð²Ð°Ð½Ð¸Ðµ', 'ru', 'yum'),
('Update Profile Field', 'ÐŸÑ€Ð°Ð²Ð¸Ñ‚ÑŒ', 'ru', 'yum'),
('Update User', 'ÐŸÑ€Ð°Ð²Ð¸Ñ‚ÑŒ', 'ru', 'yum'),
('User activation', 'ÐÐºÑ‚Ð¸Ð²Ð°Ñ†Ð¸Ñ Ð¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»Ñ', 'ru', 'yum'),
('Username is incorrect.', 'ÐŸÐ¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»ÑŒ Ñ Ñ‚Ð°ÐºÐ¸Ð¼ Ð¸Ð¼ÐµÐ½ÐµÐ¼ Ð½Ðµ Ð·Ð°Ñ€ÐµÐ³Ð¸ÑÑ‚Ñ€Ð¸Ñ€Ð¾Ð²Ð°Ð½.', 'ru', 'yum'),
('Users', 'ÐŸÐ¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ñ‚ÐµÐ»Ð¸', 'ru', 'yum'),
('Variable name', 'Ð˜Ð¼Ñ Ð¿ÐµÑ€ÐµÐ¼ÐµÐ½Ð½Ð¾Ð¹', 'ru', 'yum'),
('Verification Code', 'ÐŸÑ€Ð¾Ð²ÐµÑ€Ð¾Ñ‡Ð½Ñ‹Ð¹ ÐºÐ¾Ð´', 'ru', 'yum'),
('View Profile Field', 'ÐŸÑ€Ð¾ÑÐ¼Ð¾Ñ‚Ñ€', 'ru', 'yum'),
('View Profile Field #', 'ÐŸÐ¾Ð»Ðµ Ð¿Ñ€Ð¾Ñ„Ð¸Ð»Ñ #', 'ru', 'yum'),
('View User', 'ÐŸÑ€Ð¾ÑÐ¼Ð¾Ñ‚Ñ€ Ð¿Ñ€Ð¾Ñ„Ð¸Ð»Ñ', 'ru', 'yum'),
('Visible', 'Ð’Ð¸Ð´Ð¸Ð¼Ð¾ÑÑ‚ÑŒ', 'ru', 'yum'),
('Yes', 'Ð”Ð°', 'ru', 'yum'),
('Yes and show on registration form', 'Ð”Ð° Ð¸ Ð¿Ð¾ÐºÐ°Ð·Ð°Ñ‚ÑŒ Ð¿Ñ€Ð¸ Ñ€ÐµÐ³Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ð¸', 'ru', 'yum'),
('You account is activated.', 'Ð’Ð°ÑˆÐ° ÑƒÑ‡ÐµÑ‚Ð½Ð°Ñ Ð·Ð°Ð¿Ð¸ÑÑŒ Ð°ÐºÑ‚Ð¸Ð²Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð°.', 'ru', 'yum'),
('You account is active.', 'Ð’Ð°ÑˆÐ° ÑƒÑ‡ÐµÑ‚Ð½Ð°Ñ Ð·Ð°Ð¿Ð¸ÑÑŒ ÑƒÐ¶Ðµ Ð°ÐºÑ‚Ð¸Ð²Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð°.', 'ru', 'yum'),
('You account is blocked.', 'Ð’Ð°Ñˆ Ð°ÐºÐºÐ°ÑƒÐ½Ñ‚ Ð·Ð°Ð±Ð»Ð¾ÐºÐ¸Ñ€Ð¾Ð²Ð°Ð½.', 'ru', 'yum'),
('You account is not activated.', 'Ð’Ð°Ñˆ Ð°ÐºÐºÐ°ÑƒÐ½Ñ‚ Ð½Ðµ Ð°ÐºÑ‚Ð¸Ð²Ð¸Ñ€Ð¾Ð²Ð°Ð½.', 'ru', 'yum'),
('Your profile', 'Ð’Ð°Ñˆ Ð¿Ñ€Ð¾Ñ„Ð¸Ð»ÑŒ', 'ru', 'yum'),
('activation key', 'ÐšÐ»ÑŽÑ‡ Ð°ÐºÑ‚Ð¸Ð²Ð°Ñ†Ð¸Ð¸', 'ru', 'yum'),
('password', 'ÐŸÐ°Ñ€Ð¾Ð»ÑŒ', 'ru', 'yum'),
('username', 'Ð›Ð¾Ð³Ð¸Ð½', 'ru', 'yum'),
('username or email', 'Ð›Ð¾Ð³Ð¸Ð½ Ð¸Ð»Ð¸ email', 'ru', 'yum');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `activationKey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `lastaction` int(10) NOT NULL DEFAULT '0',
  `lastpasswordchange` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `notifyType` enum('None','Digest','Instant','Threshold') DEFAULT 'Instant',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `activationKey`, `createtime`, `lastvisit`, `lastaction`, `lastpasswordchange`, `superuser`, `status`, `avatar`, `notifyType`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 1344845293, 1363713911, 1363720012, 0, 1, 1, 'data/avatar/1_cartoon-moose-9.png', 'Instant'),
(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', '', 1344845293, 1363721018, 1363721148, 0, 0, 1, NULL, 'Instant'),
(3, 'SuperUser', 'a1866808738b5888e1546977e231f999', 'f7f7cbfb674cd0b45603c696ce5ea33b', 1345492151, 0, 0, 0, 0, 0, NULL, 'Instant'),
(4, 'SUser1', '6803f360e320f378aa82365f8c79673d', '8de9c5d0212e8cb3288c9be3137ff170', 1345492205, 0, 0, 0, 0, 0, NULL, 'Instant'),
(5, 'test', 'a1866808738b5888e1546977e231f999', 'cdd5481162a62b84487f8ab0692940dc', 1359905967, 0, 0, 1359905967, 0, 1, NULL, 'Instant'),
(6, 'uTest', 'ff4cac7d4874299d83f8be280d1cbb77', '317c9adf1b5f66b0499c75f7a93f97c7', 1359914694, 0, 0, 1359914694, 0, 0, NULL, 'Instant'),
(7, 'moderator', '0408f3c997f309c03b08bf3a4bc7b730', 'ec9c6069948906bd30b6e2a9fa29dd5a', 1363719265, 1363719992, 0, 1363719265, 0, 1, NULL, 'Instant');

-- --------------------------------------------------------

--
-- Структура таблицы `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `participants` text,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user_group_message`
--

CREATE TABLE IF NOT EXISTS `user_group_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  `createtime` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(2, 3),
(6, 5),
(7, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `yumtextsettings`
--

CREATE TABLE IF NOT EXISTS `yumtextsettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` enum('en_us','de','fr','pl','ru','es','ro') NOT NULL DEFAULT 'en_us',
  `text_email_registration` text,
  `subject_email_registration` text,
  `text_email_recovery` text,
  `text_email_activation` text,
  `text_friendship_new` text,
  `text_friendship_confirmed` text,
  `text_profilecomment_new` text,
  `text_message_new` text,
  `text_membership_ordered` text,
  `text_payment_arrived` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `yumtextsettings`
--

INSERT INTO `yumtextsettings` (`id`, `language`, `text_email_registration`, `subject_email_registration`, `text_email_recovery`, `text_email_activation`, `text_friendship_new`, `text_friendship_confirmed`, `text_profilecomment_new`, `text_message_new`, `text_membership_ordered`, `text_payment_arrived`) VALUES
(1, 'en_us', 'You have registered for this Application. To confirm your E-Mail address, please visit {activation_url}', 'You have registered for an application', 'You have requested a new Password. To set your new Password,\n										please go to {activation_url}', 'Your account has been activated. Thank you for your registration.', 'New friendship Request from {username}: {message}. To accept or ignore this request, go to your friendship page: {link_friends} or go to your profile: {link_profile}', 'The User {username} has accepted your friendship request', 'You have a new profile comment from {username}: {message} visit your profile: {link_profile}', 'You have received a new message from {username}: {message}', 'Your order of membership {membership} on {order_date} has been taken. Your order Number is {id}. You have choosen the payment style {payment}.', 'Your payment has been received on {payment_date} and your Membership {id} is now active'),
(2, 'de', 'Sie haben sich für unsere Applikation registriert. Bitte bestätigen Sie ihre E-Mail adresse mit diesem Link: {activation_url}', 'Sie haben sich für eine Applikation registriert.', 'Sie haben ein neues Passwort angefordert. Bitte klicken Sie diesen link: {activation_url}', 'Ihr Konto wurde freigeschaltet.', 'Der Benutzer {username} hat Ihnen eine Freundschaftsanfrage gesendet. \n\n							 Nachricht: {message}\n\n							 Klicken sie <a href="{link_friends}">hier</a>, um diese Anfrage zu bestätigen oder zu ignorieren. Alternativ können sie <a href="{link_profile}">hier</a> auf ihre Profilseite zugreifen.', 'Der Benutzer {username} hat ihre Freundschaftsanfrage bestätigt.', '\n							 Benutzer {username} hat Ihnen eine Nachricht auf Ihrer Pinnwand hinterlassen: \n\n							 {message}\n\n							 <a href="{link}">hier</a> geht es direkt zu Ihrer Pinnwand!', 'Sie haben eine neue Nachricht von {username} bekommen: {message}', 'Ihre Bestellung der Mitgliedschaft {membership} wurde am {order_date} entgegen genommen. Die gewählte Zahlungsart ist {payment}. Die Auftragsnummer lautet {id}.', 'Ihre Zahlung wurde am {payment_date} entgegen genommen. Ihre Mitgliedschaft mit der Nummer {id} ist nun Aktiv.'),
(3, 'es', 'Te has registrado en esta aplicación. Para confirmar tu dirección de correo electrónico, por favor, visita {activation_url}.', 'Te has registrado en esta aplicación.', 'Has solicitado una nueva contraseña. Para establecer una nueva contraseña, por favor ve a {activation_url}', 'Tu cuenta ha sido activada. Gracias por registrarte.', 'Has recibido una nueva solicitud de amistad de {user_from}: {message} Ve a tus contactos: {link}', 'Tienes un nuevo comentario en tu perfil de {username}: {message} visita tu perfil: {link}', 'Please translatore thisse hiere toh tha espagnola langsch {username}', 'Has recibido un mensaje de {username}: {message}', 'Tu orden de membresía {membership} de fecha {order_date} fué tomada. Tu número de orden es {id}. Escogiste como modo de pago {payment}.', 'Tu pago fué recibido en fecha {payment_date}. Ahora tu Membresía {id} ya está activa'),
(4, 'fr', '', '', '', '', '', '', '', '', '', ''),
(5, 'ro', '', '', '', '', '', '', '', '', '', '');
