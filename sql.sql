-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.24-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema list
--

CREATE DATABASE IF NOT EXISTS list;
USE list;

--
-- Definition of table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `userID` int(10) unsigned DEFAULT '0',
  `linkCount` int(10) unsigned DEFAULT '0',
  `url` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`,`name`,`userID`,`linkCount`,`url`) VALUES 
 (1,'Health',0,0,'health'),
 (2,'Entertainment',0,0,'entertainment'),
 (3,'Technology',0,0,'technology'),
 (4,'science',2,1,'science'),
 (5,'Cars',2,1,'cars');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;


--
-- Definition of table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itemID` int(10) unsigned NOT NULL,
  `text` varchar(360) NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IndexCommentItemID` (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


--
-- Definition of table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topicID` int(10) unsigned NOT NULL,
  `text` varchar(120) NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `voteUp` int(10) unsigned DEFAULT '0',
  `voteDown` int(10) unsigned DEFAULT '0',
  `createdOn` int(10) unsigned NOT NULL,
  `commentCount` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IndexItemTopicID` (`topicID`)
) ENGINE=InnoDB AUTO_INCREMENT=287 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` (`id`,`topicID`,`text`,`userID`,`voteUp`,`voteDown`,`createdOn`,`commentCount`) VALUES 
 (39,53,'The Shawshank Redemption',2,3,NULL,1359301603,0),
 (40,53,'The Godfather',2,1,NULL,1359301603,0),
 (41,53,'Pulp Fiction',2,1,NULL,1359301603,0),
 (42,53,'Schindler\'s List',2,2,0,1359301603,0),
 (43,53,'Fight Club',2,1,NULL,1359301603,0),
 (44,54,'Check Out the Company',2,NULL,NULL,1359301688,0),
 (45,54,'Dress for Interview Success',2,1,NULL,1359301688,0),
 (46,54,'Improve Your Interview Technique',2,NULL,NULL,1359301688,0),
 (47,54,'Prepare for a Phone Interview',2,1,NULL,1359301688,0),
 (48,54,'Practice Interviewing',2,NULL,NULL,1359301688,0),
 (49,54,'Use Your Contacts',2,1,NULL,1359301688,0),
 (50,54,'Take the Time to Say Thank You',2,1,NULL,1359301688,0),
 (51,55,'Kapalıçarşı',2,2,1,1359301847,0),
 (52,55,'Beylerbeyi',2,0,0,1359301847,0),
 (53,55,'Gülhane Parkı',2,0,1,1359301847,0),
 (54,55,'Moda',2,1,0,1359301847,0),
 (55,55,'Bağdat Caddesi',2,2,1,1359301848,0),
 (56,56,'Do your research',2,1,NULL,1359302511,0),
 (57,56,'Understand the basic procedures',2,NULL,NULL,1359302511,0),
 (58,56,'Choose the right equipment for you',2,1,NULL,1359302511,0),
 (59,56,'The bait is the main course of fishing ',2,NULL,NULL,1359302511,0),
 (60,56,'Location, location, location',2,0,NULL,1359302511,0),
 (61,56,'Check the weather',2,1,NULL,1359302511,0),
 (62,56,'Dress for success',2,1,NULL,1359302511,0),
 (63,56,'Bring food',2,NULL,NULL,1359302511,0),
 (64,56,'Bug Spray!',2,NULL,NULL,1359302511,0),
 (65,56,'No children, no worries',2,NULL,NULL,1359302511,0),
 (66,56,'Check some videos',3,NULL,NULL,1359303377,0),
 (67,57,'dfsfasdf',2,NULL,NULL,1359395075,0),
 (68,57,'asdfadsfasdf',2,NULL,NULL,1359395075,0),
 (69,57,'asdfasdf',2,NULL,NULL,1359395075,0),
 (70,58,'Rıhtım',2,NULL,NULL,1359396537,0),
 (71,58,'Rıhtımsız',2,NULL,NULL,1359396537,0),
 (72,58,'Rıhtımlı',2,NULL,NULL,1359396537,0),
 (73,55,'kız kulesi',8,2,1,1359402212,0),
 (74,55,'nişantaşı',8,0,1,1359402212,0),
 (75,55,'sultan ahmet',8,1,0,1359402212,0),
 (76,59,'nüfus cuzdanı',8,NULL,NULL,1359402770,0),
 (77,59,'tc kimlik numarası',8,1,NULL,1359402770,0),
 (78,59,'ücret bordrosu',8,NULL,NULL,1359402771,0),
 (79,59,'banka:)',8,1,NULL,1359402771,0),
 (80,59,'temiz sicil',8,1,NULL,1359402771,0),
 (81,59,'kefil',8,NULL,NULL,1359402771,0),
 (82,60,'Pixelplus Interactive',3,NULL,NULL,1359402816,0),
 (83,60,'Ping Digital',3,NULL,NULL,1359402816,0),
 (84,60,'Wanda Digital',3,NULL,NULL,1359402816,0),
 (85,60,'Promoqube',3,NULL,NULL,1359402816,0),
 (86,60,'41? 29!',3,NULL,NULL,1359402816,0),
 (87,60,'McCann',3,NULL,NULL,1359402816,0),
 (88,60,'Wunderman',3,NULL,NULL,1359402816,0),
 (89,60,'UNC Digital',3,NULL,NULL,1359402816,0),
 (90,59,'biraz da şans',2,2,NULL,1359402827,0),
 (91,55,'İstanbul Modern Sanat',9,2,NULL,1359403168,0),
 (92,61,'ilham',8,1,NULL,1359403174,0),
 (93,61,'şair',8,NULL,NULL,1359403186,0),
 (94,61,'kalem',8,0,NULL,1359403197,0),
 (95,61,'aşk',8,1,NULL,1359403203,0),
 (96,61,'doğa',8,NULL,NULL,1359403212,0),
 (97,55,'Büyük ada',9,1,NULL,1359403238,0),
 (98,61,'kalem',2,1,NULL,1359403350,0),
 (99,61,'kağıt',2,1,NULL,1359403350,0),
 (100,61,'ince ruh',8,1,NULL,1359403499,0),
 (101,61,'edebiyat',8,1,NULL,1359403499,0),
 (102,62,'Bere',9,1,NULL,1359403550,0),
 (103,62,'Atkı',9,1,NULL,1359403550,0),
 (104,62,'Çanta',9,1,NULL,1359403550,0),
 (105,62,'Şal',9,NULL,NULL,1359403550,0),
 (106,62,'Cüzdan',9,NULL,NULL,1359403550,0),
 (107,62,'Küpe',9,1,NULL,1359403550,0),
 (108,62,'Kolye',9,1,NULL,1359403550,0),
 (109,62,'Saat',9,1,NULL,1359403550,0),
 (110,62,'Eldiven',9,1,NULL,1359403562,0),
 (111,62,'Yüzük',9,1,NULL,1359403572,0),
 (112,63,'Fenerbahçe',9,3,NULL,1359403685,0),
 (113,63,'Galatasaray',9,NULL,NULL,1359403685,0),
 (114,63,'Beşiktaş',9,NULL,NULL,1359403685,0),
 (115,63,'Trabzon',9,NULL,NULL,1359403685,0),
 (116,63,'Akhisar Spor',9,1,NULL,1359403685,0),
 (117,62,'Ayakkabı',9,3,NULL,1359403722,0),
 (118,62,'Çizme',9,NULL,NULL,1359403722,0),
 (119,62,'Toka',8,NULL,NULL,1359403837,0),
 (120,62,'Yaka',8,1,1,1359403837,0),
 (121,64,'Kovboy filmi izlemek',3,2,NULL,1359403837,0),
 (122,64,'Muhteşem bir kahvaltı',3,NULL,NULL,1359403837,0),
 (123,64,'Öğlene kadar uyumak',3,NULL,NULL,1359403837,0),
 (124,64,'Alışveriş',3,NULL,NULL,1359403837,0),
 (125,64,'Temizlik',3,1,1,1359403838,0),
 (126,65,'gelin',8,1,1,1359404103,0),
 (127,65,'damat',8,1,1,1359404103,0),
 (128,65,'gelinlik',8,0,0,1359404103,0),
 (129,65,'smokin',8,NULL,NULL,1359404103,0),
 (130,65,'nikah memuru',8,1,NULL,1359404103,0),
 (131,65,'nikah tarihi',8,NULL,NULL,1359404103,0),
 (132,65,'ev',8,NULL,NULL,1359404104,0),
 (133,60,'Pure New Media',3,NULL,NULL,1359404453,0),
 (134,60,'Clockwork',3,NULL,NULL,1359404453,0),
 (135,60,'Likeable Istanbul',3,NULL,NULL,1359404453,0),
 (136,60,'Rabarba',3,NULL,NULL,1359404453,0),
 (137,60,'Sosyopath',3,NULL,NULL,1359404453,0),
 (138,60,'MagiClick',3,NULL,NULL,1359404453,0),
 (139,60,'Voden',3,NULL,NULL,1359404453,0),
 (140,60,'Project House',3,NULL,NULL,1359404453,0),
 (141,60,'Kollektif',3,NULL,NULL,1359404454,0),
 (142,60,' Alafortanfoni',3,NULL,NULL,1359404454,0),
 (143,60,'C-Section',3,NULL,NULL,1359404454,0),
 (144,65,'balayı',8,1,NULL,1359404477,0),
 (145,65,'aile büyükleri',8,1,NULL,1359404495,0),
 (146,66,'Facebook',3,1,NULL,1359404580,0),
 (147,66,'Twitter',3,3,NULL,1359404580,0),
 (148,66,'Foursquare',3,NULL,NULL,1359404580,0),
 (149,66,'Instagram',3,2,NULL,1359404580,0),
 (150,66,'Tumblr',3,1,NULL,1359404580,0),
 (151,66,'YouTube',3,0,0,1359404580,0),
 (152,66,'Pinterest',3,2,NULL,1359404580,0),
 (153,66,'Vimeo',3,NULL,NULL,1359404580,0),
 (154,66,'Google Plus',3,NULL,NULL,1359404580,0),
 (155,66,'Linkedin',3,NULL,NULL,1359404580,0),
 (156,67,'dağcılık',8,NULL,NULL,1359404685,0),
 (157,67,'snowboard',8,NULL,NULL,1359404827,0),
 (158,67,'boks',8,NULL,NULL,1359404827,0),
 (159,67,'futbol',8,NULL,NULL,1359404827,0),
 (160,67,'araba-motor yarışı',8,NULL,NULL,1359404827,0),
 (161,67,'yamaç paraşütü',8,2,NULL,1359404827,0),
 (162,68,'Tuzlu kurabiye',3,1,NULL,1359404858,0),
 (163,68,'Tatlı kurabiye',3,NULL,NULL,1359404858,0),
 (164,68,'Kek',3,1,1,1359404858,0),
 (165,68,'Poğaça',3,NULL,NULL,1359404858,0),
 (166,68,'Simit',3,NULL,NULL,1359404859,0),
 (167,69,'Deniz',3,2,NULL,1359405045,0),
 (168,69,'Kum',3,NULL,NULL,1359405045,0),
 (169,69,'Güneş',3,NULL,NULL,1359405045,0),
 (170,69,'Yayla evi',3,2,NULL,1359405045,0),
 (171,69,'Karavana',3,NULL,1,1359405045,0),
 (172,70,'Vosvos',3,NULL,NULL,1359405093,0),
 (173,70,'Nissan Micra',3,NULL,NULL,1359405093,0),
 (174,70,'Fiat 500',3,1,NULL,1359405093,0),
 (175,71,'papatya',8,2,0,1359405215,0),
 (176,71,'gül',8,NULL,NULL,1359405215,0),
 (177,71,'menekşe',8,2,NULL,1359405215,0),
 (178,71,'nergis',8,NULL,NULL,1359405216,0),
 (179,71,'lale',8,1,NULL,1359405216,0),
 (180,71,'kasımpatı',8,NULL,NULL,1359405216,0),
 (181,71,'karanfil',8,1,NULL,1359405216,0),
 (182,71,'sarmaşık',8,NULL,NULL,1359405216,0),
 (183,71,'atatürk çiçeği',8,NULL,NULL,1359405216,0),
 (184,71,'lavanta',8,0,NULL,1359405216,0),
 (185,71,'orkide',8,1,NULL,1359405216,0),
 (186,72,'Amour',9,NULL,NULL,1359405425,0),
 (187,72,'Argo',9,NULL,NULL,1359405425,0),
 (188,72,'Beasts of the Southern Wild',9,NULL,NULL,1359405425,0),
 (189,72,'Django Unchained',9,1,1,1359405425,0),
 (190,72,'Les Misérables',9,1,NULL,1359405425,0),
 (191,72,'Life of Pi',9,NULL,NULL,1359405425,0),
 (192,72,'Lincoln',9,NULL,NULL,1359405425,0),
 (193,72,'Silver Linings Playbook',9,NULL,NULL,1359405425,0),
 (194,72,'Zero Dark Thirty',9,NULL,NULL,1359405425,0),
 (195,73,'Wunderlist',9,1,NULL,1359405589,0),
 (196,73,'Any.do',9,NULL,NULL,1359405589,0),
 (197,73,'Google tasks',9,NULL,NULL,1359405589,0),
 (198,73,'Remember the milk',9,1,NULL,1359405589,0),
 (199,53,'Inception',9,1,NULL,1359405674,0),
 (200,66,'Fancy',3,NULL,NULL,1359405703,0),
 (201,53,'The notebook',8,1,NULL,1359406007,0),
 (202,53,'Sherlock holmes',8,1,NULL,1359406007,0),
 (203,53,'Gladiator',9,2,NULL,1359406064,0),
 (204,70,'Mini Cooper',3,1,NULL,1359406216,0),
 (205,70,'Smart',3,NULL,NULL,1359406216,0),
 (206,53,'Sweet Nowember',8,1,NULL,1359406247,0),
 (207,53,'Eşkiya',8,1,NULL,1359406247,0),
 (208,53,'A Beautiful Mind',8,1,NULL,1359406353,0),
 (209,53,'The Sixth Sense',8,1,NULL,1359406388,0),
 (210,74,'Star Tv',8,NULL,NULL,1359406786,0),
 (211,74,'VJ',8,1,NULL,1359406786,0),
 (212,74,'Alf',8,1,NULL,1359406786,0),
 (213,74,'Neon Renkli Taytlar',8,NULL,NULL,1359406786,0),
 (214,74,'Perma',8,2,NULL,1359406786,0),
 (215,74,'Saç Bandı',8,2,NULL,1359406786,0),
 (216,75,'Arkadaşlarla havuz keyfi yapmak',3,1,NULL,1359406791,0),
 (217,75,'Festivallere katılmak ',3,NULL,NULL,1359406791,0),
 (218,75,'İş çıkışı bir mekana gidip arkadaşlarla soğuk bira içmek',3,NULL,NULL,1359406791,0),
 (219,75,'Açık hava film festivallerine gitmek',3,NULL,NULL,1359406791,0),
 (220,76,'Kenter Tiyatrosu',8,1,NULL,1359407047,0),
 (221,76,'Oyun Atolyesi',8,2,NULL,1359407091,0),
 (222,76,'Zakoğlu Oda Tiyatrosu',8,NULL,NULL,1359407091,0),
 (223,76,'Üsküdar Tekel Sahnesi',8,NULL,NULL,1359407092,0),
 (224,76,'Krek',8,NULL,NULL,1359407132,0),
 (225,76,'Mekan Artı',8,NULL,NULL,1359407178,0),
 (226,77,'Let it Be',9,1,NULL,1359407512,0),
 (227,77,'All My Loving',9,1,NULL,1359407512,0),
 (228,77,'Strawberry Fields Forever',9,1,NULL,1359407512,0),
 (229,77,'Come Together',9,1,NULL,1359407512,0),
 (230,77,'Yesterday',9,1,NULL,1359407512,0),
 (231,78,'Avoid “white” carbohydrates',9,1,NULL,1359407903,0),
 (232,78,'Eat the same few meals over and over again',9,1,NULL,1359407903,0),
 (233,78,'Don’t drink calories',9,1,NULL,1359407903,0),
 (234,78,'Take one day off per week',9,1,NULL,1359407903,0),
 (235,79,'Bluehost',9,1,NULL,1359408653,0),
 (236,79,'Inmotion hosting',9,NULL,NULL,1359408654,0),
 (237,79,'Web Hosting hub',9,NULL,NULL,1359408654,0),
 (238,79,'Dream Host',9,NULL,NULL,1359408654,0),
 (239,79,'WP Engine',9,1,NULL,1359408654,0),
 (240,79,'HostGator',9,1,NULL,1359408654,0),
 (241,80,'Harry Potter and the Sorcerer\'s Stone',9,NULL,NULL,1359408862,0),
 (242,80,'Harry Potter and the Chamber of Secrets',9,NULL,NULL,1359408862,0),
 (243,80,'Harry Potter and the Prisoner of Azkaban',9,1,NULL,1359408862,0),
 (244,80,'Harry Potter and the Goblet of Fire',9,2,NULL,1359408862,0),
 (245,80,'Harry Potter and the Order of the Phoenix',9,NULL,NULL,1359408862,0),
 (246,80,'Harry Potter and the Half-Blood Prince',9,NULL,1,1359408862,0),
 (247,80,'Harry Potter and the Deathly Hallows: Part 1',9,1,NULL,1359408862,0),
 (248,80,'Harry Potter and the Deathly Hallows: Part 2',9,1,NULL,1359408862,0),
 (249,81,'Star Wars: Episode I - The Phantom Menace ',9,2,NULL,1359409010,0),
 (250,81,'Star Wars: Episode II - Attack of the Clones',9,1,NULL,1359409010,0),
 (251,81,'Star Wars: Episode III - Revenge of the Sith',9,1,NULL,1359409010,0),
 (252,81,'Star Wars: Episode IV - A New Hope',9,1,NULL,1359409010,0),
 (253,81,'Star Wars: Episode V - The Empire Strikes Back',9,1,NULL,1359409010,0),
 (254,81,'Star Wars: Episode VI - Return of the Jedi',9,1,NULL,1359409010,0),
 (255,82,'Google Search',9,1,0,1359409285,0),
 (256,82,'Google Maps',9,0,0,1359409285,0),
 (257,82,'Google Glass',9,2,NULL,1359409285,0),
 (258,82,'Gmail',9,0,NULL,1359409285,0),
 (259,82,'Google Analytics',9,0,NULL,1359409285,0),
 (260,82,'Google+',9,0,NULL,1359409285,0),
 (261,82,'Google Reader',9,0,NULL,1359409285,0),
 (262,82,'Youtube',9,NULL,NULL,1359409286,0),
 (263,82,'Google Drive',9,NULL,NULL,1359409286,0),
 (264,82,'Zeitgeist',9,NULL,NULL,1359409286,0),
 (265,83,'Enter first item here',2,NULL,NULL,1359487077,0),
 (266,84,'asdf',2,NULL,NULL,1359487285,0),
 (267,55,'Kuzguncuk',8,1,NULL,1359580028,0),
 (268,85,'Atatürk',8,2,NULL,1359581213,0),
 (269,85,'Obama',8,NULL,NULL,1359581213,0),
 (270,85,'Hitler',8,1,NULL,1359581213,0),
 (271,85,'Kanuni',8,NULL,NULL,1359581213,0),
 (272,85,'Bill Clinton',8,NULL,NULL,1359581213,0),
 (273,85,'Che',8,1,NULL,1359581213,0),
 (274,85,'Benazir Bhutto',8,1,NULL,1359581217,0),
 (275,85,'George W. Bush',2,NULL,NULL,1359581299,0),
 (276,86,'iPhone',3,NULL,NULL,1359829597,0),
 (277,86,'Galaxy',3,NULL,NULL,1359829597,0),
 (278,87,'Şahan Gökbakar',2,NULL,NULL,1359829866,0),
 (279,87,'Cem Yılmaz',2,NULL,NULL,1359829866,0),
 (280,88,'Kuzey Güney',2,NULL,NULL,1359829913,0),
 (281,88,'Doğu Batı',2,NULL,NULL,1359829914,0),
 (282,88,'Doğu Kuzey',2,NULL,NULL,1359829914,0),
 (283,89,'Not',2,NULL,NULL,1359829973,0),
 (284,89,'Nor',2,NULL,NULL,1359829973,0),
 (285,90,'deneme',2,NULL,NULL,1359831213,0),
 (286,90,'deneme',2,NULL,NULL,1359831213,0);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;


--
-- Definition of table `registerticket`
--

DROP TABLE IF EXISTS `registerticket`;
CREATE TABLE `registerticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `qty` int(10) unsigned NOT NULL,
  `lastUsedOn` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registerticket`
--

/*!40000 ALTER TABLE `registerticket` DISABLE KEYS */;
INSERT INTO `registerticket` (`id`,`code`,`qty`,`lastUsedOn`) VALUES 
 (1,'qubist',95,1359743110);
/*!40000 ALTER TABLE `registerticket` ENABLE KEYS */;


--
-- Definition of table `topic`
--

DROP TABLE IF EXISTS `topic`;
CREATE TABLE `topic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `title` varchar(60) NOT NULL,
  `createdOn` int(10) unsigned NOT NULL,
  `rate` int(10) unsigned NOT NULL,
  `url` varchar(60) NOT NULL,
  `inviteCode` varchar(16) NOT NULL,
  `viewCount` int(10) unsigned DEFAULT '0',
  `editorsPick` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IndexTitle` (`title`),
  KEY `IndexURL` (`url`),
  KEY `IndexInviteCode` (`inviteCode`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 PACK_KEYS=1;

--
-- Dumping data for table `topic`
--

/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id`,`userID`,`title`,`createdOn`,`rate`,`url`,`inviteCode`,`viewCount`,`editorsPick`) VALUES 
 (53,2,'Best movies of all time',1359301603,0,'best-movies-of-all-time','123456784',77,1),
 (54,2,'Top Interview Tips',1359301688,0,'top-interview-tips','123456785',10,0),
 (55,2,'Istanbul\'da görülmesi gereken yerler',1359301847,0,'istanbulda-görülmesi-gereken-yerler','123456786',93,1),
 (56,2,'Top 10 Fishing Tips for Beginners',1359302510,0,'top--fishing-tips-for-beginners','123456787',0,0),
 (59,8,'kredi almak için gerekenler',1359402770,0,'kredi-almak-icin-gerekenler','9lyU3sGHXnB7j9x2',2,0),
 (60,3,'Türkiye\'deki sosyal medya ajansları',1359402816,0,'turkiyedeki-sosyal-medya-ajanslari','iNtRSOLcDmUhMgRI',98,1),
 (61,8,'şiir yazmak için ne gerekir?',1359403174,0,'siir-yazmak-icin-ne-gerekir','x9hUDyU2RnsrFH9X',0,0),
 (62,9,'2013 en popüler bayan aksesuar',1359403550,0,'-en-populer-bayan-aksesuar','2T6BC3Awe8Mz7WFm',74,1),
 (63,9,'2012-2013 türkiye süper lig şampiyonu kim olur',1359403685,0,'-turkiye-super-lig-sampiyonu-kim-olur','38HWsKkdR9K9Jrbz',0,0),
 (64,3,'Pazar günü klasiği',1359403837,0,'pazar-gunu-klasigi','ZPHW4ERX3JBtbWV4',0,0),
 (65,8,'Evlilik hazırlıkları sırasında unutulmaması gerekenler',1359404103,0,'evlilik-hazirliklari-sirasinda-unutulmamasi-gereken-en-oneml','7pcMPfOdpe6FlthZ',1,0),
 (66,3,'Popüler sosyal platformlar',1359404580,0,'populer-sosyal-platformlar','zz4vACG5lcP3koKh',0,0),
 (67,8,'adrenali yüksek sporlar',1359404685,0,'adrenali-yuksek-sporlar','ot2LkdEyi8lEgRPo',0,0),
 (68,3,'5 çayının yanına ne hazırlanmalı?',1359404858,0,'-cayinin-yanina-ne-hazirlanmali','uP94jAfiKfMihUWU',0,0),
 (69,3,'Tatil denilince...',1359405045,0,'tatil-denilince','Sbst08yRCoWnd1QT',0,0),
 (70,3,'Bayanlara giden araba modelleri',1359405093,0,'bayanlara-giden-araba-modelleri','1cmOewtKk1gHKLWw',0,0),
 (71,8,'annelerin çiçekleri',1359405215,0,'annelerin-cicekleri','tmdxZTkCfYZ5JGpO',0,0),
 (72,9,'Who will get Oscar for Best Motion Picture 2013',1359405424,0,'who-will-get-oscar-for-best-motion-picture-','UEmcq9XsrMFgygP6',0,0),
 (73,9,'Best online list application',1359405589,0,'best-online-list-application','oGy48HJRikP4e2WV',0,0),
 (74,8,'90\'lar deyince',1359406786,0,'90lar-deyince','xZZ58nbiHIlKBsAE',53,1),
 (75,3,'Yaz mevsiminde yapılan etkinlikler',1359406791,0,'yaz-mevsiminde-yapilan-etkinlikler','JCYJEizKXDki6Itc',1,0),
 (76,8,'İstanbul\'un En iyi Tiyatroları',1359407046,0,'istanbulun-en-iyi-tiyatrolari','HztIiw8ahi8JXlAD',0,0),
 (77,9,'Best songs of The Beatles',1359407512,0,'best-songs-of-the-beatles','3aIPh2iZLXV4X1OS',1,0),
 (78,9,'Lose 10 kg of fat in 30 days',1359407903,0,'lose-10-kg-of-fat-in-30-days','bD3zjDGLbk0X9bak',69,1),
 (79,9,'Best Wordpress Hosting Providers',1359408653,0,'best-wordpress-hosting-providers','aBgSezBt5cpWYiET',0,0),
 (80,9,'Best Harry Potter Movie',1359408862,0,'best-harry-potter-movie','19JDbIO5rQZnb0mK',82,1),
 (81,9,'Best Star Wars Movie',1359409010,0,'best-star-wars-movie','QNGLSoKA2oKGNUSS',0,0),
 (82,9,'Which Google product do you think is the best',1359409285,0,'which-google-product-do-you-think-is-the-best','6wRysjVwNUM8BoEe',0,0),
 (85,8,'Tarihte en çok ses getiren liderler..',1359581212,0,'tarihte-en-cok-ses-getiren-liderler','vc7u23tAk80T7Ocv',10,NULL),
 (86,3,'iPhone mu, yoksa Galaxy mi?',1359829597,0,'iphone-mu-yoksa-galaxy-mi','mRs0L3Fz5d7uPs1z',2,NULL),
 (87,2,'Ünlü komedyenler',1359829866,0,'unlu-komedyenler','Wm5bU0y9F07PIs04',1,NULL),
 (88,2,'En iyi diziler',1359829913,0,'en-iyi-diziler','0WWc1y84ITk1y2IU',1,NULL),
 (89,2,'What is science?',1359829973,0,'what-is-science','xC036GskdRK3ne85',24,NULL),
 (90,2,'Deneme',1359831213,0,'deneme','wniL9quVcVpVa0gB',48,1);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;


--
-- Definition of table `topiccategorylink`
--

DROP TABLE IF EXISTS `topiccategorylink`;
CREATE TABLE `topiccategorylink` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topicID` int(10) unsigned NOT NULL,
  `categoryID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topiccategorylink`
--

/*!40000 ALTER TABLE `topiccategorylink` DISABLE KEYS */;
INSERT INTO `topiccategorylink` (`id`,`topicID`,`categoryID`) VALUES 
 (1,88,2),
 (2,89,4),
 (3,90,2),
 (4,90,3),
 (5,90,1),
 (6,90,5);
/*!40000 ALTER TABLE `topiccategorylink` ENABLE KEYS */;


--
-- Definition of table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(18) CHARACTER SET latin1 NOT NULL,
  `lastLogin` int(10) unsigned NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `profession` tinyint(3) unsigned DEFAULT NULL,
  `mailSettings` varchar(45) DEFAULT NULL,
  `loginCount` int(10) unsigned DEFAULT '0',
  `validationCode` varchar(16) NOT NULL,
  `photo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`,`email`,`password`,`lastLogin`,`fullname`,`bio`,`url`,`profession`,`mailSettings`,`loginCount`,`validationCode`,`photo`) VALUES 
 (2,'mecevit@gmail.com','hotmailer',1359196267,'Mehmet Ecevit','Serial Entrepreneur','http://twitter.com/mecevit',NULL,'1,1',0,'zQHWR3pWFXGLY8gI','2lpEjnf'),
 (3,'sedefecevit@gmail.com','pencerex',1359293153,'Sedef','Social media specialist at Ping','http://twitter.com/SedefEcevit',NULL,NULL,0,'a0zXXoppHr617w9T','3V6AcSG'),
 (8,'haticeey@gmail.com','111903',1359402169,'Hatice',NULL,NULL,NULL,NULL,0,'',NULL),
 (9,'arman.eker@gmail.com','3412249',1359403140,'Arman',NULL,NULL,NULL,NULL,0,'',NULL),
 (14,'mehmet@gram.gs','hotmailer',1359576129,'Mehmet',NULL,NULL,NULL,NULL,0,'',NULL),
 (16,'m_ecevit@hotmail.com','hotmail3r',1359743110,'Mehmet Ecevit','','',NULL,NULL,NULL,'BuU55s3YxXSrMX0d',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


--
-- Definition of table `usercategorylink`
--

DROP TABLE IF EXISTS `usercategorylink`;
CREATE TABLE `usercategorylink` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `categoryID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usercategorylink`
--

/*!40000 ALTER TABLE `usercategorylink` DISABLE KEYS */;
/*!40000 ALTER TABLE `usercategorylink` ENABLE KEYS */;


--
-- Definition of table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itemID` int(10) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `rate` tinyint(3) NOT NULL,
  `createdOn` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IndexItem` (`itemID`),
  KEY `IndexItemUser` (`userID`,`itemID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=306 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vote`
--

/*!40000 ALTER TABLE `vote` DISABLE KEYS */;
INSERT INTO `vote` (`id`,`itemID`,`userID`,`rate`,`createdOn`) VALUES 
 (78,50,2,1,1359301709),
 (79,39,2,1,1359301717),
 (84,53,2,-1,1359384172),
 (86,40,2,1,1359396741),
 (87,41,2,1,1359396742),
 (88,61,2,1,1359396749),
 (89,62,2,1,1359396749),
 (90,56,2,1,1359396752),
 (91,58,2,1,1359396754),
 (92,45,2,1,1359399242),
 (93,47,2,1,1359399243),
 (94,49,2,1,1359399244),
 (109,55,8,-1,1359402254),
 (110,51,8,-1,1359402255),
 (119,54,8,1,1359402553),
 (125,55,3,1,1359402615),
 (128,51,3,1,1359402624),
 (129,77,8,1,1359402815),
 (130,79,8,1,1359402817),
 (131,80,8,1,1359402820),
 (132,90,2,1,1359402830),
 (133,90,8,1,1359402872),
 (134,73,9,1,1359403153),
 (135,51,9,1,1359403155),
 (137,55,9,1,1359403175),
 (138,43,9,1,1359403327),
 (139,39,9,1,1359403328),
 (140,98,2,1,1359403351),
 (144,100,8,1,1359403504),
 (145,101,8,1,1359403505),
 (146,97,8,1,1359403523),
 (150,103,9,1,1359403554),
 (151,102,9,1,1359403554),
 (152,110,9,1,1359403563),
 (153,111,9,1,1359403573),
 (154,112,9,1,1359403693),
 (155,116,9,1,1359403694),
 (156,117,9,1,1359403744),
 (157,117,2,1,1359403748),
 (158,117,8,1,1359403773),
 (159,99,2,1,1359403829),
 (160,104,8,1,1359403848),
 (161,121,3,1,1359403857),
 (162,125,8,-1,1359403872),
 (163,112,8,1,1359403891),
 (164,121,2,1,1359403908),
 (165,125,2,1,1359404050),
 (167,127,8,-1,1359404214),
 (169,127,3,1,1359404262),
 (172,74,8,-1,1359404330),
 (174,91,8,1,1359404352),
 (175,75,8,1,1359404386),
 (176,91,2,1,1359404424),
 (178,73,2,-1,1359404440),
 (179,112,2,1,1359404487),
 (180,144,2,1,1359404499),
 (181,126,2,-1,1359404503),
 (182,146,8,1,1359404589),
 (183,147,8,1,1359404590),
 (184,149,8,1,1359404591),
 (185,150,8,1,1359404597),
 (187,152,8,1,1359404601),
 (188,147,2,1,1359404707),
 (189,152,2,1,1359404709),
 (190,164,8,1,1359404875),
 (193,126,8,1,1359404912),
 (194,145,8,1,1359404941),
 (195,95,8,1,1359405009),
 (196,92,8,1,1359405014),
 (198,162,2,1,1359405036),
 (199,164,2,-1,1359405037),
 (200,170,2,1,1359405081),
 (201,171,2,-1,1359405087),
 (203,170,3,1,1359405131),
 (204,175,8,1,1359405224),
 (205,177,8,1,1359405225),
 (206,185,8,1,1359405227),
 (208,179,8,1,1359405239),
 (209,181,8,1,1359405240),
 (211,147,9,1,1359405261),
 (212,167,8,1,1359405263),
 (213,149,9,1,1359405265),
 (214,174,2,1,1359405267),
 (215,161,8,1,1359405284),
 (216,177,3,1,1359405318),
 (217,190,9,1,1359405429),
 (218,189,2,1,1359405442),
 (219,195,9,1,1359405591),
 (222,199,9,1,1359405683),
 (223,198,2,1,1359405747),
 (224,203,9,1,1359406068),
 (226,206,8,1,1359406251),
 (227,202,8,1,1359406255),
 (228,201,8,1,1359406257),
 (229,42,8,1,1359406267),
 (230,203,8,1,1359406275),
 (231,39,8,1,1359406304),
 (234,161,9,1,1359406452),
 (235,214,2,1,1359406821),
 (237,216,2,1,1359406833),
 (240,204,8,1,1359406883),
 (241,215,3,1,1359406934),
 (242,221,3,1,1359407127),
 (243,221,8,1,1359407186),
 (244,220,8,1,1359407187),
 (245,42,2,1,1359407465),
 (246,226,9,1,1359407514),
 (247,227,9,1,1359407515),
 (248,228,9,1,1359407516),
 (249,229,9,1,1359407517),
 (250,230,9,1,1359407518),
 (251,235,9,1,1359408657),
 (252,240,9,1,1359408660),
 (253,239,9,1,1359408661),
 (254,244,9,1,1359408874),
 (255,247,9,1,1359408877),
 (256,248,9,1,1359408878),
 (257,249,9,1,1359409013),
 (258,250,9,1,1359409015),
 (259,251,9,1,1359409015),
 (260,252,9,1,1359409016),
 (261,253,9,1,1359409017),
 (262,254,9,1,1359409018),
 (271,255,9,1,1359409329),
 (272,257,2,1,1359445076),
 (273,249,2,1,1359445523),
 (274,243,2,1,1359449381),
 (275,246,2,-1,1359449390),
 (276,175,2,1,1359491575),
 (277,167,9,1,1359533709),
 (278,231,9,1,1359533795),
 (279,232,9,1,1359533795),
 (280,233,9,1,1359533796),
 (281,234,9,1,1359533797),
 (282,257,9,1,1359533860),
 (283,189,9,-1,1359540241),
 (284,244,2,1,1359574526),
 (285,108,2,1,1359578234),
 (286,107,2,1,1359578242),
 (287,109,2,1,1359578250),
 (288,120,2,-1,1359578255),
 (289,211,8,1,1359579923),
 (291,214,8,1,1359579929),
 (292,215,8,1,1359579931),
 (293,267,8,1,1359580031),
 (294,73,8,1,1359580046),
 (295,207,8,1,1359580073),
 (296,208,8,1,1359580075),
 (297,209,8,1,1359580077),
 (298,268,8,1,1359581225),
 (299,273,8,1,1359581229),
 (300,274,8,1,1359581230),
 (301,270,8,1,1359581232),
 (302,268,2,1,1359581286),
 (303,130,8,1,1359581534),
 (304,120,3,1,1359808911),
 (305,212,3,1,1359808972);
/*!40000 ALTER TABLE `vote` ENABLE KEYS */;


--
-- Definition of table `writer`
--

DROP TABLE IF EXISTS `writer`;
CREATE TABLE `writer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `topicID` int(10) unsigned NOT NULL,
  `createdOn` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IndexTopicUser` (`topicID`,`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `writer`
--

/*!40000 ALTER TABLE `writer` DISABLE KEYS */;
INSERT INTO `writer` (`id`,`userID`,`topicID`,`createdOn`) VALUES 
 (1,6,53,1359401999),
 (2,8,55,1359402169),
 (3,3,55,1359402600),
 (4,2,59,1359402814),
 (5,9,55,1359403147),
 (6,2,61,1359403288),
 (7,8,62,1359403770),
 (8,9,53,1359405598),
 (9,8,53,1359405931),
 (10,2,85,1359581283);
/*!40000 ALTER TABLE `writer` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
