-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2018 a las 01:15:50
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
-- Base de datos: `meppp2018`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `idAdministrador` int(11) NOT NULL,
  `puesto` varchar(100) NOT NULL,
  `privilegios` int(11) NOT NULL,
  `UsuariosRegistrados_Admin_idUsuarioRegistrado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`idAdministrador`, `puesto`, `privilegios`, `UsuariosRegistrados_Admin_idUsuarioRegistrado`) VALUES
(1, 'Presidente', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adopciones`
--

CREATE TABLE `adopciones` (
  `idAdopcion` int(11) NOT NULL,
  `fechaAdopcion` date NOT NULL,
  `estatusAdopcion` tinyint(4) NOT NULL,
  `UsuariosRegistrados_idUsuarioRegistrado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `adopciones`
--

INSERT INTO `adopciones` (`idAdopcion`, `fechaAdopcion`, `estatusAdopcion`, `UsuariosRegistrados_idUsuarioRegistrado`) VALUES
(1, '2018-07-29', 0, 1);

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
  `estatusArbol` tinyint(4) NOT NULL DEFAULT '1',
  `TiposArbol_idTipoArbol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `arboles`
--

INSERT INTO `arboles` (`idArbol`, `imagenArbol`, `nombreComun`, `nombreCientifico`, `descripcion`, `existencia`, `estatusArbol`, `TiposArbol_idTipoArbol`) VALUES
(1, 'naranjo.jpg', 'Naranjo', 'Naranjugui', 'Sus flores blancas, llamadas azahar, nacen aisladas o en racimos y son sumamente fragantes. Su fruto es la naranja dulce.', 20, 1, 2),
(2, 'pino.jpg', 'Pino', 'Pinigui', 'Los pinos tiene un sistema radical muy desarrollado, lo que les permite fijarse con solidez a la tierra y absorber suficiente agua en lugares secos.', 20, 1, 6),
(3, 'eucalipto.jpg', 'Eucalipto', 'Eucaliptigui', 'Las hojas jóvenes de los eucaliptos son sésiles, ovaladas, grisáceas y de forma falciforme. Estas se alargan y se tornan de un color verde azulado.', 20, 1, 4),
(4, 'cactus.jpg', 'Cáctus', 'Cactugui', 'Estas curiosas plantas, originarias de américa y áfrica, están adaptadas soportar condiciones extremas de temperatura, luz y sequía.', 20, 1, 1);

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
  `estatusCampania` tinyint(4) NOT NULL,
  `Administradores_idAdministrador` int(11) NOT NULL,
  `TiposCampania_idTipoCampania` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `campanias`
--

INSERT INTO `campanias` (`idCampania`, `imagenPortada`, `nombreCampania`, `fechaInicio`, `fechaFin`, `hora`, `lugar`, `publico`, `estatusCampania`, `Administradores_idAdministrador`, `TiposCampania_idTipoCampania`) VALUES
(1, 'campaña1.jpg', 'El fruto de la vida', '2018-06-14', '2018-06-14', '05:00:00', 'Plazuela acámbaro', 'Adultos', 2, 1, 3),
(3, 'campaña2.jpg', 'Hola mundo', '2018-06-29', '2018-06-30', '15:00:00', 'COMUDE', 'Niños', 1, 1, 1);

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
(2, 'Taranda'),
(3, 'Maravatio'),
(4, 'Salvatirrra');

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
(1, 'Centro', '38600', 1),
(2, 'Solidaridad', '38630', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(11) NOT NULL,
  `fechaComentario` date NOT NULL,
  `mensaje` text NOT NULL,
  `estatusComentario` tinyint(4) NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL,
  `TiposComentario_idTipoComentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `fechaComentario`, `mensaje`, `estatusComentario`, `Usuarios_idUsuario`, `TiposComentario_idTipoComentario`) VALUES
(1, '2018-06-14', 'Sigan mejorando el sitio.', 1, 3, 4),
(2, '2018-06-12', '¿Como puedo adoptar un árbol?', 1, 2, 3),
(3, '2018-06-14', 'Me puede decir de una maldita vez como puedo adoptar un árbol', 0, 2, 4),
(4, '2018-06-03', 'Muy buen sitio!!!!', 1, 5, 4),
(5, '2018-06-05', 'Me encanta el medio ambiente y me parece muy bueno lo que hacen....\r\nSoy un miembro e invito a las personas a que se vuelvan miembros y juntos cuidemos el medio ambiente.', 1, 6, 4),
(6, '2018-06-09', 'No tienen muchos tipos de árboles', 1, 9, 4),
(7, '2018-06-13', 'Excelente!!!\r\nSigan esforzandose', 1, 8, 4),
(8, '2018-06-11', 'Mi árbolito ha crecido bastante y me siento muy feliz!!!', 1, 7, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_adopciones`
--

CREATE TABLE `det_adopciones` (
  `idDetAdopcion` int(11) NOT NULL,
  `Adopciones_idAdopcion` int(11) NOT NULL,
  `Arboles_idArbol` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_temporadas`
--

CREATE TABLE `det_temporadas` (
  `idDetTemporada` int(11) NOT NULL,
  `Arboles_idArbol` int(11) NOT NULL,
  `TemporadasArbol_idTemporadaArbol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `det_temporadas`
--

INSERT INTO `det_temporadas` (`idDetTemporada`, `Arboles_idArbol`, `TemporadasArbol_idTemporadaArbol`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1);

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
(1, 'Aldama', '89', 1),
(2, 'Nicolas Bravo', '587', 1),
(3, 'Jesus Garcia Corona', '35 A', 2),
(4, 'Guadalupe Victoria', '13', 1),
(5, 'Allende', '63', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donaciones`
--

CREATE TABLE `donaciones` (
  `idDonacion` int(11) NOT NULL,
  `fechaDonacion` date NOT NULL,
  `monto` double NOT NULL,
  `estatusDonacion` tinyint(4) NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faqs`
--

CREATE TABLE `faqs` (
  `idFaq` int(11) NOT NULL,
  `pregunta` varchar(200) NOT NULL,
  `respuesta` text NOT NULL,
  `Administradores_idAdministrador` int(11) NOT NULL,
  `SeccionesFaq_idSeccionFaq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `faqs`
--

INSERT INTO `faqs` (`idFaq`, `pregunta`, `respuesta`, `Administradores_idAdministrador`, `SeccionesFaq_idSeccionFaq`) VALUES
(1, '¿Si se guardo?', 'Creo que si xD\r\n', 1, 2),
(3, '¿Como puedo ser miembro?', 'Ven a la asociación o acude a una de nuestras campañas y llena el formato para ser miembro.', 1, 1),
(4, '¿Como puedo adoptar un árbol?', 'Selecciona los árboles que quieres en la sección de \'Invernadero\' y sigue el proceso que ahí te indica.', 1, 2),
(5, '¿Como me llamo?', 'Jona', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_campania`
--

CREATE TABLE `imagenes_campania` (
  `idImagenCampania` int(11) NOT NULL,
  `urlImagen` varchar(100) NOT NULL,
  `Campanias_idCampania` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagenes_campania`
--

INSERT INTO `imagenes_campania` (`idImagenCampania`, `urlImagen`, `Campanias_idCampania`) VALUES
(1, 'img1.jpg', 1),
(2, 'img2.jpg', 1),
(3, 'img3.jpg', 1),
(4, 'img4.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `idPersona` int(11) NOT NULL,
  `fechaNac` date NOT NULL,
  `ocupacion` varchar(100) NOT NULL,
  `UsuariosRegistrados_Persona_idUsuarioRegistrado` int(11) NOT NULL,
  `Direcciones_idDireccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idPersona`, `fechaNac`, `ocupacion`, `UsuariosRegistrados_Persona_idUsuarioRegistrado`, `Direcciones_idDireccion`) VALUES
(2, '1996-06-14', 'Estudiante', 2, 1),
(3, '1990-06-12', 'Estudiante/Trabajador', 3, 2),
(4, '1995-05-06', 'Trabajador', 4, 5),
(5, '1997-10-21', 'Trabajador', 5, 4),
(6, '1995-08-29', 'Trabajador', 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantes`
--

CREATE TABLE `representantes` (
  `idRepresentante` int(11) NOT NULL,
  `nombreOrganizacion` varchar(100) NOT NULL,
  `Personas_idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `representantes`
--

INSERT INTO `representantes` (`idRepresentante`, `nombreOrganizacion`, `Personas_idPersona`) VALUES
(1, 'Jumapa', 3),
(2, 'CEDAMI ESMERALDA', 4),
(3, 'Noticias por Acámbaro', 5),
(4, 'Sal a Rodar', 6);

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
  `telefono` varchar(7) NOT NULL,
  `UsuariosRegistrados_Tel_idUsuarioRegistrado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `telefonos`
--

INSERT INTO `telefonos` (`idTelefono`, `lada`, `telefono`, `UsuariosRegistrados_Tel_idUsuarioRegistrado`) VALUES
(1, '417', '1026355', 1),
(2, '417', '1038964', 2),
(3, '417', '1568134', 3),
(4, '417', '1018621', 4),
(5, '417', '1058734', 5),
(6, '417', '1093485', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporadas_arbol`
--

CREATE TABLE `temporadas_arbol` (
  `idTemporadaArbol` int(11) NOT NULL,
  `temporadaArbol` varchar(50) NOT NULL,
  `fechaInicio` varchar(5) NOT NULL,
  `estatusTemporada` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `temporadas_arbol`
--

INSERT INTO `temporadas_arbol` (`idTemporadaArbol`, `temporadaArbol`, `fechaInicio`, `estatusTemporada`) VALUES
(1, 'Primavera', '21-03', 1),
(2, 'Verano', '21-06', 0),
(3, 'Otoño', '21-09', 0),
(4, 'Invierno', '21-12', 0);

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
(3, 'Miembro'),
(4, 'Representante de una organización'),
(5, 'Socio'),
(6, 'Persona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(100) NOT NULL,
  `apePat` varchar(80) NOT NULL,
  `apeMat` varchar(80) NOT NULL,
  `correo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreUsuario`, `apePat`, `apeMat`, `correo`) VALUES
(1, 'Jonathan Jair', 'Alfaro', 'Sánchez', 'jonathan_jair_01@hotmail.com'),
(2, 'Giovanni Misael', 'Alfaro', 'Sánchez', 'giovannimisael007@hotmail.com'),
(3, 'Miguel Ángel', 'Mandujano', 'Barragán', 'miguel_dark97@hotmail.com'),
(4, 'Mary Carmen', 'Crescencio', 'Bernal', 'marylupe58@hotmail.com'),
(5, 'Frida Sofia', 'Bermudez', 'Sámchez', 'sofilove@hotmail.com'),
(6, 'Johana Elizabeth', 'Guerrero', 'Campos', 'joiz@hotmail.com'),
(7, 'Jose Luis', 'Corona', 'Huerta', 'corona@hotmail.com'),
(8, 'Oscar', 'Lopez', 'Barcenas', 'oscar@hotmail.com'),
(9, 'Manuel', 'Velazquez', 'Martinez', 'mane@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_registrados`
--

CREATE TABLE `usuarios_registrados` (
  `idUsuarioRegistrado` int(11) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL,
  `Usuarios_idUsuario` int(11) NOT NULL,
  `TiposUsuario_idTipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios_registrados`
--

INSERT INTO `usuarios_registrados` (`idUsuarioRegistrado`, `avatar`, `usuario`, `contrasenia`, `Usuarios_idUsuario`, `TiposUsuario_idTipoUsuario`) VALUES
(1, 'jona.png', 'Jona', '1234', 1, 1),
(2, 'mary.png', 'Mary', '4321', 4, 6),
(3, 'coronoa.png', 'Corona', '12345', 7, 4),
(4, 'cedami.jpg', 'cedami', 'cedami', 8, 5),
(5, 'noti.png', 'noticias', 'noticias', 5, 5),
(6, 'rodar.jpg', 'rodar', 'rodar', 2, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`idAdministrador`),
  ADD KEY `fk_administradores_usuarios_registrados1_idx` (`UsuariosRegistrados_Admin_idUsuarioRegistrado`);

--
-- Indices de la tabla `adopciones`
--
ALTER TABLE `adopciones`
  ADD PRIMARY KEY (`idAdopcion`),
  ADD KEY `fk_adopciones_usuarios_registrados1_idx` (`UsuariosRegistrados_idUsuarioRegistrado`);

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
  ADD PRIMARY KEY (`idCampania`,`Administradores_idAdministrador`,`TiposCampania_idTipoCampania`),
  ADD KEY `fk_campanias_administradores1_idx` (`Administradores_idAdministrador`),
  ADD KEY `fk_campanias_tipos_campania1_idx` (`TiposCampania_idTipoCampania`);

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
  ADD PRIMARY KEY (`idDetAdopcion`,`Adopciones_idAdopcion`,`Arboles_idArbol`),
  ADD KEY `fk_adopciones_has_arboles_arboles1_idx` (`Arboles_idArbol`),
  ADD KEY `fk_adopciones_has_arboles_adopciones1_idx` (`Adopciones_idAdopcion`);

--
-- Indices de la tabla `det_temporadas`
--
ALTER TABLE `det_temporadas`
  ADD PRIMARY KEY (`idDetTemporada`,`Arboles_idArbol`,`TemporadasArbol_idTemporadaArbol`),
  ADD KEY `fk_arboles_has_temporadas_arbol_temporadas_arbol1_idx` (`TemporadasArbol_idTemporadaArbol`),
  ADD KEY `fk_arboles_has_temporadas_arbol_arboles1_idx` (`Arboles_idArbol`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`idDireccion`,`Colonias_idColonia`),
  ADD KEY `fk_direcciones_colonias1_idx` (`Colonias_idColonia`);

--
-- Indices de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`idDonacion`),
  ADD KEY `fk_donaciones_usuarios1_idx` (`Usuarios_idUsuario`);

--
-- Indices de la tabla `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`idFaq`,`Administradores_idAdministrador`,`SeccionesFaq_idSeccionFaq`),
  ADD KEY `fk_faqs_secciones_faq1_idx` (`SeccionesFaq_idSeccionFaq`),
  ADD KEY `fk_faqs_administradores1_idx` (`Administradores_idAdministrador`);

--
-- Indices de la tabla `imagenes_campania`
--
ALTER TABLE `imagenes_campania`
  ADD PRIMARY KEY (`idImagenCampania`,`Campanias_idCampania`),
  ADD KEY `fk_imagenes_campania_campanias1_idx` (`Campanias_idCampania`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`idPersona`,`Direcciones_idDireccion`),
  ADD KEY `fk_personas_usuarios_registrados1_idx` (`UsuariosRegistrados_Persona_idUsuarioRegistrado`),
  ADD KEY `fk_personas_direcciones1_idx` (`Direcciones_idDireccion`);

--
-- Indices de la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD PRIMARY KEY (`idRepresentante`),
  ADD KEY `fk_representantes_personas1_idx` (`Personas_idPersona`);

--
-- Indices de la tabla `secciones_faq`
--
ALTER TABLE `secciones_faq`
  ADD PRIMARY KEY (`idSeccionFaq`);

--
-- Indices de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD PRIMARY KEY (`idTelefono`,`UsuariosRegistrados_Tel_idUsuarioRegistrado`),
  ADD KEY `fk_telefonos_usuarios_registrados1_idx` (`UsuariosRegistrados_Tel_idUsuarioRegistrado`);

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
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `usuarios_registrados`
--
ALTER TABLE `usuarios_registrados`
  ADD PRIMARY KEY (`idUsuarioRegistrado`,`TiposUsuario_idTipoUsuario`),
  ADD KEY `fk_usuarios_registrados_usuarios_idx` (`Usuarios_idUsuario`),
  ADD KEY `fk_usuarios_registrados_tipos_usuario1_idx` (`TiposUsuario_idTipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `adopciones`
--
ALTER TABLE `adopciones`
  MODIFY `idAdopcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `arboles`
--
ALTER TABLE `arboles`
  MODIFY `idArbol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `campanias`
--
ALTER TABLE `campanias`
  MODIFY `idCampania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `idCiudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `colonias`
--
ALTER TABLE `colonias`
  MODIFY `idColonia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `faqs`
--
ALTER TABLE `faqs`
  MODIFY `idFaq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`UsuariosRegistrados_Admin_idUsuarioRegistrado`) REFERENCES `usuarios_registrados` (`idUsuarioRegistrado`);

--
-- Filtros para la tabla `adopciones`
--
ALTER TABLE `adopciones`
  ADD CONSTRAINT `adopciones_ibfk_1` FOREIGN KEY (`UsuariosRegistrados_idUsuarioRegistrado`) REFERENCES `usuarios_registrados` (`idUsuarioRegistrado`);

--
-- Filtros para la tabla `arboles`
--
ALTER TABLE `arboles`
  ADD CONSTRAINT `arboles_ibfk_1` FOREIGN KEY (`TiposArbol_idTipoArbol`) REFERENCES `tipos_arbol` (`idTipoArbol`);

--
-- Filtros para la tabla `campanias`
--
ALTER TABLE `campanias`
  ADD CONSTRAINT `campanias_ibfk_1` FOREIGN KEY (`TiposCampania_idTipoCampania`) REFERENCES `tipos_campania` (`idTipoCampania`),
  ADD CONSTRAINT `campanias_ibfk_2` FOREIGN KEY (`Administradores_idAdministrador`) REFERENCES `administradores` (`idAdministrador`);

--
-- Filtros para la tabla `colonias`
--
ALTER TABLE `colonias`
  ADD CONSTRAINT `colonias_ibfk_1` FOREIGN KEY (`Ciudades_idCiudad`) REFERENCES `ciudades` (`idCiudad`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`TiposComentario_idTipoComentario`) REFERENCES `tipos_comentario` (`idTipoComentario`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `det_adopciones`
--
ALTER TABLE `det_adopciones`
  ADD CONSTRAINT `det_adopciones_ibfk_1` FOREIGN KEY (`Adopciones_idAdopcion`) REFERENCES `adopciones` (`idAdopcion`),
  ADD CONSTRAINT `det_adopciones_ibfk_2` FOREIGN KEY (`Arboles_idArbol`) REFERENCES `arboles` (`idArbol`);

--
-- Filtros para la tabla `det_temporadas`
--
ALTER TABLE `det_temporadas`
  ADD CONSTRAINT `det_temporadas_ibfk_1` FOREIGN KEY (`Arboles_idArbol`) REFERENCES `arboles` (`idArbol`),
  ADD CONSTRAINT `det_temporadas_ibfk_2` FOREIGN KEY (`TemporadasArbol_idTemporadaArbol`) REFERENCES `temporadas_arbol` (`idTemporadaArbol`);

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`Colonias_idColonia`) REFERENCES `colonias` (`idColonia`);

--
-- Filtros para la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD CONSTRAINT `donaciones_ibfk_1` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_ibfk_1` FOREIGN KEY (`SeccionesFaq_idSeccionFaq`) REFERENCES `secciones_faq` (`idSeccionFaq`),
  ADD CONSTRAINT `faqs_ibfk_2` FOREIGN KEY (`Administradores_idAdministrador`) REFERENCES `administradores` (`idAdministrador`);

--
-- Filtros para la tabla `imagenes_campania`
--
ALTER TABLE `imagenes_campania`
  ADD CONSTRAINT `imagenes_campania_ibfk_1` FOREIGN KEY (`Campanias_idCampania`) REFERENCES `campanias` (`idCampania`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`UsuariosRegistrados_Persona_idUsuarioRegistrado`) REFERENCES `usuarios_registrados` (`idUsuarioRegistrado`),
  ADD CONSTRAINT `personas_ibfk_2` FOREIGN KEY (`Direcciones_idDireccion`) REFERENCES `direcciones` (`idDireccion`);

--
-- Filtros para la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD CONSTRAINT `representantes_ibfk_1` FOREIGN KEY (`Personas_idPersona`) REFERENCES `personas` (`idPersona`);

--
-- Filtros para la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD CONSTRAINT `telefonos_ibfk_1` FOREIGN KEY (`UsuariosRegistrados_Tel_idUsuarioRegistrado`) REFERENCES `usuarios_registrados` (`idUsuarioRegistrado`);

--
-- Filtros para la tabla `usuarios_registrados`
--
ALTER TABLE `usuarios_registrados`
  ADD CONSTRAINT `usuarios_registrados_ibfk_1` FOREIGN KEY (`TiposUsuario_idTipoUsuario`) REFERENCES `tipos_usuario` (`idTipoUsuario`),
  ADD CONSTRAINT `usuarios_registrados_ibfk_2` FOREIGN KEY (`Usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
