-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 20, 2019 at 07:47 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marcas`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `crearPerfil`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `crearPerfil` (IN `pCedula` VARCHAR(15), IN `pNombre` VARCHAR(25), IN `pApellido1` VARCHAR(25), IN `pApellido2` VARCHAR(25), IN `pFechaNacimiento` DATE, IN `pImg` VARCHAR(150), IN `pIdUsuario` INT(11), IN `pUsuario` VARCHAR(25), IN `pContrasena` VARCHAR(50), IN `pTipo` INT(11))  BEGIN
START TRANSACTION;
INSERT INTO persona (id, cedula, nombre, ape01, ape02,fechaNacimiento, img, creacionFecha, idCreador,ultimoUpdateFecha,idModificador)
VALUES(0, pCedula, pNombre, pApellido1,pApellido2, pFechaNacimiento, pImg, NOW(), pIdUsuario, NOW(), pIdUsuario);

SET @id = null;
SELECT @id:=id from persona where cedula=pCedula;

INSERT INTO user(id, idPersona, user, password, tipo,creacionFecha, idCreador, ultimoUpdateFecha,idModificador)
VALUES(0,@id, pUsuario,MD5(pContrasena), pTipo,NOW(), pIdUsuario, NOW(), pIdUsuario);

COMMIT;
END$$

DROP PROCEDURE IF EXISTS `traerHoraMarcas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `traerHoraMarcas` (`idPersonaM` INT, `idMarca` INT)  BEGIN
    Select
            if(mEntradaLaboral IS NOT NULL,
              CONCAT( 

               IF(HOUR(mEntradaLaboral) = 0,
               CONCAT(HOUR(mEntradaLaboral) + 12),
                   if(HOUR(mEntradaLaboral) = 12,
          		    CONCAT(HOUR(mEntradaLaboral)),
                          IF (HOUR(mEntradaLaboral)- 12 < 10,
                          CONCAT("0",HOUR(mEntradaLaboral) - 12),
                          CONCAT(HOUR(mEntradaLaboral) - 12)
                             )
                     )
               ),
               ":",              

               IF(MINUTE(mEntradaLaboral) < 10,
                  CONCAT("0",MINUTE(mEntradaLaboral)),
                  CONCAT(MINUTE(mEntradaLaboral))
               ),

               " ",

                IF(HOUR(mEntradaLaboral) >= 12,
                  CONCAT("PM"),
                  CONCAT("AM")
                )


              ), mEntradaLaboral) as mEntradaLaboral ,

              if(mSalidaAlmuerzo IS NOT NULL,
              CONCAT( 

               IF(HOUR(mSalidaAlmuerzo) = 0,
               CONCAT(HOUR(mSalidaAlmuerzo) + 12),
                   if(HOUR(mSalidaAlmuerzo) = 12,
          		    CONCAT(HOUR(mSalidaAlmuerzo)),
                          IF (HOUR(mSalidaAlmuerzo)- 12 < 10,
                          CONCAT("0",HOUR(mSalidaAlmuerzo) - 12),
                          CONCAT(HOUR(mSalidaAlmuerzo) - 12)
                             )
                     )
               ),
               ":",              

               IF(MINUTE(mSalidaAlmuerzo) < 10,
                  CONCAT("0",MINUTE(mSalidaAlmuerzo)),
                  CONCAT(MINUTE(mSalidaAlmuerzo))
               ),

               " ",

                IF(HOUR(mSalidaAlmuerzo) >= 12,
                  CONCAT("PM"),
                  CONCAT("AM")
                )


              ),mSalidaAlmuerzo) as mSalidaAlmuerzo ,

                if(mEntradaAlmuerzo IS NOT NULL,
              CONCAT( 

               IF(HOUR(mEntradaAlmuerzo) = 0,
               CONCAT(HOUR(mEntradaAlmuerzo) + 12),
                   if(HOUR(mEntradaAlmuerzo) = 12,
          		    CONCAT(HOUR(mEntradaAlmuerzo)),
                          IF (HOUR(mEntradaAlmuerzo)- 12 < 10,
                          CONCAT("0",HOUR(mEntradaAlmuerzo) - 12),
                          CONCAT(HOUR(mEntradaAlmuerzo) - 12)
                             )
                     )
               ),
               ":",              

               IF(MINUTE(mEntradaAlmuerzo) < 10,
                  CONCAT("0",MINUTE(mEntradaAlmuerzo)),
                  CONCAT(MINUTE(mEntradaAlmuerzo))
               ),

               " ",

                IF(HOUR(mEntradaAlmuerzo) >= 12,
                  CONCAT("PM"),
                  CONCAT("AM")
                )


              ),mEntradaAlmuerzo) as mEntradaAlmuerzo,

                  if(mSalidaLaboral IS NOT NULL,
              CONCAT( 

               IF(HOUR(mSalidaLaboral) = 0,
               CONCAT(HOUR(mSalidaLaboral) + 12),
                   if(HOUR(mSalidaLaboral) = 12,
          		    CONCAT(HOUR(mSalidaLaboral)),
                          IF (HOUR(mSalidaLaboral)- 12 < 10,
                          CONCAT("0",HOUR(mSalidaLaboral) - 12),
                          CONCAT(HOUR(mSalidaLaboral) - 12)
                             )
                     )
               ),
               ":",              

               IF(MINUTE(mSalidaLaboral) < 10,
                  CONCAT("0",MINUTE(mSalidaLaboral)),
                  CONCAT(MINUTE(mSalidaLaboral))
               ),

               " ",

                IF(HOUR(mSalidaLaboral) >= 12,
                  CONCAT("PM"),
                  CONCAT("AM")
                )


              ),mSalidaLaboral) as mSalidaLaboral

       from marca 
       WHERE idPersona = idPersonaM and id = idMarca;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `correo`
--

DROP TABLE IF EXISTS `correo`;
CREATE TABLE IF NOT EXISTS `correo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `correo` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `mEntradaLaboral` datetime NOT NULL,
  `mSalidaAlmuerzo` datetime DEFAULT NULL,
  `mEntradaAlmuerzo` datetime DEFAULT NULL,
  `mSalidaLaboral` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(15) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `ape01` varchar(25) NOT NULL,
  `ape02` varchar(25) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `img` varchar(150) DEFAULT NULL,
  `creacionFecha` datetime NOT NULL,
  `idCreador` int(11) NOT NULL,
  `ultimoUpdateFecha` datetime NOT NULL,
  `idModificador` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCreador` (`idCreador`),
  KEY `idModificador` (`idModificador`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`id`, `cedula`, `nombre`, `ape01`, `ape02`, `fechaNacimiento`, `img`, `creacionFecha`, `idCreador`, `ultimoUpdateFecha`, `idModificador`) VALUES
(1, '117630788', 'Jose', 'Quesada', 'Arce', '1999-03-12', 'img/users/jose.jpg', '2019-02-21 22:36:48', 1, '2019-02-21 22:42:51', 1),
(2, '111111111', 'Prueba', 'Prueba', 'Prueba', '2019-03-03', NULL, '2019-03-03 21:00:17', 1, '2019-03-03 21:00:17', 1),
(3, '185496325', 'Mauricio', 'Cerdas', 'Quiros', '1991-11-23', NULL, '2019-03-03 21:07:17', 1, '2019-03-03 21:07:17', 1),
(4, '156895465', 'Yendry', 'Cordonero', 'Viquez', '1998-12-16', NULL, '2019-03-03 21:12:11', 1, '2019-03-03 21:12:11', 1),
(6, '12345678', 'Kevin', 'Lopez', 'Martinez', '2019-12-03', 'img/users/lopez.png', '2019-03-14 23:16:53', 1, '2019-03-14 23:16:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `telefono`
--

DROP TABLE IF EXISTS `telefono`;
CREATE TABLE IF NOT EXISTS `telefono` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo`
--

INSERT INTO `tipo` (`id`, `tipo`) VALUES
(1, 'Normal'),
(2, 'Administrador'),
(3, 'Jefe');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL,
  `creacionFecha` datetime NOT NULL,
  `idCreador` int(11) NOT NULL,
  `ultimoUpdateFecha` datetime NOT NULL,
  `idModificador` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`),
  KEY `idCreador` (`idCreador`),
  KEY `idModificador` (`idModificador`),
  KEY `tipo` (`tipo`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `idPersona`, `user`, `password`, `tipo`, `creacionFecha`, `idCreador`, `ultimoUpdateFecha`, `idModificador`) VALUES
(1, 1, 'joquesada', '81dc9bdb52d04dc20036dbd8313ed055', 2, '2019-02-21 23:53:34', 1, '2019-02-21 23:53:34', 1),
(2, 2, 'prueba', 'c893bad68927b457dbed39460e6afd62', 1, '2019-03-03 21:03:46', 1, '2019-03-03 21:03:46', 1),
(3, 3, 'mau2019', '9da9ee7265dfa2b0992d2d7a64aaff14', 1, '2019-03-03 21:09:14', 1, '2019-03-03 21:09:14', 1),
(4, 4, 'yen2019', '729a052540ea16b40f04541effb609e6', 1, '2019-03-03 21:12:47', 1, '2019-03-03 21:12:47', 1),
(6, 6, 'kevinLopez', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2019-03-14 23:16:53', 1, '2019-03-14 23:16:53', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
