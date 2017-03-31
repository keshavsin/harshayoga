-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2017 at 05:43 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `harshayog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `mobile` bigint(10) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  `created_date` date DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `email`, `mobile`, `is_active`, `created_date`, `updated_date`) VALUES
(1, 'admin', '8dd43ae0638e1ce2690e2e3cfa653923', 'harsha@harshayoga.com', 9999999999, 1, '2017-03-05', '2017-03-05'),
(2, 'sumit mann', 'da4edf2857529c2ad3cf9c2e0502cb20', 'sumitmann93@gmail.com', 9898989898, 1, '2017-03-16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_type` varchar(20) DEFAULT NULL,
  `retreat_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `amount_paid` decimal(10,0) DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `tnc_agreed` tinyint(4) DEFAULT '0',
  `status` int(15) DEFAULT NULL,
  `user_id` varchar(40) NOT NULL,
  PRIMARY KEY (`id`,`booking_date`,`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `booking_type`, `retreat_id`, `class_id`, `amount_paid`, `currency`, `name`, `email`, `mobile`, `booking_date`, `tnc_agreed`, `status`, `user_id`) VALUES
(1, 'class', NULL, 1, '5555', 'INR', '3 months ', 'sumitmann93@gmail.com', 9898989898, '2017-03-05', 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(15) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  `duration` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `class_details`
--

CREATE TABLE IF NOT EXISTS `class_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` varchar(40) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(15) DEFAULT NULL,
  `menu_text` varchar(30) DEFAULT NULL,
  `type` varchar(15) NOT NULL,
  `location` varchar(50) NOT NULL,
  `class_type` varchar(15) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `currency` varchar(10) NOT NULL,
  `city` varchar(15) DEFAULT NULL,
  `state` varchar(15) DEFAULT NULL,
  `country` varchar(15) DEFAULT NULL,
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `itinerary` text NOT NULL,
  `max_bookings` int(11) DEFAULT NULL,
  `html_template` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `start_date` date DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `reference_no`, `menu_text`, `type`, `location`, `class_type`, `duration`, `price`, `currency`, `city`, `state`, `country`, `title`, `description`, `itinerary`, `max_bookings`, `html_template`, `is_active`, `start_date`, `created_date`, `updated_date`) VALUES
(1, NULL, NULL, 'class', '', 'weekday', 3, '5555.55', 'INR', NULL, NULL, NULL, '3 Months', '<h2>Asana</h2>\r\n<ul>\r\n<li>Begineers level 1  standing asanas as per Light on yoga (B.K.S. IYENGAR )</li>\r\n<li>Sitting asanas</li>\r\n<li>Forward bending</li>\r\n<li>Backbending</li>\r\n</ul>\r\n<p>Relaxation Asanas for different health issues (if any)</p>\r\n<h2>Pranayama</h2>\r\n<ul>\r\n<li>Suryabhedhana Pranayama</li>\r\n<li>Chandra Bhedhana Pranayama</li>\r\n<li>Bhrahmari</li>\r\n</ul>\r\n<h2>Yoga nidra</h2>\r\n<ul>\r\n<li>The first stage of yoga Nidra</li>\r\n</ul>\r\n<h2>Meditation</h2>\r\n<ul>\r\n<li>First 3 steps of Antar mauna</li>\r\n<li>First  3 steps of cidakasa dharana</li>\r\n</ul>', '', NULL, NULL, 1, NULL, '2017-03-09 01:08:11', '2017-03-09 01:10:05'),
(2, NULL, NULL, 'class', '', 'weekday', 6, '9555.55', 'INR', NULL, NULL, NULL, '6 Months', '<h2>Asana</h2>\r\n<ul>\r\n<li>Begineers level 2  standing asanas as per Light on yoga (B.K.S. IYENGAR )</li>\r\n<li>Entire cycle of sitting asanas</li>\r\n<li>Intermediate level of Backward bending</li>\r\n<li>Relaxation Asanas for different health issues (if any )</li>\r\n</ul>\r\n<h2>Pranayama</h2>\r\n<ul>\r\n<li>Kapalabhathi</li>\r\n<li>Bhasthrika pranayama</li>\r\n<li>Suryabhedhana Pranayama</li>\r\n<li>Chandra Bhedhana Pranayama</li>\r\n<li>Bhrahmari</li>\r\n</ul>\r\n<h2>Yoga nidra</h2>\r\n<ul>\r\n<li>The complete yoga Nidra practice (including the chakra visualization)</li>\r\n</ul>\r\n<h2>Meditation</h2>\r\n<ul>\r\n<li>First 5 steps of Antar mauna</li>\r\n<li>First  5 steps of cidakasa dharana</li>\r\n</ul>', '', NULL, NULL, 1, NULL, '2017-03-09 01:08:11', '2017-03-09 01:10:05'),
(3, NULL, NULL, 'class', '', 'weekday', 10, '12555.55', 'INR', NULL, NULL, NULL, '10 Months', '<h2>Asana</h2>\r\n<ul>\r\n<li>Intermediate  level  asanas as per Light on yoga (B.K.S. IYENGAR )</li>\r\n<li>Relaxation Asanas for different health issues (if any )</li>\r\n<li>Restorative practices</li>\r\n</ul>\r\n<h2>Pranayama</h2>\r\n<ul>\r\n<li>Kapalabhathi</li>\r\n<li>Bhasthrika pranayama</li>\r\n<li>Suryabhedhana Pranayama</li>\r\n<li>Chandra Bhedhana Pranayama</li>\r\n<li>Nadhi shodhana pranayama</li>\r\n<li>Bhrahmari</li>\r\n</ul>\r\n<h2>Yoga nidra</h2>\r\n<ul>\r\n<li>The complete yoga Nidra practice (including the chakra visualization)</li>\r\n</ul>\r\n<h2>Meditation</h2>\r\n<ul>\r\n<li>The complete practice of antar mauna</li>\r\n<li>The complete practice of cidakasa dharana</li>\r\n</ul>', '', NULL, NULL, 1, NULL, '2017-03-09 01:08:11', '2017-03-09 01:10:05'),
(4, NULL, NULL, 'class', '', 'weekday', 15, '15555.55', 'INR', NULL, NULL, NULL, '15 Months', '<h2>Asana</h2>\r\n<ul>\r\n<li>The complete Intermediate level  asanas as per Light on yoga (B.K.S. IYENGAR )</li>\r\n<li>Relaxation Asanas for different health issues (if any )</li>\r\n<li>Complete advance asana practices as per Light on yoga (B.K.S. IYENGAR )</li>\r\n</ul>\r\n<h2>Pranayama (along with retention)</h2>\r\n<ul>\r\n<li>Kapalabhathi</li>\r\n<li>Bhasthrika pranayama</li>\r\n<li>Suryabhedhana Pranayama</li>\r\n<li>Chandra Bhedhana Pranayama</li>\r\n<li>Nadhi shodhana pranayama</li>\r\n<li>Bhrahmari</li>\r\n</ul>\r\n<h2>Yoga nidra</h2>\r\n<ul>\r\n<li>The complete practice of Antar Mauna</li>\r\n<li>The complete practice of Cidakasa Dharana</li>\r\n<li>The complete practice of Hrudayakasa Dharana</li>\r\n</ul>\r\n<h2>TTC</h2>\r\n<ul>\r\n<li>After practicing for 15 months one can enroll for the Teacher training course which will be for a year</li>\r\n<li>Includes the study of yoga sutras, Hatha yoga, detailed study of the different practices from Asana to pranayama to Meditation</li>\r\n<li>Study of Anatomy of human body & in detail study of adopting yoga as therapy</li>\r\n</ul>', '', NULL, NULL, 1, NULL, '2017-03-09 01:08:11', '2017-03-09 01:10:05'),
(5, NULL, NULL, 'class', '', 'weekend', 4, '2555.00', 'INR', NULL, NULL, NULL, '4 Months', '', '', NULL, NULL, 0, NULL, '2017-03-09 01:08:11', '2017-03-09 01:10:05'),
(6, NULL, 'Goa', 'retreat', 'Goa, Arambol', NULL, NULL, NULL, '', 'goa', 'goa', 'india', 'goa', 'Arambol is a traditional fisherman village, located approximately a one-hour drive from the Dabolim Airport (GOI) within the Pernem, administrative region of northern Goa, India. A short walk north off the main beach is a smaller beach with a "fresh water lake" close to the sea. The jungle valley, enclosed between low hills hide a spectacular Banyan tree. Strong winds during the main season make it a significant location for leisure sports, like Paragliding and Kite Surfing. A variety of practitioners in the healing arts offer courses inYoga, meditation, Odissi Dance and others, instruments (like Tabla, Sitar and other traditional Indian as well as Western instruments.', '', NULL, NULL, 1, NULL, '2017-03-09 04:18:19', '2017-03-09 05:17:19'),
(7, NULL, 'Mysuru', 'retreat', 'Srirabgapatna', NULL, NULL, NULL, '', 'mysuru', 'karnataka', 'india', 'SRIRANGAPATTANA, MYSURU', 'Mysore (or Mysuru), a city in India''s southwestern Karnataka state, was the capital of the Kingdom of Mysore from 1399 to 1947. In its center is opulent Mysore Palace, seat of the former ruling Wodeyar dynasty. The palace blends Hindu, Islamic, Gothic and Rajput styles. Mysore is also home to the centuries-old Devaraja Market, filled with spices, silk and sandalwood.<br/>\r\nSrirangapatna is a town in Mandya district of the Indian state of Karnataka. Located near the city of Mysore, it is of religious, cultural and historic importance.\r\nThe town takes its name from the celebrated Ranganathaswamy temple which dominates the town. Tradition holds that all the islands formed in the Kaveri River are consecrated to Sri Ranganathaswamy, and large temples have been built in very ancient times dedicated to that deity on the three largest islands. These three towns, which constitute the main pilgrimage centers dedicated to god Ranganathaswamy.', '', NULL, NULL, 1, NULL, '2017-03-09 04:18:19', '2017-03-09 05:17:19'),
(8, NULL, 'Bali', 'retreat', 'Ubud', NULL, NULL, NULL, '', 'bali', NULL, 'Indonesia', 'BALI', 'Bali, also known as the "Land of the Gods", is the most famous island in Indonesia. It stakes a serious claim to be paradise on earth.<br/>\r\nBali''s looming volcanoes and lush, terraced rice fields exude both serenity and sublimity. Bali is known for its dramatic dances, intricately carved temples, colorful ceremonies, arts and crafts, luxurious beach resorts and exciting night life. From inspirational spirituality to fine dining and meeting experiences, from world class surfing and diving to exhilarating treks in the wild, this exotic island has much to offer.<br/>\r\nUbud, is where the retreat will happen, is a small town in central Bali. Far removed from the beach party scene, Ubud is the cultural center of Bali. Much of the town and nearby villages consist of artists'' workshops and galleries. The ubiquitous creativity, remarkable architecture and calm, warm vibe make Ubud a perfect place to relax, recharge and, of course, practice yoga.', '', NULL, NULL, 1, NULL, '2017-03-09 04:18:19', '2017-03-09 05:17:19'),
(9, NULL, 'Ashtanga Yoga Level 1', 'ttc', '', NULL, NULL, NULL, 'inr', NULL, NULL, NULL, 'ASHTANGA YOGA LEVEL 1', '', '', 10, '<ul class="list-group">\r\n    <li class="list-group-item disabled">Philosophy</li>\r\n  <li class="list-group-item">Important sutras from chapter 1 &amp; 2 of yoga sutras of patanjali.</li>\r\n  <li class="list-group-item">The first chapter of hatha yoga.</li>\r\n  <li class="list-group-item">A brief study on the four streams of yoga. Namely; Raja yoga, karma yoga, Bhakti yoga, Gyana yoga.</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Anatomy</li>\r\n  <li class="list-group-item">An introduction to anatomy &amp; physiology of human body</li>\r\n  <li class="list-group-item">What not to teach for individuals suffering from different ailments.</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Asana</li>\r\n  <li class="list-group-item">The beginners level from The light on Yoga &amp; the first few weeks of intermediate level for those who wish to push their limits</li>\r\n  <li class="list-group-item">Curative asanas for individuals suffering from different ailments.</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Pranayama</li>\r\n  <li class="list-group-item">Kapalbhati</li>\r\n  <li class="list-group-item">Bhastrika Pranayama</li>\r\n  <li class="list-group-item">Surya bhedhana pranayama</li>\r\n  <li class="list-group-item">Nadi shodhana pranayama</li>\r\n  <li class="list-group-item">Bhramari pranayama</li>\r\n  <li class="list-group-item text-info"><i>Involves the theoretical study of each of the above &amp; practice sequence too that can be followed for upto 18 months.</i></li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Meditation</li>\r\n  <li class="list-group-item">There will regularly be short sessions of meditation (around 15-30 minutes per session).</li>\r\n  </ul>\r\n  <ul class="list-group">\r\n    <li class="list-group-item disabled">Chanting</li>\r\n  <li class="list-group-item">Yoga shloka</li>\r\n  <li class="list-group-item">Surya Namaskara shloka &amp; 13 mantras</li>\r\n  <li class="list-group-item">Shanti mantra</li>\r\n  <li class="list-group-item">Pranayama shloka</li>\r\n  <li class="list-group-item text-info"><i>The above will be taught to students in person &amp; by the end of the ttc they will be able to chant fluently too so that a part of Sanskrit language, the of all languages stays in them for every.</i></li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Duration and intake</li>\r\n  <li class="list-group-item">Weekday : Every Tuesday , Thursday &amp; Saturday - 2 months</li>\r\n  <li class="list-group-item">Weekends : 3 months</li>\r\n  <li class="list-group-item">A maximum of 10 students/ ttc. Individual attention will be given all the students to bring out the best in them.</li>\r\n </ul>\r\n <ul class="list-group">\r\n    <li class="list-group-item disabled">Pre requisites</li>\r\n  <li class="list-group-item">Students must have prior practice for atleast 3 - 18 months</li>\r\n  <li class="list-group-item">Beginners having the inclination towards in-depth studies &amp; want to enhance their knowledge base can apply too.</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Presentation and yoga therapy</li>\r\n  <li class="list-group-item">Students are required to prepare a mini Students are required to submit this for review and then present to the class their chosen condition and how to treat it with yoga.</li>\r\n  </ul>\r\n  <ul class="list-group">\r\n    <li class="list-group-item disabled">Kriyas</li>\r\n  <li class="list-group-item"><div class="badge_cstom">Jalaneti</div><div class="badge_cstom">Sutra Neti</div><div class="badge_cstom">Kaphalabati</div><div class="badge_cstom">Trataka</div><div class="badge_cstom">Shankprakshalana</div><div class="badge_cstom">Dhouti</div>\r\n</li>\r\n  </ul>\r\n  <ul class="list-group">\r\n    <li class="list-group-item disabled">Preparatory reading</li>\r\n  <li class="list-group-item">Light on Yoga by B K S Iyengar</li>\r\n  <li class="list-group-item">Yoga: Asanas Pranayama Mudras Kriyas by Vivekananda Kendra Prakashan</li>\r\n  <li class="list-group-item">Raja Yoga by Swami Vivekananda</li>\r\n  <li class="list-group-item">The Forceful Yoga by G. P Bhatt</li>\r\n  <li class="list-group-item">Four Chapters on Freedom by Bihar Yoga</li>\r\n  <li class="list-group-item">Hatha Yoga Pradipika by Swami Muktibodhananda (Bihar Yoga)</li>\r\n  <li class="list-group-item">Asana Pranayama Mudra Bandha by Swami Satyananda Saraswati</li>\r\n  </ul>', 1, NULL, '2017-03-09 04:18:19', '2017-03-09 05:17:19'),
(10, NULL, 'Ashtanga Yoga Level 2', 'ttc', '', NULL, NULL, NULL, 'inr', NULL, NULL, NULL, 'ASHTANGA YOGA LEVEL 2', '', '', 10, '<ul class="list-group">\r\n    <li class="list-group-item disabled">Philosophy</li>\r\n  <li class="list-group-item">In-depth study of all the sutras from chapter 1 &amp; 2 of yoga sutras of patanjali. And selected sutras from chapter 3</li>\r\n  <li class="list-group-item">The 1st &amp; 2nd chapter of hatha yoga.</li>\r\n  <li class="list-group-item">A study of interrelation of Bhagavad gita &amp; yoga sutras.</li>\r\n  <li class="list-group-item">A brief study of the cultural &amp; spiritual heritage of India</li>\r\n  <li class="list-group-item">A detaileds study on the four streams of yoga. Namely; Raja yoga, karma yoga, Bhakti yoga, Gyana yoga</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Anatomy</li>\r\n  <li class="list-group-item">An introduction to anatomy &amp; physiology of human body.</li>\r\n  <li class="list-group-item">Detailed study of the yoga therapy with respect to different ailments.</li>\r\n  <li class="list-group-item">What not to teach for individuals suffering from different ailments.</li>\r\n  <li class="list-group-item">Study of yoga for backache , nervous disorders , bone &amp; women''s health.</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Asana</li>\r\n  <li class="list-group-item">The beginners &amp; intermediate level from The light on Yoga &amp; the first few weeks of advance level for those who wish to push their limits.</li>\r\n  <li class="list-group-item">The complete study of teaching method for becoming an expert in therapy, including the introduction of " Yoga for Motherhood ".</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Pranayama</li>\r\n  <li class="list-group-item">Kapalbhati</li>\r\n  <li class="list-group-item">Bhastrika Pranayama</li>\r\n  <li class="list-group-item">Surya bhedhana pranayama</li>\r\n  <li class="list-group-item">Nadi shodhana pranayama</li>\r\n  <li class="list-group-item">Bhramari pranayama</li>\r\n  <li class="list-group-item text-info"><i>In depth study of all the above pranayama Involves the theoretical study of each of the above &amp; practice sequence too that can be followed for upto 18 months .</i></li>\r\n  <li class="list-group-item text-info"><i>Complete study of chapter 2 of hatha yoga pradapika &amp; study from "light on pranayama" , By B.K.S. Iyenagar</i></li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Meditation</li>\r\n  <li class="list-group-item">There will regularly be short sessions of meditation (around 30-45minutes per session).</li>\r\n  </ul>\r\n  <ul class="list-group">\r\n    <li class="list-group-item disabled">Chanting</li>\r\n  <li class="list-group-item">Yoga shloka</li>\r\n  <li class="list-group-item">Surya Namaskara shloka &amp; 13 mantras</li>\r\n  <li class="list-group-item">Shanti mantra</li>\r\n  <li class="list-group-item">Pranayama shloka</li>\r\n  <li class="list-group-item text-info"><i>The above will be taught to students in person &amp; by the end of the ttc they will be able to chant fluently too so that a part of Sanskrit language, the of all languages stays in them for every.</i></li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Duration and intake</li>\r\n  <li class="list-group-item">Weekday : Every Tuesday , Thursday &amp; Saturday - 2 months</li>\r\n  <li class="list-group-item">Weekends : 3 months</li>\r\n  <li class="list-group-item">A maximum of 10 students/ttc. Individual attention will be given all the students to bring out the best in them.</li>\r\n </ul>\r\n <ul class="list-group">\r\n    <li class="list-group-item disabled">Pre requisites</li>\r\n  <li class="list-group-item">Must have completed the first level of Ashtanga yoga.</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Presentation and yoga therapy</li>\r\n  <li class="list-group-item">Students are required to prepare a mini Students are required to submit this for review and then present to the class their chosen condition and how to treat it with yoga.</li>\r\n  </ul>\r\n  <ul class="list-group">\r\n    <li class="list-group-item disabled">Kriyas</li>\r\n  <li class="list-group-item"><div class="badge_cstom">Jalaneti</div><div class="badge_cstom">Sutra Neti</div><div class="badge_cstom">Kaphalabati</div><div class="badge_cstom">Trataka</div><div class="badge_cstom">Shankprakshalana</div><div class="badge_cstom">Dhouti</div>\r\n</li>\r\n<li class="list-group-item text-info"><i>In addition to learning the technique, students will have the opportunity to gain personal experience in performing these kriyas during the course.</i></li>\r\n  </ul>\r\n  <ul class="list-group">\r\n    <li class="list-group-item disabled">Preparatory reading</li>\r\n  <li class="list-group-item">Light on Yoga by B K S Iyengar</li>\r\n  <li class="list-group-item">Yoga: Asanas Pranayama Mudras Kriyas by Vivekananda Kendra Prakashan</li>\r\n  <li class="list-group-item">Hatha Yoga Pradipika by Swami Muktibodhananda (Bihar Yoga)</li>\r\n  <li class="list-group-item">Asana Pranayama Mudra Bandha by Swami Satyananda Saraswati</li>\r\n  <li class="list-group-item">Light on Pranayama, B.K.S.Iyengar</li>\r\n  </ul>', 1, NULL, '2017-03-09 04:18:19', '2017-03-09 05:17:19'),
(11, NULL, 'Hatha Yoga', 'ttc', '', NULL, NULL, NULL, 'inr', NULL, NULL, NULL, 'ASHTANGA YOGA LEVEL 3', '', '', 10, '<ul class="list-group">\r\n    <li class="list-group-item disabled">Philosophy</li>\r\n  <li class="list-group-item">The complete study of 1st &amp; 2nd chapter of hatha yoga Pradipika</li>\r\n  <li class="list-group-item">Introduction to mudras &amp; Bhadhas as discussed in Hatha yoga pradipika</li>\r\n  <li class="list-group-item">A study of interrelation of Bhagavad gita &amp; yoga sutras.</li>\r\n  <li class="list-group-item">Study of Hatha ratnavali &amp; Gheranda Samhita</li>\r\n  </ul>\r\n  <div class="bg-info text-left pd10 mrgnbtm20"><strong>Shatkarma</strong><i> ( The six main cleansing techniques)</i></div>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Kriyas</li>\r\n  <li class="list-group-item"><div class="badge_cstom">Jalaneti</div><div class="badge_cstom">Sutra Neti</div><div class="badge_cstom">Kaphalabati</div><div class="badge_cstom">Trataka</div><div class="badge_cstom">Shankprakshalana</div><div class="badge_cstom">Dhouti</div>\r\n</li>\r\n<li class="list-group-item text-info"><i>In addition to learning the technique, students will have the opportunity to gain personal experience in performing these kriyas during the course.</i></li>\r\n  </ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Anatomy</li>\r\n  <li class="list-group-item">An introduction to anatomy &amp; physiology of human body.</li>\r\n  <li class="list-group-item">Detailed study of the yoga therapy with respect to different ailments.</li>\r\n  <li class="list-group-item">What not to teach for individuals suffering from different ailments.</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Asana</li>\r\n  <li class="list-group-item">The beginners &amp; intermediate level from The light on Yoga &amp; the first few weeks of advance level for those who wish to push their limits.</li>\r\n  <li class="list-group-item">Asanas as described in the Hatha yoga texts.</li>\r\n  <li class="list-group-item">Sequencing of asanas as described in Hatha yoga.</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Pranayama</li>\r\n  <li class="list-group-item">Kapalbhati</li>\r\n  <li class="list-group-item">Bhastrika Pranayama</li>\r\n  <li class="list-group-item">Surya bhedhana pranayama</li>\r\n  <li class="list-group-item">Nadi shodhana pranayama</li>\r\n  <li class="list-group-item">Bhramari pranayama</li>\r\n  <li class="list-group-item text-info"><i>In depth study of all the above pranayama Involves the theoretical study of each of the above &amp; practice sequence too that can be followed for upto 18 months .</i></li>\r\n  <li class="list-group-item text-info"><i>Complete study of chapter 2 of hatha yoga pradapika &amp; study from "light on pranayama" , By B.K.S. Iyenagar</i></li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Meditation</li>\r\n  <li class="list-group-item">There will regularly be short sessions of meditation (around 30-45minutes per session).</li>\r\n  </ul>\r\n  <ul class="list-group">\r\n    <li class="list-group-item disabled">Chanting</li>\r\n  <li class="list-group-item">Yoga shloka</li>\r\n  <li class="list-group-item">Surya Namaskara shloka &amp; 13 mantras</li>\r\n  <li class="list-group-item">Shanti mantra</li>\r\n  <li class="list-group-item">Pranayama shloka</li>\r\n  <li class="list-group-item text-info"><i>The above will be taught to students in person &amp; by the end of the ttc they will be able to chant fluently too so that a part of Sanskrit language, the of all languages stays in them for every.</i></li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Duration and intake</li>\r\n  <li class="list-group-item">Weekday : Every Tuesday , Thursday &amp; Saturday - 2 months</li>\r\n  <li class="list-group-item">Weekends : 3 months</li>\r\n  <li class="list-group-item">A maximum of 10 students/ttc. Individual attention will be given all the students to bring out the best in them.</li>\r\n </ul>\r\n <ul class="list-group">\r\n    <li class="list-group-item disabled">Pre requisites</li>\r\n  <li class="list-group-item">All are welcome</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Presentation and yoga therapy</li>\r\n  <li class="list-group-item">Students are required to prepare a mini Students are required to submit this for review and then present to the class their chosen condition and how to treat it with yoga.</li>\r\n  </ul>\r\n  \r\n  <ul class="list-group">\r\n    <li class="list-group-item disabled">Preparatory reading</li>\r\n  <li class="list-group-item">Light on Yoga by B K S Iyengar</li>\r\n  <li class="list-group-item">Yoga: Asanas Pranayama Mudras Kriyas by Vivekananda Kendra Prakashan</li>\r\n  <li class="list-group-item">Hatha Yoga Pradipika by Swami Muktibodhananda (Bihar Yoga)</li>\r\n  <li class="list-group-item">Asana Pranayama Mudra Bandha by Swami Satyananda Saraswati</li>\r\n  <li class="list-group-item">Light on Pranayama , B.K.S.Iyengar</li>\r\n  </ul>', 1, NULL, '2017-03-09 04:18:19', '2017-03-09 05:17:19'),
(12, NULL, 'Yoga Therapy', 'ttc', '', NULL, NULL, NULL, 'inr', NULL, NULL, NULL, 'ASHTANGA YOGA LEVEL 4', '', '', 10, '<ul class="list-group">\r\n    <li class="list-group-item disabled">Philosophy</li>\r\n  <li class="list-group-item">Relating the philosophy with its therapeutic insight to every day life of individuals &amp; understanding the root cause of the ailmemts.</li>\r\n  </ul>\r\n  <ul class="list-group">\r\n    <li class="list-group-item disabled">Anatomy</li>\r\n  <li class="list-group-item">A detailed, in-depth study into the anatomy &amp; physiology of human body.</li>\r\n  <li class="list-group-item">Detailed study of the yoga therapy with respect to different ailments.</li>\r\n  <li class="list-group-item">What not to teach for individuals suffering from different ailments.</li>\r\n  <li class="list-group-item">Study of yoga for backache, nervous disorders, digestive disorders, arthritis &amp; women''s health.</li>\r\n  </ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Asana</li>\r\n  <li class="list-group-item">Study &amp; practice of asanas for treating different ailments</li>\r\n  <li class="list-group-item">How to teach with the help of props(Guruji''s technique).</li>\r\n  <li class="list-group-item">Sequences for all the different disabilities &amp; how to help one to overcome them.</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Physiology</li>\r\n  <li class="list-group-item">A brief study of the physiology of the human mind to help them move towards higher consciousness.</li>\r\n  <li class="list-group-item">Practice of different meditational techniques to overcome one''s own inhibitions &amp; help them to achieve unaltered happiness.</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Pranayama</li>\r\n  <li class="list-group-item">Kapalbhati</li>\r\n  <li class="list-group-item">Bhastrika Pranayama</li>\r\n  <li class="list-group-item">Surya bhedhana pranayama</li>\r\n  <li class="list-group-item">Nadi shodhana pranayama</li>\r\n  <li class="list-group-item">Bhramari pranayama</li>\r\n  <li class="list-group-item text-info"><i>In depth study of all the above pranayama Involves the theoretical study of each of the above &amp; practice sequence too that can be followed for upto 18 months .</i></li>\r\n  <li class="list-group-item text-info"><i>Complete study of chapter 2 of hatha yoga pradapika &amp; study from "light on pranayama" , By B.K.S. Iyenagar</i></li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Chanting</li>\r\n  <li class="list-group-item">Yoga shloka</li>\r\n  <li class="list-group-item">Surya Namaskara shloka &amp; 13 mantras</li>\r\n  <li class="list-group-item">Shanti mantra</li>\r\n  <li class="list-group-item">Pranayama shloka</li>\r\n  <li class="list-group-item text-info"><i>The above will be taught to students in person &amp; by the end of the ttc they will be able to chant fluently too so that a part of Sanskrit language, the of all languages stays in them for every.</i></li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Shatkarma (cleansing techniques )</li>\r\n  <li class="list-group-item">Jala neti</li>\r\n  <li class="list-group-item">Sutra neti</li>\r\n  <li class="list-group-item">Shankapakshalana</li>\r\n  <li class="list-group-item">Vamana dhouti</li>\r\n  </ul>\r\n  \r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Duration and intake</li>\r\n  <li class="list-group-item">Weekday : Every Tuesday , Thursday &amp; Saturday - 2 months</li>\r\n  <li class="list-group-item">Weekends : 3 months</li>\r\n  <li class="list-group-item">A maximum of 10 students/ttc. Individual attention will be given all the students to bring out the best in them.</li>\r\n </ul>\r\n <ul class="list-group">\r\n    <li class="list-group-item disabled">Pre requisites</li>\r\n  <li class="list-group-item">Must have completed the first level of Ashtanga yoga/ Hatha yoga</li>\r\n</ul>\r\n<ul class="list-group">\r\n    <li class="list-group-item disabled">Thesis presentation</li>\r\n  <li class="list-group-item">At the end of the course students are advised to write a thesis on 3 ailments &amp; present the paper along with pre, post data.</li>\r\n  <li class="list-group-item">Students are required to present atleast one paper in any one of the medical journal too and they will be assisted for the same.</li>\r\n  </ul>\r\n  \r\n  <ul class="list-group">\r\n    <li class="list-group-item disabled">Books to be referred</li>\r\n  <li class="list-group-item">Yoga therapy, B.K.S.Iyengar</li>\r\n  <li class="list-group-item">Yoga therapy for different ailments, SVYASA</li>\r\n  <li class="list-group-item">Yoga Anatomy</li>\r\n  </ul>', 1, NULL, '2017-03-09 04:18:19', '2017-03-09 05:17:19'),
(13, NULL, NULL, 'class', '', 'weekend', 8, '5111.00', 'INR', NULL, NULL, NULL, '8 Months', '', '', NULL, NULL, 1, NULL, '2017-03-09 01:08:11', '2017-03-09 01:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `image_path` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`) VALUES
(1, 6, 'goa/goa_slide1.jpg'),
(2, 6, 'goa/goa_slide2.jpg'),
(3, 6, 'goa/goa_slide3.jpg'),
(4, 7, 'mysuru/mysuru_slide1.jpg'),
(5, 7, 'mysuru/mysuru_slide2.jpg'),
(6, 7, 'mysuru/mysuru_slide3.jpg'),
(7, 7, 'mysuru/mysuru_slide4.jpg'),
(8, 7, 'mysuru/mysuru_slide5.jpg'),
(9, 8, 'bali/bali_slide1.jpg'),
(10, 8, 'bali/bali_slide2.jpg'),
(11, 8, 'bali/bali_slide3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `retreats`
--

CREATE TABLE IF NOT EXISTS `retreats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(15) DEFAULT NULL,
  `duration` varchar(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `location` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1',
  `amount` decimal(10,0) DEFAULT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `additional_info` varchar(100) DEFAULT NULL,
  `services` varchar(500) DEFAULT NULL,
  `itinerary` varchar(500) DEFAULT NULL,
  `exclusions` varchar(500) DEFAULT NULL,
  `inclusions` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `remarks` varchar(1000) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `image`, `city`, `country`, `is_active`, `created_date`, `updated_date`) VALUES
(2, 'sumit mann', 'da4edf2857529c2ad3cf9c2e0502cb20', 'sumitmann93@gmail.com', '9996300433', 'user.jpg', 'India', 'Panipat', 1, '2017-03-13 19:11:05', NULL),
(3, 'sumit mann', 'da4edf2857529c2ad3cf9c2e0502cb20', 'sumitmann@outlook.com', '9898989898', 'user.jpg', 'India', 'Panipat', 1, '2017-03-15 21:32:13', '2017-03-25 16:38:20'),
(7, NULL, 'da4edf2857529c2ad3cf9c2e0502cb20', 'sumitmann93@yahoo.com', '9898989898', 'user.jpg', 'India', 'Panipat', 1, '2017-03-21 21:02:28', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
