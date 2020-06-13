-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2020 年 6 月 13 日 21:50
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `twitter_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `tweet_contents`
--

CREATE TABLE `tweet_contents` (
  `tweet` varchar(140) NOT NULL,
  `id` int(11) NOT NULL,
  `indate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tweet_contents`
--

INSERT INTO `tweet_contents` (`tweet`, `id`, `indate`) VALUES
('朝はパン。', 59, '2020-06-11 23:17:21.000000'),
('眠眠打破。', 60, '2020-06-11 23:17:34.000000'),
('ストロングZ', 61, '2020-06-11 23:17:57.000000'),
('ルマンド', 62, '2020-06-11 23:18:13.000000'),
('あああああ', 63, '2020-06-13 15:12:54.000000'),
('今日の天気は？', 64, '2020-06-13 15:18:08.000000');

-- --------------------------------------------------------

--
-- テーブルの構造 `twitter_account`
--

CREATE TABLE `twitter_account` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `username` varchar(24) DEFAULT NULL,
  `name` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `twitter_account`
--

INSERT INTO `twitter_account` (`id`, `email`, `password`, `username`, `name`) VALUES
(79, 'ashitaaaa', 'haretaaaa', 'noboruuuu', 'asahiga'),
(80, 'test@mail.com', 'testtestes', 'sesese', 'tetetete'),
(81, 'nakakaka', 'katamari', 'itai', 'kasabuta'),
(82, 'login', 'only', NULL, NULL),
(83, 'test@gmail.com', 'test', NULL, NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `tweet_contents`
--
ALTER TABLE `tweet_contents`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `twitter_account`
--
ALTER TABLE `twitter_account`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `tweet_contents`
--
ALTER TABLE `tweet_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- テーブルのAUTO_INCREMENT `twitter_account`
--
ALTER TABLE `twitter_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
