-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-08-2018 a las 03:55:27
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `meppp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adopciones`
--

CREATE TABLE `adopciones` (
  `idAdopcion` int(11) NOT NULL,
  `fechaAdopcion` date NOT NULL,
  `totalAdoptados` int(11) NOT NULL DEFAULT '0',
  `estatusAdopcion` varchar(15) NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arboles`
--

CREATE TABLE `arboles` (
  `idArbol` int(11) NOT NULL,
  `imagenArbol` varchar(100) NOT NULL,
  `nombreComun` varchar(100) NOT NULL,
  `nombreCientifico` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `existencia` int(11) NOT NULL,
  `estatusArbol` varchar(15) NOT NULL DEFAULT '1',
  `TiposArbol_idTipoArbol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campanias`
--

CREATE TABLE `campanias` (
  `idCampania` int(11) NOT NULL,
  `imagenPortada` varchar(100) NOT NULL,
  `nombreCampania` varchar(150) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `hora` time NOT NULL,
  `lugar` varchar(150) NOT NULL,
  `publico` varchar(50) NOT NULL,
  `estatusCampania` varchar(15) NOT NULL,
  `TiposCampania_idTipoCampania` int(11) NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `idCiudad` int(11) NOT NULL,
  `ciudad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`idCiudad`, `ciudad`) VALUES
(1, 'Acámbaro'),
(2, 'Acámbaro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colonias`
--

CREATE TABLE `colonias` (
  `idColonia` int(11) NOT NULL,
  `colonia` varchar(100) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `Ciudades_idCiudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `colonias`
--

INSERT INTO `colonias` (`idColonia`, `colonia`, `cp`, `Ciudades_idCiudad`) VALUES
(1, 'San Isidro', '38942', 1),
(2, 'San Isidro', '38942', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(11) NOT NULL,
  `fechaComentario` date NOT NULL,
  `mensaje` text NOT NULL,
  `estatusComentario` varchar(15) NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL,
  `TiposComentario_idTipoComentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_adopciones`
--

CREATE TABLE `det_adopciones` (
  `idDetAdopcion` int(11) NOT NULL,
  `idAdopcion` int(11) NOT NULL,
  `idArbol` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_temporadas`
--

CREATE TABLE `det_temporadas` (
  `idDetTemporada` int(11) NOT NULL,
  `idTemporadaArbol` int(11) NOT NULL,
  `idArbol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `idDireccion` int(11) NOT NULL,
  `calle` varchar(150) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `Colonias_idColonia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`idDireccion`, `calle`, `numero`, `Colonias_idColonia`) VALUES
(1, 'Carretera Morelia', '54', 1),
(2, 'Carretera Morelia', '54', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faqs`
--

CREATE TABLE `faqs` (
  `idFaq` int(11) NOT NULL,
  `pregunta` varchar(200) NOT NULL,
  `respuesta` text NOT NULL,
  `SeccionesFaq_idSeccionFaq` int(11) NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_campania`
--

CREATE TABLE `imagenes_campania` (
  `idImagenCampania` int(11) NOT NULL,
  `urlImagen` varchar(100) NOT NULL,
  `Campanias_idCampania` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quienes_somos`
--

CREATE TABLE `quienes_somos` (
  `idQuienesSomos` int(11) NOT NULL,
  `telefono1` varchar(10) NOT NULL,
  `telefono2` varchar(10) DEFAULT NULL,
  `correoEmpresa` varchar(80) NOT NULL,
  `mision` text NOT NULL,
  `vision` text NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `quienes_somos`
--

INSERT INTO `quienes_somos` (`idQuienesSomos`, `telefono1`, `telefono2`, `correoEmpresa`, `mision`, `vision`, `Usuarios_idUsuario`) VALUES
(1, '4171064285', NULL, 'meppp@gmail.com', 'Movimiento Ecologista Preocupados por el Planeta tiene como misión concientizar a la ciudadanía sobre el medio ambiente y su deterioro, así como motivarlos a la plantación de árboles, buscando innovación, respeto  y amor por el planeta.', 'Lograr ser reconocidos como una asociación que mejora el medio ambiente a través de la donación de árboles a los miembros de la sociedad logrando así una reserva ecológica sustentable.', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones_faq`
--

CREATE TABLE `secciones_faq` (
  `idSeccionFaq` int(11) NOT NULL,
  `nombreSeccion` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `secciones_faq`
--

INSERT INTO `secciones_faq` (`idSeccionFaq`, `nombreSeccion`) VALUES
(1, 'Miembros'),
(2, 'Adopciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos`
--

CREATE TABLE `telefonos` (
  `idTelefono` int(11) NOT NULL,
  `lada` varchar(3) NOT NULL,
  `telefono` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `telefonos`
--

INSERT INTO `telefonos` (`idTelefono`, `lada`, `telefono`) VALUES
(2, '417', '1065474');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporadas_arbol`
--

CREATE TABLE `temporadas_arbol` (
  `idTemporadaArbol` int(11) NOT NULL,
  `temporadaArbol` varchar(50) NOT NULL,
  `fechaInicio` varchar(5) NOT NULL,
  `estatusTemporada` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `temporadas_arbol`
--

INSERT INTO `temporadas_arbol` (`idTemporadaArbol`, `temporadaArbol`, `fechaInicio`, `estatusTemporada`) VALUES
(1, 'Primavera', '21-03', 'Inactiva'),
(2, 'Verano', '21-06', 'Activa'),
(3, 'Otoño', '21-09', 'Inactiva'),
(4, 'Invierno', '21-12', 'Inactiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_arbol`
--

CREATE TABLE `tipos_arbol` (
  `idTipoArbol` int(11) NOT NULL,
  `tipoArbol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_arbol`
--

INSERT INTO `tipos_arbol` (`idTipoArbol`, `tipoArbol`) VALUES
(1, 'De sol'),
(2, 'Frutal'),
(3, 'Vegetal'),
(4, 'Planifolio'),
(5, 'Frondoso'),
(6, 'Conífero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_campania`
--

CREATE TABLE `tipos_campania` (
  `idTipoCampania` int(11) NOT NULL,
  `tipoCampania` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_campania`
--

INSERT INTO `tipos_campania` (`idTipoCampania`, `tipoCampania`) VALUES
(1, 'Taller'),
(2, 'Plática'),
(3, 'Conferencia'),
(4, 'Donación'),
(5, 'Reforestación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_comentario`
--

CREATE TABLE `tipos_comentario` (
  `idTipoComentario` int(11) NOT NULL,
  `tipoComentario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_comentario`
--

INSERT INTO `tipos_comentario` (`idTipoComentario`, `tipoComentario`) VALUES
(1, 'Queja'),
(2, 'Sugerencia'),
(3, 'Duda'),
(4, 'Comentario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuario`
--

CREATE TABLE `tipos_usuario` (
  `idTipoUsuario` int(11) NOT NULL,
  `tipoUsuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`idTipoUsuario`, `tipoUsuario`) VALUES
(1, 'Administrador'),
(2, 'Usuario general'),
(3, 'Representante'),
(4, 'Miembro'),
(5, 'Socio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `nombreUsuario` varchar(100) NOT NULL,
  `apePat` varchar(80) NOT NULL,
  `apeMat` varchar(80) NOT NULL,
  `correoUsuario` varchar(80) NOT NULL,
  `organizacion` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` tinyblob NOT NULL,
  `privilegios` varchar(15) NOT NULL,
  `estatusUsuario` varchar(15) NOT NULL,
  `Telefonos_idTelefono` int(11) NOT NULL,
  `Direcciones_idDireccion` int(11) NOT NULL,
  `TiposUsuario_idTipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `avatar`, `nombreUsuario`, `apePat`, `apeMat`, `correoUsuario`, `organizacion`, `usuario`, `contrasenia`, `privilegios`, `estatusUsuario`, `Telefonos_idTelefono`, `Direcciones_idDireccion`, `TiposUsuario_idTipoUsuario`) VALUES
(2, 'perfil11.jpg', 'Sebastian', 'Sánchez', 'Castro', 'sebastian@gmail.com', 'Movimiento Ecologista Preocupados Por el Planeta', 'Sebastian', 0xb51b4a36a5181fe90f09ec130f16c230, 'Súper', 'Activo', 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores`
--

CREATE TABLE `valores` (
  `idValor` int(11) NOT NULL,
  `nombreValor` varchar(80) NOT NULL,
  `descripcionValor` text NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `valores`
--

INSERT INTO `valores` (`idValor`, `nombreValor`, `descripcionValor`, `Usuarios_idUsuario`) VALUES
(5, 'Amor', 'Consideramos que el amor puede mover cualquier cosa es por eso  que cada uno de nuestros miembros ama a la naturaleza y su entorno.', 2),
(6, 'Confianza', 'Sabemos que la confianza, permite creer en nosotros y sobre todo en los demás, lo que provoca lograr un mejor resultado.', 2),
(7, 'Comunicación', 'Fomentamos la comunicación dentro y fuera de la asociación, contribuyendo a la comunicación de ideas de manera clara.', 2),
(8, 'Cooperación', 'Impulsamos el trabajo en equipo, complementando esfuerzos y respetando los distintos puntos de vista.', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adopciones`
--
ALTER TABLE `adopciones`
  ADD PRIMARY KEY (`idAdopcion`),
  ADD KEY `fk_adopciones_usuarios1_idx` (`Usuarios_idUsuario`);

--
-- Indices de la tabla `arboles`
--
ALTER TABLE `arboles`
  ADD PRIMARY KEY (`idArbol`,`TiposArbol_idTipoArbol`),
  ADD KEY `fk_arboles_tipo_arbol1_idx` (`TiposArbol_idTipoArbol`);

--
-- Indices de la tabla `campanias`
--
ALTER TABLE `campanias`
  ADD PRIMARY KEY (`idCampania`,`TiposCampania_idTipoCampania`,`Usuarios_idUsuario`),
  ADD KEY `fk_campanias_tipos_campania1_idx` (`TiposCampania_idTipoCampania`),
  ADD KEY `fk_campanias_usuarios1_idx` (`Usuarios_idUsuario`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`idCiudad`);

--
-- Indices de la tabla `colonias`
--
ALTER TABLE `colonias`
  ADD PRIMARY KEY (`idColonia`,`Ciudades_idCiudad`),
  ADD KEY `fk_colonias_ciudades1_idx` (`Ciudades_idCiudad`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`,`TiposComentario_idTipoComentario`),
  ADD KEY `fk_comentarios_usuarios1_idx` (`Usuarios_idUsuario`),
  ADD KEY `fk_comentarios_tipos_comentario1_idx` (`TiposComentario_idTipoComentario`);

--
-- Indices de la tabla `det_adopciones`
--
ALTER TABLE `det_adopciones`
  ADD PRIMARY KEY (`idDetAdopcion`,`idAdopcion`,`idArbol`),
  ADD KEY `fk_adopciones_has_arboles_arboles1_idx` (`idArbol`),
  ADD KEY `fk_adopciones_has_arboles_adopciones1_idx` (`idAdopcion`);

--
-- Indices de la tabla `det_temporadas`
--
ALTER TABLE `det_temporadas`
  ADD PRIMARY KEY (`idDetTemporada`,`idTemporadaArbol`,`idArbol`),
  ADD KEY `fk_temporadas_arbol_has_arboles_arboles1_idx` (`idArbol`),
  ADD KEY `fk_temporadas_arbol_has_arboles_temporadas_arbol1_idx` (`idTemporadaArbol`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`idDireccion`,`Colonias_idColonia`),
  ADD KEY `fk_direcciones_colonias1_idx` (`Colonias_idColonia`);

--
-- Indices de la tabla `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`idFaq`,`SeccionesFaq_idSeccionFaq`,`Usuarios_idUsuario`),
  ADD KEY `fk_faqs_secciones_faq1_idx` (`SeccionesFaq_idSeccionFaq`),
  ADD KEY `fk_faqs_usuarios1_idx` (`Usuarios_idUsuario`);

--
-- Indices de la tabla `imagenes_campania`
--
ALTER TABLE `imagenes_campania`
  ADD PRIMARY KEY (`idImagenCampania`,`Campanias_idCampania`),
  ADD KEY `fk_imagenes_campania_campanias1_idx` (`Campanias_idCampania`);

--
-- Indices de la tabla `quienes_somos`
--
ALTER TABLE `quienes_somos`
  ADD PRIMARY KEY (`idQuienesSomos`,`Usuarios_idUsuario`),
  ADD KEY `fk_quienes_somos_usuarios1_idx` (`Usuarios_idUsuario`);

--
-- Indices de la tabla `secciones_faq`
--
ALTER TABLE `secciones_faq`
  ADD PRIMARY KEY (`idSeccionFaq`);

--
-- Indices de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD PRIMARY KEY (`idTelefono`);

--
-- Indices de la tabla `temporadas_arbol`
--
ALTER TABLE `temporadas_arbol`
  ADD PRIMARY KEY (`idTemporadaArbol`);

--
-- Indices de la tabla `tipos_arbol`
--
ALTER TABLE `tipos_arbol`
  ADD PRIMARY KEY (`idTipoArbol`);

--
-- Indices de la tabla `tipos_campania`
--
ALTER TABLE `tipos_campania`
  ADD PRIMARY KEY (`idTipoCampania`);

--
-- Indices de la tabla `tipos_comentario`
--
ALTER TABLE `tipos_comentario`
  ADD PRIMARY KEY (`idTipoComentario`);

--
-- Indices de la tabla `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  ADD PRIMARY KEY (`idTipoUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`,`Telefonos_idTelefono`,`Direcciones_idDireccion`,`TiposUsuario_idTipoUsuario`),
  ADD KEY `fk_usuarios_telefonos1_idx` (`Telefonos_idTelefono`),
  ADD KEY `fk_usuarios_tipos_usuario1_idx` (`TiposUsuario_idTipoUsuario`),
  ADD KEY `fk_usuarios_direcciones1_idx` (`Direcciones_idDireccion`);

--
-- Indices de la tabla `valores`
--
ALTER TABLE `valores`
  ADD PRIMARY KEY (`idValor`,`Usuarios_idUsuario`),
  ADD KEY `fk_valores_usuarios1_idx` (`Usuarios_idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adopciones`
--
ALTER TABLE `adopciones`
  MODIFY `idAdopcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `arboles`
--
ALTER TABLE `arboles`
  MODIFY `idArbol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `campanias`
--
ALTER TABLE `campanias`
  MODIFY `idCampania` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `idCiudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `colonias`
--
ALTER TABLE `colonias`
  MODIFY `idColonia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `det_adopciones`
--
ALTER TABLE `det_adopciones`
  MODIFY `idDetAdopcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `det_temporadas`
--
ALTER TABLE `det_temporadas`
  MODIFY `idDetTemporada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `idDireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `faqs`
--
ALTER TABLE `faqs`
  MODIFY `idFaq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes_campania`
--
ALTER TABLE `imagenes_campania`
  MODIFY `idImagenCampania` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `quienes_somos`
--
ALTER TABLE `quienes_somos`
  MODIFY `idQuienesSomos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `secciones_faq`
--
ALTER TABLE `secciones_faq`
  MODIFY `idSeccionFaq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  MODIFY `idTelefono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `temporadas_arbol`
--
ALTER TABLE `temporadas_arbol`
  MODIFY `idTemporadaArbol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipos_arbol`
--
ALTER TABLE `tipos_arbol`
  MODIFY `idTipoArbol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipos_campania`
--
ALTER TABLE `tipos_campania`
  MODIFY `idTipoCampania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipos_comentario`
--
ALTER TABLE `tipos_comentario`
  MODIFY `idTipoComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipos_usuario`
--
ALTER TABLE `tipos_usuario`
  MODIFY `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `valores`
--
ALTER TABLE `valores`
  MODIFY `idValor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adopciones`
--
ALTER TABLE `adopciones`
  ADD CONSTRAINT `fk_adopciones_usuarios1` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `arboles`
--
ALTER TABLE `arboles`
  ADD CONSTRAINT `arboles_ibfk_1` FOREIGN KEY (`TiposArbol_idTipoArbol`) REFERENCES `tipos_arbol` (`idTipoArbol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `campanias`
--
ALTER TABLE `campanias`
  ADD CONSTRAINT `campanias_ibfk_1` FOREIGN KEY (`TiposCampania_idTipoCampania`) REFERENCES `tipos_campania` (`idTipoCampania`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_campanias_usuarios1` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `colonias`
--
ALTER TABLE `colonias`
  ADD CONSTRAINT `colonias_ibfk_1` FOREIGN KEY (`Ciudades_idCiudad`) REFERENCES `ciudades` (`idCiudad`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`TiposComentario_idTipoComentario`) REFERENCES `tipos_comentario` (`idTipoComentario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `det_adopciones`
--
ALTER TABLE `det_adopciones`
  ADD CONSTRAINT `det_adopciones_ibfk_1` FOREIGN KEY (`idAdopcion`) REFERENCES `adopciones` (`idAdopcion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `det_adopciones_ibfk_2` FOREIGN KEY (`idArbol`) REFERENCES `arboles` (`idArbol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `det_temporadas`
--
ALTER TABLE `det_temporadas`
  ADD CONSTRAINT `fk_temporadas_arbol_has_arboles_arboles1` FOREIGN KEY (`idArbol`) REFERENCES `arboles` (`idArbol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_temporadas_arbol_has_arboles_temporadas_arbol1` FOREIGN KEY (`idTemporadaArbol`) REFERENCES `temporadas_arbol` (`idTemporadaArbol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`Colonias_idColonia`) REFERENCES `colonias` (`idColonia`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_ibfk_1` FOREIGN KEY (`SeccionesFaq_idSeccionFaq`) REFERENCES `secciones_faq` (`idSeccionFaq`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_faqs_usuarios1` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagenes_campania`
--
ALTER TABLE `imagenes_campania`
  ADD CONSTRAINT `imagenes_campania_ibfk_1` FOREIGN KEY (`Campanias_idCampania`) REFERENCES `campanias` (`idCampania`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `quienes_somos`
--
ALTER TABLE `quienes_somos`
  ADD CONSTRAINT `fk_quienes_somos_usuarios1` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_direcciones1` FOREIGN KEY (`Direcciones_idDireccion`) REFERENCES `direcciones` (`idDireccion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuarios_telefonos1` FOREIGN KEY (`Telefonos_idTelefono`) REFERENCES `telefonos` (`idTelefono`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuarios_tipos_usuario1` FOREIGN KEY (`TiposUsuario_idTipoUsuario`) REFERENCES `tipos_usuario` (`idTipoUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `valores`
--
ALTER TABLE `valores`
  ADD CONSTRAINT `fk_valores_usuarios1` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
