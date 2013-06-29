--
-- Base de datos: `bd_sistdoc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_archivo`
--

CREATE TABLE IF NOT EXISTS `tb_archivo` (
  `id_archivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_archivo` varchar(50) DEFAULT NULL,
  `id_expediente` int(11) NOT NULL,
  PRIMARY KEY (`id_archivo`),
  KEY `Ref851` (`id_expediente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `tb_archivo`
--

INSERT INTO `tb_archivo` (`id_archivo`, `nombre_archivo`, `id_expediente`) VALUES
(1, '000001_1.png', 1),
(2, '000002_2.png', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cliente`
--

CREATE TABLE IF NOT EXISTS `tb_cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `numero_identificacion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=30 ;

--
-- Volcar la base de datos para la tabla `tb_cliente`
--

INSERT INTO `tb_cliente` (`id_cliente`, `nombre`, `numero_identificacion`) VALUES
(1, 'summer alvarado', '47347950'),
(2, 'lester ramirez', '47347951'),
(3, 'andy buitron', '47347952'),
(4, 'smith lopez ', '47347953'),
(5, 'franklin  obregon', '47347954'),
(6, 'Lester Narvasta', '47336621'),
(7, 'Colegio', '20777'),
(8, 'Juan Perez', '45678912'),
(9, 'Juan Perez', '45678912'),
(10, 'Jorge Perez', '45678999'),
(11, 'Colegio Nacional', '295885'),
(12, 'Colegio Nacional', '295885'),
(13, 'Colegio Nacional', '20999'),
(14, 'Colegio Nacional', '20999'),
(15, 'Andy Buitron', '44778866'),
(16, 'Luis', 'Benites'),
(17, 'Colegio Nacional', '20999'),
(18, '0', '0'),
(19, '0', '0'),
(20, 'Colegio Nacional Estatal', '208999'),
(21, 'Colegio Estatal', '208999'),
(22, 'Juan Perez', '44556677'),
(23, 'Colegio Estatal', '208989'),
(24, 'Colegio de Leoncio Prado', '222555888'),
(25, 'summer jean alvarado', '47347950'),
(26, 'lester', '47347950'),
(27, 'lester', '47347950'),
(28, '0', '0'),
(29, 'Buitron Villagaray Andy Omar', '47823253');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cuenta_usuario`
--

CREATE TABLE IF NOT EXISTS `tb_cuenta_usuario` (
  `id_cuenta_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_cuenta_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `tb_cuenta_usuario`
--

INSERT INTO `tb_cuenta_usuario` (`id_cuenta_usuario`, `usuario`, `clave`) VALUES
(1, 'admin', '123'),
(2, 'TRAMITE', '123'),
(3, 'ALCALDE', '123'),
(4, 'GERENCIA', '123'),
(5, 'obras', '123'),
(6, 'tesoreria', '123'),
(7, 'log', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_estado`
--

CREATE TABLE IF NOT EXISTS `tb_estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `tb_estado`
--

INSERT INTO `tb_estado` (`id_estado`, `nombre`) VALUES
(1, 'recibido '),
(2, 'Por Atender'),
(3, 'derivado'),
(4, 'No tramitado'),
(5, 'derivar concluido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_expediente`
--

CREATE TABLE IF NOT EXISTS `tb_expediente` (
  `id_expediente` int(11) NOT NULL AUTO_INCREMENT,
  `id_procedimiento` int(11) NOT NULL,
  `numero_expediente` varchar(50) DEFAULT NULL,
  `numero_documento` varchar(50) DEFAULT NULL,
  `asunto` varchar(300) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `folio` int(11) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `estado_expediente` char(1) DEFAULT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `observacion` varchar(250) NOT NULL,
  PRIMARY KEY (`id_expediente`),
  KEY `Ref1446` (`id_tipo_documento`),
  KEY `Ref2047` (`id_procedimiento`),
  KEY `Ref118` (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=32 ;

--
-- Volcar la base de datos para la tabla `tb_expediente`
--

INSERT INTO `tb_expediente` (`id_expediente`, `id_procedimiento`, `numero_expediente`, `numero_documento`, `asunto`, `fecha`, `folio`, `id_cliente`, `estado_expediente`, `id_tipo_documento`, `observacion`) VALUES
(1, 1, '0000001', '3', 'Apollo economico para la construccion de un puente ', '2012-11-16 09:58:17', 1, 1, '1', 2, ''),
(2, 2, '0000002', '2', 'Reunion ordinaria', '2012-11-16 09:58:17', 2, 2, '1', 1, ''),
(3, 1, '2012-100003', '', 'Construccion de Loza Deportiva', '2012-11-24 22:46:33', 2, 6, '1', 1, ''),
(4, 2, '2012-100004', '2012-001', 'Muerte de Tupac Amaru', '2012-11-24 23:38:48', 2, 7, '1', 1, ''),
(5, 1, '2012-100005', '', 'Construccion de Colegio', '2012-11-24 23:59:09', 2, 8, '1', 1, ''),
(7, 1, '2012-100007', '', 'Construccion de Puente', '2012-11-25 00:05:51', 1, 9, '2', 1, ''),
(8, 1, '2012-100008', '', 'Construccion de Casa', '2012-11-25 16:29:52', 1, 10, '1', 1, ''),
(10, 2, '2012-1000010', '2012-01', 'Reunion de Profesores', '2012-11-25 16:42:06', 2, 12, '2', 1, ''),
(12, 1, '2012-1000012', '2012-02', 'Reunion Directores', '2012-11-25 16:38:08', 2, 14, '1', 2, ''),
(13, 1, '2012-1000013', '', 'Mantenimiento de Pista', '2012-11-25 16:40:51', 2, 15, '1', 1, ''),
(14, 1, '2012-1000014', '', 'Permiso para agregar solicitud', '2012-11-25 18:38:22', 0, 16, '1', 1, ''),
(15, 1, '2012-1000015', '', 'Financiamiento de Viaje', '2012-12-06 18:51:31', 0, 17, '1', 1, ''),
(18, 0, '2012-1000018', '', 'Financiamiento de Viaje de Promocion', '2012-12-06 21:19:20', 0, 20, '1', 1, ''),
(19, 0, '2012-1000019', '', 'Reuniion Urgente', '2012-12-06 21:20:04', 0, 21, '1', 1, ''),
(20, 0, '2012-1000020', '0001-2012', 'Apoyo', '2012-12-20 00:41:12', 0, 22, '1', 1, '1010'),
(21, 0, '2012-1000021', '', 'Reunion de profesores', '2012-12-07 15:42:56', 2, 23, '1', 1, ''),
(22, 0, '2012-1000022', '001-2013', 'Fin de Año Academico', '2012-12-14 01:26:02', 0, 24, '1', 2, ''),
(23, 1, '2012-1000023', '', 'licencia', '2012-12-14 17:22:30', 2, 25, '2', 1, ''),
(24, 1, '2012-1000024', '', 'licencia', '2012-12-14 13:08:17', 2, 26, '1', 1, ''),
(25, 1, '2012-1000025', '', 'licencia', '2012-12-20 00:40:39', 2, 27, '2', 1, 'ooo'),
(26, 0, '2012-1000026', '', 'Ayuda de Sistema', '2012-12-19 13:37:56', 0, 6, '1', 1, ''),
(27, 0, '2012-1000027', '', 'Apoyo', '2012-12-19 18:12:10', 0, 22, '2', 1, ''),
(28, 0, '2012-1000028', '', 'Construccion de Loza Deportiva', '2012-12-20 00:41:58', 2, 22, '1', 1, 'Hola'),
(29, 0, '2012-1000029', '', 'Construccion de Loza Deportiva', '2012-12-20 00:40:17', 2, 22, '1', 1, 'Nueva Observacion 12345'),
(30, 5, '030-2012', '', 'eventos', '2012-12-20 17:34:04', 2, 29, '2', 1, ''),
(31, 2, '31-2012', '', 'eventos', '2012-12-20 17:53:06', 2, 29, '2', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_movimiento`
--

CREATE TABLE IF NOT EXISTS `tb_movimiento` (
  `id_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `id_expediente` int(11) NOT NULL,
  `id_organo_administrativo` int(11) DEFAULT NULL,
  `org_destino` int(11) DEFAULT NULL,
  `fecha_recepcion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rol_recepcion` int(11) DEFAULT NULL,
  `fecha_derivacion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rol_derivacion` int(11) DEFAULT NULL,
  `fecha_atencion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rol_atencion` int(11) DEFAULT NULL,
  `id_estado` int(11) NOT NULL,
  `proveido` varchar(250) NOT NULL,
  `historial` varchar(250) NOT NULL,
  PRIMARY KEY (`id_movimiento`),
  KEY `Ref356` (`rol_derivacion`),
  KEY `Ref359` (`rol_atencion`),
  KEY `Ref360` (`rol_recepcion`),
  KEY `Ref812` (`id_expediente`),
  KEY `Ref429` (`id_estado`),
  KEY `Ref536` (`id_organo_administrativo`),
  KEY `Ref539` (`org_destino`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=67 ;

--
-- Volcar la base de datos para la tabla `tb_movimiento`
--

INSERT INTO `tb_movimiento` (`id_movimiento`, `id_expediente`, `id_organo_administrativo`, `org_destino`, `fecha_recepcion`, `rol_recepcion`, `fecha_derivacion`, `rol_derivacion`, `fecha_atencion`, `rol_atencion`, `id_estado`, `proveido`, `historial`) VALUES
(1, 1, 1, 2, '2012-11-16 00:00:00', 1, '2012-11-17 00:00:00', 2, '2012-11-17 00:00:00', 1, 1, '', ''),
(2, 3, 0, 1, '2012-11-24 22:46:30', 1, '2012-11-24 22:46:30', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(3, 3, 1, 2, '2012-11-24 23:17:07', 2, '2012-11-24 23:17:07', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(4, 3, 2, 5, '2012-11-24 23:17:07', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 2, '', ''),
(5, 4, 0, 1, '2012-11-24 23:38:45', 1, '2012-11-24 23:38:45', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(6, 4, 1, 2, '2012-11-24 23:39:19', 2, '2012-11-24 23:39:19', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(7, 4, 2, 4, '2012-11-24 23:40:09', 2, '2012-11-24 23:40:09', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(8, 4, 4, 5, '2012-11-24 23:44:04', 2, '0000-00-00 00:00:00', 0, '2012-11-24 23:44:04', 2, 5, '', ''),
(9, 5, 0, 1, '2012-11-24 23:59:06', 1, '2012-11-24 23:59:06', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(10, 5, 1, 2, '2012-11-25 00:00:06', 2, '2012-11-25 00:00:06', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(11, 5, 2, 4, '2012-11-25 00:00:35', 2, '2012-11-25 00:00:35', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(12, 5, 4, 4, '2012-11-25 00:00:49', 2, '0000-00-00 00:00:00', 0, '2012-11-25 00:00:49', 2, 5, '', ''),
(13, 7, 0, 1, '2012-11-25 00:04:34', 1, '2012-11-25 00:04:34', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(14, 7, 1, 2, '2012-11-25 00:05:04', 2, '2012-11-25 00:05:04', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(15, 7, 2, 2, '2012-11-25 00:05:24', 2, '2012-11-25 00:05:24', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(16, 7, 2, 5, '2012-11-25 00:05:51', 2, '0000-00-00 00:00:00', 0, '2012-11-25 00:05:51', 2, 5, '', ''),
(17, 8, 0, 1, '2012-11-25 16:29:49', 1, '2012-11-25 16:29:49', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(18, 8, 1, 2, '2012-11-25 16:29:52', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 2, '', ''),
(19, 10, 0, 1, '2012-11-25 16:31:08', 1, '2012-11-25 16:31:08', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(20, 10, 1, 2, '2012-11-25 16:42:00', 2, '2012-11-25 16:42:00', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(21, 12, 0, 1, '2012-11-25 16:38:08', 1, '2012-11-25 16:38:08', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(22, 12, 1, 2, '2012-11-25 19:52:48', 2, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, '', ''),
(23, 13, 0, 1, '2012-11-25 16:40:50', 1, '2012-11-25 16:40:50', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(24, 13, 1, 2, '2012-11-25 18:17:39', 2, '2012-11-25 18:17:39', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(25, 10, 2, 4, '2012-11-25 16:42:06', 2, '0000-00-00 00:00:00', 0, '2012-11-25 16:42:06', 2, 5, '', ''),
(26, 13, 2, 3, '2012-11-25 18:18:01', 2, '2012-11-25 18:18:01', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(27, 13, 3, 6, '2012-11-25 18:23:20', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, '', ''),
(28, 14, 0, 1, '2012-11-25 18:36:32', 1, '2012-11-25 18:36:32', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(29, 14, 1, 2, '2012-11-25 18:41:54', 2, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, '', ''),
(30, 15, 0, 1, '2012-12-06 18:51:28', 2, '2012-12-06 18:51:28', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(31, 15, 1, 3, '2012-12-06 20:03:07', 3, '2012-12-06 20:03:07', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(32, 15, 3, 5, '2012-12-06 20:03:10', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 2, '', ''),
(33, 18, 0, 1, '2012-12-06 21:19:17', 2, '2012-12-06 21:19:17', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(34, 18, 1, 2, '2012-12-06 21:19:20', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 2, '', ''),
(35, 19, 0, 1, '2012-12-06 21:20:02', 2, '2012-12-06 21:20:02', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(36, 19, 1, 2, '2012-12-06 21:20:04', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 2, '', ''),
(37, 20, 0, 1, '2012-12-06 22:41:05', 0, '2012-12-06 22:41:05', 0, '0000-00-00 00:00:00', 0, 3, '', ''),
(38, 20, 1, 2, '2012-12-06 22:42:18', 2, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, '', ''),
(39, 21, 0, 1, '2012-12-07 15:42:53', 2, '2012-12-07 15:42:53', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(40, 21, 1, 2, '2012-12-07 15:46:07', 2, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, '', ''),
(41, 22, 0, 1, '2012-12-14 01:26:00', 0, '2012-12-14 01:26:00', 0, '0000-00-00 00:00:00', 0, 3, '', ''),
(42, 22, 1, 2, '2012-12-14 01:26:02', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 2, '', ''),
(43, 23, 0, 1, '2012-12-14 17:12:35', 1, '2012-12-14 17:12:35', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(44, 23, 1, 2, '2012-12-14 17:16:08', 2, '2012-12-14 17:16:08', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(45, 23, 2, 8, '2012-12-14 17:20:38', 4, '2012-12-14 17:20:38', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(46, 23, 8, 3, '2012-12-14 17:22:30', 3, '0000-00-00 00:00:00', 0, '2012-12-14 17:22:30', 3, 5, '', ''),
(47, 24, 0, 1, '2012-12-14 07:08:13', 1, '2012-12-14 07:08:13', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(48, 24, 1, 2, '2012-12-14 13:08:17', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 2, '', ''),
(49, 25, 0, 1, '2012-12-14 07:08:19', 1, '2012-12-14 07:08:19', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(50, 25, 1, 2, '2012-12-14 13:10:56', 2, '2012-12-14 07:10:56', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(51, 25, 2, 8, '2012-12-14 07:11:57', 4, '0000-00-00 00:00:00', 0, '2012-12-14 07:11:57', 4, 5, '', ''),
(52, 26, 0, 1, '2012-12-19 13:37:53', 1, '2012-12-19 13:37:53', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(53, 26, 1, 1, '2012-12-19 16:41:53', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, '', ''),
(54, 27, 0, 1, '2012-12-19 17:45:04', 1, '2012-12-19 17:45:04', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(55, 27, 1, 2, '2012-12-21 01:41:47', 2, '2012-12-19 18:05:20', 2, '0000-00-00 00:00:00', 0, 3, 'Pasa al area de Obras Publicas para Revisar\nNecesita evaluar el Presupuesto', ''),
(56, 27, 2, 8, '2012-12-19 18:12:10', 4, '0000-00-00 00:00:00', 0, '2012-12-19 18:12:10', 4, 5, '', ''),
(57, 28, 0, 1, '2012-12-19 18:27:34', 1, '2012-12-19 18:27:34', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(58, 28, 1, 2, '2012-12-19 18:27:39', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 2, '', ''),
(59, 29, 0, 1, '2012-12-19 18:27:40', 1, '2012-12-19 18:27:40', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(60, 29, 1, 2, '2012-12-21 11:47:13', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 2, 'und23fgdfg', 'HISio'),
(61, 30, 0, 1, '2012-12-20 17:22:30', 1, '2012-12-20 17:22:30', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(62, 30, 1, 2, '2012-12-20 17:34:01', 2, '0000-00-00 00:00:00', 0, '2012-12-20 17:34:01', 2, 5, '', ''),
(63, 31, 0, 1, '2012-12-20 17:39:14', 1, '2012-12-20 17:39:14', 1, '0000-00-00 00:00:00', 0, 3, '', ''),
(64, 31, 1, 2, '2012-12-20 17:41:21', 2, '2012-12-20 17:41:21', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(65, 31, 2, 8, '2012-12-20 17:44:07', 4, '2012-12-20 17:44:07', 2, '0000-00-00 00:00:00', 0, 3, '', ''),
(66, 31, 8, 5, '2012-12-20 17:53:06', 5, '0000-00-00 00:00:00', 0, '2012-12-20 17:53:06', 5, 5, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_nivel_acceso`
--

CREATE TABLE IF NOT EXISTS `tb_nivel_acceso` (
  `id_nivel_acceso` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nivel_acceso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `tb_nivel_acceso`
--

INSERT INTO `tb_nivel_acceso` (`id_nivel_acceso`, `nivel`) VALUES
(1, 0),
(2, 1),
(3, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_observacion`
--

CREATE TABLE IF NOT EXISTS `tb_observacion` (
  `id_observacion` int(11) NOT NULL AUTO_INCREMENT,
  `observacion` varchar(100) DEFAULT NULL,
  `id_movimiento` int(11) NOT NULL,
  PRIMARY KEY (`id_observacion`),
  KEY `Ref944` (`id_movimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `tb_observacion`
--

INSERT INTO `tb_observacion` (`id_observacion`, `observacion`, `id_movimiento`) VALUES
(1, 'ok', 37),
(2, 'First', 37),
(5, 'Termino', 37),
(7, 'dato 1', 38),
(8, 'primer dato', 35),
(9, 'ok', 43),
(10, 'ok', 51),
(11, 'documento por revisar con estado de urgencia', 61);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_organo_administrativo`
--

CREATE TABLE IF NOT EXISTS `tb_organo_administrativo` (
  `id_organo_administrativo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_area` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_organo_administrativo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=23 ;

--
-- Volcar la base de datos para la tabla `tb_organo_administrativo`
--

INSERT INTO `tb_organo_administrativo` (`id_organo_administrativo`, `nombre_area`) VALUES
(0, ''),
(1, 'Tramite'),
(2, 'Alcaldia'),
(3, 'Gerencia'),
(4, 'Logistica'),
(5, 'Tesoreria'),
(6, 'Comite Especial de Adquisicion'),
(8, 'Obras Publicas'),
(9, 'Seguridad'),
(11, 'Asesoria Legal'),
(12, 'Secretaria General'),
(13, 'Catastro'),
(14, 'Control Patrimonial'),
(15, 'Maquinaria'),
(16, 'Gestrion de Personal'),
(17, 'Participacion Social'),
(18, 'Gestion Pedagogica'),
(19, 'Biblioteca'),
(20, 'Demuna'),
(21, 'Archivo'),
(22, 'Mercado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_procedimiento`
--

CREATE TABLE IF NOT EXISTS `tb_procedimiento` (
  `id_procedimiento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_procedimiento` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_procedimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=8 ;

--
-- Volcar la base de datos para la tabla `tb_procedimiento`
--

INSERT INTO `tb_procedimiento` (`id_procedimiento`, `nombre_procedimiento`) VALUES
(0, '<< Ninguno >>'),
(1, 'Expedicion de constancias.'),
(2, 'Recurso administrativo de reconsideracion contra resoluciones administrativas.'),
(3, 'Farcionamiento deudas tributarias soporte normativo.'),
(4, 'Procedimieto de prueba.'),
(5, 'Autorizacion de eventos y/o espectaculos publicos no deportivos.'),
(6, 'Inscripcion de menores de edad por mandato judicial.'),
(7, 'Expedicion de Constancias.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_reporte`
--

CREATE TABLE IF NOT EXISTS `tb_reporte` (
  `id_reporte` int(11) NOT NULL,
  `fecha_reporte` char(10) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_expediente` int(11) DEFAULT NULL,
  `id_tipo_reporte` int(11) NOT NULL,
  PRIMARY KEY (`id_reporte`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `tb_reporte`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_rol_usuario`
--

CREATE TABLE IF NOT EXISTS `tb_rol_usuario` (
  `id_rol_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(100) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `id_organo_administrativo` int(11) NOT NULL,
  `id_cuenta_usuario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_nivel_acceso` int(11) NOT NULL,
  PRIMARY KEY (`id_rol_usuario`),
  KEY `Ref152` (`id_cuenta_usuario`),
  KEY `Ref753` (`id_usuario`),
  KEY `Ref261` (`id_nivel_acceso`),
  KEY `Ref519` (`id_organo_administrativo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `tb_rol_usuario`
--

INSERT INTO `tb_rol_usuario` (`id_rol_usuario`, `nombre_rol`, `estado`, `id_organo_administrativo`, `id_cuenta_usuario`, `id_usuario`, `id_nivel_acceso`) VALUES
(0, '', 'A', 0, 1, 1, 1),
(1, 'Jefe de Tramite', '1', 1, 2, 2, 3),
(2, 'Alcalde', '0', 2, 3, 3, 2),
(3, 'Gerencia', '0', 3, 4, 4, 2),
(4, 'Obras publicas', '1', 8, 5, 6, 3),
(5, 'tesoreria', '1', 5, 6, 8, 3),
(6, 'Logistica', '1', 4, 7, 11, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_documento`
--

CREATE TABLE IF NOT EXISTS `tb_tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_documento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_documento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=13 ;

--
-- Volcar la base de datos para la tabla `tb_tipo_documento`
--

INSERT INTO `tb_tipo_documento` (`id_tipo_documento`, `nombre_tipo_documento`) VALUES
(1, 'Solicitud'),
(2, 'Oficio'),
(3, 'Memorandum'),
(4, 'Carta'),
(5, 'Informe'),
(6, 'Contratos'),
(7, 'Provehido'),
(8, 'Oficio Multiple'),
(9, 'Resolucion'),
(10, 'Archivo'),
(11, 'Acuerdo de Sesion Ordinaria'),
(12, 'Acuerdo de Sesion Extraordinaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_reporte`
--

CREATE TABLE IF NOT EXISTS `tb_tipo_reporte` (
  `id_tipo_reporte` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_reporte` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_reporte`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `tb_tipo_reporte`
--

INSERT INTO `tb_tipo_reporte` (`id_tipo_reporte`, `nombre_reporte`) VALUES
(1, 'Individual'),
(2, 'General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuario`
--

CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `dni` char(8) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido_paterno` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=14 ;

--
-- Volcar la base de datos para la tabla `tb_usuario`
--

INSERT INTO `tb_usuario` (`id_usuario`, `dni`, `nombre`, `apellido_paterno`) VALUES
(1, '00000000', 'Administrador', 'de Sistema'),
(2, '44444333', 'Marco', 'Gonzales'),
(3, '33333322', 'Maximo', 'Carmin'),
(4, '12345678', 'Pedro', 'Rivera'),
(5, '59435946', 'Bernardino', 'Acevedo'),
(6, '45523278', 'Victor', 'Guerrero'),
(8, '47336621', 'Lester', 'Narvasta Ramirez'),
(10, '123456', 'Jean', 'Alvarado'),
(11, '123456', 'Usuario', '2'),
(12, '789456', 'Usuario', '3'),
(13, '456963', 'Usuario', '4');

--
-- Filtros para la tabla `tb_expediente`
--
ALTER TABLE `tb_expediente`
  ADD CONSTRAINT `Refprocedimiento47` FOREIGN KEY (`id_procedimiento`) REFERENCES `tb_procedimiento` (`id_procedimiento`),
  ADD CONSTRAINT `Reftb_cliente8` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`),
  ADD CONSTRAINT `Reftb_tipo_documento46` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tb_tipo_documento` (`id_tipo_documento`);

--
-- Filtros para la tabla `tb_movimiento`
--
ALTER TABLE `tb_movimiento`
  ADD CONSTRAINT `Reftb_estado29` FOREIGN KEY (`id_estado`) REFERENCES `tb_estado` (`id_estado`),
  ADD CONSTRAINT `Reftb_expediente12` FOREIGN KEY (`id_expediente`) REFERENCES `tb_expediente` (`id_expediente`),
  ADD CONSTRAINT `Reftb_organo_administrativo36` FOREIGN KEY (`id_organo_administrativo`) REFERENCES `tb_organo_administrativo` (`id_organo_administrativo`),
  ADD CONSTRAINT `Reftb_organo_administrativo39` FOREIGN KEY (`org_destino`) REFERENCES `tb_organo_administrativo` (`id_organo_administrativo`),
  ADD CONSTRAINT `Reftb_rol_usuario56` FOREIGN KEY (`rol_derivacion`) REFERENCES `tb_rol_usuario` (`id_rol_usuario`),
  ADD CONSTRAINT `Reftb_rol_usuario59` FOREIGN KEY (`rol_atencion`) REFERENCES `tb_rol_usuario` (`id_rol_usuario`),
  ADD CONSTRAINT `Reftb_rol_usuario60` FOREIGN KEY (`rol_recepcion`) REFERENCES `tb_rol_usuario` (`id_rol_usuario`);

--
-- Filtros para la tabla `tb_observacion`
--
ALTER TABLE `tb_observacion`
  ADD CONSTRAINT `Reftb_movimiento44` FOREIGN KEY (`id_movimiento`) REFERENCES `tb_movimiento` (`id_movimiento`);

--
-- Filtros para la tabla `tb_rol_usuario`
--
ALTER TABLE `tb_rol_usuario`
  ADD CONSTRAINT `Reftb_cuenta_usuario52` FOREIGN KEY (`id_cuenta_usuario`) REFERENCES `tb_cuenta_usuario` (`id_cuenta_usuario`),
  ADD CONSTRAINT `Reftb_nivel_acceso61` FOREIGN KEY (`id_nivel_acceso`) REFERENCES `tb_nivel_acceso` (`id_nivel_acceso`),
  ADD CONSTRAINT `Reftb_organo_administrativo19` FOREIGN KEY (`id_organo_administrativo`) REFERENCES `tb_organo_administrativo` (`id_organo_administrativo`),
  ADD CONSTRAINT `Reftb_usuario53` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id_usuario`);
