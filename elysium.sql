-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 23 2023 г., 18:51
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `elysium`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL COMMENT 'Уникальный идентификатор категории товаров. Нужен для связи с другими таблицами. Первичный ключ',
  `id_shop` int NOT NULL COMMENT 'Идентификатор магазина. Из таблицы "roles". Внешний ключ',
  `name` varchar(500) NOT NULL COMMENT 'Название категории товаров'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `id_shop`, `name`) VALUES
(13, 20, 'м1к1'),
(14, 20, 'м1к2'),
(15, 20, 'м1к3'),
(16, 21, 'м2к1'),
(17, 21, 'м2к2'),
(18, 21, 'м2к3'),
(19, 21, 'м2к4');

-- --------------------------------------------------------

--
-- Структура таблицы `floor`
--

CREATE TABLE `floor` (
  `floor` int NOT NULL COMMENT 'Идентификатор этажа. Нужен для связи с другими таблицами.',
  `count` int NOT NULL COMMENT 'Оставшееся количество мест под аренду.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `floor`
--

INSERT INTO `floor` (`floor`, `count`) VALUES
(1, 5),
(2, 3),
(3, 0),
(4, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL COMMENT 'Идентификатор товара. Нужен для связи с другими таблицами. Первичный ключ',
  `name` varchar(500) NOT NULL COMMENT 'Имя товара',
  `price` double NOT NULL COMMENT 'Цена товара',
  `id_category` int NOT NULL COMMENT 'Идентификатор категории. Берется из таблицы "category". Внешний ключ',
  `logo` text NOT NULL COMMENT 'Картинка, демонстрирующая товар',
  `count` int NOT NULL COMMENT 'количество товара на складе'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `id_category`, `logo`, `count`) VALUES
(6, 'Товар 1', 100, 13, '/media/img/a.png', 4),
(7, 'Товар 2', 90, 14, '/media/img/c.png', 14),
(8, 'Товар 3', 700, 15, '/media/img/Q.png', 4),
(9, 'Товар 4', 145, 13, '/media/img/T.png', 26),
(10, 'Товар 5', 2000, 16, '/media/img/B.png', 14),
(11, 'Товар 6', 4000, 17, '/media/img/d.png', 59),
(12, 'Товар 7', 9000, 18, '/media/img/g.png', 120),
(13, 'Товар 8', 10000, 19, '/media/img/X.png', 99);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL COMMENT 'Идентификатор заказа. Нужен для связи с другими таблицами. Первичный ключ',
  `id_user` int NOT NULL COMMENT 'Идентификатор пользователя, совершившего заказ. Берется из таблицы "users". Внешний ключ',
  `date` date NOT NULL COMMENT 'Дата, когда был сделан заказ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `id_user`, `date`) VALUES
(12, 5, '2023-05-20'),
(13, 5, '2023-05-20');

-- --------------------------------------------------------

--
-- Структура таблицы `order_item`
--

CREATE TABLE `order_item` (
  `id` int NOT NULL COMMENT 'Идентификатор товара, находящегося в заказе. Нужен для связи с другими таблицами. Первичный ключ',
  `id_order` int NOT NULL COMMENT 'Идентификатор заказа. Берется из таблицы "order". Внешний ключ',
  `id_item` int NOT NULL COMMENT 'Идентификатор товара. Берется из таблицы "items". Внешний ключ.',
  `status` int NOT NULL COMMENT 'Статус товара: 0 - в ожидании, 1 - товар собран',
  `price` int NOT NULL COMMENT 'Цена товара на момент покупки',
  `count` int NOT NULL COMMENT 'Количество заказанного товара.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_item`
--

INSERT INTO `order_item` (`id`, `id_order`, `id_item`, `status`, `price`, `count`) VALUES
(8, 12, 6, 1, 100, 6),
(9, 12, 9, 0, 145, 4),
(10, 12, 7, 0, 90, 1),
(11, 12, 10, 0, 2000, 3),
(12, 12, 13, 0, 10000, 1),
(13, 13, 9, 0, 145, 10),
(14, 13, 8, 0, 700, 1),
(15, 13, 11, 0, 4000, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL COMMENT 'Уникальный идентификатор роли. Нужен для связи с другими таблицами. Первичный ключ',
  `name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Название роли'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Посетитель'),
(2, 'Арендатор'),
(3, 'Администратор ');

-- --------------------------------------------------------

--
-- Структура таблицы `shops`
--

CREATE TABLE `shops` (
  `id` int NOT NULL COMMENT 'Уникальный идентификатор магазина. Нужен для связи с другими таблицами. Первичный ключ',
  `id_user` int NOT NULL COMMENT 'Идентификатор пользователя. Берется из таблицы "users". Внешний ключ',
  `name` varchar(500) NOT NULL COMMENT 'Название магазина',
  `floor` int NOT NULL COMMENT 'Этаж',
  `logo` text NOT NULL COMMENT 'Ссылка на логотип'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `shops`
--

INSERT INTO `shops` (`id`, `id_user`, `name`, `floor`, `logo`) VALUES
(20, 4, 'Магазин 1', 1, '/media/img/m.png'),
(21, 4, 'Магазин 2', 2, '/media/img/n.png'),
(22, 6, 'Магазин 3', 4, '/media/img/o.png'),
(23, 6, 'Магазин 4', 1, '/media/img/U.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL COMMENT 'Уникальный идентификатор пользователя. Нужен для связи с другими таблицами. Первичный ключ',
  `login` varchar(500) NOT NULL COMMENT 'Логин пользователя',
  `password` varchar(500) NOT NULL COMMENT 'Пароль пользователя. Защищен алгоритмом хэширования md5/',
  `name` varchar(500) NOT NULL COMMENT 'Имя пользователя',
  `email` varchar(500) NOT NULL COMMENT 'Почта пользователя',
  `id_role` int NOT NULL COMMENT 'Роль пользователя. Берется из таблицы "roles". Внешний ключ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `email`, `id_role`) VALUES
(3, 'admin', '8762eb814817cc8dcbb3fb5c5fcd52e0', 'admin', 'qwerty@qwerty.qwerty', 3),
(4, 'vladimir', 'e807f1fcf82d132f9bb018ca6738a19f', 'Володя', 'qwerty@qwerty.qwerty', 2),
(5, 'kirill', 'e807f1fcf82d132f9bb018ca6738a19f', 'Кирилл', 'test@test.test', 1),
(6, 'nazar', 'e807f1fcf82d132f9bb018ca6738a19f', 'Назар', 'user@user.user', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_shop` (`id_shop`);

--
-- Индексы таблицы `floor`
--
ALTER TABLE `floor`
  ADD PRIMARY KEY (`floor`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`,`id_item`),
  ADD KEY `id_item` (`id_item`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`floor`),
  ADD KEY `floor` (`floor`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор категории товаров. Нужен для связи с другими таблицами. Первичный ключ', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `floor`
--
ALTER TABLE `floor`
  MODIFY `floor` int NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор этажа. Нужен для связи с другими таблицами.', AUTO_INCREMENT=417;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор товара. Нужен для связи с другими таблицами. Первичный ключ', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор заказа. Нужен для связи с другими таблицами. Первичный ключ', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор товара, находящегося в заказе. Нужен для связи с другими таблицами. Первичный ключ', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор роли. Нужен для связи с другими таблицами. Первичный ключ', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор магазина. Нужен для связи с другими таблицами. Первичный ключ', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор пользователя. Нужен для связи с другими таблицами. Первичный ключ', AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`id_shop`) REFERENCES `shops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shops_ibfk_2` FOREIGN KEY (`floor`) REFERENCES `floor` (`floor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
