-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 20 2017 г., 06:24
-- Версия сервера: 5.6.16
-- Версия PHP: 7.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `simpleapp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `text`, `create_at`) VALUES
(1, 1, 'sdgsdfg', '2017-03-19 14:49:01'),
(2, 1, 'sdgsdfg', '2017-03-19 14:52:18'),
(3, 1, 'New comment', '2017-03-19 15:05:38'),
(4, 1, 'оылдвао1&lt;p&gt;', '2017-03-19 15:50:51'),
(5, 6, 'Новый комментарий', '2017-03-19 17:05:15');

-- --------------------------------------------------------

--
-- Структура таблицы `fos_user`
--

CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vkontakte_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `first_name`, `last_name`, `facebook_id`, `vkontakte_id`) VALUES
(1, 'Evgeniy', 'evgeniy', 'e19a@yandex.ru', 'e19a@yandex.ru', 1, NULL, '$2y$13$IB3LnWyhcNS.BQqdcG0RwefNjII44FsoOycwbfDVb5BVty2NIMqtS', '2017-03-20 05:53:39', NULL, NULL, 'a:0:{}', 'Евгений', 'Бледнов', '1012602695497264', NULL),
(2, 'Ivan', 'ivan', 'ivan@mail.ru', 'ivan@mail.ru', 1, NULL, '$2y$13$h0ay3zbkb.V0YLeIHC6tmeJTdj5rfRS5tvJw78fvaMDBBbwtT3MGG', '2017-03-19 10:52:03', NULL, NULL, 'a:0:{}', NULL, NULL, NULL, NULL),
(3, 'Petr', 'petr', 'petr@mail.ru', 'petr@mail.ru', 1, NULL, '$2y$13$6Gi0VXaW4HKvWiUREbzdFO6tTMj9xjzRanjOfDe/pma1KLRY3BBsq', '2017-03-19 10:52:51', NULL, NULL, 'a:0:{}', NULL, NULL, NULL, NULL),
(4, 'Andrey', 'andrey', 'andrey@mail.ru', 'andrey@mail.ru', 1, NULL, '$2y$13$ot3KQvBPtqQlWHUZyK0bcO1r7BEUHNFgrwnw52w4moS92hRzFsukq', '2017-03-19 10:53:25', NULL, NULL, 'a:0:{}', NULL, NULL, NULL, NULL),
(5, 'Makar', 'makar', 'makar@mail.ru', 'makar@mail.ru', 1, NULL, '$2y$13$WyekmSw9VhCHd6Is6.9yhedz/rTi1mpr5sZOPDlquEYm6SFJ14C2.', '2017-03-19 10:54:07', NULL, NULL, 'a:0:{}', NULL, NULL, NULL, NULL),
(6, '58ce8e5d2eb47', '58ce8e5d2eb47', 'evgeniy_p08@mail.ru', 'evgeniy_p08@mail.ru', 1, NULL, '$2y$13$b0nsFtlREQucYmo3xIZQTuYxq3KOMn2eTXAJMQfDYEsXlBgaGZKP.', '2017-03-19 16:57:49', NULL, NULL, 'a:0:{}', 'Евгений', 'Бледнов', NULL, '31426091');

-- --------------------------------------------------------

--
-- Структура таблицы `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `friend_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `friend`
--

INSERT INTO `friend` (`id`, `user_id`, `friend_id`) VALUES
(1, 1, 2),
(2, 1, 5),
(3, 2, 4),
(4, 4, 1),
(7, 6, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5F9E962AA76ED395` (`user_id`);

--
-- Индексы таблицы `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Индексы таблицы `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_55EEAC61A76ED395` (`user_id`),
  ADD KEY `IDX_55EEAC616A5458E8` (`friend_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Ограничения внешнего ключа таблицы `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `FK_55EEAC616A5458E8` FOREIGN KEY (`friend_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_55EEAC61A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
