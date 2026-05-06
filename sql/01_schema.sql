-- Notebook adatbázis - ReNew Kft.
-- Generálva a feltöltött .txt adatfájlokból.
-- MySQL / MariaDB / phpMyAdmin kompatibilis.

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `gep`;
DROP TABLE IF EXISTS `processzor`;
DROP TABLE IF EXISTS `oprendszer`;

CREATE TABLE `oprendszer` (
  `id` INT NOT NULL,
  `nev` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

CREATE TABLE `processzor` (
  `id` INT NOT NULL,
  `gyarto` VARCHAR(50) NOT NULL,
  `tipus` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

CREATE TABLE `gep` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `gyarto` VARCHAR(50) NOT NULL,
  `tipus` VARCHAR(150) NOT NULL,
  `kijelzo` DECIMAL(3,1) NOT NULL,
  `memoria` INT NOT NULL,
  `merevlemez` INT NOT NULL,
  `videovezerlo` VARCHAR(150) NOT NULL,
  `ar` INT NOT NULL,
  `processzorid` INT NOT NULL,
  `oprendszerid` INT NOT NULL,
  `db` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_gep_processzorid` (`processzorid`),
  KEY `idx_gep_oprendszerid` (`oprendszerid`),
  CONSTRAINT `fk_gep_processzor` FOREIGN KEY (`processzorid`) REFERENCES `processzor` (`id`),
  CONSTRAINT `fk_gep_oprendszer` FOREIGN KEY (`oprendszerid`) REFERENCES `oprendszer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

SET FOREIGN_KEY_CHECKS = 1;
