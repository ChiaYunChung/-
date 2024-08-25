-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:3306
-- 產生時間： 2024 年 01 月 07 日 13:29
-- 伺服器版本： 10.5.20-MariaDB
-- PHP 版本： 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `id21351669_ncyu_csie_reservation`
--

-- --------------------------------------------------------

--
-- 資料表結構 `classroom_mng`
--

CREATE TABLE `classroom_mng` (
  `id` int(5) UNSIGNED NOT NULL,
  `c_type` text NOT NULL COMMENT '教室 / 研討室 / 多功能視聽教室',
  `c_key` tinyint(1) NOT NULL,
  `ac_remote` tinyint(1) NOT NULL,
  `projector_remote` tinyint(1) NOT NULL,
  `act` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `classroom_mng`
--

INSERT INTO `classroom_mng` (`id`, `c_type`, `c_key`, `ac_remote`, `projector_remote`, `act`) VALUES
(104, '視聽教室', 1, 0, 0, 0),
(401, '教室', 1, 1, 0, 0),
(403, '教室', 1, 1, 0, 0),
(415, '電腦教室', 1, 0, 0, 0),
(523, '研討室', 1, 0, 1, 0),
(524, '研討室', 1, 0, 1, 0),
(3310, '教室', 1, 1, 0, 1),
(3311, '研討室', 1, 0, 1, 1),
(3312, '教室', 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `classroom_rsv`
--

CREATE TABLE `classroom_rsv` (
  `id` int(20) UNSIGNED NOT NULL COMMENT '借用序號',
  `c_id` int(5) UNSIGNED NOT NULL COMMENT '借用教室',
  `d_id` int(5) UNSIGNED NOT NULL COMMENT '使用單位',
  `user_id` varchar(10) NOT NULL,
  `start_time` datetime NOT NULL COMMENT '借用開始時間',
  `end_time` datetime NOT NULL COMMENT '借用結束時間',
  `timestamp` datetime NOT NULL DEFAULT current_timestamp() COMMENT '登記送出時間',
  `object` text NOT NULL COMMENT '借用物品',
  `activity` text NOT NULL COMMENT '場地用途',
  `note` text NOT NULL COMMENT '備註',
  `review_state` int(11) NOT NULL COMMENT '審核狀態 0:未審核 / 1:通過 / 2:未完成 / -1:失敗 / -2:取消',
  `review_comment` text DEFAULT NULL COMMENT '審核回覆'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `classroom_rsv`
--

INSERT INTO `classroom_rsv` (`id`, `c_id`, `d_id`, `user_id`, `start_time`, `end_time`, `timestamp`, `object`, `activity`, `note`, `review_state`, `review_comment`) VALUES
(11, 104, 3, '1102943', '2024-01-10 09:00:00', '2024-01-10 22:00:00', '2024-01-03 03:42:00', ' c_key', '睡覺', '', -1, ''),
(12, 104, 3, '1102943', '2024-01-10 09:00:00', '2024-01-10 22:00:00', '2024-01-03 03:43:23', ' c_key', '睡覺', '', -1, 'ddd'),
(13, 104, 1, '1102943', '2024-01-15 06:00:00', '2024-01-15 06:00:00', '2024-01-03 03:43:37', ' c_key', '睡覺', '', -1, '123'),
(14, 415, 1, '1102943', '2024-01-11 06:00:00', '2024-01-11 07:00:00', '2024-01-03 04:01:49', ' c_key', '偷睡覺', '', -3, '54198'),
(17, 104, 2, 'admin', '2024-01-17 06:00:00', '2024-01-17 07:00:00', '2024-01-03 23:31:41', '<br>c_key', '夜巡', '', 1, ''),
(18, 415, 5, 'admin', '2024-01-18 06:00:00', '2024-01-18 07:00:00', '2024-01-03 23:33:32', '<br>c_key', '吃披薩', '', -3, '555'),
(19, 104, 3, 'admin', '2024-01-18 20:00:00', '2024-01-18 20:01:00', '2024-01-03 23:34:13', '<br>鑰匙', '路過', '', -1, ''),
(20, 104, 1, 'admin', '2024-01-26 06:00:00', '2024-01-26 07:00:00', '2024-01-04 00:39:19', '鑰匙', 'tttt', '', -3, '123'),
(21, 104, 1, 'admin', '2024-01-14 06:00:00', '2024-01-14 07:00:00', '2024-01-04 00:47:18', '鑰匙', '睡覺', '', -1, ''),
(22, 104, 3, '1102943', '2024-01-26 02:00:00', '2024-01-26 02:01:00', '2024-01-06 18:04:10', '鑰匙', '出現一分鐘', '', -1, '遲還三分鐘'),
(23, 524, 9, 'admin', '2024-01-18 06:00:00', '2024-01-18 07:00:00', '2024-01-06 22:46:54', '鑰匙<br>投影機遙控器', '早起咪挺', '', -1, '冷氣未關'),
(24, 415, 3, '1102943', '2024-01-07 10:00:00', '2024-01-07 12:00:00', '2024-01-06 22:51:54', '鑰匙', '上機考', '', 1, ''),
(25, 415, 4, 'admin', '2024-01-24 06:00:00', '2024-01-24 07:00:00', '2024-01-06 16:45:39', '', 'aaaaaaaaaaa', '', -1, ''),
(26, 415, 4, 'admin', '2024-01-24 06:00:00', '2024-01-24 07:00:00', '2024-01-06 16:46:25', '', 'aaaaaaaaaaa', '', -3, ''),
(27, 104, 1, 'admin', '2024-01-17 06:00:00', '2024-01-17 07:00:00', '2024-01-06 16:47:48', '', 'eqewq', '', -3, ''),
(28, 104, 1, 'admin', '2024-01-09 06:00:00', '2024-01-09 07:00:00', '2024-01-06 16:49:00', '鑰匙', 'bbbbbbbbbbb', '', -3, '123'),
(29, 415, 6, 'admin', '2024-01-11 06:00:00', '2024-01-11 07:00:00', '2024-01-06 16:50:08', '鑰匙', '55', '', -3, '用甚麼途'),
(30, 524, 4, '1102943', '2024-01-10 06:00:00', '2024-01-10 07:00:00', '2024-01-06 16:51:49', '鑰匙<br>投影機遙控器', '借', '', -3, '不要'),
(31, 104, 1, '1102943', '2027-10-26 06:00:00', '2027-10-26 07:00:00', '2024-01-06 16:54:46', '鑰匙', 'dddd', '', -3, '不要'),
(32, 104, 1, '1102943', '2024-01-22 06:00:00', '2024-01-22 07:00:00', '2024-01-06 16:57:48', '鑰匙', 'qqqqq', '', 1, ''),
(33, 401, 1, 'admin', '2024-01-15 06:00:00', '2024-01-15 07:00:00', '2024-01-06 17:06:38', '冷氣遙控器', '123', '', 1, '5?'),
(34, 401, 3, '1102924', '2024-01-10 09:00:00', '2024-01-10 11:00:00', '2024-01-06 17:26:01', '冷氣遙控器<br>鑰匙', '上課', '', -2, ''),
(35, 401, 1, '1102924', '2024-01-10 06:00:00', '2024-01-10 12:00:00', '2024-01-06 17:27:04', '冷氣遙控器<br>鑰匙', '555', '', -3, ''),
(36, 104, 3, '1102924', '2024-01-17 06:00:00', '2024-01-17 10:00:00', '2024-01-06 17:30:10', '', '123', '', -3, '111'),
(37, 403, 3, '1102924', '2024-01-24 06:00:00', '2024-01-24 13:00:00', '2024-01-06 17:57:21', '冷氣遙控器<br>鑰匙', '上課', '', -3, '不要'),
(38, 104, 3, 'admin', '2024-01-25 10:00:00', '2024-01-25 12:00:00', '2024-01-06 17:59:06', '鑰匙', '1123', '', -3, ''),
(39, 104, 3, '1102924', '2024-01-17 11:00:00', '2024-01-17 12:00:00', '2024-01-06 18:07:09', '鑰匙', '上課', '', 1, ''),
(40, 403, 3, '1102924', '2024-01-26 06:00:00', '2024-01-26 11:00:00', '2024-01-06 18:07:31', '冷氣遙控器<br>鑰匙', '煮火鍋', '', -3, '?'),
(41, 523, 3, '1102924', '2024-01-16 06:00:00', '2024-01-16 09:00:00', '2024-01-06 18:08:05', '鑰匙<br>投影機遙控器', '咪挺', '', 1, ''),
(42, 104, 1, '1102924', '2024-01-15 06:00:00', '2024-01-15 07:00:00', '2024-01-06 18:15:44', '鑰匙', '1', '', -1, ''),
(43, 104, 1, '1102924', '2024-01-23 06:00:00', '2024-01-23 07:00:00', '2024-01-06 18:15:52', '鑰匙', '1', '', -1, ''),
(44, 104, 1, '1102924', '2024-01-24 06:00:00', '2024-01-24 07:00:00', '2024-01-06 18:16:02', '鑰匙', '11111', '', -1, ''),
(45, 415, 3, '1102924', '2024-02-02 13:00:00', '2024-02-02 17:00:00', '2024-01-06 18:58:45', '鑰匙', '上課', '', 1, ''),
(46, 403, 3, 'admin', '2024-01-15 06:00:00', '2024-01-15 07:00:00', '2024-01-06 19:01:17', '鑰匙', '上課', '', -3, '太早了'),
(47, 403, 3, '1102924', '2024-01-24 10:00:00', '2024-01-24 12:00:00', '2024-01-06 19:03:44', '鑰匙', '上課', '', 1, ''),
(48, 403, 3, '1102999', '2024-01-16 06:00:00', '2024-01-16 07:00:00', '2024-01-06 19:11:22', '鑰匙', '上課', '', 2, ''),
(49, 403, 3, '1102999', '2024-01-15 10:00:00', '2024-01-15 12:00:00', '2024-01-06 19:14:20', '冷氣遙控器<br>鑰匙', '煮湯圓', '', -3, '教室不能煮');

-- --------------------------------------------------------

--
-- 資料表結構 `department_mng`
--

CREATE TABLE `department_mng` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `act` tinyint(4) NOT NULL,
  `vio_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `department_mng`
--

INSERT INTO `department_mng` (`id`, `name`, `act`, `vio_time`) VALUES
(1, '大一', 0, 4),
(2, '大二', 0, 0),
(3, '大三', 0, 4),
(4, '大四', 0, 1),
(5, '碩士班', 0, 0),
(6, '電腦網路（CN LAB）', 0, 0),
(7, '語音通訊（SC LAB）', 0, 0),
(8, '知識與資訊（KI LAB）', 0, 0),
(9, '資訊安全（IS LAB）', 0, 1),
(10, '多媒體應用（MA LAB）', 0, 0),
(11, '網際網路技術（IT LAB）', 0, 0),
(12, '視訊處理及應用（VP LAB）', 0, 0),
(13, '遊戲與動畫技術（GAT LAB）', 0, 0),
(14, '生物資訊探勘（BDM LAB）', 0, 0),
(15, '軟體工程（SE LAB）', 0, 0),
(16, '無線網路（WN LAB）', 0, 0),
(17, '多媒體暨網路安全（MNS LAB）', 0, 0),
(18, '多媒體分析檢索（MAR LAB）', 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `object_mng`
--

CREATE TABLE `object_mng` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `amount` int(5) NOT NULL,
  `act` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `object_mng`
--

INSERT INTO `object_mng` (`id`, `name`, `amount`, `act`) VALUES
(1, '掃把', 111, 0),
(2, '拖把', 3, 0),
(3, '水桶', 85, 0),
(4, '相機A', 1, 0),
(5, '相機電池A', 2, 0),
(6, '腳架', 3, 0),
(7, '攝影機A', 1, 0),
(8, '攝影機電池A', 2, 0),
(9, '乖乖', 2, 1),
(10, '三眼怪怪', 1, 1),
(16, '你才怪', 3, 1),
(17, '抹布', 156, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `object_rsv`
--

CREATE TABLE `object_rsv` (
  `id` int(20) UNSIGNED NOT NULL COMMENT '借用次序',
  `object` text NOT NULL COMMENT '借用項目',
  `d_id` int(5) UNSIGNED NOT NULL COMMENT '借用單位',
  `user_id` varchar(10) NOT NULL,
  `start_time` datetime NOT NULL COMMENT '借用開始時間',
  `end_time` datetime NOT NULL COMMENT '借用結束時間',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '登記送出時間',
  `activity` text NOT NULL COMMENT '用途',
  `note` text NOT NULL COMMENT '備註',
  `review_state` int(11) NOT NULL COMMENT '審核狀態 -1:失敗/0:未審核/1:通過/2:未完成',
  `review_comment` text NOT NULL COMMENT '審核回覆'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `object_rsv`
--

INSERT INTO `object_rsv` (`id`, `object`, `d_id`, `user_id`, `start_time`, `end_time`, `timestamp`, `activity`, `note`, `review_state`, `review_comment`) VALUES
(3, '拖把 ： 3個<br>水桶 ： 9個<br>', 1, 'admin', '2024-01-11 06:00:00', '2024-01-11 07:00:00', '2024-01-06 14:40:07', '123', '', 2, '???'),
(4, '水桶 ： 2個<br>', 1, 'admin', '2024-01-17 06:00:00', '2024-01-17 07:00:00', '2024-01-06 14:40:46', 'ddd', '', -3, '??'),
(5, '相機A ： 1個<br>相機電池A ： 1個<br>腳架 ： 1個<br>', 3, '1102943', '2024-01-24 06:00:00', '2024-01-24 06:01:00', '2024-01-06 14:40:59', '拍攝一分鐘', '', 1, ''),
(6, '掃把 ： 111個<br>', 3, '1102943', '2024-01-25 06:00:00', '2024-01-25 07:00:00', '2024-01-06 14:27:37', '把掃把拿去賣', '', 0, ''),
(7, '掃把 ： 100個<br>', 3, 'admin', '2024-01-24 06:00:00', '2024-01-24 07:00:00', '2024-01-06 17:00:31', '打架', '', 1, ''),
(8, '掃把 ： 100個<br>', 3, 'admin', '2024-01-24 06:00:00', '2024-01-24 07:00:00', '2024-01-06 17:00:18', '打架', '', -3, ''),
(9, '掃把 ： 100個<br>', 3, '1102924', '2024-01-16 06:00:00', '2024-01-16 07:00:00', '2024-01-06 18:13:20', '拿去賣', '', -3, '?'),
(10, '相機A ： 1個<br>', 3, '1102924', '2024-01-15 06:00:00', '2024-01-15 07:00:00', '2024-01-06 18:11:37', '拍照', '', -2, ''),
(11, '相機A ： 1個<br>', 3, '1102924', '2024-01-30 06:00:00', '2024-01-30 12:00:00', '2024-01-06 18:13:33', '拍照', '', -1, ''),
(12, '水桶 ： 80個<br>', 3, '1102924', '2024-01-17 06:00:00', '2024-01-17 07:00:00', '2024-01-06 18:14:39', '給波妞住', '', 0, ''),
(13, '掃把 ： 100個<br>拖把 ： 2個<br>', 3, '1102999', '2024-01-18 06:00:00', '2024-01-18 07:00:00', '2024-01-06 19:16:55', '蓋房子', '', 0, ''),
(14, '掃把 ： 10個<br>拖把 ： 2個<br>水桶 ： 1個<br>', 3, '1102999', '2024-01-22 06:00:00', '2024-01-22 07:00:00', '2024-01-06 19:17:36', '愛戲服務', '', -2, ''),
(15, '掃把 ： 10個<br>拖把 ： 3個<br>水桶 ： 1個<br>', 3, '1102999', '2024-01-18 06:00:00', '2024-01-18 07:00:00', '2024-01-06 19:18:59', '愛戲服務', '', 1, ''),
(16, '相機A ： 1個<br>', 3, '1102999', '2024-01-15 06:00:00', '2024-01-15 07:00:00', '2024-01-06 19:21:11', '拍照', '', 1, '準時歸還');

-- --------------------------------------------------------

--
-- 資料表結構 `user_mng`
--

CREATE TABLE `user_mng` (
  `id` varchar(10) NOT NULL,
  `level` varchar(5) NOT NULL COMMENT '學生/教職員工/管理者',
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `blocked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `user_mng`
--

INSERT INTO `user_mng` (`id`, `level`, `name`, `phone`, `email`, `password_hash`, `blocked`) VALUES
('1100000', 'user', 'Ire', '0900000000', 's1100000@mail.ncyu.edu.tw', '$2y$10$5TqS4rszy.rHqa0cmEMTuOULPHVfKPiK3RJztNBnatm.dRtTjBYiq', 0),
('1102924', 'user', '李名智', '0922000000', 's1102924@mail.ncyu.edu.tw', '$2y$10$EI2x7/3TSDVP8tVBeVe1c.4.LWF1XyH.aIrUM2cWTP.VSMAscfB7i', 0),
('1102943', 'user', '顏莉諭', '0979000000', 's1102943@mail.ncyu.edu.tw', '$2y$10$pcmt0RXBOVSZ8XvyTsFla./mCsSXN4Sl1lDknKobc2LYxwy2kSGq6', 0),
('1102962', 'user', '鍾佳妘', '0975000000', 's1102962@mail.ncyu.edu.tw', '$2y$10$2dt/lycNTyklikFjoDugxuW9XYMSvB.F.khis2u9WOOBDnxidlIP.', 0),
('1102999', 'user', '123', '0922222222', 's1102999@mail.ncyu.edu.tw', '$2y$10$gE6x6fz6FrKnHYUD9yYrU.xJdUpHR0ChM2gUkNnwa1iph6OKDyLEW', 1),
('admin', 'admin', '管理員', '052717740', 's1102943@mail.ncyu.edu.tw', '$2y$10$VabA9qsmyhgIU1NrSkFdVOQPYK0ra8KBSbM8HtYVtvuSWaGmUnbTC', 0),
('admin2', 'admin', '管理員', '052717740', 's1102943@mail.ncyu.edu.tw', '$2y$10$VWnF8TcQteZVJF2g5xHkZe3CE1TzIb6u/SFtuJ/gP.WWjv3Ehstqi', 0),
('admin3', 'admin', '管理員', '052717740', 's1102943@mail.ncyu.edu.tw', '$2y$10$xAbxV1Rnp6lB22rbRw68U.nv0XctnFqldRwtI6j7T7ItGSjj5A6cy', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `violation_mng`
--

CREATE TABLE `violation_mng` (
  `d_id` int(5) UNSIGNED NOT NULL,
  `c_rsv_id` int(5) UNSIGNED NOT NULL,
  `detail` varchar(255) NOT NULL,
  `times` int(5) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `violation_mng`
--

INSERT INTO `violation_mng` (`d_id`, `c_rsv_id`, `detail`, `times`, `date`) VALUES
(3, 12, 'ddd', 1, '2024-01-03'),
(3, 19, '', 2, '2024-01-04'),
(1, 21, '', 1, '2024-01-04'),
(3, 22, '遲還三分鐘', 3, '2024-01-06'),
(9, 23, '冷氣未關', 1, '2024-01-06'),
(4, 25, '', 1, '2024-01-07'),
(3, 11, '', 4, '2024-01-07'),
(1, 44, '', 2, '2024-01-07'),
(1, 43, '', 3, '2024-01-07'),
(1, 42, '', 4, '2024-01-07');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `classroom_mng`
--
ALTER TABLE `classroom_mng`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `classroom_rsv`
--
ALTER TABLE `classroom_rsv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`,`d_id`,`user_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `classroom_rsv_ibfk_3` (`d_id`);

--
-- 資料表索引 `department_mng`
--
ALTER TABLE `department_mng`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `object_mng`
--
ALTER TABLE `object_mng`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `object_rsv`
--
ALTER TABLE `object_rsv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `d_id` (`d_id`);

--
-- 資料表索引 `user_mng`
--
ALTER TABLE `user_mng`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `violation_mng`
--
ALTER TABLE `violation_mng`
  ADD KEY `c_mng_id` (`c_rsv_id`),
  ADD KEY `c_rsv_id` (`c_rsv_id`),
  ADD KEY `d_id` (`d_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `classroom_rsv`
--
ALTER TABLE `classroom_rsv`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '借用序號', AUTO_INCREMENT=50;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `department_mng`
--
ALTER TABLE `department_mng`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `object_mng`
--
ALTER TABLE `object_mng`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `object_rsv`
--
ALTER TABLE `object_rsv`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '借用次序', AUTO_INCREMENT=17;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `classroom_rsv`
--
ALTER TABLE `classroom_rsv`
  ADD CONSTRAINT `classroom_rsv_ibfk_3` FOREIGN KEY (`d_id`) REFERENCES `department_mng` (`id`),
  ADD CONSTRAINT `classroom_rsv_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user_mng` (`id`),
  ADD CONSTRAINT `classroom_rsv_ibfk_5` FOREIGN KEY (`c_id`) REFERENCES `classroom_mng` (`id`);

--
-- 資料表的限制式 `object_rsv`
--
ALTER TABLE `object_rsv`
  ADD CONSTRAINT `object_rsv_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_mng` (`id`),
  ADD CONSTRAINT `object_rsv_ibfk_4` FOREIGN KEY (`d_id`) REFERENCES `department_mng` (`id`);

--
-- 資料表的限制式 `violation_mng`
--
ALTER TABLE `violation_mng`
  ADD CONSTRAINT `violation_mng_ibfk_2` FOREIGN KEY (`c_rsv_id`) REFERENCES `classroom_rsv` (`id`),
  ADD CONSTRAINT `violation_mng_ibfk_3` FOREIGN KEY (`d_id`) REFERENCES `department_mng` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
