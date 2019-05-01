-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-04-2019 a las 00:45:15
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `marcas`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `buscadorEmpleados`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscadorEmpleados` (IN `pCedula` VARCHAR(15), IN `pNombre` VARCHAR(50), IN `pApe01` VARCHAR(50), IN `pApe02` VARCHAR(50))  BEGIN

Select p.cedula,CONCAT(p.nombre," ",p.ape01," ",p.ape02) as nombre,fechaNacimiento,
u.user, telefono, correo, ti.tipo from persona p
INNER JOIN user u
on p.id = u.idPersona
INNER JOIN telefono t
on p.id = t.idPersona
INNER JOIN correo c
on p.id = c.idPersona
INNER JOIN tipo ti
on u.tipo = ti.id
where cedula like (case when pCedula is null
    then "%%" else CONCAT("%",pCedula,"%") end)
  AND p.nombre like (case when pNombre is null
	then "%%" else CONCAT("%",pNombre,"%") end)
  and  p.ape01 like (case when pApe01 is null
	then "%%" else CONCAT("%",pApe01,"%") end)
  and  p.ape02 like (case when pApe02 is null
	then "%%" else CONCAT("%",pApe02,"%") end);	



END$$

DROP PROCEDURE IF EXISTS `crearPerfil`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `crearPerfil` (`pCedula` VARCHAR(15), `pNombre` VARCHAR(25), `pApellido1` VARCHAR(25), `pApellido2` VARCHAR(25), `pFechaNacimiento` DATE, `pTelefono` VARCHAR(20), `pCorreo` VARCHAR(150), `pImg` VARCHAR(150), `pIdUsuario` INT(11), `pUsuario` VARCHAR(25), `pContrasena` VARCHAR(50), `pTipo` INT(11))  BEGIN
START TRANSACTION;
INSERT INTO persona (id, cedula, nombre, ape01, ape02,fechaNacimiento, img, creacionFecha, idCreador,ultimoUpdateFecha,idModificador)
VALUES(0, pCedula, pNombre, pApellido1,pApellido2, pFechaNacimiento, pImg, NOW(), pIdUsuario, NOW(), pIdUsuario);

SELECT @id := id from persona where cedula=pCedula;

INSERT INTO user(id, idPersona, user, password, tipo,creacionFecha, idCreador, ultimoUpdateFecha,idModificador)
VALUES(0,@id, pUsuario,MD5(pContrasena), pTipo,NOW(), pIdUsuario, NOW(), pIdUsuario);

INSERT INTO correo(id, idPersona, correo, creacionFecha, idCreador, ultimoUpdateFecha, idModificador)
VALUES (0,@id,pCorreo,NOW(), pIdUsuario, NOW(), pIdUsuario);

INSERT INTO telefono(id, idPersona, telefono, creacionFecha, idCreador, ultimoUpdateFecha, idModificador)
VALUES (0,@id,pTelefono,NOW(), pIdUsuario, NOW(), pIdUsuario);

COMMIT;
END$$

DROP PROCEDURE IF EXISTS `infoPersona`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `infoPersona` (`idPersona` INT)  BEGIN

SELECT nombre,ape01,ape02,fechaNacimiento,cedula,telefono,correo,img from persona p
inner join telefono t
on p.id = t.idPersona
inner join correo c
on p.id = c.idPersona
where p.id = idPersona;

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
                          IF (HOUR(mEntradaLaboral) < 10,
                          CONCAT("0",HOUR(mEntradaLaboral)),
                          IF (HOUR(mEntradaLaboral)-12 < 10 AND HOUR(mEntradaLaboral)-12 > 0 ,
                          CONCAT("0",HOUR(mEntradaLaboral)-12),
                          IF (HOUR(mEntradaLaboral) > 12,
                          CONCAT(HOUR(mEntradaLaboral)-12),
                          CONCAT(HOUR(mEntradaLaboral))
                              )
                             )
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
                          IF (HOUR(mSalidaAlmuerzo) < 10,
                          CONCAT("0",HOUR(mSalidaAlmuerzo)),
                          IF (HOUR(mSalidaAlmuerzo)-12 < 10 AND HOUR(mSalidaAlmuerzo)-12 > 0 ,
                          CONCAT("0",HOUR(mSalidaAlmuerzo)-12),
                          IF (HOUR(mSalidaAlmuerzo) > 12,
                          CONCAT(HOUR(mSalidaAlmuerzo)-12),
                          CONCAT(HOUR(mSalidaAlmuerzo))
                              )
                             )
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
                          IF (HOUR(mEntradaAlmuerzo) < 10,
                          CONCAT("0",HOUR(mEntradaAlmuerzo)),
                          IF (HOUR(mEntradaAlmuerzo)-12 < 10 AND HOUR(mEntradaAlmuerzo)-12 > 0 ,
                          CONCAT("0",HOUR(mEntradaAlmuerzo)-12),
                          IF (HOUR(mEntradaAlmuerzo) > 12,
                          CONCAT(HOUR(mEntradaAlmuerzo)-12),
                          CONCAT(HOUR(mEntradaAlmuerzo))
                              )
                             )
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
                          IF (HOUR(mSalidaLaboral) < 10,
                          CONCAT("0",HOUR(mSalidaLaboral)),
                          IF (HOUR(mSalidaLaboral)-12 < 10 AND HOUR(mSalidaLaboral)-12 > 0 ,
                          CONCAT("0",HOUR(mSalidaLaboral)-12),
                          IF (HOUR(mSalidaLaboral) > 12,
                          CONCAT(HOUR(mSalidaLaboral)-12),
                          CONCAT(HOUR(mSalidaLaboral))
                              )
                             )
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

DROP PROCEDURE IF EXISTS `traerInformeCompleto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `traerInformeCompleto` ()  BEGIN
 
 Select
    
      cedula,CONCAT(nombre," ",ape01," ",ape02) as Nombre,
      DATE(mEntradaLaboral) AS Fecha,
      
            if(mEntradaLaboral IS NOT NULL,
              CONCAT( 

               IF(HOUR(mEntradaLaboral) = 0,
               CONCAT(HOUR(mEntradaLaboral) + 12),
                   if(HOUR(mEntradaLaboral) = 12,
                    CONCAT(HOUR(mEntradaLaboral)),
                          IF (HOUR(mEntradaLaboral) < 10,
                          CONCAT("0",HOUR(mEntradaLaboral)),
                          IF (HOUR(mEntradaLaboral)-12 < 10 AND HOUR(mEntradaLaboral)-12 > 0 ,
                          CONCAT("0",HOUR(mEntradaLaboral)-12),
                          IF (HOUR(mEntradaLaboral) > 12,
                          CONCAT(HOUR(mEntradaLaboral)-12),
                          CONCAT(HOUR(mEntradaLaboral))
                              )
                             )
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
                          IF (HOUR(mSalidaAlmuerzo) < 10,
                          CONCAT("0",HOUR(mSalidaAlmuerzo)),
                          IF (HOUR(mSalidaAlmuerzo)-12 < 10 AND HOUR(mSalidaAlmuerzo)-12 > 0 ,
                          CONCAT("0",HOUR(mSalidaAlmuerzo)-12),
                          IF (HOUR(mSalidaAlmuerzo) > 12,
                          CONCAT(HOUR(mSalidaAlmuerzo)-12),
                          CONCAT(HOUR(mSalidaAlmuerzo))
                              )
                             )
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
                          IF (HOUR(mEntradaAlmuerzo) < 10,
                          CONCAT("0",HOUR(mEntradaAlmuerzo)),
                          IF (HOUR(mEntradaAlmuerzo)-12 < 10 AND HOUR(mEntradaAlmuerzo)-12 > 0 ,
                          CONCAT("0",HOUR(mEntradaAlmuerzo)-12),
                          IF (HOUR(mEntradaAlmuerzo) > 12,
                          CONCAT(HOUR(mEntradaAlmuerzo)-12),
                          CONCAT(HOUR(mEntradaAlmuerzo))
                              )
                             )
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
                          IF (HOUR(mSalidaLaboral) < 10,
                          CONCAT("0",HOUR(mSalidaLaboral)),
                          IF (HOUR(mSalidaLaboral)-12 < 10 AND HOUR(mSalidaLaboral)-12 > 0 ,
                          CONCAT("0",HOUR(mSalidaLaboral)-12),
                          IF (HOUR(mSalidaLaboral) > 12,
                          CONCAT(HOUR(mSalidaLaboral)-12),
                          CONCAT(HOUR(mSalidaLaboral))
                              )
                             )
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


              ),mSalidaLaboral) as mSalidaLaboral,
              (HOUR(mSalidaLaboral) - HOUR(mEntradaLaboral)) as HorasTrabajadas,
              
          IF(
              (HOUR(mSalidaLaboral) - HOUR(mEntradaLaboral)) > 8,
              CONCAT((HOUR(mSalidaLaboral) - HOUR(mEntradaLaboral)) - 8),
              "0"

          ) AS Extras,

        IF(
            (HOUR(mSalidaLaboral) - HOUR(mEntradaLaboral)) >=8,
            "Salida normal",
            "Salida temprana"
          )

        as Estado 

      from marca m
        INNER JOIN persona p
        on p.id = m.idPersona;
 
END$$

DROP PROCEDURE IF EXISTS `traerInformeDia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `traerInformeDia` ()  BEGIN
 
  Select
    
      cedula,
      CONCAT(nombre," ",ape01," ",ape02) as Nombre,
      DATE(mEntradaLaboral) AS Fecha,
      convertirHora(mEntradaLaboral) as mEntradaLaboral,
      convertirHora(mSalidaAlmuerzo) as mSalidaAlmuerzo, 
      convertirHora(mEntradaAlmuerzo) as mEntradaAlmuerzo, 
      convertirHora(mSalidaLaboral) as mSalidaLaboral,
      (HOUR(mSalidaLaboral) - HOUR(mEntradaLaboral)) as HorasTrabajadas,
              
          IF(
              (HOUR(mSalidaLaboral) - HOUR(mEntradaLaboral)) > 8,
              CONCAT((HOUR(mSalidaLaboral) - HOUR(mEntradaLaboral)) - 8),
              "0"

          ) AS Extras,

        IF(
            (HOUR(mSalidaLaboral) - HOUR(mEntradaLaboral)) >=8,
            "Salida normal",
            "Salida temprana"
          )

        as Estado 

      from marca m
        INNER JOIN persona p
        on p.id = m.idPersona
        
        where DATE(mEntradaLaboral) = DATE(NOW()) AND YEAR(mEntradaLaboral) = YEAR(NOW());
 
END$$

DROP PROCEDURE IF EXISTS `traerInformeMes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `traerInformeMes` ()  BEGIN
 
 Select
    
      cedula,
      CONCAT(nombre," ",ape01," ",ape02) as Nombre,
      DATE(mEntradaLaboral) AS Fecha,
      convertirHora(mEntradaLaboral) as mEntradaLaboral,
      convertirHora(mSalidaAlmuerzo) as mSalidaAlmuerzo, 
      convertirHora(mEntradaAlmuerzo) as mEntradaAlmuerzo, 
      convertirHora(mSalidaLaboral) as mSalidaLaboral,
      (HOUR(mSalidaLaboral) - HOUR(mEntradaLaboral)) as HorasTrabajadas,
              
          IF(
              (HOUR(mSalidaLaboral) - HOUR(mEntradaLaboral)) > 8,
              CONCAT((HOUR(mSalidaLaboral) - HOUR(mEntradaLaboral)) - 8),
              "0"

          ) AS Extras,

        IF(
            (HOUR(mSalidaLaboral) - HOUR(mEntradaLaboral)) >=8,
            "Salida normal",
            "Salida temprana"
          )

        as Estado 

      from marca m
        INNER JOIN persona p
        on p.id = m.idPersona
        
        where month(mEntradaLaboral) = month(NOW()) AND YEAR(mEntradaLaboral) = YEAR(NOW());
 
END$$

DROP PROCEDURE IF EXISTS `updateImg`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateImg` (IN `pIdPersona` INT, IN `pImg` VARCHAR(150))  BEGIN
START TRANSACTION;
     
UPDATE persona set img = pImg,ultimoUpdateFecha = NOW(),idModificador = pIdPersona 
WHERE id = pIdPersona;

COMMIT;
END$$

DROP PROCEDURE IF EXISTS `updatePassword`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePassword` (IN `pIdPersona` INT, IN `pPassword` VARCHAR(50))  BEGIN
START TRANSACTION;
     
UPDATE user set password = MD5(pPassword),ultimoUpdateFecha = NOW(),idModificador = pIdPersona 
WHERE idPersona = pIdPersona;

COMMIT;
END$$

DROP PROCEDURE IF EXISTS `updatePerfil`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePerfil` (IN `pIdPersona` INT, IN `pCedula` VARCHAR(15), IN `pNombre` VARCHAR(25), IN `pApellido1` VARCHAR(25), IN `pApellido2` VARCHAR(25), IN `pFechaNacimiento` DATE, IN `pTelefono` VARCHAR(20), IN `pCorreo` VARCHAR(150))  BEGIN
START TRANSACTION;
    
UPDATE persona SET cedula = pCedula, nombre = pNombre, ape01 = pApellido1, ape02 = pApellido2,
fechaNacimiento = pFechaNacimiento,ultimoUpdateFecha = NOW(),idModificador = pIdPersona
WHERE id = pIdPersona;
    
UPDATE telefono set telefono = pTelefono, ultimoUpdateFecha = NOW(),idModificador = pIdPersona
WHERE idPersona = pIdPersona;
    
UPDATE correo set correo = pCorreo, ultimoUpdateFecha = NOW(),idModificador = pIdPersona 
WHERE idPersona = pIdPersona;

COMMIT;
END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `convertirHora`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `convertirHora` (`mEntradaLaboral` DATETIME) RETURNS CHAR(250) CHARSET latin1 BEGIN
        DECLARE fecha CHAR(250);
        SET fecha = if(mEntradaLaboral IS NOT NULL,
              CONCAT( 

               IF(HOUR(mEntradaLaboral) = 0,
               CONCAT(HOUR(mEntradaLaboral) + 12),
                   if(HOUR(mEntradaLaboral) = 12,
                    CONCAT(HOUR(mEntradaLaboral)),
                          IF (HOUR(mEntradaLaboral) < 10,
                          CONCAT("0",HOUR(mEntradaLaboral)),
                          IF (HOUR(mEntradaLaboral)-12 < 10 AND HOUR(mEntradaLaboral)-12 > 0 ,
                          CONCAT("0",HOUR(mEntradaLaboral)-12),
                          IF (HOUR(mEntradaLaboral) > 12,
                          CONCAT(HOUR(mEntradaLaboral)-12),
                          CONCAT(HOUR(mEntradaLaboral))
                              )
                             )
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


              ), mEntradaLaboral);
        RETURN fecha;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correo`
--

DROP TABLE IF EXISTS `correo`;
CREATE TABLE IF NOT EXISTS `correo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `creacionFecha` datetime NOT NULL,
  `idCreador` int(11) NOT NULL,
  `ultimoUpdateFecha` datetime NOT NULL,
  `idModificador` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `correo`
--

INSERT INTO `correo` (`id`, `idPersona`, `correo`, `creacionFecha`, `idCreador`, `ultimoUpdateFecha`, `idModificador`) VALUES
(1, 22, 'josedavidquesada2017@gmail.com', '2019-04-17 00:39:37', 1, '2019-04-29 18:14:32', 22),
(2, 23, 'NelsonGamboa@gmail.com', '2019-04-17 19:35:16', 22, '2019-04-27 21:19:28', 23),
(3, 24, 'yendry2019@gmail.com', '2019-04-17 19:36:19', 22, '2019-04-19 03:43:18', 24),
(4, 25, 'mau2019@gmail.com', '2019-04-17 19:38:37', 22, '2019-04-29 18:26:36', 25),
(5, 26, '11111111@gmail.com', '2019-04-29 18:15:12', 22, '2019-04-29 18:15:12', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `mEntradaLaboral` datetime NOT NULL,
  `mSalidaAlmuerzo` datetime DEFAULT NULL,
  `mEntradaAlmuerzo` datetime DEFAULT NULL,
  `mSalidaLaboral` datetime DEFAULT NULL,
  `estado` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `idPersona`, `mEntradaLaboral`, `mSalidaAlmuerzo`, `mEntradaAlmuerzo`, `mSalidaLaboral`, `estado`) VALUES
(58, 22, '2019-04-19 02:39:42', '2019-04-19 02:39:45', '2019-04-19 02:39:48', '2019-04-19 02:39:49', 'N'),
(57, 23, '2019-04-17 19:39:30', '2019-04-17 19:39:31', '2019-04-17 19:39:31', '2019-04-17 19:39:31', 'N'),
(56, 24, '2019-04-17 19:39:17', '2019-04-17 19:39:17', '2019-04-17 19:39:18', '2019-04-17 19:39:18', 'N'),
(55, 25, '2019-04-17 19:39:06', '2019-04-17 19:39:07', '2019-04-17 19:39:07', '2019-04-17 19:39:08', 'N'),
(53, 22, '2019-04-17 19:12:34', '2019-04-17 19:12:48', '2019-04-17 19:12:50', '2019-04-17 19:12:52', 'N'),
(54, 22, '2019-04-17 19:30:23', '2019-04-17 19:30:52', '2019-04-17 19:30:53', '2019-04-17 19:30:54', 'N'),
(59, 24, '2019-04-19 03:35:59', '2019-04-19 03:36:00', '2019-04-19 03:36:00', '2019-04-19 03:36:01', 'N'),
(60, 25, '2019-04-19 03:44:03', '2019-04-19 03:44:03', '2019-04-19 03:44:03', '2019-04-19 03:44:04', 'N'),
(61, 23, '2019-04-19 03:44:48', '2019-04-19 03:44:48', '2019-04-19 03:44:48', '2019-04-19 03:44:48', 'N'),
(62, 25, '2019-04-29 17:13:05', '2019-04-29 17:13:06', '2019-04-29 17:13:07', '2019-04-29 17:13:07', 'N'),
(63, 22, '2019-04-29 17:13:57', '2019-04-29 17:13:57', '2019-04-29 17:13:57', '2019-04-29 17:13:58', 'N'),
(64, 23, '2019-04-29 17:35:14', '2019-04-29 17:35:15', '2019-04-29 17:35:16', '2019-04-29 17:35:16', 'N'),
(65, 26, '2019-04-29 18:15:28', '2019-04-29 18:15:28', '2019-04-29 18:15:29', '2019-04-29 18:15:29', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `cedula`, `nombre`, `ape01`, `ape02`, `fechaNacimiento`, `img`, `creacionFecha`, `idCreador`, `ultimoUpdateFecha`, `idModificador`) VALUES
(26, '123456987', 'Prueba', 'prueba', 'prueba', '2019-04-19', 'img/users/no_img.png', '2019-04-29 18:15:12', 22, '2019-04-29 18:15:12', 22),
(25, '569856495', 'Mauricio', 'Cerdas', 'Quiros', '1991-11-23', 'img/users/no_img.png', '2019-04-17 19:38:37', 22, '2019-04-29 18:26:36', 25),
(24, '789548563', 'Yendry', 'Cordonero', 'Viquez', '1999-12-02', 'img/users/no_img.png', '2019-04-17 19:36:19', 22, '2019-04-19 03:43:18', 24),
(23, '111111111', 'Nelson', 'Prueba', 'Gamboa', '1997-12-14', 'img/users/no_img.png', '2019-04-17 19:35:16', 22, '2019-04-27 21:22:04', 23),
(22, '117630788', 'Jose ', 'Quesada', 'Arce', '1999-12-03', 'img/users/jose.jpg', '2019-04-17 00:39:37', 1, '2019-04-29 18:14:32', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

DROP TABLE IF EXISTS `telefono`;
CREATE TABLE IF NOT EXISTS `telefono` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `creacionFecha` datetime NOT NULL,
  `idCreador` int(11) NOT NULL,
  `ultimoUpdateFecha` datetime NOT NULL,
  `idModificador` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `telefono`
--

INSERT INTO `telefono` (`id`, `idPersona`, `telefono`, `creacionFecha`, `idCreador`, `ultimoUpdateFecha`, `idModificador`) VALUES
(1, 22, '85685558', '2019-04-17 00:39:37', 1, '2019-04-29 18:14:32', 22),
(2, 23, '96857412', '2019-04-17 19:35:16', 22, '2019-04-27 21:19:28', 23),
(3, 24, '81236547', '2019-04-17 19:36:19', 22, '2019-04-19 03:43:18', 24),
(4, 25, '85469658', '2019-04-17 19:38:37', 22, '2019-04-29 18:26:36', 25),
(5, 26, '1111111111', '2019-04-29 18:15:12', 22, '2019-04-29 18:15:12', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `tipo`) VALUES
(1, 'Normal'),
(2, 'Administrador'),
(3, 'Jefe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
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
  KEY `tipo` (`tipo`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `idPersona`, `user`, `password`, `tipo`, `creacionFecha`, `idCreador`, `ultimoUpdateFecha`, `idModificador`) VALUES
(26, 26, 'prueba2', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2019-04-29 18:15:12', 22, '2019-04-29 18:15:12', 22),
(22, 22, 'joquesada2', '81dc9bdb52d04dc20036dbd8313ed055', 2, '2019-04-17 00:39:37', 1, '2019-04-19 03:33:33', 22),
(23, 23, 'nelson', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2019-04-17 19:35:16', 22, '2019-04-19 03:33:33', 22),
(24, 24, 'yendry', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2019-04-17 19:36:19', 22, '2019-04-19 03:33:33', 22),
(25, 25, 'mau', '81dc9bdb52d04dc20036dbd8313ed055', 3, '2019-04-17 19:38:37', 22, '2019-04-29 18:26:35', 25);

--
-- Eventos
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
