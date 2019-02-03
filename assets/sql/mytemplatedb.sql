-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 03 Feb 2019 pada 18.43
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mytemplatedb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `special_privilege` tinyint(4) NOT NULL DEFAULT '0',
  `dashboard_access` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `special_privilege`, `dashboard_access`, `created_date`, `updated_date`) VALUES
(1, 'Super Administrator', 'Group for Super Administrator', 1, 0, '2018-12-05 07:18:47', '0000-00-00 00:00:00'),
(2, 'Administrator', 'Group for Administrator', 0, 0, '2018-12-05 07:18:47', '2018-12-12 18:05:00'),
(5, 'Regular User', 'Group for Regular User', 0, 0, '2018-12-05 07:20:37', '0000-00-00 00:00:00'),
(7, 'Geng Kapak', 'Jangan coba-coba', 1, 1, '2018-12-12 17:51:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups_acl`
--

DROP TABLE IF EXISTS `groups_acl`;
CREATE TABLE IF NOT EXISTS `groups_acl` (
`id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_` tinyint(1) NOT NULL,
  `read_` tinyint(1) NOT NULL,
  `update_` tinyint(1) NOT NULL,
  `delete_` tinyint(1) NOT NULL,
  `report_` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `groups_acl`
--

INSERT INTO `groups_acl` (`id`, `group_id`, `menu_id`, `created_date`, `create_`, `read_`, `update_`, `delete_`, `report_`) VALUES
(3, 1, 2, '2018-12-09 17:31:06', 0, 1, 0, 0, 0),
(4, 3, 1, '2018-12-20 07:10:53', 0, 0, 1, 0, 0),
(5, 4, 1, '2018-12-20 07:10:53', 0, 0, 0, 1, 0),
(6, 1, 5, '2018-12-20 07:12:41', 0, 0, 0, 0, 0),
(7, 1, 1, '2018-12-21 08:37:40', 1, 1, 1, 0, 0),
(8, 4, 3, '2018-12-21 09:03:41', 0, 0, 0, 0, 0),
(9, 1, 7, '2018-12-21 09:40:22', 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keys`
--

DROP TABLE IF EXISTS `keys`;
CREATE TABLE IF NOT EXISTS `keys` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `app_key` varchar(64) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `class_name` varchar(20) NOT NULL,
  `method_name` varchar(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `class_name`, `method_name`, `created_date`, `updated_date`) VALUES
(1, 'Master Menu', 'Menu to manage Master Menu', 'menu', '', '2018-12-09 17:26:40', '2018-12-11 03:53:19'),
(3, 'Master User', 'Menu Master User (using fake class name)', 'master_user', '', '2018-12-11 09:32:38', '0000-00-00 00:00:00'),
(4, 'Master Group', 'Managing Group of Users', 'group', '', '2018-12-14 07:20:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id` int(6) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `birth` date DEFAULT NULL,
  `profile_picture` varchar(100) DEFAULT NULL,
  `utype` int(5) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `phone`, `address`, `status`, `birth`, `profile_picture`, `utype`, `created_date`, `updated_date`) VALUES
(37, 'superadmin', 'Super Admin', 'admin@mail.com', 'a/F/w9VLWK2TjR2secXh6dpeHazmjlqkjd6UpkLTPD8=', NULL, NULL, 0, NULL, NULL, NULL, '2018-12-12 18:16:23', '2019-02-03 16:47:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_group`
--

DROP TABLE IF EXISTS `users_group`;
CREATE TABLE IF NOT EXISTS `users_group` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data untuk tabel `users_group`
--

INSERT INTO `users_group` (`id`, `user_id`, `group_id`, `created_date`) VALUES
(27, 37, 1, '2018-12-23 14:30:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_type`
--

DROP TABLE IF EXISTS `users_type`;
CREATE TABLE IF NOT EXISTS `users_type` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `users_type`
--

INSERT INTO `users_type` (`id`, `name`, `code`) VALUES
(1, 'Super Administrator', 1),
(2, 'Administrator', 2),
(3, 'Director', 3),
(4, 'Regular User', 90);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_acl`
--
ALTER TABLE `groups_acl`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_group`
--
ALTER TABLE `users_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_type`
--
ALTER TABLE `users_type`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `groups_acl`
--
ALTER TABLE `groups_acl`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `users_group`
--
ALTER TABLE `users_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `users_type`
--
ALTER TABLE `users_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;