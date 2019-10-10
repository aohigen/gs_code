-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2019 年 10 月 10 日 23:25
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `quiz_app`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(64) NOT NULL,
  `user_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `plan` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `admin_flg` int(64) NOT NULL,
  `life_flg` int(64) NOT NULL,
  `answer_times` int(128) NOT NULL,
  `crct_times` int(11) NOT NULL DEFAULT '0',
  `quiz_times` int(128) NOT NULL,
  `regist_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_name`, `email`, `password`, `plan`, `admin_flg`, `life_flg`, `answer_times`, `crct_times`, `quiz_times`, `regist_date`) VALUES
(1, 'tanaka', 'gokuu@gmail.com', '$2y$10$sHpGlG2Cp6iC6e8qJoDBGuvUvi222QD3CklesEHNU61HcKycO7pLC', 'silver', 0, 0, 0, 0, 0, '2019-10-08'),
(2, 'tetora', 'aohigen@gmail.com', '$2y$10$R55NNfmQ4ECj5q./oEKKRe4EraPEdtolzAsuqlELVIBvod9YPoycy', 'gold', 0, 0, 0, 0, 0, '2019-10-08'),
(3, 'takesi', 'gokuu@gmail.com', '$2y$10$FIz9Nss2s3gDLjz9V4ENheag5pfUBD4/KlhsuiVRpU7bF1IUm6uF6', 'silver', 0, 1, 0, 0, 0, '2019-10-09'),
(4, 'dfasdfasf', 'aohigen@gmail.com', '$2y$10$zHoNh0.yH8jed8gBsh.nauaeKj07pX.Lkx9LQsuock2xIL5.vHqCm', 'silver', 0, 1, 0, 0, 0, '2019-10-09'),
(5, 'dfasdfasfd', 'aohigen@gmail.com', '$2y$10$/GL7Lvw4/FsN2fY.15emY.Mynz4gvM9y3jYqNr5GAeSe6sgnTD1MK', 'silver', 0, 1, 1, 1, 0, '2019-10-09'),
(6, 'niijima', 'aohigen@gmail.com', '$2y$10$MFv7k3wo6mPHBP45UIxq0.P.PKjhY49b78q5vwyZYDv87yrVZtQrS', 'silver', 0, 1, 118, 31, 7, '2019-10-09');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
