-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 08 2011 г., 18:43
-- Версия сервера: 5.1.41
-- Версия PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `fluentcms`
--
DROP DATABASE `fluentcms`;
CREATE DATABASE `fluentcms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fluentcms`;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `comment` text NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `text_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `parent_id`, `name`, `comment`, `date_add`, `text_id`) VALUES
(1, 0, 'LosYear', 'Мы очень рады', '2011-11-07 18:47:05', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `contest`
--

CREATE TABLE IF NOT EXISTS `contest` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` text NOT NULL,
  `desc` text NOT NULL,
  `rootcat` int(11) NOT NULL,
  `subtype` int(11) NOT NULL,
  `from` datetime NOT NULL,
  `till` datetime NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contest`
--

INSERT INTO `contest` (`id`, `type`, `name`, `desc`, `rootcat`, `subtype`, `from`, `till`) VALUES
(2, 2, 'Блиц тур', 'Тур представлен в виде теста, выполняется в течении часа.', 1, 1, '2011-11-07 00:00:00', '2012-11-07 00:00:00'),
(1, 1, 'Физико-математическое направлени', 'Направление, в котором дети могут проявить себя в качестве будующих математиков и физиков', -1, -1, '2011-11-07 20:32:42', '2011-11-07 20:32:42'),
(3, 2, 'Полный тур', 'Скачиваете задание, отправляете ответы', 1, 2, '2011-11-07 00:00:00', '2011-12-07 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` int(11) NOT NULL,
  `hidden` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `from`, `to`, `title`, `text`, `date`, `state`, `hidden`) VALUES
(1, 1, 2, 'Тестовое сообщение', 'Текст сообщения', '2011-11-27 19:22:17', 1, 0),
(2, 1, 1, '1', '1', '2011-12-01 10:26:13', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `author` text NOT NULL,
  `folder` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `version` text NOT NULL,
  `cms_version_min` text NOT NULL,
  `cms_version_max` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `main_filename` text NOT NULL,
  `contacts` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`id`, `name`, `author`, `folder`, `title`, `description`, `version`, `cms_version_min`, `cms_version_max`, `is_active`, `main_filename`, `contacts`) VALUES
(1, 'fl_twitter', 'LosYear aka Losev Yaroslav', 'twitter', 'FLuent CMS Twitter', 'Twitter', '0.1 alpha', '*', '*', 0, 'index.php', 'E-Mail : flexo.o@yandex.ru www : www.losyar.ru'),
(2, 'fl_profiles', 'LosYear aka Losev Yaroslav', 'pages', 'User Profiles', 'User Profiles for Fluent. Part of Fluent Rush', '0.1 alpha', '*', '*', 1, 'index.php', 'E-Mail : flexo.o@yandex.ru www : www.losyar.ru'),
(3, 'fl_concore', 'LosYear aka Losev Yaroslav', 'contest', 'Contest core', 'Core for contest', '0.1 alpha', '*', '*', 1, 'index.php', 'E-Mail : flexo.o@yandex.ru www : www.losyar.ru'),
(4, 'fr_messages', 'LosYear aka Losev Yaroslav', 'messages', 'Fluent CMS private messages', 'Users can write messages to each other', '0.1 alpha', '*', '*', 0, 'index.php', 'E-Mail : flexo.o@yandex.ru www : www.losyar.ru'),
(5, 'send_mail', 'LosYear aka Losev Yaroslav', 'send_mail', 'Send Mail', 'Sending mail on different events', '0.1 alpha', '*', '*', 1, 'index.php', 'E-Mail : flexo.o@yandex.ru www : www.losyar.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` text NOT NULL,
  `teacher` text NOT NULL,
  `school` text NOT NULL,
  `about_team` text NOT NULL,
  `photo` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `type`, `name`, `teacher`, `school`, `about_team`, `photo`) VALUES
(4, 3, 'Команда № 3', 'Федоров Федор Федорович', 'Школа № 3', 'Состав команды :\r\nВ состав входят 3 учащихся 5-х классов', '4'),
(1, 3, 'Команда Администраторов', 'Учителя входят в состав команды', 'Школа № 10', 'Состав команды будет известен позже', '1'),
(2, 3, 'Команда № 1', 'Иванова Анна Ивановна', 'Школа № 1', 'Состав команды :\r\n* Иванов Иван\r\n* Петров Петр\r\n* Федотов Федор', '2'),
(3, 3, 'Команда № 2', 'Иванов Иван Иванович', 'Школа № 2', 'Состав команды :\r\n - Состав команды держиться в тайне', '3');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL,
  `question` text CHARACTER SET utf8 NOT NULL,
  `ans1` text CHARACTER SET utf8 NOT NULL,
  `ans2` text CHARACTER SET utf8 NOT NULL,
  `ans3` text CHARACTER SET utf8 NOT NULL,
  `ans4` text CHARACTER SET utf8 NOT NULL,
  `write_ans` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `question`, `ans1`, `ans2`, `ans3`, `ans4`, `write_ans`, `tour_id`, `point`, `time`) VALUES
(4, '3.txt', '--', '--', '--', '--', -1, 3, -1, 0),
(2, '5+5', '10', '20', '30', '40', 1, 2, 10, 100000),
(1, 'Сколько будет "2+2"', '4', '', '"7"', '9', 1, 2, 5, 100000),
(5, 'Работает ли таймер?', 'Хз', 'Да', 'Ес-но будет работать', '---', 3, 2, 10, 100000),
(3, 'tmp', '1', '2', '3', '4', 1, 2, 10, 100000);

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `adv` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `results`
--


-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `site_name` text NOT NULL,
  `site_describe` text NOT NULL,
  `copyright` text NOT NULL,
  `site_url` text NOT NULL,
  `site_s` text NOT NULL,
  `theme_name` text NOT NULL,
  `language` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_describe`, `copyright`, `site_url`, `site_s`, `theme_name`, `language`) VALUES
(0, 'Мудрёнок', 'Описание марафона', '© Тверская гимназия №10', 'http://localhost', '/home/site', 'mudrenok', 'ru');

-- --------------------------------------------------------

--
-- Структура таблицы `texts`
--

CREATE TABLE IF NOT EXISTS `texts` (
  `id` text NOT NULL,
  `caption` text NOT NULL,
  `text` longtext NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` text NOT NULL,
  `isPage` tinyint(1) NOT NULL,
  `isHidden` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `texts`
--

INSERT INTO `texts` (`id`, `caption`, `text`, `data`, `author`, `isPage`, `isHidden`) VALUES
('1', 'Туры', '<p style="text-align: center;"><em><span style="font-size: xx-large;"><img style="vertical-align: baseline;" title="В разработке" src="../styles/system/images/under_construction.png" alt="В разработке" width="250" height="250" /></span></em></p>\r\n<p style="text-align: center;"><em><span style="font-size: xx-large;">Раздел в разработке</span></em></p>', '2011-09-27 23:57:56', 'admin', 1, 0),
('2', 'Документы', '<p>Регламент соревнования :</p>\r\n<p>&lt;ссылка&gt;</p>\r\n<p>Пример заполнения заявки: :</p>\r\n<p>&lt;ссылка&gt;</p>\r\n<p>...</p>', '2011-09-26 23:59:03', 'admin', 1, 0),
('3', 'О проекте', '<p style="text-align: center;"><img title="i" src="../styles/system/images/info.png" alt="i" width="128" height="128" /></p>\r\n<p style="text-align: center;"><span style="font-size: medium;">Информация о проекте, написанная администратором.</span></p>', '2011-09-17 00:05:31', 'admin', 1, 0),
('4', 'Помощь', '<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><img src="../styles/system/images/help.png" alt="" width="128" height="128" /><span style="font-size: medium;">&nbsp;</span></p>\r\n<p style="text-align: center;"><span style="font-size: medium;">Некая информация, которая поможет пользователям в использовании сайта.</span></p>', '2011-09-25 00:08:35', 'admin', 1, 0),
('5', 'Направления', '<p style="text-align: center;"><em><span style="font-size: xx-large;"><img style="vertical-align: baseline;" title="В разработке" src="../styles/system/images/under_construction.png" alt="В разработке" width="250" height="250" /></span></em></p>\r\n<p style="text-align: center;"><em><span style="font-size: xx-large;">Раздел в разработке</span></em></p>', '2011-09-28 00:09:29', 'admin', 1, 0),
('6', 'Мы начали работать', '<p>Пример некой новости.</p>\r\n<p><img src="http://images.findicons.com/files/icons/1676/primo/128/news.png" alt="" width="128" height="128" /></p>', '2011-09-28 00:15:19', 'admin', 0, 0),
('7', 'Приветствие', '<p>Здесь в будующем будет находиться приветствие</p>\r\n<p><img src="http://images.findicons.com/files/icons/734/phuzion/128/chat.png" alt="" width="128" height="128" /></p>', '2011-09-28 00:16:49', 'admin', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tmp_result`
--

CREATE TABLE IF NOT EXISTS `tmp_result` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tmp_result`
--


-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `pass` longtext NOT NULL,
  `email` text NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `group`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@localhost.ru', 1),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@user.ru', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
