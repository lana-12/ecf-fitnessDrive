CREATE DATABASE  IF NOT EXISTS `heroku_27b8c4c20faffd0` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `heroku_27b8c4c20faffd0`;
-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: us-cdbr-east-06.cleardb.net    Database: heroku_27b8c4c20faffd0
-- ------------------------------------------------------
-- Server version	5.6.50-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (4,'Mistral','mistral@exemple.fr','Test formulaire contact','Message de test de contact franchise'),(14,'Albert','albert@exemple.fr','Test formulaire contact','Message de test de contact Structure');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20221030110354','2022-10-30 12:04:11',3377);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name_partner` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EFEB516439407BA8` (`name_partner`),
  UNIQUE KEY `UNIQ_EFEB5164444F97DD` (`phone`),
  UNIQUE KEY `UNIQ_EFEB51645E237E06` (`name`),
  KEY `IDX_EFEB5164A76ED395` (`user_id`),
  CONSTRAINT `FK_EFEB5164A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES (1,1,'Nimes','0625968741',1,'Mistral'),(2,5,'Montpellier','0695741203',1,'Stark'),(3,7,'Toulouse','0639874125',1,'Ibanez'),(4,44,'Mauguio','0434859625',0,'Mariano');
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Distributeur de Boisson','Eau, soda, boisson énergisante...',1),(2,'Distributeur de Nourriture','Barre vitaminée, chocolatée, chips...',1),(3,'Vente de produit de la Marque','Sportif, vêtement, poster...',1),(4,'Gérer le planning','Application de gestion de planning des coachs sportif',1),(5,'Coach Sportif','Caoch sportif selon la catégorie',1),(6,'Newsletter','Envoi de newsletter',1),(7,'Douche','Salle de douche (max 10) avec vestiaire privée ',1),(8,'Vestiaire','Vestiaire collectif ',1),(9,'Appli Sportive','Application Fitness Drive payante, à télécharger réservé aux sportif ',1),(14,'Chaîne Télévision sportive','Compte à une plateforme',1);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `structure_permission`
--

DROP TABLE IF EXISTS `structure_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `structure_permission` (
  `structure_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`structure_id`,`permission_id`),
  KEY `IDX_D207A6E42534008B` (`structure_id`),
  KEY `IDX_D207A6E4FED90CCA` (`permission_id`),
  CONSTRAINT `FK_D207A6E42534008B` FOREIGN KEY (`structure_id`) REFERENCES `structures` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D207A6E4FED90CCA` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `structure_permission`
--

LOCK TABLES `structure_permission` WRITE;
/*!40000 ALTER TABLE `structure_permission` DISABLE KEYS */;
INSERT INTO `structure_permission` VALUES (2,1),(2,5),(2,7),(3,3),(3,4),(3,6),(4,1),(4,2),(4,4),(4,5),(4,7),(14,1),(14,5),(14,9);
/*!40000 ALTER TABLE `structure_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `structures`
--

DROP TABLE IF EXISTS `structures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `structures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name_structure` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` int(11) NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `full_description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5BBEC55A13F109A8` (`name_structure`),
  UNIQUE KEY `UNIQ_5BBEC55A444F97DD` (`phone`),
  KEY `IDX_5BBEC55A9393F8FE` (`partner_id`),
  KEY `IDX_5BBEC55AA76ED395` (`user_id`),
  CONSTRAINT `FK_5BBEC55A9393F8FE` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`),
  CONSTRAINT `FK_5BBEC55AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `structures`
--

LOCK TABLES `structures` WRITE;
/*!40000 ALTER TABLE `structures` DISABLE KEYS */;
INSERT INTO `structures` VALUES (1,1,3,'Albert','3 avenue Jean Jaures',30000,'Nimes','0430691260',1,NULL,'Première Structure pour la franchise de Nimes de Mr Mistral'),(2,2,6,'Steve','647 avenue de la justice',34090,'Montpellier','0467728684',1,NULL,'Première structure de la franchise de Montpellier'),(3,3,8,'Trinhduc','12 rue du ballon rond',31000,'Toulouse','0541036574',1,NULL,NULL),(4,2,24,'Gamora','3 rue de la défense',34000,'Montpellier','0639854123',1,NULL,NULL),(14,4,54,'TinoRossi','26 boulevard du papa noel',34130,'Mauguio','0636985478',0,NULL,NULL);
/*!40000 ALTER TABLE `structures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mistral','mistral@exemple.fr','$2y$13$M41QRb.5XOM90vqeRa4B5e8O03QHabft5zv/3.zNepJ60BiF0/CLq','[\"ROLE_PARTNER\"]'),(3,'Albert','albert@exemple.fr','$2y$13$Kvs/IjMqMBpHVdXFRGfgyOFvBXhhT1jyaudyGaZ7h2Onk3nmy5Gg6','[\"ROLE_STRUCTURE\"]'),(4,'Admin01','fitnessdrive.ad01@outlook.com','$2y$13$5QxUh6z4XdxuLdVcf0YpjOMvjo4nJrdUxR/VjTDGWv/rzbDBhnLZC','[\"ROLE_ADMIN\"]'),(5,'Avenger','avenger@exemple.fr','$2y$13$lZ2QCpVKyxf3t04J8jkKYu2Gm3qQPnrR/nMjOedzCVuCYZ8eGXzaO','[\"ROLE_PARTNER\"]'),(6,'Steve','steve@exemple.fr','$2y$13$vkO/NWklbHcCnxFj4Mi12uGyLUkegr0GLUut40aR76xXnP.DM64LW','[\"ROLE_STRUCTURE\"]'),(7,'Ibanez','ibanez@exemple.fr','$2y$13$rNceh7sWORxLWdQ4a9A9.OIq4BqPFqVnPScmIBwMU6hmRfa59F2je','[\"ROLE_PARTNER\"]'),(8,'trinhduc','trinhduc@exemple.fr','$2y$13$/pwcl6YpSaaf4miTCxwNp.oLxk3C50bfkcWo9dZASv/j5iiE9KZaS','[\"ROLE_STRUCTURE\"]'),(14,'StarLord','starlord@exemple.fr','$2y$13$7GhQZbQaYcQHL5PperREv.YqQhtMG0gXR9nzG8JVEsN0iaXS0G9Yi','[\"ROLE_STRUCTURE\"]'),(24,'Gamora','gamora@exemple.fr','$2y$13$tW6FdH6EuLvTl4V3XP1lC.ztcBltO6d5oVuEP.xJRdH1RVz2T/zlS','[\"ROLE_STRUCTURE\"]'),(34,'Rocket','rocket@exemple.fr','$2y$13$FAU3w3Ky7R7pR3/QAgiowONRmVxASCWyNSpZz3d/GnaFnlH5r3/IG','[\"ROLE_STRUCTURE\"]'),(44,'MarianoL','mariano@exemple.fr','$2y$13$7tpUjtJmKEEaI07XQkad.OOOLwCTcgzYzRrVxRBKTVfiaUVVm5qFW','[\"ROLE_PARTNER\"]'),(54,'TinoRossi','tinorossi@exemple.fr','$2y$13$PowaWPeXTkFWcUHHghmHQuQlHtteNUJhv7fZ/3BAVDnmoaJz3aQFG','[\"ROLE_STRUCTURE\"]');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-31 21:41:31
