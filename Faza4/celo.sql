CREATE TABLE `kalendar` (
  `idMaj` int NOT NULL,
  `idTer` int NOT NULL,
  `idRez` int DEFAULT NULL,
  PRIMARY KEY (`idMaj`),
  KEY `fk_idTer_idx` (`idTer`),
  KEY `fk_idRez_idx` (`idRez`),
  CONSTRAINT `fk_idRez_kalendar` FOREIGN KEY (`idRez`) REFERENCES `rezervacija` (`idRez`) ON UPDATE CASCADE,
  CONSTRAINT `fk_idTer_kalendar` FOREIGN KEY (`idTer`) REFERENCES `termin` (`idTer`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `korisnik` (
  `idKor` int NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `brojTelefona` varchar(15) NOT NULL,
  `lozinka` varchar(20) NOT NULL,
  `slika` longtext,
  `uloga` int NOT NULL,
  `odobren` varchar(1) NOT NULL,
  PRIMARY KEY (`idKor`),
  KEY `fkUlogaKorisnik_idx` (`uloga`),
  CONSTRAINT `fk_Uloga_korisnik` FOREIGN KEY (`uloga`) REFERENCES `uloga` (`iduloga`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `rezervacija` (
  `idRez` int NOT NULL,
  `idMaj` int NOT NULL,
  `vremeOdgovora` datetime NOT NULL,
  PRIMARY KEY (`idRez`),
  KEY `fk_idMaj_idx` (`idMaj`),
  CONSTRAINT `fk_idMaj_rezervacija` FOREIGN KEY (`idMaj`) REFERENCES `korisnik` (`idKor`) ON UPDATE CASCADE,
  CONSTRAINT `fk_idRez_rezervacija` FOREIGN KEY (`idRez`) REFERENCES `zahtev` (`idZah`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `tag` (
  `idTag` int NOT NULL,
  `opis` varchar(45) NOT NULL,
  PRIMARY KEY (`idTag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `termin` (
  `idTer` int NOT NULL AUTO_INCREMENT,
  `datumVreme` datetime NOT NULL,
  PRIMARY KEY (`idTer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `uloga` (
  `iduloga` int NOT NULL,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`iduloga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `usluga` (
  `idUsl` int NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `opis` longtext NOT NULL,
  `cena` double NOT NULL,
  `idMaj` int NOT NULL,
  PRIMARY KEY (`idUsl`),
  KEY `fkIdMajstrora_idx` (`idMaj`),
  CONSTRAINT `fk_idMaj_usluga` FOREIGN KEY (`idMaj`) REFERENCES `korisnik` (`idKor`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `usluga-tag` (
  `idUsl` int NOT NULL,
  `idTag` int NOT NULL,
  PRIMARY KEY (`idUsl`,`idTag`),
  KEY `fk_idTag_idx` (`idTag`),
  CONSTRAINT `fk_idTag_usluga-tag` FOREIGN KEY (`idTag`) REFERENCES `tag` (`idTag`) ON UPDATE CASCADE,
  CONSTRAINT `fk_idUsl_usluga-tag` FOREIGN KEY (`idUsl`) REFERENCES `usluga` (`idUsl`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `uslugaostvarena` (
  `idUslOstv` int NOT NULL,
  `idUsl` int NOT NULL,
  `komentar` longtext,
  `ocena` varchar(1) DEFAULT NULL,
  `obrisano` varchar(1) NOT NULL,
  `idRez` int NOT NULL,
  PRIMARY KEY (`idUslOstv`),
  KEY `fk_idUsl_uslugaOtvorena_idx` (`idUsl`),
  KEY `fk_idRez_uslugaOstvarena_idx` (`idRez`),
  CONSTRAINT `fk_idRez_uslugaOstvarena` FOREIGN KEY (`idRez`) REFERENCES `rezervacija` (`idRez`) ON UPDATE CASCADE,
  CONSTRAINT `fk_idUsl_uslugaOtvorena` FOREIGN KEY (`idUsl`) REFERENCES `usluga` (`idUsl`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `zahtev` (
  `idZah` int NOT NULL AUTO_INCREMENT,
  `idKor` int NOT NULL,
  `opis` longtext NOT NULL,
  `idTer` int NOT NULL,
  `vremeSlanja` datetime NOT NULL,
  PRIMARY KEY (`idZah`),
  KEY `fk_IdKor_idx` (`idKor`),
  CONSTRAINT `fk_IdKor_zahtev` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`idKor`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
