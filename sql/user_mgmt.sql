-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2025 at 07:32 AM
-- Server version: 8.0.42-0ubuntu0.22.04.2
-- PHP Version: 8.1.2-1ubuntu2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m2its`
--

-- --------------------------------------------------------

--
-- Table structure for table `org_info`
--

CREATE TABLE `org_info` (
  `pk_org_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `org_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `org_email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `org_password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `org_updated_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `org_updated_on` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `org_status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `org_info`
--

INSERT INTO `org_info` (`pk_org_id`, `org_name`, `org_email`, `org_password`, `org_updated_by`, `org_updated_on`, `org_status`) VALUES
('6479e79b21971', 'ABC School', 'abc@gmail.com', 'abc', 'Test_User', '2023-06-02 12:59:07.137638', 'A'),
('6479e7b0a6913', 'DEF School', 'def@gmail.com', 'def', 'Test_User', '2023-06-02 12:59:28.682306', 'A'),
('6484662c5e3f8', 'GEH', 'geh@geh.com', 'geh', 'danny@gmail.com', '2023-06-10 12:01:48.386129', 'A'),
('649345cf9eb60', 'CLOUD SCHOOL', 'admin@cloudschool.com', 'admin', 'danny@gmail.com', '2023-06-21 18:47:43.650143', 'A'),
('6497039c9a679', 'TNSSLC', 'admin@tnsslc.com', 'admin', 'danny@gmail.com', '2023-06-24 14:54:20.632513', 'A'),
('649731d623a73', 'MAAYAAH', 'sadmin@maayaah.com', 'admin', 'danny@gmail.com', '2023-06-24 18:11:34.146098', 'A'),
('64b8d862acd66', 'M2i Technology Solutions PVT LTD', 'm2its@m2i.com', 'm2its', 'superadmin@m2i.com', '2023-07-20 06:46:58.707975', 'A'),
('6658bf3f7e913', 'Bala', 'bala@test.com', 'test123', 'admin@m2i.com', '2024-05-30 18:02:39.518487', 'A'),
('66764b510e111', 'M2iTS PVT LTD', 'm2itsadmin@m2its.com', 'm2itsadmin', 'admin@m2i.com', '2024-06-22 03:56:01.057685', 'A'),
('66824d54e4b35', 'TN Schools', 'tnschoolsdesk@tnschools.com', 'tnschoolsdesk', 'tnschoolssuperadmin@tnschools.com', '2024-07-01 06:31:48.936836', 'A'),
('6687d7467a90b', 'SHSS', 'shss@m2i.com', 'admin', 'admin@m2i.com', '2024-07-05 11:21:42.502099', 'A'),
('6695e5efb9271', 'Jeri_tution', 'vjericot@gmail.com', 'jeri', 'admin@m2i.com', '2024-07-16 03:15:59.758445', 'A'),
('66ae31425ac4e', 'tcs', 'tcs@tcs.com', 'tcs', 'jeganvedha00@gmail.com', '2024-08-03 13:31:46.371848', 'A'),
('66de53eacde01', 'STMARYS', 'admin@stmary.com', 'spc', 'superadmin@m2i.com', '2024-09-09 01:48:26.843401', 'A'),
('66de53eace841', 'add', 'admin@avrmv.com', 'aac', 'superadmin@m2i.com', '2024-09-09 01:48:26.845922', 'A'),
('66de56765e6cd', 'LHSS', 'admin@lhss.com', 'lhss', 'superadmin@m2i.com', '2024-09-09 01:59:18.386858', 'A'),
('66de56765ee39', 'GHSS', 'admin@ghss.com', 'ghss', 'superadmin@m2i.com', '2024-09-09 01:59:18.388706', 'A'),
('671080e054b33', '507507', 'boothagent1@gmail.com', 'boothagent1c', 'superadmin@m2i.com', '2024-10-17 03:13:36.346977', 'A'),
('671315b123e0e', 'Mayah music school', 'admin@mayah.com', 'Admin@123#', 'superadmin@m2i.com', '2024-10-19 02:13:05.147007', 'A'),
('686b9f0a1c898', 'jerituition', 'superadmin@m2i.com', 'superadminm2i', 'superadmin@m2i.com', '2025-07-07 10:18:50.116974', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

CREATE TABLE `role_master` (
  `pk_role_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `role_org_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `role_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `role_description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role_updated_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `role_updated_on` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `role_status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_master`
--

INSERT INTO `role_master` (`pk_role_id`, `role_org_id`, `role_name`, `role_description`, `role_updated_by`, `role_updated_on`, `role_status`) VALUES
('role_admin_001', '6484662c5e3f8', 'Admin', 'Administrator role with full access', 'system', '2023-06-10 12:00:00.000000', 'A'),
('role_user_001', '6484662c5e3f8', 'User', 'Standard user role with limited access', 'system', '2023-06-10 12:00:00.000000', 'A'),
('role_deo_001', '6484662c5e3f8', 'Data Entry Operator', 'Data entry operator role', 'system', '2023-06-10 12:00:00.000000', 'A'),
('role_admin_002', '649345cf9eb60', 'Admin', 'Administrator role with full access', 'system', '2023-06-21 18:00:00.000000', 'A'),
('role_user_002', '649345cf9eb60', 'User', 'Standard user role with limited access', 'system', '2023-06-21 18:00:00.000000', 'A'),
('role_deo_002', '649345cf9eb60', 'Data Entry Operator', 'Data entry operator role', 'system', '2023-06-21 18:00:00.000000', 'A'),
('role_admin_003', '6497039c9a679', 'Admin', 'Administrator role with full access', 'system', '2023-06-24 15:00:00.000000', 'A'),
('role_user_003', '6497039c9a679', 'User', 'Standard user role with limited access', 'system', '2023-06-24 15:00:00.000000', 'A'),
('role_deo_003', '6497039c9a679', 'Data Entry Operator', 'Data entry operator role', 'system', '2023-06-24 15:00:00.000000', 'A'),
('role_admin_004', '649731d623a73', 'Admin', 'Administrator role with full access', 'system', '2023-06-24 18:00:00.000000', 'A'),
('role_user_004', '649731d623a73', 'User', 'Standard user role with limited access', 'system', '2023-06-24 18:00:00.000000', 'A'),
('role_deo_004', '649731d623a73', 'Data Entry Operator', 'Data entry operator role', 'system', '2023-06-24 18:00:00.000000', 'A'),
('role_admin_005', '64b8d862acd66', 'Admin', 'Administrator role with full access', 'system', '2023-07-20 06:00:00.000000', 'A'),
('role_user_005', '64b8d862acd66', 'User', 'Standard user role with limited access', 'system', '2023-07-20 06:00:00.000000', 'A'),
('role_admin_006', '6658bf3f7e913', 'Admin', 'Administrator role with full access', 'system', '2024-05-30 18:00:00.000000', 'A'),
('role_user_006', '6658bf3f7e913', 'User', 'Standard user role with limited access', 'system', '2024-05-30 18:00:00.000000', 'A'),
('role_user_007', '66764b510e111', 'User', 'Standard user role with limited access', 'system', '2024-06-22 03:00:00.000000', 'A'),
('role_admin_008', '66824d54e4b35', 'Admin', 'Administrator role with full access', 'system', '2024-07-01 06:00:00.000000', 'A'),
('role_user_008', '66824d54e4b35', 'User', 'Standard user role with limited access', 'system', '2024-07-01 06:00:00.000000', 'A'),
('role_user_009', '6687d7467a90b', 'User', 'Standard user role with limited access', 'system', '2024-07-05 11:00:00.000000', 'A'),
('role_admin_010', '6687d7467a90b', 'Admin', 'Administrator role with full access', 'system', '2024-07-05 11:00:00.000000', 'A'),
('role_admin_011', '6695e5efb9271', 'Admin', 'Administrator role with full access', 'system', '2024-07-16 03:00:00.000000', 'A'),
('role_user_011', '6695e5efb9271', 'User', 'Standard user role with limited access', 'system', '2024-07-16 03:00:00.000000', 'A'),
('role_admin_012', '66ae31425ac4e', 'Admin', 'Administrator role with full access', 'system', '2024-08-03 13:00:00.000000', 'A'),
('role_user_012', '66ae31425ac4e', 'User', 'Standard user role with limited access', 'system', '2024-08-03 13:00:00.000000', 'A'),
('role_admin_013', '671315b123e0e', 'Admin', 'Administrator role with full access', 'system', '2024-10-19 02:00:00.000000', 'A'),
('role_user_013', '671315b123e0e', 'User', 'Standard user role with limited access', 'system', '2024-10-19 02:00:00.000000', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `pk_user_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_org_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_role_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_updated_by` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_updated_date_time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `user_status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`pk_user_id`, `user_org_id`, `user_name`, `user_email`, `user_password`, `user_role_id`, `user_updated_by`, `user_updated_date_time`, `user_status`) VALUES
('64846e2cc6878', '6484662c5e3f8', 'Christofer', 'christofer@gmail.com', 'christofer', 'role_user_001', 'danny@gmail.com', '2023-06-10 12:35:56.813268', 'A'),
('6489739e20c50', '6484662c5e3f8', 'John', 'john@gmail.com', 'john', 'role_deo_001', 'danny@gmail.com', '2023-06-14 08:00:30.134373', 'A'),
('648973c801a6e', '6484662c5e3f8', 'Merwin', 'merwin@gmail.com', 'merwin', 'role_user_001', 'danny@gmail.com', '2023-06-14 08:01:12.006927', 'A'),
('648fe81b36ca0', '6484662c5e3f8', 'Abi', 'abi@gmail.com', 'abi', 'role_admin_001', 'danny@gmail.com', '2023-06-19 05:31:07.224517', 'A'),
('64929dcb9961d', '6484662c5e3f8', 'Dinesh', 'dinesh@gmail.com', 'dinesh', 'role_user_001', 'abi@gmail.com', '2023-06-21 06:50:51.628307', 'A'),
('649346083aa60', '649345cf9eb60', 'deo_cloudschool', 'deo@cloudschool.com', 'deo', 'role_deo_002', 'danny@gmail.com', '2023-06-21 18:48:40.240618', 'A'),
('6493462a2fa54', '649345cf9eb60', 'user_cloudschool', 'user@cloudschool.com', 'user', 'role_user_002', 'danny@gmail.com', '2023-06-21 18:49:14.195207', 'A'),
('6493468e86734', '649345cf9eb60', 'admin_cloudschool', 'admin@cloudschool.com', 'admin', 'role_admin_002', 'danny@gmail.com', '2023-06-21 18:50:54.550790', 'A'),
('649710ff5ba5f', '6497039c9a679', 'admin tnsslc.com', 'admin@tnsslc.com', 'admin', 'role_admin_003', 'danny@gmail.com', '2023-06-24 15:51:27.375909', 'A'),
('6497111a7d679', '6497039c9a679', 'deo tnsslc.com', 'deo@tnsslc.com', 'deo', 'role_deo_003', 'danny@gmail.com', '2023-06-24 15:51:54.513713', 'A'),
('6497113245796', '6497039c9a679', 'user tnsslc.com', 'user@tnsslc.com', 'user', 'role_user_003', 'danny@gmail.com', '2023-06-24 15:52:18.284624', 'A'),
('6497323d2709f', '649731d623a73', 'admin @ maayaah.com', 'admin@maayaah.com', 'admin', 'role_admin_004', 'danny@gmail.com', '2023-06-24 18:13:17.159965', 'A'),
('6497324f762d0', '649731d623a73', 'deo@ maayaah.com', 'deo@maayaah.com', 'deo', 'role_deo_004', 'danny@gmail.com', '2023-06-24 18:13:35.484129', 'A'),
('649732665fe15', '649731d623a73', 'user@ maayaah.com', 'user@maayaah.com', 'user', 'role_user_004', 'danny@gmail.com', '2023-06-24 18:13:58.392804', 'A'),
('64b8d8a662864', '64b8d862acd66', 'Admin', 'admin@m2i.com', 'admin', 'role_admin_005', 'superadmin@m2i.com', '2023-07-20 06:48:06.403576', 'A'),
('659ba8b29aaf4', '64b8d862acd66', 'andrew@m2i.com', 'andrew@m2i.com', 'Admin@123€', 'role_user_005', 'admin@m2i.com', '2024-01-08 07:48:02.633610', 'A'),
('6658bf94b233f', '6658bf3f7e913', 'pondybala', 'balachandar.saas@gmail.com', 'test123', 'role_user_006', 'admin@m2i.com', '2024-05-30 18:04:04.729977', 'A'),
('6658c002be4a1', '6658bf3f7e913', 'balachandar', 'berlin@123.com', 'test123', 'role_user_006', 'admin@m2i.com', '2024-05-30 18:05:54.779509', 'A'),
('6658c03cd280a', '6658bf3f7e913', 'balaadmin', 'balachandar.saas@gmail.com', 'test123', 'role_admin_006', 'admin@m2i.com', '2024-05-30 18:06:52.862309', 'A'),
('6658c09aab5ca', '6658bf3f7e913', 'adminbala', 'adminbala@test.com', 'test123', 'role_admin_006', 'admin@m2i.com', '2024-05-30 18:08:26.701955', 'A'),
('66764b71d473e', '66764b510e111', 'Guest User', 'guestuser@m2its.com', 'guestuser@123#', 'role_user_007', 'admin@m2i.com', '2024-06-22 03:56:33.870274', 'A'),
('66824de450754', '66824d54e4b35', 'TN Schools Admin', 'tnschoolsadmin@tnschools.com', 'admin@tnschools', 'role_admin_008', 'tnschoolssuperadmin@tnschools.com', '2024-07-01 06:34:12.329613', 'A'),
('6682503dab438', '66824d54e4b35', 'Guest TN School User', 'guestuser@tnschools.com', 'guestuser@tnschools', 'role_user_008', 'tnschoolsadmin@tnschools.com', '2024-07-01 06:44:13.701568', 'A'),
('6687d80464347', '6687d7467a90b', 'aravind', 'aravind@m2i.com', 'aravind', 'role_user_009', 'admin@m2i.com', '2024-07-05 11:24:52.410522', 'A'),
('6687dd048e1a4', '64b8d862acd66', 'aravind@m2i.com', 'aravind@m2i.com', 'user', 'role_user_005', 'admin@m2i.com', '2024-07-05 11:46:12.582100', 'A'),
('6695e650d0ef1', '6695e5efb9271', 'admin', 'admin@jeritution.com', 'admin', 'role_admin_011', 'admin@m2i.com', '2024-07-16 03:17:36.855838', 'A'),
('6695e71718d03', '6695e5efb9271', 'user', 'user@jeritution.com', 'user', 'role_user_011', 'admin@m2i.com', '2024-07-16 03:20:55.101674', 'A'),
('66975f52f09f2', '6687d7467a90b', 'shssadmin', 'admin@shss.com', 'shss', 'role_admin_010', 'admin@m2i.com', '2024-07-17 06:06:10.985630', 'A'),
('66a0adab930b1', '6687d7467a90b', 'naveen', 'naveen@shss.com', 'user', 'role_user_009', 'admin@shss.com', '2024-07-24 07:30:51.602335', 'A'),
('66a0add2a8991', '6687d7467a90b', 'naveen', 'naveen@shss.com', 'user', 'role_user_009', 'admin@shss.com', '2024-07-24 07:31:30.690614', 'A'),
('66a0ae1bbe5ac', '6687d7467a90b', 'naveen', 'naveen@shss.com', 'user', 'role_user_009', 'admin@shss.com', '2024-07-24 07:32:43.779740', 'A'),
('66a0af0ae4e9c', '6687d7467a90b', 'arun', 'arun@shss.com', 'arun', 'role_user_009', 'admin@shss.com', '2024-07-24 07:36:42.937671', 'A'),
('66ae319cc0393', '66ae31425ac4e', 'vedha', 'vedha@00@gmail.com', 'vedha', 'role_admin_012', 'jeganvedha00@gmail.com', '2024-08-03 13:33:16.787393', 'A'),
('66ae32701e36f', '66ae31425ac4e', 'ashok', 'ashok@gmail.com', 'ashok', 'role_admin_012', 'jeganvedha00@gmail.com', '2024-08-03 13:36:48.123804', 'A'),
('66ae338a02024', '66ae31425ac4e', 'siva', 'siva@gmail.com', 'siva', 'role_user_012', 'ashok@gmail.com', '2024-08-03 13:41:30.008297', 'A'),
('66b5c178bafb2', '66ae31425ac4e', 'jegan', 'siva@gmail.com', '1234', 'role_admin_012', 'jeganvedha00@gmail.com', '2024-08-09 07:12:56.765921', 'A'),
('671318b00e659', '671315b123e0e', 'udi@mayah.com', 'udi@mayah.com', 'Admin@123#', 'role_admin_013', 'superadmin@m2i.com', '2024-10-19 02:25:52.059024', 'A'),
('671318f912a21', '671315b123e0e', 'rini@mayah.com', 'rini@mayah.com', 'Admin@123#', 'role_user_013', 'superadmin@m2i.com', '2024-10-19 02:27:05.076380', 'A'),
('678cd249da0ef', '6695e5efb9271', 'joshua', 'joshua@jeritution.com', 'joshua', 'role_user_011', 'admin@jeritution.com', '2025-01-19 10:22:01.893225', 'A'),
('678cecba0f22a', '6695e5efb9271', 'deepesh', 'deepesh@jeritution.com', 'deepesh', 'role_user_011', 'admin@jeritution.com', '2025-01-19 12:14:50.062105', 'A'),
('685ee08833bf9', '6687d7467a90b', 'aravind0505', 'aravind@shss.com', '123', 'role_user_009', 'admin@shss.com', '2025-06-27 18:18:48.212024', 'A'),
('687d2f49930f2', '6687d7467a90b', 'Aravind S', 'aravind11201004@gmail.com', 'shss', 'role_admin_010', 'admin@shss.com', '2025-07-20 18:02:49.602396', 'A'),
('687d31e58395b', '6687d7467a90b', 'Andrews Selvaraj', 'andrew_india@yahoo.com', 'shss', 'role_admin_010', 'admin@shss.com', '2025-07-20 18:13:57.539011', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `org_info`
--
ALTER TABLE `org_info`
  ADD PRIMARY KEY (`pk_org_id`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`pk_role_id`),
  ADD KEY `fk_role_org_id` (`role_org_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`pk_user_id`),
  ADD KEY `fk_user_org_id` (`user_org_id`),
  ADD KEY `fk_user_role_id` (`user_role_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_master`
--
ALTER TABLE `role_master`
  ADD CONSTRAINT `fk_role_org_id` FOREIGN KEY (`role_org_id`) REFERENCES `org_info` (`pk_org_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `fk_user_org_id` FOREIGN KEY (`user_org_id`) REFERENCES `org_info` (`pk_org_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_role_id` FOREIGN KEY (`user_role_id`) REFERENCES `role_master` (`pk_role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
