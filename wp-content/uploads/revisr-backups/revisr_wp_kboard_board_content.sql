
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `wp_kboard_board_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_kboard_board_content` (
  `uid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `board_id` bigint(20) unsigned NOT NULL,
  `parent_uid` bigint(20) unsigned DEFAULT NULL,
  `member_uid` bigint(20) unsigned DEFAULT NULL,
  `member_display` varchar(127) DEFAULT NULL,
  `title` varchar(127) NOT NULL,
  `content` longtext NOT NULL,
  `date` char(14) DEFAULT NULL,
  `view` int(10) unsigned DEFAULT NULL,
  `comment` int(10) unsigned DEFAULT NULL,
  `like` int(10) unsigned DEFAULT NULL,
  `unlike` int(10) unsigned DEFAULT NULL,
  `vote` int(11) DEFAULT NULL,
  `thumbnail_file` varchar(127) DEFAULT NULL,
  `thumbnail_name` varchar(127) DEFAULT NULL,
  `category1` varchar(127) DEFAULT NULL,
  `category2` varchar(127) DEFAULT NULL,
  `secret` varchar(5) DEFAULT NULL,
  `notice` varchar(5) DEFAULT NULL,
  `search` char(1) DEFAULT NULL,
  `password` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `board_id` (`board_id`),
  KEY `parent_uid` (`parent_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_kboard_board_content` WRITE;
/*!40000 ALTER TABLE `wp_kboard_board_content` DISABLE KEYS */;
INSERT INTO `wp_kboard_board_content` VALUES (1,1,0,1,'motiontree','asdf','asdfsadf','20160111123451',1,0,0,0,0,'','','','','','','1',''),(2,2,0,1,'motiontree','saccs','scacsa','20160113160315',2,0,0,0,0,'/wp-content/uploads/kboard_thumbnails/2/201601/56960667232057059866.png','포켓몬_(5).png','','','','','1','');
/*!40000 ALTER TABLE `wp_kboard_board_content` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

