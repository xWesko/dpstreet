# Host: localhost  (Version 5.7.14)
# Date: 2019-07-17 18:19:31
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "clientes"
#

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id_cliente` bigint(20) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(40) NOT NULL,
  `ap_cliente` varchar(50) NOT NULL,
  `am_cliente` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(80) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "clientes"
#

/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'javier','romero','armenta','3232457698','yeabeibe@gmail.com'),(2,'carlos','osuna','beibe','3232443438','maquinadefuego@gmail.com'),(3,'romero','bleik','urrutia','32324656598','beilbel@gmal.com'),(4,'armeta','botellon','ochoa','323656576','elmejor@gmail.com'),(5,'Erick','Gallegos','Rivera','32324579879','paikujan@gmail.com');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

#
# Structure for table "productos"
#

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id_producto` bigint(20) NOT NULL AUTO_INCREMENT,
  `producto` varchar(60) NOT NULL,
  `precio` decimal(15,2) NOT NULL,
  `marca` varchar(40) NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "productos"
#

/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'air',1000.00,'jordan'),(2,'lebron',1100.00,'nike'),(3,'max',1200.00,'reebok'),(4,'blue',1300.00,'vans'),(5,'red',1400.00,'converse');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

#
# Structure for table "usuarios"
#

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `cuenta` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `idioma` int(5) NOT NULL,
  `nivel` int(3) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "usuarios"
#

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'gahelito','gahel@gmail.com','202cb962ac59075b964b07152d234b70',1,1),(3,'carlos','carlo@gmail.com','202cb962ac59075b964b07152d234b70',2,2),(7,'fernando','fer@gmail.com','202cb962ac59075b964b07152d234b70',2,1),(8,'daniela','dani@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',1,1),(9,'jose','jose@gmail.com','202cb962ac59075b964b07152d234b70',1,1),(10,'German','germano@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',1,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

#
# Structure for table "ventas"
#

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas` (
  `id_venta` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_cliente` bigint(20) NOT NULL,
  `id_producto` bigint(20) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(15) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `id_usuariof` (`id_usuario`),
  KEY `id_productof` (`id_producto`),
  KEY `id_clientef` (`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

#
# Data for table "ventas"
#

/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (1,1,1,1,'2018-01-12',1,1000.00),(2,2,2,2,'2018-01-13',1,1100.00),(3,3,3,3,'2018-01-15',1,1200.00),(4,4,4,4,'2018-01-19',1,1300.00),(5,5,5,5,'2018-01-20',1,1400.00),(6,1,3,3,'2018-03-05',1,1000.00),(11,1,2,1,'2019-07-17',2,5000.00);
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
