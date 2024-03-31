-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 31, 2022 at 11:46 PM
-- Server version: 5.7.38-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `live_port10`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_groups`
--

CREATE TABLE `admin_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `store_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_groups`
--

INSERT INTO `admin_groups` (`id`, `name`, `description`, `store_type`) VALUES
(1, 'webmaster', 'Webmaster', 'KWT'),
(2, 'admin', 'Admin', 'KWT'),
(5, 'vendor', 'vendor', 'KWT'),
(8, 'branch', 'branch', 'KWT'),
(10, 'subsupplier', 'subsupplier', 'KWT');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `group_id` varchar(100) NOT NULL DEFAULT '9',
  `first_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `entity_name` varchar(255) DEFAULT NULL,
  `phone` varchar(100) NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL,
  `social` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `newsletter` tinyint(4) NOT NULL COMMENT '1 mean subscribtion for newsletter 0 means else',
  `source` varchar(11) NOT NULL,
  `own_refere_id` varchar(11) DEFAULT NULL,
  `refer_count` int(255) NOT NULL DEFAULT '0',
  `invite_code` varchar(255) DEFAULT NULL,
  `token` longtext,
  `fcm_no` varchar(255) DEFAULT NULL,
  `created_on` varchar(255) NOT NULL,
  `type` varchar(11) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `ip_address` varchar(15) NOT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `slug` varchar(255) DEFAULT '',
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `street_name` varchar(255) NOT NULL,
  `building_no` varchar(255) NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `vat_number` varchar(50) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `iban` varchar(100) DEFAULT NULL,
  `is_email_verify` tinyint(4) NOT NULL COMMENT '1 means email verified o mean not verify',
  `subs_start_date` date NOT NULL,
  `subs_end_date` date NOT NULL,
  `subs_status` varchar(10) NOT NULL,
  `is_terminate` tinyint(4) NOT NULL COMMENT '1 means yes 0 means no',
  `is_trial_email_send` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 means sned yes 0 means no',
  `is_iban` tinyint(1) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `access_permission` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `email`, `address`, `active`, `group_id`, `first_name`, `last_name`, `entity_name`, `phone`, `logo`, `social`, `newsletter`, `source`, `own_refere_id`, `refer_count`, `invite_code`, `token`, `fcm_no`, `created_on`, `type`, `activation_code`, `ip_address`, `forgotten_password_time`, `remember_code`, `slug`, `forgotten_password_code`, `salt`, `last_login`, `street_name`, `building_no`, `city`, `state`, `postal_code`, `country`, `vat_number`, `bank_name`, `iban`, `is_email_verify`, `subs_start_date`, `subs_end_date`, `subs_status`, `is_terminate`, `is_trial_email_send`, `is_iban`, `seller_id`, `access_permission`) VALUES
(1, 'Port10Admin', '$2y$08$FdvpDeQh.Bd.zQiKuIhTAOsEb7TjYToJYINaBWx5M8MLGFWzKO4SK', 'Port10Admin', 'sargam society nanded city pune', 1, '1', 'Anwar', 'Adushe', '', '34234', '6968.png', '', 1, '', '', 0, '', '', '', '2019', '', NULL, '', NULL, '5kgXJRXBXAhdIom0qvWlze', '', '5ee1cb520921f', NULL, 1659269312, 'Eastern Ring Road – Exit 8 – Al Rabwah District', 'Granada Business Towers Tower A4 – Unit 24', 'Abha', 'State', '12824', 'Saudi Arabia', '', '10', '', 1, '0000-00-00', '0000-00-00', '', 0, 0, 0, NULL, NULL),
(2, '10010847995', '$2y$10$2Sm5q68EXkaO1SMWlAyA3ucbWXecFgN1V4y1NvGXjEF57kYD8lfGS', 'a.alrbiah@aplaco.com.sa', '', 1, '5', 'aplaco', '', 'aplaco', '0533298789', 'user_chat.png', 'normal', 1, 'web', '', 0, '', '', '', '2021/07/01 06:01:21', 'suppler', NULL, '77.240.83.98', NULL, NULL, '', NULL, NULL, NULL, '', '', 'Abha', 'Riyadh', '', 'Saudi Arabia', '10002220002', '12', 'sa9291-1-0-10102939999999', 1, '2021-07-01', '2021-10-01', 'expired', 0, 1, 0, NULL, NULL),
(3, '123456789', '$2y$10$zmm/DnTgt2HZ3rvFiDoIieFz.T/fz25Sgqc3FRcopTKKvuuNVXNGW', 'quamer123@gmail.com', '', 1, '9', 'quameruddin', '', 'siddiqui', '8482901476', 'f5b9613a4fae0325ce8e619387cae3f797.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/02/18 08:43:39', 'buyer', NULL, '106.220.161.34', NULL, NULL, '', NULL, NULL, NULL, 'test address', '456', 'Abha', 'Riyadh', '75471', 'Saudi Arabia', '123456', '21', '12312323123', 1, '0000-00-00', '0000-00-00', '', 0, 0, 0, NULL, NULL),
(4, '123456', '$2y$10$JkXrhUHoN3RHY3TK3GACyOkkuHmN26xwR6AdO2zvXZ7e4elwjEBVG', 'quamer313@gmail.com', '', 1, '5', 'shaikh', '', 'irfan', '12345678', 'user_chat.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/02/18 08:47:11', 'suppler', NULL, '106.220.161.34', NULL, NULL, '', NULL, NULL, 1658857119, 'test address', '456', 'Abha', 'Sakaka', '62217', 'Saudi Arabia', '123456', '21', '231313123', 1, '2022-02-18', '2022-12-31', 'trial', 0, 1, 0, NULL, NULL),
(5, '88888888888', '$2y$10$Pjm7rOtFQOXMS7m6/XKYXOKI56KcOelGHiHCuyjhnX0l8MNrzeTFa', 'mitchlove@yahoo.com', '', 1, '5', 'mitchlove', '', 'DTS', '+966507921171', 'user_chat.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/03/16 05:41:43', 'suppler', NULL, '155.138.71.40', NULL, NULL, '', NULL, NULL, NULL, 'Riyadh', '1122', 'Abha', 'Riyadh', '77425', 'Saudi Arabia', '12', '11', '1', 1, '2022-03-16', '2022-06-16', 'expired', 0, 1, 0, NULL, NULL),
(6, '12345678900003', '$2y$10$pR2wrL04t0liimr3AhJ2Seu40WouBW5vC6qXxsvNJhG2VEvUod5Xq', 'mohammedayem@port10.sa', '', 1, '5', 'Mohammed Abduldayem', '', 'Abduldayem', '0501242611', 'user_chat.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/03/30 05:32:14', 'suppler', NULL, '37.216.237.46', NULL, NULL, '', NULL, NULL, NULL, 'Eastern Ring Branch Rd', 'Ash Shuhada District', 'Abha', 'Riyadh', '11564', 'Saudi Arabia', '123123123123', '10', '123123123123123', 0, '2022-03-30', '2022-12-31', 'trial', 0, 0, 0, NULL, NULL),
(7, '1234566', '$2y$10$CXVHjAiZebZNQ9lu1oOZb.PkQ8SFJyT49Cqa07kSlIj0.A70V/vn6', 'quamer1231@gmail.com', '', 1, '5', 'siddiqui', '', 'test entity', '8999050182', 'user_chat.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/03/30 05:43:26', 'suppler', NULL, '106.210.239.70', NULL, NULL, '', NULL, NULL, NULL, 'Street Name', 'Building Num', 'Abha', 'Al-Baha', '55425', 'Saudi Arabia', '12121212', '9', '121212121', 0, '2022-03-30', '2022-12-31', 'trial', 0, 0, 0, NULL, NULL),
(8, '123456789900003', '$2y$08$qjPGT1V9whftUtxzrQ5FDuU5L1nA8KHifcwexAZbg8CUKNhooTMtC', 'mabduldayem@digitalworld.com.sa', '', 1, '5', 'Mohammed Abduldayem', '', 'TAFTS', '050124261', '6772.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/03/30 05:48:14', 'suppler', NULL, '37.216.237.46', NULL, 'jzcZL2E9ZbQN8qhRAFZLEu', '', NULL, NULL, 1653910504, 'Eastern Ring Branch Rd', 'Ash Shuhada District', 'Abha', 'Riyadh', '11564', 'Saudi Arabia', '123456789900003', '10', '123123123123123', 1, '2022-03-30', '2022-12-31', 'trial', 0, 0, 0, NULL, NULL),
(9, 'Port10SubAdmn', '$2y$08$FdvpDeQh.Bd.zQiKuIhTAOsEb7TjYToJYINaBWx5M8MLGFWzKO4SK', 'Port10SubAdmn', 'sargam society nanded city pune', 1, '2', 'sup admin', 'sup admin', '', '', '6434.png', '', 1, '', '', 0, '', '', '', '', '', NULL, '', NULL, NULL, '', NULL, NULL, 1654622475, 'Eastern Ring Road – Exit 8 – Al Rabwah District', 'Granada Business Towers Tower A4 – Unit 24', 'Abha', 'State', '12824', 'Saudi Arabia', '', '', '', 1, '0000-00-00', '0000-00-00', '', 0, 0, 0, NULL, NULL),
(10, '123', '$2y$10$kZj/r040XdOEzXm1zzg7C.6cHkVFapKnUDRNb02sPJM.03mNvolYu', 'prishu@mailinator.com', '', 1, '5', 'prishu', '', 'Prishu', 'phone', '9139.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/04/04 02:44:40', 'suppler', NULL, '110.227.30.245', NULL, NULL, '', '625fb48435298', NULL, 1656079642, 'Street name', 'Building Num / Suite Num / Office Num', 'Abha', 'Abha', '26312', 'Saudi Arabia', 'VAT number', '9', 'IBAN', 1, '2022-04-04', '2022-12-31', 'trial', 0, 0, 0, NULL, NULL),
(11, '1234', '$2y$10$syjysieHTumZzwm2ITRK2Os6qvMGk5m/G8Y/G8a7bj8ir5w14Lv92', 'varada@mailinator.com', '', 1, '9', 'varada', '', 'Varada', '94043198772', '02c460baa8ff0fbfcea1e3feff0acaf240.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/04/05 04:37:20', 'buyer', NULL, '110.227.30.233', NULL, NULL, '', '625e5463ba651', NULL, NULL, 'Street Name', 'Building Num / Suite Num / Office Num', 'Abha', 'Al-Baha', '55211', 'Saudi Arabia', 'VAT123', '16', 'IBAN123', 1, '0000-00-00', '0000-00-00', '', 0, 0, 0, NULL, NULL),
(12, '1010498952', '$2y$10$M/4HzZIFaAlMmKfJDg2Heu/V6lAHyt/v3fAc09kt3QIdmpqbqOyx6', 'FIN@MUNIPACK.COM', '', 1, '5', 'mohamed', '', 'شركة مصنع منيف للتعبئة والتغليف', '541895132', 'user_chat.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/04/07 04:50:31', 'suppler', NULL, '155.138.79.1', NULL, NULL, '', NULL, NULL, NULL, '', '', 'Abha', 'Riyadh', '', 'Saudi Arabia', '310132582300003', '2', 'SA934500000013666664001', 0, '2022-04-07', '2022-12-31', 'trial', 0, 0, 0, NULL, NULL),
(13, '4030298277', '$2y$10$NhkrKHPseFXLE1ZgLS6dNuLgm0NLQg4mNedv7x9wRbxKGAvZl07oe', 'info@munawwara.com', '', 1, '5', 'dmtc', '', 'شركة درة المنورة للنقليات', '0544041111', 'user_chat.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/04/13 04:05:52', 'suppler', NULL, '31.167.218.40', NULL, NULL, '', NULL, NULL, NULL, 'شارع فلسطين', 'مبنى وصال 7575 الدور الرابع مكتب 408', 'Abha', 'Makkah', '20012', 'Saudi Arabia', '310860207100003', '10', 'SA5080000391608010222880', 1, '2022-04-13', '2022-12-31', 'trial', 0, 0, 0, NULL, NULL),
(14, '1010656650', '$2y$10$vigMNiK3ut9UvGV3Ihbip.ANEm/c1ngwFMnHwKihUPXLqvEMV5yda', 'mofo0117@gmail.com', '', 1, '5', 'Mohamd', '', 'الفوزان لصناعة السيارات', '0114466644', 'user_chat.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/04/14 02:22:25', 'suppler', NULL, '78.95.85.41', NULL, NULL, '', NULL, NULL, NULL, 'المدينه الصناعيه', '٥١١', 'Abha', 'Riyadh', '', 'Saudi Arabia', '1827377484848483848', '10', 'SA1580000449608010183944', 1, '2022-04-14', '2022-12-31', 'trial', 0, 0, 0, NULL, NULL),
(15, '9404', '$2y$10$/PyTuNt/nBnQwjjPMPlSc.gCt5lVY4rzYFbFewwRheQ3S6tlYqZjm', 'aayu@mailinator.com', '', 1, '5', 'aayu', '', 'Aayu', '1234', 'user_chat.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/04/20 01:05:22', 'suppler', NULL, '106.220.219.4', NULL, NULL, '', NULL, NULL, NULL, 'Street address', '', 'Abha', 'Ar\'ar', '61961', 'Saudi Arabia', '1243', '9', '123', 0, '2022-04-20', '2022-12-31', 'trial', 0, 0, 0, NULL, NULL),
(16, '1234567899000033', '$2y$10$Z8DZI4g.SMyss/jAxSO0RekgY9Iu0hmo/3ky2gwDzVAL7ukhx9sMu', 'rijoyim903@dakcans.com', '', 1, '5', 'adasd', '', 'dasda', '05012426', 'user_chat.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/05/16 05:49:18', 'suppler', NULL, '37.216.237.46', NULL, NULL, '', NULL, NULL, 1652789941, 'Eastern Ring Branch Rd', 'Ash Shuhada District', 'Abha', 'Riyadh', '55425', 'Saudi Arabia', '1231231231233', '10', '12421', 1, '2022-05-16', '2022-12-31', 'trial', 0, 0, 0, NULL, NULL),
(17, '1075484186', '$2y$10$mMSd2vHIGl28v5Zm20BayuRz9eWATzxzSsz3I18Jnh7C7Un8ZBsNG', 'mm.alsaftty@gmail.com', '', 1, '5', 'Mohammed', '', 'Baking Up', '0530872583', 'user_chat.png', 'normal', 1, 'web', '', 0, '', '', '', '2022/05/18 06:18:20', 'suppler', NULL, '77.232.107.173', NULL, NULL, '', NULL, NULL, NULL, 'محمد الفاتح', '', 'Abha', 'Dammam', '', 'Saudi Arabia', '000000000', '5', 'sa23232323232323', 1, '2022-05-18', '2022-12-31', 'trial', 0, 0, 0, NULL, NULL),
(18, '456789', '$2y$10$GNszdOR1hH1M/LCa/DgQuOboYPmo0XwxJYvJ2NEnrwToQ38w2rLKS', 'subs@mailinator.com', NULL, 1, '10', 'siddiqui', NULL, NULL, '84829014761', 'user_chat.png', '', 0, '', '', 0, '', '', '', '2022/06/02 11:20:51', 'subsupplier', NULL, '106.195.1.60', NULL, NULL, '', NULL, NULL, 1656266098, 'Street Name', 'Building Num', 'Abha', 'Al-Baha', '25725', 'Saudi Arabia', '', '', '', 1, '2022-02-18', '2022-12-31', 'trial', 0, 0, 0, 4, 'vorders,receive_quotation,product,chat,brand'),
(19, '45678902', '$2y$10$eZPeEK85kQ4Hnh1vPyIhsOySkEup0a0BBKRasOXRAIY9f2qyeZ1B6', 'subs02@mailinator.com', NULL, 1, '10', 'muntazar', '', NULL, '848290147602', 'user_chat.png', 'normal', 0, '', NULL, 0, NULL, NULL, NULL, '2022/06/02 11:26:39', 'subsupplier', NULL, '106.195.2.200', NULL, NULL, '', NULL, NULL, 1654249016, 'Street Name', 'Building Num', 'Abha', 'Abha', '25725', 'Saudi Arabia', NULL, NULL, NULL, 1, '2022-02-18', '2022-12-31', 'trial', 0, 0, 0, 4, 'product'),
(20, '122', '$2y$10$l4piwCdfvUQOgXMujNyZpe.899BAP6idZOkvl/Z2crd5r3b82SOZS', 'rush@gmail.com', NULL, 1, '9', 'rohit', '', 'persausive', '7741971831', 'user_chat.png', 'normal', 1, 'web', NULL, 0, NULL, NULL, NULL, '2022/06/09 11:48:18', 'buyer', NULL, '152.57.237.160', NULL, NULL, '', NULL, NULL, NULL, 'Ramajaram', 'test', 'Abha', 'Jazan', '411051', 'Saudi Arabia', '3143243', '7', 'abc23433q', 0, '0000-00-00', '0000-00-00', '', 0, 0, 0, NULL, NULL),
(21, '5566', '$2y$10$Tvt8PFJrEB/khPfLTwFjyeDmP7M2330yPlWrEuBrA.ZR3FCL53c5i', 'key@mailinator.com', NULL, 1, '5', 'siddiqui', '', 'Techno', '84829014767', 'user_chat.png', 'normal', 1, 'web', NULL, 0, NULL, NULL, NULL, '2022/06/24 10:15:44', 'suppler', NULL, '117.99.243.210', NULL, NULL, '', NULL, NULL, NULL, 'Street Name', 'Building Num', 'Abha', 'Al-Baha', '431401', 'Saudi Arabia', '12121212', '8', 'fdsfasda fsdfasd', 1, '2022-06-24', '2022-12-31', 'trial', 0, 0, 0, NULL, NULL),
(22, '558899', '$2y$10$LdNfiWo8.eskUUZtFh92euktVWpzDXBx20Iv2dOkSmaERxyGqbo22', 'quamer5588@gmail.com', NULL, 1, '10', 'irfan', '', NULL, '8482901478', 'user_chat.png', 'normal', 0, '', NULL, 0, NULL, NULL, NULL, '2022/07/15 04:13:37', 'subsupplier', NULL, '106.195.0.153', NULL, NULL, '', NULL, NULL, 1658857377, 'test', 'test', 'Abha', 'Al-Baha', '431401', 'Saudi Arabia', NULL, NULL, NULL, 1, '2022-02-18', '2022-12-31', 'trial', 0, 0, 0, 4, 'vorders,receive_quotation,product,buyer_account'),
(23, '788999', '$2y$10$k3qZL3V2Eu4TEC/ZOqVAPetvm1RmA603wrKiKBQ282WtV4POU9LeO', 'rohit@persausive.com', NULL, 1, '5', 'rohit', '', 'rushi', '48290155', 'user_chat.png', 'normal', 1, 'web', NULL, 0, NULL, NULL, NULL, '2022/07/15 04:45:00', 'suppler', NULL, '106.210.172.217', NULL, NULL, '', NULL, NULL, NULL, 'test', 'test', 'Afif', 'Al-Baha', '431401', 'Saudi Arabia', '1212121', '8', '23423423', 1, '2022-07-15', '2022-12-31', 'trial', 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users_groups`
--

CREATE TABLE `admin_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `store_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users_groups`
--

INSERT INTO `admin_users_groups` (`id`, `user_id`, `group_id`, `store_type`) VALUES
(1, 1, 1, 'KWT'),
(3, 2, 5, ''),
(4, 4, 5, ''),
(5, 5, 5, ''),
(6, 6, 5, ''),
(7, 7, 5, ''),
(8, 8, 5, ''),
(9, 9, 2, ''),
(10, 10, 5, ''),
(11, 12, 5, ''),
(12, 13, 5, ''),
(13, 14, 5, ''),
(14, 15, 5, ''),
(15, 16, 5, ''),
(16, 17, 5, ''),
(17, 18, 10, NULL),
(18, 19, 10, NULL),
(19, 21, 5, NULL),
(20, 22, 10, NULL),
(21, 23, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `item_priority` varchar(255) NOT NULL,
  `display_type` varchar(255) NOT NULL,
  `store_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`id`, `name`, `item_priority`, `display_type`, `store_type`) VALUES
(19, 'Color', '1', 'color', 'KWT'),
(20, 'Size', '2', 'dropdown', 'KWT');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_item`
--

CREATE TABLE `attribute_item` (
  `id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `i_priority` varchar(255) NOT NULL,
  `item_value` varchar(255) NOT NULL,
  `store_type` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `bank_name`) VALUES
(1, 'Saudi National Bank'),
(2, 'The Saudi British Bank'),
(3, 'Saudi Investment Bank'),
(4, 'Alinma Bank'),
(5, 'Banque Saudi Fransi'),
(6, 'Riyad Bank'),
(7, 'Al Rajhi Bank'),
(8, 'Arab National Bank'),
(9, 'Bank AlBilad'),
(10, 'Bank AlJazir'),
(11, 'Gulf International Bank Saudi Arabia'),
(12, 'Emirates NBD'),
(13, 'National Bank of Bahrain'),
(14, 'National Bank of Kuwait'),
(15, 'Bank Muscat'),
(16, 'Deutsche Bank'),
(17, 'BNP Paribas'),
(18, 'J.P. Morgan Chase N.A'),
(19, 'National Bank Of Pakistan'),
(20, 'T.C.ZIRAAT BANKASI A.S'),
(21, 'Industrial and Commercial Bank of China'),
(22, 'Qatar National Bank'),
(23, 'MUFG Bank, Ltd'),
(24, 'First Abu Dhabi Bank'),
(25, 'Credit Suisse'),
(26, 'Standard Chartered Bank'),
(27, 'Trade Bank of Iraq');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading1` varchar(255) NOT NULL,
  `heading2` varchar(255) NOT NULL,
  `main_cat` int(11) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image`, `heading1`, `heading2`, `main_cat`, `status`) VALUES
(1, 'd343170e26988fda3ac5a1c37bd39693.png', 'welcome to PORT10', 'Oil Tanker', 40, 'deactive'),
(2, '9397a141692c7e953076840c5c0155e9.png', 'welcome to PORT10', 'welcome to PORT10', 1, 'deactive'),
(3, '9c82d1673a430294dccb8a2a5cf71827.jpg', 'test', 'test', 1, 'deactive'),
(4, '6291af76206a7d366ab6e23b8d38a753.jpg', 'test2', 'test2', 1, 'deactive'),
(5, '5446ad25d99d0251aa84e735a12f8213.jpg', 'Port10', 'port', 110, 'active'),
(6, '9737253aecba19c4bec6bc6b653d3caa.png', 'erf', 'afra', 1, 'deactive'),
(7, '66f76ab4ff0a247ca78a0a6f6adaff26.png', 'daf', 'gra', 1, 'deactive'),
(8, '9379dc35e369dc3ccbda05856ebe5e6d.png', 'gbs', 'rgg', 1, 'deactive'),
(9, '31491645042038a84765bb818dea6610.jpg', 'Port 10 Title ', '', 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `banner_trans`
--

CREATE TABLE `banner_trans` (
  `id` int(11) NOT NULL,
  `heading1` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `heading2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `main_cat` int(11) NOT NULL,
  `status` varchar(12) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_trans`
--

INSERT INTO `banner_trans` (`id`, `heading1`, `heading2`, `main_cat`, `status`, `image`) VALUES
(1, 'welcome to PORT10', 'Oil Tanker', 1, 'deactive', 'd343170e26988fda3ac5a1c37bd39693.png'),
(2, 'welcome to PORT10', 'welcome to PORT10', 1, 'deactive', '9397a141692c7e953076840c5c0155e9.png'),
(3, 'test', 'test', 1, 'active', '9c82d1673a430294dccb8a2a5cf71827.jpg'),
(4, 'test2', 'test2', 1, 'active', '6291af76206a7d366ab6e23b8d38a753.jpg'),
(5, 'Port10', 'port', 1, 'active', 'e5e08a146c2a27cff1ebdb6a9c4fcee0.png'),
(6, 'erf', 'afra', 1, 'active', '4939181392941fbdcfd5515d75b41882.jpg'),
(7, 'daf', 'gra', 1, 'active', '66f76ab4ff0a247ca78a0a6f6adaff26.png'),
(8, 'جيجابايت', 'rgg', 1, 'active', '9379dc35e369dc3ccbda05856ebe5e6d.png'),
(9, 'مرحبا بكم في', 'hjr', 1, 'active', '1e969de9bd4be5511c32fe7b314eeb2d.png');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `blog_type_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading` varchar(530) NOT NULL,
  `blog_tag` varchar(530) DEFAULT NULL,
  `description` longtext NOT NULL,
  `status` varchar(15) NOT NULL,
  `created_date` datetime NOT NULL,
  `date_of_publish` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `blog_type_id`, `image`, `heading`, `blog_tag`, `description`, `status`, `created_date`, `date_of_publish`) VALUES
(1, 1, '577e5271721934adae031775639afabe.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', NULL, '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2020-09-12 05:09:07', '02-04-2021'),
(2, 1, '9856e136aca097ac25fcf536c0870331.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', 'Lorem Ipsum', '<p>&nbsp;</p>\r\n\r\n<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2021-02-10 03:05:09', ''),
(3, 7, 'c148661d08c9f68552dcf6ca550383c1.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', NULL, '<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2021-03-02 12:59:06', ''),
(4, 6, '9697d8e8df43c70d421ff96b7000c3f3.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', NULL, '<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2021-03-02 01:02:38', ''),
(5, 5, '142cfa3eda7627c7849a5d3df4613e2b.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', NULL, '<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2021-03-02 01:06:50', ''),
(6, 3, 'c9c457ac0e45c742862046e6155c6923.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', NULL, '<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2021-03-02 01:07:29', ''),
(8, 7, '573600b84d9bb69869aa9c8bf9f76308.jpg', 'Heading', 'Blog Tag Blog Tag2', '<p>Heading&nbsp;Description</p>\r\n', 'active', '2021-04-01 01:47:52', ''),
(9, 4, 'd3546b7610d5e4857c3c551c9457f5cc.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', NULL, '<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2022-01-18 03:53:39', '11-01-2022'),
(12, 3, '6d821ce31d23722199084255afe6cd57.jpg', 'Understand your audience and target audience.', NULL, '<h3>1. Understand your audience.</h3>\r\n\r\n<p>Before you start writing your blog post, make sure you have a clear understanding of your target audience.</p>\r\n\r\n<p>Ask questions like: What do they want to know about? What will resonate with them?</p>\r\n\r\n<p>This is where the process of&nbsp;creating&nbsp;<a href=\"https://blog.hubspot.com/marketing/buyer-persona-research\" target=\"_blank\">buyer personas</a>&nbsp;comes in handy. Consider what you know about your buyer personas and their interests while you&#39;re coming up with a topic for your blog post.</p>\r\n\r\n<p>For instance, if your readers are millennials looking to start a business, you probably don&#39;t need to provide them with information about getting started on social media &mdash; most of them already have that down.</p>\r\n\r\n<p>You might, however, want to give them information about how to adjust their social media approach (for example &mdash; from what may be a casual, personal approach to a more business-savvy, networking-focused approach). That kind of tweak is what helps you publish content about the topics your audience really wants and needs.</p>\r\n\r\n<p>Don&#39;t have buyer personas in place for your business? Here are a few resources to help you get started:</p>\r\n\r\n<ul>\r\n	<li><a href=\"https://offers.hubspot.com/free-template-creating-buyer-personas?hubs_post=blog.hubspot.com/marketing/how-to-start-a-blog&amp;hubs_post-cta=Create%20Buyer%20Personas%20for%20Your%20Business%20%5BFree%20Template%5D&amp;_ga=2.186338474.2085623187.1649224454-1898102196.1649224454\" target=\"_blank\">Create Buyer Personas for Your Business [Free Template]</a></li>\r\n	<li><a href=\"https://blog.hubspot.com/marketing/buyer-persona-research\" target=\"_blank\">Guide: How to Create Detailed Buyer Personas for Your Business</a></li>\r\n	<li><a href=\"https://www.hubspot.com/make-my-persona?hubs_post=blog.hubspot.com/marketing/how-to-start-a-blog&amp;hubs_post-cta=%5BFree%20Tool%5D%20Make%20My%20Persona%3A%20Buyer%20Persona%20Generator\" target=\"_blank\">[Free Tool] Make My Persona: Buyer Persona Generator</a></li>\r\n</ul>\r\n\r\n<h3>2. Check out your competition.</h3>\r\n\r\n<p>What better way to draw inspiration than to look at your well-established competition?</p>\r\n\r\n<p>It&rsquo;s worth taking a look at popular, highly reviewed blogs because their strategy and execution is what got them to grow in credibility. The purpose of doing this isn&rsquo;t to copy these elements, but to gain better insight into what readers appreciate in a quality blog.</p>\r\n\r\n<p>There are multiple angles you should look at when doing a competitive analysis:</p>\r\n\r\n<ul>\r\n	<li><strong>Visuals</strong>: Look at the blog&rsquo;s branding, color palette, and theme.</li>\r\n	<li><strong>Copy</strong>: Analyze the tone and writing style of the competition to see what readers respond well to.</li>\r\n	<li><strong>Topics</strong>: See what subject matter&nbsp;their readers enjoy interacting with.</li>\r\n</ul>\r\n\r\n<h3>3. Determine what topics you&rsquo;ll cover.</h3>\r\n\r\n<p>Before you write anything, pick a topic you&rsquo;d like to write about. The topic can be pretty general to start as you find your desired&nbsp;<a href=\"https://www.founderjar.com/blog-niche/\" target=\"_blank\">niche in blogging</a>.</p>\r\n\r\n<p>Some ways to choose topics to cover include asking yourself questions like:</p>\r\n\r\n<ul>\r\n	<li><em>Who do I want to write to?</em></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li><em>How well do I understand this topic?</em></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li><em>Is this topic relevant?</em></li>\r\n</ul>\r\n\r\n<h3>4. Identify your unique angle.</h3>\r\n\r\n<p>What perspective do you bring that makes you stand out from the crowd? This is key to determining the trajectory of your blog&rsquo;s future and there&rsquo;s many avenues to choose in the process.</p>\r\n\r\n<ul>\r\n	<li>What unique experience makes you a trusted expert or thought leader on the topic?</li>\r\n	<li>What problem will you solve for readers?</li>\r\n	<li>Will you share your opinions on trending debates?</li>\r\n	<li>Teach your readers how to do something?</li>\r\n	<li>Compare or share original research?</li>\r\n</ul>\r\n\r\n<p>It&rsquo;s up to you to decide the unique angle you&rsquo;ll take on topics.</p>\r\n\r\n<h3>5. Name your blog.</h3>\r\n\r\n<p>This is your opportunity to get creative and make a name that gives readers an idea of what to expect from your blog. Some tips on&nbsp;<a href=\"https://blog.hubspot.com/marketing/how-to-ensure-your-blog-is-set-up-right\" target=\"_blank\">how to choose your blog name</a>&nbsp;include:</p>\r\n\r\n<ul>\r\n	<li>Keep your blog name easy to say and spell.</li>\r\n	<li>Link your blog name to your brand message.</li>\r\n	<li>Consider what your target audience is looking for.</li>\r\n</ul>\r\n\r\n<p>If you still need more assistance, try using a&nbsp;<a href=\"https://themeisle.com/blog-name-generator/\" target=\"_blank\">blog name generator</a>.</p>\r\n\r\n<p>Make sure the name you come up with isn&rsquo;t already taken as it could lessen your visibility and confuse readers looking for your content.</p>\r\n\r\n<h3>6. Create your blog domain.</h3>\r\n\r\n<p>A&nbsp;<a href=\"https://blog.hubspot.com/website/what-is-a-domain\" target=\"_blank\">domain</a>&nbsp;is a part of the web address nomenclature someone would use to find your website or a page of your website online.</p>\r\n\r\n<p>Your blog&#39;s domain will look like this: www.yourblog.com. The name between the two periods is up to you, as long as this domain name doesn&#39;t yet exist on the internet.</p>\r\n\r\n<p>Want to create a subdomain for your blog? If you already own a cooking business at www.yourcompany.com, you might create a blog that looks like this: blog.yourcompany.com. In other words, your blog&#39;s subdomain will live in its own section of yourcompany.com.</p>\r\n\r\n<p>Some CMS platforms offer subdomains as a free service, where your blog lives on the CMS, rather than your business&#39;s website. For example, it might look like this: yourblog.contentmanagementsystem.com. However, to create a subdomain that belongs to your company website, register the subdomain with a&nbsp;<a href=\"https://blog.hubspot.com/website/web-hosting\" target=\"_blank\">website host</a>.</p>\r\n\r\n<p>Most&nbsp;<a href=\"https://blog.hubspot.com/marketing/best-wordpress-hosting\" target=\"_blank\">website hosting services</a>&nbsp;charge very little to host an original domain &mdash; in fact, website costs can be as inexpensive as $3 per month when you commit to a 36-month term.</p>\r\n\r\n<p>Here are five popular web hosting services to choose from:</p>\r\n\r\n<ul>\r\n	<li><a href=\"https://www.godaddy.com/\" target=\"_blank\">GoDaddy</a></li>\r\n	<li><a href=\"https://www.hostgator.com/\" target=\"_blank\">HostGator</a></li>\r\n	<li><a href=\"https://www.dreamhost.com/\" target=\"_blank\">DreamHost</a></li>\r\n	<li><a href=\"https://www.bluehost.com/\" target=\"_blank\">Bluehost</a></li>\r\n	<li><a href=\"https://www.ipage.com/\" target=\"_blank\">iPage</a></li>\r\n</ul>\r\n\r\n<h3>7. Choose a CMS and set up your blog.</h3>\r\n\r\n<p>A&nbsp;<a href=\"https://blog.hubspot.com/blog/tabid/6307/bid/7969/what-is-a-cms-and-why-should-you-care.aspx\" target=\"_blank\">CMS</a>&nbsp;(content management system) is a software application that allows users to build and maintain a website without having to code it from scratch. CMS platforms can manage domains (where you create your website) and subdomains (where you create a webpage that connects to an existing website).</p>\r\n\r\n<p>HubSpot customers&nbsp;<a href=\"https://www.hubspot.com/products/cms/web-hosting?hubs_post=blog.hubspot.com/marketing/how-to-start-a-blog&amp;hubs_post-cta=host%20web%20content\" target=\"_blank\">host web content</a>&nbsp;via&nbsp;<a href=\"https://www.hubspot.com/products/cms?hubs_post=blog.hubspot.com/marketing/how-to-start-a-blog&amp;hubs_post-cta=CMS%20Hub\" target=\"_blank\">CMS Hub</a>. Another popular option is a self-hosted&nbsp;<a href=\"https://blog.hubspot.com/marketing/wordpress-website\" target=\"_blank\">WordPress website</a>&nbsp;on a hosting site such as&nbsp;<a href=\"https://wpengine.com/\" target=\"_blank\">WP Engine</a>. Whether you create a domain or a subdomain to start your blog, you&#39;ll need to choose a&nbsp;<a href=\"https://blog.hubspot.com/website/web-hosting\" target=\"_blank\">web hosting</a>&nbsp;service after you pick a CMS.</p>\r\n\r\n<h3>8. Customize the look of your blog.</h3>\r\n\r\n<p>Once you have your domain name set up, customize the appearance of your blog to reflect the theme of the content you plan on creating and your brand.</p>\r\n\r\n<p>For example, if you&#39;re writing about sustainability and the environment, green might be a color to keep in mind while designing your blog.</p>\r\n\r\n<p>If you already manage a website and are writing the first post for that existing website, ensure the article is consistent with the website in appearance and subject matter. Two ways to do this are including your:</p>\r\n\r\n<ul>\r\n	<li><a href=\"https://blog.hubspot.com/marketing/how-to-design-logo\" target=\"_blank\">Logo</a>: This can be your business&#39;s name and logo &mdash; it will remind blog readers of who&#39;s publishing the content. (How heavily you want to brand your blog, however, is up to you.)</li>\r\n	<li><a href=\"https://blog.hubspot.com/marketing/remarkable-about-us-page-examples\" target=\"_blank\">&quot;About&quot; Page</a>: You might already have an &quot;About&quot; blurb describing yourself or your business. Your blog&#39;s &quot;About&quot; section is an extension of this higher-level statement. Think of it as your blog&#39;s mission statement, which serves to support your company&#39;s goals.</li>\r\n</ul>\r\n\r\n<h3>9. Write your first blog post.</h3>\r\n\r\n<p>Once you have your blog set up, the only thing missing is the content. While the design and layout are fun and functionally necessary, it&#39;s the content that will draw your readers in and keep them coming back. So how do you actually go about writing one of these engaging and informational pieces?</p>\r\n\r\n<h2>Writing Your First Blog Post</h2>\r\n\r\n<p>You&rsquo;ve got the technical and practical tidbits down &mdash; now it&rsquo;s time to write your very first blog post. And nope, this isn&rsquo;t the space to introduce yourself and your new blog (i.e. &ldquo;Welcome to my blog! This is the topic I&rsquo;ll be covering. Here are my social media handles. Will you please follow?&rdquo;).</p>\r\n\r\n<p>Start with &ldquo;low-hanging fruit,&rdquo; writing about a highly specific topic that serves a small segment of your target audience.</p>\r\n\r\n<p>That seems unintuitive, right? If more people are searching for a term or a topic, that should mean more readers for you.</p>\r\n\r\n<p>But that&rsquo;s not true. If you choose a general and highly searched topic that&rsquo;s been covered by major competitors or more established brands, it&rsquo;s unlikely that your post will rank on the first page of search engine results pages (SERPs). Give your newly born blog a chance by choosing a topic that few bloggers have written about.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;</li>\r\n</ul>\r\n', 'active', '2022-04-06 12:09:08', '09-04-2022');

-- --------------------------------------------------------

--
-- Table structure for table `blog_trans`
--

CREATE TABLE `blog_trans` (
  `id` int(11) NOT NULL,
  `blog_type_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading` varchar(530) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `blog_tag` varchar(530) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) NOT NULL,
  `created_date` datetime NOT NULL,
  `date_of_publish` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_trans`
--

INSERT INTO `blog_trans` (`id`, `blog_type_id`, `image`, `heading`, `blog_tag`, `description`, `status`, `created_date`, `date_of_publish`) VALUES
(1, 1, '577e5271721934adae031775639afabe.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', '', '<p>&nbsp;</p>\r\n\r\n<p>Consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.</p>\r\n', 'active', '2020-09-12 05:09:07', ''),
(2, 1, '9856e136aca097ac25fcf536c0870331.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', '', '<p>&nbsp;</p>\r\n\r\n<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2021-02-10 03:05:09', ''),
(3, 7, '31b2529efda9e6ed2f39eec38b58ec7f.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', '', '<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2021-03-02 12:59:06', ''),
(4, 6, '4bcaa10c4d88966b4f91833cfcfd017a.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', '', '<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2021-03-02 01:02:38', ''),
(5, 5, '142cfa3eda7627c7849a5d3df4613e2b.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', '', '<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2021-03-02 01:06:50', ''),
(6, 3, 'c9c457ac0e45c742862046e6155c6923.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', '', '<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2021-03-02 01:07:29', ''),
(8, 7, '573600b84d9bb69869aa9c8bf9f76308.jpg', 'Heading', 'Blog Tag Blog Tag2', '<p>Heading&nbsp;Description</p>\r\n', 'active', '2021-04-01 01:47:52', ''),
(9, 4, '8ac9b0016504f92d34317410cbf2be09.jpg', 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry.', '', '<p>Consequences that are extremely painful. Nor again is there anyone who loves or&nbsp;&nbsp; pursues or desires to obtain pain of itself, because it is pain, but because&nbsp;&nbsp; &nbsp;occasionally circumstances occur in which toil and pain can procure him some&nbsp;&nbsp; great pleasure.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n', 'active', '2022-01-18 03:53:39', '11-01-2022'),
(12, 3, '6d821ce31d23722199084255afe6cd57.jpg', 'افهم جمهورك والجمهور المستهدف.', '', '<p>1. افهم جمهورك.<br />\r\nقبل أن تبدأ في كتابة منشور مدونتك ، تأكد من أن لديك فهمًا واضحًا لجمهورك المستهدف.</p>\r\n\r\n<p>اطرح أسئلة مثل: ما الذي يريدون معرفته؟ ماذا سيكون له صدى؟</p>\r\n\r\n<p>هذا هو المكان الذي تكون فيه عملية تكوين شخصيات المشتري مفيدة. ضع في اعتبارك ما تعرفه عن شخصيات المشتري الخاصة بك واهتماماتهم أثناء طرح موضوع لنشر مدونتك.</p>\r\n\r\n<p>على سبيل المثال ، إذا كان قراؤك من جيل الألفية يتطلعون إلى بدء عمل تجاري ، فربما لا تحتاج إلى تزويدهم بمعلومات حول البدء على وسائل التواصل الاجتماعي - فمعظمهم لديهم ذلك بالفعل.</p>\r\n\r\n<p>ومع ذلك ، قد ترغب في تزويدهم بمعلومات حول كيفية تعديل نهجهم في وسائل التواصل الاجتماعي (على سبيل المثال - من ما قد يكون نهجًا شخصيًا غير رسمي إلى نهج أكثر ذكاءً في مجال الأعمال ويركز على الشبكات). هذا النوع من التعديل هو ما يساعدك على نشر محتوى حول الموضوعات التي يريدها جمهورك ويحتاجها حقًا.</p>\r\n\r\n<p>ليس لديك شخصية المشتري في مكان عملك؟ إليك بعض الموارد لمساعدتك على البدء:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>إنشاء شخصيات المشتري لنشاطك التجاري [قالب مجاني]<br />\r\n	الدليل: كيفية إنشاء شخصيات مفصلة للمشتري لعملك<br />\r\n	[أداة مجانية] اجعل شخصيتي: مولد شخصية المشتري<br />\r\n	2. تحقق من منافسيك.<br />\r\n	ما هي أفضل طريقة لاستلهام الأفكار من إلقاء نظرة على منافسيك الراسخين؟</p>\r\n\r\n	<p>يجدر إلقاء نظرة على المدونات الشهيرة والتي تمت مراجعتها بشكل كبير لأن إستراتيجيتها وتنفيذها هو ما جعلها تزداد مصداقيتها. الغرض من القيام بذلك ليس نسخ هذه العناصر ، ولكن لاكتساب رؤية أفضل لما يقدره القراء في مدونة عالية الجودة.</p>\r\n\r\n	<p>هناك عدة زوايا يجب أن تنظر إليها عند إجراء تحليل تنافسي:</p>\r\n\r\n	<p>المرئيات: انظر إلى العلامة التجارية للمدونة ولوحة الألوان والمظهر.<br />\r\n	النسخ: قم بتحليل أسلوب وأسلوب كتابة المسابقة لمعرفة ما يستجيب له القراء جيدًا.<br />\r\n	المواضيع: تعرف على الموضوع الذي يستمتع القراء بالتفاعل معه.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>3. حدد الموضوعات التي ستغطيها.<br />\r\nقبل أن تكتب أي شيء ، اختر الموضوع الذي ترغب في الكتابة عنه. يمكن أن يكون الموضوع عامًا جدًا للبدء عندما تجد المكانة التي تريدها في التدوين.</p>\r\n\r\n<p>تتضمن بعض طرق اختيار الموضوعات التي يجب تغطيتها طرح أسئلة على نفسك مثل:</p>\r\n\r\n<p>لمن أريد أن أكتب؟<br />\r\nما مدى فهمي لهذا الموضوع؟<br />\r\nهل هذا الموضوع ذو صلة؟<br />\r\n4. حدد الزاوية الفريدة الخاصة بك.<br />\r\nما هو المنظور الذي تقدمه والذي يجعلك متميزًا عن الآخرين؟ هذا هو المفتاح لتحديد مسار مستقبل مدونتك وهناك العديد من السبل للاختيار في هذه العملية.</p>\r\n\r\n<p>ما هي التجربة الفريدة التي تجعلك خبيرًا موثوقًا به أو قائد فكريًا حول الموضوع؟<br />\r\nما المشكلة التي ستحلها للقراء؟<br />\r\nهل ستشارك بآرائك حول المناقشات الشائعة؟<br />\r\nعلم القراء كيفية القيام بشيء ما؟<br />\r\nقارن أو شارك البحث الأصلي؟<br />\r\nالأمر متروك لك لتحديد الزاوية الفريدة التي ستأخذها في الموضوعات.</p>\r\n\r\n<p>5. قم بتسمية مدونتك.<br />\r\nهذه هي فرصتك للإبداع وإنشاء اسم يمنح القراء فكرة عما يمكن توقعه من مدونتك. تتضمن بعض النصائح حول كيفية اختيار اسم مدونتك ما يلي:</p>\r\n\r\n<p>اجعل اسم مدونتك سهل النطق والتهجئة.<br />\r\nاربط اسم مدونتك برسالة علامتك التجارية.<br />\r\nضع في اعتبارك ما يبحث عنه جمهورك المستهدف.<br />\r\nإذا كنت لا تزال بحاجة إلى مزيد من المساعدة ، فحاول استخدام منشئ اسم المدونة.</p>\r\n\r\n<p>تأكد من أن الاسم الذي تبتكره لم يتم استخدامه بالفعل لأنه قد يقلل من ظهورك ويُربك القراء الذين يبحثون عن المحتوى الخاص بك.</p>\r\n\r\n<p>6. إنشاء مجال بلوق الخاص بك.<br />\r\nالنطاق هو جزء من تسمية عنوان الويب التي قد يستخدمها شخص ما للعثور على موقع الويب الخاص بك أو صفحة من موقع الويب الخاص بك على الإنترنت.</p>\r\n\r\n<p>سيبدو مجال مدونتك بالشكل التالي: www.yourblog.com. يعود الاسم بين الفترتين إليك ، طالما أن اسم المجال هذا غير موجود على الإنترنت.</p>\r\n\r\n<p>هل تريد إنشاء مجال فرعي لمدونتك؟ إذا كنت تمتلك بالفعل نشاطًا تجاريًا للطهي على www.yourcompany.com ، فيمكنك إنشاء مدونة تشبه هذا: blog.yourcompany.com. بمعنى آخر ، سيعيش النطاق الفرعي لمدونتك في القسم الخاص به في yourcompany.com.</p>\r\n\r\n<p>تقدم بعض منصات CMS نطاقات فرعية كخدمة مجانية ، حيث تعيش مدونتك على CMS ، بدلاً من موقع الويب الخاص بشركتك. على سبيل المثال ، قد يبدو كالتالي: yourblog.contentmanagementsystem.com. ومع ذلك ، لإنشاء مجال فرعي ينتمي إلى موقع شركتك على الويب ، قم بتسجيل النطاق الفرعي مع مضيف موقع الويب.</p>\r\n\r\n<p>تتقاضى معظم خدمات استضافة مواقع الويب القليل جدًا لاستضافة مجال أصلي - في الواقع ، يمكن أن تكون تكاليف موقع الويب غير مكلفة مثل 3 دولارات شهريًا عندما تلتزم بمدة 36 شهرًا.</p>\r\n\r\n<p>فيما يلي خمس خدمات استضافة ويب شائعة للاختيار من بينها:</p>\r\n\r\n<p>7. اختر CMS وقم بإعداد مدونتك.<br />\r\nCMS (نظام إدارة المحتوى) هو تطبيق برمجي يتيح للمستخدمين إنشاء موقع ويب وصيانته دون الحاجة إلى ترميزه من البداية. يمكن للأنظمة الأساسية CMS إدارة المجالات (حيث تقوم بإنشاء موقع الويب الخاص بك) والمجالات الفرعية (حيث تقوم بإنشاء صفحة ويب تتصل بموقع ويب موجود).</p>\r\n\r\n<p>يستضيف عملاء HubSpot محتوى الويب عبر CMS Hub. خيار شائع آخر هو موقع WordPress المستضاف ذاتيًا على موقع استضافة مثل WP Engine. سواء قمت بإنشاء مجال أو مجال فرعي لبدء مدونتك ، فستحتاج إلى اختيار خدمة استضافة الويب بعد اختيار CMS.</p>\r\n\r\n<p>8. تخصيص مظهر بلوق الخاص بك.<br />\r\nبمجرد إعداد اسم المجال الخاص بك ، قم بتخصيص مظهر مدونتك لتعكس موضوع المحتوى الذي تخطط لإنشائه وعلامتك التجارية.</p>\r\n\r\n<p>على سبيل المثال ، إذا كنت تكتب عن الاستدامة والبيئة ، فقد يكون اللون الأخضر لونًا يجب مراعاته أثناء تصميم مدونتك.</p>\r\n\r\n<p>إذا كنت تدير بالفعل موقعًا على الويب وتقوم بكتابة المنشور الأول لذلك الموقع الحالي ، فتأكد من توافق المقالة مع موقع الويب في المظهر والموضوع. هناك طريقتان للقيام بذلك ، بما في ذلك:</p>\r\n\r\n<p>الشعار: يمكن أن يكون هذا هو اسم شركتك وشعارها - سيذكر قراء المدونة بمن ينشر المحتوى. (ومع ذلك ، فإن مدى رغبتك في تمييز مدونتك هو أمر متروك لك).<br />\r\nصفحة &quot;حول&quot;: قد يكون لديك بالفعل دعاية مغالى فيها &quot;حول&quot; تصف نفسك أو نشاطك التجاري. يعد قسم &quot;حول&quot; في مدونتك امتدادًا لبيان المستوى الأعلى هذا. فكر في الأمر على أنه بيان مهمة لمدونتك ، والذي يعمل على دعم أهداف شركتك.<br />\r\n9. اكتب أول مدونة لك.<br />\r\nبمجرد إعداد مدونتك ، فإن الشيء الوحيد المفقود هو المحتوى. في حين أن التصميم والتخطيط ممتعان وضروريان من الناحية الوظيفية ، فإن المحتوى هو الذي سيجذب القراء ويجعلهم يعودون. إذن ، كيف يمكنك بالفعل كتابة واحدة من هذه القطع الشيقة والمعلوماتية؟</p>\r\n\r\n<p>كتابة أول مدونة لك<br />\r\nلقد حصلت على الحكايات التقنية والعملية - حان الوقت الآن لكتابة أول مشاركة لك في المدونة. وكلا ، هذه ليست المساحة لتقديم نفسك ومدونتك الجديدة (على سبيل المثال ، &quot;مرحبًا بك في مدونتي! هذا هو الموضوع الذي سأقوم بتغطيته. ها هي مقابض الوسائط الاجتماعية الخاصة بي. هل يمكنك المتابعة من فضلك؟&quot;).</p>\r\n\r\n<p>ابدأ بـ &quot;الفاكهة المتدلية&quot; ، والكتابة عن موضوع محدد للغاية يخدم شريحة صغيرة من جمهورك المستهدف.</p>\r\n\r\n<p>هذا يبدو غير بديهي ، أليس كذلك؟ إذا كان المزيد من الأشخاص يبحثون عن مصطلح أو موضوع ، فهذا يعني المزيد من القراء بالنسبة لك.</p>\r\n\r\n<p>لكن هذا ليس صحيحًا. إذا اخترت موضوعًا عامًا تم البحث عنه كثيرًا وتم تغطيته بواسطة المنافسين الرئيسيين أو المزيد من العلامات التجارية المعروفة ، فسيكون كذلك</p>\r\n\r\n<ul>\r\n</ul>\r\n', 'active', '2022-04-06 12:09:08', '09-04-2022');

-- --------------------------------------------------------

--
-- Table structure for table `blog_type`
--

CREATE TABLE `blog_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_trans` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_type`
--

INSERT INTO `blog_type` (`id`, `name`, `name_trans`) VALUES
(1, 'Other', 'آخر'),
(2, 'Ecommerce', 'التجارة الإلكترونية'),
(3, 'Digital Marketing', 'التسويق الرقمي'),
(4, 'Payments', 'المدفوعات'),
(5, 'Supply Chain & Logistics', 'سلسلة الإمداد اللوجستية'),
(6, 'International', 'دولي'),
(7, 'Trade', 'تجارة');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand_name`, `seller_id`, `image`) VALUES
(1, 'brand 12', 4, '33746d779f40269c09e2341456ac43ea.png'),
(2, 'milky6', 4, 'aa0f2748914ce6d08b85ab5e04562131.png'),
(3, 'dove', 4, '890fcb916aeb7fe317b632ee6bfb2cad.png'),
(4, 'shoulder', 4, '726a54837d6d849708dadde0cc1e2ab7.png'),
(5, 'brand 121', 4, ''),
(6, 'super', 10, ''),
(7, 'Port10', 8, 'd1a04317906b39d692cf47e3d1247a4e.png'),
(8, 'Levise', 8, ''),
(9, 'Orient', 8, ''),
(10, 'Havells', 8, ''),
(11, 'Luminous', 8, ''),
(12, 'Anchor', 8, ''),
(13, 'Crompton', 8, ''),
(14, 'test', 8, '27f1415d78031bee0a18d679c1526306.png');

-- --------------------------------------------------------

--
-- Table structure for table `brand_trans`
--

CREATE TABLE `brand_trans` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `seller_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand_trans`
--

INSERT INTO `brand_trans` (`id`, `brand_name`, `seller_id`, `image`) VALUES
(1, 'هندي', 4, 'e11350ea8dd59a125f914b71d05bb8a9.png'),
(2, 'milky', 4, 'aa0f2748914ce6d08b85ab5e04562131.png'),
(3, 'حمامة', 4, ''),
(4, 'quamer', 4, ''),
(5, 'brand 121', 4, ''),
(6, 'ممتاز', 10, ''),
(7, 'Port10', 8, 'd1a04317906b39d692cf47e3d1247a4e.png'),
(8, 'Levise', 8, ''),
(9, 'Orient', 8, ''),
(10, 'Havells', 8, ''),
(11, 'Luminous', 8, ''),
(12, 'Anchor', 8, ''),
(13, 'Crompton', 8, ''),
(14, 'test', 8, '27f1415d78031bee0a18d679c1526306.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `display_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent` int(11) NOT NULL DEFAULT '0',
  `has_product` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - not for product, 1- for product',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `display_name`, `banner_image`, `image`, `status`, `parent`, `has_product`, `slug`) VALUES
(1, 'Food and Beverage', '307ee482d5025c216f64e879103973fe61.jpg', 'ef64ceccaa8d110081945d088850672d.png', 'active', 0, 1, 'food-and-beverage'),
(2, 'Milk and Dairy Products', '', '', 'active', 1, 0, 'milk-and-dairy-products'),
(3, 'Water and Processed Drinks', '', '', 'active', 1, 0, 'water-and-processed-drinks'),
(4, 'Tea and Coffee Products', '', '', 'active', 1, 0, 'tea-and-coffee-products'),
(5, 'Meat and Poultry Products', '', '', 'active', 1, 0, 'meat-and-poultry-products'),
(6, 'Oilseeds', '', '', 'active', 1, 0, 'oilseeds'),
(7, 'Spices', '', '', 'active', 1, 0, 'spices'),
(8, 'Beans', '', '', 'active', 1, 0, 'beans'),
(9, 'Feed', '', '', 'active', 1, 0, 'feed'),
(10, 'Fruits', '', '', 'active', 1, 0, 'fruits'),
(11, 'Vegetables', '', '', 'active', 1, 0, 'vegetables'),
(12, 'Seafood', '', '', 'active', 1, 0, 'seafood'),
(13, 'Canned and Packed Food', '', '', 'active', 1, 0, 'canned-and-packed-food'),
(14, 'Sweets', '', '', 'active', 1, 0, 'sweets'),
(15, 'Industrial Food Ingredients', '', '', 'active', 1, 0, 'industrial-food-ingredients'),
(16, 'Honey', '', '', 'active', 1, 0, 'honey'),
(17, 'Snacks and Instant Food', '', '', 'active', 1, 0, 'snacks-and-instant-food'),
(18, 'Baby Food', '', '', 'active', 1, 0, 'baby-food'),
(19, 'Agricultural Waste', '', '', 'active', 1, 0, 'agricultural-waste'),
(20, 'Animal Waste', '', '', 'active', 1, 0, 'animal-waste'),
(21, 'Oils', '', '', 'active', 1, 0, 'oils-1'),
(22, 'Other Items', '', '', 'active', 1, 0, 'other-items'),
(24, 'Fabrics, Fiber, Feather and Fur', '', '', 'active', 23, 0, 'fabrics-fiber-feather-and-fur'),
(25, 'Leather', '', '', 'active', 23, 0, 'leather'),
(26, 'Textile Processing and Accessories', '', '', 'active', 23, 0, 'textile-processing-and-accessories'),
(27, 'Cotton', '', '', 'active', 23, 0, 'cotton'),
(28, 'Jewelry and Accessories', '', '', 'active', 23, 0, 'jewelry-and-accessories'),
(29, 'Eyewear', '', '', 'active', 23, 0, 'eyewear'),
(30, 'Watches', '', '', 'active', 23, 0, 'watches'),
(31, 'Hats, Ties, Belts and Accessories', '', '', 'active', 23, 0, 'hats-ties-belts-and-accessories'),
(32, 'Children Clothing', '', '', 'active', 23, 0, 'children-clothing'),
(33, 'Maternity Clothing', '', '', 'active', 23, 0, 'maternity-clothing'),
(34, 'Sportswear', '', '', 'active', 23, 0, 'sportswear'),
(35, 'Men’s Clothing and Footwear', '', '', 'active', 23, 0, 'men-s-clothing-and-footwear'),
(36, 'Women’s Clothing and Footwear', '', '', 'active', 23, 0, 'women-s-clothing-and-footwear'),
(37, 'Textile Supplies', '', '', 'active', 23, 0, 'textile-supplies'),
(38, 'Bags', '', '', 'active', 23, 0, 'bags'),
(39, 'Shoe Accessories', '', '', 'active', 23, 0, 'shoe-accessories'),
(40, 'Electronics', 'd498938c1beaa750fa762cf37d5fa5f876.jpg', 'b9c39644f952899f0e139704a465fa8f.png', 'active', 0, 1, 'electronics'),
(41, 'Air Conditioners', '', '', 'active', 40, 0, 'air-conditioners'),
(42, 'Cleaning and Laundry', '', '', 'active', 40, 0, 'cleaning-and-laundry'),
(43, 'Kitchen Appliances', '', '', 'active', 40, 0, 'kitchen-appliances'),
(44, 'Camera, Audio and Equipments', '', '', 'active', 40, 0, 'camera-audio-and-equipments'),
(45, 'Mobile Phone and Equipments', '', '', 'active', 40, 0, 'mobile-phone-and-equipments'),
(46, 'Computers and Peripherials', '', '', 'active', 40, 0, 'computers-and-peripherials'),
(47, 'Security and Equipments', '', '', 'active', 40, 0, 'security-and-equipments'),
(48, 'Solar and Energy Equipments', '', '', 'active', 40, 0, 'solar-and-energy-equipments'),
(49, 'Toys and Gifts', '307ee482d5025c216f64e879103973fe61.jpg', '3c03b668e697b483e54c66ec76efff67.png', 'active', 0, 1, 'toys-and-gifts'),
(50, 'Dolls and Action Figures', '', '', 'active', 49, 0, 'dolls-and-action-figures'),
(51, 'Educational Toys', '', '', 'active', 49, 0, 'educational-toys'),
(52, 'Outdoor Toys', '', '', 'active', 49, 0, 'outdoor-toys'),
(53, 'Inflatables', '', '', 'active', 49, 0, 'inflatables'),
(54, 'Electronic Toys', '', '', 'active', 49, 0, 'electronic-toys'),
(55, 'Wooden and Windup Toys', '', '', 'active', 49, 0, 'wooden-and-windup-toys'),
(56, 'Plastic Toys', '', '', 'active', 49, 0, 'plastic-toys'),
(57, 'Camping', '', '', 'active', 49, 0, 'camping'),
(58, 'Other Type of Toys', '', '', 'active', 49, 0, 'other-type-of-toys'),
(59, 'Toys Accessories', '', '', 'active', 49, 0, 'toys-accessories'),
(60, 'Ceremonial Decoration and Gift Sets', '', '', 'active', 49, 0, 'ceremonial-decoration-and-gift-sets'),
(61, 'Arts and Crafts', '', '', 'active', 49, 0, 'arts-and-crafts'),
(62, 'Pottery and Souvenir', '', '', 'active', 49, 0, 'pottery-and-souvenir'),
(63, 'Body and Beauty', '307ee482d5025c216f64e879103973fe61.jpg', 'e6db3b96508fe875f00586c177ffc24d.png', 'active', 0, 1, 'body-and-beauty'),
(64, 'Sports Equipment', '', '', 'active', 63, 0, 'sports-equipment'),
(65, 'Baby Care', '', '', 'active', 63, 0, 'baby-care'),
(66, 'Body Care', '', '', 'active', 63, 0, 'body-care'),
(67, 'Shaving and Hair Removal', '', '', 'active', 63, 0, 'shaving-and-hair-removal'),
(68, 'Medical Equipment', '', '', 'active', 63, 0, 'medical-equipment'),
(69, 'Health Care Supplies', '', '', 'active', 63, 0, 'health-care-supplies'),
(70, 'Construction and Commercial Equipment', '307ee482d5025c216f64e879103973fe61.jpg', '4d6747c4c769164fe23d39f44492fd81.png', 'active', 0, 1, 'construction-and-commercial-equipment'),
(71, 'Agricultural Machinery and Resources', '', '', 'active', 70, 0, 'agricultural-machinery-and-resources'),
(72, 'Construction Machinery and Resources', '', '', 'active', 70, 0, 'construction-machinery-and-resources'),
(73, 'Electronic Machinery and Resources', '', '', 'active', 70, 0, 'electronic-machinery-and-resources'),
(74, 'Food Machinery and Resources', '', '', 'active', 70, 0, 'food-machinery-and-resources'),
(75, 'Light Tools and Equipments', '', '', 'active', 70, 0, 'light-tools-and-equipments'),
(76, 'Printing, Packaging and Plastic Machinery', '', '', 'active', 70, 0, 'printing-packaging-and-plastic-machinery'),
(77, 'Pharmaceutical and Medical Equipments', '', '', 'active', 70, 0, 'pharmaceutical-and-medical-equipments'),
(78, 'Metal Machinery', '', '', 'active', 70, 0, 'metal-machinery'),
(79, 'Textile and Fabric Machinery', '', '', 'active', 70, 0, 'textile-and-fabric-machinery'),
(80, 'Construction Materials', '', '', 'active', 70, 0, 'construction-materials'),
(81, 'Other Machinery', '', '', 'active', 70, 0, 'other-machinery'),
(82, 'Metals, Chemicals and Other Raw Materials', '307ee482d5025c216f64e879103973fe61.jpg', 'ce88e821ece19aca7558c8906e1b7a43.png', 'active', 0, 1, 'metals-chemicals-and-other-raw-materials'),
(83, 'Aluminum', '', '', 'active', 82, 0, 'aluminum'),
(84, 'Copper', '', '', 'active', 82, 0, 'copper'),
(85, 'Iron', '', '', 'active', 82, 0, 'iron'),
(86, 'Lead', '', '', 'active', 82, 0, 'lead'),
(87, 'Ceramic', '', '', 'active', 82, 0, 'ceramic'),
(88, 'Cement', '', '', 'active', 82, 0, 'cement'),
(89, 'Glass', '', '', 'active', 82, 0, 'glass'),
(90, 'Plastic', '', '', 'active', 82, 0, 'plastic-2'),
(91, 'Solvents', '', '', 'active', 82, 0, 'solvents'),
(92, 'Coal', '', '', 'active', 82, 0, 'coal'),
(93, 'Coke', '', '', 'active', 82, 0, 'coke'),
(94, 'Biodiesel', '', '', 'active', 82, 0, 'biodiesel'),
(95, 'Lubricants', '', '', 'active', 82, 0, 'lubricants'),
(96, 'rubber', '', '', 'active', 82, 0, 'rubber'),
(97, 'Scrap and Waste', '', '', 'active', 82, 0, 'scrap-and-waste'),
(98, 'Recycled Resources', '', '', 'active', 82, 0, 'recycled-resources'),
(99, 'Paper and Packaging', '307ee482d5025c216f64e879103973fe61.jpg', '9b2d13cfd20e6960348a6d9d3fb601f1.png', 'active', 0, 1, 'paper-and-packaging'),
(100, 'Films and Foils', '', '', 'active', 99, 0, 'films-and-foils'),
(101, 'Cans, Bottles and Jars', '', '', 'active', 99, 0, 'cans-bottles-and-jars'),
(102, 'Composite Packaging', '', '', 'active', 99, 0, 'composite-packaging'),
(103, 'Adhesives', '', '', 'active', 99, 0, 'adhesives'),
(104, 'Office Supply', '', '', 'active', 99, 0, 'office-supply'),
(105, 'Paper Boards', '', '', 'active', 99, 0, 'paper-boards'),
(106, 'Bags', '', '', 'active', 99, 0, 'bags-1'),
(107, 'Crates and Pallets', '', '', 'active', 99, 0, 'crates-and-pallets'),
(108, 'Racks and Shelves', '', '', 'active', 99, 0, 'racks-and-shelves'),
(109, 'Cargo and Storage Equipments', '', '', 'active', 99, 0, 'cargo-and-storage-equipments'),
(110, 'Automotive', '307ee482d5025c216f64e879103973fe61.jpg', '244c8ae60063006cf3a5f2b90990eeca.png', 'active', 0, 1, 'automotive'),
(111, 'Cars and Spare Parts', '', '', 'active', 110, 0, 'cars-and-spare-parts'),
(112, 'Accessories', '', '', 'active', 110, 0, 'accessories-6'),
(113, 'Buses and Spare Parts', '', '', 'active', 110, 0, 'buses-and-spare-parts'),
(114, 'Trucks and Spare Parts', '', '', 'active', 110, 0, 'trucks-and-spare-parts'),
(115, 'Trailers', '', '', 'active', 110, 0, 'trailers'),
(116, 'Motorcycles and Accessories', '', '', 'active', 110, 0, 'motorcycles-and-accessories'),
(117, 'All-Terrain Vehicles', '', '', 'active', 110, 0, 'all-terrain-vehicles'),
(23, 'Textiles and Accessories', '', '', 'active', 0, 0, 'Textiles-and-Accessories'),
(119, 'Fashion', '', '', 'active', 0, 1, 'fashion'),
(120, 'Women', '', '', 'active', 119, 0, 'women-1');

-- --------------------------------------------------------

--
-- Table structure for table `category_trans`
--

CREATE TABLE `category_trans` (
  `id` int(11) NOT NULL,
  `display_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `parent` int(11) NOT NULL DEFAULT '0',
  `has_product` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - not for product, 1- for product',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_trans`
--

INSERT INTO `category_trans` (`id`, `display_name`, `banner_image`, `image`, `status`, `parent`, `has_product`, `slug`) VALUES
(1, 'الأغذية والمشروبات', '307ee482d5025c216f64e879103973fe61.jpg', 'ef64ceccaa8d110081945d088850672d.png', 'active', 0, 1, 'food-and-beverage'),
(2, 'الحليب ومنتجات الألبان', '', '', 'active', 1, 0, 'milk-and-dairy-products'),
(3, 'Water and Processed Drinks', '', '', 'active', 1, 0, 'water-and-processed-drinks'),
(4, 'Tea and Coffee Products', '', '', 'active', 1, 0, 'tea-and-coffee-products'),
(5, 'Meat and Poultry Products', '', '', 'active', 1, 0, 'meat-and-poultry-products'),
(6, 'Oilseeds', '', '', 'active', 1, 0, 'oilseeds'),
(7, 'Spices', '', '', 'active', 1, 0, 'spices'),
(8, 'Beans', '', '', 'active', 1, 0, 'beans'),
(9, 'Feed', '', '', 'active', 1, 0, 'feed'),
(10, 'Fruits', '', '', 'active', 1, 0, 'fruits'),
(11, 'Vegetables', '', '', 'active', 1, 0, 'vegetables'),
(12, 'Seafood', '', '', 'active', 1, 0, 'seafood'),
(13, 'Canned and Packed Food', '', '', 'active', 1, 0, 'canned-and-packed-food'),
(14, 'Sweets', '', '', 'active', 1, 0, 'sweets'),
(15, 'Industrial Food Ingredients', '', '', 'active', 1, 0, 'industrial-food-ingredients'),
(16, 'Honey', '', '', 'active', 1, 0, 'honey'),
(17, 'Snacks and Instant Food', '', '', 'active', 1, 0, 'snacks-and-instant-food'),
(18, 'Baby Food', '', '', 'active', 1, 0, 'baby-food'),
(19, 'Agricultural Waste', '', '', 'active', 1, 0, 'agricultural-waste'),
(20, 'Animal Waste', '', '', 'active', 1, 0, 'animal-waste'),
(21, 'Oils', '', '', 'active', 1, 0, 'oils-1'),
(22, 'Other Items', '', '', 'active', 1, 0, 'other-items'),
(24, 'Fabrics, Fiber, Feather and Fur', '', '', 'active', 23, 0, 'fabrics-fiber-feather-and-fur'),
(25, 'Leather', '', '', 'active', 23, 0, 'leather'),
(26, 'Textile Processing and Accessories', '', '', 'active', 23, 0, 'textile-processing-and-accessories'),
(27, 'Cotton', '', '', 'active', 23, 0, 'cotton'),
(28, 'Jewelry and Accessories', '', '', 'active', 23, 0, 'jewelry-and-accessories'),
(29, 'Eyewear', '', '', 'active', 23, 0, 'eyewear'),
(30, 'Watches', '', '', 'active', 23, 0, 'watches'),
(31, 'Hats, Ties, Belts and Accessories', '', '', 'active', 23, 0, 'hats-ties-belts-and-accessories'),
(32, 'Children Clothing', '', '', 'active', 23, 0, 'children-clothing'),
(33, 'Maternity Clothing', '', '', 'active', 23, 0, 'maternity-clothing'),
(34, 'Sportswear', '', '', 'active', 23, 0, 'sportswear'),
(35, 'Men’s Clothing and Footwear', '', '', 'active', 23, 0, 'men-s-clothing-and-footwear'),
(36, 'Women’s Clothing and Footwear', '', '', 'active', 23, 0, 'women-s-clothing-and-footwear'),
(37, 'Textile Supplies', '', '', 'active', 23, 0, 'textile-supplies'),
(38, 'Bags', '', '', 'active', 23, 0, 'bags'),
(39, 'Shoe Accessories', '', '', 'active', 23, 0, 'shoe-accessories'),
(40, 'إلكترونيات', 'd498938c1beaa750fa762cf37d5fa5f876.jpg', 'b9c39644f952899f0e139704a465fa8f.png', 'active', 0, 1, 'electronics'),
(41, 'Air Conditioners', '', '', 'active', 40, 0, 'air-conditioners'),
(42, 'Cleaning and Laundry', '', '', 'active', 40, 0, 'cleaning-and-laundry'),
(43, 'Kitchen Appliances', '', '', 'active', 40, 0, 'kitchen-appliances'),
(44, 'Camera, Audio and Equipments', '', '', 'active', 40, 0, 'camera-audio-and-equipments'),
(45, 'Mobile Phone and Equipments', '', '', 'active', 40, 0, 'mobile-phone-and-equipments'),
(46, 'Computers and Peripherials', '', '', 'active', 40, 0, 'computers-and-peripherials'),
(47, 'Security and Equipments', '', '', 'active', 40, 0, 'security-and-equipments'),
(48, 'Solar and Energy Equipments', '', '', 'active', 40, 0, 'solar-and-energy-equipments'),
(49, 'اللعب والهدايا', '307ee482d5025c216f64e879103973fe61.jpg', '3c03b668e697b483e54c66ec76efff67.png', 'active', 0, 1, 'toys-and-gifts'),
(50, 'Dolls and Action Figures', '', '', 'active', 49, 0, 'dolls-and-action-figures'),
(51, 'Educational Toys', '', '', 'active', 49, 0, 'educational-toys'),
(52, 'Outdoor Toys', '', '', 'active', 49, 0, 'outdoor-toys'),
(53, 'Inflatables', '', '', 'active', 49, 0, 'inflatables'),
(54, 'Electronic Toys', '', '', 'active', 49, 0, 'electronic-toys'),
(55, 'Wooden and Windup Toys', '', '', 'active', 49, 0, 'wooden-and-windup-toys'),
(56, 'Plastic Toys', '', '', 'active', 49, 0, 'plastic-toys'),
(57, 'Camping', '', '', 'active', 49, 0, 'camping'),
(58, 'Other Type of Toys', '', '', 'active', 49, 0, 'other-type-of-toys'),
(59, 'Toys Accessories', '', '', 'active', 49, 0, 'toys-accessories'),
(60, 'Ceremonial Decoration and Gift Sets', '', '', 'active', 49, 0, 'ceremonial-decoration-and-gift-sets'),
(61, 'Arts and Crafts', '', '', 'active', 49, 0, 'arts-and-crafts'),
(62, 'Pottery and Souvenir', '', '', 'active', 49, 0, 'pottery-and-souvenir'),
(63, 'الجسم والجمال', '307ee482d5025c216f64e879103973fe61.jpg', 'e6db3b96508fe875f00586c177ffc24d.png', 'active', 0, 1, 'body-and-beauty'),
(64, 'Sports Equipment', '', '', 'active', 63, 0, 'sports-equipment'),
(65, 'Baby Care', '', '', 'active', 63, 0, 'baby-care'),
(66, 'Body Care', '', '', 'active', 63, 0, 'body-care'),
(67, 'Shaving and Hair Removal', '', '', 'active', 63, 0, 'shaving-and-hair-removal'),
(68, 'Medical Equipment', '', '', 'active', 63, 0, 'medical-equipment'),
(69, 'Health Care Supplies', '', '', 'active', 63, 0, 'health-care-supplies'),
(70, 'المعدات الإنشائية والتجارية', '307ee482d5025c216f64e879103973fe61.jpg', '4d6747c4c769164fe23d39f44492fd81.png', 'active', 0, 1, 'construction-and-commercial-equipment'),
(71, 'Agricultural Machinery and Resources', '', '', 'active', 70, 0, 'agricultural-machinery-and-resources'),
(72, 'Construction Machinery and Resources', '', '', 'active', 70, 0, 'construction-machinery-and-resources'),
(73, 'Electronic Machinery and Resources', '', '', 'active', 70, 0, 'electronic-machinery-and-resources'),
(74, 'Food Machinery and Resources', '', '', 'active', 70, 0, 'food-machinery-and-resources'),
(75, 'Light Tools and Equipments', '', '', 'active', 70, 0, 'light-tools-and-equipments'),
(76, 'Printing, Packaging and Plastic Machinery', '', '', 'active', 70, 0, 'printing-packaging-and-plastic-machinery'),
(77, 'Pharmaceutical and Medical Equipments', '', '', 'active', 70, 0, 'pharmaceutical-and-medical-equipments'),
(78, 'Metal Machinery', '', '', 'active', 70, 0, 'metal-machinery'),
(79, 'Textile and Fabric Machinery', '', '', 'active', 70, 0, 'textile-and-fabric-machinery'),
(80, 'Construction Materials', '', '', 'active', 70, 0, 'construction-materials'),
(81, 'Other Machinery', '', '', 'active', 70, 0, 'other-machinery'),
(82, 'المعادن والكيماويات والمواد الخام الأخرى', '307ee482d5025c216f64e879103973fe61.jpg', 'ce88e821ece19aca7558c8906e1b7a43.png', 'active', 0, 1, 'metals-chemicals-and-other-raw-materials'),
(83, 'Aluminum', '', '', 'active', 82, 0, 'aluminum'),
(84, 'Copper', '', '', 'active', 82, 0, 'copper'),
(85, 'Iron', '', '', 'active', 82, 0, 'iron'),
(86, 'Lead', '', '', 'active', 82, 0, 'lead'),
(87, 'Ceramic', '', '', 'active', 82, 0, 'ceramic'),
(88, 'Cement', '', '', 'active', 82, 0, 'cement'),
(89, 'Glass', '', '', 'active', 82, 0, 'glass'),
(90, 'Plastic', '', '', 'active', 82, 0, 'plastic-2'),
(91, 'Solvents', '', '', 'active', 82, 0, 'solvents'),
(92, 'Coal', '', '', 'active', 82, 0, 'coal'),
(93, 'Coke', '', '', 'active', 82, 0, 'coke'),
(94, 'Biodiesel', '', '', 'active', 82, 0, 'biodiesel'),
(95, 'Lubricants', '', '', 'active', 82, 0, 'lubricants'),
(96, 'rubber', '', '', 'active', 82, 0, 'rubber'),
(97, 'Scrap and Waste', '', '', 'active', 82, 0, 'scrap-and-waste'),
(98, 'Recycled Resources', '', '', 'active', 82, 0, 'recycled-resources'),
(99, 'الورق والتغليف', '307ee482d5025c216f64e879103973fe61.jpg', '9b2d13cfd20e6960348a6d9d3fb601f1.png', 'active', 0, 1, 'paper-and-packaging'),
(100, 'Films and Foils', '', '', 'active', 99, 0, 'films-and-foils'),
(101, 'Cans, Bottles and Jars', '', '', 'active', 99, 0, 'cans-bottles-and-jars'),
(102, 'Composite Packaging', '', '', 'active', 99, 0, 'composite-packaging'),
(103, 'Adhesives', '', '', 'active', 99, 0, 'adhesives'),
(104, 'Office Supply', '', '', 'active', 99, 0, 'office-supply'),
(105, 'Paper Boards', '', '', 'active', 99, 0, 'paper-boards'),
(106, 'Bags', '', '', 'active', 99, 0, 'bags-1'),
(107, 'Crates and Pallets', '', '', 'active', 99, 0, 'crates-and-pallets'),
(108, 'Racks and Shelves', '', '', 'active', 99, 0, 'racks-and-shelves'),
(109, 'Cargo and Storage Equipments', '', '', 'active', 99, 0, 'cargo-and-storage-equipments'),
(110, 'السيارات', '307ee482d5025c216f64e879103973fe61.jpg', '244c8ae60063006cf3a5f2b90990eeca.png', 'active', 0, 1, 'automotive'),
(111, 'Cars and Spare Parts', '', '', 'active', 110, 0, 'cars-and-spare-parts'),
(112, 'Accessories', '', '', 'active', 110, 0, 'accessories-6'),
(113, 'Buses and Spare Parts', '', '', 'active', 110, 0, 'buses-and-spare-parts'),
(114, 'Trucks and Spare Parts', '', '', 'active', 110, 0, 'trucks-and-spare-parts'),
(115, 'Trailers', '', '', 'active', 110, 0, 'trailers'),
(116, 'Motorcycles and Accessories', '', '', 'active', 110, 0, 'motorcycles-and-accessories'),
(117, 'All-Terrain Vehicles', '', '', 'active', 110, 0, 'all-terrain-vehicles'),
(23, 'Textiles and Accessories', '', '', 'active', 0, 0, 'Textiles-and-Accessories'),
(119, 'موضة', '', '', 'active', 0, 1, 'fashion'),
(120, 'Women', '', '', 'active', 119, 0, 'women-1');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(111) NOT NULL,
  `compose_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `chat_images` varchar(255) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 means record delete',
  `message_type` varchar(20) NOT NULL DEFAULT 'text'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `compose_id`, `user_id`, `sender_id`, `receiver_id`, `message`, `seen`, `created_date`, `chat_images`, `is_delete`, `message_type`) VALUES
(1, 1, 3, 3, 4, 'test messsage', 0, '2022-05-04 08:53:00', NULL, 0, 'text'),
(2, 2, 10, 10, 4, 'Test message ', 0, '2022-05-04 09:18:32', NULL, 0, 'text'),
(3, 3, 10, 10, 7, 'Vvdcb', 0, '2022-05-04 09:19:11', NULL, 0, 'text'),
(4, 4, 11, 11, 15, 'Hello message ', 0, '2022-05-04 10:33:40', NULL, 0, 'text'),
(5, 1, 3, 3, 4, '789', 0, '2022-05-06 08:59:03', NULL, 0, 'text'),
(6, 5, 3, 3, 4, 'test description ', 0, '2022-05-06 08:59:30', NULL, 0, 'text'),
(7, 1, 3, 3, 4, '4444', 0, '2022-06-07 12:05:02', NULL, 0, 'text'),
(8, 1, 4, 4, 3, '789', 0, '2022-06-07 05:35:15', NULL, 0, 'text'),
(9, 1, 3, 3, 4, '8888', 0, '2022-06-07 12:08:53', NULL, 0, 'text'),
(10, 1, 3, 3, 4, '9999', 0, '2022-06-07 12:28:27', NULL, 0, 'text'),
(11, 1, 3, 3, 4, '9999', 0, '2022-06-07 12:28:27', NULL, 0, 'text'),
(12, 1, 3, 3, 4, '8888', 0, '2022-06-07 12:28:45', NULL, 0, 'text');

-- --------------------------------------------------------

--
-- Table structure for table `chat_compose`
--

CREATE TABLE `chat_compose` (
  `id` int(11) NOT NULL,
  `cuser_id` int(11) NOT NULL,
  `csender_id` int(11) NOT NULL,
  `creceiver_id` int(11) NOT NULL,
  `subject` varchar(530) NOT NULL,
  `compose_message` text NOT NULL,
  `ccreated_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 means active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_compose`
--

INSERT INTO `chat_compose` (`id`, `cuser_id`, `csender_id`, `creceiver_id`, `subject`, `compose_message`, `ccreated_date`, `status`) VALUES
(1, 3, 3, 4, 'test subject', 'test messsage', '2022-05-04 08:53:00', 1),
(2, 10, 10, 4, 'Test subjects ', 'Test message ', '2022-05-04 09:18:32', 1),
(3, 10, 10, 7, 'Test', 'Vvdcb', '2022-05-04 09:19:11', 1),
(4, 11, 11, 15, 'Test subject ', 'Hello message ', '2022-05-04 10:33:40', 1),
(5, 3, 3, 4, 'test subject admin may', 'test description ', '2022-05-06 08:59:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `city_list`
--

CREATE TABLE `city_list` (
  `id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_list`
--

INSERT INTO `city_list` (`id`, `city_name`) VALUES
(1, 'Abha'),
(2, 'Abqaiq'),
(3, 'Abu Areish'),
(4, 'Afif'),
(5, 'Aflaj'),
(6, 'Ahad Masarha '),
(7, 'Ahad Rufaidah'),
(8, 'Ain Dar'),
(9, 'Al Bada'),
(10, 'Al Dalemya'),
(11, 'Al Hassa'),
(12, 'Al Mada'),
(13, 'Al Moya'),
(14, 'Al-Jsh'),
(15, 'Alghat'),
(16, 'Alhada'),
(17, 'Alrass'),
(18, 'Amaq'),
(19, 'Anak'),
(20, 'Aqiq'),
(21, 'Arar'),
(22, 'Artawiah'),
(23, 'Asfan'),
(24, 'Ash Shuqaiq'),
(25, 'Assiyah'),
(26, 'Atawleh'),
(27, 'Awamiah'),
(28, 'Ayn Fuhayd          '),
(29, 'Badaya'),
(30, 'Bader'),
(31, 'Baha'),
(32, 'Bahara'),
(33, 'Bahrat Al Moujoud'),
(34, 'Balahmar'),
(35, 'Balasmar'),
(36, 'Bareq'),
(37, 'Batha'),
(38, 'Biljurashi'),
(39, 'Birk'),
(40, 'Bish '),
(41, 'Bisha'),
(42, 'Bukeiriah'),
(43, 'Buraidah'),
(44, 'Daelim'),
(45, 'Damad'),
(46, 'Dammam'),
(47, 'Darb'),
(48, 'Dawadmi'),
(49, 'Daws'),
(50, 'Deraab'),
(51, 'Dere\'Iyeh'),
(52, 'Dhahran'),
(53, 'Dhahran Al Janoob'),
(54, 'Dhalm'),
(55, 'Dhurma        '),
(56, 'Domat Al Jandal'),
(57, 'Duba'),
(58, 'Farasan'),
(59, 'Gilwa'),
(60, 'Gizan'),
(61, 'Hadeethah'),
(62, 'Hafer Al Batin'),
(63, 'Hail'),
(64, 'Halat Ammar'),
(65, 'Haqil'),
(66, 'Harad'),
(67, 'Hareeq'),
(68, 'Harjah'),
(69, 'Hawea/Taif'),
(70, 'Haweyah'),
(71, 'Hawtat Bani Tamim'),
(72, 'Hinakeya'),
(73, 'Hofuf'),
(74, 'Horaimal'),
(75, 'Hotat Sudair'),
(76, 'Ja\'Araneh'),
(77, 'Jadid'),
(78, 'Jafar'),
(79, 'Jalajel'),
(80, 'Jeddah'),
(81, 'Jouf'),
(82, 'Jubail'),
(83, 'Jumum'),
(84, 'Kara'),
(85, 'Kara\'A'),
(86, 'Karboos'),
(87, 'Khafji'),
(88, 'Khaibar'),
(89, 'Khamaseen'),
(90, 'Khamis Mushait'),
(91, 'Kharj'),
(92, 'Khasawyah'),
(93, 'Khobar'),
(94, 'Khodaria'),
(95, 'Khulais'),
(96, 'Khurma'),
(97, 'Laith'),
(98, 'Madinah'),
(99, 'Mahad Al Dahab'),
(100, 'Majarda'),
(101, 'Majma'),
(102, 'Makkah'),
(103, 'Mandak'),
(104, 'Mastura'),
(105, 'Midinhab'),
(106, 'Mikhwa'),
(107, 'Mnefah'),
(108, 'Mohayel Aseer'),
(109, 'Molejah'),
(110, 'Mrat'),
(111, 'Mubaraz'),
(112, 'Mulaija'),
(113, 'Muthaleif'),
(114, 'Muzahmiah'),
(115, 'Muzneb'),
(116, 'Nabiya'),
(117, 'Najran'),
(118, 'Namas'),
(119, 'Nanyah'),
(120, 'Nimra'),
(121, 'Noweirieh'),
(122, 'Nwariah'),
(123, 'Ojam'),
(124, 'Onaiza'),
(125, 'Othmanyah'),
(126, 'Oula'),
(127, 'Oyaynah'),
(128, 'Qahmah'),
(129, 'Qarah               '),
(130, 'Qariya Al Olaya'),
(131, 'Qasab               '),
(132, 'Qassim'),
(133, 'Qatif'),
(134, 'Qaysoomah'),
(135, 'Qunfudah'),
(136, 'Qurayat'),
(137, 'Quwei\'Ieh'),
(138, 'Rabigh'),
(139, 'Rafha'),
(140, 'Rahima'),
(141, 'Rania'),
(142, 'Ras Al Kheir'),
(143, 'Ras Tanura'),
(144, 'Rejal Alma\'A'),
(145, 'Remah'),
(146, 'Riyadh'),
(147, 'Riyadh Al Khabra'),
(148, 'Rowdat Sodair'),
(149, 'Rwaydah'),
(150, 'Sabt El Alaya'),
(151, 'Sabya'),
(152, 'Safanyah'),
(153, 'Safwa'),
(154, 'Sahna'),
(155, 'Sajir'),
(156, 'Sakaka'),
(157, 'Salbookh'),
(158, 'Salwa'),
(159, 'Samtah '),
(160, 'Sarar'),
(161, 'Sarat Obeida'),
(162, 'Seihat'),
(163, 'Shaqra'),
(164, 'Sharourah'),
(165, 'Shefa\'A'),
(166, 'Shoaiba'),
(167, 'Shraie\'E'),
(168, 'Shumeisi'),
(169, 'Snabs'),
(170, 'Subheka'),
(171, 'Sulaiyl'),
(172, 'Tabrjal'),
(173, 'Tabuk'),
(174, 'Taif'),
(175, 'Tanda'),
(176, 'Tanjeeb'),
(177, 'Tanuma'),
(178, 'Tarut'),
(179, 'Tatleeth'),
(180, 'Tayma               '),
(181, 'Tebrak'),
(182, 'Thabya'),
(183, 'Thadek'),
(184, 'Thumair             '),
(185, 'Thuqba'),
(186, 'THUWAL'),
(187, 'Towal'),
(188, 'Turaib'),
(189, 'Turaif'),
(190, 'Turba'),
(191, 'Udhaliyah'),
(192, 'Um Aljamajim'),
(193, 'Umluj'),
(194, 'Uqlat Al Suqur'),
(195, 'Uyun'),
(196, 'Wadeien'),
(197, 'Wadi Bin Hasbal'),
(198, 'Wadi El Dwaser'),
(199, 'Wadi Fatmah'),
(200, 'Wajeh (Al Wajh)'),
(201, 'Yanbu'),
(202, 'Yanbu Al Baher'),
(203, 'Zahban '),
(204, 'Zulfi');

-- --------------------------------------------------------

--
-- Table structure for table `contact_request`
--

CREATE TABLE `contact_request` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `message` mediumtext NOT NULL,
  `created_date` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_request`
--

INSERT INTO `contact_request` (`id`, `first_name`, `last_name`, `email`, `phone`, `message`, `created_date`) VALUES
(1, 'test', 'test last name', 'fs@sg.gg', '34543543', 'fdbvcbvc', '2022-04-19 06:45:07'),
(2, 'test', 'bnv', 'asg@sv.cv', '2332423432', 'bcnbn', '2022-04-19 06:45:40'),
(3, 'rita', 'nigam', 'rita@mailinator.com', '2343465', 'test', '2022-04-20 07:55:45'),
(4, 'CrytoItami', 'CrytoItami', 'jasmine_e_loew@yahoo.com', '89030905913', '?? ?????? ??? ???? ???? ??????? ??? ????????. ???? ??????!  https://tek.dkworld.de/gotodate/go', '2022-07-05 08:14:39'),
(5, 'CrytoItami', 'CrytoItami', 'john.mcguinness@nbcuni.com', '89037428400', '??? ??????? ????? ?????? ??? ??? ???? ?????.  https://tek.dkworld.de/gotodate/go', '2022-07-05 10:38:37'),
(6, 'CrytoItami', 'CrytoItami', 'kalen.dai@yahoo.com', '89038988128', '??? ???? ????? ????? ????????? ?????? ????? ??.  https://tek.dkworld.de/gotodate/go', '2022-07-05 01:04:16'),
(7, 'CrytoItami', 'CrytoItami', 'katie.pearson46@yahoo.com', '89039164622', '??? ????? ? ???? ?????! ??????? ?????? ?? ?? ??????.  https://tek.dkworld.de/gotodate/go', '2022-07-05 03:26:17'),
(8, 'CrytoItami', 'CrytoItami', 'christinelagasca@yahoo.com', '89030421124', '??? ?? ???? ??? ?????? ??????? ?????? ??? ?????? ?? ?????.  https://tek.dkworld.de/gotodate/go', '2022-07-05 05:49:17'),
(9, 'CrytoItami', 'CrytoItami', 'mrs-mel@hotmail.com', '89032891020', '??? ????? ?????? ??? ????.  https://tek.dkworld.de/gotodate/go', '2022-07-05 08:11:25'),
(10, 'CrytoItami', 'CrytoItami', 'rudin_r92@hotmail.com', '89035027708', '??? ????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-05 10:33:53'),
(11, 'CrytoItami', 'CrytoItami', 'suelane@comcast.net', '89033106876', '???? ??????? ?????? ??? ??? ???? ?? ????????? ?? ???.  https://tek.seamonkey.es/gotodate/go', '2022-07-06 12:58:49'),
(12, 'CrytoItami', 'CrytoItami', 'namanparikh2012@gmail.com', '89033586041', '??????? ??? ???????? ?? ???? ????? ????????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-06 03:21:34'),
(13, 'CrytoItami', 'CrytoItami', 'phillcheech@yahoo.com', '89033240974', '???? ?????? ??? ???? ?? ???? ????.  https://tek.seamonkey.es/gotodate/go', '2022-07-06 05:45:35'),
(14, 'CrytoItami', 'CrytoItami', 'christinagmiterko@roadrunner.com', '89036126655', '????? ??? ???????? ?? ????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-06 08:08:30'),
(15, 'CrytoItami', 'CrytoItami', 'fran_martins30@hotmail.com', '89036751938', '???? ???? ???? ?? ???????? ???????? ??? ??????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-06 10:30:48'),
(16, 'CrytoItami', 'CrytoItami', 'jsossong@att.net', '89039227275', '???? ???? ???? ????? ?? ????? ??? ????. ????? ??? ????????.  https://tek.seamonkey.es/gotodate/go', '2022-07-06 01:07:02'),
(17, 'CrytoItami', 'CrytoItami', 'glitzandears@gmail.com', '89030991134', '??? ?????? ?? ????? ????? ??? ???????? ???.  https://tek.seamonkey.es/gotodate/go', '2022-07-06 03:30:06'),
(18, 'CrytoItami', 'CrytoItami', 'theand.dyan@yahoo.com', '89031775183', '??????? ?? ???? ?????? ??? ?? ???? ?? ????.  https://tek.seamonkey.es/gotodate/go', '2022-07-06 05:52:15'),
(19, 'CrytoItami', 'CrytoItami', 'jamilah30314@yahoo.com', '89033586659', '??? ???? ????????? ????? ?? ????? ?? ??? ????.  https://tek.seamonkey.es/gotodate/go', '2022-07-06 08:19:33'),
(20, 'CrytoItami', 'CrytoItami', 'nmontmarquet@chadbourne.com', '89031148263', '????? ??????? ???? ?????? ???????? ??? ???????.  https://tek.seamonkey.es/gotodate/go', '2022-07-06 10:41:21'),
(21, 'CrytoItami', 'CrytoItami', 'carl_thorson@dell.com', '89036151339', '???? ?? ??? ????????, ???? ???? ???? 24/7.  https://tek.seamonkey.es/gotodate/go', '2022-07-07 01:05:45'),
(22, 'CrytoItami', 'CrytoItami', 'justinrobben@aol.com', '89034026432', '??? ??? ??? ???????? ???? ?? ?????? ?????????.  https://tek.seamonkey.es/gotodate/go', '2022-07-07 03:29:08'),
(23, 'CrytoItami', 'CrytoItami', 'syber_03@hotmail.com', '89032326783', '????? ??? ??????? ????? ????.  https://tek.seamonkey.es/gotodate/go', '2022-07-07 05:51:58'),
(24, 'CrytoItami', 'CrytoItami', 'michele_petrillo22@yahoo.com', '89035748033', '???? ????? ??? ?? ????? ?? ??? ????????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-07 04:49:12'),
(25, 'CrytoItami', 'CrytoItami', 'maiagirl@gmail.com', '89031604512', '??? ????? ?????? ??? ??? ????????.  https://tek.seamonkey.es/gotodate/go', '2022-07-07 07:11:47'),
(26, 'CrytoItami', 'CrytoItami', 'spencer_amol@yahoo.com', '89034542281', '????????? ?????? ?? ?? ?????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-07 09:35:27'),
(27, 'CrytoItami', 'CrytoItami', 'puppylove_01_85@hotmail.com', '89036851270', '??? ????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-07 11:58:06'),
(28, 'CrytoItami', 'CrytoItami', 'integturbo@hotmail.com', '89034311613', '????? ??????? ?????? ??????? ?????.  https://tek.seamonkey.es/gotodate/go', '2022-07-08 02:25:05'),
(29, 'CrytoItami', 'CrytoItami', 'sbmmxx56@gmail.com', '89037422765', '???? ?? ???? ??????????? ??????? ?????? ?? ????????? ?????.  https://tek.seamonkey.es/gotodate/go', '2022-07-08 04:50:00'),
(30, 'CrytoItami', 'CrytoItami', 'wildtater28@yahoo.com', '89036053157', '????? ??? ?????? ??? ??? ??? ?????? ?????.  https://tek.seamonkey.es/gotodate/go', '2022-07-08 08:40:28'),
(31, 'CrytoItami', 'CrytoItami', 'eviction_spider@yahoo.com', '89032679028', '??????? ??? ??????? ?? ???? ????? ?????? ????.  https://tek.seamonkey.es/gotodate/go', '2022-07-08 11:23:08'),
(32, 'CrytoItami', 'CrytoItami', 'shantu.maity@gmail.com', '89038958365', '??????? ?????? ???? ??????? ?? ??? ??? ?????.  https://tek.seamonkey.es/gotodate/go', '2022-07-08 01:45:27'),
(33, 'CrytoItami', 'CrytoItami', 'kagkmooeqw@eeykmooeyz.com', '89034961774', '??? $1000 ?? 1 1 ?? ??? ?????. ????? ??????? ?????? ????.  https://tek.seamonkey.es/gotodate/go', '2022-07-08 04:07:13'),
(34, 'CrytoItami', 'CrytoItami', 'dcseaster@yahoo.com', '89032418141', '?? ???? ????? ??? ???? ?? ??? ???? ??????? ?????!  https://tek.seamonkey.es/gotodate/go', '2022-07-08 06:29:29'),
(35, 'CrytoItami', 'CrytoItami', 'goodwinavery@gmail.com', '89038356379', '??? ????? ?? ????? ??? ??? ??? ?????? ??????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-08 08:49:56'),
(36, 'CrytoItami', 'CrytoItami', 'walter.r.e.ed247.85@gmail.com', '89033984430', '???? ??? ???? ????? ???? ?????.  https://tek.seamonkey.es/gotodate/go', '2022-07-08 11:11:06'),
(37, 'CrytoItami', 'CrytoItami', 'jennifer.lebow@prufoxroach.com', '89034939812', '????? ????? ??? ???? ?? ???? ?????? ????? ???.  https://tek.seamonkey.es/gotodate/go', '2022-07-09 01:32:55'),
(38, 'CrytoItami', 'CrytoItami', 'scottgreen_5@hotmail.com', '89034760132', '????? ??? ??? ?????? ?? ?????? ??? ??????? ??? ??? ????? ???.  https://tek.seamonkey.es/gotodate/go', '2022-07-09 03:54:49'),
(39, 'CrytoItami', 'CrytoItami', 'Rockboarderchick@yahoo.com', '89036978360', '??? ????? ?? ????? ??? ??? ??? ?????? ??????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-09 06:16:48'),
(40, 'CrytoItami', 'CrytoItami', 'seba_crazy78@hotmail.com', '89034144775', '????? ???? ?? ???, ???? ???? ?? ???? ????? 1 100 ???.  https://tek.seamonkey.es/gotodate/go', '2022-07-09 08:38:08'),
(41, 'CrytoItami', 'CrytoItami', 'gaeta_brenda@yahoo.com', '89033001359', '??? ????? ?????? ??? ???? ???????.  https://tek.seamonkey.es/gotodate/go', '2022-07-09 11:01:25'),
(42, 'CrytoItami', 'CrytoItami', 'masako.tasaka@gmail.com', '89037687461', '???? ????? ??? ???????? ??????????. ??? ?????? ??????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-09 01:26:18'),
(43, 'CrytoItami', 'CrytoItami', 'linoblessing@yahoo.com', '89033510684', '????? ? ?????! ??? ?????? ?? ????? ?? ??????? ??????!  https://tek.seamonkey.es/gotodate/go', '2022-07-09 03:48:29'),
(44, 'CrytoItami', 'CrytoItami', 'pinklight_loved@yahoo.com', '89038112661', '??? ????? ?????? ?? ?????? ?????? ??? ???.  https://tek.seamonkey.es/gotodate/go', '2022-07-09 06:10:56'),
(45, 'CrytoItami', 'CrytoItami', 'ekaklc1234@naver.com', '89036256537', '??????? ?????? ????? ?? ?? # 1 ???? ???? ?????.  https://tek.seamonkey.es/gotodate/go', '2022-07-09 08:36:30'),
(46, 'CrytoItami', 'CrytoItami', 'evilbaby16@yahoo.com', '89037344694', '???? ?? ??? ???? ????????? ?? ?????.  https://tek.seamonkey.es/gotodate/go', '2022-07-09 10:58:00'),
(47, 'CrytoItami', 'CrytoItami', 'KJCollier810@aol.com', '89031117133', '??????? ?????? ?? # 1 ???? ????????? ?? ?? ??? ???. ??????!  https://tek.seamonkey.es/gotodate/go', '2022-07-10 01:20:57'),
(48, 'CrytoItami', 'CrytoItami', 'raiders_sanjose@yahoo.com', '89039709858', '??? ??? ??? ???????? ???? ?? ?????? ?????????.  https://tek.seamonkey.es/gotodate/go', '2022-07-10 03:41:06'),
(49, 'CrytoItami', 'CrytoItami', 'rachelmonthony@rocketmail.com', '89035716401', '??? ???? ??? ???? ???? ????  https://tek.seamonkey.es/gotodate/go', '2022-07-10 06:02:46'),
(50, 'CrytoItami', 'CrytoItami', 'theairsoncompany@gmail.com', '89039907662', '?? ???? ??? ????????? ??? ??????? ?????? ????? ??!  https://tek.seamonkey.es/gotodate/go', '2022-07-10 08:24:27'),
(51, 'CrytoItami', 'CrytoItami', 'bsoltis@mac.com', '89035438025', '?? ????? ????? ?? ???? ?? ????? ??? 100 you ??? ?????? ??? ???????.  https://tek.seamonkey.es/gotodate/go', '2022-07-10 10:46:51'),
(52, 'CrytoItami', 'CrytoItami', 'keking02@hotmail.com', '89036997489', '???? ???? ???? ????? ?? ????? ??? ????. ????? ??? ????????.  https://tek.seamonkey.es/gotodate/go', '2022-07-10 01:09:01'),
(53, 'CrytoItami', 'CrytoItami', 'Vicpat002@yahoo.com', '89037522617', '??? ??????? ????? ?????? ??? ??? ???? ?????.  https://tek.seamonkey.es/gotodate/go', '2022-07-10 03:30:52'),
(54, 'CrytoItami', 'CrytoItami', 'zachbrown619@yahoo.com', '89038731805', '?? ??????? ????? ?? ??? ??????? ???? ??? ???? ??? 100..  https://tek.seamonkey.es/gotodate/go', '2022-07-10 05:53:54'),
(55, 'CrytoItami', 'CrytoItami', 'gloria.anna43@yahoo.com', '89033262133', '?????? ???? ??? ????? ????.  https://tek.seamonkey.es/gotodate/go', '2022-07-10 08:15:01'),
(56, 'CrytoItami', 'CrytoItami', 'marshalltj@comcast.net', '89030107310', '???? ??? ???? ??????? 1 1000 ?? investment 1 ?????????.  https://tek.seamonkey.es/gotodate/go', '2022-07-10 10:36:42'),
(57, 'CrytoItami', 'CrytoItami', 'info@artizen.com', '89037176427', '??? ????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-11 01:03:44'),
(58, 'CrytoItami', 'CrytoItami', '563216007@qq.com', '89035327250', '??? ????? ?? ????? ??? ??? ??? ?????? ??????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-11 03:23:56'),
(59, 'CrytoItami', 'CrytoItami', 'e.reyes58@yahoo.com', '89031047534', '????? ??? ???????? ???? ?? ???? ????? ??? ??? ??? ?????? ??? ???????.  https://tek.seamonkey.es/gotodate/go', '2022-07-11 05:44:01'),
(60, 'CrytoItami', 'CrytoItami', 'leonardohopkins1226@yahoo.com', '89038591599', '????? ???? ?? ???, ???? ???? ?? ???? ????? 1 100 ???.  https://tek.seamonkey.es/gotodate/go', '2022-07-11 08:07:40'),
(61, 'CrytoItami', 'CrytoItami', 'clearstar7wormstare@gmail.com', '89032751114', '????? ??? ?????? ???? ???? ??? ??????! ??? ???? ??? ??? ?????? ???????.  https://tek.seamonkey.es/gotodate/go', '2022-07-11 10:30:45'),
(62, 'CrytoItami', 'CrytoItami', 's.m.e673@gmail.com', '89037506912', '?????? ! ??????? ?????? ?? ???? ?? ????????!  https://tek.seamonkey.es/gotodate/go', '2022-07-11 12:53:02'),
(63, 'CrytoItami', 'CrytoItami', 'jolenemull93@hotmail.com', '89038730681', '??????? ?? ???? ?????? ??? ?? ???? ?? ????.  https://tek.seamonkey.es/gotodate/go', '2022-07-11 03:16:02'),
(64, 'CrytoItami', 'CrytoItami', 'danajgann@att.net', '89033180419', '??? ????? ?? ???????? ???????? ??? ???. ??? ???? ???!  https://tek.seamonkey.es/gotodate/go', '2022-07-11 05:39:29'),
(65, 'CrytoItami', 'CrytoItami', 'shop@butterflyhome.net', '89034339342', '????? 1 ????? ??? 100 ????? ??? ?????. ??????? ??????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-11 10:26:38'),
(66, 'CrytoItami', 'CrytoItami', 'zombie@studionumbernine.net', '89038217635', '???? ?? ???? ????? ?????? ??? ????.  https://tek.seamonkey.es/gotodate/go', '2022-07-12 12:49:05'),
(67, 'CrytoItami', 'CrytoItami', 'adambulthuis@gmail.com', '89036521299', '????????? ?????? ?? ?? ????? ??? ???????.  https://tek.seamonkey.es/gotodate/go', '2022-07-12 03:12:26'),
(68, 'CrytoItami', 'CrytoItami', 'darria.pettiford@gmail.com', '89030617031', '??? $1000 ?? 1 1 ?? ??? ?????. ????? ??????? ?????? ????.  https://tek.seamonkey.es/gotodate/go', '2022-07-12 10:31:31'),
(69, 'CrytoItami', 'CrytoItami', 'tatoskiwis@hotmail.com', '89033048810', '???? ??? ??? ?? ???? ???? ?? ???? ?????? ??? ???????.  https://tek.seamonkey.es/gotodate/go', '2022-07-12 12:54:02'),
(70, 'CrytoItami', 'CrytoItami', 'lalamayu@hotmail.com', '89030979574', '??? 1000 ????? ?? ????? ??? ??? ??? ??? ?????? ??? ??????? ??????.  https://tek.seamonkey.es/gotodate/go', '2022-07-12 03:15:18'),
(71, 'CrytoItami', 'CrytoItami', 'pink_inkpen@hotmail.com', '89037181434', '??????? ?????? ????? ???? ?? ????? ????? ?????.  https://tek.seamonkey.es/gotodate/go', '2022-07-12 05:36:51'),
(72, 'CrytoItami', 'CrytoItami', 'tjburns@consolidated.net', '89037189975', '??? ????????? ??????? ???? ????? ?? ??? ????????.  https://tek.seamonkey.es/gotodate/go', '2022-07-12 07:59:35'),
(73, 'CrytoItami', 'CrytoItami', 'africanpeopleoflove@hotmail.com', '89036243357', '??? ????? ?????? ??? ???? ???????.  https://tek.seamonkey.es/gotodate/go', '2022-07-12 10:20:50'),
(74, 'CrytoItami', 'CrytoItami', 'Megan0822@gmail.com', '89038995655', '???????? ?????? ????? ???????? ??? ???????.  https://tek.seamonkey.es/gotodate/go', '2022-07-13 12:42:09'),
(75, 'CrytoItami', 'CrytoItami', 'lilmochen@gmail.com', '89038565222', '????? ? ?????! ??? ?????? ?? ????? ?? ??????? ??????!  https://tek.seamonkey.es/gotodate/go', '2022-07-13 03:03:00'),
(76, 'CrytoItami', 'CrytoItami', 'xooxmickeyxoox@aol.com', '89034997877', '????????? ?????? ?? ?? ????? ??? ???????.  https://tek.seamonkey.es/gotodate/go', '2022-07-13 05:23:19'),
(77, 'CrytoItami', 'CrytoItami', 'bna1n2@aol.com', '89030686691', '??? ????? ?????? ??? ???? ???????.  https://tek.seamonkey.es/gotodate/go', '2022-07-13 07:45:23'),
(78, 'CrytoItami', 'CrytoItami', 'sroger@metlifehomeloans.com', '89030586098', '???? ?? ????? ??????? ??? ???? ???? ?????.  https://tek.seamonkey.es/gotodate/go', '2022-07-13 10:07:06'),
(79, 'CrytoItami', 'CrytoItami', 's8resourcemgt@gmail.com', '89033771926', '???? ?? ????? ??????? ??? ???? ???? ?????.  https://tek.seamonkey.es/gotodate/go', '2022-07-13 12:28:29'),
(80, 'CrytoItami', 'CrytoItami', 'tigerw58@gmail.com', '89039278066', '??????? ?????? ?? ?? ?????? ??? ???? ?????. ????? ?????? ??? ??? ???????.  https://tek.seamonkey.es/gotodate/go', '2022-07-13 02:48:59'),
(81, 'CrytoItami', 'CrytoItami', 'supl2ax@gmail.com', '89034272889', '??? ???? ??? ???? ???????? ???? ??? ????  https://tek.startupers.se/gotodate/go', '2022-07-13 05:10:17'),
(82, 'CrytoItami', 'CrytoItami', 'a_zellmer@sbcglobal.net', '89034450836', '??????? ?????? ??? ???????? ?? ????? ??????.  https://tek.startupers.se/gotodate/go', '2022-07-13 07:32:26'),
(83, 'CrytoItami', 'CrytoItami', 'allanchau_201292@hotmail.com', '89032701270', '???? ?????? ???? ?? ???? ???? ?????.  https://tek.startupers.se/gotodate/go', '2022-07-13 09:54:45'),
(84, 'CrytoItami', 'CrytoItami', 'beccaluvsue@yahoo.com', '89034875088', '????? ??? ?????? ???? ???? ??? ???????  https://tek.startupers.se/gotodate/go', '2022-07-14 12:35:36'),
(85, 'CrytoItami', 'CrytoItami', 'lthodos@hotmail.com', '89032935184', '??? ????? ?? ???????? ???????? ??? ???. ??? ???? ???!  https://tek.startupers.se/gotodate/go', '2022-07-14 02:57:04'),
(86, 'CrytoItami', 'CrytoItami', 'ksta57@yahoo.com', '89031016213', '???? ?? ???? ?? ??????? ??? ???????? ???? ?????.  https://tek.startupers.se/gotodate/go', '2022-07-14 05:18:42'),
(87, 'CrytoItami', 'CrytoItami', 'phonika@yahoo.com', '89033075449', '?? ???? ??? ????????? ??? ??????? ?????? ????? ??!  https://tek.startupers.se/gotodate/go', '2022-07-14 07:40:30'),
(88, 'CrytoItami', 'CrytoItami', 'uncle.leaver@gmail.com', '89037622251', '????? ??????? ?????? ??????? ?????.  https://tek.startupers.se/gotodate/go', '2022-07-14 10:02:26'),
(89, 'CrytoItami', 'CrytoItami', 'pinkllamalove@gmail.com', '89037594101', '?? ???? ????? ???? ???????? ??? ??? ?????? ??? ??????? ??????.  https://tek.startupers.se/gotodate/go', '2022-07-14 12:24:01'),
(90, 'CrytoItami', 'CrytoItami', 'c_stanley9599@yahoo.com', '89030100013', '??????? ?????? ??? ???????? ?? ????? ??????.  https://tek.startupers.se/gotodate/go', '2022-07-14 02:51:05'),
(91, 'CrytoItami', 'CrytoItami', 'ajfbrfklf@yahoo.com', '89034390671', '???? ?? ?? ???? ??? ????? ??? ????????.  https://tek.startupers.se/gotodate/go', '2022-07-14 05:13:44'),
(92, 'CrytoItami', 'CrytoItami', 'brandyanderson88@yahoo.com', '89032444329', '??? ????? ???? ?????? ??????.  https://tek.startupers.se/gotodate/go', '2022-07-14 07:37:38'),
(93, 'CrytoItami', 'CrytoItami', 'naty.gimbatti@gmail.com', '89038014164', '?? ???? ?????? ??????? ???? ????? ???? ?????. ????? ???????.  https://tek.startupers.se/gotodate/go', '2022-07-14 10:00:08'),
(94, 'CrytoItami', 'CrytoItami', 'malfoys_lylyth@yahoo.com', '89038936370', '?????? ! ??? ????? ??? ????? ??? ????????!  https://tek.startupers.se/gotodate/go', '2022-07-15 12:22:58'),
(95, 'CrytoItami', 'CrytoItami', 'acoplen@hccsc.k12.in.us', '89037151324', '??????? ?????? ?? ????? ????????? ?? ????????.  https://tek.startupers.se/gotodate/go', '2022-07-15 02:45:39'),
(96, 'CrytoItami', 'CrytoItami', 'rholder@eaglecompression.com', '89038492309', '??? ????? ?????? ?? ????? ????? ??? ???????? ???.  https://tek.startupers.se/gotodate/go', '2022-07-15 05:07:44'),
(97, 'CrytoItami', 'CrytoItami', 'marisaespinoza86@yahoo.com', '89031320952', '??? ????????? ??????? ???? ????? ?? ??? ????????.  https://tek.startupers.se/gotodate/go', '2022-07-15 07:28:55'),
(98, 'CrytoItami', 'CrytoItami', 'mz.sexy200978@yahoo.com', '89032253014', '????? ?????? ?? ????? ?? ????. ????? ???????!  https://tek.startupers.se/gotodate/go', '2022-07-15 09:50:13'),
(99, 'CrytoItami', 'CrytoItami', 'ninfa1-bcn@hotmail.com', '89038515776', '??? ????? ?? ?????? ???? ????.  https://tek.startupers.se/gotodate/go', '2022-07-15 12:10:17'),
(100, 'CrytoItami', 'CrytoItami', 'cpbendl@verizon.net', '89034067119', '???? ?? ???? ?? ??????? ??? ???????? ???? ?????.  https://tek.startupers.se/gotodate/go', '2022-07-15 02:31:24'),
(101, 'CrytoItami', 'CrytoItami', 'shirley.sayre@southernlocal.net', '89039800270', '???? ??????? ?????? ??? ??? ???? ?? ????????? ?? ???.  https://tek.startupers.se/gotodate/go', '2022-07-15 04:52:57'),
(102, 'CrytoItami', 'CrytoItami', 'fredfel123@aol.com', '89037410204', '?? ???? ??? ?? ????. ????? ??? ????????.  https://tek.startupers.se/gotodate/go', '2022-07-15 07:13:55'),
(103, 'CrytoItami', 'CrytoItami', 'katee_fisher@yahoo.com', '89037621719', '???? ?? ???? ??????????? ??????? ?????? ?? ????????? ?????.  https://tek.startupers.se/gotodate/go', '2022-07-15 09:39:47'),
(104, 'CrytoItami', 'CrytoItami', 'reenie1954@aol.com', '89032127013', '????? ??? ?????? ??????? ?????? ?? ???? ????? ??.  https://tek.startupers.se/gotodate/go', '2022-07-15 11:59:28'),
(105, 'CrytoItami', 'CrytoItami', 'LeeCarmel59@yahoo.com', '89031312830', '??? ????? ???? ??? ???? 100 ????? ?????.  https://tek.startupers.se/gotodate/go', '2022-07-16 02:19:46'),
(106, 'CrytoItami', 'CrytoItami', 'mpost21@hotmail.com', '89031768189', '?? ?????? ??? ???? ??????. ????? ?????? ??? ??? ???????.  https://tek.startupers.se/gotodate/go', '2022-07-16 04:42:12'),
(107, 'CrytoItami', 'CrytoItami', 'amjad10887@gmail.com', '89032076833', '??????? ?? ???? ????? ??? ?? ???? ?? ????????? ??????.  https://tek.startupers.se/gotodate/go', '2022-07-16 07:04:39'),
(108, 'CrytoItami', 'CrytoItami', 'gameplayandroid133@gmail.com', '89030254146', '???? ?? ?????? ??????? ??????? ? ????? ???? ?? ????? ????.  https://tek.startupers.se/gotodate/go', '2022-07-16 09:25:33'),
(109, 'CrytoItami', 'CrytoItami', 'pabila28@gmail.com', '89031637106', '??? ?????? ?? ?????????. ??? ??????? ?????? ?????? ??? ?????? ????!  https://tek.elletvweb.it/gotodate/go', '2022-07-16 11:48:00'),
(110, 'CrytoItami', 'CrytoItami', 'Jedirampage@gmail.com', '89031437554', '?? ?????? ??? ???? ??????. ????? ?????? ??? ??? ???????.  https://tek.elletvweb.it/gotodate/go', '2022-07-16 02:09:02'),
(111, 'CrytoItami', 'CrytoItami', 'Rose40Budsley@aol.com', '89038450223', '????? ?????? ???? ???? ??? ????????.  https://tek.elletvweb.it/gotodate/go', '2022-07-16 04:29:31'),
(112, 'CrytoItami', 'CrytoItami', 'Jedirampage@gmail.com', '89034662222', '??? ???? ????????? ????? ?? ????? ?? ??? ????.  https://tek.elletvweb.it/gotodate/go', '2022-07-16 06:51:53'),
(113, 'CrytoItami', 'CrytoItami', 'tinaj1122@yahoo.com', '89030125467', '????? 1 ????? ??? 100 ????? ??? ?????. ??????? ??????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-16 09:14:58'),
(114, 'CrytoItami', 'CrytoItami', 'ile-92@hotmail.com', '89030227894', '????? ??? ??????? ???? ????? ?? ???.  https://tek.elletvweb.it/gotodate/go', '2022-07-16 11:37:08'),
(115, 'CrytoItami', 'CrytoItami', 'm_maamaar_r@yahoo.com', '89030912526', '??? ????? ?? ????? ??? ??? ??? ?????? ??????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-17 02:02:37'),
(116, 'CrytoItami', 'CrytoItami', 'debrakatz@optonline.net', '89039367445', '???? ?? ?? ???? ??? ????? ??? ????????.  https://tek.elletvweb.it/gotodate/go', '2022-07-17 06:14:29'),
(117, 'CrytoItami', 'CrytoItami', 'aslanemmi@hotmail.com', '89031239829', '??? ????? ???? ??? ???? 100 ????? ?????.  https://tek.elletvweb.it/gotodate/go', '2022-07-17 08:36:11'),
(118, 'CrytoItami', 'CrytoItami', 'eelkenny@hotmail.com', '89033384664', '???? ?? ?????? ??????? ??????? ? ????? ???? ?? ????? ????.  https://tek.elletvweb.it/gotodate/go', '2022-07-17 10:56:59'),
(119, 'CrytoItami', 'CrytoItami', 'mkm330@yahoo.com', '89037650399', '???? ???? ???? ?? ???????? ???????? ??? ??????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-17 01:21:02'),
(120, 'CrytoItami', 'CrytoItami', 'bombers.jw35@yahoo.com', '89036908200', '????? ??? ?????? ???? ???? ??? ??????! ??? ???? ??? ??? ?????? ???????.  https://tek.elletvweb.it/gotodate/go', '2022-07-17 03:42:29'),
(121, 'CrytoItami', 'CrytoItami', 'otisboatus@hotmail.com', '89030587820', '????? ????? ???? ????????? ????.  https://tek.elletvweb.it/gotodate/go', '2022-07-17 06:04:28'),
(122, 'CrytoItami', 'CrytoItami', 'samiritza@yahoo.com', '89038133221', '??? ????? ???? ??? ???? ?????. ??? ??????? ?? ?? ??????!  https://tek.elletvweb.it/gotodate/go', '2022-07-17 08:24:26'),
(123, 'CrytoItami', 'CrytoItami', 'dittohead00000@yahoo.com', '89037469830', '????? ??? ??????? ???? ????? ?? ???.  https://tek.elletvweb.it/gotodate/go', '2022-07-17 10:46:08'),
(124, 'CrytoItami', 'CrytoItami', 'sammydada67@gmail.com', '89036607187', '???? ?? ????? ??????? ??? ???? ???? ?????.  https://tek.elletvweb.it/gotodate/go', '2022-07-18 01:06:50'),
(125, 'CrytoItami', 'CrytoItami', 'roohiraj@gmail.com', '89033003290', '??????? ?????? ???? ??????? ?????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-18 03:28:50'),
(126, 'CrytoItami', 'CrytoItami', 'tony_the_hair@hotmail.com', '89036272741', '????? ????? ??? ???? ?? ????? ??????? ??? 1000 ?????.  https://tek.elletvweb.it/gotodate/go', '2022-07-18 05:51:10'),
(127, 'CrytoItami', 'CrytoItami', 'anthony680@btinternet.com', '89034922501', '?? ???? ??? ????????? ??? ??????? ?????? ????? ??!  https://tek.elletvweb.it/gotodate/go', '2022-07-18 08:13:07'),
(128, 'CrytoItami', 'CrytoItami', 'thankiem08@yahoo.com', '89032587640', '???? ?? ??? ????????, ???? ???? ???? 24/7.  https://tek.elletvweb.it/gotodate/go', '2022-07-18 10:34:13'),
(129, 'CrytoItami', 'CrytoItami', 'Brandifitch@aol.com', '89030637729', '??? ????? ???? ????? ????? ????. ?????? ???? ???.  https://tek.elletvweb.it/gotodate/go', '2022-07-18 12:57:53'),
(130, 'CrytoItami', 'CrytoItami', 'zakster93@yahoo.com', '89033339336', '??? ????? ???? ??? ???? 100 ????? ?????.  https://tek.elletvweb.it/gotodate/go', '2022-07-18 03:21:38'),
(131, 'CrytoItami', 'CrytoItami', 'tony_the_hair@hotmail.com', '89031302587', '??????? ?? ???? ????. ???? ???? ?? ????? ??????? ?? 24/7.  https://tek.elletvweb.it/gotodate/go', '2022-07-18 05:43:42'),
(132, 'CrytoItami', 'CrytoItami', 'jwiens@gmail.com', '89039669091', '??? ?????? ?? ?????????. ?? ???? ????.  https://tek.elletvweb.it/gotodate/go', '2022-07-18 08:38:25'),
(133, 'CrytoItami', 'CrytoItami', 'ewekizaf@sdd2q.com', '89032460034', '???? ??? ????? ??????? ???????? ????? ?????? ????? ???.  https://tek.elletvweb.it/gotodate/go', '2022-07-18 11:01:20'),
(134, 'CrytoItami', 'CrytoItami', 'adamredbomb@yahoo.com', '89034083801', '???? ?? ???? ??????????? ??????? ?????? ?? ????????? ?????.  https://tek.elletvweb.it/gotodate/go', '2022-07-19 01:22:46'),
(135, 'CrytoItami', 'CrytoItami', 'adnen.debbabi@laposte.net', '89038036572', '????? ????? ??? ???? ?? ???? ?????? ????? ???.  https://tek.elletvweb.it/gotodate/go', '2022-07-19 03:44:27'),
(136, 'CrytoItami', 'CrytoItami', 'felipe7501@sbcglobal.net', '89038065307', '??? ?????? ?? ????? ????? ??? ???????? ???.  https://tek.elletvweb.it/gotodate/go', '2022-07-19 06:06:30'),
(137, 'CrytoItami', 'CrytoItami', 'dameian.helton@gmail.com', '89036788759', '??? ?????? ?? ?????????. ?? ???? ????.  https://tek.elletvweb.it/gotodate/go', '2022-07-19 08:27:01'),
(138, 'CrytoItami', 'CrytoItami', 'pradeepanc@hotmail.com', '89039885071', '????? ??? ?????? ???? ???? ??? ??????! ??? ???? ??? ??? ?????? ???????.  https://tek.elletvweb.it/gotodate/go', '2022-07-19 10:47:00'),
(139, 'CrytoItami', 'CrytoItami', 'hbbell42@yahoo.com', '89035707785', '??????? ?????? ??? ???????? ?? ????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-19 01:07:30'),
(140, 'CrytoItami', 'CrytoItami', 'wsthevisionary@yahoo.com', '89032851352', '???? ????? ??? ???????? ??????????. ??? ?????? ??????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-19 03:28:35'),
(141, 'CrytoItami', 'CrytoItami', 'kellylynnmchugh@gmail.com', '89030169056', '??? ????? ???? ????? ????? ????. ?????? ???? ???.  https://tek.elletvweb.it/gotodate/go', '2022-07-19 05:46:45'),
(142, 'CrytoItami', 'CrytoItami', 'vic0427@bellsouth.net', '89038884291', '??? ??? ?? ?? ????? ??? ????? ????? ??? ???????.  https://tek.elletvweb.it/gotodate/go', '2022-07-19 08:08:54'),
(143, 'CrytoItami', 'CrytoItami', 'rubberduckz1997@gmail.com', '89032023766', '??? ????? ?????? ?? ????? ????? ??? ???????? ???.  https://tek.elletvweb.it/gotodate/go', '2022-07-19 10:31:16'),
(144, 'CrytoItami', 'CrytoItami', 'mpv410@gmail.com', '89038826265', '??? $1000 ?? 1 1 ?? ??? ?????. ????? ??????? ?????? ????.  https://tek.elletvweb.it/gotodate/go', '2022-07-20 12:51:10'),
(145, 'CrytoItami', 'CrytoItami', 'robertoforte@live.com', '89039619500', '??? ????? ?? ???????? ???????? ??? ???. ??? ???? ???!  https://tek.elletvweb.it/gotodate/go', '2022-07-20 03:09:47'),
(146, 'CrytoItami', 'CrytoItami', 'angela.chen895@gmail.com', '89037325962', '????? ???????? ????? ??? ??????? ???? ?? ?? ?????.  https://tek.elletvweb.it/gotodate/go', '2022-07-20 05:49:24'),
(147, 'CrytoItami', 'CrytoItami', 'chrysacosta@yahoo.com', '89030073768', '????? ??????? ?????? ??????? ?????.  https://tek.elletvweb.it/gotodate/go', '2022-07-20 08:13:29'),
(148, 'CrytoItami', 'CrytoItami', 'brittany_hulse@yahoo.com', '89030028820', '??? ?? ???? ??? ?????? ??????? ?????? ??? ?????? ?? ?????.  https://tek.elletvweb.it/gotodate/go', '2022-07-20 10:33:33'),
(149, 'CrytoItami', 'CrytoItami', 'MEMEMEEBARBIE@YAHOO.COM', '89035954681', '?????? ???? ???? 24/7 ??? ??? ?????? ??????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-20 12:54:52'),
(150, 'CrytoItami', 'CrytoItami', 'yliaen@gmail.com', '89038532844', '????? 1 ????? ??? 100 ????? ??? ?????. ??????? ??????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-20 03:15:02'),
(151, 'CrytoItami', 'CrytoItami', 'l.a.m.pe.n.y.uz.ufa.h@gmail.com', '89039092001', '??? ????? ?? ?????? ???? ????.  https://tek.elletvweb.it/gotodate/go', '2022-07-20 05:38:55'),
(152, 'CrytoItami', 'CrytoItami', 'tiaboglin@gmail.com', '89031418239', '????? ????? ???? ????????? ????.  https://tek.elletvweb.it/gotodate/go', '2022-07-20 07:59:32'),
(153, 'CrytoItami', 'CrytoItami', 'goldglove3@yahoo.com', '89032023387', '??????? ?????? ???? ??????? ?? ??? ??? ?????.  https://tek.elletvweb.it/gotodate/go', '2022-07-20 10:16:30'),
(154, 'CrytoItami', 'CrytoItami', 'tallodia@pillsellr.com', '89034503924', '????? ????? ?? ??????? ???? ?? ???? ?? ?????? ?? ?????????.  https://tek.elletvweb.it/gotodate/go', '2022-07-21 01:04:19'),
(155, 'CrytoItami', 'CrytoItami', 'blkstar@yahoo.com', '89030093604', '??????? $1 ????? ???? tomorrow 1000 ???.  https://tek.elletvweb.it/gotodate/go', '2022-07-21 04:58:57'),
(156, 'CrytoItami', 'CrytoItami', 'angus6chan@gmail.com', '89035528013', '??? ????? ???? ??? ???? ?????. ??? ??????? ?? ?? ??????!  https://tek.elletvweb.it/gotodate/go', '2022-07-21 08:52:55'),
(157, 'CrytoItami', 'CrytoItami', 'mazharul_smile@yahoo.com', '89038150395', '?????? ! ??????? ?????? ?? ???? ?? ????????!  https://tek.elletvweb.it/gotodate/go', '2022-07-21 12:56:26'),
(158, 'CrytoItami', 'CrytoItami', 'cheryl_edwards@sbcglobal.net', '89032008283', '???? ?? ????? ???? ???? ?????? ???? ?? ??????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-21 04:48:45'),
(159, 'CrytoItami', 'CrytoItami', 'rysmomma411@yahoo.com', '89039512387', '??? ??? ?? ?? ????? ??? ????? ????? ??? ???????.  https://tek.elletvweb.it/gotodate/go', '2022-07-21 08:39:34'),
(160, 'CrytoItami', 'CrytoItami', 'gourme_pamela1984@yahoo.com', '89033318445', '?? ????? ????? ?? ???? ?? ????? ??? 100 you ??? ?????? ??? ???????.  https://tek.elletvweb.it/gotodate/go', '2022-07-22 12:52:34'),
(161, 'CrytoItami', 'CrytoItami', 'jeffedwar@excite.com', '89030888248', '??????? ????? ?? ???? ????? ????????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-22 08:34:20'),
(162, 'CrytoItami', 'CrytoItami', 'kellylynnmchugh@gmail.com', '89038916446', '???? ????! ??? ?? ???? ????? ????????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-22 12:26:35'),
(163, 'CrytoItami', 'CrytoItami', 'hlgordy@hotmail.com', '89039962986', '??? ????? ???? ??? ???? 100 ????? ?????.  https://tek.elletvweb.it/gotodate/go', '2022-07-22 04:11:20'),
(164, 'CrytoItami', 'CrytoItami', 'tiaboglin@gmail.com', '89033781952', '????? ????? ???? ????????? ????.  https://tek.elletvweb.it/gotodate/go', '2022-07-22 08:03:01'),
(165, 'CrytoItami', 'CrytoItami', 'ellesime@hotmail.com', '89034577135', '??????? ?????? ?? ???? ???? ????????.  https://tek.elletvweb.it/gotodate/go', '2022-07-23 12:00:59'),
(166, 'CrytoItami', 'CrytoItami', 'sondervik@gmail.com', '89035830188', '???? ?? ??? ???? ????????? ?? ?????.  https://tek.elletvweb.it/gotodate/go', '2022-07-23 03:54:54'),
(167, 'CrytoItami', 'CrytoItami', 'tabuhaq@yahoo.com', '89039434333', '# 1 ???? ???? ?? ??????! ???? ?? ??????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-23 08:08:19'),
(168, 'CrytoItami', 'CrytoItami', 'smatz@usd397.com', '89033250711', '??? ?????? ?? ?????????. ?? ???? ????.  https://tek.elletvweb.it/gotodate/go', '2022-07-23 03:54:36'),
(169, 'CrytoItami', 'CrytoItami', 'jyw@hotmail.com', '89039962750', '??????? ?????? ??? ???????? ?? ????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-24 12:22:01'),
(170, 'CrytoItami', 'CrytoItami', 'play65@hotmail.com', '89034798967', '???? ???? ???? ????? ?? ????? ??? ????. ????? ??? ????????.  https://tek.elletvweb.it/gotodate/go', '2022-07-24 08:18:13'),
(171, 'CrytoItami', 'CrytoItami', 'gregorivanov@email.org', '89039549556', '???? ????! ??? ?? ???? ????? ????????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-24 12:10:39'),
(172, 'CrytoItami', 'CrytoItami', 'murdockalicia17@gmail.com', '89039247632', '????? ??? ???????? ?? ???? ????? ???? ??? ?????.  https://tek.elletvweb.it/gotodate/go', '2022-07-24 04:04:00'),
(173, 'CrytoItami', 'CrytoItami', 'tomwelter@uk2.net', '89034922186', '????? ??????? ???? ?????? ???????? ??? ???????.  https://tek.elletvweb.it/gotodate/go', '2022-07-24 07:59:01'),
(174, 'CrytoItami', 'CrytoItami', 'pegbd@Charter.net', '89039485851', '????? ????? ???? ????????? ????.  https://tek.elletvweb.it/gotodate/go', '2022-07-24 11:51:45'),
(175, 'CrytoItami', 'CrytoItami', 'aris_win99@yahoo.com', '89039970026', '????????? ?????? ?? ?? ?????? ??????.  https://tek.elletvweb.it/gotodate/go', '2022-07-25 03:46:43'),
(176, 'CrytoItami', 'CrytoItami', 'alabrinza@yahoo.com', '89033827781', '??? ????? ???? ?? ???? ?? ????? ?????? ??? ??? ?????? ??? ???????.  https://tek.elletvweb.it/gotodate/go', '2022-07-25 07:37:32'),
(177, 'CrytoItami', 'CrytoItami', 'matthew_motes@yahoo.com', '89037160609', '????? ? ?????! ??? ?????? ?? ????? ?? ??????? ??????!  https://tek.elletvweb.it/gotodate/go', '2022-07-25 11:33:19'),
(178, 'CrytoItami', 'CrytoItami', 'liwold@gmail.com', '89030930734', '??? ????? ?????? ??? ???? ???????.  https://tek.elletvweb.it/gotodate/go', '2022-07-25 07:50:15'),
(179, 'CrytoItami', 'CrytoItami', 'fixnthngs@hotmail.com', '89039102560', '??? ????? 24/7 ??? ?? ???? ?????????.  https://tek.frostyelk.se/gotodate/go', '2022-07-26 12:45:11'),
(180, 'CrytoItami', 'CrytoItami', 'robin.walker247@comcast.net', '89038056384', '???? ?? ?? ???? ??? ????? ??? ????????.  https://tek.frostyelk.se/gotodate/go', '2022-07-26 04:41:12'),
(181, 'CrytoItami', 'CrytoItami', 'stephanie.warren@cnh.com', '89034958129', '??? ?????? ?? ?????????. ??? ??????? ?????? ?????? ??? ?????? ????!  https://tek.frostyelk.se/gotodate/go', '2022-07-26 08:34:45'),
(182, 'CrytoItami', 'CrytoItami', 'c.eissej@gmail.com', '89031304915', '???? ?????? ??? ???? ?? ???? ????.  https://tek.frostyelk.se/gotodate/go', '2022-07-26 12:27:51'),
(183, 'CrytoItami', 'CrytoItami', 'yustiana_utama@yahoo.com', '89032669353', '??? ????? ??? ???????? ? ??????? ?? ?????? ??? ?????? ??????.  https://tek.frostyelk.se/gotodate/go', '2022-07-26 04:21:53'),
(184, 'CrytoItami', 'CrytoItami', 'megan_wicks19@yahoo.com', '89036543873', '????? ????? ??? ???? ?? ???? ?????? ????? ???.  https://tek.frostyelk.se/gotodate/go', '2022-07-26 08:15:28'),
(185, 'CrytoItami', 'CrytoItami', 'kadbar3783@nrms.org', '89036286348', '????? ????? ?? ??????? ???? ?? ???? ?? ?????? ?? ?????????.  https://tek.frostyelk.se/gotodate/go', '2022-07-27 12:05:11'),
(186, 'CrytoItami', 'CrytoItami', 'liwold@gmail.com', '89036919937', '?????? ???? ???? 24/7 ??? ??? ?????? ??????? ??????.  https://tek.frostyelk.se/gotodate/go', '2022-07-27 03:55:04'),
(187, 'CrytoItami', 'CrytoItami', 'sorinaromano@yahoo.com', '89035189268', '??? ????? ???? ?? ???? ?? ????? ?????? ??? ??? ?????? ??? ???????.  https://tek.frostyelk.se/gotodate/go', '2022-07-27 07:47:12'),
(188, 'CrytoItami', 'CrytoItami', 'puroclan@hotmail.com', '89038924321', '??? ????? ?? ????? ??? ??? ??? ?????? ??????? ??????.  https://tek.frostyelk.se/gotodate/go', '2022-07-27 11:37:16'),
(189, 'CrytoItami', 'CrytoItami', 'susannah_wells@hotmail.com', '89035866078', '???? ??? ????? ??????? ???????? ????? ?????? ????? ???.  https://tek.frostyelk.se/gotodate/go', '2022-07-27 03:31:31'),
(190, 'CrytoItami', 'CrytoItami', 'industrialfeyxo@yahoo.com', '89033337952', '????? ?????? ???? ???? ??? ????????.  https://tek.frostyelk.se/gotodate/go', '2022-07-27 11:28:11'),
(191, 'CrytoItami', 'CrytoItami', 'pacoparra@gmail.com', '89035859222', '??? ????? ???? ??? ???? ?????. ???  https://tek.frostyelk.se/gotodate/go', '2022-07-28 07:20:46'),
(192, 'CrytoItami', 'CrytoItami', 'loc.nql@gmail.com', '89036640996', '??? ???? ??? ???? ???????? ???? ??? ????  https://tek.frostyelk.se/gotodate/go', '2022-07-28 11:14:41'),
(193, 'CrytoItami', 'CrytoItami', 'valeriemule@greeninbox.org', '89031401879', '???? ?? ?? ???? ??? ????? ??? ????????.  https://tek.pumpati.de/tek', '2022-07-28 01:48:10'),
(194, 'CrytoItami', 'CrytoItami', 'gamu2lawin@yahoo.com', '89032492969', '??? ????? ? ???? ?????! ??????? ?????? ?? ?? ??????.  https://tek.pumpati.de/tek', '2022-07-28 04:10:35'),
(195, 'CrytoItami', 'CrytoItami', 'michelleciecwierz@yahoo.com', '89030910149', '??? ????? ???? ??? ???? 100 ????? ????? ??????? ??? ???????.  https://tek.pumpati.de/tek', '2022-07-28 06:32:13'),
(196, 'CrytoItami', 'CrytoItami', 'ellesime@hotmail.com', '89033950670', '????? 1 ????? ??? 100 ????? ??? ?????. ??????? ??????? ??????.  https://tek.pumpati.de/tek', '2022-07-28 08:53:28'),
(197, 'CrytoItami', 'CrytoItami', 'downey.hilary@gmail.com', '89030240443', '??? ????? ?????? ??? ???? ???????.  https://tek.pumpati.de/tek', '2022-07-28 11:14:37'),
(198, 'CrytoItami', 'CrytoItami', 'themtwenties@hotmail.com', '89034268264', '??? ????? ???? ?????? ??????.  https://tek.pumpati.de/tek', '2022-07-29 01:36:25'),
(199, 'CrytoItami', 'CrytoItami', 'sqimyrrizwm@hotmails.com', '89034622565', '??????? $1 ????? ???? tomorrow 1000 ???.  https://tek.pumpati.de/tek', '2022-07-29 03:57:12'),
(200, 'ElenaBop', 'ElenaBop', 'elenaBop@outlook.com', '+40 2843746860', '????? ?? ????! ???? ?? ?????? ?? ???? ????? ???? ?\r\n??? ???? ???? ????? ?????? ??? ?????? ???? ??? ?! :)\r\n??? 26 ??? ? ??????  ? ?? ??????? ? ???? ?????? ?????????? ?????????? ?????\r\n? .. ??? ??? ???? ???? ??????. ?? ???? ?? ??? ? ????? ?? ?????? (?? ?????? ?? ???? ??? ??? ?????)\r\n?? ??? ? ???? ?????? ????? ???? ?? ??? ????? ??? ?))\r\n??? ???? ?????? ? ???? ???? ? ????? ?? ????? ???? ?????? ...\r\n??? ?? ??? ? ????? ?????? ??? ???? ?????? ???: http://provisadhaly.ml/user-11015/ \r\n', '2022-07-29 05:18:47'),
(201, 'CrytoItami', 'CrytoItami', 'wildflower8779@yahoo.com', '89030194162', '???? ????? ??? ???????? ??????????. ??? ?????? ??????? ??????.  https://tek.pumpati.de/tek', '2022-07-29 06:16:26'),
(202, 'CrytoItami', 'CrytoItami', 'renewenvserv@att.net', '89030639821', '?? ????? ????? ?? ???? ?? ????? ??? 100 you ??? ?????? ??? ???????.  https://tek.pumpati.de/tek', '2022-07-29 08:35:24'),
(203, 'CrytoItami', 'CrytoItami', 'hrteoloko@gmail.com', '89036477112', '??? ??????? ???? ?? ???? ?? ????? 24/7.  https://tek.pumpati.de/tek', '2022-07-29 10:56:11'),
(204, 'CrytoItami', 'CrytoItami', 'trish5507@gmail.com', '89037703952', '??????? ?????? ????? ?? ?? # 1 ???? ???? ?????.  https://tek.pumpati.de/tek', '2022-07-29 01:15:07'),
(205, 'CrytoItami', 'CrytoItami', 'mdkass@comcast.net', '89037776569', '?? ?????? ??? ???? ???? ??????? ??? ????????. ???? ??????!  https://tek.pumpati.de/tek', '2022-07-29 03:36:42'),
(206, 'CrytoItami', 'CrytoItami', 'metalblud@gmail.com', '89039731705', '?? ???? ??? ????????? ?????? ????!  https://tek.pumpati.de/tek', '2022-07-29 05:57:38'),
(207, 'CrytoItami', 'CrytoItami', 'uchemaryjane@yahoo.com', '89033480095', '???? ????? ??? ???? ?????? ?? ???.  https://tek.pumpati.de/tek', '2022-07-29 08:20:54'),
(208, 'CrytoItami', 'CrytoItami', 'lholder@rrfcu.com', '89037714285', '????? ???????? ????? ??? ??????? ???? ?? ?? ?????.  https://tek.pumpati.de/tek', '2022-07-30 01:25:46'),
(209, 'CrytoItami', 'CrytoItami', 'Brandifitch@aol.com', '89038073106', '??? $1000 ?? 1 1 ?? ??? ?????. ????? ??????? ?????? ????.  https://tek.pumpati.de/tek', '2022-07-30 03:46:45'),
(210, 'CrytoItami', 'CrytoItami', 'digitan@naver.com', '89033115575', '????? ?????? ?? ????? ?? ????. ????? ???????!  https://tek.pumpati.de/tek', '2022-07-30 06:05:52'),
(211, 'CrytoItami', 'CrytoItami', 'rhemanat@yahoo.com', '89038228538', '??? ????? ???? ??? ???? 100 ????? ?????.  https://tek.pumpati.de/tek', '2022-07-30 08:26:44'),
(212, 'CrytoItami', 'CrytoItami', 'amwagrez@gmail.com', '89033313539', '??? ?????? ?? ????? ????? ??? ???????? ???.  https://tek.qbe-medienhaus.de/tek', '2022-07-30 10:47:27'),
(213, 'CrytoItami', 'CrytoItami', 'brittany_hulse@yahoo.com', '89035657302', '??? ????? ???? ??? ???? ?????. ???  https://tek.qbe-medienhaus.de/tek', '2022-07-30 01:08:48'),
(214, 'CrytoItami', 'CrytoItami', 'pityshtolze@ymail.org', '89031666970', '??????? ?? ???? ????. ???? ???? ?? ????? ??????? ?? 24/7.  https://tek.qbe-medienhaus.de/tek', '2022-07-30 03:50:49'),
(215, 'CrytoItami', 'CrytoItami', 'rablove@live.com', '89032641306', '??????? ?????? ?? ????? ????? ?????? ?????? ????.  https://tek.qbe-medienhaus.de/tek', '2022-07-30 06:11:44'),
(216, 'CrytoItami', 'CrytoItami', 'fixnthngs@hotmail.com', '89032450115', '??? ????? ?????? ??? ???? ???????.  https://tek.qbe-medienhaus.de/tek', '2022-07-30 10:02:56'),
(217, 'CrytoItami', 'CrytoItami', 'sarahdoesfandom@gmail.com', '89039618901', '????? ???? ?? ???, ???? ???? ?? ???? ????? 1 100 ???.  https://tek.qbe-medienhaus.de/tek', '2022-07-31 12:23:14'),
(218, 'CrytoItami', 'CrytoItami', 'thankiem08@yahoo.com', '89036246271', '????? ?????? ???? ???? ??? ????????.  https://tek.qbe-medienhaus.de/tek', '2022-07-31 02:47:44'),
(219, 'CrytoItami', 'CrytoItami', 'jleibold@comcast.net', '89032682550', '?????? ! ??? ????? ??? ????? ??? ????????!  https://tek.qbe-medienhaus.de/tek', '2022-07-31 05:10:28'),
(220, 'CrytoItami', 'CrytoItami', 'tiaboglin@gmail.com', '89033138596', '???? ????! ??? ?? ???? ????? ????????? ??????.  https://tek.qbe-medienhaus.de/tek', '2022-07-31 07:34:20'),
(221, 'CrytoItami', 'CrytoItami', 'godinovirgie@yahoo.com', '89032535053', '???? ??? ??? ?? ???? ???? ?? ???? ?????? ??? ???????.  https://tek.qbe-medienhaus.de/tek', '2022-07-31 09:55:17'),
(222, 'CrytoItami', 'CrytoItami', 'pitmarley@email.net', '89031324036', '?? ????? ?? ???? ?? ?? ???? ?? ??? ?????.  https://tek.qbe-medienhaus.de/tek', '2022-07-31 12:15:20'),
(223, 'CrytoItami', 'CrytoItami', 'kkaren1@juno.com', '89033341372', '???? ????? ??? ???????? ??????????. ??? ?????? ??????? ??????.  https://tek.qbe-medienhaus.de/tek', '2022-07-31 02:34:17'),
(224, 'CrytoItami', 'CrytoItami', 'dyugdyuginmobany@yahoo.com', '89039342151', '????? ?????? ???? ???? ??? ????????.  https://tek.qbe-medienhaus.de/tek', '2022-07-31 04:56:51'),
(225, 'CrytoItami', 'CrytoItami', 'Cardio439@gmail.com', '89030212561', '???? ???? ???? ????? ?? ????? ??? ????. ????? ??? ????????.  https://tek.qbe-medienhaus.de/tek', '2022-07-31 07:22:03'),
(226, 'CrytoItami', 'CrytoItami', 'aldenorthmm@yahoo.com', '89034938533', '??????? $1 ????? ???? tomorrow 1000 ???.  https://tek.qbe-medienhaus.de/tek', '2022-07-31 09:43:25'),
(227, 'CrytoItami', 'CrytoItami', 'ingrid_457@hotmail.com', '89037904388', '???? ?? ???? ????? ?????? ??? ????.  https://tek.qbe-medienhaus.de/tek', '2022-08-01 12:04:02'),
(228, 'CrytoItami', 'CrytoItami', 'aslanemmi@hotmail.com', '89039869132', '??? ?? ???? ??? ?????? ??????? ?????? ??? ?????? ?? ?????.  https://tek.qbe-medienhaus.de/tek', '2022-08-01 02:23:44'),
(229, 'CrytoItami', 'CrytoItami', 'r.reza131@gmail.com', '89036087363', '??? ???? ????????? ????? ?? ????? ?? ??? ????.  https://tek.qbe-medienhaus.de/tek', '2022-08-01 04:43:53');

-- --------------------------------------------------------

--
-- Table structure for table `cron_test`
--

CREATE TABLE `cron_test` (
  `id` int(11) NOT NULL,
  `cron_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cron_test`
--

INSERT INTO `cron_test` (`id`, `cron_id`) VALUES
(1, 140891);

-- --------------------------------------------------------

--
-- Table structure for table `email_info_offer`
--

CREATE TABLE `email_info_offer` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_date` varchar(255) NOT NULL,
  `type` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_info_offer`
--

INSERT INTO `email_info_offer` (`id`, `subject`, `message`, `created_date`, `type`) VALUES
(1, 'a', '<p>a</p>', '2022-03-27 02:54:48', 'customer_all');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(530) NOT NULL,
  `answer` mediumtext NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `image`) VALUES
(6, 'What is Port10?', '<p>We are a technological company working to improve and simplify commerce between businesses.</p>\r\n\r\n<p>A look at Vision 2030</p>\r\n\r\n<p><a href=\"https://www.vision2030.gov.sa/\">Vision2030</a> is a national transformation blueprint of Saudi Arabia to turn the country into a diversified economic powerhouse and leverage its strategic position to become a hub linking multiple continents. At Port10, we focus on the Digital Transformation. Business activity, and commerce specifically, is being dragged by inefficiencies. By working on this digital drive, we help our customers focus on their core activities and make the process of commerce better.</p>\r\n', ''),
(7, 'What is ecommerce?', '<p>E-commerce is handling business transactions using electronic platforms. By using platforms such as ours, businesses can conduct all their activities electronically, from Customer Service and Marketing, to Sales and Payments.</p>\r\n', ''),
(8, 'Who is Port10 for?', '<p>Port10 is for all those interested in buying and selling in bulk or wholesale.</p>\r\n', ''),
(9, 'What are the benefits of Port10?', '<p>Digitizing the buying and selling experience. The COVID-19 pandemic has shown us the need to urgently move businesses online and increase efficiency in all the processes related to commerce.</p>\r\n', ''),
(10, 'Which geographic markets is Port10 available?', '<p>Port10 is initially launching in Saudi Arabia.</p>\r\n', ''),
(11, 'How can I join?', '<p>Easy! Just click <a href=\"https://port10.sa/en/login\">here</a>, fill out the details and you will be part of Port10 in minutes!</p>\r\n', ''),
(12, 'What are the benefits of the subscribing to Port10?', '<p>Subscriptions are offered to sellers interested in expanding their reach using the power of the internet. By becoming a Port10 subscriber, a seller can put up products for sale, arrange documentation, handle customer inquiry and much more all in one place.</p>\r\n', ''),
(13, 'What’s the buying process at Port10?', '<ul>\r\n	<li>Visit the registration <a href=\"https://port10.sa/en/login\">link</a>.</li>\r\n	<li>Choose <strong>Account Type</strong> as a <strong>Buyer</strong>.</li>\r\n	<li>Fill out the registration details as required.</li>\r\n	<li>Once complete, you will receive an activation email to complete the registration process.</li>\r\n	<li>Search our product catalogue to find products that meets your demand.</li>\r\n	<li>Choose the product and add it to your cart.</li>\r\n	<li>Head to the checkout to conduct payment. You can use card payment (Mada, Mastercard or Visa) and also bank transfer payments.</li>\r\n	<li>Done!</li>\r\n</ul>\r\n', ''),
(14, 'What’s the selling process at Port10?', '<ul>\r\n	<li>Visit the registration <a href=\"https://port10.sa/en/login\">link</a>.</li>\r\n	<li>Choose <strong>Account Type</strong> as a <strong>Supplier</strong>.</li>\r\n	<li>Fill out the registration details as required.</li>\r\n	<li>Once complete, you will receive an activation email to complete the registration process.</li>\r\n	<li>After that, you will receive on your email detailed steps to help you setup your seller account and start handling online orders.</li>\r\n</ul>\r\n', ''),
(15, 'What products will be offered on Port10?', '<p>You can find all types of products on Port10.</p>\r\n\r\n<p><br />\r\nThe major product categories that we have on our platform are: <a href=\"https://port10.sa/en/home/listing/1\">Food and Beverages</a>, Textile and Accessories, <a href=\"https://port10.sa/en/home/listing/40\">Electronics</a>, <a href=\"https://port10.sa/en/home/listing/49\">Toys and Gifts</a>, <a href=\"https://port10.sa/en/home/listing/63\">Body and Beauty</a>, <a href=\"https://port10.sa/en/home/listing/70\">Construction and Commercial Equipments</a>, <a href=\"https://port10.sa/en/home/listing/82\">Metals and Chemicals Raw Materials</a>, <a href=\"https://port10.sa/en/home/listing/99\">Paper and Packaging</a> and <a href=\"https://port10.sa/en/home/listing/110\">Automotive</a>.</p>\r\n', ''),
(16, 'What are the costs for using Port10?', '<ul>\r\n	<li>As a Buyer, you have no costs whatsoever. Once registered, you can start shopping immediately.</li>\r\n	<li>Sellers can subscribe using our <a href=\"https://port10.sa/en/price\">Basic</a> package, which gives them access to upload products, monitor orders and sales, enjoy direct messaging channels with buyers and also accept Request for Quotations (RFQ).</li>\r\n	<li>In addition to that, Sellers are capable of making purchases on Port10, for free.</li>\r\n</ul>\r\n', ''),
(17, 'Where can I access my account details?', '<p>Buyer &ndash; You can follow the below steps to check out or edit your account details:</p>\r\n\r\n<ol>\r\n	<li>Log In.</li>\r\n	<li>Click the account icon that&rsquo;s on the top right side of the page.</li>\r\n	<li>Click on the <strong>Edit Profile</strong>.</li>\r\n	<li>Make the changes as needed.</li>\r\n	<li>Click on <strong>Update </strong>to save changes.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Seller &ndash; The account details can be accessed by following the steps:</p>\r\n\r\n<ol>\r\n	<li>Log In.</li>\r\n	<li>On the top left hand corner, click the burger button (&equiv;).</li>\r\n	<li>Go to <strong>Account Settings</strong>.</li>\r\n	<li>You will have two options available, <strong>Edit Profile</strong> and <strong>Subscription History</strong>.</li>\r\n	<li>Click on Edit Profile to view your account details and if you want to change any of the fields, you can do so and save your changes.</li>\r\n</ol>\r\n\r\n<p>Click on Subscription History to find out information about your subscription.</p>\r\n', ''),
(18, 'What if I face problems on my account?', '<p>You can contact our support team at <a href=\"mailto:hello@port10.sa\">hello@port10.sa</a> and we&rsquo;ll be happy to assist you.</p>\r\n', ''),
(19, 'How can I make orders?', '<p>Simple. Just follow the steps below:</p>\r\n\r\n<ol>\r\n	<li>Register as a buyer or supplier.</li>\r\n	<li>Log In to your account.</li>\r\n	<li>Use the search bar to find the products you&rsquo;re looking for.</li>\r\n	<li>Put it on the cart and continue searching for your other items or head to the checkout page to finish your order.</li>\r\n	<li>At the cart, you can choose the payment method that is best for you. You can either choose <strong>Virtual Account Transfer</strong> or <strong>Credit Card</strong>.</li>\r\n	<li>Once at the checkout page, you will input the payment address (one-time only) and confirm payment. If payment is made using a card, you will input the details of the card and conclude the payment. If you chose transfer as your option, then you will get the order information such as transaction reference and other details to make the transfer to the designated virtual account that will show up once you confirm the order.</li>\r\n</ol>\r\n\r\n<p>Done! Your order will be ready to be processed by the supplier.</p>\r\n', ''),
(20, 'What are the payment methods used on Port10?', '<p>There are two payments methods used on Port10: Cards and Transfers.</p>\r\n\r\n<p>By using cards for payments, your order will be paid off for immediately and the invoice will be made available to you. You can use Mada, Visa or Mastercards to make your payments.</p>\r\n\r\n<p>Transfers require you to pay off the invoice value by transferring to the virtual account that shows up upon finalizing your order. You can transfer to the account online, through a bank branch or via mobile app of your bank. The invoice will be made available to you only once payment is confirmed received, which can take up to 3 days.</p>\r\n', ''),
(21, 'I have special requirements for my order. How can I have that handled?', '<p>You can have your order requirements processed via our RFQ panel. By inputting all the necessary details for your order and sending it to the supplier, you can get specially tailored pricing as per your need.</p>\r\n', ''),
(22, 'How about delivery for my orders?', '<p>You can specify the delivery method and requirements during the order.</p>\r\n\r\n<p>We are working on setting up delivery services and any developments made will be announced soon.</p>\r\n\r\n<p>At the moment, delivery is either made directly by the supplier or you will have to arrange for pick up from the supplier&rsquo;s warehouse.</p>\r\n', ''),
(23, 'Is Port10 available in international markets?', '<p>We are currently operating in Saudi Arabia only and will be announcing expansions to the GCC markets soon.</p>\r\n', ''),
(24, 'What is the return and refund process?', '<p>The return of a product has to be arranged directly with the supplier by lodging a request. Refunds, if required, will be made by the supplier.</p>\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `faq_trans`
--

CREATE TABLE `faq_trans` (
  `id` int(11) NOT NULL,
  `question` varchar(530) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq_trans`
--

INSERT INTO `faq_trans` (`id`, `question`, `answer`, `image`) VALUES
(8, 'Who is Port10 for?', 'Port10 is for all those interested in buying and selling in bulk or wholesale.', ''),
(6, 'ما هو Port10؟', '<p>نحن شركة تكنولوجية تعمل على تحسين وتبسيط التجارة بين الشركات.</p>\r\n\r\n<p>نظرة على رؤية 2030</p>\r\n\r\n<p>رؤية 2020 هي مخطط تحول وطني للمملكة العربية السعودية لتحويل البلاد إلى قوة اقتصادية متنوعة والاستفادة من موقعها الاستراتيجي لتصبح مركزًا يربط بين قارات متعددة. في Port10 ، نركز على التحول الرقمي. يتم جر النشاط التجاري ، والتجارة على وجه التحديد ، بسبب عدم الكفاءة. من خلال العمل على هذا المحرك الرقمي ، نساعد عملائنا على التركيز على أنشطتهم الأساسية وجعل عملية التجارة أفضل.</p>\r\n', ''),
(7, 'What is ecommerce?', 'E-commerce is handling business transactions using electronic platforms. By using platforms such as ours, businesses can conduct all their activities electronically, from Customer Service and Marketing, to Sales and Payments.', ''),
(9, 'What are the benefits of Port10?', 'Digitizing the buying and selling experience. The COVID-19 pandemic has shown us the need to urgently move businesses online and increase efficiency in all the processes related to commerce.', ''),
(10, 'Which geographic markets is Port10 available?', 'Port10 is initially launching in Saudi Arabia.', ''),
(11, 'How can I join?', 'Easy! Just click here, fill out the details and you will be part of Port10 in minutes!', ''),
(12, 'What are the benefits of the subscribing to Port10?', 'Subscriptions are offered to sellers interested in expanding their reach using the power of the internet. By becoming a Port10 subscriber, a seller can put up products for sale, arrange documentation, handle customer inquiry and much more all in one place.', ''),
(13, 'What', '-	Visit the registration link.\r\n\r\n-	Choose Account Type as a Buyer.\r\n\r\n-	Fill out the registration details as required.\r\n\r\n-	Once complete, you will receive an activation email to complete the registration process.\r\n\r\n-	Search our product catalogue to find products that meets your demand.\r\n\r\n-	Choose the product and add it to your cart.\r\n\r\n-	Head to the checkout to conduct payment. You can use card payment (Mada, Mastercard or Visa) and also bank transfer payments.\r\n\r\n-	Done!\r\n', ''),
(14, 'What', '-	Visit the registration link.\r\n\r\n-	Choose Account Type as a Supplier.\r\n\r\n-	Fill out the registration details as required.\r\n\r\n-	Once complete, you will receive an activation email to complete the registration process.\r\n\r\n-	After that, you will receive on your email detailed steps to help you setup your seller account and start handling online orders.\r\n', ''),
(15, 'What products will be offered on Port10?', 'You can find all types of products on Port10.\r\n\r\nThe major product categories that we have on our platform are: Food and Beverages, Textile and Accessories, Electronics, Toys and Gifts, Body and Beauty, Construction and Commercial Equipments, Metals and Chemicals Raw Materials, Paper and Packaging and Automotive.\r\n', ''),
(16, 'What are the costs for using Port10?', 'As a Buyer, you have no costs whatsoever. Once registered, you can start shopping immediately.\r\n\r\nSellers can subscribe using our Basic package, which gives them access to upload products, monitor orders and sales, enjoy direct messaging channels with buyers and also accept Request for Quotations (RFQ). \r\nIn addition to that, Sellers are capable of making purchases on Port10, for free.\r\n', ''),
(17, 'Where can I access my account details?', 'Buyer ', ''),
(18, 'What if I face problems on my account?', 'You can contact our support team at hello@port10.sa and we', ''),
(19, 'How can I make orders?', 'Simple. Just follow the steps below:\r\n1.	Register as a buyer or supplier.\r\n2.	Log In to your account.\r\n3.	Use the search bar to find the products you', ''),
(20, 'What are the payment methods used on Port10?', 'There are two payments methods used on Port10: Cards and Transfers. \r\n\r\nBy using cards for payments, your order will be paid off for immediately and the invoice will be made available to you. You can use Mada, Visa or Mastercards to make your payments.\r\n\r\nTransfers require you to pay off the invoice value by transferring to the virtual account that shows up upon finalizing your order. You can transfer to the account online, through a bank branch or via mobile app of your bank. The invoice will be made available to you only once payment is confirmed received, which can take up to 3 days.\r\n', ''),
(21, 'I have special requirements for my order. How can I have that handled?', 'You can have your order requirements processed via our RFQ panel. By inputting all the necessary details for your order and sending it to the supplier, you can get specially tailored pricing as per your need. ', ''),
(22, 'How about delivery for my orders?', 'You can specify the delivery method and requirements during the order.\r\n\r\nWe are working on setting up delivery services and any developments made will be announced soon.\r\n', ''),
(23, 'Is Port10 available in international markets?', 'We are currently operating in Saudi Arabia only and will be announcing expansions to the GCC markets soon.', ''),
(24, 'What is the return and refund process?', 'The return of a product has to be arranged directly with the supplier by lodging a request. Refunds, if required, will be made by the supplier.', '');

-- --------------------------------------------------------

--
-- Table structure for table `footer_content`
--

CREATE TABLE `footer_content` (
  `id` int(11) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `mobile_no2` varchar(30) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `email_id2` varchar(80) NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_arabic` varchar(530) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `newsletter` varchar(500) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `cr_number` varchar(255) NOT NULL,
  `vat_number` varchar(255) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `google_map_location` text NOT NULL,
  `default_period` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `footer_content`
--

INSERT INTO `footer_content` (`id`, `mobile_no`, `mobile_no2`, `email_id`, `email_id2`, `location`, `location_arabic`, `newsletter`, `facebook`, `twitter`, `linkedin`, `youtube`, `cr_number`, `vat_number`, `fax`, `google_map_location`, `default_period`) VALUES
(1, '920033769', '', 'hello@port10.sa', '', 'Granada Business Towers<br>Tower A4 – Unit 24<br>Eastern Ring Road – Exit 8 – Al Rabwah District<br>Riyadh 12824 – 4748<br>Kingdom of Saudi Arabia', 'Granada Business Towers<br>Tower A4 – Unit 24<br>Eastern Ring Road – Exit 8 – Al Rabwah District<br>Riyadh 12824 – 4748<br>Kingdom of Saudi Arabia', 'ddddd', 'https://www.facebook.com', 'https://twitter.com', 'https://www.linkedin.com/', 'https://www.youtube.com/', '1010531814', '3022513519', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3622.2462028674645!2d46.723810814618076!3d24.787021654302468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2efdb8b99ddbbb%3A0xdf0d9bfc1c97e402!2sGranada%20Business!5e0!3m2!1sen!2sin!4v1644947592250!5m2!1sen!2sin\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', '3 month');

-- --------------------------------------------------------

--
-- Table structure for table `inv_mesg_notification`
--

CREATE TABLE `inv_mesg_notification` (
  `id` int(11) NOT NULL,
  `noti_type` varchar(30) NOT NULL,
  `message` varchar(530) NOT NULL,
  `uid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `qut_msg_id` int(11) NOT NULL,
  `send_by` varchar(15) NOT NULL,
  `send_to` varchar(30) NOT NULL,
  `is_seen` tinyint(1) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_mesg_notification`
--

INSERT INTO `inv_mesg_notification` (`id`, `noti_type`, `message`, `uid`, `sid`, `qut_msg_id`, `send_by`, `send_to`, `is_seen`, `created_date`) VALUES
(1, 'invoice', 'You receive new invoice request', 3, 4, 13, 'user', 'seller', 1, '2022-06-29 09:35:09'),
(2, 'invoice', 'You receive new invoice request', 3, 15, 14, 'user', 'seller', 0, '2022-06-29 01:42:15'),
(3, 'invoice', 'Admin assigned new request', 8, 10, 7, 'admin', 'seller', 0, '2022-06-30 11:12:55'),
(4, 'invoice', 'You receive new invoice request', 3, 4, 15, 'user', 'seller', 1, '2022-06-30 11:47:33'),
(5, 'invoice', 'Your invoice request confirmed by seller', 3, 4, 15, 'seller', 'user', 0, '2022-06-30 05:18:29'),
(6, 'invoice', 'You receive new invoice request', 3, 0, 16, 'user', 'admin', 1, '2022-06-30 04:14:17'),
(7, 'invoice', 'You receive new invoice request', 3, 4, 17, 'user', 'seller', 0, '2022-06-30 04:15:21'),
(8, 'invoice', 'Your invoice request confirmed by seller', 3, 4, 17, 'seller', 'user', 0, '2022-06-30 09:50:02'),
(9, 'invoice', 'You receive new invoice request', 3, 4, 18, 'user', 'seller', 0, '2022-06-30 04:29:00'),
(10, 'invoice', 'Your invoice request confirmed by seller', 3, 4, 18, 'seller', 'user', 0, '2022-06-30 09:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `items_extra_data`
--

CREATE TABLE `items_extra_data` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `pc_attri_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(3,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `my_cart`
--

CREATE TABLE `my_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `store_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `my_cart`
--

INSERT INTO `my_cart` (`id`, `user_id`, `meta_key`, `content`, `store_type`) VALUES
(23, 3, 'wish_list', 'a:6:{s:2:\"m5\";a:2:{s:3:\"pid\";s:1:\"5\";s:8:\"add_date\";s:10:\"2022-05-02\";}s:2:\"m4\";a:2:{s:3:\"pid\";s:1:\"4\";s:8:\"add_date\";s:10:\"2022-05-02\";}s:2:\"m8\";a:2:{s:3:\"pid\";s:1:\"8\";s:8:\"add_date\";s:10:\"2022-05-06\";}s:3:\"m10\";a:2:{s:3:\"pid\";s:2:\"10\";s:8:\"add_date\";s:10:\"2022-05-23\";}s:6:\"mm9m13\";a:2:{s:3:\"pid\";s:5:\"m9m13\";s:8:\"add_date\";s:10:\"2022-06-16\";}s:7:\"mm15m13\";a:2:{s:3:\"pid\";s:6:\"m15m13\";s:8:\"add_date\";s:10:\"2022-06-16\";}}', ''),
(18, 4, 'wish_list', 'a:4:{s:2:\"m4\";a:2:{s:3:\"pid\";s:1:\"4\";s:8:\"add_date\";s:10:\"2022-04-16\";}s:6:\"mm5m13\";a:2:{s:3:\"pid\";s:5:\"m5m13\";s:8:\"add_date\";s:10:\"2022-05-03\";}s:3:\"m10\";a:2:{s:3:\"pid\";s:2:\"10\";s:8:\"add_date\";s:10:\"2022-06-29\";}s:2:\"m9\";a:2:{s:3:\"pid\";s:1:\"9\";s:8:\"add_date\";s:10:\"2022-06-29\";}}', ''),
(27, 16, 'cart', 'a:1:{s:5:\"m10m9\";a:5:{s:3:\"pid\";s:2:\"10\";s:3:\"qty\";i:10000;s:8:\"metadata\";N;s:7:\"comment\";s:0:\"\";s:4:\"unit\";s:1:\"9\";}}', ''),
(21, 10, 'wish_list', 'a:2:{s:2:\"m4\";a:2:{s:3:\"pid\";s:1:\"4\";s:8:\"add_date\";s:10:\"2022-04-21\";}s:2:\"m7\";a:2:{s:3:\"pid\";s:1:\"7\";s:8:\"add_date\";s:10:\"2022-04-22\";}}', ''),
(28, 4, 'compare', 'a:2:{s:2:\"m2\";a:1:{s:3:\"pid\";s:1:\"2\";}s:3:\"m15\";a:1:{s:3:\"pid\";s:2:\"15\";}}', ''),
(29, 3, 'compare', 'a:1:{s:3:\"m15\";a:1:{s:3:\"pid\";s:2:\"15\";}}', ''),
(38, 21, 'compare', 'b:0;', ''),
(39, 10, 'compare', 'a:2:{s:3:\"m10\";a:1:{s:3:\"pid\";s:2:\"10\";}s:2:\"m9\";a:1:{s:3:\"pid\";s:1:\"9\";}}', ''),
(40, 18, 'compare', 'a:1:{s:2:\"m9\";a:1:{s:3:\"pid\";s:1:\"9\";}}', ''),
(51, 22, 'compare', 'b:0;', ''),
(49, 16, 'compare', 'b:0;', ''),
(50, 4, 'cart', 'a:1:{s:5:\"m1m13\";a:5:{s:3:\"pid\";s:1:\"1\";s:3:\"qty\";s:1:\"1\";s:8:\"metadata\";N;s:7:\"comment\";s:0:\"\";s:4:\"unit\";s:2:\"13\";}}', '');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_date` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `created_date`, `status`) VALUES
(1, 'test@mailinator.com', '2022-04-18 07:20:18', 'active'),
(2, 'lkjkjknk@jnjk.jbh', '2022-04-18 07:29:36', 'active'),
(3, 'hjg@yg.iugyu', '2022-04-19 10:31:59', 'active'),
(4, 'ahmed@algeaidyest.com', '2022-04-23 09:44:50', 'active'),
(5, 'quamer313@gmail.com', '2022-04-30 10:14:41', 'active'),
(6, 'Test@g.com', '2022-05-03 06:57:08', 'active'),
(7, 'mm.alsaftty@gmail.com', '2022-05-18 12:46:04', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `order_invoice`
--

CREATE TABLE `order_invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_ref` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `order_no` int(11) NOT NULL,
  `item_ids` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `order_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seller_id` int(11) NOT NULL,
  `shipping_cost` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax` decimal(12,2) NOT NULL,
  `sub_total` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `net_total` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `commission` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `order_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `display_order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_show` tinyint(1) NOT NULL,
  `shipping_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_date_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_dub_date` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_invoice`
--

INSERT INTO `order_invoice` (`invoice_id`, `invoice_ref`, `order_no`, `item_ids`, `payment_status`, `payment_mode`, `order_comment`, `created_date`, `seller_id`, `shipping_cost`, `tax`, `sub_total`, `net_total`, `commission`, `order_status`, `display_order_id`, `is_show`, `shipping_id`, `shipping_date_time`, `shipping_dub_date`) VALUES
(1, '2022061620121', 1, '1,2', 'Pending', 'cash-on-del', '', '2022-06-16 21:40:58', 4, '2576', 69.30, '420.00', '3107.30', '42', 'Pending', '202206162010581', 1, NULL, NULL, ''),
(2, '202206171632', 2, '3', 'Pending', 'cash-on-del', '', '2022-06-17 17:34:50', 4, '1288', 33.00, '200.00', '1541.00', '20', 'Pending', '202206171604502', 1, NULL, NULL, ''),
(3, '2022062016453', 3, '4,5', 'Pending', 'cash-on-del', '', '2022-06-20 17:48:50', 4, '1288', 69.30, '420.00', '1819.30', '42', 'Pending', '202206201618503', 1, NULL, NULL, ''),
(4, '202206221664', 4, '6', 'Pending', 'cash-on-del', '', '2022-06-22 17:42:52', 4, '1288', 33.00, '200.00', '1541.00', '20', 'Pending', '202206221612524', 1, '44117285181', '28-06-2022 10:00', '28-06-2022 10:00'),
(5, '202206271775', 5, '7', 'Pending', 'cash-on-del', '', '2022-06-27 18:46:11', 4, '1288', 33.00, '200.00', '1541.00', '20', 'Pending', '202206271716115', 1, '44117285170', '28-06-2022 10:00', '28-06-2022 10:00'),
(6, '202206272386', 6, '8', 'Pending', 'cash-on-del', '', '2022-06-28 00:56:40', 4, '0', 33.00, '200.00', '253.00', '20', 'Pending', '202206272326406', 1, NULL, NULL, ''),
(7, '202206291997', 7, '9', 'Pending', 'cash-on-del', '', '2022-06-29 21:04:25', 14, '0', 457.50, '3000.00', '3507.50', '50', 'Pending', '202206291934257', 1, NULL, NULL, ''),
(8, '2022062919910118', 7, '10,11', 'Pending', 'cash-on-del', '', '2022-06-29 21:04:25', 8, '0', 0.66, '4.00', '5.06', '0.4', 'Pending', '202206291934257', 1, NULL, NULL, ''),
(9, '202206291991011129', 7, '12', 'Pending', 'cash-on-del', '', '2022-06-29 21:04:25', 4, '0', 33.00, '200.00', '253.00', '20', 'Pending', '202206291934257', 1, NULL, NULL, ''),
(10, '20220630131310', 8, '13', 'Pending', 'cash-on-del', '', '2022-06-30 14:30:48', 4, '0', 33.00, '200.00', '253.00', '20', 'Pending', '202206301300488', 1, NULL, NULL, ''),
(11, '2022063013141511', 9, '14,15', 'Pending', 'cash-on-del', '', '2022-06-30 15:23:38', 4, '3643.2', 69.30, '420.00', '4174.50', '42', 'Pending', '202206301353389', 1, '44117286021', '01-07-2022 10:00', '01-07-2022 10:00'),
(12, '2022063015161712', 10, '16,17', 'Pending', 'cash-on-del', '', '2022-06-30 17:23:28', 4, '3643.2', 69.30, '420.00', '4174.50', '42', 'Pending', '2022063015532810', 1, NULL, NULL, ''),
(13, '20220630171813', 12, '18', 'Pending', 'cash-on-del', '', '2022-06-30 19:29:04', 4, '3643.2', 36.30, '220.00', '3921.50', '22', 'Pending', '2022063017590412', 1, NULL, NULL, ''),
(14, '20220630181914', 13, '19', 'Pending', 'cash-on-del', '', '2022-06-30 19:32:54', 8, '0', 0.33, '2.00', '2.53', '0.2', 'Pending', '2022063018025413', 1, NULL, NULL, ''),
(15, '20220630182015', 14, '20', 'Pending', 'cash-on-del', '', '2022-06-30 19:33:16', 4, '0', 33.00, '200.00', '253.00', '20', 'Pending', '2022063018031614', 1, NULL, NULL, ''),
(16, '20220630182116', 15, '21', 'Pending', 'cash-on-del', '', '2022-06-30 19:33:39', 4, '0', 33.00, '200.00', '253.00', '20', 'Pending', '2022063018033915', 1, NULL, NULL, ''),
(17, '20220630192217', 16, '22', 'Pending', 'cash-on-del', '', '2022-06-30 20:42:06', 8, '0', 0.33, '2.00', '2.53', '0.2', 'Pending', '2022063019120616', 1, NULL, NULL, ''),
(18, '20220630192318', 17, '23', 'Pending', 'cash-on-del', '', '2022-06-30 20:42:31', 8, '0', 0.33, '2.00', '2.53', '0.2', 'Pending', '2022063019123117', 1, NULL, NULL, ''),
(19, '20220630192419', 18, '24', 'Pending', 'cash-on-del', '', '2022-06-30 20:43:26', 8, '0', 0.33, '2.00', '2.53', '0.2', 'Pending', '2022063019132618', 1, NULL, NULL, ''),
(20, '20220630192520', 19, '25', 'Pending', 'cash-on-del', '', '2022-06-30 20:43:40', 8, '0', 0.33, '2.00', '2.53', '0.2', 'Pending', '2022063019134019', 1, NULL, NULL, ''),
(21, '20220630202621', 20, '26', 'Pending', 'cash-on-del', '', '2022-06-30 21:56:22', 4, '0', 33.00, '200.00', '253.00', '20', 'Pending', '2022063020262220', 1, NULL, NULL, ''),
(22, '20220630202722', 21, '27', 'Pending', 'cash-on-del', '', '2022-06-30 21:56:40', 4, '0', 33.00, '200.00', '253.00', '20', 'Pending', '2022063020264021', 1, NULL, NULL, ''),
(23, '20220630202823', 22, '28', 'Pending', 'cash-on-del', '', '2022-06-30 21:59:58', 8, '0', 0.33, '2.00', '2.53', '0.2', 'Pending', '2022063020295822', 1, NULL, NULL, ''),
(24, '20220630202924', 23, '29', 'Pending', 'cash-on-del', '', '2022-06-30 22:00:13', 8, '0', 0.33, '2.00', '2.53', '0.2', 'Pending', '2022063020301323', 1, NULL, NULL, ''),
(25, '20220630203025', 24, '30', 'Pending', 'cash-on-del', '', '2022-06-30 22:03:18', 8, '0', 0.33, '2.00', '2.53', '0.2', 'Pending', '2022063020331824', 1, NULL, NULL, ''),
(26, '20220630213126', 25, '31', 'Pending', 'cash-on-del', '', '2022-06-30 23:16:54', 8, '0', 0.33, '2.00', '2.53', '0.2', 'Pending', '2022063021465425', 1, NULL, NULL, ''),
(27, '2022063021313227', 25, '32', 'Pending', 'cash-on-del', '', '2022-06-30 23:16:54', 4, '3643.2', 36.30, '220.00', '3921.50', '22', 'Pending', '2022063021465425', 1, NULL, NULL, ''),
(28, '20220630213328', 26, '33', 'Pending', 'cash-on-del', '', '2022-06-30 23:17:22', 8, '0', 0.33, '2.00', '2.53', '0.2', 'Pending', '2022063021472226', 1, NULL, NULL, ''),
(29, '20220630213429', 27, '34', 'Pending', 'cash-on-del', '', '2022-06-30 23:17:44', 4, '3643.2', 36.30, '220.00', '3921.50', '22', 'Pending', '2022063021474427', 1, NULL, NULL, ''),
(30, '20220630213530', 28, '35', 'Pending', 'cash-on-del', '', '2022-07-01 04:50:35', 4, '0', 33.00, '200.00', '253.00', '20', 'Pending', '2022063021503528', 1, NULL, NULL, ''),
(31, '20220630213631', 29, '36', 'Pending', 'cash-on-del', '', '2022-07-01 04:56:52', 4, '0', 24.75, '150.00', '189.75', '15', 'Pending', '2022063021565229', 1, NULL, NULL, ''),
(32, '20220630223732', 30, '37', 'Pending', 'cash-on-del', '', '2022-07-01 05:00:40', 4, '0', 49.50, '300.00', '379.50', '30', 'Pending', '2022063022004030', 1, NULL, NULL, ''),
(33, '20220726193833', 31, '38', 'Pending', 'cash-on-del', '', '2022-07-26 20:31:54', 8, '0', 0.33, '2.00', '2.53', '0.2', 'Pending', '2022072619015431', 1, NULL, NULL, ''),
(34, '20220726203934', 32, '39', 'Pending', 'cash-on-del', '', '2022-07-26 21:33:48', 8, '0', 0.33, '2.00', '2.53', '0.2', 'Pending', '2022072620034832', 1, NULL, NULL, ''),
(35, '2022072620394035', 32, '40', 'Pending', 'cash-on-del', '', '2022-07-26 21:33:48', 4, '0', 33.00, '200.00', '253.00', '20', 'Pending', '2022072620034832', 1, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_no` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `trans_ref` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL DEFAULT '0',
  `product_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_cost` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sub_total` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `commision` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `order_comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `delivery_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `attribute` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `id_size` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `is_delivery_available` int(11) NOT NULL COMMENT '1 means vendor provide delivery for that product 0 means not	',
  `shipping_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_no`, `trans_ref`, `user_id`, `product_id`, `seller_id`, `product_name`, `quantity`, `price`, `shipping_cost`, `sub_total`, `tax`, `commision`, `created_date`, `order_status`, `payment_status`, `payment_mode`, `order_comment`, `delivery_date`, `attribute`, `id_size`, `unit`, `is_delivery_available`, `shipping_id`) VALUES
(1, '1', '202206161', 3, 9, 4, 'Test product', 1, '200.00', '1288', '200.00', '33', '20', '2022-06-16 21:40:58', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-16 14:40:58', '', 0, 13, 0, NULL),
(2, '1', '202206162', 3, 5, 4, 'Test product 4', 1, '220.00', '1288', '220.00', '36.3', '22', '2022-06-16 21:40:58', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-16 14:40:58', '', 0, 13, 0, NULL),
(3, '2', '202206173', 3, 9, 4, 'Test product', 1, '200.00', '1288', '200.00', '33', '20', '2022-06-17 17:34:50', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-17 10:34:50', '', 0, 13, 0, NULL),
(4, '3', '202206204', 3, 9, 4, 'Test product', 1, '200.00', '1288', '200.00', '33', '20', '2022-06-20 17:48:50', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-20 10:48:50', '', 0, 13, 0, NULL),
(5, '3', '202206205', 3, 5, 4, 'Test product 4', 1, '220.00', '0', '220.00', '36.3', '22', '2022-06-20 17:48:50', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-20 10:48:50', '', 0, 13, 0, NULL),
(6, '4', '202206226', 3, 9, 4, 'Test product', 1, '200.00', '1288', '200.00', '33', '20', '2022-06-22 17:42:52', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-22 10:42:52', '', 0, 13, 0, '44117285181'),
(7, '5', '202206277', 3, 9, 4, 'Test product', 1, '200.00', '1288', '200.00', '33', '20', '2022-06-27 18:46:11', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-27 11:46:11', '', 0, 9, 0, '44117285170'),
(8, '6', '202206278', 3, 9, 4, 'Test product', 1, '200.00', '0', '200.00', '33', '20', '2022-06-28 00:56:40', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-27 17:56:40', '', 0, 13, 1, NULL),
(9, '7', '202206299', 4, 8, 14, 'تمر ', 20, '150.00', '0', '3000.00', '457.5', '50.00', '2022-06-29 21:04:25', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-29 14:04:25', '', 0, 13, 1, NULL),
(10, '7', '2022062910', 4, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-06-29 21:04:25', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-29 14:04:25', '', 0, 9, 1, NULL),
(11, '7', '2022062911', 4, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-06-29 21:04:25', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-29 14:04:25', '', 0, 13, 1, NULL),
(12, '7', '2022062912', 4, 9, 4, 'Test product', 1, '200.00', '0', '200.00', '33', '20', '2022-06-29 21:04:25', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-29 14:04:25', '', 0, 13, 1, NULL),
(13, '8', '2022063013', 10, 9, 4, 'Test product', 1, '200.00', '0', '200.00', '33', '20', '2022-06-30 14:30:48', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 07:30:48', '', 0, 9, 1, NULL),
(14, '9', '2022063014', 3, 5, 4, 'Test product 4', 1, '220.00', '3643.2', '220.00', '36.3', '22', '2022-06-30 15:23:38', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 08:23:38', '', 0, 13, 0, '44117286021'),
(15, '9', '2022063015', 3, 9, 4, 'Test product', 1, '200.00', '0', '200.00', '33', '20', '2022-06-30 15:23:38', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 08:23:38', '', 0, 13, 1, NULL),
(16, '10', '2022063016', 3, 5, 4, 'Test product 4', 1, '220.00', '3643.2', '220.00', '36.3', '22', '2022-06-30 17:23:28', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 10:23:28', '', 0, 13, 0, NULL),
(17, '10', '2022063017', 3, 9, 4, 'Test product', 1, '200.00', '0', '200.00', '33', '20', '2022-06-30 17:23:28', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 10:23:28', '', 0, 13, 1, NULL),
(18, '12', '2022063018', 3, 5, 4, 'Test product 4', 1, '220.00', '3643.2', '220.00', '36.3', '22', '2022-06-30 19:29:04', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 12:29:04', '', 0, 13, 0, NULL),
(19, '13', '2022063019', 3, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-06-30 19:32:54', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 12:32:54', '', 0, 9, 1, NULL),
(20, '14', '2022063020', 3, 9, 4, 'Test product', 1, '200.00', '0', '200.00', '33', '20', '2022-06-30 19:33:16', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 12:33:16', '', 0, 9, 1, NULL),
(21, '15', '2022063021', 3, 9, 4, 'Test product', 1, '200.00', '0', '200.00', '33', '20', '2022-06-30 19:33:39', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 12:33:39', '', 0, 0, 1, NULL),
(22, '16', '2022063022', 3, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-06-30 20:42:06', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 13:42:06', '', 0, 9, 1, NULL),
(23, '17', '2022063023', 3, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-06-30 20:42:31', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 13:42:31', '', 0, 0, 1, NULL),
(24, '18', '2022063024', 3, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-06-30 20:43:26', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 13:43:26', '', 0, 0, 1, NULL),
(25, '19', '2022063025', 3, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-06-30 20:43:40', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 13:43:40', '', 0, 9, 1, NULL),
(26, '20', '2022063026', 3, 9, 4, 'Test product', 1, '200.00', '0', '200.00', '33', '20', '2022-06-30 21:56:22', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 14:56:22', '', 0, 9, 1, NULL),
(27, '21', '2022063027', 3, 9, 4, 'Test product', 1, '200.00', '0', '200.00', '33', '20', '2022-06-30 21:56:40', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 14:56:40', '', 0, 0, 1, NULL),
(28, '22', '2022063028', 3, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-06-30 21:59:58', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 14:59:58', '', 0, 9, 1, NULL),
(29, '23', '2022063029', 3, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-06-30 22:00:13', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 15:00:13', '', 0, 0, 1, NULL),
(30, '24', '2022063030', 3, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-06-30 22:03:18', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 15:03:18', '', 0, 13, 1, NULL),
(31, '25', '2022063031', 3, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-06-30 23:16:54', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 16:16:54', '', 0, 13, 1, NULL),
(32, '25', '2022063032', 3, 5, 4, 'Test product 4', 1, '220.00', '3643.2', '220.00', '36.3', '22', '2022-06-30 23:16:54', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 16:16:54', '', 0, 13, 0, NULL),
(33, '26', '2022063033', 3, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-06-30 23:17:22', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 16:17:22', '', 0, 0, 1, NULL),
(34, '27', '2022063034', 3, 5, 4, 'Test product 4', 1, '220.00', '3643.2', '220.00', '36.3', '22', '2022-06-30 23:17:44', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 16:17:44', '', 0, 0, 0, NULL),
(35, '28', '2022063035', 3, 9, 4, 'Test product', 1, '200.00', '0', '200.00', '33', '20', '2022-07-01 04:50:35', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 21:50:35', '', 0, 10, 1, NULL),
(36, '29', '2022063036', 3, 9, 4, 'Test product', 1, '150.00', '0', '150.00', '24.75', '15', '2022-07-01 04:56:52', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 21:56:52', '', 0, 10, 1, NULL),
(37, '30', '2022063037', 3, 9, 4, 'Test product', 2, '150.00', '0', '300.00', '49.5', '30', '2022-07-01 05:00:40', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-06-30 22:00:40', '', 0, 12, 1, NULL),
(38, '31', '2022072638', 22, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-07-26 20:31:54', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-07-26 13:31:54', '', 0, 13, 1, NULL),
(39, '32', '2022072639', 22, 10, 8, 'Test', 1, '2.00', '0', '2.00', '0.33', '0.2', '2022-07-26 21:33:48', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-07-26 14:33:48', '', 0, 13, 1, NULL),
(40, '32', '2022072640', 22, 9, 4, 'Test product', 1, '200.00', '0', '200.00', '33', '20', '2022-07-26 21:33:48', 'Pending', 'Unpaid', 'cash-on-del', '', '2022-07-26 14:33:48', '', 0, 13, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `order_master_id` int(11) NOT NULL,
  `display_order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shipping_charge` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `sub_total` double NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT '0',
  `commission` double NOT NULL,
  `transfer_fees` decimal(12,2) NOT NULL,
  `bank_fees` decimal(12,2) NOT NULL,
  `net_total` double NOT NULL DEFAULT '0',
  `coupon_price` decimal(8,2) NOT NULL,
  `coupon_code` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `order_status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `payment_mode` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Paid',
  `payment_status` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_option` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mobile_no` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pincode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lng` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `is_show` tinyint(4) NOT NULL COMMENT '1 means yes 0 means no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`order_master_id`, `display_order_id`, `first_name`, `last_name`, `user_id`, `order_datetime`, `shipping_charge`, `sub_total`, `tax`, `commission`, `transfer_fees`, `bank_fees`, `net_total`, `coupon_price`, `coupon_code`, `order_status`, `payment_mode`, `payment_status`, `delivery_option`, `delivery_date`, `mobile_no`, `email`, `country`, `city`, `state`, `pincode`, `address_1`, `address_2`, `google_address`, `lat`, `lng`, `order_comment`, `source`, `currency`, `is_show`) VALUES
(1, '202206162010581', 'quameruddin', 'siddiqui', 3, '2022-06-16 21:40:58', '2576', 420, 69.3, 42, 0.00, 0.00, 3107.3, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-16 14:40:58', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', '', '', '', '', NULL, '', 'SAR', 1),
(2, '202206171604502', 'quameruddin', 'siddiqui', 3, '2022-06-17 17:34:50', '1288', 200, 33, 20, 0.00, 0.00, 1541, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-17 10:34:50', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(3, '202206201618503', 'quameruddin', 'siddiqui', 3, '2022-06-20 17:48:50', '1288', 420, 69.3, 42, 0.00, 0.00, 1819.3, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-20 10:48:50', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(4, '202206221612524', 'quameruddin', 'siddiqui', 3, '2022-06-22 17:42:52', '1288', 200, 33, 20, 0.00, 0.00, 1541, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-22 10:42:52', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(5, '202206271716115', 'quameruddin', 'siddiqui', 3, '2022-06-27 18:46:11', '1288', 200, 33, 20, 0.00, 0.00, 1541, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-27 11:46:11', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(6, '202206272326406', 'quameruddin', 'siddiqui', 3, '2022-06-28 00:56:40', '0', 200, 33, 20, 0.00, 0.00, 253, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-27 17:56:40', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(7, '202206291934257', 'shaikh', 's', 4, '2022-06-29 21:04:25', '0', 3204, 491.16, 70.4, 0.00, 0.00, 3765.56, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-29 14:04:25', '12345678', 'quamer313@gmail.com', 'Saudi Arabia', 'Qatif', 'Sakaka', '61321', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(8, '202206301300488', 'prishu', 'Nandal', 10, '2022-06-30 14:30:48', '0', 200, 33, 20, 0.00, 0.00, 253, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 07:30:48', 'phone', 'prishu@mailinator.com', 'Saudi Arabia', 'Abha', 'Abha', '26312', 'Building Num / Suite Num / Office Num Street name', NULL, '', '', '', NULL, '', 'SAR', 1),
(9, '202206301353389', 'quameruddin', 'siddiqui', 3, '2022-06-30 15:23:38', '3643.2', 420, 69.3, 42, 0.00, 0.00, 4174.5, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 08:23:38', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(10, '2022063015532810', 'quameruddin', 'siddiqui', 3, '2022-06-30 17:23:28', '3643.2', 420, 69.3, 42, 0.00, 0.00, 4174.5, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 10:23:28', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(12, '2022063017590412', 'quameruddin', 'siddiqui', 3, '2022-06-30 19:29:04', '3643.2', 220, 36.3, 22, 0.00, 0.00, 3921.5, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 12:29:04', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(13, '2022063018025413', 'quameruddin', 'siddiqui', 3, '2022-06-30 19:32:54', '0', 2, 0.33, 0.2, 0.00, 0.00, 2.53, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 12:32:54', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(14, '2022063018031614', 'quameruddin', 'siddiqui', 3, '2022-06-30 19:33:16', '0', 200, 33, 20, 0.00, 0.00, 253, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 12:33:16', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(15, '2022063018033915', 'quameruddin', 'siddiqui', 3, '2022-06-30 19:33:39', '0', 200, 33, 20, 0.00, 0.00, 253, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 12:33:39', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(16, '2022063019120616', 'quameruddin', 'siddiqui', 3, '2022-06-30 20:42:06', '0', 2, 0.33, 0.2, 0.00, 0.00, 2.53, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 13:42:06', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(17, '2022063019123117', 'quameruddin', 'siddiqui', 3, '2022-06-30 20:42:31', '0', 2, 0.33, 0.2, 0.00, 0.00, 2.53, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 13:42:31', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(18, '2022063019132618', 'quameruddin', 'siddiqui', 3, '2022-06-30 20:43:26', '0', 2, 0.33, 0.2, 0.00, 0.00, 2.53, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 13:43:26', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(19, '2022063019134019', 'quameruddin', 'siddiqui', 3, '2022-06-30 20:43:40', '0', 2, 0.33, 0.2, 0.00, 0.00, 2.53, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 13:43:40', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(20, '2022063020262220', 'quameruddin', 'siddiqui', 3, '2022-06-30 21:56:22', '0', 200, 33, 20, 0.00, 0.00, 253, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 14:56:22', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(21, '2022063020264021', 'quameruddin', 'siddiqui', 3, '2022-06-30 21:56:40', '0', 200, 33, 20, 0.00, 0.00, 253, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 14:56:40', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(22, '2022063020295822', 'quameruddin', 'siddiqui', 3, '2022-06-30 21:59:58', '0', 2, 0.33, 0.2, 0.00, 0.00, 2.53, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 14:59:58', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(23, '2022063020301323', 'quameruddin', 'siddiqui', 3, '2022-06-30 22:00:13', '0', 2, 0.33, 0.2, 0.00, 0.00, 2.53, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 15:00:13', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(24, '2022063020331824', 'quameruddin', 'siddiqui', 3, '2022-06-30 22:03:18', '0', 2, 0.33, 0.2, 0.00, 0.00, 2.53, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 15:03:18', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(25, '2022063021465425', 'quameruddin', 'siddiqui', 3, '2022-06-30 23:16:54', '3643.2', 222, 36.63, 22.2, 0.00, 0.00, 3924.03, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 16:16:54', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(26, '2022063021472226', 'quameruddin', 'siddiqui', 3, '2022-06-30 23:17:22', '0', 2, 0.33, 0.2, 0.00, 0.00, 2.53, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 16:17:22', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(27, '2022063021474427', 'quameruddin', 'siddiqui', 3, '2022-06-30 23:17:44', '3643.2', 220, 36.3, 22, 0.00, 0.00, 3921.5, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 16:17:44', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(28, '2022063021503528', 'quameruddin', 'siddiqui', 3, '2022-07-01 04:50:35', '0', 200, 33, 20, 0.00, 0.00, 253, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 21:50:35', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(29, '2022063021565229', 'quameruddin', 'siddiqui', 3, '2022-07-01 04:56:52', '0', 150, 24.75, 15, 0.00, 0.00, 189.75, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 21:56:52', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(30, '2022063022004030', 'quameruddin', 'siddiqui', 3, '2022-07-01 05:00:40', '0', 300, 49.5, 30, 0.00, 0.00, 379.5, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-06-30 22:00:40', '8482901476', 'quamer123@gmail.com', 'Saudi Arabia', 'Qatif', 'Riyadh', '75471', '456 test address', NULL, '', '', '', NULL, '', 'SAR', 1),
(31, '2022072619015431', 'irfan', 'quameruddin', 22, '2022-07-26 20:31:54', '0', 2, 0.33, 0.2, 0.00, 0.00, 2.53, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-07-26 13:31:54', '8482901478', 'quamer5588@gmail.com', 'Saudi Arabia', 'Abha', 'Al-Baha', '431401', 'test test', NULL, '', '', '', NULL, '', 'SAR', 1),
(32, '2022072620034832', 'irfan', 'quameruddin', 22, '2022-07-26 21:33:48', '0', 202, 33.33, 20.2, 0.00, 0.00, 255.53, 0.00, '', 'Pending', 'cash-on-del', 'Unpaid', '', '2022-07-26 14:33:48', '8482901478', 'quamer5588@gmail.com', 'Saudi Arabia', 'Abha', 'Al-Baha', '431401', 'test test', NULL, '', '', '', NULL, '', 'SAR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `editor` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `date_of_publish` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `status`, `editor`, `slug`, `created_date`, `date_of_publish`) VALUES
(1, 'Privacy Policy', 'active', '<p>This Privacy Policy describes how your personal information is collected, used, and shared when you visit or make a purchase from <a href=\"http://www.port10.sa\">www.port10.sa</a> (the &ldquo;Site&rdquo;).</p>\r\n\r\n<p><strong>PERSONAL INFORMATION WE COLLECT</strong></p>\r\n\r\n<p>When you visit the Site, we automatically collect certain information about your device, including information about your web browser, IP address, time zone, and some of the cookies that are installed on your device. Additionally, as you browse the Site, we collect information about the individual web pages or products that you view, what websites or search terms referred you to the Site, and information about how you interact with the Site. We refer to this automatically-collected information as &ldquo;Device Information.&rdquo;</p>\r\n\r\n<p><strong>We collect Device Information using the following technologies:</strong></p>\r\n\r\n<p>- &ldquo;Cookies&rdquo; are data files that are placed on your device or computer and often include an anonymous unique identifier. For more information about cookies, and how to disable cookies, visit&nbsp; <a href=\"http://www.allaboutcookies.org\" target=\"_blank\"> http://www.allaboutcookies.org </a></p>\r\n\r\n<p>- &ldquo;Log files&rdquo; track actions occurring on the Site, and collect data including your IP address, browser type, Internet service provider, referring/exit pages, and date/time stamps.</p>\r\n\r\n<p>- &ldquo;Web beacons,&rdquo; &ldquo;tags,&rdquo; and &ldquo;pixels&rdquo; are electronic files used to record information about how you browse the Site.</p>\r\n\r\n<p><br />\r\nAdditionally when you make a purchase or attempt to make a purchase through the Site, we collect certain information from you, including your name, billing address, shipping address, payment information (including credit card numbers, debit card numbers and bank transfer account numbers), email address, and phone number. &nbsp;We refer to this information as &ldquo;Order Information.&rdquo;</p>\r\n\r\n<p><br />\r\nWhen we talk about &ldquo;Personal Information&rdquo; in this Privacy Policy, we are talking both about Device Information and Order Information.</p>\r\n\r\n<p><strong>HOW DO WE USE YOUR PERSONAL INFORMATION?</strong></p>\r\n\r\n<p>We use the Order Information that we collect generally to fulfill any orders placed through the Site (including processing your payment information, arranging for shipping, and providing you with invoices and/or order confirmations). &nbsp;Additionally, we use this Order Information to:<br />\r\nCommunicate with you;<br />\r\nScreen our orders for potential risk or fraud; and<br />\r\nWhen in line with the preferences you have shared with us, provide you with information or advertising relating to our products or services.</p>\r\n\r\n<p>We use the Device Information that we collect to help us screen for potential risk and fraud (in particular, your IP address), and more generally to improve and optimize our Site (for example, by generating analytics about how our customers browse and interact with the Site, and to assess the success of our marketing and advertising campaigns).</p>\r\n\r\n<p><br />\r\nWe also use Google Analytics to help us understand how our customers use the Site--you can read more about how Google uses your Personal Information here: &nbsp; <a href=\"https://www.google.com/intl/en/policies/privacy/\" target=\"_blank\"> https://www.google.com/intl/en/policies/privacy/ </a> . &nbsp;</p>\r\n\r\n<p>Finally, we may also share your Personal Information to comply with applicable laws and regulations, to respond to a subpoena, search warrant or other lawful request for information we receive, or to otherwise protect our rights.</p>\r\n\r\n<p><br />\r\nAs described above, we use your Personal Information to provide you with targeted advertisements or marketing communications we believe may be of interest to you. &nbsp;For more information about how targeted advertising works, you can visit the Network Advertising Initiative&rsquo;s (&ldquo;NAI&rdquo;) educational page at <a href=\"https://www.networkadvertising.org/understanding-online-advertising/how-does-it-work\" target=\"_blank\"> http://www.networkadvertising.org/understanding-online-advertising/how-does-it-work. </a></p>\r\n\r\n<p><br />\r\n<strong>MINORS</strong><br />\r\nThe Site is not intended for individuals under the age of 18.</p>\r\n\r\n<p><strong>CHANGES</strong><br />\r\nWe may update this privacy policy from time to time in order to reflect, for example, changes to our practices or for other operational, legal or regulatory reasons.</p>\r\n\r\n<p><strong>CONTACT US</strong><br />\r\nFor more information about our privacy practices, if you have questions, or if you would like to make a complaint, please contact us by e-mail at hello@port10.sa or by mail using the details provided below:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Port10</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Granada Business Towers,&nbsp;<br />\r\nTower A4 &ndash; Unit 24<br />\r\nEastern Ring Road &ndash; Exit 8 &ndash; Al Rabwah District<br />\r\nRiyadh 12824 &ndash; 4748<br />\r\nKingdom of Saudi Arabia</p>\r\n', 'privacy-policy', '2021-01-20 11:55:28', ''),
(2, 'Terms Of Service', 'active', '<p>This website is operated by Port10. Throughout the site, the terms &ldquo;we&rdquo;, &ldquo;us&rdquo; and &ldquo;our&rdquo; refer to Port10. Port10 offers this website, including all information, tools and services available from this site to you, the user, conditioned upon your acceptance of all terms, conditions, policies and notices stated here.</p>\r\n\r\n<p>By visiting our site and/or purchasing something from our website, you engage in our &ldquo;Service&rdquo; and agree to be bound by the following terms and conditions (&ldquo;Terms of Service&rdquo;, &ldquo;Terms&rdquo;), including those additional terms and conditions and policies referenced herein and/or available by hyperlink. These Terms of Service apply to all users of the site, including without limitation users who are browsers, vendors, customers, merchants, and/ or contributors of content.</p>\r\n\r\n<p>Please read these Terms of Service carefully before accessing or using our website. By accessing or using any part of the site, you agree to be bound by these Terms of Service. If you do not agree to all the terms and conditions of this agreement, then you may not access the website or use any services. If these Terms of Service are considered an offer, acceptance is expressly limited to these Terms of Service.</p>\r\n\r\n<p>Any new features or tools which are added to the current store shall also be subject to the Terms of Service. You can review the most current version of the Terms of Service at any time on this page. We reserve the right to update, change or replace any part of these Terms of Service by posting updates and/or changes to our website. It is your responsibility to check this page periodically for changes. Your continued use of or access to the website following the posting of any changes constitutes acceptance of those changes.</p>\r\n\r\n<p><strong>SECTION 1 - ONLINE STORE TERMS</strong></p>\r\n\r\n<p>By agreeing to these Terms of Service, you represent that you are at least the age of majority in your state or country of residence.</p>\r\n\r\n<p>You may not use our products for any illegal or unauthorized purpose nor may you, in the use of the Service, violate any laws in your jurisdiction (including but not limited to copyright laws).</p>\r\n\r\n<p>You must not transmit any worms or viruses or any code of a destructive nature.</p>\r\n\r\n<p>A breach or violation of any of the Terms will result in an immediate termination of your Services.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 2 - GENERAL CONDITIONS</strong></p>\r\n\r\n<p>We reserve the right to refuse service to anyone for any reason at any time.</p>\r\n\r\n<p>You understand that your content (not including credit card information), may be transferred unencrypted and involve (a) transmissions over various networks; and (b) changes to conform and adapt to technical requirements of connecting networks or devices. Credit card information is always encrypted during transfer over networks.</p>\r\n\r\n<p>You agree not to reproduce, duplicate, copy, sell, resell or exploit any portion of the Service, use of the Service, or access to the Service or any contact on the website through which the service is provided, without express written permission by us.</p>\r\n\r\n<p>The headings used in this agreement are included for convenience only and will not limit or otherwise affect these Terms.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 3 - ACCURACY, COMPLETENESS AND TIMELINESS OF INFORMATION</strong></p>\r\n\r\n<p>We are not responsible if information made available on this site is not accurate, complete or current. The material on this site is provided for general information only and should not be relied upon or used as the sole basis for making decisions without consulting primary, more accurate, more complete or more timely sources of information. Any reliance on the material on this site is at your own risk.</p>\r\n\r\n<p>This site may contain certain historical information. Historical information, necessarily, is not current and is provided for your reference only. We reserve the right to modify the contents of this site at any time, but we have no obligation to update any information on our site. You agree that it is your responsibility to monitor changes to our site.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 4 - MODIFICATIONS TO THE SERVICE AND PRICES</strong></p>\r\n\r\n<p>Prices for our products are subject to change without notice.</p>\r\n\r\n<p>We reserve the right at any time to modify or discontinue the Service (or any part or content thereof) without notice at any time.</p>\r\n\r\n<p>We shall not be liable to you or to any third-party for any modification, price change, suspension or discontinuance of the Service.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 5 - PRODUCTS OR SERVICES (if applicable)</strong></p>\r\n\r\n<p>Certain products or services may be available exclusively online through the website. These products or services may have limited quantities and are subject to return or exchange only according to our Return Policy.</p>\r\n\r\n<p>We have made every effort to display as accurately as possible the colors and images of our products that appear at the store. We cannot guarantee that your computer monitor&#39;s display of any color will be accurate.</p>\r\n\r\n<p>We reserve the right, but are not obligated, to limit the sales of our products or Services to any person, geographic region or jurisdiction. We may exercise this right on a case-by-case basis. We reserve the right to limit the quantities of any products or services that we offer. All descriptions of products or product pricing are subject to change at anytime without notice, at the sole discretion of us. We reserve the right to discontinue any product at any time. Any offer for any product or service made on this site is void where prohibited.</p>\r\n\r\n<p>We do not warrant that the quality of any products, services, information, or other material purchased or obtained by you will meet your expectations, or that any errors in the Service will be corrected.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 6 - ACCURACY OF BILLING AND ACCOUNT INFORMATION</strong></p>\r\n\r\n<p>We reserve the right to refuse any order you place with us. We may, in our sole discretion, limit or cancel quantities purchased per person, per company or per order. These restrictions may include orders placed by or under the same customer account, the same credit card, debit card or bank account, and/or orders that use the same billing and/or shipping address. In the event that we make a change to or cancel an order, we may attempt to notify you by contacting the e-mail and/or billing address/phone number provided at the time the order was made. We reserve the right to limit or prohibit orders that, in our sole judgment, appear to be placed by dealers, resellers or distributors.</p>\r\n\r\n<p>You agree to provide current, complete and accurate purchase and account information for all purchases made at our store. You agree to promptly update your account and other information, including your email address credit card, debit card and bank account numbers and expiration dates, so that we can complete your transactions and contact you as needed.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 7 - OPTIONAL TOOLS</strong></p>\r\n\r\n<p>We may provide you with access to third-party tools over which we neither monitor nor have any control nor input.</p>\r\n\r\n<p>You acknowledge and agree that we provide access to such tools &rdquo;as is&rdquo; and &ldquo;as available&rdquo; without any warranties, representations or conditions of any kind and without any endorsement. We shall have no liability whatsoever arising from or relating to your use of optional third-party tools.</p>\r\n\r\n<p>Any use by you of optional tools offered through the site is entirely at your own risk and discretion and you should ensure that you are familiar with and approve of the terms on which tools are provided by the relevant third-party provider(s).</p>\r\n\r\n<p>We may also, in the future, offer new services and/or features through the website (including, the release of new tools and resources). Such new features and/or services shall also be subject to these Terms of Service.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 8 - THIRD-PARTY LINKS</strong></p>\r\n\r\n<p>Certain content, products and services available via our Service may include materials from third-parties.</p>\r\n\r\n<p>Third-party links on this site may direct you to third-party websites that are not affiliated with us. We are not responsible for examining or evaluating the content or accuracy and we do not warrant and will not have any liability or responsibility for any third-party materials or websites, or for any other materials, products, or services of third-parties.</p>\r\n\r\n<p>We are not liable for any harm or damages related to the purchase or use of goods, services, resources, content, or any other transactions made in connection with any third-party websites. Please review carefully the third-party&#39;s policies and practices and make sure you understand them before you engage in any transaction. Complaints, claims, concerns, or questions regarding third-party products should be directed to the third-party.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 9 - USER COMMENTS, FEEDBACK AND OTHER SUBMISSIONS</strong></p>\r\n\r\n<p>If, at our request, you send certain specific submissions (for example contest entries) or without a request from us you send creative ideas, suggestions, proposals, plans, or other materials, whether online, by email, by postal mail, or otherwise (collectively, &#39;comments&#39;), you agree that we may, at any time, without restriction, edit, copy, publish, distribute, translate and otherwise use in any medium any comments that you forward to us. We are and shall be under no obligation (1) to maintain any comments in confidence; (2) to pay compensation for any comments; or (3) to respond to any comments.</p>\r\n\r\n<p>We may, but have no obligation to, monitor, edit or remove content that we determine in our sole discretion are unlawful, offensive, threatening, libelous, defamatory, pornographic, obscene or otherwise objectionable or violates any party&rsquo;s intellectual property or these Terms of Service.</p>\r\n\r\n<p>You agree that your comments will not violate any right of any third-party, including copyright, trademark, privacy, personality or other personal or proprietary right. You further agree that your comments will not contain libelous or otherwise unlawful, abusive or obscene material, or contain any computer virus or other malware that could in any way affect the operation of the Service or any related website. You may not use a false e-mail address, pretend to be someone other than yourself, or otherwise mislead us or third-parties as to the origin of any comments. You are solely responsible for any comments you make and their accuracy. We take no responsibility and assume no liability for any comments posted by you or any third-party.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 10 - PERSONAL INFORMATION</strong></p>\r\n\r\n<p>Your submission of personal information through the store is governed by our Privacy Policy. To view our Privacy Policy.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 11 - ERRORS, INACCURACIES AND OMISSIONS</strong></p>\r\n\r\n<p>Occasionally there may be information on our site or in the Service that contains typographical errors, inaccuracies or omissions that may relate to product descriptions, pricing, promotions, offers, product shipping charges, transit times and availability. We reserve the right to correct any errors, inaccuracies or omissions, and to change or update information or cancel orders if any information in the Service or on any related website is inaccurate at any time without prior notice (including after you have submitted your order).</p>\r\n\r\n<p>We undertake no obligation to update, amend or clarify information in the Service or on any related website, including without limitation, pricing information, except as required by law. No specified update or refresh date applied in the Service or on any related website, should be taken to indicate that all information in the Service or on any related website has been modified or updated.</p>\r\n\r\n<p><strong>SECTION 12 - PROHIBITED USES</strong></p>\r\n\r\n<p>In addition to other prohibitions as set forth in the Terms of Service, you are prohibited from using the site or its content: (a) for any unlawful purpose; (b) to solicit others to perform or participate in any unlawful acts; (c) to violate any international, &nbsp;or Saudi Arabian regulations, rules, laws, or local ordinances; (d) to infringe upon or violate our intellectual property rights or the intellectual property rights of others; (e) to harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate based on gender, religion, ethnicity, race, age, national origin, or disability; (f) to submit false or misleading information; (g) to upload or transmit viruses or any other type of malicious code that will or may be used in any way that will affect the functionality or operation of the Service or of any related website, other websites, or the Internet; (h) to collect or track the personal information of others; (i) to spam, phish, pharm, pretext, spider, crawl, or scrape; (j) for any obscene or immoral purpose; or (k) to interfere with or circumvent the security features of the Service or any related website, other websites, or the Internet. We reserve the right to terminate your use of the Service or any related website for violating any of the prohibited uses.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 13 - DISCLAIMER OF WARRANTIES; LIMITATION OF LIABILITY</strong></p>\r\n\r\n<p>We do not guarantee, represent or warrant that your use of our service will be uninterrupted, timely, secure or error-free.</p>\r\n\r\n<p>We do not warrant that the results that may be obtained from the use of the service will be accurate or reliable.</p>\r\n\r\n<p>You agree that from time to time we may remove the service for indefinite periods of time or cancel the service at any time, without notice to you.</p>\r\n\r\n<p>You expressly agree that your use of, or inability to use, the service is at your sole risk. The service and all products and services delivered to you through the service are (except as expressly stated by us) provided &#39;as is&#39; and &#39;as available&#39; for your use, without any representation, warranties or conditions of any kind, either express or implied, including all implied warranties or conditions of merchantability, merchantable quality, fitness for a particular purpose, durability, title, and non-infringement.</p>\r\n\r\n<p>In no case shall Port10, our directors, officers, employees, affiliates, agents, contractors, interns, suppliers, service providers or licensors be liable for any injury, loss, claim, or any direct, indirect, incidental, punitive, special, or consequential damages of any kind, including, without limitation lost profits, lost revenue, lost savings, loss of data, replacement costs, or any similar damages, whether based in contract, tort (including negligence), strict liability or otherwise, arising from your use of any of the service or any products procured using the service, or for any other claim related in any way to your use of the service or any product, including, but not limited to, any errors or omissions in any content, or any loss or damage of any kind incurred as a result of the use of the service or any content (or product) posted, transmitted, or otherwise made available via the service, even if advised of their possibility. Because some states or jurisdictions do not allow the exclusion or the limitation of liability for consequential or incidental damages, in such states or jurisdictions, our liability shall be limited to the maximum extent permitted by law.</p>\r\n\r\n<p><strong>SECTION 14 - INDEMNIFICATION</strong></p>\r\n\r\n<p>You agree to indemnify, defend and hold harmless Port10 and our parent, subsidiaries, affiliates, partners, officers, directors, agents, contractors, licensors, service providers, subcontractors, suppliers, interns and employees, harmless from any claim or demand, including reasonable attorneys&rsquo; fees, made by any third-party due to or arising out of your breach of these Terms of Service or the documents they incorporate by reference, or your violation of any law or the rights of a third-party.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 15 - SEVERABILITY</strong></p>\r\n\r\n<p>In the event that any provision of these Terms of Service is determined to be unlawful, void or unenforceable, such provision shall nonetheless be enforceable to the fullest extent permitted by applicable law in the Kingdom of Saudi Arabia, and the unenforceable portion shall be deemed to be severed from these Terms of Service, such determination shall not affect the validity and enforceability of any other remaining provisions.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 16 - TERMINATION</strong></p>\r\n\r\n<p>The obligations and liabilities of the parties incurred prior to the termination date shall survive the termination of this agreement for all purposes.</p>\r\n\r\n<p>These Terms of Service are effective unless and until terminated by either you or us. You may terminate these Terms of Service at any time by notifying us that you no longer wish to use our Services, or when you cease using our site.</p>\r\n\r\n<p>If in our sole judgment you fail, or we suspect that you have failed, to comply with any term or provision of these Terms of Service, we also may terminate this agreement at any time without notice and you will remain liable for all amounts due up to and including the date of termination; and/or accordingly may deny you access to our Services (or any part thereof).</p>\r\n\r\n<p><br />\r\n<strong>SECTION 17 - ENTIRE AGREEMENT</strong></p>\r\n\r\n<p>The failure of us to exercise or enforce any right or provision of these Terms of Service shall not constitute a waiver of such right or provision.</p>\r\n\r\n<p>These Terms of Service and any policies or operating rules posted by us on this site or in respect to The Service constitutes the entire agreement and understanding between you and us and govern your use of the Service, superseding any prior or contemporaneous agreements, communications and proposals, whether oral or written, between you and us (including, but not limited to, any prior versions of the Terms of Service).</p>\r\n\r\n<p>Any ambiguities in the interpretation of these Terms of Service shall not be construed against the drafting party.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 18 - GOVERNING LAW</strong></p>\r\n\r\n<p>These Terms of Service and any separate agreements whereby we provide you Services shall be governed by and construed in accordance with the laws of the&nbsp;<br />\r\nKingdom of Saudi Arabia.&nbsp;</p>\r\n\r\n<p><strong>SECTION 19 - CHANGES TO TERMS OF SERVICE</strong></p>\r\n\r\n<p>You can review the most current version of the Terms of Service at any time at this page.</p>\r\n\r\n<p>We reserve the right, at our sole discretion, to update, change or replace any part of these Terms of Service by posting updates and changes to our website. It is your responsibility to check our website periodically for changes. Your continued use of or access to our website or the Service following the posting of any changes to these Terms of Service constitutes acceptance of those changes.</p>\r\n\r\n<p><br />\r\n<strong>SECTION 20 - CONTACT INFORMATION</strong></p>\r\n\r\n<p>Questions about the Terms of Service should be sent to us at <a href=\"mailto:hello@port10.sa\" target=\"_blank\">hello@port10.sa</a>&nbsp;or by mail using the details provided below:</p>\r\n\r\n<p>Port10</p>\r\n\r\n<p>Granada Business Towers,&nbsp;<br />\r\nTower A4 &ndash; Unit 24<br />\r\nEastern Ring Road &ndash; Exit 8 &ndash; Al Rabwah District<br />\r\nRiyadh 12824 &ndash; 4748<br />\r\n&lsquo;&rsquo;Kingdom of Saudi Arabia&rsquo;&rsquo;</p>\r\n', 'terms-of-service', '2021-01-20 11:55:28', ''),
(3, 'About Us', 'active', '<p>At Port10, we aim at digitize and simplify commerce.</p>\r\n\r\n<p>Port10 is an ecommerce marketplace for businesses to buy and sell all kinds of products with ease and security.</p>\r\n\r\n<p>Our vision is to provide a platform with all the essential components that help businesses operate.</p>\r\n\r\n<p><br />\r\nContact Us<br />\r\nLooking to get in touch?&nbsp;<br />\r\nWe can be reached through one of the following channels.&nbsp;<br />\r\nE: <a href=\"mailto:hello@port10.sa\">hello@port10.sa</a>&nbsp;<br />\r\nT:<a href=\"tel:+966-11 440 1046\">+966-11 440 1046</a></p>\r\n', 'about', '2021-01-20 11:55:28', '02-04-2021');

-- --------------------------------------------------------

--
-- Table structure for table `pages_trans`
--

CREATE TABLE `pages_trans` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `editor` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `date_of_publish` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages_trans`
--

INSERT INTO `pages_trans` (`id`, `title`, `status`, `editor`, `slug`, `created_date`, `date_of_publish`) VALUES
(1, 'سياسة الخصوصية', 'active', '<p> تصف سياسة الخصوصية هذه كيفية جمع معلوماتك الشخصية واستخدامها ومشاركتها عند زيارة أو إجراء عملية شراء من www.port10.net (\"الموقع\"). </ p>\r\n\r\n<p> المعلومات الشخصية التي نجمعها </ p>\r\n\r\n<p> عندما تزور الموقع ، نقوم تلقائيًا بجمع معلومات معينة حول جهازك ، بما في ذلك معلومات حول متصفح الويب وعنوان IP والمنطقة الزمنية وبعض ملفات تعريف الارتباط المثبتة على جهازك. بالإضافة إلى ذلك ، أثناء تصفحك للموقع ، نقوم بجمع معلومات حول صفحات الويب الفردية أو المنتجات التي تشاهدها ، ومواقع الويب أو مصطلحات البحث التي أحالتك إلى الموقع ، ومعلومات حول كيفية تفاعلك مع الموقع. نشير إلى هذه المعلومات التي تم جمعها تلقائيًا باسم \"معلومات الجهاز\". </ p>\r\n\r\n<p> نجمع معلومات الجهاز باستخدام التقنيات التالية: </ p>\r\n\r\n<p> - \"ملفات تعريف الارتباط\" هي ملفات بيانات يتم وضعها على جهازك أو جهاز الكمبيوتر الخاص بك وغالبًا ما تتضمن معرفًا فريدًا مجهول الهوية. لمزيد من المعلومات حول ملفات تعريف الارتباط وكيفية تعطيل ملفات تعريف الارتباط ، تفضل بزيارة http://www.allaboutcookies.org. <br />\r\n- إجراءات تتبع \"ملفات السجل\" التي تحدث على الموقع ، وجمع البيانات بما في ذلك عنوان IP الخاص بك ، ونوع المتصفح ، ومزود خدمة الإنترنت ، وصفحات الإحالة / الخروج ، وطوابع التاريخ / الوقت. <br />\r\n- \"إشارات الويب\" و \"العلامات\" و \"وحدات البكسل\" هي ملفات إلكترونية تُستخدم لتسجيل المعلومات حول كيفية تصفحك للموقع. </ p>\r\n\r\n<p> <br />\r\nبالإضافة إلى ذلك ، عند إجراء عملية شراء أو محاولة إجراء عملية شراء عبر الموقع ، فإننا نجمع معلومات معينة منك ، بما في ذلك اسمك وعنوان الفواتير وعنوان الشحن ومعلومات الدفع (بما في ذلك أرقام بطاقات الائتمان وأرقام بطاقات الخصم وأرقام حسابات التحويل المصرفي) وعنوان البريد الإلكتروني ورقم الهاتف. نشير إلى هذه المعلومات باسم \"معلومات الطلب\". </ p>\r\n\r\n<p> <br />\r\nعندما نتحدث عن \"المعلومات الشخصية\" في سياسة الخصوصية هذه ، فإننا نتحدث عن معلومات الجهاز ومعلومات الطلب. </ p>\r\n\r\n<p> كيف نستخدم معلوماتك الشخصية؟ </ p>\r\n\r\n<p> نستخدم معلومات الطلب التي نجمعها بشكل عام للوفاء بأي طلبات يتم تقديمها عبر الموقع (بما في ذلك معالجة معلومات الدفع الخاصة بك ، وترتيب الشحن ، وتزويدك بالفواتير و / أو تأكيدات الطلبات). بالإضافة إلى ذلك ، نستخدم معلومات الطلب هذه من أجل: <br />\r\nالتواصل معك ؛ <br />\r\nفحص طلباتنا بحثًا عن مخاطر محتملة أو احتيال ؛ و <br />\r\nعندما يتماشى مع التفضيلات التي شاركتها معنا ، قم بتزويدك بالمعلومات أو الإعلانات المتعلقة بمنتجاتنا أو خدماتنا. </ p>\r\n\r\n<p> نستخدم معلومات الجهاز التي نجمعها لمساعدتنا في فحص المخاطر المحتملة والاحتيال (على وجه الخصوص ، عنوان IP الخاص بك) ، وبشكل عام لتحسين موقعنا وتحسينه (على سبيل المثال ، من خلال إنشاء تحليلات حول كيفية تصفح عملائنا والتفاعل مع الموقع وتقييم نجاح حملاتنا التسويقية والإعلانية). </ p>\r\n\r\n<p> <br />\r\nنستخدم أيضًا Google Analytics لمساعدتنا على فهم كيفية استخدام عملائنا للموقع - يمكنك قراءة المزيد حول كيفية استخدام Google لمعلوماتك الشخصية هنا: https://www.google.com/intl/ar/policies/privacy/. </p>\r\n\r\n<p> أخيرًا ، قد نشارك أيضًا معلوماتك الشخصية للامتثال للقوانين واللوائح المعمول بها ، للرد على أمر استدعاء أو أمر تفتيش أو أي طلب قانوني آخر للحصول على معلومات نتلقاها ، أو لحماية حقوقنا بطريقة أخرى. </ p>\r\n\r\n<p> <br />\r\nكما هو موضح أعلاه ، نستخدم معلوماتك الشخصية لتزويدك بالإعلانات المستهدفة أو الاتصالات التسويقية التي نعتقد أنها قد تهمك. لمزيد من المعلومات حول كيفية عمل الإعلانات المستهدفة ، يمكنك زيارة الصفحة التعليمية لمبادرة إعلانات الشبكة (\"NAI\") على http://www.networkadvertising.org/understanding-online-advertising/how-does-it-work.</ ص>\r\n\r\n<p> <br />\r\nالقاصرون <br />\r\nالموقع غير مخصص للأفراد الذين تقل أعمارهم عن 18 عامًا. </ p>\r\n\r\n<p> التغييرات <br />\r\nقد نقوم بتحديث سياسة الخصوصية هذه من وقت لآخر من أجل عكس ، على سبيل المثال ، التغييرات التي تطرأ على ممارساتنا أو لأسباب تشغيلية أو قانونية أو تنظيمية أخرى. </ p>\r\n\r\n<p> اتصل بنا <br />\r\nلمزيد من المعلومات حول ممارسات الخصوصية لدينا ، إذا كانت لديك أسئلة ، أو إذا كنت ترغب في تقديم شكوى ، فيرجى الاتصال بنا عبر البريد الإلكتروني على help@port10.net أو عن طريق البريد باستخدام التفاصيل الواردة أدناه: </ p>\r\n\r\n<p> المنفذ 10 </p>\r\n\r\n<p> طريق الأمير أحمد بن عبد العزيز <br />\r\nحي لبن - 2330 <br />\r\nالرياض 12923 <br />\r\nرقم المبنى - 2330 <br />\r\nرقم المكتب - 9 <br />\r\nالمملكة العربية السعودية </ p>', 'privacy-policy', '2021-01-20 11:55:28', ''),
(2, 'شروط الخدمة', 'active', '<p> يتم تشغيل هذا الموقع بواسطة Port10. في جميع أنحاء الموقع ، تشير المصطلحات \"نحن\" و \"نحن\" و \"خاصتنا\" إلى Port10. يقدم Port10 هذا الموقع ، بما في ذلك جميع المعلومات والأدوات والخدمات المتاحة من هذا الموقع لك ، للمستخدم ، بشرط موافقتك على جميع الشروط والأحكام والسياسات والإشعارات المذكورة هنا. </ p>\r\n\r\n<p> من خلال زيارة موقعنا و / أو شراء شيء من موقعنا ، فإنك تشارك في \"الخدمة\" الخاصة بنا وتوافق على الالتزام بالشروط والأحكام التالية (\"شروط الخدمة\" ، \"الشروط\") ، بما في ذلك تلك الشروط الإضافية والشروط والسياسات المشار إليها هنا و / أو المتاحة عن طريق الارتباط التشعبي. تنطبق شروط الخدمة هذه على جميع مستخدمي الموقع ، بما في ذلك على سبيل المثال لا الحصر المستخدمين من المتصفحات و / أو البائعين و / أو العملاء و / أو التجار و / أو المساهمين في المحتوى. </ p>\r\n\r\n<p> يرجى قراءة شروط الخدمة هذه بعناية قبل الوصول إلى موقعنا الإلكتروني أو استخدامه. من خلال الوصول إلى أو استخدام أي جزء من الموقع ، فإنك توافق على الالتزام بشروط الخدمة هذه. إذا كنت لا توافق على جميع شروط وأحكام هذه الاتفاقية ، فلا يجوز لك الوصول إلى موقع الويب أو استخدام أي خدمات. إذا كانت شروط الخدمة هذه بمثابة عرض ، فإن القبول يقتصر صراحةً على شروط الخدمة هذه. </ p>\r\n\r\n<p> تخضع أيضًا أي ميزات أو أدوات جديدة تضاف إلى المتجر الحالي لشروط الخدمة. يمكنك مراجعة أحدث إصدار من شروط الخدمة في أي وقت على هذه الصفحة. نحتفظ بالحق في تحديث أو تغيير أو استبدال أي جزء من شروط الخدمة هذه عن طريق نشر التحديثات و / أو التغييرات على موقعنا. تقع على عاتقك مسؤولية مراجعة هذه الصفحة بشكل دوري لمعرفة التغييرات. استمرار استخدامك أو الوصول إلى موقع الويب بعد نشر أي تغييرات يشكل قبولًا لهذه التغييرات. </ p>\r\n<p> القسم 1 - شروط المتجر عبر الإنترنت </ p>\r\n\r\n<p> بالموافقة على شروط الخدمة هذه ، فإنك تقر بأنك على الأقل تبلغ سن الرشد في ولايتك أو بلد إقامتك. </ p>\r\n\r\n<p> لا يجوز لك استخدام منتجاتنا لأي غرض غير قانوني أو غير مصرح به ولا يجوز لك ، في استخدام الخدمة ، انتهاك أي قوانين في نطاق سلطتك (بما في ذلك على سبيل المثال لا الحصر قوانين حقوق النشر). </ p>\r\n\r\n<p> يحظر عليك نقل أي فيروسات أو فيروسات متنقلة أو أي رمز ذي طبيعة مدمرة. </ p>\r\n\r\n<p> سيؤدي خرق أو انتهاك أي من البنود إلى الإنهاء الفوري لخدماتك. </ p>\r\n\r\n<p> <br />\r\nالقسم 2 - الشروط العامة </ p>\r\n\r\n<p> نحتفظ بالحق في رفض الخدمة لأي شخص لأي سبب وفي أي وقت. </ p>\r\n\r\n<p> أنت تدرك أن المحتوى الخاص بك (لا يشمل معلومات بطاقة الائتمان) ، قد يتم نقله بدون تشفير ويتضمن (أ) عمليات نقل عبر شبكات مختلفة ؛ و (ب) التغييرات للتوافق والتكيف مع المتطلبات الفنية لتوصيل الشبكات أو الأجهزة. يتم دائمًا تشفير معلومات بطاقة الائتمان أثناء النقل عبر الشبكات. </ p>\r\n\r\n<p> أنت توافق على عدم إعادة إنتاج أو تكرار أو نسخ أو بيع أو إعادة بيع أو استغلال أي جزء من الخدمة أو استخدام الخدمة أو الوصول إلى الخدمة أو أي جهة اتصال على موقع الويب التي يتم تقديم الخدمة من خلالها ، دون كتابة صريحة إذن منا. </ p>\r\n\r\n<p> تم تضمين العناوين المستخدمة في هذه الاتفاقية للتسهيل فقط ولن تقيد هذه الشروط أو تؤثر عليها. </ p>\r\n\r\n<p> <br />\r\nالقسم 3 - دقة المعلومات واكتمالها وحداثتها </ p>\r\n\r\n<p> لا نتحمل المسؤولية إذا كانت المعلومات المتوفرة على هذا الموقع غير دقيقة أو كاملة أو حديثة. يتم توفير المواد الموجودة على هذا الموقع للحصول على معلومات عامة فقط ولا ينبغي الاعتماد عليها أو استخدامها كأساس وحيد لاتخاذ القرارات دون استشارة مصادر المعلومات الأولية أو الأكثر دقة أو الأكثر اكتمالًا أو في الوقت المناسب. أي اعتماد على المواد الموجودة على هذا الموقع يكون على مسؤوليتك الخاصة. </ p>\r\n\r\n<p> قد يحتوي هذا الموقع على معلومات تاريخية معينة. المعلومات التاريخية ، بالضرورة ، ليست حديثة ويتم توفيرها للرجوع إليها فقط. نحتفظ بالحق في تعديل محتويات هذا الموقع في أي وقت ، لكننا لسنا ملزمين بتحديث أي معلومات على موقعنا. أنت توافق على أنه من مسؤوليتك مراقبة التغييرات على موقعنا. </ p>\r\n\r\n<p> <br />\r\n\r\nالقسم 4 - تعديلات على الخدمة والأسعار </ p>\r\n\r\n<p> تخضع أسعار منتجاتنا للتغيير دون إشعار. </ p>\r\n\r\n<p> نحتفظ بالحق في أي وقت في تعديل أو إيقاف الخدمة (أو أي جزء أو محتوى منها) دون إشعار في أي وقت. </ p>\r\n\r\n<p> لن نكون مسؤولين تجاهك أو تجاه أي طرف ثالث عن أي تعديل أو تغيير في الأسعار أو تعليق أو وقف للخدمة. </ p>\r\n\r\n<p> <br />\r\nالقسم 5 - المنتجات أو الخدمات (إن وجدت) </ p>\r\n\r\n<p> قد تكون بعض المنتجات أو الخدمات متاحة حصريًا عبر الإنترنت من خلال موقع الويب. قد يكون لهذه المنتجات أو الخدمات كميات محدودة وتخضع للإرجاع أو الاستبدال فقط وفقًا لسياسة الإرجاع الخاصة بنا. </ p>\r\n\r\n<p> لقد بذلنا قصارى جهدنا لعرض ألوان وصور منتجاتنا التي تظهر في المتجر بأكبر قدر ممكن من الدقة. لا يمكننا ضمان دقة عرض شاشة الكمبيوتر لأي لون. </ p>\r\n\r\n<p> نحتفظ بالحق ، ولكننا لسنا ملزمين ، في تقييد مبيعات منتجاتنا أو خدماتنا لأي شخص أو منطقة جغرافية أو سلطة قضائية. يجوز لنا ممارسة هذا الحق على أساس كل حالة على حدة. نحتفظ بالحق في تحديد كميات أي منتجات أو خدمات نقدمها. تخضع جميع أوصاف المنتجات أو أسعار المنتجات للتغيير في أي وقت دون إشعار ، وفقًا لتقديرنا الخاص. نحتفظ بالحق في إيقاف أي منتج في أي وقت. يعد أي عرض لأي منتج أو خدمة يتم تقديمه على هذا الموقع باطلاً إذا كان محظورًا. </ p>\r\n\r\n<p> لا نضمن أن جودة أي منتجات أو خدمات أو معلومات أو مواد أخرى تم شراؤها أو الحصول عليها بواسطتك ستلبي توقعاتك ، أو أنه سيتم تصحيح أي أخطاء في الخدمة. </ p>\r\n\r\n<p> <br />\r\n\r\nالقسم 6 - دقة الفواتير ومعلومات الحساب </ p>\r\n\r\n<p> نحتفظ بالحق في رفض أي طلب تضعه معنا. يجوز لنا ، وفقًا لتقديرنا الخاص ، تقييد أو إلغاء الكميات المشتراة لكل شخص أو لكل شركة أو لكل طلب. قد تشمل هذه القيود الطلبات المقدمة من قبل أو تحته نفس حساب العميل ، و / أو نفس بطاقة الائتمان ، أو بطاقة الخصم أو الحساب المصرفي ، و / أو الطلبات التي تستخدم نفس عنوان الفوترة و / أو الشحن. في حالة قيامنا بإجراء تغيير أو إلغاء طلب ، فقد نحاول إخطارك عن طريق الاتصال بالبريد الإلكتروني و / أو عنوان إرسال الفواتير / رقم الهاتف المقدم في وقت تقديم الطلب. نحتفظ بالحق في تقييد أو حظر الطلبات التي ، في حكمنا الوحيد ، يبدو أنها مقدمة من التجار أو البائعين أو الموزعين. </ p>\r\n\r\n<p> أنت توافق على تقديم معلومات الشراء والحساب الحالية والكاملة والدقيقة لجميع عمليات الشراء التي تتم في متجرنا. أنت توافق على تحديث حسابك والمعلومات الأخرى على الفور ، بما في ذلك عنوان بريدك الإلكتروني ، بطاقة الائتمان وبطاقة الخصم وأرقام الحساب المصرفي وتواريخ انتهاء الصلاحية ، حتى نتمكن من إكمال معاملاتك والاتصال بك حسب الحاجة. </ p>\r\n\r\n<p> <br />\r\nالقسم 7 - الأدوات الاختيارية </ p>\r\n\r\n<p> قد نوفر لك إمكانية الوصول إلى أدوات الجهات الخارجية التي لا نراقبها ولا نملك أي تحكم أو إدخال. </ p>\r\n\r\n<p> أنت تقر وتوافق على أننا نوفر الوصول إلى هذه الأدوات \"كما هي\" و \"كما هي متوفرة\" دون أي ضمانات أو إقرارات أو شروط من أي نوع ودون أي مصادقة. لن نتحمل أي مسؤولية من أي نوع تنشأ عن أو تتعلق باستخدامك لأدوات خارجية اختيارية. </ p>\r\n\r\n<p> إن أي استخدام من جانبك للأدوات الاختيارية المقدمة من خلال الموقع يكون على مسؤوليتك الخاصة ووفقًا لتقديرك تمامًا ، ويجب عليك التأكد من أنك على دراية بالمصطلحات التي يتم توفير الأدوات من خلالها والموافقة عليها من قِبل موفر (موفري الجهات الخارجية) ذي الصلة ). </p>\r\n\r\n<p> قد نقدم أيضًا ، في المستقبل ، خدمات و / أو ميزات جديدة من خلال موقع الويب (بما في ذلك ، إصدار أدوات وموارد جديدة). تخضع هذه الميزات و / أو الخدمات الجديدة أيضًا لشروط الخدمة هذه. </ p>\r\n\r\n<p> <br /> ', 'terms-of-service', '2021-01-20 11:55:28', ''),
(3, 'معلومات عنا', 'active', '<p> في Port10 ، نهدف إلى رقمنة التجارة وتبسيطها. </ p>\r\n\r\n<p> يعد Port10 سوقًا للتجارة الإلكترونية للشركات لشراء وبيع جميع أنواع المنتجات بسهولة وأمان. </ p>\r\n\r\n<p> تتمثل رؤيتنا في توفير نظام أساسي به جميع المكونات الأساسية التي تساعد الشركات على العمل. </ p>\r\n\r\n<p> <br />\r\nاتصل بنا <br />\r\nتبحث للحصول على اتصال؟ <br />\r\nيمكن الوصول إلينا من خلال إحدى القنوات التالية. <br />\r\nالبريد الإلكتروني: connect@port10.net <br />\r\nهاتف: + 966-11440 1046 </p> ', 'about', '2021-01-20 11:55:28', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment_code_msg`
--

CREATE TABLE `payment_code_msg` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `message` varchar(255) NOT NULL,
  `card_type` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_code_msg`
--

INSERT INTO `payment_code_msg` (`id`, `code`, `message`, `card_type`) VALUES
(1, '01', 'Honour with identification', 'mada'),
(2, '02', 'Approved for partial amount', 'mada'),
(3, '03', 'Approved (VIP)', 'mada'),
(4, '07', 'Approved, update ICC.\nTo be used for mada only when a response includes an issuer script.', 'mada'),
(5, '60', 'Approved in Stand-In Processing (STIP) mode by mada switch', 'mada'),
(6, '61', 'Approved in Stand-In Processing (STIP) mode by mada POS', 'mada'),
(7, '62', 'No Reason To Decline\nTo be used for transit account verification status', 'mada'),
(8, '85', 'Used for Visa SMS PIN Change\nservice. (Visa SMS PIN Change/Unlock error code 85)', 'mada'),
(9, '87', 'Offline Approved (Chip only) by EMV card', 'mada'),
(10, '89', 'Unable to go On-line. Off-line approved by POS terminal', 'mada'),
(11, '100', 'Do not honour', 'mada'),
(12, '101', 'Expired card', 'mada'),
(13, '102', 'Suspected fraud (To be used when ARQC validation fails)', 'mada'),
(14, '103', 'Card acceptor contact acquirer', 'mada'),
(15, '104', 'Restricted card', 'mada'),
(16, '105', 'Card acceptor call acquirer?s security department', 'mada'),
(17, '106', 'Allowable PIN tries exceeded', 'mada'),
(18, '107', 'Refer to card issuer', 'mada'),
(19, '108', 'Refer to card issuer?s special conditions', 'mada'),
(20, '109', 'Invalid merchant', 'mada'),
(21, '110', 'Invalid amount', 'mada'),
(22, '111', 'Invalid card number', 'mada'),
(23, '112', 'PIN data required (also used for Visa SMS PIN Change/Unlock error code 12)', 'mada'),
(24, '114', 'No account of type requested', 'mada'),
(25, '115', 'Requested function not supported', 'mada'),
(26, '116', 'Not sufficient funds', 'mada'),
(27, '117', 'Incorrect PIN', 'mada'),
(28, '118', 'No card record', 'mada'),
(29, '119', 'Transaction not permitted to cardholder', 'mada'),
(30, '120', 'Transaction not permitted to terminal', 'mada'),
(31, '121', 'Exceeds withdrawal amount limit', 'mada'),
(32, '122', 'Security violation', 'mada'),
(33, '123', 'Exceeds withdrawal frequency limit', 'mada'),
(34, '125', 'Card not effective', 'mada'),
(35, '126', 'Invalid PIN block', 'mada'),
(36, '127', 'PIN length error', 'mada'),
(37, '128', 'PIN key synch error', 'mada'),
(38, '129', 'Suspected counterfeit card', 'mada'),
(39, '160', 'Issuer not participating in the PIN Change/Unblock Service. (Visa SMS PIN Change/Unlock error code 57)', 'mada'),
(40, '161', 'Acquirer not participating in the PIN Change/Unblock Service. (Visa SMS PIN Change/Unlock error code 58)', 'mada'),
(41, '162', 'Denied PIN Unblock. This code indicates that either the PIN Change or PIN Unblock request was declined by the issuer. (Visa SMS PIN Change/Unlock error code P5)', 'mada'),
(42, '163', 'Denied PIN Change. This code is also used by mada Issuers and indicates that requested new PIN is unsafe (Visa SMS PIN Change/Unlock error code P6)', 'mada'),
(43, '164', 'Transaction not permitted for this Merchant Category Code (MCC).', 'mada'),
(44, '165', 'Excessive capture not allowed.  The excessive capture attempt violates the mada business rules in terms of the total amount being\ncaptured or the allowed transaction channels or presentment mode.', 'mada'),
(45, '166', 'More than one pre-authorization extension is not allowed', 'mada'),
(46, '167', 'Issuer not certified for this transaction or service or Issuer does not support this service', 'mada'),
(47, '180', 'Unable to locate previous message (Visa 76)', 'mada'),
(48, '181', 'Previous message located for a repeat or reversal, but message data is inconsistent with original message (Visa 77)', 'mada'),
(49, '182', 'Invalid date (Visa 80)', 'mada'),
(50, '183', 'Cryptographic error found in PIN or CVV (Visa 81)', 'mada'),
(51, '184', 'Incorrect CVV (Visa 82)', 'mada'),
(52, '185', 'Unable to verify PIN (Visa 83)', 'mada'),
(53, '186', 'No reason to decline a request for account verification or address verification (Visa 85)', 'mada'),
(54, '187', 'Original transaction for refund, preauthorization completion, preauthorization void or preauthorization extension not found based on original transaction data elements.', 'mada'),
(55, '189', 'Agreement ID is not present in the initial 3DS authenticated agreed payment transaction or the Agreement ID in a subsequent COF agreed payment transaction is not present or does not match the Agreement ID in the initial 3DS transaction.', 'mada'),
(56, '197', 'The bank account used in the original transaction does not match the bank account being used in the Refund, Preauthorization Completion, Preauthorization Void or Preauthorization Extension transaction.', 'mada'),
(57, '198', 'The refund or preauthorization void transaction amount or cumulative amount exceeds the original transaction amount.', 'mada'),
(58, '199', 'The refund, pre-authorization\ncompletion or preauthorization void transaction period exceeds the maximum time limit allowed by the\nmada business rules.', 'mada'),
(59, '188', 'Offline declined', 'mada'),
(60, '190', 'Unable to go online ? Offline declined', 'mada'),
(61, '195', 'Individual transaction amount exceeds limit', 'mada'),
(62, '196', 'Cumulative contactless limit exceeded', 'mada'),
(63, '200', 'Do not honour', 'mada'),
(64, '201', 'Expired card', 'mada'),
(65, '202', 'Suspected fraud (To be used when ARQC validation fails)', 'mada'),
(66, '203', 'Card acceptor contact acquirer', 'mada'),
(67, '204', 'Restricted card', 'mada'),
(68, '205', 'Card acceptor call acquirer?s security department', 'mada'),
(69, '206', 'Allowable PIN tries exceeded', 'mada'),
(70, '207', 'Special conditions', 'mada'),
(71, '208', 'Lost card', 'mada'),
(72, '209', 'Stolen card', 'mada'),
(73, '210', 'Suspected counterfeit card', 'mada'),
(74, '400', 'Accepted', 'mada'),
(75, '480', 'Original transaction not found', 'mada'),
(76, '481', 'Original transaction was declined\nfound but', 'mada'),
(77, '500', 'Reconciled, in balance', 'mada'),
(78, '501', 'Reconciled, out of balance', 'mada'),
(79, '504', 'Not reconciled, totals provided  (Used in a 1524 when a Retailer Bank issues a Request Reconciliation for a POS terminal.)', 'mada'),
(80, '600', 'Accepted', 'mada'),
(81, '690', 'Unable to parse message', 'mada'),
(82, '800', 'Accepted', 'mada'),
(83, '884', 'Problem in signature verification', 'mada'),
(84, '886', 'Problem with keys format', 'mada'),
(85, '888', 'Unknown error (Default value for all other 18xx\nresponses where no appropriate 8xx or 9xx Action Code exists.)', 'mada'),
(86, '892', 'Transmission Date and Time Identical to Earlier Request', 'mada'),
(87, '902', 'Invalid transaction', 'mada'),
(88, '903', 'Re-enter transaction', 'mada'),
(89, '904', 'Format error', 'mada'),
(90, '906', 'Cutover in process', 'mada'),
(91, '907', 'Card issuer or switch inoperative', 'mada'),
(92, '908', 'Transaction destination cannot be found for routing', 'mada'),
(93, '909', 'System malfunction', 'mada'),
(94, '910', 'Card issuer signed off', 'mada'),
(95, '911', 'Card issuer timed out', 'mada'),
(96, '912', 'Card issuer unavailable', 'mada'),
(97, '913', 'Duplicate transmission', 'mada'),
(98, '914', 'Not able to trace back to original transaction', 'mada'),
(99, '915', 'Reconciliation cutover or checkpoint error', 'mada'),
(100, '916', 'MAC incorrect (permissible in 1644)', 'mada'),
(101, '917', 'MAC key sync', 'mada'),
(102, '918', 'No communication keys available for use', 'mada'),
(103, '919', 'Encryption key sync error', 'mada'),
(104, '920', 'Security software/hardware error ? try again', 'mada'),
(105, '921', 'Security software/hardware error ? no action', 'mada'),
(106, '922', 'Message number out of sequence', 'mada'),
(107, '923', 'Request in progress', 'mada'),
(108, '941', 'Destination Unavailable', 'mada'),
(109, '942', 'Invalid Capture/Reconciliation/Cutover Date', 'mada'),
(110, '00', 'Successful approval/completion or V.I.P. PIN verification is valid', 'visa'),
(111, '01', 'Refer to card issuer', 'visa'),
(112, '02', 'Refer to card issuer, special', 'visa'),
(113, '03', 'Invalid merchant or service', 'visa'),
(114, '04', 'Pick up card', 'visa'),
(115, '05', 'Do not honor', 'visa'),
(116, '06', 'Error', 'visa'),
(117, '07', 'Pick up card, special condition (other than lost/stolen card)', 'visa'),
(118, '10', 'Partial approval', 'visa'),
(119, '11', 'V.I.P. approval', 'visa'),
(120, '12', 'Invalid transaction', 'visa'),
(121, '13', 'Invalid amount (currency conversion field overflow); or amount exceeds maximum for card program', 'visa'),
(122, '14', 'Invalid account number (', 'visa'),
(123, '15', 'No such issuer', 'visa'),
(124, '19', 'Re-enter transaction', 'visa'),
(125, '21', 'No action taken (unable to back out prior transaction)', 'visa'),
(126, '25', 'Unable to locate record in file, or account number is missing from the inquiry', 'visa'),
(127, '28', 'File is temporarily unavailable', 'visa'),
(128, '39', 'No credit account', 'visa'),
(129, '41', 'Pick up card (lost card)', 'visa'),
(130, '43', 'Pick up card (stolen card)', 'visa'),
(131, '51', 'Insufficient funds', 'visa'),
(132, '52', 'No checking account', 'visa'),
(133, '53', 'No savings account', 'visa'),
(134, '54', 'Expired card', 'visa'),
(135, '55', 'Incorrect PIN', 'visa'),
(136, '57', 'Transaction not permitted to cardholder', 'visa'),
(137, '58', 'Transaction not allowed at terminal', 'visa'),
(138, '59', 'Suspected fraud', 'visa'),
(139, '61', 'Activity amount limit exceeded', 'visa'),
(140, '62', 'Restricted card (for instance, in Country Exclusion table)', 'visa'),
(141, '63', 'Security violation', 'visa'),
(142, '64', 'Transaction does not fulfill AML requirement', 'visa'),
(143, '65', 'Activity count limit exceeded', 'visa'),
(144, '75', 'Allowable number of PIN-entry tries exceeded', 'visa'),
(145, '76', 'Unable to locate previous message (no match on retrieval reference number)', 'visa'),
(146, '77', 'Previous message located for a repeat or reversal, but repeat or reversal data inconsistent with original message', 'visa'),
(147, '78', '?Blocked, first used??Transaction from new cardholder, and card not properly unblocked', 'visa'),
(148, '79', 'Transaction reversed', 'visa'),
(149, '80', 'Visa transactions: credit issuer unavailable.\nPrivate label and check acceptance: invalid date', 'visa'),
(150, '81', 'PIN cryptographic error found (error found by VIC security module during PIN decryption)', 'visa'),
(151, '82', 'Negative Online CAM, dCVV, iCVV, or CVV results Or Offline PIN authentication interrupted', 'visa'),
(152, '85', 'No reason to decline request for account number verification, address verification, CVV2\nverification, or credit voucher or merchandise return', 'visa'),
(153, '86', 'Cannot verify PIN', 'visa'),
(154, '91', 'Issuer unavailable or switch inoperative (STIP not', 'visa'),
(155, '92', 'applicable or available for this transaction) Issuers can respond with this code, which V.I.P. passes to the acquirer without invoking stand-in processing (STIP). Issuer processors use the code to indicate they cannot perform authorization on issuers? beh', 'visa'),
(156, '93', 'Financial institution or intermediate network facility cannot be found for routing', 'visa'),
(157, '94', 'Transaction cannot be completed; violation of law', 'visa'),
(158, '96', 'Duplicate transaction. Transaction submitted containing values in tracing data fields that\nduplicate values in a previous transaction.', 'visa'),
(159, 'B1', 'System malfunction or certain field error conditions', 'visa'),
(160, 'N0', 'Surcharge amount not permitted on Visa cards (U.S. acquirers only)\n1', 'visa'),
(161, 'N3', 'Force STIP', 'visa'),
(162, 'N4', 'Cash service not available', 'visa'),
(163, 'N7', 'Cashback request exceeds issuer limit', 'visa'),
(164, 'P2', 'Decline for CVV2 failure', 'visa'),
(165, 'P5', 'Invalid biller information', 'visa'),
(166, 'P6', 'PIN change/unblock request declined', 'visa'),
(167, 'R0', 'Unsafe PIN', 'visa'),
(168, 'R1', 'Stop payment order', 'visa'),
(169, 'R3', 'Revocation of authorization order', 'visa'),
(170, 'Z3', 'Revocation of all authorizations order', 'visa'),
(171, 'XA', 'Unable to go online; declined', 'visa'),
(172, 'XD', 'Forward to issuer', 'visa'),
(173, '00', 'Approved or completed successfully', 'mastercard'),
(174, '01', 'Refer to card issuer', 'mastercard'),
(175, '03', 'Invalid merchant', 'mastercard'),
(176, '04', 'Capture card', 'mastercard'),
(177, '05', 'Do not honor', 'mastercard'),
(178, '08', 'Honor with ID', 'mastercard'),
(179, '10', 'Partial Approval', 'mastercard'),
(180, '12', 'Invalid transaction', 'mastercard'),
(181, '13', 'Invalid amount', 'mastercard'),
(182, '14', 'Invalid card number', 'mastercard'),
(183, '15', 'Invalid issuer', 'mastercard'),
(184, '30', 'Format error', 'mastercard'),
(185, '41', 'Lost card', 'mastercard'),
(186, '43', 'Stolen card', 'mastercard'),
(187, '51', 'Insufficient funds/over credit limit', 'mastercard'),
(188, '54', 'Expired card', 'mastercard'),
(189, '55', 'Invalid PIN', 'mastercard'),
(190, '57', 'Transaction not permitted to issuer/cardholder', 'mastercard'),
(191, '58', 'Transaction not permitted to acquirer/terminal', 'mastercard'),
(192, '61', 'Exceeds withdrawal amount limit', 'mastercard'),
(193, '62', 'Restricted card', 'mastercard'),
(194, '63', 'Security violation', 'mastercard'),
(195, '65', 'Exceeds withdrawal count limit', 'mastercard'),
(196, '70', 'Contact Card Issuer', 'mastercard'),
(197, '71', 'PIN Not Changed', 'mastercard'),
(198, '75', 'Allowable number of PIN tries exceeded', 'mastercard'),
(199, '76', 'Invalid/nonexistent ?To Account? specified', 'mastercard'),
(200, '77', 'Invalid/nonexistent ?From Account? specified', 'mastercard'),
(201, '78', 'Invalid/nonexistent account specified (general)', 'mastercard'),
(202, '81', 'Domestic Debit Transaction Not Allowed (Regional use only)', 'mastercard'),
(203, '84', 'Invalid Authorization Life Cycle', 'mastercard'),
(204, '85', 'Not declined\nValid for all zero amount transactions.', 'mastercard'),
(205, '86', 'PIN Validation not possible', 'mastercard'),
(206, '87', 'Purchase Amount Only, No Cash Back Allowed', 'mastercard'),
(207, '88', 'Cryptographic failure', 'mastercard'),
(208, '89', 'Unacceptable PIN? Transaction Declined?Retry', 'mastercard'),
(209, '91', 'Authorization System or issuer system inoperative', 'mastercard'),
(210, '92', 'Unable to route transaction', 'mastercard'),
(211, '94', 'Duplicate transmission detected', 'mastercard'),
(212, '96', 'System error', 'mastercard'),
(213, '00', 'Approved', 'mada');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `display_order_id` varchar(255) NOT NULL,
  `track_id` varchar(255) NOT NULL,
  `paymentid` varchar(255) NOT NULL,
  `transId` varchar(55) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `created_date` varchar(80) NOT NULL,
  `source` varchar(7) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `errorText` varchar(530) NOT NULL,
  `error` varchar(255) NOT NULL,
  `authCode` varchar(255) DEFAULT NULL,
  `authRespCode` varchar(255) DEFAULT NULL,
  `currency` varchar(3) NOT NULL,
  `cardType` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `user_id`, `display_order_id`, `track_id`, `paymentid`, `transId`, `payment_status`, `created_date`, `source`, `amount`, `errorText`, `error`, `authCode`, `authRespCode`, `currency`, `cardType`) VALUES
(1, 5, '202203161745534', '202203161745534', '700202207583522554', '', '', '2022-03-16 17:45:53', 'web', 0.00, '', '', NULL, NULL, 'SAR', ''),
(2, 8, '2022041114423717', '2022041114423717', '700202210134179788', '', '', '2022-04-11 14:42:37', 'web', 0.00, '', '', NULL, NULL, 'SAR', ''),
(3, 4, '2022050417340822', '2022050417340822', '700202212432925305', '', '', '2022-05-04 17:34:08', 'web', 0.00, '', '', NULL, NULL, 'SAR', ''),
(4, 16, '2022051618552224', '2022051618552224', '700202213603762041', '', '', '2022-05-16 18:55:22', 'web', 0.00, '', '', NULL, NULL, 'SAR', '');

-- --------------------------------------------------------

--
-- Table structure for table `pcustomize_attribute`
--

CREATE TABLE `pcustomize_attribute` (
  `id` int(11) NOT NULL,
  `pcus_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `delete_status` tinyint(4) NOT NULL COMMENT '1 means deleted '
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pcustomize_title`
--

CREATE TABLE `pcustomize_title` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `add_limit` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1 means radio 2 means checkbox',
  `status` tinyint(4) NOT NULL COMMENT '1 means active',
  `delete_status` tinyint(4) NOT NULL COMMENT '1 means deleted',
  `slug` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `postal_code_list`
--

CREATE TABLE `postal_code_list` (
  `id` int(11) NOT NULL,
  `postal_code` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postal_code_list`
--

INSERT INTO `postal_code_list` (`id`, `postal_code`) VALUES
(1, '11564'),
(2, '15941'),
(3, '24236'),
(4, '20012'),
(5, '21577'),
(6, '26513'),
(7, '30799'),
(8, '32241'),
(9, '32816'),
(10, '35541'),
(11, '34424'),
(12, '34464'),
(13, '39923'),
(14, '46357'),
(15, '47711'),
(16, '48313'),
(17, '49549'),
(18, '51431'),
(19, '51911'),
(20, '55425'),
(21, '61321'),
(22, '65525'),
(23, '61961'),
(24, '61441'),
(25, '75471'),
(26, '75311'),
(27, '76321'),
(28, '77425'),
(29, '77451'),
(30, '88723'),
(31, '73311'),
(32, '35412'),
(33, '55211'),
(34, '25725'),
(35, '26312');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `price_select` tinyint(4) NOT NULL COMMENT '1 means single price 2 means multi price',
  `sku_code` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `seller_id` int(11) NOT NULL DEFAULT '0',
  `category` int(11) NOT NULL DEFAULT '0',
  `brand` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL DEFAULT '0',
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sale_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock_status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `stock` int(11) NOT NULL DEFAULT '0',
  `sale` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `product_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image_gallery` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '1 - Active, 0 - Deactive',
  `tags` varchar(530) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `customize` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_delete` tinyint(4) NOT NULL COMMENT '1 means product deleted',
  `update_date` date NOT NULL,
  `unite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `specification` longtext COLLATE utf8_unicode_ci NOT NULL,
  `shipment_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `is_delivery_available` tinyint(4) NOT NULL COMMENT '1 means vendor provide delivery for that product 0 means not',
  `is_sample_order` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 means vendor provide sample product  0 means not',
  `min_order_quantity` int(6) NOT NULL,
  `packaging_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `weight` float NOT NULL,
  `weight_unit` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `length` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `width` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `height` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `warehouse_location` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_hazardous` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `vehical_requirement` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hazardous_specify` varchar(530) COLLATE utf8_unicode_ci NOT NULL,
  `req_loading` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `is_csv` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `price_select`, `sku_code`, `product_name`, `seller_id`, `category`, `brand`, `subcategory`, `description`, `short_description`, `price`, `sale_price`, `stock_status`, `stock`, `sale`, `slug`, `product_image`, `image_gallery`, `created_date`, `status`, `tags`, `customize`, `product_delete`, `update_date`, `unite`, `specification`, `shipment_by`, `is_delivery_available`, `is_sample_order`, `min_order_quantity`, `packaging_type`, `weight`, `weight_unit`, `length`, `width`, `height`, `warehouse_location`, `city`, `lat`, `lng`, `is_hazardous`, `vehical_requirement`, `hazardous_specify`, `req_loading`, `is_csv`) VALUES
(1, 1, 0, 'Test product', 4, 1, 1, 2, '<p>Test product</p>\r\n', 'Test product', 240.00, 200.00, 'instock', 20, 0, '', '3c10bc56db7a9ac2a9488d0aad7e2da5.jpg', 'eef4f1b2ebfb878c862de06de4581e88.jpg,a566321f92b27218d1b2d915756c14a7.jpg', '2022-03-10 14:24:03', '1', 'Test product', '', 0, '2022-06-30', '9', '<p>Test product</p>\r\n', '3-4 days', 0, 1, 1, 'Boxes', 2, 'KG', '1.5 cm', '1.5 cm', '1.5 cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 0),
(2, 1, NULL, 'Test product 2', 4, 1, 2, 2, '<p>Test product 2</p>\r\n', 'Test product 2', 240.00, 220.00, 'notinstock', 30, 0, '', 'bad7c83d43909affb7f3e165536f2141.jpg', '', '2022-03-10 14:25:42', '1', 'Test product 2', '', 0, '2022-04-18', '9', '<p>Test product 2</p>\r\n', '3-4 dya', 0, 0, 1, 'Boxes', 1, 'KG', '1.54 cm', '1.54 cm', '1.54 cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 0),
(3, 1, 0, 'Test product 3', 4, 1, 1, 2, '<p>Test product 3</p>\r\n', 'Test product 3', 240.00, 220.00, 'instock', 50, 0, '', '242a124270645cced661bca98381a6eb.jpg', '', '2022-03-10 14:26:44', '1', 'Test product 3', '', 0, '2022-06-16', '9', '<p>Test product 3</p>\r\n', '3-4 days', 0, 1, 1, 'Boxes', 1, 'KG', '1.5 cm', '1.5 cm', '1.5 cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 0),
(4, 1, 0, 'Test product 3', 4, 1, 1, 3, '<p>Test product 3</p>\r\n', 'Test product 3', 240.00, 220.00, 'instock', 15, 0, '', '05d7d151a9833e089e37f37c94f4bede.jpg', '', '2022-03-10 14:28:24', '1', 'Test product 3', '', 0, '2022-06-16', '9', '<p>Test product 3</p>\r\n', '3-4', 0, 1, 1, 'Boxes', 1, 'KG', '1.5 cm', '1.5 cm', '1.5 cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 0),
(5, 1, 0, 'Test product 4', 4, 1, 1, 2, '<p>Test product 4</p>\r\n', 'Test product 4', 240.00, 220.00, 'instock', 81, 0, '', 'c5add3b89487fcac6f7485b356b0d259.jpg', '', '2022-03-10 14:29:51', '1', 'Test product 4', '', 0, '2022-06-30', '10', '<p>Test product 4</p>\r\n', '3-4', 0, 1, 1, 'Boxes', 5, 'KG', '1.5 cm', '1.5 cm', '1.5 cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 0),
(6, 1, NULL, 'product name 1', 10, 110, 6, 111, '<p>Description 1</p>\r\n', 'short description 1', 210.00, 110.00, 'instock', 1, 0, 'product-name-1', 'b8ce7cde31b66e18972bc50062839fbe.jpg', '6b67010353c5c10b07b238bb7dc60c1e.jpg,65bde49f07002d3a4d6c8e00de8d2e6b.jpg', '2022-04-04 09:59:10', '0', 'Search Tag 1', '', 1, '2022-04-04', '9', '<p>Specification 1</p>\r\n\r\n<p></p>\r\n', '4-5 Days', 1, 1, 2, 'Pallets', 1, 'KG', '21', '31', '41', 'Pune 1', 'Abha', '', '', 'No', 'Refrigerator Truck', '', 'Ramps', 0),
(7, 1, NULL, 'product name', 10, 119, 6, 120, '<p>Description</p>\r\n', 'short description', 300.00, 250.00, 'instock', 1, 0, '', '249852d58ee1c161657ac3c966a2cd8a.jpg', '02621652a7e4c7c60fb83c5b3b0206c4.jpg,954ab94cdbda8a8de6785ba847bbb891.jpg,d7fe6f38cd759c6f885e2a66fd037ed5.jpg', '2022-04-04 10:36:18', '0', 'Search Tag', '', 1, '2022-04-21', '9', '<p>Specification</p>\r\n', '3-5 days', 1, 1, 2, 'Pallets', 1, 'KG', '20', '30', '40', '', 'Abha', '', '', 'Yes', 'Truck', 'Gas', 'Ramps', 0),
(8, 1, NULL, 'تمر ', 14, 1, 6, 19, '<p>تمر</p>\r\n', 'سكري القصيم مفتل', 250.00, 150.00, 'instock', 999999940, 0, '', '04ef386eb7e963342d218c28fdc7b841.jpeg', '', '2022-04-14 09:09:34', '1', 'تمر سكري', '', 0, '2022-04-18', '13', '<p>تمر بمذاق لذيذ</p>\r\n', '4', 1, 0, 10, 'Boxes', 1, 'KG', '30 sm ', '10sm', '6am', 'الرياض الشفا', 'Abha', '', '', 'No', 'Refrigerator Truck', '', 'Ramps', 0),
(9, 1, 0, 'Test product', 4, 1, 1, 2, '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'Test product', 220.00, 200.00, 'instock', 70, 0, '', 'download-160.png', 'aztec24.png,apb-qr-code5.png', '2022-05-14 10:29:56', '1', 'Test product', '', 0, '2022-06-30', '9', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '3-4 days', 1, 1, 1, 'Boxes', 5, 'KG', '12 cm', '12 cm', '12 cm', '', 'Abha', '', '', 'Yes', 'Truck', 'Specify Nature', 'Liftgate', 1),
(10, 1, NULL, 'Test', 8, 119, 14, 120, '<p>Test</p>\r\n', 'a test product for Port10', 4.00, 2.00, 'instock', 9978, 0, '', 'd02beb6789281723019c05cef086588d.png', '', '2022-05-16 12:16:22', '1', 'Test', '', 0, '2022-05-30', '9', '<p>Test product for port10</p>\r\n', '3-4 days', 1, 0, 1, 'Boxes', 1, 'KG', '14', '16', '122', 'riyadh', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 0),
(11, 0, NULL, 'Test product', 1, 1, 1, 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Test product', 220.00, 200.00, 'instock', 5, 0, '', 'download-160.png', 'aztec24.png,apb-qr-code5.png', '2022-05-17 09:42:21', '0', 'Test product', '', 1, '2022-05-17', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '3-4 days', 1, 1, 1, 'Boxes', 1, 'KG', '12 cm', '12 cm', '12 cm', '', 'Abha', '', '', 'Yes', 'Truck', '', 'Liftgate', 1),
(12, 0, NULL, 'Sample Product', 1, 119, 2, 120, 'Description: Lorem Ipsum', 'Short Description of Product', 250.00, 230.00, 'instock', 10, 0, '', '', '', '2022-05-17 10:15:53', '0', 'Search Product Tag', '', 1, '2022-05-17', '11', 'Specification: Lorem Ipsum', '4 days', 0, 0, 2, 'Pallets', 1, 'KG', '9 cm', '14 cm', '08 cm', '', 'Abha', '', '', 'Yes', 'Refrigerator Truck', '', 'Ramps', 1),
(13, 0, NULL, 'CSV produt check', 1, 23, 3, 24, 'Description ', 'csv short description', 300.00, 210.00, 'instock', 4, 0, '', '', '', '2022-05-17 10:15:53', '0', 'CSV search tag', '', 1, '2022-05-17', '13', 'Specification ', '2-3 Days', 1, 1, 1, 'Boxes', 1, 'KG', '12cm', '13cm', '14cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 1),
(14, 0, NULL, 'Sample Product', 10, 119, 3, 120, 'Description: Lorem Ipsum', 'Short Description of Product', 250.00, 230.00, 'instock', 10, 0, '', 'desert.jpg', 'jellyfish.jpg', '2022-05-17 12:06:50', '0', 'Search Product Tag', '', 1, '2022-05-17', '11', 'Specification: Lorem Ipsum', '4 days', 0, 0, 2, 'Pallets', 1, 'KG', '9 cm', '14 cm', '08 cm', '', 'Abha', '', '', 'Yes', 'Refrigerator Truck', '', 'Ramps', 1),
(15, 1, 0, 'CSV produt check', 10, 23, 4, 25, '<p>Description</p>\r\n', 'csv short description', 300.00, 210.00, 'notinstock', 3, 0, '', 'tulips.jpg', 'desert.jpg,jellyfish.jpg', '2022-05-17 12:06:50', '1', 'CSV search tag', '', 0, '2022-06-13', '13', '<p>Specification</p>\r\n', '2-3 Days', 1, 1, 1, 'Boxes', 5, 'KG', '12cm', '13cm', '14cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_advertise`
--

CREATE TABLE `product_advertise` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `p_id` varchar(255) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `store_type` varchar(255) DEFAULT NULL,
  `sale_price` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` int(111) NOT NULL,
  `id_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_custimze_details`
--

CREATE TABLE `product_custimze_details` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `pcustomize_title_id` int(11) NOT NULL,
  `pcustomize_attribute_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_trans`
--

CREATE TABLE `product_trans` (
  `id` int(11) NOT NULL,
  `price_select` tinyint(4) NOT NULL COMMENT '1 means single price 2 means multi price',
  `sku_code` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `seller_id` int(11) NOT NULL DEFAULT '0',
  `category` int(11) NOT NULL DEFAULT '0',
  `brand` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL DEFAULT '0',
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sale_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock_status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `stock` int(11) NOT NULL DEFAULT '0',
  `sale` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `product_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image_gallery` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '1 - Active, 0 - Deactive',
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `customize` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_delete` tinyint(4) NOT NULL COMMENT '1 means product deleted',
  `update_date` date NOT NULL,
  `unite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `specification` longtext COLLATE utf8_unicode_ci NOT NULL,
  `shipment_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `is_delivery_available` tinyint(4) NOT NULL COMMENT '1 means vendor provide delivery for that product 0 means not',
  `is_sample_order` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 means vendor provide sample product  0 means not',
  `min_order_quantity` int(6) NOT NULL,
  `packaging_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `weight` float NOT NULL,
  `weight_unit` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `length` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `width` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `height` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `warehouse_location` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_hazardous` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `vehical_requirement` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hazardous_specify` varchar(530) COLLATE utf8_unicode_ci NOT NULL,
  `req_loading` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `is_csv` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_trans`
--

INSERT INTO `product_trans` (`id`, `price_select`, `sku_code`, `product_name`, `seller_id`, `category`, `brand`, `subcategory`, `description`, `short_description`, `price`, `sale_price`, `stock_status`, `stock`, `sale`, `slug`, `product_image`, `image_gallery`, `created_date`, `status`, `tags`, `customize`, `product_delete`, `update_date`, `unite`, `specification`, `shipment_by`, `is_delivery_available`, `is_sample_order`, `min_order_quantity`, `packaging_type`, `weight`, `weight_unit`, `length`, `width`, `height`, `warehouse_location`, `city`, `lat`, `lng`, `is_hazardous`, `vehical_requirement`, `hazardous_specify`, `req_loading`, `is_csv`) VALUES
(1, 1, 0, 'Test product', 4, 1, 1, 2, '<p>Test product</p>\r\n', 'Test product', 240.00, 200.00, 'instock', 20, 0, '', '3c10bc56db7a9ac2a9488d0aad7e2da5.jpg', '', '2022-03-10 14:24:03', '1', 'Test product', '', 0, '2022-05-17', '9', '<p>Test product</p>\r\n', '3-4 days', 0, 1, 1, 'Boxes', 1, 'KG', '1.5 cm', '1.5 cm', '1.5 cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 0),
(2, 1, NULL, 'Test product 2', 4, 1, 2, 2, '<p>Test product 2</p>\r\n', 'Test product 2', 240.00, 220.00, 'notinstock', 30, 0, '', 'bad7c83d43909affb7f3e165536f2141.jpg', '', '2022-03-10 14:25:42', '1', 'Test product 2', '', 0, '2022-03-10', '9', '<p>Test product 2</p>\r\n', '3-4 dya', 0, 0, 1, 'Boxes', 1, 'KG', '1.54 cm', '1.54 cm', '1.54 cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 0),
(3, 1, 0, 'Test product 3', 4, 1, 1, 2, '<p>Test product 3</p>\r\n', 'Test product 3', 240.00, 220.00, 'instock', 50, 0, '', '242a124270645cced661bca98381a6eb.jpg', '', '2022-03-10 14:26:44', '1', 'Test product 3', '', 0, '2022-03-10', '9', '<p>Test product 3</p>\r\n', '3-4 days', 0, 1, 1, 'Boxes', 1, 'KG', '1.5 cm', '1.5 cm', '1.5 cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 0),
(4, 1, 0, 'Test product 3', 4, 1, 1, 3, '<p>Test product 3</p>\r\n', 'Test product 3', 240.00, 220.00, 'instock', 15, 0, '', '05d7d151a9833e089e37f37c94f4bede.jpg', '', '2022-03-10 14:28:24', '1', 'Test product 3', '', 0, '2022-03-10', '9', '<p>Test product 3</p>\r\n', '3-4', 0, 1, 1, 'Boxes', 1, 'KG', '1.5 cm', '1.5 cm', '1.5 cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 0),
(5, 1, 0, 'Test product 4', 4, 1, 1, 2, '<p>Test product 4</p>\r\n', 'Test product 4', 240.00, 220.00, 'instock', 81, 0, '', 'c5add3b89487fcac6f7485b356b0d259.jpg', '', '2022-03-10 14:29:51', '1', 'Test product 4', '', 0, '2022-04-15', '10', '<p>Test product 4</p>\r\n', '3-4', 0, 1, 1, 'Boxes', 1, 'KG', '1.5 cm', '1.5 cm', '1.5 cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 0),
(6, 1, NULL, 'product name', 10, 110, 6, 111, '<p>Description</p>\r\n', 'short description', 210.00, 110.00, 'instock', 1, 0, '', 'b8ce7cde31b66e18972bc50062839fbe.jpg', '6b67010353c5c10b07b238bb7dc60c1e.jpg', '2022-04-04 09:59:10', '0', 'Search Tag', '', 1, '2022-04-04', '9', '<p>Specification</p>\r\n\r\n<p></p>\r\n', '3-4 Days', 0, 1, 1, 'Boxes', 1, 'KG', '20', '30', '40', 'Pune', 'Abha', '', '', 'Yes', 'Truck', 'Gas', 'Liftgate', 0),
(7, 1, NULL, 'اسم المنتج', 10, 119, 6, 120, '<p>وصف</p>\r\n', 'وصف قصير', 300.00, 250.00, 'instock', 1, 0, '-8', '249852d58ee1c161657ac3c966a2cd8a.jpg', '02621652a7e4c7c60fb83c5b3b0206c4.jpg,954ab94cdbda8a8de6785ba847bbb891.jpg,d7fe6f38cd759c6f885e2a66fd037ed5.jpg', '2022-04-04 10:36:18', '0', 'بحث الوسم', '', 1, '2022-04-22', '9', '<p>تخصيص</p>\r\n', '3-5 days', 1, 1, 2, 'Pallets', 1, 'KG', '20', '30', '40', '', 'Abha', '', '', 'Yes', 'Truck', 'Gas', 'Ramps', 0),
(8, 1, NULL, 'تمر ', 14, 1, 6, 19, '<p>تمر</p>\r\n', 'سكري القصيم مفتل', 250.00, 150.00, 'instock', 999999940, 0, '', '04ef386eb7e963342d218c28fdc7b841.jpeg', '', '2022-04-14 09:09:34', '1', 'تمر سكري', '', 0, '2022-04-14', '13', '<p>تمر بمذاق لذيذ</p>\r\n', '4', 1, 0, 10, 'Boxes', 1, 'KG', '30 sm ', '10sm', '6am', 'الرياض الشفا', 'Abha', '', '', 'No', 'Refrigerator Truck', '', 'Ramps', 0),
(9, 1, 0, 'Test product', 4, 1, 1, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Test product', 220.00, 200.00, 'instock', 70, 0, '', 'download-160.png', 'aztec24.png,apb-qr-code5.png', '2022-05-14 10:29:56', '1', 'Test product', '', 0, '2022-05-14', '9', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '3-4 days', 1, 1, 1, 'Boxes', 1, 'KG', '12 cm', '12 cm', '12 cm', '', 'Abha', '', '', 'Yes', 'Truck', '', 'Liftgate', 1),
(10, 1, NULL, 'Test', 8, 119, 14, 120, '<p>Test</p>\r\n', 'a test product for Port10', 4.00, 2.00, 'instock', 9978, 0, '', 'd02beb6789281723019c05cef086588d.png', '', '2022-05-16 12:16:22', '1', 'Test', '', 0, '2022-05-16', '9', '<p>Test</p>\r\n', '3-4 days', 1, 0, 1, 'Boxes', 1, 'KG', '14', '16', '122', 'riyadh', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 0),
(11, 0, NULL, 'Test product', 1, 1, 1, 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Test product', 220.00, 200.00, 'instock', 5, 0, '', 'download-160.png', 'aztec24.png,apb-qr-code5.png', '2022-05-17 09:42:21', '0', 'Test product', '', 1, '2022-05-17', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '3-4 days', 1, 1, 1, 'Boxes', 1, 'KG', '12 cm', '12 cm', '12 cm', '', 'Abha', '', '', 'Yes', 'Truck', '', 'Liftgate', 1),
(12, 0, NULL, 'Sample Product', 1, 119, 2, 120, 'Description: Lorem Ipsum', 'Short Description of Product', 250.00, 230.00, 'instock', 10, 0, '', '', '', '2022-05-17 10:15:53', '0', 'Search Product Tag', '', 1, '2022-05-17', '11', 'Specification: Lorem Ipsum', '4 days', 0, 0, 2, 'Pallets', 1, 'KG', '9 cm', '14 cm', '08 cm', '', 'Abha', '', '', 'Yes', 'Refrigerator Truck', '', 'Ramps', 1),
(13, 0, NULL, 'CSV produt check', 1, 23, 3, 24, 'Description ', 'csv short description', 300.00, 210.00, 'instock', 4, 0, '', '', '', '2022-05-17 10:15:53', '0', 'CSV search tag', '', 1, '2022-05-17', '13', 'Specification ', '2-3 Days', 1, 1, 1, 'Boxes', 1, 'KG', '12cm', '13cm', '14cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 1),
(14, 0, NULL, 'Sample Product', 10, 119, 3, 120, 'Description: Lorem Ipsum', 'Short Description of Product', 250.00, 230.00, 'instock', 10, 0, '', 'desert.jpg', 'jellyfish.jpg', '2022-05-17 12:06:50', '0', 'Search Product Tag', '', 1, '2022-05-17', '11', 'Specification: Lorem Ipsum', '4 days', 0, 0, 2, 'Pallets', 1, 'KG', '9 cm', '14 cm', '08 cm', '', 'Abha', '', '', 'Yes', 'Refrigerator Truck', '', 'Ramps', 1),
(15, 1, 0, 'CSV produt check', 10, 23, 4, 25, 'Description ', 'csv short description', 300.00, 210.00, 'notinstock', 3, 0, '', 'tulips.jpg', 'desert.jpg,jellyfish.jpg', '2022-05-17 12:06:50', '1', 'CSV search tag', '', 0, '2022-05-17', '13', 'Specification ', '2-3 Days', 1, 1, 1, 'Boxes', 11, 'KG', '12cm', '13cm', '14cm', '', 'Abha', '', '', 'No', 'Truck', '', 'Liftgate', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_invoice`
--

CREATE TABLE `quotation_invoice` (
  `in_id` int(11) NOT NULL,
  `quotaion_id` int(11) NOT NULL,
  `invoice_status` varchar(20) NOT NULL,
  `reject_message` varchar(530) NOT NULL,
  `in_iref_no` varchar(255) NOT NULL,
  `in_user_name` varchar(255) NOT NULL,
  `uid` int(14) NOT NULL,
  `seller_id` int(15) NOT NULL,
  `in_address` varchar(255) NOT NULL,
  `in_sn` varchar(15) NOT NULL,
  `in_qty` varchar(25) NOT NULL,
  `in_unit` varchar(25) NOT NULL,
  `in_describtion` varchar(530) NOT NULL,
  `in_sku` varchar(20) NOT NULL,
  `in_price` decimal(15,2) NOT NULL,
  `in_net_total` decimal(15,2) NOT NULL,
  `in_port_total_amount` decimal(15,2) NOT NULL,
  `created_date` varchar(70) NOT NULL,
  `in_date` date NOT NULL,
  `is_view` tinyint(4) NOT NULL COMMENT '0 means default 1 means viewed 2 means  not veiwed'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_invoice`
--

INSERT INTO `quotation_invoice` (`in_id`, `quotaion_id`, `invoice_status`, `reject_message`, `in_iref_no`, `in_user_name`, `uid`, `seller_id`, `in_address`, `in_sn`, `in_qty`, `in_unit`, `in_describtion`, `in_sku`, `in_price`, `in_net_total`, `in_port_total_amount`, `created_date`, `in_date`, `is_view`) VALUES
(1, 1, 'Confirmed', '', 'quameruddin-1', 'quameruddin', 3, 4, 'Destination', '1', '5', '15', 'test ', '5', 500.00, 500.00, 525.00, '2022-03-30 07:10:57', '2022-03-30', 0),
(2, 2, '', '', 'quameruddin-2', 'quameruddin', 3, 4, 'Destination', '', '5', '10', '', '5', 0.00, 0.00, 0.00, '', '0000-00-00', 0),
(3, 3, '', '', 'quameruddin3', 'quameruddin', 3, 4, 'Destination', '', '5', '10', '', '5', 0.00, 0.00, 0.00, '', '0000-00-00', 0),
(4, 5, '', '', '123456-4', '123456', 4, 4, 'Destination', '', '5', '9', '', '5', 0.00, 0.00, 0.00, '', '0000-00-00', 0),
(5, 8, '', '', 'adasd-5', 'adasd', 16, 6, 'test', '', '155', '25', '', '1415', 0.00, 0.00, 0.00, '', '0000-00-00', 0),
(6, 9, 'Rejected', 'test', 'adasd-6', 'adasd', 16, 8, '4124', '', '144', '26', '', '1415', 0.00, 0.00, 0.00, '', '0000-00-00', 0),
(7, 10, '', '', '1234567899000033-7', '1234567899000033', 16, 8, 'test', '', '155', '10', '', '1415', 0.00, 0.00, 0.00, '', '0000-00-00', 0),
(8, 11, 'Rejected', 'Reject', '1234567899000033-8', '1234567899000033', 16, 8, 'test', '', '155', '29', '', '1415', 0.00, 0.00, 0.00, '', '0000-00-00', 0),
(9, 12, 'Rejected', '?????', 'adasd-9', 'adasd', 16, 8, 'test', '', '155', '9', '', '1415', 0.00, 0.00, 0.00, '', '0000-00-00', 0),
(10, 13, '', '', 'quameruddin-10', 'quameruddin', 3, 4, 'Destination', '', '5', '9', '', '1', 0.00, 0.00, 0.00, '', '0000-00-00', 0),
(11, 14, '', '', 'quameruddin-11', 'quameruddin', 3, 15, 'a', '', 'a', '24', '', '33', 0.00, 0.00, 0.00, '', '0000-00-00', 0),
(12, 7, '', '', '12345678990000312', '123456789900003', 8, 10, 'test', '', '155', '9', '', '1315', 0.00, 0.00, 0.00, '', '0000-00-00', 0),
(13, 15, 'Confirmed', '', 'quameruddin-13', 'quameruddin', 3, 4, 'test address', '15', '1', '9', 'test', '5', 220.00, 220.00, 245.00, '2022-06-30 05:18:29', '2022-06-30', 0),
(14, 17, 'Confirmed', '', 'quameruddin-14', 'quameruddin', 3, 4, 'test address', '17', '1', '10', 'test', '9', 150.00, 150.00, 175.00, '2022-06-30 09:50:02', '2022-06-30', 0),
(15, 18, 'Confirmed', '', 'quameruddin-15', 'quameruddin', 3, 4, 'Destination', '18', '2', '12', 'test', '9', 300.00, 300.00, 325.00, '2022-06-30 09:59:22', '2022-06-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `send_quotation`
--

CREATE TABLE `send_quotation` (
  `id` int(15) NOT NULL,
  `uid` int(15) NOT NULL,
  `quotation_status` varchar(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `seller_id` int(15) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `purchase_cycle` varchar(10) NOT NULL,
  `customiz` varchar(10) NOT NULL,
  `deadline` date NOT NULL,
  `pid` varchar(11) NOT NULL,
  `hscode` varchar(70) NOT NULL,
  `unit` int(11) NOT NULL,
  `qty` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `delivery_date` date NOT NULL,
  `incoterms` varchar(25) NOT NULL,
  `certification` varchar(10) NOT NULL,
  `information` varchar(530) NOT NULL,
  `created_date` varchar(50) NOT NULL,
  `document` varchar(530) NOT NULL,
  `google_address` varchar(530) NOT NULL,
  `lat` varchar(244) NOT NULL,
  `lng` varchar(244) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `send_quotation`
--

INSERT INTO `send_quotation` (`id`, `uid`, `quotation_status`, `user_name`, `seller_id`, `product_name`, `category_id`, `purchase_cycle`, `customiz`, `deadline`, `pid`, `hscode`, `unit`, `qty`, `address`, `delivery_date`, `incoterms`, `certification`, `information`, `created_date`, `document`, `google_address`, `lat`, `lng`) VALUES
(1, 3, 'Confirmed', 'quameruddin', 4, 'test product', 1, 'one time', 'yes', '2022-03-15', '5', '5', 15, '5', 'Destination', '2022-03-29', 'CIF', 'yes', 'test Information', '2022-03-30 01:39:53', '', '', '', ''),
(2, 3, 'Open', 'quameruddin', 4, 'test product', 1, 'one time', 'yes', '2022-04-23', '5', '5', 10, '5', 'Destination', '2022-04-23', 'CFR', 'yes', 'test', '2022-04-21 06:35:57', '', '', '', ''),
(3, 3, 'Open', 'quameruddin', 0, 'test product', 1, 'one time', 'yes', '2022-04-23', '5', '5', 10, '5', 'Destination', '2022-04-23', 'CFR', 'yes', 'test', '2022-04-21 06:38:44', '', '', '', ''),
(4, 10, 'Cancelled', 'prishu', 0, 'test', 1, 'one time', 'yes', '2022-04-19', 'xzv', 'cvcv', 24, '1', 'sacx', '2022-04-13', 'CFR', 'yes', 'scsf', '2022-04-22 11:17:01', '', '', '', ''),
(5, 4, 'Open', '123456', 4, 'test product', 40, 'one time', 'yes', '2022-05-06', '5', '5', 9, '5', 'Destination', '2022-05-07', 'CFR', 'yes', 'test', '2022-05-06 03:57:19', '', '', '', ''),
(6, 8, 'Open', '123456789900003', 0, 'test', 63, 'one time', 'no', '2022-05-13', '1415', '1315', 9, '155', 'test', '2022-05-26', 'CFR', 'no', 'test', '2022-05-11 07:57:33', '', '', '', ''),
(7, 8, 'Open', '123456789900003', 0, 'test', 63, 'one time', 'no', '2022-05-12', '1415', '1315', 9, '155', 'test', '2022-05-31', 'FOB', 'no', 'test', '2022-05-11 07:58:59', '', '', '', ''),
(8, 16, 'Open', 'adasd', 6, 'test', 119, 'one time', 'yes', '2022-05-24', '1415', '1315', 25, '155', 'test', '2022-05-31', 'FOB', 'no', 'test', '2022-05-16 01:21:02', '', '', '', ''),
(9, 16, 'Rejected', 'adasd', 8, 'test', 119, 'one time', 'no', '2022-05-16', '1415', '1315', 26, '144', '4124', '2022-05-31', 'CFR', 'no', 'rrad', '2022-05-16 01:23:38', '', '', '', ''),
(10, 16, 'Open', '1234567899000033', 8, 'test', 119, 'one time', 'no', '2022-05-17', '1415', '1315', 10, '155', 'test', '2022-05-31', 'CFR', 'no', 'test', '2022-05-17 12:22:00', '', '', '', ''),
(11, 16, 'Rejected', '1234567899000033', 8, 'test', 119, 'one time', 'no', '2022-05-17', '1415', '1315', 29, '155', 'test', '2022-05-31', 'CPT', 'no', 'rtes', '2022-05-17 12:26:21', '', '', '', ''),
(12, 16, 'Rejected', 'adasd', 8, 'test', 119, 'one time', 'no', '2022-05-10', '1415', '1315', 9, '155', 'test', '2022-05-31', 'CFR', 'no', 'test', '2022-05-17 12:55:09', '', '', '', ''),
(13, 3, 'Open', 'quameruddin', 4, 'test product', 40, 'one time', 'yes', '2022-06-30', '1', '1', 9, '5', 'Destination', '2022-06-30', 'CFR', 'yes', 'test', '2022-06-29 09:35:09', '', '', '', ''),
(14, 3, 'Open', 'quameruddin', 15, 'a', 40, 'one time', 'yes', '2022-06-16', '33', 'a', 24, 'a', 'a', '2022-06-14', 'FAS', 'yes', 'as', '2022-06-29 01:42:15', '', '', '', ''),
(15, 3, 'Confirmed', 'quameruddin', 4, 'test product', 1, 'one time', 'yes', '2022-06-30', '5', '5', 9, '1', 'test address', '2022-06-30', 'CFR', 'yes', 'test', '2022-06-30 11:47:33', '', '', '', ''),
(16, 3, 'Open', 'quameruddin', 0, 'test product', 40, 'one time', 'yes', '2022-06-30', '5', '5', 10, '1', 'Destination', '2022-06-30', 'CFR', 'yes', 'test', '2022-06-30 04:14:17', '', '', '', ''),
(17, 3, 'Confirmed', 'quameruddin', 4, 'test product', 1, 'one time', 'yes', '2022-06-30', '9', '5', 10, '1', 'test address', '2022-06-30', 'CFR', 'yes', 'test', '2022-06-30 04:15:21', '', '', '', ''),
(18, 3, 'Confirmed', 'quameruddin', 4, 'test product', 1, 'one time', 'yes', '2022-06-30', '9', '8', 12, '2', 'Destination', '2022-06-30', 'CFR', 'yes', 'test pro', '2022-06-30 04:29:00', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `single_image`
--

CREATE TABLE `single_image` (
  `id` int(11) NOT NULL,
  `heading` varchar(530) NOT NULL,
  `image` varchar(530) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `single_image`
--

INSERT INTO `single_image` (`id`, `heading`, `image`) VALUES
(1, ' <h2>2020</h2> <h3>Steel / Aluminum</h3>  <h4>special offer</h4>', '');

-- --------------------------------------------------------

--
-- Table structure for table `state_list`
--

CREATE TABLE `state_list` (
  `id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state_list`
--

INSERT INTO `state_list` (`id`, `state_name`) VALUES
(1, 'Makkah'),
(2, 'Riyadh'),
(3, 'Dammam'),
(4, 'Abha'),
(5, 'Jazan'),
(6, 'Madinah'),
(7, 'Buraidah'),
(8, 'Tabuk'),
(9, 'Ha\'il'),
(10, 'Najran'),
(11, 'Sakaka'),
(12, 'Al-Baha'),
(13, 'Ar\'ar');

-- --------------------------------------------------------

--
-- Table structure for table `subs_plans`
--

CREATE TABLE `subs_plans` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(530) NOT NULL,
  `plan_title` varchar(50) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `duration` int(4) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subs_plans`
--

INSERT INTO `subs_plans` (`id`, `title`, `description`, `plan_title`, `amount`, `duration`, `created_date`) VALUES
(1, 'Subscribe Now!', 'Enjoy full access to Port10 by subscribing to our Starter  package. <br/><br/> By becoming a Port10 subscriber, you can utilize the platform to offer your <br/> products and serve your customers online.', 'BASIC', 4999.99, 1, '2020-10-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subs_plans_trans`
--

CREATE TABLE `subs_plans_trans` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(530) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `plan_title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `duration` int(4) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subs_plans_trans`
--

INSERT INTO `subs_plans_trans` (`id`, `title`, `description`, `plan_title`, `amount`, `duration`, `created_date`) VALUES
(1, 'Subscribe Now!', 'Enjoy full access to Port10 by subscribing to our Starter  package. <br/><br/> By becoming a Port10 subscriber, you can utilize the platform to offer your <br/> products and serve your customers online.', 'BASIC', 99.99, 1, '2020-10-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sub_more`
--

CREATE TABLE `sub_more` (
  `id` int(11) NOT NULL,
  `description` varchar(530) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_more`
--

INSERT INTO `sub_more` (`id`, `description`) VALUES
(1, 'Product Listings'),
(2, 'Automated proposals to Request for Quotation'),
(3, 'Supplier - Buyer Direct Messaging Interface'),
(4, 'Omnichannel Digital Payments');

-- --------------------------------------------------------

--
-- Table structure for table `sub_more_trans`
--

CREATE TABLE `sub_more_trans` (
  `id` int(11) NOT NULL,
  `description` varchar(530) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_more_trans`
--

INSERT INTO `sub_more_trans` (`id`, `description`) VALUES
(1, 'Product Listings'),
(2, 'Automated proposals to Request for Quotation'),
(3, 'Supplier - Buyer Direct Messaging Interface'),
(4, 'Omnichannel Digital Payments');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_info`
--

CREATE TABLE `supplier_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `national_id` varchar(50) DEFAULT NULL,
  `scheme_id` varchar(50) DEFAULT NULL,
  `remitter_id` varchar(50) DEFAULT NULL,
  `remitter_account` varchar(50) DEFAULT NULL,
  `language_code` varchar(15) DEFAULT NULL,
  `remitter_name_en` varchar(80) DEFAULT NULL,
  `remitter_name_ar` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `remitter_address1` varchar(100) DEFAULT NULL,
  `remitter_address2` varchar(100) DEFAULT NULL,
  `remitter_address3` varchar(100) DEFAULT NULL,
  `remitter_address4` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(25) DEFAULT NULL,
  `start_date` varchar(15) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `invoice_notification_flag` varchar(25) DEFAULT NULL,
  `iban_account_number` varchar(80) DEFAULT NULL,
  `bban_account_number` varchar(80) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `vat` decimal(10,2) NOT NULL COMMENT 'vat in form on percentage',
  `commission` decimal(10,2) NOT NULL,
  `shipping_charge` decimal(5,2) NOT NULL,
  `shipping_charge2` decimal(5,2) NOT NULL,
  `sar_rate` decimal(5,2) NOT NULL,
  `usd_rate` decimal(5,2) NOT NULL,
  `index_heading` mediumtext NOT NULL,
  `index_heading_trans` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bank_fees_online` decimal(10,2) NOT NULL,
  `bank_fees_cod` decimal(10,2) NOT NULL,
  `sarie_transfer_fees` decimal(10,2) NOT NULL,
  `rajhi_bank_fees` decimal(10,2) NOT NULL,
  `transfer_fees` decimal(10,2) NOT NULL COMMENT 'is equal to SARIE (Transfer) Fee + Rajhi Bank Fee',
  `cap_rate` decimal(12,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `vat`, `commission`, `shipping_charge`, `shipping_charge2`, `sar_rate`, `usd_rate`, `index_heading`, `index_heading_trans`, `bank_fees_online`, `bank_fees_cod`, `sarie_transfer_fees`, `rajhi_bank_fees`, `transfer_fees`, `cap_rate`) VALUES
(1, 15.00, 10.00, 0.00, 12.00, 1.00, 1.62, '', '', 0.00, 0.00, 0.00, 0.00, 0.00, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `track_id` varchar(255) NOT NULL,
  `paymentid` varchar(255) NOT NULL,
  `transId` varchar(255) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `created_date` varchar(50) NOT NULL,
  `source` varchar(8) NOT NULL,
  `subs_start_date` date NOT NULL,
  `subs_end_date` date NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `errorText` varchar(255) NOT NULL,
  `error` varchar(255) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `authCode` varchar(255) DEFAULT NULL,
  `authRespCode` varchar(255) DEFAULT NULL,
  `cardType` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `user_id`, `track_id`, `paymentid`, `transId`, `subscription_id`, `payment_status`, `created_date`, `source`, `subs_start_date`, `subs_end_date`, `amount`, `errorText`, `error`, `currency`, `authCode`, `authRespCode`, `cardType`) VALUES
(1, 3, '202201061524203', '700202200641330834', '', 1, '', '2022-01-06 15:24:20', 'web', '0000-00-00', '0000-00-00', 0.00, '', '', 'SAR', NULL, NULL, NULL),
(2, 3, '202201311146323', '700202203185202707', '', 1, '', '2022-01-31 11:46:32', 'web', '0000-00-00', '0000-00-00', 0.00, '', '', 'SAR', NULL, NULL, NULL),
(3, 8, '202203301239378', '700202208921989273', '', 1, '', '2022-03-30 12:39:37', 'web', '0000-00-00', '0000-00-00', 0.00, '', '', 'SAR', NULL, NULL, NULL),
(4, 8, '202203301307218', '700202208922821365', '', 1, '', '2022-03-30 13:07:21', 'web', '0000-00-00', '0000-00-00', 0.00, '', '', 'SAR', NULL, NULL, NULL),
(5, 4, '202204011119554', '700202209105998317', '', 1, '', '2022-04-01 11:19:55', 'web', '0000-00-00', '0000-00-00', 0.00, '', '', 'SAR', NULL, NULL, NULL),
(6, 4, '202204160855114', '700202210650343673', '', 1, '', '2022-04-16 08:55:11', 'web', '0000-00-00', '0000-00-00', 0.00, '', '', 'SAR', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tutorial`
--

CREATE TABLE `tutorial` (
  `id` int(11) NOT NULL,
  `heading` varchar(530) NOT NULL,
  `description` mediumtext NOT NULL,
  `video` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` varchar(15) NOT NULL,
  `date_of_publish` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutorial`
--

INSERT INTO `tutorial` (`id`, `heading`, `description`, `video`, `image`, `created_date`, `status`, `date_of_publish`) VALUES
(11, 'What are the benefits of the subscribing port 10', 'Product Listings\r\nAutomated proposals to Request for Quotation\r\nSupplier - Buyer Direct Messaging Interface\r\nOmnichannel Digital Payments', 'b8ec41902b50bfef126b3947f20f55c560.webm', '6e02b926117908cb854caa0928188011.jpg', '2022-04-19 04:23:01', 'active', '');

-- --------------------------------------------------------

--
-- Table structure for table `tutorial_trans`
--

CREATE TABLE `tutorial_trans` (
  `id` int(11) NOT NULL,
  `heading` varchar(530) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `status` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_of_publish` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutorial_trans`
--

INSERT INTO `tutorial_trans` (`id`, `heading`, `description`, `video`, `image`, `created_date`, `status`, `date_of_publish`) VALUES
(11, 'What are the benefits of the subscribing port 10', 'Product Listings\r\nAutomated proposals to Request for Quotation\r\nSupplier - Buyer Direct Messaging Interface\r\nOmnichannel Digital Payments', 'b8ec41902b50bfef126b3947f20f55c560.webm', '', '2022-04-19 04:23:01', 'active', '');

-- --------------------------------------------------------

--
-- Table structure for table `unit_list`
--

CREATE TABLE `unit_list` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_list`
--

INSERT INTO `unit_list` (`id`, `unit_name`) VALUES
(9, 'Bag/Bags'),
(3, 'Inch/Inches'),
(4, 'Kilometer/Kilometers'),
(5, 'Ounce/Ounces'),
(6, 'Pack/Packs'),
(7, 'Liter/Liters'),
(8, 'Ton/Tons'),
(10, 'Barrel/Barrels'),
(11, 'Box/Boxes'),
(12, 'Bushel/Bushels'),
(13, 'Carton/Cartons'),
(14, 'Case/Cases'),
(15, 'Centimeter/Centimeters'),
(16, 'Chain/Chains'),
(17, 'Combo/Combos'),
(18, 'Cubic Centimeter/Cubic Centimeters'),
(19, 'Cubic Foot/Cubic Feet'),
(20, 'Cubic Inch/Cubic Inches'),
(21, 'Cubic Meter/Cubic Meters'),
(22, 'Cubic Yard/Cubic Yards '),
(23, 'Drum/Drums'),
(24, 'Fluid Ounce/Fluid Ounces'),
(25, 'Foot/Feet'),
(26, 'Forty-Foot Container '),
(27, 'Furlong/Furlongs'),
(28, 'Gallon/Gallons'),
(29, 'Gill/Gills'),
(30, 'Gram/Grams'),
(31, 'Kilogram/Kilograms'),
(32, 'Kilowatt/Kilowatts'),
(33, 'Long Ton/Long Tons'),
(34, 'Meter/Meters'),
(35, 'Metric Ton/Metric Tons'),
(36, 'Mile/Miles'),
(37, 'Pair/Pairs'),
(38, 'Pallet/Pallets'),
(39, 'Parcel/Parcels'),
(40, 'Perch/Perches'),
(41, 'Piece/Pieces'),
(42, 'Pint/Pints'),
(43, 'Pound/Pounds'),
(44, 'Quart/Quarts'),
(45, 'Roll/Rolls'),
(46, 'Set/Sets'),
(47, 'Sheet/Sheets'),
(48, 'Short Ton/Short Tons'),
(49, 'Square Centimeter/Square Centimeters'),
(50, 'Square Foot/Square Feet'),
(51, 'Square Inch/Square Inches'),
(52, 'Square Meter/Square Meters'),
(53, 'Square Mile/Square Miles'),
(54, 'Square Yard/Square Yards'),
(55, 'Stone/Stones'),
(56, 'Strand/Strands'),
(57, 'Tonne/Tonnes'),
(58, 'Tray/Trays'),
(59, 'Twenty-Foot Container'),
(60, 'Yard/Yards');

-- --------------------------------------------------------

--
-- Table structure for table `unit_list_trans`
--

CREATE TABLE `unit_list_trans` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_list_trans`
--

INSERT INTO `unit_list_trans` (`id`, `unit_name`) VALUES
(10, 'Barrel/Barrels'),
(9, 'Bag/Bags'),
(3, 'Inch/Inches'),
(4, 'Kilometer/Kilometers'),
(5, 'Ounce/Ounces'),
(6, 'Pack/Packs'),
(7, 'Liter/Liters'),
(8, 'Ton/Tons'),
(11, 'Box/Boxes'),
(12, 'Bushel/Bushels'),
(13, 'Carton/Cartons'),
(14, 'Case/Cases'),
(15, 'Centimeter/Centimeters'),
(16, 'Chain/Chains'),
(17, 'Combo/Combos'),
(18, 'Cubic Centimeter/Cubic Centimeters'),
(19, 'Cubic Foot/Cubic Feet'),
(20, 'Cubic Inch/Cubic Inches'),
(21, 'Cubic Meter/Cubic Meters'),
(22, 'Cubic Yard/Cubic Yards '),
(23, 'Drum/Drums'),
(24, 'Fluid Ounce/Fluid Ounces'),
(25, 'Foot/Feet'),
(26, 'Forty-Foot Container '),
(27, 'Furlong/Furlongs'),
(28, 'Gallon/Gallons'),
(29, 'Gill/Gills'),
(30, 'Gram/Grams'),
(31, 'Kilogram/Kilograms'),
(32, 'Kilowatt/Kilowatts'),
(33, 'Long Ton/Long Tons'),
(34, 'Meter/Meters'),
(35, 'Metric Ton/Metric Tons'),
(36, 'Mile/Miles'),
(37, 'Pair/Pairs'),
(38, 'Pallet/Pallets'),
(39, 'Parcel/Parcels'),
(40, 'Perch/Perches'),
(41, 'Piece/Pieces'),
(42, 'Pint/Pints'),
(43, 'Pound/Pounds'),
(44, 'Quart/Quarts'),
(45, 'Roll/Rolls'),
(46, 'Set/Sets'),
(47, 'Sheet/Sheets'),
(48, 'Short Ton/Short Tons'),
(49, 'Square Centimeter/Square Centimeters'),
(50, 'Square Foot/Square Feet'),
(51, 'Square Inch/Square Inches'),
(52, 'Square Meter/Square Meters'),
(53, 'Square Mile/Square Miles'),
(54, 'Square Yard/Square Yards'),
(55, 'Stone/Stones'),
(56, 'Strand/Strands'),
(57, 'Tonne/Tonnes'),
(58, 'Tray/Trays'),
(59, 'Twenty-Foot Container'),
(60, 'Yard/Yards');

-- --------------------------------------------------------

--
-- Table structure for table `upload_images`
--

CREATE TABLE `upload_images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload_images`
--

INSERT INTO `upload_images` (`id`, `image`, `seller_id`) VALUES
(1, 'aa3.jpg', 1),
(2, 'apb-qr-code.png', 1),
(3, 'download.png', 1),
(4, 'apb-qr-code5.png', 1),
(5, 'aztec24.png', 1),
(6, 'download-160.png', 1),
(7, 'desert.jpg', 1),
(8, 'wildlife.wmv', 1),
(9, 'hydrangeas.jpg', 1),
(10, 'jellyfish.jpg', 1),
(11, 'tulips.jpg', 1),
(12, 'jellyfish96.jpg', 1),
(13, 'tulips74.jpg', 1),
(14, 'd3546b7610d5e4857c3c551c9457f5cc.jpg', 4),
(15, 'apb-qr-code58.png', 4),
(16, 'aztec97.png', 4),
(17, 'bnr3.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_rating`
--

CREATE TABLE `user_rating` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `pid` int(11) NOT NULL DEFAULT '0',
  `rating` tinyint(4) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL,
  `created_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `code_name` varchar(80) NOT NULL,
  `start_date` varchar(80) NOT NULL,
  `end_date` varchar(80) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 means active 0 means deactive',
  `type` tinyint(4) NOT NULL COMMENT '1 means percentage 0 means fiex amount',
  `amount` decimal(6,2) NOT NULL,
  `free_shipping` tinyint(4) NOT NULL COMMENT '1 means shipping free 0 means not free'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_groups`
--
ALTER TABLE `admin_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users_groups`
--
ALTER TABLE `admin_users_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_item`
--
ALTER TABLE `attribute_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_trans`
--
ALTER TABLE `banner_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_trans`
--
ALTER TABLE `blog_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_type`
--
ALTER TABLE `blog_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_trans`
--
ALTER TABLE `brand_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_trans`
--
ALTER TABLE `category_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_compose`
--
ALTER TABLE `chat_compose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_list`
--
ALTER TABLE `city_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_request`
--
ALTER TABLE `contact_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cron_test`
--
ALTER TABLE `cron_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_info_offer`
--
ALTER TABLE `email_info_offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_trans`
--
ALTER TABLE `faq_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_content`
--
ALTER TABLE `footer_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_mesg_notification`
--
ALTER TABLE `inv_mesg_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_extra_data`
--
ALTER TABLE `items_extra_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_cart`
--
ALTER TABLE `my_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_invoice`
--
ALTER TABLE `order_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`order_master_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages_trans`
--
ALTER TABLE `pages_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_code_msg`
--
ALTER TABLE `payment_code_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pcustomize_attribute`
--
ALTER TABLE `pcustomize_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pcustomize_title`
--
ALTER TABLE `pcustomize_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postal_code_list`
--
ALTER TABLE `postal_code_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_advertise`
--
ALTER TABLE `product_advertise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_id` (`attribute_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `product_custimze_details`
--
ALTER TABLE `product_custimze_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_trans`
--
ALTER TABLE `product_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_invoice`
--
ALTER TABLE `quotation_invoice`
  ADD PRIMARY KEY (`in_id`);

--
-- Indexes for table `send_quotation`
--
ALTER TABLE `send_quotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `single_image`
--
ALTER TABLE `single_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_list`
--
ALTER TABLE `state_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subs_plans`
--
ALTER TABLE `subs_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subs_plans_trans`
--
ALTER TABLE `subs_plans_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_more`
--
ALTER TABLE `sub_more`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_more_trans`
--
ALTER TABLE `sub_more_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_info`
--
ALTER TABLE `supplier_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutorial`
--
ALTER TABLE `tutorial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutorial_trans`
--
ALTER TABLE `tutorial_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_list`
--
ALTER TABLE `unit_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_list_trans`
--
ALTER TABLE `unit_list_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_images`
--
ALTER TABLE `upload_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rating`
--
ALTER TABLE `user_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_groups`
--
ALTER TABLE `admin_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `admin_users_groups`
--
ALTER TABLE `admin_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `attribute_item`
--
ALTER TABLE `attribute_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `banner_trans`
--
ALTER TABLE `banner_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `blog_trans`
--
ALTER TABLE `blog_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `blog_type`
--
ALTER TABLE `blog_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `brand_trans`
--
ALTER TABLE `brand_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `category_trans`
--
ALTER TABLE `category_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chat_compose`
--
ALTER TABLE `chat_compose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `city_list`
--
ALTER TABLE `city_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `contact_request`
--
ALTER TABLE `contact_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `cron_test`
--
ALTER TABLE `cron_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email_info_offer`
--
ALTER TABLE `email_info_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `faq_trans`
--
ALTER TABLE `faq_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `footer_content`
--
ALTER TABLE `footer_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inv_mesg_notification`
--
ALTER TABLE `inv_mesg_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items_extra_data`
--
ALTER TABLE `items_extra_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `my_cart`
--
ALTER TABLE `my_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_invoice`
--
ALTER TABLE `order_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `order_master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages_trans`
--
ALTER TABLE `pages_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_code_msg`
--
ALTER TABLE `payment_code_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pcustomize_attribute`
--
ALTER TABLE `pcustomize_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pcustomize_title`
--
ALTER TABLE `pcustomize_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postal_code_list`
--
ALTER TABLE `postal_code_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_advertise`
--
ALTER TABLE `product_advertise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_custimze_details`
--
ALTER TABLE `product_custimze_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_trans`
--
ALTER TABLE `product_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `quotation_invoice`
--
ALTER TABLE `quotation_invoice`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `send_quotation`
--
ALTER TABLE `send_quotation`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `single_image`
--
ALTER TABLE `single_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `state_list`
--
ALTER TABLE `state_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subs_plans`
--
ALTER TABLE `subs_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subs_plans_trans`
--
ALTER TABLE `subs_plans_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_more`
--
ALTER TABLE `sub_more`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_more_trans`
--
ALTER TABLE `sub_more_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier_info`
--
ALTER TABLE `supplier_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tutorial`
--
ALTER TABLE `tutorial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tutorial_trans`
--
ALTER TABLE `tutorial_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `unit_list`
--
ALTER TABLE `unit_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `unit_list_trans`
--
ALTER TABLE `unit_list_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `upload_images`
--
ALTER TABLE `upload_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_rating`
--
ALTER TABLE `user_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
