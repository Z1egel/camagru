-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Хост: 10.0.0.129:3306
-- Время создания: Окт 29 2019 г., 06:11
-- Версия сервера: 10.1.40-MariaDB
-- Версия PHP: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `rootpokrov_camagru`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `photo_id` int(11) unsigned NOT NULL,
  `comment` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `photo_id` (`photo_id`),
  KEY `comment_id` (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `user_id` int(10) unsigned NOT NULL,
  `photo_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  KEY `user_id` (`user_id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `url` varchar(1000) NOT NULL,
  `thumb_url` varchar(1000) NOT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=564 ;

-- --------------------------------------------------------

--
-- Структура таблицы `stickers`
--

CREATE TABLE IF NOT EXISTS `stickers` (
  `sticker_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` enum('common','animals','games','memes') NOT NULL DEFAULT 'common',
  `url` varchar(256) NOT NULL,
  `uses` int(11) NOT NULL,
  PRIMARY KEY (`sticker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Дамп данных таблицы `stickers`
--

INSERT INTO `stickers` (`sticker_id`, `category`, `url`, `uses`) VALUES
(5, 'animals', 'beaver.png', 0),
(6, 'memes', '5845e665fb0b0755fa99d7ec.png', 0),
(7, 'memes', '5845e1677733c3558233c0ee.png', 0),
(8, 'memes', '5845cd230b2a3b54fdbaecf7.png', 0),
(9, 'games', '5904f37ebbee4f0964d87903.png', 0),
(10, 'games', '5904f2c9bbee4f0964d878fc.png', 0),
(12, 'games', '5852c19358215f0354495f4e.png', 0),
(13, 'games', '580b57fcd9996e24bc43c28b.png', 0),
(16, 'games', '584c69846e7d5809d2fa6366.png', 0),
(17, 'games', '584c69426e7d5809d2fa6361.png', 0),
(20, 'games', '5b90ed55196573108b203a6d.png', 0),
(21, 'games', '580b57fcd9996e24bc43c29d.png', 0),
(22, 'games', '580b57fcd9996e24bc43c2a9.png', 0),
(23, 'games', '58ff7d3316ae4b3fc58f481f.png', 0),
(24, 'games', '5904f274bbee4f0964d878fa.png', 0),
(25, 'games', '5904f174bdb9ca08f59eed92.png', 0),
(27, 'games', '58a1f801c8dd3432c6fa81ec.png', 0),
(28, 'games', '58a1f84cc8dd3432c6fa81f4.png', 0),
(29, 'games', '58a1f80ac8dd3432c6fa81ed.png', 0),
(30, 'games', '580b57fcd9996e24bc43c2d2.png', 0),
(31, 'games', '5ca631ae1cf23004f28368a7.png', 0),
(32, 'games', '5ca631721cf23004f283689f.png', 0),
(33, 'games', '580b57fcd9996e24bc43c306.png', 0),
(34, 'games', '5859691e4f6ae202fedf287e.png', 0),
(35, 'games', '580b57fcd9996e24bc43c31f.png', 0),
(36, 'games', '580b57fcd9996e24bc43c325.png', 0),
(37, 'games', '585961604f6ae202fedf285a.png', 0),
(38, 'memes', '58961fa0cba9841eabab60fb.png', 0),
(39, 'memes', '58f7689584b713aab61d0a09.png', 0),
(40, 'memes', '5845ec62dda95a5696fa1a27.png', 0),
(41, 'memes', '584877787b758d6b0758d00c.png', 0),
(42, 'memes', '589b4da582250818d81e748f.png', 0),
(43, 'animals', '5c8a23edcdad6d02b006e463.png', 0),
(44, 'animals', '5af948ea6554160a79bea0f2.png', 0),
(45, 'animals', '5c2e2b57a97bc40295eb8350.png', 0),
(46, 'animals', '580b57fbd9996e24bc43bb3e.png', 0),
(47, 'animals', '580b57fbd9996e24bc43bb4a.png', 0),
(48, 'animals', '580b57fbd9996e24bc43bb53.png', 0),
(49, 'animals', '5b8ab132a639e004e1cab50d.png', 0),
(50, 'animals', '580b57fbd9996e24bc43bb87.png', 0),
(51, 'animals', '580b57fbd9996e24bc43bb8d.png', 0),
(52, 'animals', '58a050065583a1291368eeb4.png', 0),
(53, 'animals', '589c87a864b351149f22a84d.png', 0),
(54, 'animals', '580b57fbd9996e24bc43bbbe.png', 0),
(55, 'animals', '580b57fbd9996e24bc43bbbf.png', 0),
(56, 'animals', '580b57fbd9996e24bc43bbca.png', 0),
(57, 'animals', '585bb595cb11b227491c32a1.png', 0),
(58, 'animals', '58b061768a4b5bbbc8492952.png', 0),
(59, 'animals', '580b57fbd9996e24bc43bc17.png', 0),
(60, 'animals', '59cfc7b7d3b1936210a5ddd5.png', 0),
(61, 'common', '580b585b2edbce24c47b278e.png', 0),
(62, 'common', '580b585b2edbce24c47b2798.png', 0),
(63, 'common', '580b585b2edbce24c47b279d.png', 0),
(64, 'common', '5ba661babede2105e7aaeef0.png', 0),
(65, 'common', '5c3a26c60bed5b0214b59de0.png', 0),
(66, 'common', '580b585b2edbce24c47b290c.png', 0),
(67, 'common', '58a7a2a15ad0fd0b7fdd33d2.png', 0),
(68, 'common', '5c499e4bf8ab04028c27e0f9.png', 0),
(69, 'common', '585acd664f6ae202fedf2952.png', 0),
(70, 'common', '585ace884f6ae202fedf295d.png', 0),
(71, 'common', '58738b41f3a71010b5e8ef52.png', 0),
(72, 'common', '59d62ad93752880e93e16eb4.png', 0),
(73, 'common', '599e9a91eb380faa1fd1ced2.png', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` enum('admin','guest') NOT NULL DEFAULT 'guest',
  `confirmed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `confirm_link` varchar(128) NOT NULL,
  `inform` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`),
  KEY `login` (`login`),
  KEY `email` (`email`),
  KEY `password` (`password`),
  KEY `status` (`status`),
  KEY `confirmed` (`confirmed`),
  KEY `confirm_link` (`confirm_link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`photo_id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`photo_id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
