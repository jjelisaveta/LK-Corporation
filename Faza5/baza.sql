CREATE DATABASE  IF NOT EXISTS `popravi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `popravi`;
-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: popravi
-- ------------------------------------------------------
-- Server version	8.0.21

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
-- Table structure for table `kalendar`
--

DROP TABLE IF EXISTS `kalendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kalendar` (
  `idKal` int NOT NULL AUTO_INCREMENT,
  `idMaj` int NOT NULL,
  `idTer` int NOT NULL,
  `idRez` int DEFAULT NULL,
  PRIMARY KEY (`idKal`),
  KEY `fk_idTer_idx` (`idTer`),
  KEY `fk_idRez_idx` (`idRez`),
  KEY `fk_idMaj_kalendar_idx` (`idMaj`),
  CONSTRAINT `fk_idMaj_kalendar` FOREIGN KEY (`idMaj`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_idRez_kalendar` FOREIGN KEY (`idRez`) REFERENCES `rezervacija` (`idRez`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_idTer_kalendar` FOREIGN KEY (`idTer`) REFERENCES `termin` (`idTer`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=315 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kalendar`
--

LOCK TABLES `kalendar` WRITE;
/*!40000 ALTER TABLE `kalendar` DISABLE KEYS */;
INSERT INTO `kalendar` VALUES (12,1,5,NULL),(13,1,6,NULL),(14,1,7,NULL),(15,1,9,1),(20,1,10,2),(21,1,12,NULL),(22,1,13,NULL),(23,1,14,NULL),(24,1,15,NULL),(25,1,16,NULL),(28,1,19,NULL),(29,1,20,NULL),(30,1,11,NULL),(31,1,21,5),(32,1,22,NULL),(37,1,25,NULL),(38,1,26,NULL),(39,1,27,NULL),(41,1,28,NULL),(42,1,29,NULL),(43,1,30,NULL),(44,1,31,NULL),(51,1,33,NULL),(52,1,32,11),(53,1,34,NULL),(59,1,35,14),(60,1,36,27),(64,1,40,NULL),(76,1,47,NULL),(89,1,48,NULL),(108,1,44,NULL),(109,1,49,NULL),(110,1,41,NULL),(111,1,37,NULL),(115,1,38,NULL),(116,1,52,NULL),(119,1,53,NULL),(120,1,54,NULL),(121,1,43,NULL),(122,1,55,NULL),(123,1,56,NULL),(124,1,57,NULL),(125,1,58,NULL),(126,1,59,NULL),(127,1,60,NULL),(128,1,61,NULL),(142,1,65,54),(143,1,64,NULL),(144,1,63,NULL),(145,1,62,NULL),(147,1,66,NULL),(148,1,67,NULL),(149,1,68,55),(150,1,69,NULL),(151,1,70,NULL),(158,1,76,NULL),(161,1,73,NULL),(162,1,72,NULL),(163,1,79,NULL),(164,1,80,NULL),(165,1,81,NULL),(166,17,72,60),(167,17,73,57),(170,17,81,NULL),(171,17,74,NULL),(172,17,71,NULL),(173,17,82,NULL),(174,17,83,NULL),(175,17,84,NULL),(176,17,85,NULL),(178,17,86,NULL),(179,17,87,NULL),(180,17,88,NULL),(181,17,89,NULL),(182,17,90,NULL),(183,17,91,NULL),(184,17,92,NULL),(185,17,93,NULL),(186,17,94,NULL),(187,17,95,NULL),(188,17,96,NULL),(189,17,97,NULL),(190,17,98,NULL),(191,17,99,NULL),(192,17,100,NULL),(193,17,101,NULL),(194,17,102,NULL),(195,17,103,NULL),(196,17,104,NULL),(197,17,105,NULL),(198,17,106,NULL),(200,16,108,NULL),(201,16,109,NULL),(202,16,110,58),(203,16,111,NULL),(204,16,112,NULL),(205,16,113,NULL),(206,16,82,NULL),(207,16,83,NULL),(208,16,114,NULL),(209,16,115,NULL),(210,16,87,NULL),(211,16,88,NULL),(212,16,116,NULL),(213,16,117,NULL),(214,16,92,NULL),(215,16,93,NULL),(216,16,118,NULL),(217,16,119,NULL),(218,16,97,NULL),(219,16,98,NULL),(220,15,79,NULL),(221,15,80,NULL),(222,15,73,NULL),(223,15,81,NULL),(224,15,72,NULL),(225,15,108,NULL),(226,15,111,NULL),(227,15,110,NULL),(228,15,109,NULL),(229,15,83,NULL),(230,15,84,NULL),(231,15,85,NULL),(232,15,86,NULL),(233,15,88,NULL),(234,15,89,NULL),(235,15,90,NULL),(236,15,91,NULL),(237,15,94,NULL),(238,15,95,NULL),(239,15,96,NULL),(240,15,93,NULL),(241,15,98,NULL),(242,15,99,NULL),(243,15,101,NULL),(244,15,100,NULL),(247,1,121,NULL),(248,1,120,NULL),(249,1,122,NULL),(250,1,123,NULL),(251,1,124,NULL),(254,1,127,NULL),(255,1,128,NULL),(256,1,129,NULL),(257,1,130,NULL),(258,1,131,NULL),(259,1,132,NULL),(260,1,133,NULL),(261,1,134,NULL),(262,1,135,NULL),(263,9,136,NULL),(264,9,137,NULL),(265,9,127,NULL),(266,9,129,NULL),(267,9,133,NULL),(268,9,134,NULL),(269,15,138,NULL),(270,15,139,NULL),(271,15,123,NULL),(272,15,140,NULL),(273,15,121,NULL),(274,15,125,NULL),(275,15,127,NULL),(276,15,128,NULL),(277,15,141,NULL),(278,17,138,NULL),(279,17,139,NULL),(280,9,138,75),(281,9,120,NULL),(282,9,121,NULL),(283,9,139,NULL),(284,9,122,NULL),(285,9,126,NULL),(286,9,142,NULL),(287,1,143,76),(288,9,144,77),(290,9,143,NULL),(292,17,136,NULL),(293,17,142,NULL),(294,17,137,NULL),(295,17,125,NULL),(296,17,146,NULL),(297,17,147,NULL),(298,17,148,NULL),(299,17,149,NULL),(300,17,150,NULL),(301,17,134,NULL),(302,17,151,NULL),(303,17,135,NULL),(304,17,152,NULL),(305,17,153,NULL),(306,9,125,NULL),(307,9,128,NULL),(308,16,136,NULL),(309,16,142,NULL),(310,16,137,NULL),(311,16,125,NULL),(312,16,126,NULL),(313,16,128,NULL),(314,16,127,NULL);
/*!40000 ALTER TABLE `kalendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kljuc`
--

DROP TABLE IF EXISTS `kljuc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kljuc` (
  `idkljuc` int NOT NULL AUTO_INCREMENT,
  `vrednost` int DEFAULT NULL,
  PRIMARY KEY (`idkljuc`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kljuc`
--

LOCK TABLES `kljuc` WRITE;
/*!40000 ALTER TABLE `kljuc` DISABLE KEYS */;
INSERT INTO `kljuc` VALUES (1,225);
/*!40000 ALTER TABLE `kljuc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `korisnik` (
  `idKor` int NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `brojTelefona` varchar(15) NOT NULL,
  `lozinka` varchar(20) NOT NULL,
  `adresa` varchar(101) NOT NULL,
  `slika` longtext,
  `idUlo` int NOT NULL,
  `odobren` varchar(1) NOT NULL,
  PRIMARY KEY (`idKor`),
  KEY `fkUlogaKorisnik_idx` (`idUlo`),
  CONSTRAINT `fk_Uloga_korisnik` FOREIGN KEY (`idUlo`) REFERENCES `uloga` (`idUlo`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` VALUES (1,'Pera','Perić','pera123@gmail.com','064122223','pera123','nova adresa','slike/mica.JPG',2,'1'),(2,'Lepa','Brena','lepa@brena.com','0696969696969','lepabrena1234','lepa brena adresa','slike/lepa brena.JPG',3,'1'),(9,'luka','lukic','luka@lukic.com','006306606','luka1234','Studenjak 23','slike/Capture.JPG',2,'1'),(13,'admin','admin','admin',' ','1admin1',' ',' ',1,'1'),(15,'Nenad','Nenadic','nenadNenadic@gmail.com','06056748915','nenad123','Nenada Nenadica 13','slike/haus-majstor-5425635300408-71790071590.jpg',2,'1'),(16,'Petar','Petrovic','petra.petrovic1234@hotmail.au','064 85214596','petar123','Petra Petrovica 234','slike/haus-majstor-dule-5425634826205-71789021051.jpg',2,'1'),(17,'Marko','Markovic','markomajstor@outlook.com','06585214584','marko123','Marka Markovića 231','slike/MAJSTOR-SLIKA-269x300.jpg',2,'1'),(18,'Jovan','Jovic','jovanOvan@gmail.com','065 854 7852','jovan123','Tosin bunar 12','slike/300x300.jpg',3,'1'),(19,'Nevena','Garic','nexynexy@gmail.com','069 85474251','nexy1234','Despota Stefana 123, Smederevo','slike/0dc102aaa606e846db2947fe2fe02983_400x400.jpeg',3,'1'),(20,'Igor','Markovic','mrki49@gmail.com','06499421808','mrkica1234','Ugljese Mrnjavcevica 92','slike/profilna.png',3,'1'),(21,'Jakov','Andrejevic','jakAndrej344@gmail.com','332456789','jakicamakica123','Bulevar Kralja Aleksandra 75','slike/profilna.png',2,'0');
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rezervacija`
--

DROP TABLE IF EXISTS `rezervacija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rezervacija` (
  `idRez` int NOT NULL,
  `idMaj` int NOT NULL,
  `vremeOdgovora` datetime NOT NULL,
  `id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idRez_UNIQUE` (`idRez`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_idMaj_idx` (`idMaj`),
  CONSTRAINT `fk_idMaj_rezervacija` FOREIGN KEY (`idMaj`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_idRez` FOREIGN KEY (`idRez`) REFERENCES `zahtev` (`idZah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rezervacija`
--

LOCK TABLES `rezervacija` WRITE;
/*!40000 ALTER TABLE `rezervacija` DISABLE KEYS */;
INSERT INTO `rezervacija` VALUES (1,1,'2021-05-22 22:00:00',1),(2,1,'2021-05-22 22:00:00',2),(3,1,'2021-05-22 22:00:00',3),(4,1,'2021-05-22 22:00:00',4),(5,1,'2021-05-22 22:00:00',5),(11,1,'2021-05-28 10:35:14',11),(14,1,'2021-05-29 05:21:54',14),(27,1,'2021-05-29 05:25:21',27),(54,1,'2021-06-03 10:30:49',54),(55,1,'2021-06-04 07:29:35',55),(57,17,'2021-06-05 05:22:31',57),(58,16,'2021-06-05 05:25:20',58),(60,17,'2021-06-06 00:50:10',60),(75,9,'2021-06-17 23:13:45',75),(76,1,'2021-06-17 23:04:28',76),(77,9,'2021-06-17 23:13:47',77);
/*!40000 ALTER TABLE `rezervacija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag` (
  `idTag` int NOT NULL AUTO_INCREMENT,
  `opis` varchar(45) NOT NULL,
  PRIMARY KEY (`idTag`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'kupatilo'),(2,'veš mašina'),(3,'wc šolja'),(4,'lavabo'),(5,'vodoinstalacije'),(6,'bojler'),(7,'tuš'),(8,'kuhinja'),(9,'sudopera'),(10,'mašina za sudove'),(11,'automobil'),(12,'parket'),(13,'namestaj'),(14,'moleraj'),(15,'klima uredjaji'),(16,'bela tehnika');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `termin`
--

DROP TABLE IF EXISTS `termin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `termin` (
  `idTer` int NOT NULL AUTO_INCREMENT,
  `datumVreme` datetime NOT NULL,
  PRIMARY KEY (`idTer`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `termin`
--

LOCK TABLES `termin` WRITE;
/*!40000 ALTER TABLE `termin` DISABLE KEYS */;
INSERT INTO `termin` VALUES (1,'2021-05-23 00:00:00'),(2,'2021-05-23 06:00:00'),(3,'2021-05-23 08:00:00'),(4,'2021-05-23 02:00:00'),(5,'2021-05-23 14:00:00'),(6,'2021-05-23 16:00:00'),(7,'2021-05-23 10:00:00'),(8,'2021-05-23 22:00:00'),(9,'2021-05-23 20:00:00'),(10,'2021-05-24 14:00:00'),(11,'2021-05-24 16:00:00'),(12,'2021-05-25 14:00:00'),(13,'2021-05-25 20:00:00'),(14,'2021-05-25 22:00:00'),(15,'2021-05-24 18:00:00'),(16,'2021-05-24 20:00:00'),(17,'2021-05-24 12:00:00'),(18,'2021-05-24 06:00:00'),(19,'2021-05-24 08:00:00'),(20,'2021-05-24 10:00:00'),(21,'2021-06-01 06:00:00'),(22,'2021-06-01 08:00:00'),(23,'2021-06-01 14:00:00'),(24,'2021-06-01 20:00:00'),(25,'2021-05-25 12:00:00'),(26,'2021-05-25 06:00:00'),(27,'2021-05-25 08:00:00'),(28,'2021-05-26 06:00:00'),(29,'2021-05-26 12:00:00'),(30,'2021-05-26 14:00:00'),(31,'2021-05-26 08:00:00'),(32,'2021-06-01 22:00:00'),(33,'2021-06-01 16:00:00'),(34,'2021-05-28 20:00:00'),(35,'2021-05-29 14:00:00'),(36,'2021-05-29 20:00:00'),(37,'2021-05-31 12:00:00'),(38,'2021-05-31 14:00:00'),(39,'2021-05-31 16:00:00'),(40,'2021-05-31 22:00:00'),(41,'2021-05-31 20:00:00'),(42,'2021-05-31 18:00:00'),(43,'2021-06-02 06:00:00'),(44,'2021-06-01 12:00:00'),(45,'2021-06-01 00:00:00'),(46,'2021-06-01 02:00:00'),(47,'2021-06-01 10:00:00'),(48,'2021-05-31 06:00:00'),(49,'2021-05-31 08:00:00'),(50,'2021-05-31 10:00:00'),(51,'2021-06-01 18:00:00'),(52,'2021-05-31 00:00:00'),(53,'2021-06-02 02:00:00'),(54,'2021-06-02 08:00:00'),(55,'2021-06-02 12:00:00'),(56,'2021-06-02 14:00:00'),(57,'2021-06-02 20:00:00'),(58,'2021-06-02 18:00:00'),(59,'2021-06-02 22:00:00'),(60,'2021-06-02 16:00:00'),(61,'2021-06-02 10:00:00'),(62,'2021-06-03 20:00:00'),(63,'2021-06-03 18:00:00'),(64,'2021-06-03 12:00:00'),(65,'2021-06-03 14:00:00'),(66,'2021-06-03 22:00:00'),(67,'2021-06-03 16:00:00'),(68,'2021-06-05 20:00:00'),(69,'2021-06-05 14:00:00'),(70,'2021-06-05 18:00:00'),(71,'2021-06-06 18:00:00'),(72,'2021-06-06 12:00:00'),(73,'2021-06-06 14:00:00'),(74,'2021-06-06 20:00:00'),(75,'2021-06-06 22:00:00'),(76,'2021-06-05 12:00:00'),(77,'2021-06-05 22:00:00'),(78,'2021-06-05 16:00:00'),(79,'2021-06-06 08:00:00'),(80,'2021-06-06 10:00:00'),(81,'2021-06-06 16:00:00'),(82,'2021-06-08 12:00:00'),(83,'2021-06-08 14:00:00'),(84,'2021-06-08 16:00:00'),(85,'2021-06-08 18:00:00'),(86,'2021-06-08 20:00:00'),(87,'2021-06-09 12:00:00'),(88,'2021-06-09 14:00:00'),(89,'2021-06-09 16:00:00'),(90,'2021-06-09 18:00:00'),(91,'2021-06-09 20:00:00'),(92,'2021-06-10 12:00:00'),(93,'2021-06-10 14:00:00'),(94,'2021-06-10 16:00:00'),(95,'2021-06-10 18:00:00'),(96,'2021-06-10 20:00:00'),(97,'2021-06-11 12:00:00'),(98,'2021-06-11 14:00:00'),(99,'2021-06-11 16:00:00'),(100,'2021-06-11 18:00:00'),(101,'2021-06-11 20:00:00'),(102,'2021-06-12 12:00:00'),(103,'2021-06-12 14:00:00'),(104,'2021-06-12 16:00:00'),(105,'2021-06-12 18:00:00'),(106,'2021-06-12 20:00:00'),(107,'2021-06-07 06:00:00'),(108,'2021-06-07 08:00:00'),(109,'2021-06-07 10:00:00'),(110,'2021-06-07 12:00:00'),(111,'2021-06-07 14:00:00'),(112,'2021-06-08 08:00:00'),(113,'2021-06-08 10:00:00'),(114,'2021-06-09 08:00:00'),(115,'2021-06-09 10:00:00'),(116,'2021-06-10 08:00:00'),(117,'2021-06-10 10:00:00'),(118,'2021-06-11 08:00:00'),(119,'2021-06-11 10:00:00'),(120,'2021-06-18 14:00:00'),(121,'2021-06-18 16:00:00'),(122,'2021-06-18 18:00:00'),(123,'2021-06-18 20:00:00'),(124,'2021-06-18 22:00:00'),(125,'2021-06-19 14:00:00'),(126,'2021-06-19 16:00:00'),(127,'2021-06-19 20:00:00'),(128,'2021-06-19 18:00:00'),(129,'2021-06-19 22:00:00'),(130,'2021-06-20 18:00:00'),(131,'2021-06-20 20:00:00'),(132,'2021-06-20 22:00:00'),(133,'2021-06-21 20:00:00'),(134,'2021-06-21 08:00:00'),(135,'2021-06-21 12:00:00'),(136,'2021-06-19 08:00:00'),(137,'2021-06-19 12:00:00'),(138,'2021-06-18 08:00:00'),(139,'2021-06-18 10:00:00'),(140,'2021-06-18 12:00:00'),(141,'2021-06-19 04:00:00'),(142,'2021-06-19 10:00:00'),(143,'2021-06-18 00:00:00'),(144,'2021-06-18 02:00:00'),(145,'2021-06-19 00:00:00'),(146,'2021-06-20 08:00:00'),(147,'2021-06-20 10:00:00'),(148,'2021-06-20 12:00:00'),(149,'2021-06-20 14:00:00'),(150,'2021-06-20 16:00:00'),(151,'2021-06-21 10:00:00'),(152,'2021-06-21 14:00:00'),(153,'2021-06-21 16:00:00');
/*!40000 ALTER TABLE `termin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uloga`
--

DROP TABLE IF EXISTS `uloga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uloga` (
  `idUlo` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`idUlo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uloga`
--

LOCK TABLES `uloga` WRITE;
/*!40000 ALTER TABLE `uloga` DISABLE KEYS */;
INSERT INTO `uloga` VALUES (1,'admin'),(2,'majstor'),(3,'korisnik');
/*!40000 ALTER TABLE `uloga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usluga`
--

DROP TABLE IF EXISTS `usluga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usluga` (
  `idUsl` int NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  `opis` longtext NOT NULL,
  `cena` double NOT NULL,
  `idMaj` int NOT NULL,
  PRIMARY KEY (`idUsl`),
  KEY `fkIdMajstrora_idx` (`idMaj`),
  CONSTRAINT `fk_idMaj_usluga` FOREIGN KEY (`idMaj`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usluga`
--

LOCK TABLES `usluga` WRITE;
/*!40000 ALTER TABLE `usluga` DISABLE KEYS */;
INSERT INTO `usluga` VALUES (19,'Povoljno, brzo i efikasno!','Popravljam masinu za sudove, nabavljam zamenske delove. Iskustvo i u popravljanju elektronike masine za sudove. Takodje radim i odcepljavanje cevi (sudopera)',6000,1),(20,'Tim majstora za sve','Moja uza specijalnost su masina za sudove kao i sudopera. Medjutim u saradnji sa jos par majstora smo spremni da pokrijem i vecinu ostalih kvarova-lavabo, tus, pa sve do wc solje. Pozovite nas!',3000,1),(34,'Najbolji u gradu za klima uredjaje','Radimo montiranje klima uredjaja, popravljanje (kako starih tako i novih modela). Nudimo savete pri kupovini klima!',1900,1),(37,'Vodoinstalacije','Povoljno vrsim poravke svih kvarova u vodoinstalacionoj mrezi vaseg doma.\r\nBrza i povoljna usluga na jedan klik od vas.\r\n\r\n',2000,16),(38,'Krecenje, moleraj','Sredjujemo zidove brzo i povoljno. Ulepsajte svoj dom najnovijim italijanskim farbama, sve boje i dezeni. Svaki 10ti kvadrat gratis',10000,16),(39,'Elektricar Nenad','Popravljam sporete, klime, frizidere, zamrzivace.\r\nDostupan 24/7\r\n',3500,15),(40,'Namestaj','Restauriram stari, poravljam i pravim novi namestaj od najkvalitetnijeg drveta.',8000,15),(41,'Opel fiat alfa','Sve vrste popravki za automobile marke opel, fiat ili alfa. Najpovoljniji u gradu.',6000,17),(42,'Specijalista za bojler!','Popravljam i nabavljam bojlere! Takodje menjam i wc solju kao i popravka tus-a.',2000,1),(43,'Menjamo plocice povoljno','Visegodisnje iskustvo u renoviranju kupatila. menjamo sve plocice, wc solju, kadu! Najefikasniji u gradu! Ne razmisljajte 2 puta',3000,9),(44,'Krecim povoljno!','Vrlo brzo i efikasno zavrsavam posao na najbolji moguci nacin. U ponudi i najskuplje nijanse boja!',3200,9),(45,'Krecenje ','Najbolji u gradu! Ako niste zadovoljni vrsimo povrat novca!',2500,17);
/*!40000 ALTER TABLE `usluga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uslugaostvarena`
--

DROP TABLE IF EXISTS `uslugaostvarena`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uslugaostvarena` (
  `idUslOstv` int NOT NULL AUTO_INCREMENT,
  `idUsl` int NOT NULL,
  `komentar` longtext,
  `ocena` varchar(1) DEFAULT NULL,
  `obrisano` varchar(1) NOT NULL,
  `idRez` int NOT NULL,
  PRIMARY KEY (`idUslOstv`),
  KEY `fk_idUsl_uslugaOtvorena_idx` (`idUsl`),
  KEY `fk_idRez_uslugaOstvarena_idx` (`idRez`),
  CONSTRAINT `fk_idRez_uslugaOstvarena` FOREIGN KEY (`idRez`) REFERENCES `rezervacija` (`idRez`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_idUsl_uslugaOtvorena` FOREIGN KEY (`idUsl`) REFERENCES `usluga` (`idUsl`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uslugaostvarena`
--

LOCK TABLES `uslugaostvarena` WRITE;
/*!40000 ALTER TABLE `uslugaostvarena` DISABLE KEYS */;
INSERT INTO `uslugaostvarena` VALUES (3,19,'Usluga je bila korekna.','1','0',1),(4,19,'Komentar je obrisan od strane admina','0','0',2),(5,19,'Nije ispostovan dogovor.','0','1',3),(6,19,'Sve je OK bilo.','1','1',4),(7,19,NULL,'1','1',5),(12,19,NULL,'1','1',14),(13,20,'Sve preporuke za majstora!','1','0',27),(18,20,NULL,NULL,'1',54),(19,20,NULL,NULL,'1',55),(20,41,'Brzo i jeftino',NULL,'0',57),(21,38,'Majstor je bio potpuno neprofesionalan, osim zidova okrecio je i dobar deo parketa.',NULL,'0',58),(22,41,'Odlicna usluga!','1','0',60),(23,20,NULL,'1','0',76),(24,44,NULL,'1','0',75),(25,44,'Zid je okrecen u rekordnom vremenu svaka cast!','1','0',77);
/*!40000 ALTER TABLE `uslugaostvarena` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uslugatag`
--

DROP TABLE IF EXISTS `uslugatag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uslugatag` (
  `idUsl` int NOT NULL,
  `idTag` int NOT NULL,
  PRIMARY KEY (`idUsl`,`idTag`),
  KEY `fk_idUsl_usuga-tag_idx` (`idUsl`),
  KEY `fk_idTag_usluga-tag_idx` (`idTag`),
  CONSTRAINT `fk_idTag_usluga-tag` FOREIGN KEY (`idTag`) REFERENCES `tag` (`idTag`),
  CONSTRAINT `fk_idUsl_usuga-tag` FOREIGN KEY (`idUsl`) REFERENCES `usluga` (`idUsl`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uslugatag`
--

LOCK TABLES `uslugatag` WRITE;
/*!40000 ALTER TABLE `uslugatag` DISABLE KEYS */;
INSERT INTO `uslugatag` VALUES (19,1),(19,9),(19,10),(20,1),(20,2),(20,3),(20,4),(20,5),(20,6),(20,7),(20,8),(20,9),(20,10),(34,15),(35,4),(35,7),(35,9),(37,4),(37,5),(37,9),(38,14),(39,2),(39,6),(39,10),(39,15),(39,16),(40,13),(41,11),(42,3),(42,6),(42,7),(43,1),(43,3),(43,6),(44,14),(45,14);
/*!40000 ALTER TABLE `uslugatag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zahtev`
--

DROP TABLE IF EXISTS `zahtev`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zahtev` (
  `idZah` int NOT NULL AUTO_INCREMENT,
  `idUsl` int NOT NULL,
  `idKor` int NOT NULL,
  `idTer` int NOT NULL,
  `opis` longtext NOT NULL,
  `vremeSlanja` datetime NOT NULL,
  `identifikator` int NOT NULL,
  PRIMARY KEY (`idZah`),
  KEY `fk_IdKor_idx` (`idKor`),
  KEY `fk_idTer_zahtev_idx` (`idTer`),
  KEY `fk_idUsl_zahtev_idx` (`idUsl`),
  CONSTRAINT `fk_IdKor_zahtev` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_idTer_zahtev` FOREIGN KEY (`idTer`) REFERENCES `termin` (`idTer`) ON UPDATE CASCADE,
  CONSTRAINT `fk_idUsl_zahtev` FOREIGN KEY (`idUsl`) REFERENCES `usluga` (`idUsl`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zahtev`
--

LOCK TABLES `zahtev` WRITE;
/*!40000 ALTER TABLE `zahtev` DISABLE KEYS */;
INSERT INTO `zahtev` VALUES (1,19,2,9,'Cev je zapusena.','2021-05-22 22:00:00',-1),(2,19,2,10,'Masina za pranje sudova neprijatno mirise.','2021-05-22 22:00:00',-1),(3,19,2,21,'Masina za pranje sudove se ne ukljucuje.','2021-05-22 22:00:00',-1),(4,19,2,22,'Masina za pranje sudova pravi buku.','2021-05-22 22:00:00',-1),(5,19,2,23,'U dnevnoj sobi ispod sudopere mi je pukla cev. hitno mi je potreban majstor da to sredi poplava je u kuci. Pomagajte','2021-05-22 22:00:00',-1),(11,20,2,32,'Vodokotlic ne prima dovoljno vode.','2021-05-22 22:00:00',-1),(14,19,2,35,'Tableta za masinu za pranje sudova se ne rastvara.','2021-05-22 22:00:00',-1),(27,20,2,36,'U dnevnoj sobi ispod sudopere mi je pukla cev. hitno mi je potreban majstor da to sredi poplava je u kuci. Pomagajte','2021-05-22 22:00:00',-1),(54,20,2,65,'Masina za pranje sudova ne ispusta vodu.','2021-06-03 10:29:02',-1),(55,20,2,68,'Slab pritisak tusa.','2021-06-04 07:29:31',-1),(57,41,18,73,'Opel astra 2003\nNe vuce dobro plin','2021-06-05 17:22:23',-1),(58,38,18,110,'Krecenje sobe 22m2. U belo, sto pre. ','2021-06-05 17:24:58',-1),(60,41,19,72,'Ne radi auto ne znam sta mu je nece da upali\r opel vectra 2006','2021-06-06 00:50:00',-1),(61,19,20,122,'Imam problema sa okrnjenim plocicama','2021-06-17 22:11:13',196),(62,43,2,136,'Potrebno celokupno renoviranje kupatila. Cena je manje bitna!','2021-06-17 22:33:27',197),(63,43,2,127,'Potrebno celokupno renoviranje kupatila. Cena je manje bitna!','2021-06-17 22:33:27',197),(64,40,18,138,'Potrebno je da restaurira stara dedina fotelja. Pare nisu problem, potreban je kvalitet usluge!','2021-06-17 22:38:50',199),(65,40,18,139,'Potrebno je da restaurira stara dedina fotelja. Pare nisu problem, potreban je kvalitet usluge!','2021-06-17 22:38:50',199),(66,40,18,123,'Potrebno je da restaurira stara dedina fotelja. Pare nisu problem, potreban je kvalitet usluge!','2021-06-17 22:38:50',199),(67,40,18,140,'Potrebno je da restaurira stara dedina fotelja. Pare nisu problem, potreban je kvalitet usluge!','2021-06-17 22:38:50',199),(68,40,18,121,'Potrebno je da restaurira stara dedina fotelja. Pare nisu problem, potreban je kvalitet usluge!','2021-06-17 22:38:50',199),(69,20,18,121,'Imam zapusene cevi na sudoperi, molim pomoc!','2021-06-17 22:41:52',200),(75,44,19,138,'Hitno potreban moler! Useljavaju nam se podstanari sledece nedelje!!','2021-06-17 22:53:10',-1),(76,20,19,143,'Hitno potrebna popravka ves masine','2021-06-17 22:59:52',-1),(77,44,19,144,'Deca su mi iscrtala zid u stanu hitno potrebno krecenje!','2021-06-17 23:12:58',-1),(78,41,20,142,'Motor se gasi.','2021-06-18 09:04:30',222),(79,41,20,125,'Motor se gasi.','2021-06-18 09:04:30',222),(80,44,18,128,'Potrebno krecenje celog stana (65 kvadrata).','2021-06-18 09:11:01',223),(81,44,19,127,'Zelim da uradim tapete u spavacoj sobi.','2021-06-18 09:13:53',224),(82,44,19,126,'Zelim da uradim tapete u spavacoj sobi.','2021-06-18 09:13:53',224),(83,44,19,128,'Zelim da uradim tapete u spavacoj sobi.','2021-06-18 09:13:53',224),(84,38,19,126,'Zelim da uradim tapete u spavacoj sobi.','2021-06-18 09:13:53',224),(85,38,19,128,'Zelim da uradim tapete u spavacoj sobi.','2021-06-18 09:13:53',224),(86,38,19,127,'Zelim da uradim tapete u spavacoj sobi.','2021-06-18 09:13:53',224);
/*!40000 ALTER TABLE `zahtev` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-18  9:26:44
