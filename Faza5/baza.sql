-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: popravi
-- ------------------------------------------------------
-- Server version	8.0.22

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
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kalendar`
--

LOCK TABLES `kalendar` WRITE;
/*!40000 ALTER TABLE `kalendar` DISABLE KEYS */;
INSERT INTO `kalendar` VALUES (12,1,5,NULL),(13,1,6,NULL),(14,1,7,NULL),(15,1,9,1),(20,1,10,2),(21,1,12,NULL),(22,1,13,NULL),(23,1,14,NULL),(24,1,15,NULL),(25,1,16,NULL),(28,1,19,NULL),(29,1,20,NULL),(30,1,11,NULL),(31,1,21,5),(32,1,22,NULL),(37,1,25,NULL),(38,1,26,NULL),(39,1,27,NULL),(41,1,28,NULL),(42,1,29,NULL),(43,1,30,NULL),(44,1,31,NULL),(51,1,33,NULL),(52,1,32,11),(53,1,34,NULL),(59,1,35,14),(60,1,36,27),(64,1,40,NULL),(76,1,47,NULL),(89,1,48,NULL),(108,1,44,NULL),(109,1,49,NULL),(110,1,41,NULL),(111,1,37,NULL),(115,1,38,NULL),(116,1,52,NULL),(119,1,53,NULL),(120,1,54,NULL),(121,1,43,NULL),(122,1,55,NULL),(123,1,56,NULL),(124,1,57,NULL),(125,1,58,NULL),(126,1,59,NULL),(127,1,60,NULL),(128,1,61,NULL),(142,1,65,54),(143,1,64,NULL),(144,1,63,NULL),(145,1,62,NULL),(147,1,66,NULL),(148,1,67,NULL),(149,1,68,NULL),(150,1,69,NULL),(151,1,70,NULL),(152,1,71,NULL),(153,1,72,NULL),(154,1,73,NULL),(155,1,74,NULL),(156,1,75,NULL);
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
INSERT INTO `kljuc` VALUES (1,106);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` VALUES (1,'Pera','Perić','pera123@gmail.com','064122223','pera123','nova adresa','slike/profilna.png',2,'1'),(2,'Lepa','Brena','lepa@brena.com','0696969696969','1234','Ulica Lepe Brene 69','slike/profilna.png',3,'1'),(9,'luka','lukic','luka@lukic.com','006306606','luka1234','adresa','slike/Capture.JPG',2,'1'),(13,'admin','admin','admin',' ','1admin1',' ',' ',1,'1');
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
INSERT INTO `rezervacija` VALUES (1,1,'2021-05-22 22:00:00',1),(2,1,'2021-05-22 22:00:00',2),(3,1,'2021-05-22 22:00:00',3),(4,1,'2021-05-22 22:00:00',4),(5,1,'2021-05-22 22:00:00',5),(11,1,'2021-05-28 10:35:14',11),(14,1,'2021-05-29 05:21:54',14),(27,1,'2021-05-29 05:25:21',27),(54,1,'2021-06-03 10:30:49',54);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'kupatilo'),(2,'veš mašina'),(3,'wc šolja'),(4,'lavabo'),(5,'vodoinstalacije'),(6,'bojler'),(7,'tuš'),(8,'kuhinja'),(9,'sudopera'),(10,'mašina za sudove');
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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `termin`
--

LOCK TABLES `termin` WRITE;
/*!40000 ALTER TABLE `termin` DISABLE KEYS */;
INSERT INTO `termin` VALUES (1,'2021-05-23 00:00:00'),(2,'2021-05-23 06:00:00'),(3,'2021-05-23 08:00:00'),(4,'2021-05-23 02:00:00'),(5,'2021-05-23 14:00:00'),(6,'2021-05-23 16:00:00'),(7,'2021-05-23 10:00:00'),(8,'2021-05-23 22:00:00'),(9,'2021-05-23 20:00:00'),(10,'2021-05-24 14:00:00'),(11,'2021-05-24 16:00:00'),(12,'2021-05-25 14:00:00'),(13,'2021-05-25 20:00:00'),(14,'2021-05-25 22:00:00'),(15,'2021-05-24 18:00:00'),(16,'2021-05-24 20:00:00'),(17,'2021-05-24 12:00:00'),(18,'2021-05-24 06:00:00'),(19,'2021-05-24 08:00:00'),(20,'2021-05-24 10:00:00'),(21,'2021-06-01 06:00:00'),(22,'2021-06-01 08:00:00'),(23,'2021-06-01 14:00:00'),(24,'2021-06-01 20:00:00'),(25,'2021-05-25 12:00:00'),(26,'2021-05-25 06:00:00'),(27,'2021-05-25 08:00:00'),(28,'2021-05-26 06:00:00'),(29,'2021-05-26 12:00:00'),(30,'2021-05-26 14:00:00'),(31,'2021-05-26 08:00:00'),(32,'2021-06-01 22:00:00'),(33,'2021-06-01 16:00:00'),(34,'2021-05-28 20:00:00'),(35,'2021-05-29 14:00:00'),(36,'2021-05-29 20:00:00'),(37,'2021-05-31 12:00:00'),(38,'2021-05-31 14:00:00'),(39,'2021-05-31 16:00:00'),(40,'2021-05-31 22:00:00'),(41,'2021-05-31 20:00:00'),(42,'2021-05-31 18:00:00'),(43,'2021-06-02 06:00:00'),(44,'2021-06-01 12:00:00'),(45,'2021-06-01 00:00:00'),(46,'2021-06-01 02:00:00'),(47,'2021-06-01 10:00:00'),(48,'2021-05-31 06:00:00'),(49,'2021-05-31 08:00:00'),(50,'2021-05-31 10:00:00'),(51,'2021-06-01 18:00:00'),(52,'2021-05-31 00:00:00'),(53,'2021-06-02 02:00:00'),(54,'2021-06-02 08:00:00'),(55,'2021-06-02 12:00:00'),(56,'2021-06-02 14:00:00'),(57,'2021-06-02 20:00:00'),(58,'2021-06-02 18:00:00'),(59,'2021-06-02 22:00:00'),(60,'2021-06-02 16:00:00'),(61,'2021-06-02 10:00:00'),(62,'2021-06-03 20:00:00'),(63,'2021-06-03 18:00:00'),(64,'2021-06-03 12:00:00'),(65,'2021-06-03 14:00:00'),(66,'2021-06-03 22:00:00'),(67,'2021-06-03 16:00:00'),(68,'2021-06-05 20:00:00'),(69,'2021-06-05 14:00:00'),(70,'2021-06-05 18:00:00'),(71,'2021-06-06 18:00:00'),(72,'2021-06-06 12:00:00'),(73,'2021-06-06 14:00:00'),(74,'2021-06-06 20:00:00'),(75,'2021-06-06 22:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usluga`
--

LOCK TABLES `usluga` WRITE;
/*!40000 ALTER TABLE `usluga` DISABLE KEYS */;
INSERT INTO `usluga` VALUES (19,'Popravka dobro','Ja sam mnogo dobro',6000,1),(20,'Popravke 2','opis opis opis opis proba',3000,1),(34,'Nova usluga','Nova usluga',1500,1),(35,'Nova usluga 2','Nova usluga 2',1500,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uslugaostvarena`
--

LOCK TABLES `uslugaostvarena` WRITE;
/*!40000 ALTER TABLE `uslugaostvarena` DISABLE KEYS */;
INSERT INTO `uslugaostvarena` VALUES (2,19,'','1','0',1),(3,19,'kom','1','0',1),(4,19,'proba','0','0',2),(5,19,'kalina','0','1',3),(6,19,'dadaad','1','1',4),(7,19,NULL,'1','1',5),(12,19,NULL,'1','1',14),(13,20,NULL,'1','0',27),(18,20,NULL,NULL,'0',54);
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
INSERT INTO `uslugatag` VALUES (19,1),(19,9),(19,10),(20,1),(20,2),(20,3),(20,4),(20,5),(20,6),(20,7),(20,8),(20,9),(20,10),(34,2),(34,6),(34,7),(35,4),(35,7),(35,9);
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zahtev`
--

LOCK TABLES `zahtev` WRITE;
/*!40000 ALTER TABLE `zahtev` DISABLE KEYS */;
INSERT INTO `zahtev` VALUES (1,19,2,9,'Otpusi mi cev majstore','2021-05-22 22:00:00',-1),(2,19,2,10,'Majstore pomagaj','2021-05-22 22:00:00',-1),(3,19,2,21,'pomoc','2021-05-22 22:00:00',-1),(4,19,2,22,'super pomoc','2021-05-22 22:00:00',-1),(5,19,2,23,'U dnevnoj sobi ispod sudopere mi je pukla cev. hitno mi je potreban majstor da to sredi poplava je u kuci. Pomagajte','2021-05-22 22:00:00',-1),(11,20,2,32,'Nesto','2021-05-22 22:00:00',-1),(14,19,2,35,'OVAJ','2021-05-22 22:00:00',-1),(27,20,2,36,'U dnevnoj sobi ispod sudopere mi je pukla cev. hitno mi je potreban majstor da to sredi poplava je u kuci. Pomagajte','2021-05-22 22:00:00',-1),(54,20,2,65,'opis opis opis','2021-06-03 10:29:02',-1);
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

-- Dump completed on 2021-06-04  0:46:33
