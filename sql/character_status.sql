-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-01-05 15:44:11
-- サーバのバージョン： 10.4.27-MariaDB
-- PHP のバージョン: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsy_d03_04`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `character_status`
--

CREATE TABLE `character_status` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `caption` varchar(140) DEFAULT NULL,
  `pl_name` varchar(11) DEFAULT NULL,
  `attack` int(1) NOT NULL DEFAULT 3,
  `toughness` int(1) NOT NULL DEFAULT 3,
  `speed` int(1) NOT NULL DEFAULT 3,
  `technic` int(1) NOT NULL DEFAULT 3,
  `imagination` int(1) NOT NULL DEFAULT 3,
  `chase` int(1) NOT NULL DEFAULT 3,
  `insert_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `character_status`
--

INSERT INTO `character_status` (`id`, `file_name`, `file_path`, `caption`, `pl_name`, `attack`, `toughness`, `speed`, `technic`, `imagination`, `chase`, `insert_time`, `update_time`) VALUES
(4, 'hino.png', 'images\\ 20230104174002hino.png', '再テスト', 'ヒノトリ', 3, 6, 3, 3, 6, 3, '2023-01-05 01:40:02', '2023-01-05 01:40:02'),
(5, 'obake_g.png', 'images\\ 20230104175719obake_g.png', 'ささおきば様より', 'おばけ', 2, 3, 6, 2, 2, 6, '2023-01-05 01:57:19', '2023-01-05 01:57:19'),
(6, 'robot_f.png', 'images\\ 20230104182751robot_f.png', 'ロボ', 'ロボット', 3, 3, 3, 3, 3, 3, '2023-01-05 02:27:51', '2023-01-05 02:27:51');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `character_status`
--
ALTER TABLE `character_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `file_path` (`file_path`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `character_status`
--
ALTER TABLE `character_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
