
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
DROP TABLE IF EXISTS `wp_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_posts` WRITE;
/*!40000 ALTER TABLE `wp_posts` DISABLE KEYS */;
INSERT INTO `wp_posts` VALUES (1,1,'2016-01-08 18:20:14','2016-01-08 09:20:14','워드프레스에 오신 것을 환영합니다. 이것은 첫번째 글입니다. 이 글을 고치거나 지운 후에 블로깅을 시작하세요!','안녕하세요!','','publish','open','open','','hello-world','','','2016-01-08 18:20:14','2016-01-08 09:20:14','',0,'http://121.135.190.98/wordpress/?p=1',0,'post','',1),(2,1,'2016-01-08 18:20:14','2016-01-08 09:20:14','이것은 예제 페이지입니다. 페이지는 한 곳에 고정되며 사이트 네비게이션에 표시되기 때문에 블로그 글과는 다릅니다 (대부분의 테마). 대다수의 사람들은 사이트 방문자들에게 자신들을 소개하기 위한 About 페이지부터 시작합니다. 다음과 같이 작성할 수 있습니다:\n\n<blockquote>안녕하세요! 저는 낮에는 자전거로 배달하는 일을 하고 밤에는 배우가 되기 위한 연기 연습을 합니다. 여기는 제 블로그입니다. 서울에 살고 순돌이라는 이름의 대단한 개를 키우고 있죠.음악 듣기와 영화보기를 좋아합니다.(이런식의 자기소개).</blockquote>\n\n...또는 이럴 수도 있습니다:\n\n<blockquote>이 가나다 회사는 2012년에 만들어졌으며 그 후로 소비자를 위해 품질 좋은 생산품을 만들고 있습니다. 고담시에 위치하며 2천명의 직원이 있고 고담시 커뮤니티를 위해 다양하고 멋진 일을 하고 있습니다.</blockquote>\n\n새로운 워드프레스 사용자로써, <a href=\"http://121.135.190.98/wordpress/wp-admin/\">관리자 화면</a>으로 가서 이 페이지를 삭제하고 컨텐츠로 채워진 새로운 페이지를 생성해보세요. 즐겨보세요!','샘플 페이지','','publish','closed','open','','sample-page','','','2016-01-08 18:20:14','2016-01-08 09:20:14','',0,'http://121.135.190.98/wordpress/?page_id=2',0,'page','',0),(3,1,'2016-01-08 18:20:21','0000-00-00 00:00:00','','자동 임시글','','auto-draft','open','open','','','','','2016-01-08 18:20:21','0000-00-00 00:00:00','',0,'http://121.135.190.98/wordpress/?p=3',0,'post','',0),(4,1,'2016-01-11 12:13:37','2016-01-11 03:13:37','','sample','','trash','closed','closed','','sample','','','2016-01-11 12:13:54','2016-01-11 03:13:54','',0,'http://121.135.190.98/wordpress/?page_id=4',0,'page','',0),(5,1,'2016-01-11 12:13:37','2016-01-11 03:13:37','','sample','','inherit','closed','closed','','4-revision-v1','','','2016-01-11 12:13:37','2016-01-11 03:13:37','',4,'http://121.135.190.98/wordpress/index.php/2016/01/11/4-revision-v1/',0,'revision','',0),(6,1,'2016-01-11 12:14:34','2016-01-11 03:14:34','테스트입니다\r\n\r\n&nbsp;','test','','publish','closed','closed','','test','','','2016-01-11 12:14:39','2016-01-11 03:14:39','',0,'http://121.135.190.98/wordpress/?page_id=6',0,'page','',0),(7,1,'2016-01-11 12:14:08','2016-01-11 03:14:08','','test','','inherit','closed','closed','','6-revision-v1','','','2016-01-11 12:14:08','2016-01-11 03:14:08','',6,'http://121.135.190.98/wordpress/index.php/2016/01/11/6-revision-v1/',0,'revision','',0),(8,1,'2016-01-11 12:14:28','2016-01-11 03:14:28','테스트입니다\r\n\r\n&nbsp;','test','','inherit','closed','closed','','6-revision-v1','','','2016-01-11 12:14:28','2016-01-11 03:14:28','',6,'http://121.135.190.98/wordpress/index.php/2016/01/11/6-revision-v1/',0,'revision','',0),(9,1,'2016-01-11 12:34:51','2016-01-11 03:34:51','asdfsadf','asdf','','publish','closed','closed','','1','','','2016-01-11 12:34:51','2016-01-11 03:34:51','',1,'http://121.135.190.98/wordpress/?kboard_content_redirect=1',0,'kboard','',0),(10,2,'2016-01-13 15:18:19','0000-00-00 00:00:00','','자동 임시글','','auto-draft','open','open','','','','','2016-01-13 15:18:19','0000-00-00 00:00:00','',0,'http://121.135.190.98/wordpress/?p=10',0,'post','',0),(11,1,'2016-01-13 16:03:15','2016-01-13 07:03:15','scacsa','saccs','','publish','closed','closed','','2','','','2016-01-13 17:10:15','2016-01-13 08:10:15','',2,'http://121.135.190.98/wordpress/?kboard_content_redirect=2',0,'kboard','',0),(13,5,'2016-01-13 18:45:51','0000-00-00 00:00:00','','자동 임시글','','auto-draft','open','open','','','','','2016-01-13 18:45:51','0000-00-00 00:00:00','',0,'http://121.135.190.98/wordpress/?p=13',0,'post','',0),(14,4,'2016-01-14 10:39:36','0000-00-00 00:00:00','','자동 임시글','','auto-draft','open','open','','','','','2016-01-14 10:39:36','0000-00-00 00:00:00','',0,'http://121.135.190.98/wordpress/?p=14',0,'post','',0),(15,4,'2016-01-14 10:43:04','0000-00-00 00:00:00','','자동 임시글','','auto-draft','open','open','','','','','2016-01-14 10:43:04','0000-00-00 00:00:00','',0,'http://121.135.190.98/wordpress/?p=15',0,'post','',0);
/*!40000 ALTER TABLE `wp_posts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

