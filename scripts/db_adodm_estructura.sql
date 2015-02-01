-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-01-2010 a las 10:53:59
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `db_adodm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grabacion`
--

CREATE TABLE IF NOT EXISTS `grabacion` (
  `id_grabacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `duracion` varchar(8) NOT NULL,
  PRIMARY KEY (`id_grabacion`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `num_telefonico`
--

CREATE TABLE IF NOT EXISTS `num_telefonico` (
  `telefono` varchar(15) NOT NULL,
  `nombres` varchar(25) DEFAULT NULL,
  `apellidos` varchar(25) DEFAULT NULL,
  `empresa` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`telefono`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `num_tel_X_grab`
--

CREATE TABLE IF NOT EXISTS `num_tel_X_grab` (
  `telefono` varchar(15) NOT NULL,
  `id_grabacion` int(11) NOT NULL,
  `fecha_realizacion` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`telefono`,`id_grabacion`),
  KEY `id_grabacion` (`id_grabacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `num_tel_X_grab`
--
ALTER TABLE `num_tel_X_grab`
  ADD CONSTRAINT `num_tel_X_grab_ibfk_2` FOREIGN KEY (`id_grabacion`) REFERENCES `grabacion` (`id_grabacion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `num_tel_X_grab_ibfk_1` FOREIGN KEY (`telefono`) REFERENCES `num_telefonico` (`telefono`) ON DELETE CASCADE ON UPDATE CASCADE;
