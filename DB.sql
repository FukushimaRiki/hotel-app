-- phpMyAdmin SQL Dump
-- version 5.0.4
-- http://www.phpmyadmin.net
--
-- Host: db
-- Generation Time: 2021 年 2 月 21 日 20:00
-- サーバのバージョン： 10.4.17-MariaDB - mariadb.org binary distribution
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_app`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `users` ユーザテーブル
--

CREATE TABLE `hotel_app`.`users` (
   `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID' ,
   `user_categories` INT(11) NOT NULL COMMENT 'ユーザ区分',
   `last_name` VARCHAR(50) NOT NULL COMMENT '苗字' ,
   `first_name` VARCHAR(50) NOT NULL COMMENT '名前' ,
   `last_name_kana` VARCHAR(50) NOT NULL COMMENT '苗字のフリガナ' ,
   `first_name_kana` VARCHAR(50) NOT NULL COMMENT '名前のフリガナ' ,
   `email` VARCHAR(100) NOT NULL COMMENT 'メールアドレス' ,
   `password` VARCHAR(100) NOT NULL COMMENT 'パスワード' ,
   `tel` VARCHAR(50) NOT NULL COMMENT '電話番号' ,
   `postcode` VARCHAR(50) NOT NULL COMMENT '住所（郵便番号）' ,
   `prefecture_id` VARCHAR(50) NOT NULL COMMENT '住所（都道府県）' ,
   `city` VARCHAR(50) NOT NULL COMMENT '住所（市区町村）' ,
   `block` VARCHAR(50) NOT NULL COMMENT '住所（番地）' ,
   `building` VARCHAR(100) NOT NULL COMMENT '住所（建物名）' ,
   `created_at` DATETIME NOT NULL COMMENT '作成日' ,
   `updated_at` DATETIME NOT NULL COMMENT '更新日' ,
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 --
 -- テーブルのデータのダンプ `plans`
 --

 INSERT INTO `hotel_app`.`users` (`id`, `user_categories`, `last_name`, `first_name`, `last_name_kana`, `first_name_kana`, `email`, `password`, `tel`, `postcode`, `prefecture_id`, `city`, `block`, `building`, `created_at`, `updated_at`) VALUES
 ('1', '1', '管理者', '', '', '', 'admin@mail.com', '$2y$10$ax4ZFI9AFZq04HUCvh21neoTh9W3QTT4gd51a5SHq6qb5/n9dZwT6', '', '', '', '', '', '', '', ''),
 ('2', '2', '田中', '太郎', 'タナカ', 'タロウ', 'user1@mail.com', '$2y$10$aj5x0dpygcVp2OW7JUKfPumBGl8TVCnOPem17QiqEZYYCuS6t/H92', '09031317482', '2030034', '東京都', '東久留米市弥生', '1-1-1', '', '', '');

 -- --------------------------------------------------------

 --
 -- テーブルの構造 `pluns`プランテーブル
 --

 CREATE TABLE `hotel_app`.`plans` (
    `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID' ,
    `name` VARCHAR(50) NOT NULL COMMENT 'プラン名' ,
    `image` VARCHAR(50) NOT NULL COMMENT 'プラン画像' ,
    `number_people` INT(11) NOT NULL COMMENT '人数' ,
    `breakfast` VARCHAR(50) NOT NULL COMMENT '朝食' ,
    `dinner` VARCHAR(50) NOT NULL COMMENT '夕食' ,
    `price` INT(11) NOT NULL COMMENT '宿泊料金' ,
    `created_at` DATETIME NOT NULL COMMENT '作成日' ,
    `updated_at` DATETIME NOT NULL COMMENT '更新日' ,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  --
  -- テーブルのデータのダンプ `plans`
  --

  INSERT INTO `hotel_app`.`plans` (`id`, `name`, `image`, `number_people`, `breakfast`, `dinner`, `price`, `created_at`, `updated_at`) VALUES
  ('1', 'シングル素泊まりプラン', 'single-room.jpg', '1', 'なし', 'なし', '5000', '', ''),
  ('2', 'シングル朝食付きプラン', 'breakfast1.jpg', '1', 'あり', 'なし', '10000', '', ''),
  ('3', 'シングル２食付きプラン', 'dinner1.jpg', '1', 'あり', 'あり', '15000', '', ''),
  ('4', 'ダブル素泊まりプラン', 'double-room.jpg', '2', 'なし', 'なし', '10000', '', ''),
  ('5', 'ダブル朝食付きプラン', 'breakfast2.jpg', '2', 'あり', 'なし', '20000', '', ''),
  ('6', 'ダブル２食付きプラン', 'dinner2.jpg', '2', 'あり', 'あり', '30000', '', '');

-- --------------------------------------------------------

 --
 -- テーブルの構造 `reservations` 予約テーブル
 --

 CREATE TABLE `hotel_app`.`reservations` (
   `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID' ,
   `plans_id` INT(11) NOT NULL COMMENT 'プランID' ,
   `users_id` INT(11) NOT NULL COMMENT 'ユーザID' ,
   `start_date` DATETIME NOT NULL COMMENT '旅行開始日' ,
   `last_date` DATETIME NOT NULL COMMENT '旅行終了日' ,
   `created_at` DATETIME NOT NULL COMMENT '作成日' ,
   `updated_at` DATETIME NOT NULL COMMENT '更新日' ,
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

 --
 -- テーブルの構造 `favorites` お気に入りテーブル
 --

 CREATE TABLE `hotel_app`.`favorites` (
   `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID' ,
   `plans_id` INT(11) NOT NULL COMMENT 'プランID' ,
   `users_id` INT(11) NOT NULL COMMENT 'ユーザID' ,
   `start_date` DATETIME NOT NULL COMMENT '旅行開始日' ,
   `last_date` DATETIME NOT NULL COMMENT '旅行終了日' ,
   `created_at` DATETIME NOT NULL COMMENT '作成日' ,
   `updated_at` DATETIME NOT NULL COMMENT '更新日' ,
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
