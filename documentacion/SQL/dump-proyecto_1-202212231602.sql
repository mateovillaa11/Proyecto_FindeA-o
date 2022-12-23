-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: proyecto_1
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cargo` (
  `id` int(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` VALUES (1,'Recepcionista'),(2,'Encargado'),(3,'Repartidor');
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `CI` int(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `estado` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`CI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Julian','Alvarez','1',0),(777,'cristiano','ronaldo','800',0),(5432210,'Esteba','Ruiz','094123324',1),(11124906,'Gemma','Frances','098517202',1),(11411115,'Iryna','Alvarado','093123223',1),(12821916,'Omar','Fernandez','09463281',1),(21947350,'Carlos ','Talavera','096623291',1),(25554442,'Matias','Olivera','094133325',1),(27735979,'Mirian','Sanz','092222999',1),(35411432,'Angela','Maria Roig','094123325',1),(37725881,'Anibal','Moreno','097511476',1),(41115113,'Svetlana','Puente','093123211',1),(42221436,'Raul','Roman','094123725',1),(42627848,'Aida','Jaime','091851720',1),(61611414,'Guillem','Mansilla','093123122',1);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamentos` (
  `id` int(19) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'Montevideo'),(2,'canelones'),(3,'San Jose'),(4,'Maldonado'),(5,'Rocha'),(6,'Colonia'),(7,'Lavalleja'),(8,'Florida'),(9,'Flores'),(10,'Soriano'),(11,'Rio Negro'),(12,'Durazno'),(13,'Treinta y Tres'),(14,'Cerro Largo'),(15,'Paysandu'),(16,'Tacuarembo'),(17,'Rivera'),(18,'Salto'),(19,'Artigas');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `envios`
--

DROP TABLE IF EXISTS `envios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `envios` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `CI_cliente` int(20) NOT NULL,
  `destinatario` varchar(50) NOT NULL,
  `id_departamentos` int(19) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `puerta` int(50) NOT NULL,
  `FechaRecibido` date NOT NULL,
  `id_estado` int(3) NOT NULL,
  `estado` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estado` (`id_estado`),
  KEY `CI_cliente` (`CI_cliente`),
  KEY `id_departamentos` (`id_departamentos`),
  CONSTRAINT `fk_CI_cliente_CI` FOREIGN KEY (`CI_cliente`) REFERENCES `cliente` (`CI`),
  CONSTRAINT `fk_id_departamentos_id` FOREIGN KEY (`id_departamentos`) REFERENCES `departamentos` (`id`),
  CONSTRAINT `fk_id_estado_id` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `envios`
--

LOCK TABLES `envios` WRITE;
/*!40000 ALTER TABLE `envios` DISABLE KEYS */;
INSERT INTO `envios` VALUES (1,11411115,'Mateo',1,'18 de julio',4119,'2022-11-20',2,0),(2,5432210,'Agustin',1,'General Hornos',211,'2022-10-21',3,1),(3,5432210,'Marcos',2,'Canelones',241,'2022-11-23',3,1),(4,35411432,'Rodrigo',4,'Maldonado',21,'2022-11-22',2,1),(5,11411115,'Mateo',1,'18 de julio',4119,'2022-11-25',2,1),(6,11124906,'Santiago',1,'11',12,'2022-12-19',1,0),(7,12821916,'Messi',1,'1',212,'2022-12-20',1,0),(8,42627848,'Cristiano ',3,'2',3,'2022-12-21',2,0),(9,27735979,'Diego',1,'18 de julio',4321,'2022-12-20',1,1),(10,12821916,'Roman',5,'avenida treinta y tres',33,'2022-12-22',1,0),(11,42221436,'Jose Luis',15,'paysandu',888,'2022-12-22',1,1);
/*!40000 ALTER TABLE `envios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `id` int(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'pendiente'),(2,'enviado'),(3,'recibido');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionarios` (
  `ci` int(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `id_cargo` int(3) NOT NULL,
  `estado` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`ci`),
  KEY `id_cargo` (`id_cargo`),
  CONSTRAINT `fk_id_cargo_id` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (2,'juan','lopez','2','d10s@gmail.com',3,0),(2121343,'Marisa','Da Luz','093723892','Marisa@gmail.com',3,1),(12221112,'Guillermo','Mendez','092453223','Guille@gmail.com',3,1),(32221112,'Valeria','Rodriguez','095124323','Vale@gmail.com',1,1),(43322216,'Esteban','Lopez','096555789','EstabanElrey@gmail.com',3,1),(44565432,'Laura','Fuentes','091623271','Laura@gmail.com',2,1);
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` varchar(100) NOT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','AdminEmpresa1@gmail.com','21232f297a57a5a743894a0e4a801fc3','administrador',1),(2,'encargado','encargados@gmail.com','cb0d0277094bffbf04eceb3a6091cfaa','encargado',1),(3,'recepcionista','recepcionista@gmail.com','6e1a5113640fa25ca9d466fa128f367a','recepcionista',1),(4,'repartidor','repartidor@gmail.com','c0036674228ee9d9a7e60a44b6c58544','repartidor',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'proyecto_1'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-23 16:02:45
