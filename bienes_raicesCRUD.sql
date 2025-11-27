-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
-- Host: localhost    Database: bienesraices_crud
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Base de Datos
--
CREATE DATABASE IF NOT EXISTS bienesraices_crud DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bienesraices_crud;

-- -----------------------------------------------------
-- 1. Estructura de tabla para `vendedores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vendedores`;
CREATE TABLE `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Volcado de datos para `vendedores`
LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'Carlos','Martinez','9993240893'),(2,'Benito','Martínez','7884412154'),(5,' Andrea','González','9998451274'),(6,' Cristiano Actualizado','Ronaldo','7854123654');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;

-- -----------------------------------------------------
-- 2. Estructura de tabla para `propiedades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `propiedades`;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamiento` varchar(45) DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedores_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_propiedades_vendedores1_idx` (`vendedores_id`),
  CONSTRAINT `fk_propiedades_vendedores1` FOREIGN KEY (`vendedores_id`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb3;

-- Volcado de datos para `propiedades`
LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` VALUES (39,' Nueva casa bonita',784651.00,'187e53a85249c8ef47f635fcfaeb71bf.jpg','Mensaje de prueba Mensaje de prueba Mensaje de prueba Mensaje de prueba Mensaje de prueba Mensaje de prueba Mensaje de prueba ',2,3,'4','2023-05-16',1),(40,' Otra casa',4657899.00,'6ee1dbff90804af833e7d74e53b7fcf7.jpg','Mensaje de prueba Mensaje de prueba Mensaje de prueba Mensaje de prueba Mensaje de prueba Mensaje de prueba ',8,9,'2','2023-05-16',2),(55,' Casa nueva nueva ',67845.00,'f2ff1adc71bd933e2f8ad0d433f89aab.jpg','propiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedad',5,5,'6','2023-05-30',1),(59,' Casa en la playa MVC',79864531.00,'1b2e08a48ad1cfd82ee5c3befa90477b.jpg','Casa en la playa MVCCasa en la playa MVCCasa en la playa MVCCasa en la playa MVCCasa en la playa MVCCasa en la playa MVCCasa en la playa MVC',2,4,'4','2023-06-02',5);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

-- -----------------------------------------------------
-- 3. Estructura de tabla para `roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcado de datos para `roles`
LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin'),(2,'Editor'),(3,'Comprador');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

-- -----------------------------------------------------
-- 4. Estructura de tabla para `permisos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcado de datos para `permisos`
LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES 
(1,'Ver Admin','ver_admin'),
(2,'Crear Propiedad','crear_propiedad'),
(3,'Actualizar Propiedad','actualizar_propiedad'),
(4,'Eliminar Propiedad','eliminar_propiedad'),
(5,'Crear Vendedor','crear_vendedor'),
(6,'Actualizar Vendedor','actualizar_vendedor'),
(7,'Eliminar Vendedor','eliminar_vendedor'),
(8,'Comprar Propiedad','comprar_propiedad');
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

-- -----------------------------------------------------
-- 5. Estructura de tabla para `roles_permisos` (Pivote)
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roles_permisos`;
CREATE TABLE `roles_permisos` (
  `rol_id` int NOT NULL,
  `permiso_id` int NOT NULL,
  KEY `fk_roles_permisos_roles_idx` (`rol_id`),
  KEY `fk_roles_permisos_permisos_idx` (`permiso_id`),
  CONSTRAINT `fk_roles_permisos_permisos` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_roles_permisos_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcado de datos para `roles_permisos`
LOCK TABLES `roles_permisos` WRITE;
/*!40000 ALTER TABLE `roles_permisos` DISABLE KEYS */;
-- Asignamos TODOS los permisos (1 al 8) al Super Admin (Rol 1)
INSERT INTO `roles_permisos` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8);
-- Asignamos permisos de Editor (Rol 2) - Ejemplo
INSERT INTO `roles_permisos` VALUES (2,1),(2,2),(2,3); 
-- Asignamos permisos de Comprador (Rol 3)
INSERT INTO `roles_permisos` VALUES (3,8); 
/*!40000 ALTER TABLE `roles_permisos` ENABLE KEYS */;
UNLOCK TABLES;

-- -----------------------------------------------------
-- 6. Estructura de tabla para `usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rol_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuarios_roles_idx` (`rol_id`),
  CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcado de datos para `usuarios`
LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;

-- 1. Tu Super Admin (ID 1)
INSERT INTO `usuarios` VALUES (1,'correo@correo.com','$2y$10$smxhYWS5fRVso2t.x6FD9Omw966zbaTCCsH8ghazzvW/.R9P7uQ1S', 1);

-- 2. Comprador de prueba (ID 2)
INSERT INTO `usuarios` VALUES (2,'usuario@correo.com','$2y$10$HDxlv0dhTAaJILOBNxFHDeyo1i8IITzVoj1CaI1vmWqasteLFghri', 3);

-- 3. NUEVOS USUARIOS SIN ROL (rol_id = NULL)
INSERT INTO `usuarios` VALUES (4,'visitante1@correo.com','$2y$10$HDxlv0dhTAaJILOBNxFHDeyo1i8IITzVoj1CaI1vmWqasteLFghri', NULL);
INSERT INTO `usuarios` VALUES (5,'visitante2@correo.com','$2y$10$HDxlv0dhTAaJILOBNxFHDeyo1i8IITzVoj1CaI1vmWqasteLFghri', NULL);
INSERT INTO `usuarios` VALUES (6,'visitante3@correo.com','$2y$10$HDxlv0dhTAaJILOBNxFHDeyo1i8IITzVoj1CaI1vmWqasteLFghri', NULL);

/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;