CREATE DATABASE  IF NOT EXISTS `proyectofinal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `proyectofinal`;
-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: proyectofinal
-- ------------------------------------------------------
-- Server version	8.0.40-0ubuntu0.24.04.1

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
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `identification_number` varchar(255) DEFAULT NULL,
  `phone` int DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'Alberto','González','12345678A',600123456,'alberto.gonzalez@ejemplo.com'),(2,'Beatriz','Hernández','87654321B',600234567,'beatriz.hernandez@ejemplo.com'),(3,'Carlos','Martínez','23456789C',600345678,'carlos.martinez@ejemplo.com'),(4,'Diana','Pérez','98765432D',600456789,'diana.perez@ejemplo.com'),(5,'Esteban','López','34567890E',600567890,'esteban.lopez@ejemplo.com'),(6,'Fernando','Gómez','65432178F',600678901,'fernando.gomez@ejemplo.com'),(7,'Gabriela','Fernández','56781234G',600789012,'gabriela.fernandez@ejemplo.com'),(8,'Hugo','Rodríguez','34567821H',600890123,'hugo.rodriguez@ejemplo.com'),(9,'Isabel','Díaz','87654321I',600901234,'isabel.diaz@ejemplo.com'),(10,'Javier','Torres','12348765J',600912345,'javier.torres@ejemplo.com'),(11,'Karla','Ramírez','56781234K',600923456,'karla.ramirez@ejemplo.com'),(12,'Luis','Sánchez','43216789L',600934567,'luis.sanchez@ejemplo.com'),(13,'María','Castro','65432178M',600945678,'maria.castro@ejemplo.com'),(14,'Néstor','Hidalgo','12348765N',600956789,'nestor.hidalgo@ejemplo.com'),(15,'Olivia','Méndez','87654321O',600967890,'olivia.mendez@ejemplo.com'),(16,'Pedro','Alonso','34567821P',600978901,'pedro.alonso@ejemplo.com'),(17,'Quinta','Reyes','56781234Q',600989012,'quinta.reyes@ejemplo.com'),(18,'Raúl','Domínguez','43216789R',600990123,'raul.dominguez@ejemplo.com'),(19,'Sara','Velázquez','12348765S',600991234,'sara.velazquez@ejemplo.com'),(20,'Tomás','Moreno','65432178T',600992345,'tomas.moreno@ejemplo.com'),(21,'Úrsula','Giménez','87654321U',600993456,'ursula.gimenez@ejemplo.com'),(22,'Victor','Herrera','34567821V',600994567,'victor.herrera@ejemplo.com'),(23,'Wanda','Martín','56781234W',600995678,'wanda.martin@ejemplo.com'),(24,'Ximena','Salazar','43216789X',600996789,'ximena.salazar@ejemplo.com'),(25,'Yolanda','García','65432178Y',600997890,'yolanda.garcia@ejemplo.com'),(26,'Zacarías','Ruiz','12348765Z',600998901,'zacarias.ruiz@ejemplo.com'),(27,'Aitor','Navarro','87654321A',600999012,'aitor.navarro@ejemplo.com'),(28,'Blanca','Paredes','34567821B',600999123,'blanca.paredes@ejemplo.com'),(29,'Cristina','Campos','56781234C',600999234,'cristina.campos@ejemplo.com'),(30,'Diego','Vargas','43216789D',600999345,'diego.vargas@ejemplo.com'),(31,'Elena','Ortega','65432178E',600999456,'elena.ortega@ejemplo.com'),(32,'Fabián','Barrios','12348765F',600999567,'fabian.barrios@ejemplo.com'),(33,'Gloria','Montero','87654321G',600999678,'gloria.montero@ejemplo.com'),(34,'Héctor','Peña','34567821H',600999789,'hector.pena@ejemplo.com'),(35,'Inés','Ramos','56781234I',600999890,'ines.ramos@ejemplo.com'),(36,'Joaquín','Núñez','43216789J',600999901,'joaquin.nunez@ejemplo.com'),(37,'Karina','Carreño','65432178K',600999012,'karina.carreno@ejemplo.com'),(38,'Leonardo','Rosales','12348765L',600999123,'leonardo.rosales@ejemplo.com'),(39,'Manuela','Santana','87654321M',600999234,'manuela.santana@ejemplo.com'),(40,'Nicolás','Espinoza','34567821N',600999345,'nicolas.espinoza@ejemplo.com'),(41,'Olga','Molina','56781234O',600999456,'olga.molina@ejemplo.com'),(42,'Pablo','Pérez','43216789P',600999567,'pablo.perez@ejemplo.com'),(43,'Ramona','Delgado','65432178R',600999678,'ramona.delgado@ejemplo.com'),(44,'Salvador','Álvarez','12348765S',600999789,'salvador.alvarez@ejemplo.com'),(45,'Teresa','Márquez','87654321T',600999890,'teresa.marquez@ejemplo.com'),(46,'Ulises','Araya','34567821U',600999901,'ulises.araya@ejemplo.com'),(47,'Violeta','Correa','56781234V',600999012,'violeta.correa@ejemplo.com'),(48,'Wilfredo','Luna','43216789W',600999123,'wilfredo.luna@ejemplo.com'),(49,'Xiomara','Cabrera','65432178X',600999234,'xiomara.cabrera@ejemplo.com'),(50,'Yasmina','Albornoz','12348765Y',600999345,'yasmina.albornoz@ejemplo.com');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `driver` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver`
--

LOCK TABLES `driver` WRITE;
/*!40000 ALTER TABLE `driver` DISABLE KEYS */;
INSERT INTO `driver` VALUES (1,'Fernando','Sánchez',600678901),(2,'Gloria','Ramírez',600789012),(3,'Héctor','Jiménez',600890123),(4,'Inés','Mendoza',600901234),(5,'Javier','Vargas',600012345);
/*!40000 ALTER TABLE `driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `latitude` decimal(18,15) DEFAULT NULL,
  `longitude` decimal(18,15) DEFAULT NULL,
  `box_type` enum('large','medium','small') DEFAULT NULL,
  `maximum_permissible_mass` enum('50','20','10') DEFAULT NULL,
  `maximum_permissible_volume` enum('0.5','0.06','0.008') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,1,'2025-01-15 00:00:00','Calle Mayor de Triana, 35. Las Palmas de Gran Canaria. 35002',28.104873705450860,-15.415339761669202,'large','50','0.5'),(2,2,'2025-01-14 00:00:00','Avenida Mesa y López, 18. Las Palmas de Gran Canaria. 35006',28.135245247813895,-15.431815761282190,'medium','20','0.06'),(3,3,'2025-01-13 00:00:00','Calle León y Castillo, 227. Las Palmas de Gran Canaria. 35005',28.122169907548567,-15.428085861282600,'small','10','0.008'),(4,4,'2025-01-15 00:00:00','Calle Cano, 5. Las Palmas de Gran Canaria. 35002',28.104092688841640,-15.416198861283167,'large','50','0.5'),(5,5,'2025-01-15 00:00:00','Calle Luis Morote, 6. Las Palmas de Gran Canaria. 35007',28.141850562421446,-15.430583459469576,'large','50','0.5'),(6,6,'2025-01-14 00:00:00','Calle Pérez Galdós, 47. Las Palmas de Gran Canaria. 35002',28.107129193016520,-15.419785345976376,'medium','20','0.06'),(7,7,'2025-01-13 00:00:00','Calle Tomás Morales, 50. Las Palmas de Gran Canaria. 35004',28.110809661312530,-15.422344618988100,'medium','20','0.06'),(8,8,'2025-01-15 00:00:00','Calle Galicia, 25. Las Palmas de Gran Canaria. 35006',28.134467336957440,-15.433455436659413,'small','10','0.008'),(9,9,'2025-01-13 00:00:00','Calle Secretario Artiles, 42. Las Palmas de Gran Canaria. 35007',28.139961067994335,-15.431862903646087,'medium','20','0.06'),(10,10,'2025-01-15 00:00:00','Calle Viera y Clavijo, 29. Las Palmas de Gran Canaria. 35002',28.108036155235116,-15.418722803646888,'small','10','0.008'),(11,11,'2025-01-14 00:00:00','Calle Obispo Codina, 12. Las Palmas de Gran Canaria. 35002',28.099173911410480,-15.414010961317825,'medium','20','0.06'),(12,12,'2025-01-13 00:00:00','Calle Buenos Aires, 15. Las Palmas de Gran Canaria. 35002',28.107808327288687,-15.418508774811750,'small','10','0.008'),(13,13,'2025-01-15 00:00:00','Calle Murga, 9. Las Palmas de Gran Canaria. 35002',28.111390439817110,-15.418439632482155,'small','10','0.008'),(14,14,'2025-01-13 00:00:00','Calle Venegas, 30. Las Palmas de Gran Canaria. 35003',28.111617907595875,-15.417801330635143,'medium','20','0.06'),(15,15,'2025-01-13 00:00:00','Calle Domingo J. Navarro, 24. Las Palmas de Gran Canaria. 35002',28.107307301296892,-15.418727217141140,'large','50','0.5'),(16,16,'2025-01-15 00:00:00','Calle General Bravo, 36. Las Palmas de Gran Canaria. 35002',28.104896277300810,-15.417984890152985,'large','50','0.5'),(17,17,'2025-01-15 00:00:00','Calle Triana, 78. Las Palmas de Gran Canaria. 35002',28.106422175877302,-15.416067230635235,'medium','20','0.06'),(18,18,'2025-01-14 00:00:00','Calle Mendizábal, 14. Las Palmas de Gran Canaria. 35002',28.102283155890895,-15.413508332482433,'small','10','0.008'),(19,19,'2025-01-12 00:00:00','Calle Domingo Doreste, 11. Las Palmas de Gran Canaria. 35002',28.098537805146474,-15.412821517141369,'small','10','0.008'),(20,20,'2025-01-13 00:00:00','Calle Pérez Muñoz, 8. Las Palmas de Gran Canaria. 35002',28.148788333667664,-15.426576974810562,'medium','20','0.06'),(21,21,'2025-01-14 00:00:00','Calle Torres, 22. Las Palmas de Gran Canaria. 35002',28.104575734704827,-15.416999530635335,'large','50','0.5'),(22,22,'2025-01-15 00:00:00','Calle Buenos Aires, 7. Las Palmas de Gran Canaria. 35002',28.108055801144957,-15.417998094335468,'large','50','0.5'),(23,23,'2025-01-15 00:00:00','Calle Murga, 15. Las Palmas de Gran Canaria. 35002',28.111321876726453,-15.419033976658676,'medium','20','0.06'),(24,24,'2025-01-13 00:00:00','Calle Venegas, 14. Las Palmas de Gran Canaria. 35003',28.111557819806600,-15.417626807828805,'small','10','0.008'),(25,25,'2025-01-14 00:00:00','Calle Domingo J. Navarro, 18. Las Palmas de Gran Canaria. 35002',28.107498759692750,-15.418312543412044,'large','50','0.5'),(26,26,'2025-10-15 00:00:00','Calle León y Castillo, 7. Telde. 35200',28.109717027288607,-15.418172894334969,'large','50','0.5'),(27,27,'2025-01-15 00:00:00','Calle Betancor Fabelo, 23. Telde. 35200',27.995741625715297,-15.417285101105405,'medium','20','0.06'),(28,28,'2025-01-13 00:00:00','Avenida del Cabildo, 45. Telde. 35200',27.999258479688056,-15.418450190155886,'medium','20','0.06'),(29,29,'2025-01-15 00:00:00','Calle Goya, 12. Telde. 35200',27.995825767854647,-15.377166080864129,'small','10','0.008'),(30,30,'2025-01-15 00:00:00','Calle Picasso, 10. Telde. 35200',27.980873996236475,-15.393205688309216,'medium','20','0.06'),(31,31,'2025-01-14 00:00:00','C. Pastor, 10. Telde. 35200',27.978173678430828,-15.388999984658453,'small','10','0.008'),(32,32,'2025-01-12 00:00:00','Calle Poeta Pablo Neruda, 3. Telde. 35200',27.998202585596555,-15.413781588308836,'medium','20','0.06'),(33,33,'2025-01-13 00:00:00','Calle León y Castillo, 15. Arucas. 35400',28.118529352256854,-15.523806467345018,'large','50','0.5'),(34,34,'2025-01-14 00:00:00','Calle Doctor Fleming, 5. Arucas. 35400',28.120351086413606,-15.521165317140746,'large','50','0.5'),(35,35,'2025-01-15 00:00:00','Calle Alcalde Suárez Franchy, 12. Arucas. 35400',28.118520014965892,-15.525459903646665,'medium','20','0.06'),(36,36,'2025-01-15 00:00:00','Calle San Juan, 8. Arucas. 35400',28.119138163617130,-15.523746476658493,'medium','20','0.06'),(37,37,'2025-01-13 00:00:00','P.º Poeta Pedro Lezcano, 9. Arucas. 35400',28.117806177937283,-15.527907745976107,'small','10','0.008'),(38,38,'2025-01-14 00:00:00','Calle Capitán Quesada, 1. Gáldar. 35460',28.145681778368214,-15.654680390151794,'medium','20','0.06'),(39,39,'2025-01-15 00:00:00','Calle Guaires, 23. Gáldar. 35460',28.144654761880307,-15.656984859469423,'small','10','0.008'),(40,40,'2025-01-15 00:00:00','Calle Doramas, 10. Gáldar. 35460',28.147103416687190,-15.652112803645842,'medium','20','0.06'),(41,41,'2025-01-13 00:00:00','Avenida de Tirajana, 28. San Bartolomé de Tirajana. 35100',27.759638115236836,-15.578936812250632,'large','50','0.5'),(42,42,'2025-01-14 00:00:00','Calle Las Dunas, 15. San Bartolomé de Tirajana. 35100',27.754178583069194,-15.568713515303617,'large','50','0.5'),(43,43,'2025-01-15 00:00:00','Avenida de Canarias, 150. Santa Lucía de Tirajana. 35110',27.855354328089884,-15.438902874145585,'medium','20','0.06'),(44,44,'2025-01-15 00:00:00','Calle Primero de Mayo, 5. Santa Lucía de Tirajana. 35110',27.856116101206077,-15.439562166224444,'medium','20','0.06'),(45,45,'2025-01-13 00:00:00','Av. del Atlántico, 363. Santa Lucía de Tirajana. 35110',27.845162062588027,-15.439222995983622,'large','50','0.5'),(46,46,'2025-01-14 00:00:00','Calle Ansite, 7. Santa Lucía de Tirajana. 35110',27.880793370545460,-15.431213893211924,'large','50','0.5'),(47,47,'2025-01-15 00:00:00','Calle Tagoror, 18. Santa Lucía de Tirajana. 35110',27.870590657005590,-15.420390332488758,'medium','20','0.06'),(48,48,'2025-01-14 00:00:00','Calle Tirma, 10. Santa Lucía de Tirajana. 35110',27.879736881460524,-15.432988090159098,'medium','20','0.06'),(49,49,'2025-01-12 00:00:00','Calle Garajonay, 22. Santa Lucía de Tirajana. 35110',27.878229534822044,-15.434403694382077,'small','10','0.008'),(50,50,'2025-01-15 00:00:00','C. de Fataga, 18. Santa Lucía de Tirajana. 35110',27.854667648039545,-15.442144118995131,'medium','20','0.06');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `route` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `truck_id` int DEFAULT NULL,
  `route_date` datetime DEFAULT NULL,
  `estimated_duration` time DEFAULT NULL,
  `total_distance` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `truck_id` (`truck_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `route_ibfk_1` FOREIGN KEY (`truck_id`) REFERENCES `truck` (`id`),
  CONSTRAINT `route_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route`
--

LOCK TABLES `route` WRITE;
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
/*!40000 ALTER TABLE `route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `truck`
--

DROP TABLE IF EXISTS `truck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `truck` (
  `id` int NOT NULL AUTO_INCREMENT,
  `driver_id` int DEFAULT NULL,
  `license_plate` varchar(255) DEFAULT NULL,
  `availability` enum('Available','Not available','Maintenance') DEFAULT NULL,
  `max_mass` int DEFAULT NULL,
  `max_volume` int DEFAULT NULL,
  `max_permissible_volume` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `driver_id` (`driver_id`),
  CONSTRAINT `truck_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `truck`
--

LOCK TABLES `truck` WRITE;
/*!40000 ALTER TABLE `truck` DISABLE KEYS */;
INSERT INTO `truck` VALUES (1,1,'1234BCD','Available',1329,11,9.00),(2,2,'5678FGH','Available',1329,11,9.00),(3,3,'9101JKL','Available',1329,11,9.00),(4,4,'2345MNP','Available',1329,11,9.00),(5,5,'6789KRS','Available',1329,11,9.00),(6,1,'3456MMV','Available',1329,11,9.00),(7,2,'7890MXY','Available',1329,11,9.00),(8,3,'4567BGH','Available',1329,11,9.00),(9,4,'8912LMN','Available',1329,11,9.00),(10,5,'1230LRT','Available',1329,11,9.00);
/*!40000 ALTER TABLE `truck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'proyectofinal'
--

--
-- Dumping routines for database 'proyectofinal'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-15 16:06:52
