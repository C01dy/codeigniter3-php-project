-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 19 2021 г., 16:56
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `registry_rest_api`
--

-- --------------------------------------------------------

--
-- Структура таблицы `registry_table`
--

CREATE TABLE `registry_table` (
  `id` int NOT NULL,
  `smp` varchar(255) NOT NULL,
  `supervisory_authority` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `planned_duration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `registry_table`
--

INSERT INTO `registry_table` (`id`, `smp`, `supervisory_authority`, `date_from`, `date_to`, `planned_duration`) VALUES
(74, 'ООО \'Новый мир\'', 'Роспотребнадзор', '2002-10-20', '2016-10-20', 1),
(75, 'ООО \'Здравствуй, черный понедельник\'', 'Роспотребнадзор', '2004-10-20', '2029-10-20', 9),
(76, 'ООО  \'Пожалуйста, ну работай 1\'', 'Природоохрана', '2026-10-20', '2029-10-20', 9),
(77, 'ООО  \'Пожалуйста, ну работай 2\'', 'Природоохрана', '2008-10-20', '2006-10-20', 4),
(78, 'ООО \'Йойойо\'', 'Роспотребнадзор', '2002-10-20', '2031-10-20', 1234567),
(79, 'dfgdfgdf', 'Природоохрана', '2021-10-01', '2021-10-13', 76767);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `registry_table`
--
ALTER TABLE `registry_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `registry_table`
--
ALTER TABLE `registry_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
