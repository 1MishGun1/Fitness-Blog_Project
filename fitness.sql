-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 08 2023 г., 22:44
-- Версия сервера: 10.3.34-MariaDB
-- Версия PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fitness`
--
CREATE DATABASE IF NOT EXISTS `fitness` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fitness`;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) UNSIGNED NOT NULL,
  `posts_id_post` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `users_id_user` int(10) UNSIGNED NOT NULL,
  `comment` text CHARACTER SET utf8mb4 NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`comment_id`, `posts_id_post`, `parent_id`, `users_id_user`, `comment`, `create_at`) VALUES
(199, 162, NULL, 92, 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum', '2023-06-08 19:40:06'),
(200, 162, 199, 96, 'deserunt mollit anim id est laborum!', '2023-06-08 19:40:45'),
(201, 162, NULL, 94, 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-06-08 19:41:36'),
(202, 162, 200, 94, 'voluptate velit ess', '2023-06-08 19:41:55'),
(203, 162, 200, 95, 'Iaculis at erat pellentesque adipiscing commodo elit at imperdiet. Vitae sapien pellentesque habitant morbi tristique senectus', '2023-06-08 19:42:54'),
(204, 162, 201, 95, 'Et leo duis ut diam quam nulla. Ipsum consequat nisl vel pretium lectus quam id', '2023-06-08 19:43:25');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `users_id_user` int(10) UNSIGNED NOT NULL,
  `preview` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `content` text CHARACTER SET utf8mb4 NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `users_id_user`, `preview`, `content`, `create_at`, `update_at`, `image`) VALUES
(152, 'Пост про здоровую еду', 91, 'Lorem ipsum dolor sit amet, consectetur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2023-06-08 19:21:52', '2023-06-08 19:21:52', 'images/1463_osnovy-pravilnogo-pitaniya.jpg'),
(153, '1 Пост', 92, 'Превью 1 поста', 'Контент 1 поста', '2023-06-08 19:23:45', '2023-06-08 19:23:45', ''),
(154, 'Пост 2', 92, 'Превью поста 2', 'Контент поста 2', '2023-06-08 19:24:23', '2023-06-08 19:25:21', 'images/bg_1.jpg'),
(155, 'Пост 3', 93, 'Превью поста 3', 'Контент поста 3', '2023-06-08 19:27:33', '2023-06-08 19:27:33', 'images/image_5.jpg'),
(156, 'Пост 4', 93, 'Превью поста 4', 'Контент поста 4', '2023-06-08 19:28:18', '2023-06-08 19:28:18', 'images/kartinki-na-avatarku-dlya-parnej-i-muzhchin-68.jpg'),
(157, 'Пост 5', 94, 'Превью поста 5', 'Контент поста 5', '2023-06-08 19:29:43', '2023-06-08 19:29:43', 'images/image_2.jpg'),
(158, 'Пост 6', 94, 'Превью поста 6', 'Контент поста 6', '2023-06-08 19:30:18', '2023-06-08 19:30:18', 'images/image_6.jpg'),
(159, 'Пост 7', 95, 'Превью пост 7', 'Контент пост 7', '2023-06-08 19:33:05', '2023-06-08 19:33:55', 'images/image_11.jpg'),
(160, 'Пост 8', 95, 'Превью поста 8', 'Контент поста 8', '2023-06-08 19:34:35', '2023-06-08 19:34:35', 'images/image_10.jpg'),
(161, 'Пост про здоровый сон', 96, 'voluptate velit esse', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-06-08 19:37:09', '2023-06-08 19:37:09', 'images/2856439338.jpg'),
(162, 'Места для тренирок', 96, 'Lorem ipsum dolor siе', 'consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequatconsectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat', '2023-06-08 19:37:59', '2023-06-08 19:37:59', 'images/4285d328750b7c22d54bc1fdb846f2fa.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`role_id`, `title`) VALUES
(1, 'admin'),
(2, 'author');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `patronymic` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `block_time` timestamp NULL DEFAULT NULL,
  `is_block` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `roles_id_role` int(10) UNSIGNED NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `patronymic`, `login`, `email`, `password`, `token`, `block_time`, `is_block`, `roles_id_role`, `avatar`) VALUES
(90, 'admin', 'admin', 'admin', 'admin', 'admin@admin', '$2y$10$31RWXcb0hVocQyw0VdhK1eCJS4STb7ExBPITiTi1NaMDCJUcmYdLa', NULL, NULL, 0, 1, 'images/admin.png'),
(91, 'mihail', 'mihail', 'mihail', 'mihail', 'mihail@mihail', '$2y$10$ZlxNp.9Flf7Rv6JqYkmJOuF584Ga0TddmjbjkrJIASqCUeyqxphu2', NULL, NULL, 0, 2, 'images/author.jpg'),
(92, 'user1', 'user1', 'user1', 'user1', 'user1@user1', '$2y$10$QOfGP/OJuNN.LDTXrIOxZuXSwDPNMolJAb3l5DN9DM0bKvwwzwyV.', NULL, NULL, 0, 2, 'images/default.png'),
(93, 'user2', 'user2', 'user2', 'user2', 'user2@user2', '$2y$10$rRF9rHwOFU7bELkkHu2dQu91vExm9IKHuybr47tq6jwupuwo0buci', NULL, NULL, 0, 2, 'images/ikonka-malchik.jpg'),
(94, 'user3', 'user3', 'user3', 'user3', 'user3@user3', '$2y$10$Fhqa/Fc3qN4AbhcqdRM2PerU9qHbZp7ann/OnmPhzHZ0StZHEY9x2', NULL, NULL, 0, 2, 'images/default.png'),
(95, 'Petr', 'Petr', 'Petr', 'Petr', 'Petr@Petr', '$2y$10$xh7uF4Uptsc5YmPJvIqPyOKSUv3jeTuWO.2HOK6h0Z3w13Deat/jC', NULL, NULL, 0, 2, 'images/person_1.jpg'),
(96, 'Kate', 'Kate', 'Kate', 'Kate', 'Kate@Kate', '$2y$10$kPDCn1PZhlhmbojSiVg3/eKgJt3G7P2vyQfydfVPKtrw53c7OJMHy', NULL, NULL, 0, 2, 'images/about.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `Parent_id` (`parent_id`),
  ADD KEY `Posts_id_post` (`posts_id_post`),
  ADD KEY `User_id_User` (`users_id_user`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `Users_id_user` (`users_id_user`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `Roles_id_role` (`roles_id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`comment_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`posts_id_post`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`users_id_user`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`users_id_user`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roles_id_role`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
