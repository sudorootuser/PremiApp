/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.24-MariaDB : Database - premiapp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`premiapp` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `premiapp`;

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `cliente_id` int(10) NOT NULL AUTO_INCREMENT,
  `cliente_dni` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_apellido` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_direccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `cliente` */

insert  into `cliente`(`cliente_id`,`cliente_dni`,`cliente_nombre`,`cliente_apellido`,`cliente_telefono`,`cliente_direccion`) values (3,'1003652438','Juan Sebastian','Hernandez Cardenas','3227405024','Carrera 75L bis 62 H #66 Sur'),(5,'3242344234','Juan','Hernandez','3227405024','Carrera 75L bis 62 H #66 Sur');

/*Table structure for table `notificaciones` */

DROP TABLE IF EXISTS `notificaciones`;

CREATE TABLE `notificaciones` (
  `idnotificaciones` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `activa` int(11) NOT NULL,
  PRIMARY KEY (`idnotificaciones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `notificaciones` */

/*Table structure for table `participantes` */

DROP TABLE IF EXISTS `participantes`;

CREATE TABLE `participantes` (
  `idparticipantes` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inscripcion` varchar(45) NOT NULL,
  `usuarios_idusuarios` int(11) NOT NULL,
  `promociones_idpromociones` int(11) NOT NULL,
  PRIMARY KEY (`idparticipantes`),
  KEY `fk_participantes_usuarios_idx` (`usuarios_idusuarios`),
  KEY `fk_participantes_promociones1_idx` (`promociones_idpromociones`),
  CONSTRAINT `fk_participantes_promociones1` FOREIGN KEY (`promociones_idpromociones`) REFERENCES `promociones` (`idpromociones`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_participantes_usuarios` FOREIGN KEY (`usuarios_idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `participantes` */

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `idproductos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`idproductos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `productos` */

/*Table structure for table `promociones` */

DROP TABLE IF EXISTS `promociones`;

CREATE TABLE `promociones` (
  `idpromociones` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `maximo_participantes` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `productos_idproductos` int(11) NOT NULL,
  PRIMARY KEY (`idpromociones`),
  KEY `fk_promociones_productos1_idx` (`productos_idproductos`),
  CONSTRAINT `fk_promociones_productos1` FOREIGN KEY (`productos_idproductos`) REFERENCES `productos` (`idproductos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `promociones` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_dni` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `user_firstname` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `user_lastname` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `user_phone` decimal(10,0) NOT NULL,
  `user_address` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `user_email` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `user_username` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `user_key` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `user_state` varchar(6) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'active',
  `user_privilege` int(2) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Data for the table `user` */

insert  into `user`(`user_id`,`user_dni`,`user_firstname`,`user_lastname`,`user_phone`,`user_address`,`user_email`,`user_username`,`user_key`,`user_state`,`user_privilege`) values (1,'0000000000','Administrador',' Principal',3227405024,'Administrador','Administrador@gmail.com','Administrador','dWFBeENEeEZXdm9qeVZxSW9uU3RGZz09','active',1),(2,'1003652437','Juan Sebastian','Cardenas Hernandez',3227405024,'Carrera 75L bis 62 H #66 Sur','rrejuancho1999@gmail.com','rrejuancho1999','dWFBeENEeEZXdm9qeVZxSW9uU3RGZz09','active',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
