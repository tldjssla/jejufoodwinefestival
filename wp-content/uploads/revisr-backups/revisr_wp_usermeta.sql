
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
DROP TABLE IF EXISTS `wp_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_usermeta` WRITE;
/*!40000 ALTER TABLE `wp_usermeta` DISABLE KEYS */;
INSERT INTO `wp_usermeta` VALUES (1,1,'nickname','motiontree'),(2,1,'first_name',''),(3,1,'last_name',''),(4,1,'description',''),(5,1,'rich_editing','true'),(6,1,'comment_shortcuts','false'),(7,1,'admin_color','fresh'),(8,1,'use_ssl','0'),(9,1,'show_admin_bar_front','true'),(10,1,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(11,1,'wp_user_level','10'),(12,1,'dismissed_wp_pointers',''),(13,1,'show_welcome_panel','1'),(15,1,'wp_dashboard_quick_press_last_post_id','3'),(16,1,'wp_user-settings','mfold=o&editor=tinymce'),(17,1,'wp_user-settings-time','1452482015'),(18,1,'managenav-menuscolumnshidden','a:5:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";i:4;s:15:\"title-attribute\";}'),(19,1,'metaboxhidden_nav-menus','a:2:{i:0;s:12:\"add-post_tag\";i:1;s:15:\"add-post_format\";}'),(20,2,'nickname','Design'),(21,2,'first_name','Jeju'),(22,2,'last_name','foodandwine'),(23,2,'description',''),(24,2,'rich_editing','true'),(25,2,'comment_shortcuts','false'),(26,2,'admin_color','fresh'),(27,2,'use_ssl','0'),(28,2,'show_admin_bar_front','true'),(29,2,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(30,2,'wp_user_level','10'),(31,2,'dismissed_wp_pointers',''),(33,2,'wp_dashboard_quick_press_last_post_id','10'),(49,4,'nickname','jfwf_designer'),(50,4,'first_name',''),(51,4,'last_name',''),(52,4,'description',''),(53,4,'rich_editing','true'),(54,4,'comment_shortcuts','false'),(55,4,'admin_color','fresh'),(56,4,'use_ssl','0'),(57,4,'show_admin_bar_front','true'),(58,4,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(59,4,'wp_user_level','10'),(60,4,'dismissed_wp_pointers',''),(61,5,'nickname','jfwf_publisher'),(62,5,'first_name',''),(63,5,'last_name',''),(64,5,'description',''),(65,5,'rich_editing','true'),(66,5,'comment_shortcuts','false'),(67,5,'admin_color','fresh'),(68,5,'use_ssl','0'),(69,5,'show_admin_bar_front','true'),(70,5,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(71,5,'wp_user_level','10'),(72,5,'dismissed_wp_pointers',''),(75,5,'wp_dashboard_quick_press_last_post_id','13'),(79,4,'session_tokens','a:1:{s:64:\"4a6364b173eee9b3973f281dd3671a5645ee8d51a1bd897842eb177b1ddd031b\";a:4:{s:10:\"expiration\";i:1452908421;s:2:\"ip\";s:15:\"121.138.173.179\";s:2:\"ua\";s:109:\"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\";s:5:\"login\";i:1452735621;}}'),(80,4,'wp_dashboard_quick_press_last_post_id','14'),(82,1,'session_tokens','a:1:{s:64:\"0d253c61c16bdc6e957551aeab7615a25871c79967619c2e14455b7c7b98683e\";a:4:{s:10:\"expiration\";i:1453006303;s:2:\"ip\";s:11:\"14.63.28.35\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\";s:5:\"login\";i:1452833503;}}');
/*!40000 ALTER TABLE `wp_usermeta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

