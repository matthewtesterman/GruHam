We created multiple tables in the database:
 gh_favorites
 gh_reviews
 gh_system
 gh_users

Logging into the db is team01 for username and HomeBuyer1! for password. 
 
We did not delete the tables that were from a previous team.
 
The website address is: https://php.radford.edu/~team01/GruHAM
the password to access the team01 account for web server access has not changed.

##############################
As for logging into GruHAM, use my login info to be an admin.
username: mtesterman
password: 12
##############################

As for configuration on another web server, 
Address information (the variables in the top of the file) may need to be changed in functions.php and everything needs to be set to 755 for permission for it to function properly.

SQL code to create tables in another database if necessary:

-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 04, 2014 at 10:36 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `team01`
--

-- --------------------------------------------------------

--
-- Table structure for table `gh_favorites`
--

CREATE TABLE IF NOT EXISTS `gh_favorites` (
  `user_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `fav_id` int(6) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`fav_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gh_favorites`
--

INSERT INTO `gh_favorites` (`user_id`, `house_id`, `fav_id`) VALUES
(14, 245234534, 1),
(14, 32454354, 2);

-- --------------------------------------------------------

--
-- Table structure for table `gh_reviews`
--

CREATE TABLE IF NOT EXISTS `gh_reviews` (
  `reviewID` int(20) NOT NULL AUTO_INCREMENT,
  `house_id` char(20) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `body` varchar(250) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `post_time` varchar(25) NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`reviewID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `gh_reviews`
--

INSERT INTO `gh_reviews` (`reviewID`, `house_id`, `user_ID`, `subject`, `body`, `user_name`, `post_time`) VALUES
(5, '3540 Old Towne Road', 1, 'It''s a house', 'This is most definitely a house', 'Alex Morris', '12-04-2014 07:23:56'),
(7, '209 6th Street', 1, 'House', 'This house is located in Radford', 'Alex Morris', '12-04-2014 19:30:56');

-- --------------------------------------------------------

--
-- Table structure for table `gh_system`
--

CREATE TABLE IF NOT EXISTS `gh_system` (
  `gh_system_id` int(11) NOT NULL AUTO_INCREMENT,
  `gh_system_disable` int(3) NOT NULL,
  `gh_system_message` varchar(300) NOT NULL,
  `gh_user_id` int(11) NOT NULL,
  PRIMARY KEY (`gh_system_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gh_system`
--

INSERT INTO `gh_system` (`gh_system_id`, `gh_system_disable`, `gh_system_message`, `gh_user_id`) VALUES
(1, 0, 'Sorry, the website is down. Please try again later.', 14);

-- --------------------------------------------------------

--
-- Table structure for table `gh_users`
--

CREATE TABLE IF NOT EXISTS `gh_users` (
  `gh_user_id` int(10) NOT NULL AUTO_INCREMENT,
  `gh_email` varchar(25) NOT NULL,
  `gh_password` varchar(50) NOT NULL,
  `gh_name_first` varchar(50) NOT NULL,
  `gh_name_last` varchar(50) NOT NULL,
  `gh_registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gh_role` varchar(20) NOT NULL,
  `gh_user_suspended` varchar(3) NOT NULL,
  `gh_last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `gh_activate_key` varchar(60) NOT NULL,
  `gh_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`gh_user_id`),
  UNIQUE KEY `gh_user_email` (`gh_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `gh_users`
--

INSERT INTO `gh_users` (`gh_user_id`, `gh_email`, `gh_password`, `gh_name_first`, `gh_name_last`, `gh_registration_date`, `gh_role`, `gh_user_suspended`, `gh_last_login`, `gh_activate_key`, `gh_active`) VALUES
(14, 'mtesterman@radford.edu', '7b52009b64fd0a2a49e6d8a939753077792b0554', 'Matt', 'Testerman', '2014-11-11 04:57:07', 'admin', '', '2014-12-04 22:09:58', '1d2c7604fcdc037fbbaa540280402c367fd8e9e2', 1),
(27, 'blank207@gmail.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', 'Johnny', 'Smith', '2014-11-16 01:05:35', 'user', '', '2014-12-02 10:53:00', '143d8f7a28a6782220eb9837e534cdf9446a7e3b', 1),
(26, 'katlynn.belcher@gmail.com', '65bff254bba09fdf8d77c9b549c20c7cad845e84', 'Katlynn', 'Belcher', '2014-11-14 13:14:43', 'user', '', '0000-00-00 00:00:00', 'c753be37724d82d8267c2b2689cc38632bfec57e', 0),
(28, 'csayre2@radford.edu', '673a9ea7b605a33140d7996e8c20cab961ab8d21', 'Chris', 'Sayre', '2014-11-17 22:52:14', 'user', '', '0000-00-00 00:00:00', '4f33ac82059e32d028497b017c0f3d82f7601396', 1),
(29, 'adzik@radford.edu', 'ef8aec626d941b7fb5bbd60ae857f0e45dbbeb7e', 'Adam', 'Dzik', '2014-11-17 22:53:45', 'admin', '', '2014-12-04 20:06:22', '04bf3ffb1e1b356d6eb6b72f765b77d14cc108fb', 1),
(47, 'amorris5@radford.edu', '7b52009b64fd0a2a49e6d8a939753077792b0554', 'Alex', 'Morris', '2014-12-05 03:17:51', 'admin', 'no', '2014-12-04 22:19:48', '', 1);


 