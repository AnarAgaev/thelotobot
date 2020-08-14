-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Хост: pareta.mysql.ukraine.com.ua
-- Время создания: Янв 24 2020 г., 19:34
-- Версия сервера: 5.7.16-10-log
-- Версия PHP: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pareta_loto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE `languages` (
  `id_lang` int(2) UNSIGNED NOT NULL COMMENT 'Идентификатор языка',
  `name_lang` varchar(5) NOT NULL COMMENT 'Имя зыка на латинице'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id_lang`, `name_lang`) VALUES
(24, 'ru'),
(2, 'en'),
(3, 'fr'),
(4, 'de'),
(5, 'it'),
(6, 'es'),
(7, 'da'),
(8, 'pl'),
(9, 'pt'),
(10, 'no'),
(11, 'sv'),
(12, 'fi'),
(13, 'id'),
(14, 'ms'),
(15, 'hu'),
(16, 'nl'),
(17, 'ro'),
(18, 'cs'),
(19, 'grk'),
(20, 'ja'),
(21, 'ko'),
(22, 'sk'),
(23, 'tr'),
(1, 'uk'),
(26, 'vi'),
(25, 'th'),
(27, 'zh-cn'),
(28, 'zh-tw'),
(29, 'lv');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id_lang`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id_lang` int(2) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор языка', AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
