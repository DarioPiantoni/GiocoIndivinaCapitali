
-- Dump della struttura del database newworld
CREATE DATABASE IF NOT EXISTS newworld;
USE newworld;

-- Dump della struttura di tabella newworld.country
CREATE TABLE IF NOT EXISTS country (
  Code char(3) PRIMARY KEY,
  Name varchar(52) NOT NULL DEFAULT '',
  Continent enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') NOT NULL DEFAULT 'Asia',
  Region varchar(26) NOT NULL DEFAULT '',
  SurfaceArea float(10,2) NOT NULL DEFAULT '0.00',
  IndepYear smallint(6) DEFAULT NULL,
  Population int(11) NOT NULL DEFAULT '0',
  LifeExpectancy float(3,1) DEFAULT NULL,
  GNP float(10,2) DEFAULT NULL,
  GNPOld float(10,2) DEFAULT NULL,
  LocalName varchar(45) NOT NULL DEFAULT '',
  GovernmentForm varchar(45) NOT NULL DEFAULT '',
  HeadOfState varchar(60) DEFAULT NULL,
  Capital int(11) DEFAULT NULL,
  Code2 char(2) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dump della struttura di tabella newworld.city
CREATE TABLE IF NOT EXISTS city (
  ID int(11) AUTO_INCREMENT PRIMARY KEY,
  Name varchar(35) NOT NULL DEFAULT '',
  CountryCode char(3) NOT NULL DEFAULT '',
  District varchar(20) DEFAULT NULL,
  Population int(11) NOT NULL DEFAULT '0',
  FOREIGN KEY (CountryCode) REFERENCES country (Code)
) ENGINE=InnoDB AUTO_INCREMENT=4080 DEFAULT CHARSET=latin1;

-- Dump della struttura di tabella newworld.language
CREATE TABLE IF NOT EXISTS language (
  Id int(11) AUTO_INCREMENT PRIMARY KEY,
  LanguageName varchar(30) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=512 DEFAULT CHARSET=latin1;

-- Dump della struttura di tabella newworld.countrylanguage
CREATE TABLE IF NOT EXISTS countrylanguage (
  CountryCode char(3) NOT NULL DEFAULT '',
  IsOfficial enum('T','F') NOT NULL DEFAULT 'F',
  Percentage float(4,1) NOT NULL DEFAULT '0.0',
  idLanguage int(11) NOT NULL,
  PRIMARY KEY (idLanguage,CountryCode),
  FOREIGN KEY (idLanguage) REFERENCES language (Id),
  FOREIGN KEY (CountryCode) REFERENCES country (Code)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





