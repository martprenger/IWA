-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: projectsemester2
-- ------------------------------------------------------
-- Server version	8.0.19

drop schema if exists weerstation;
create schema weerstation;

use weerstation;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country`
(
    `country_code` varchar(2)  NOT NULL,
    `country`      varchar(45) NOT NULL,
    PRIMARY KEY (`country_code`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf16;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `geolocation`
--

DROP TABLE IF EXISTS `geolocation`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `geolocation`
(
    `id`             int         NOT NULL AUTO_INCREMENT,
    `station_name`   varchar(10) NOT NULL,
    `country_code`   varchar(2)  NOT NULL,
    `island`         varchar(100) DEFAULT NULL,
    `county`         varchar(100) DEFAULT NULL,
    `place`          varchar(100) DEFAULT NULL,
    `hamlet`         varchar(100) DEFAULT NULL,
    `town`           varchar(100) DEFAULT NULL,
    `municipality`   varchar(100) DEFAULT NULL,
    `state_district` varchar(100) DEFAULT NULL,
    `administrative` varchar(100) DEFAULT NULL,
    `state`          varchar(100) DEFAULT NULL,
    `village`        varchar(100) DEFAULT NULL,
    `region`         varchar(100) DEFAULT NULL,
    `province`       varchar(100) DEFAULT NULL,
    `city`           varchar(100) DEFAULT NULL,
    `locality`       varchar(100) DEFAULT NULL,
    `postcode`       varchar(100) DEFAULT NULL,
    `country`        varchar(100) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_geolocation_station_name` (`station_name`),
    KEY `fk_geolocation_country_code` (`country_code`),
    CONSTRAINT `fk_geolocation_country_code` FOREIGN KEY (`country_code`) REFERENCES `country` (`country_code`),
    CONSTRAINT `fk_geolocation_station_name` FOREIGN KEY (`station_name`) REFERENCES `station` (`name`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 8001
  DEFAULT CHARSET = utf16;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nearestlocation`
--

DROP TABLE IF EXISTS `nearestlocation`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nearestlocation`
(
    `id`                     int         NOT NULL AUTO_INCREMENT,
    `station_name`           varchar(10) NOT NULL,
    `name`                   varchar(100) DEFAULT NULL,
    `administrative_region1` varchar(100) DEFAULT NULL,
    `administrative_region2` varchar(100) DEFAULT NULL,
    `country_code`           varchar(2)  NOT NULL,
    `longitude`              float       NOT NULL,
    `latitude`               float       NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_nearestlocation_station_name` (`station_name`),
    KEY `fk_nearestlocation_country_code` (`country_code`),
    CONSTRAINT `fk_nearestlocation_country_code` FOREIGN KEY (`country_code`) REFERENCES `country` (`country_code`),
    CONSTRAINT `fk_nearestlocation_station_name` FOREIGN KEY (`station_name`) REFERENCES `station` (`name`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 8001
  DEFAULT CHARSET = utf16;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `station`
--

DROP TABLE IF EXISTS `station`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `station`
(
    `id`        int         NOT NULL AUTO_INCREMENT,
    `name`      varchar(10) NOT NULL,
    `longitude` float       NOT NULL,
    `latitude`  float       NOT NULL,
    `elevation` float       NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf16;

--
-- Table structure for table `users`
--
drop table if exists users;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
create table users
(
    id       int auto_increment not null,
    username varchar(45)        not null,
    email    varchar(45)        not null,
    password varchar(45)        not null,
    primary key (id)
);

--
-- Table structure for table `rights`
--

drop table if exists rights;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
create table rights
(
    id   int auto_increment not null,
    name varchar(45)        not null,
    primary key (id)
);

--
-- Table structure for table `user_rights`
--

drop table if exists user_rights;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
create table user_rights
(
    user_id  int not null,
    right_id int not null,
    primary key (user_id, right_id),
    constraint fk_user_rights_rights
        foreign key (right_id) references rights (id),
    constraint fk_user_rights_users
        foreign key (user_id) references users (id)
);

--
-- Table structure for table `customers`
--

drop table if exists customers;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
create table customers
(
    id       int auto_increment not null,
    username varchar(45)        not null,
    email    varchar(45)        not null,
    password varchar(45)        not null,
    primary key (id)
);

--
-- Table structure for table `API_keys`
--

drop table if exists API_keys;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
create table API_keys
(
    id          int auto_increment not null,
    customer_id int                not null,
    api_key     varchar(45)        not null,
    primary key (id),
    foreign key (customer_id) references users (id)
);

--
-- Table structure for table `API_keys_station`
--

drop table if exists API_keys_station;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
create table API_keys_station
(
    api_key_id     int         not null,
    station_id     int         not null,
    primary key (api_key_id, station_id),
    foreign key (api_key_id) references API_keys (id),
    foreign key (station_id) references station (id)
);


/*!40101 SET character_set_client = @saved_cs_client */;

/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2022-03-10 18:01:03


