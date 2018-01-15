-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 27, 2017 at 08:53 AM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taipei_station`
--

-- --------------------------------------------------------

--
-- Table structure for table `version_log`
--

CREATE TABLE IF NOT EXISTS `version_log` (
  `id` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` datetime NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buildingID` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `version_log`
--

INSERT INTO `version_log` (`id`, `version`, `file`, `createTime`, `code`, `buildingID`) VALUES
(186, 186, '/icon/icon_test123.png', '2017-07-08 22:57:13', '9872ed9fc22fc182d371c3e9ed316094', NULL),
(187, 187, '/icon/icon_test123.png', '2017-07-08 22:57:26', '31fefc0e570cb3860f2a6d4b38c6490d', NULL),
(188, 188, '/icon/icon_asdasdsa.png', '2017-07-08 23:03:23', '9dcb88e0137649590b755372b040afad', NULL),
(189, 189, '/icon/icon_qweqwe.png', '2017-07-08 23:03:30', 'a2557a7b2e94197ff767970b67041697', NULL),
(190, 190, '/icon/icon_cvxvcxv.png', '2017-07-08 23:03:44', 'cfecdb276f634854f3ef915e2e980c31', NULL),
(191, 191, '/icon/icon_099.png', '2017-07-10 22:01:09', '0aa1883c6411f7873cb83dacb17b0afc', NULL),
(192, 192, '/keelung01/map/b2.svg', '2017-07-17 21:30:38', '58a2fc6ed39fd083f55d4182bf88826d', NULL),
(193, 193, '/TaipeiZ/map/.svg', '2017-07-17 21:31:08', 'bd686fd640be98efaae0091fa301e613', NULL),
(194, 194, '/TaipeiZ2/map/b5.svg', '2017-07-17 21:38:40', 'a597e50502f5ff68e3e25b9114205d4a', NULL),
(195, 195, '/TaipeiZ2/map/k1.svg', '2017-07-17 21:41:36', '0336dcbab05b9d5ad24f4333c7658a0e', NULL),
(196, 196, '/icon/icon_099.png', '2017-07-17 21:48:57', '084b6fbb10729ed4da8c3d3f5a3ae7c9', NULL),
(197, 197, '/Taipei_Main_Station/map/k_zone.svg', '2017-07-17 22:16:36', '85d8ce590ad8981ca2c8286f79f59954', NULL),
(198, 198, '/icon/icon_test222.png', '2017-07-17 22:17:30', '0e65972dce68dad4d52d063967f0a705', NULL),
(199, 199, '/Taipei_Main_Station/map/Z_zone.svg', '2017-07-17 22:29:44', '84d9ee44e457ddef7f2c4f25dc8fa865', NULL),
(200, 200, '/icon/icon_123214.png', '2017-07-17 22:58:21', '3644a684f98ea8fe223c713b77189a77', NULL),
(201, 201, '/icon/icon_123214333.png', '2017-07-17 22:58:30', '757b505cfd34c64c85ca5b5690ee5293', NULL),
(202, 202, '/icon/icon_dsad.png', '2017-07-17 23:25:06', '854d6fae5ee42911677c739ee1734486', NULL),
(203, 203, '/k_zone/map/1.svg', '2017-07-17 23:43:03', 'e2c0be24560d78c5e599c2a9c9d0bbd2', NULL),
(204, 204, '/Y_zone/map/1.svg', '2017-07-17 23:44:30', '274ad4786c3abca69fa097b85867d9a4', NULL),
(205, 205, '/Z_zone/map/1.svg', '2017-07-17 23:46:03', 'eae27d77ca20db309e056e3d2dcd7d69', NULL),
(206, 206, '/BeiMen_B2_B1/map/B1.svg', '2017-07-17 23:48:12', '7eabe3a1649ffa2b3ff8c02ebfd5659f', NULL),
(207, 207, '/icon/icon_AED.png', '2017-07-18 14:09:55', '69adc1e107f7f7d035d7baf04342e1ca', NULL),
(208, 208, '/icon/icon_Restroom.png', '2017-07-18 14:29:25', '091d584fced301b442654dd8c23b3fc9', NULL),
(209, 209, '/k_zone/map/1.svg', '2017-07-26 15:33:11', 'b1d10e7bafa4421218a51b1e1f1b0ba2', NULL),
(210, 210, '/icon/icon_Apparel .png', '2017-07-26 15:40:26', '6f3ef77ac0e3619e98159e9b6febf557', NULL),
(211, 211, '/icon/icon_FOOD.png', '2017-07-26 16:20:38', 'eb163727917cbba1eea208541a643e74', NULL),
(212, 212, '/icon/icon_FOOD.png', '2017-07-26 16:27:41', '1534b76d325a8f591b52d302e7181331', NULL),
(213, 213, '/icon/icon_Supply.png', '2017-07-26 17:58:07', '979d472a84804b9f647bc185a877a8b5', NULL),
(214, 214, '/icon/icon_Supply.png', '2017-07-26 18:34:41', 'ca46c1b9512a7a8315fa3c5a946e8265', NULL),
(215, 215, '/icon/icon_Supply.png', '2017-07-26 18:35:12', '3b8a614226a953a8cd9526fca6fe9ba5', NULL),
(216, 216, '/icon/icon_Supply.png', '2017-07-26 18:35:29', '45fbc6d3e05ebd93369ce542e8f2322d', NULL),
(217, 217, '/icon/icon_Supply.png', '2017-07-26 22:04:01', '63dc7ed1010d3c3b8269faf0ba7491d4', NULL),
(218, 218, '/icon/icon_FOOD.png', '2017-07-26 22:04:18', 'e96ed478dab8595a7dbda4cbcbee168f', NULL),
(219, 219, '/icon/icon_Apparel .png', '2017-07-26 22:04:31', 'c0e190d8267e36708f955d7ab048990d', NULL),
(220, 220, '/Z_zone/map/B1.svg', '2017-07-26 22:08:23', 'ec8ce6abb3e952a85b8551ba726a1227', NULL),
(221, 221, '/k_zone/map/B1.svg', '2017-07-26 22:09:50', '060ad92489947d410d897474079c1477', NULL),
(222, 222, '/icon/icon_3C.png', '2017-07-26 22:12:35', 'bcbe3365e6ac95ea2c0343a2395834dd', NULL),
(223, 223, '/icon/icon_other.png', '2017-07-26 22:13:00', '115f89503138416a242f40fb7d7f338e', NULL),
(224, 224, '/icon/icon_cloth.png', '2017-07-26 22:13:27', '13fe9d84310e77f13a6d184dbf1232f3', NULL),
(225, 225, '/icon/icon_Apparel.png', '2017-07-26 22:13:39', 'd1c38a09acc34845c6be3a127a5aacaf', NULL),
(226, 226, '/icon/icon_furniture.png', '2017-07-26 22:14:47', '9cfdf10e8fc047a44b08ed031e1f0ed1', NULL),
(227, 227, '/icon/icon_market.png', '2017-07-26 22:15:08', '705f2172834666788607efbfca35afb3', NULL),
(228, 228, '/icon/icon_Sports.png', '2017-07-26 22:15:29', '74db120f0a8e5646ef5a30154e9f6deb', NULL),
(229, 229, '/icon/icon_books.png', '2017-07-26 22:16:10', '57aeee35c98205091e18d1140e9f38cf', NULL),
(230, 230, '/icon/icon_Boutique .png', '2017-07-26 22:16:54', '6da9003b743b65f4c0ccd295cc484e57', NULL),
(231, 231, '/icon/icon_Multimedia.png', '2017-07-26 22:17:59', '9b04d152845ec0a378394003c96da594', NULL),
(232, 232, '/icon/icon_shoes and bags.png', '2017-07-26 22:18:53', 'be83ab3ecd0db773eb2dc1b0a17836a1', NULL),
(233, 233, '/icon/icon_Pets.png', '2017-07-26 22:19:14', 'e165421110ba03099a1c0393373c5b43', NULL),
(234, 234, '/icon/icon_shoebag.png', '2017-07-26 22:20:16', '289dff07669d7a23de0ef88d2f7129e7', NULL),
(235, 235, '/icon/icon_FOOD.png', '2017-07-26 22:24:56', '577ef1154f3240ad5b9b413aa7346a1e', NULL),
(236, 236, '/k_zone/map/b1.svg', '2017-07-27 14:01:03', '01161aaa0b6d1345dd8fe4e481144d84', NULL),
(237, 237, '/z_zone/map/b1.svg', '2017-07-27 14:07:35', '539fd53b59e3bb12d203f45a912eeaf2', NULL),
(238, 238, '/y_zone/map/b1.svg', '2017-07-27 14:08:10', 'ac1dd209cbcc5e5d1c6e28598e8cbbe8', NULL),
(239, 239, '/z_zone/map/b1.svg', '2017-07-27 14:08:52', '555d6702c950ecb729a966504af0a635', NULL),
(240, 240, '/k_zone/map/b1.svg', '2017-07-27 14:09:38', '335f5352088d7d9bf74191e006d8e24c', NULL),
(241, 241, '/y_zone/map/b1.svg', '2017-07-27 14:09:59', 'f340f1b1f65b6df5b5e3f94d95b11daf', NULL),
(242, 242, '/tms_b1_f1_f2/map/.svg', '2017-07-27 14:12:11', 'e4a6222cdb5b34375400904f03d8e6a5', NULL),
(243, 243, '/tms_b1_f1_f2/map/b1.svg', '2017-07-27 14:12:29', 'cb70ab375662576bd1ac5aaf16b3fca4', NULL),
(244, 244, '/tms_b1_f1_f2/map/1f.svg', '2017-07-27 14:13:03', '9188905e74c28e489b44e954ec0b9bca', NULL),
(245, 245, '/tms_b1_f1_f2/map/.svg', '2017-07-27 14:13:30', '0266e33d3f546cb5436a10798e657d97', NULL),
(246, 246, '/tms_b1_f1_f2/map/2f.svg', '2017-07-27 14:14:10', '38db3aed920cf82ab059bfccbd02be6a', NULL),
(247, 247, '/mrt_bl/map/b2.svg', '2017-07-27 14:15:24', '3cec07e9ba5f5bb252d13f5f431e4bbb', NULL),
(248, 248, '/beimen_b2_b1/map/b1.svg', '2017-07-27 14:16:58', '621bf66ddb7c962aa0d22ac97d69b793', NULL),
(249, 249, '/beimen_b2_b1/map/b2.svg', '2017-07-27 14:17:24', '077e29b11be80ab57e1a2ecabb7da330', NULL),
(250, 250, '/qsquare/map/b1.svg', '2017-07-27 14:20:34', '6c9882bbac1c7093bd25041881277658', NULL),
(251, 251, '/qsquare/map/1f.svg', '2017-07-27 14:21:05', '19f3cd308f1455b3fa09a282e0d496f4', NULL),
(252, 252, '/k_zone/map/2f.svg', '2017-07-27 14:21:25', '03c6b06952c750899bb03d998e631860', NULL),
(253, 253, '/qsquare/map/2f.svg', '2017-07-27 14:21:48', 'c24cd76e1ce41366a4bbe8a49b02a028', NULL),
(254, 254, '/qsquare/map/3f.svg', '2017-07-27 14:22:24', 'c52f1bd66cc19d05628bd8bf27af3ad6', NULL),
(255, 255, '/qsquare/map/4f.svg', '2017-07-27 14:22:42', 'fe131d7f5a6b38b23cc967316c13dae2', NULL),
(256, 256, '/icon/icon_entertainment.png', '2017-07-27 14:35:44', 'f718499c1c8cef6730f9fd03c8125cab', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `version_log`
--
ALTER TABLE `version_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `version_log`
--
ALTER TABLE `version_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=257;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
