SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+01:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE IF NOT EXISTS `gch_admin` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `ref` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'close',
  `Nombre` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',
  `doc` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Password` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Tlf1` varchar(9) NOT NULL DEFAULT '0',
  `Tlf2` varchar(9) NOT NULL DEFAULT '0',
  `lastin` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `lastout` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `visitadmin` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
	UNIQUE KEY `id` (`id`),
	UNIQUE KEY `ref` (`ref`),
	UNIQUE KEY `dni` (`dni`),
	UNIQUE KEY `Email` (`Email`),
	UNIQUE KEY `Usuario` (`Usuario`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `gch_admin` (`id`, `ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`, `lastin`, `lastout`, `visitadmin`) VALUES
(1, 'jbp55555555k', 'admin', 'Juan', 'Barros Pazos', 'jbp55555555k.jpg', 'DNI', '55555555', 'K', 'juanbarrospazos@hotmail.es', 'admin', 'admin', 'Palma de Mallorca', '111111111', '111111112', '2020-06-26/09:47:48', '2020-06-25/19:18:41', '53');


CREATE TABLE `gch_user` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `ref` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'useru',
  `Nombre` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',
  `Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Password` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Tlf1` varchar(9) NOT NULL DEFAULT '0',
  `lastin` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `lastout` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `visituser` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`),
	UNIQUE KEY `ref` (`ref`),
	UNIQUE KEY `Email` (`Email`),
	UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gch_user` (`id`, `ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `lastin`, `lastout`, `visituser`) VALUES
(1, 'jbp55555555k', 'user', 'Juan', 'Barros Pazos', 'jbp55555555k.jpg', 'juanbarrospazos@hotmail.es', 'user', 'user', 'Palma de Mallorca', '111111111', '2020-06-26/09:47:48', '2020-06-25/19:18:41', '1');


CREATE TABLE IF NOT EXISTS `gch_art` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `refuser` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `refart` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `tit` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `titsub` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `datein` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `timein` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `datemod` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `timemod` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `conte` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',
  `myimg2` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',
  `myimg3` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',
  `myimg4` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',
  `refayto` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `refisla` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `reftipo` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `refespec1` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `refespec2` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `iprecio` int(4) NOT NULL DEFAULT '50',
  `ivalora` int(4) NOT NULL DEFAULT '50',
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'http://juanbarrospazos.blogspot.com.es/',
  `map` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'https://goo.gl/maps/63M96me7YdBkhJLf7',
  `mapiframe` varchar(340) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3075.5997770189756!2d2.6670561!3d39.568631!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x55bc574de040df4a!2sCIFP%20Francesc%20de%20Borja%20Moll!5e0!3m2!1ses!2ses!4v1593844861566!5m2!1ses!2ses',
  `latitud` float(10,6) NOT NULL DEFAULT 39.569065,
  `longitud` float(10,6) NOT NULL DEFAULT 2.667335,
  `calle` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Tlf1` varchar(9) NOT NULL DEFAULT '0',
  `Tlf2` varchar(9) NOT NULL DEFAULT '0',
	PRIMARY KEY  (`id`),
	UNIQUE KEY `id` (`id`),
	UNIQUE KEY `refart` (`refart`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gch_art`
--

INSERT INTO `gch_art` (`id`, `refuser`, `refart`, `tit`, `titsub`, `datein`, `timein`, `datemod`, `timemod`, `conte`, `myimg1`, `myimg2`, `myimg3`, `myimg4`, `refayto`, `refisla`, `reftipo`, `refespec1`, `refespec2`, `iprecio`, `ivalora`, `url`, `map`, `mapiframe`, `latitud`, `longitud`, `calle`, `Email`, `Tlf1`, `Tlf2`) VALUES
(1, 'jbp55555555k', '2020.06.16.13.18.15', 'RESTAURANTE 01', 'REST 01bbb', '2020-06-16', '13:18:15', '2020-06-20', '12:26:14', 'RESTAURANTE 01 bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla BLE BLE BLE BLE BLE BLE', '2020.06.16.13.18.15_2241a.jpg', '2020.06.16.13.18.15_2241b.jpg', '2020.06.16.13.18.15_2241c.jpg', '2020.06.16.13.18.15_2241d.jpg', 'sedr', 'ibiz', 'parr', 'carn', 'pesc', 4, 3, 'http://juanbarrospazos.blogspot.com.es/', 'https://goo.gl/maps/umAsLPALDLpRys9H7', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6209.059610409907!2d1.4221816!3d38.9118664!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8fefb99174ce7c10!2sAjuntament%20d&#39;Eivissa!5e0!3m2!1ses!2ses!4v1593844047155!5m2!1ses!2ses', 38.912258, 1.424649, 'Ibiza 1', 'juanbarrospazos@hotmail.es', '111111111', '111111112'),
(2, 'jbp55555555k', '2020.06.16.13.36.02', 'RESTAURANTE 02', 'REST 02', '2020-06-16', '13:36:02', '0000-00-00', '00:00:00', 'RESTAURANTE 02 bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla BLE BLE BLE BLE BLE BLE', '2020.06.16.13.36.02a.jpg', '2020.06.16.13.36.02b.jpg', '2020.06.16.13.36.02c.jpg', '2020.06.16.13.36.02d.jpg', 'arta', 'mall', 'cafb', 'conv', 'otrs', 3, 3, 'http://juanbarrospazos.blogspot.com.es/', 'https://goo.gl/maps/5mf8PsbopX7WPmUt7', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d24598.440805839946!2d2.6406005!3d39.5865427!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc8f728352f576d9b!2sAjuntament%20De%20Palma%20De%20Mallorca!5e0!3m2!1ses!2ses!4v1593845158274!5m2!1ses!2ses', 39.591667, 2.647381, 'Mallorca 1', 'juanbarrospazos@hotmail.com', '222222221', '222222222'),
(3, 'jbp55555555k', '2020.06.16.13.44.27', 'RESTAURANTE 03', 'REST 03', '2020-06-16', '13:44:27', '0000-00-00', '00:00:00', 'RESTAURANTE 03 bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla BLE BLE BLE BLE BLE BLE', '2020.06.16.13.44.27a.jpg', '2020.06.16.13.44.27b.jpg', '2020.06.16.13.44.27c.jpg', '2020.06.16.13.44.27d.jpg', 'form', 'form', 'burg', 'conv', 'otrs', 60, 80, 'http://juanbarrospazos.blogspot.com.es/', 'https://goo.gl/maps/5kKBi9tm8NyamCWZ8', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1556.772119853823!2d1.4284584!3d38.7053121!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8f9e5e528e730c87!2sConsell%20Insular%20de%20Formentera!5e0!3m2!1ses!2ses!4v1593845251079!5m2!1ses!2ses', 38.705490, 1.428705, 'Formentera 1', 'juanbarrospazos@gmail.com', '333333331', '333333332'),
(4, 'jbp55555555k', '2020.06.16.13.47.17', 'RESTAURANTE 04', 'REST 04', '2020-06-16', '13:47:17', '0000-00-00', '00:00:00', 'RESTAURANTE 04 bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla BLE BLE BLE BLE BLE BLE', '2020.06.16.13.47.17a.jpg', '2020.06.16.13.47.17b.jpg', '2020.06.16.13.47.17c.jpg', '2020.06.16.13.47.17d.jpg', 'sapr', 'ibiz', 'rs02', 'fusi', 'degu', 3, 3, 'http://juanbarrospazos.blogspot.com.es/', 'https://goo.gl/maps/HskrA7YKNerAoLxB8', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3104.736067743047!2d1.4273197153506523!3d38.90715047956907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x129946bb67f053ab%3A0x79c4e31b18a27d9!2sMuseu%20Monogr%C3%A0fic%20Puig%20des%20Molins!5e0!3m2!1ses!2ses!4v1593845309872!5m2!1ses!2ses', 38.907349, 1.429541, 'Ibiza 2', 'juanbarrospazos@hotmail.es', '444444441', '444444442'),
(5, 'jbp55555555k', '2020.06.16.13.18.17', 'RESTAURANTE 05', 'REST 05', '2020-06-17', '13:18:15', '0000-00-00', '00:00:00', 'RESTAURANTE 05 bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla BLE BLE BLE BLE BLE BLE', '2020.06.16.13.18.17_2636a.jpg', '2020.06.16.13.18.17_2636b.jpg', '2020.06.16.13.18.17_2636c.jpg', '2020.06.16.13.18.17_2636d.jpg', 'sedr', 'ibiz', 'parr', 'carn', 'pesc', 2, 3, 'http://juanbarrospazos.blogspot.com.es/', 'https://goo.gl/maps/gVDM3vXVXExVKDuk6', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6208.848656973733!2d1.4414994!3d38.9142778!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1299414a96c7bd75%3A0x55ae6023eef82c8e!2sL%C3%ADo%20Ibiza!5e0!3m2!1ses!2ses!4v1593845379210!5m2!1ses!2ses', 38.914085, 1.443087, 'Ibiza 5', 'juanbarrospazos@hotmail.com', '555555555', '555555552'),
(6, 'jbp55555555k', '2020.06.16.13.18.18', 'RESTAURANTE 06', 'REST 06', '2020-06-17', '13:18:15', '0000-00-00', '00:00:00', 'RESTAURANTE 06 bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla BLE BLE BLE BLE BLE BLE', '2020.06.16.13.18.18_4011a.jpg', '2020.06.16.13.18.18_4011b.jpg', '2020.06.16.13.18.18_4011c.jpg', '2020.06.16.13.18.18_4011d.jpg', 'sedr', 'ibiz', 'parr', 'carn', 'pesc', 4, 3, 'http://juanbarrospazos.blogspot.com.es/', 'https://goo.gl/maps/tPgxPQRJG1ELuEm4A', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6208.548007015129!2d1.4426118!3d38.9177143!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x14935029aa2a6457!2sEl%20Hotel%20Pacha!5e0!3m2!1ses!2ses!4v1593845447379!5m2!1ses!2ses', 38.917725, 1.443813, 'Ibiza 6', 'juanbarrospazos@gmail.com', '666666666', '666666662'),
(7, 'jbp55555555k', '2020.06.16.13.18.19', 'RESTAURANTE 07', 'REST 07', '2020-06-17', '13:18:15', '0000-00-00', '00:00:00', 'RESTAURANTE 07 bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla BLE BLE BLE BLE BLE BLE', '2020.06.16.13.18.19_4638a.jpg', '2020.06.16.13.18.19_4638b.jpg', '2020.06.16.13.18.19_4638c.jpg', '2020.06.16.13.18.19_4638d.jpg', 'sedr', 'ibiz', 'parr', 'pesc', 'carn', 3, 3, 'http://juanbarrospazos.blogspot.com.es/', 'https://g.page/carpediem-eivissa?share', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3103.807635027215!2d1.4502959153512736!3d38.92837407956592!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1299412f0ad5185b%3A0xc2eea7d77be67a8e!2sCarpe%20Diem%20-%20Restaurante%20%2F%20Pizzer%C3%ACa!5e0!3m2!1ses!2ses!4v1593845551650!5m2!1ses!2ses', 38.928570, 1.452452, 'Ibiza 7', 'juanbarrospazos@hotmail.es', '777777777', '777777772'),
(8, 'jbp55555555k', '2020.06.20.09.29.39', 'XESCA JOAN', 'XESCA MI AMOR', '2020-06-20', '09:29:39', '0000-00-00', '00:00:00', 'RESTAURANTE XESCA JOAN bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla BLE BLE BLE BLE BLE BLE', '2020.06.20.09.29.39a.jpg', '2020.06.20.09.29.39b.jpg', '2020.06.20.09.29.39c.jpg', '2020.06.20.09.29.39d.jpg', 'plma', 'mall', 'rs01', 'fusi', 'etni', 2, 3, 'http://juanbarrospazos.blogspot.com.es/', 'https://g.page/Animabeach?share', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3075.81627784647!2d2.656094315370149!3d39.563749979473286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1297924b494d197f%3A0x721af2e559f771ef!2sAnima%20Beach%20Palma!5e0!3m2!1ses!2ses!4v1593845621204!5m2!1ses!2ses', 39.563927, 2.658283, 'Otra calle de Palma', 'juanbarrospazos@hotmail.com', '999999995', '999999996'),
(9, 'jbp55555555k', '2020.06.20.09.33.53', 'XESCA BARROS', 'MI AMORCITO', '2020-06-20', '09:33:53', '0000-00-00', '00:00:00', 'RESTAURANTE XESCA BARROS bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla BLE BLE BLE BLE BLE BLE', '2020.06.20.09.33.53a.jpg', '2020.06.20.09.33.53b.jpg', '2020.06.20.09.33.53c.jpg', '2020.06.20.09.33.53d.jpg', 'plma', 'mall', 'parr', 'carn', 'pesc', 4, 3, 'http://juanbarrospazos.blogspot.com.es/', 'https://goo.gl/maps/63M96me7YdBkhJLf7', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3075.5997770189756!2d2.6670561!3d39.568631!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x55bc574de040df4a!2sCIFP%20Francesc%20de%20Borja%20Moll!5e0!3m2!1ses!2ses!4v1593844861566!5m2!1ses!2ses', 39.569065, 2.667335, 'otra callecita de palma', 'juanbarrospazos@gmail.com', '333333334', '333333335');
 

CREATE TABLE IF NOT EXISTS `gch_aytos` (
	`id` int(3) NOT NULL auto_increment,
		`ayto` varchar(26) collate utf8_spanish2_ci NOT NULL,
		`refayto` varchar(4) collate utf8_spanish2_ci NOT NULL,
		`refisla` varchar(4) collate utf8_spanish2_ci NOT NULL,
		PRIMARY KEY  (`id`),
		UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gch_aytos` (`id`, `ayto`, `refayto`, `refisla`) VALUES
('1', 'Formentera', 'form', 'form'),
('2', 'Eivissa', 'eivi', 'ibiz'),
('3', 'Sant Antoni Portmany', 'sapr', 'ibiz'),
('4', 'Sant Josep Sa Talaia', 'sjst', 'ibiz'),
('5', 'Sant Joan Labritja', 'sjlb', 'ibiz'),
('6', 'Santa Eularia Riu', 'sedr', 'ibiz'),
('7', 'Alaro', 'alar', 'mall'),
('8', 'Alcudia', 'alcu', 'mall'),
('9', 'Algaida', 'alga', 'mall'),
('10', 'Andratx', 'andr', 'mall'),
('11', 'Ariany', 'aria', 'mall'),
('12', 'Arta', 'arta', 'mall'),
('13', 'Banyalbufar', 'bnya', 'mall'),
('14', 'Binissalem', 'bini', 'mall'),
('15', 'Buger', 'bugr', 'mall'),
('16', 'Bunyola', 'bnyo', 'mall'),
('17', 'Calvia', 'clvi', 'mall'),
('18', 'Campanet', 'cmpn', 'mall'),
('19', 'Campos', 'camp', 'mall'),
('20', 'Capdepera', 'cpdp', 'mall'),
('21', 'Consell', 'cnsl', 'mall'),
('22', 'Costitx', 'cstx', 'mall'),
('23', 'Deia', 'deia', 'mall'),
('24', 'Escorca', 'escr', 'mall'),
('25', 'Esporles', 'espr', 'mall'),
('26', 'Estellencs', 'estl', 'mall'),
('27', 'Felanitx', 'flni', 'mall'),
('28', 'Fornalutx', 'frnl', 'mall'),
('29', 'Inca', 'inca', 'mall'),
('30', 'Lloret Vistalegre', 'lldv', 'mall'),
('31', 'Lloseta', 'llst', 'mall'),
('32', 'Llubi', 'llbi', 'mall'),
('33', 'Llucmajor', 'llmj', 'mall'),
('34', 'Manacor', 'mncr', 'mall'),
('35', 'Mancor la Vall', 'mdlv', 'mall'),
('36', 'Maria la Salut', 'mdls', 'mall'),
('37', 'Marratxi', 'mrtx', 'mall'),
('38', 'Montuiri', 'mntr', 'mall'),
('39', 'Muro', 'muro', 'mall'),
('40', 'Palma', 'plma', 'mall'),
('41', 'Petra', 'ptra', 'mall'),
('42', 'Pollenca', 'pllc', 'mall'),
('43', 'Porreres', 'pres', 'mall'),
('44', 'Sa Pobla', 'spob', 'mall'),
('45', 'Puigpunyent', 'ppny', 'mall'),
('46', 'Ses Salines', 'ssal', 'mall'),
('47', 'Sant Joan', 'sjan', 'mall'),
('48', 'S. Llorenc Cardassar', 'sldc', 'mall'),
('49', 'Sencelles', 'scls', 'mall'),
('50', 'Santa Eugenia', 'segn', 'mall'),
('51', 'Santa Margalida', 'smrg', 'mall'),
('52', 'Santa Maria Cami', 'smdc', 'mall'),
('53', 'Santanyi', 'sntn', 'mall'),
('54', 'Selva', 'slva', 'mall'),
('55', 'Sineu', 'sneu', 'mall'),
('56', 'Soller', 'sllr', 'mall'),
('57', 'Son Servera', 'ssrv', 'mall'),
('58', 'Valldemossa', 'vdsa', 'mall'),
('59', 'Vilafranca Bonany', 'vdby', 'mall'),
('60', 'Alaior', 'alor', 'menr'),
('61', 'Ciutadella Menorca', 'cdmn', 'menr'),
('62', 'Ferreries', 'frrs', 'menr'),
('63', 'Maho', 'maho', 'menr'),
('64', 'Es Mercadal', 'emrc', 'menr'),
('65', 'Es Migjorn Gran', 'emjg', 'menr'),
('66', 'Sant Lluis', 'slls', 'menr'),
('67', 'Es Castell', 'ecst', 'menr');

CREATE TABLE IF NOT EXISTS `gch_especialidad` (
	`id` int(2) NOT NULL auto_increment,
		`espec` varchar(18) collate utf8_spanish2_ci NOT NULL,
		`refespec` varchar(4) collate utf8_spanish2_ci NOT NULL,
		PRIMARY KEY  (`id`),
		UNIQUE KEY `id` (`id`),
		UNIQUE KEY `espec` (`espec`),
		UNIQUE KEY `refespec` (`refespec`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gch_especialidad` (`id`, `espec`, `refespec`) VALUES
('1', 'Carta Clasica', 'clas'),
('2', 'Fusion', 'fusi'),
('3', 'Degustacion', 'degu'),
('4', 'Casera', 'case'),
('5', 'Pescados Mariscos', 'pesc'),
('6', 'Carnes Caza', 'carn'),
('7', 'Platos Convinados', 'conv'),
('8', 'Etnica', 'etni'),
('9', 'Otros', 'otrs');


CREATE TABLE IF NOT EXISTS `gch_islas` (
	`id` int(3) NOT NULL auto_increment,
		`isla` varchar(12) collate utf8_spanish2_ci NOT NULL,
		`refisla` varchar(4) collate utf8_spanish2_ci NOT NULL,
		PRIMARY KEY  (`id`),
		UNIQUE KEY `id` (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gch_islas` (`id`, `isla`, `refisla`) VALUES
('1', 'Mallorca', 'mall'),
('2', 'Menorca', 'menr'),
('3', 'Ibiza', 'ibiz'),
('4', 'Formentera', 'form');


CREATE TABLE IF NOT EXISTS `gch_opiniones` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `refart` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `refuser` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'anonymous',
  `refayto` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `refisla` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `opina` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `valora` int(4) NOT NULL,
  `precio` int(4) NOT NULL,
  `datein` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '00-00-00',
  `datemod` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '00-00-00',
  `modera` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'n',
	PRIMARY KEY  (`id`),
	UNIQUE KEY `id` (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `gch_opiniones` (`id`, `refart`, `refuser`, `refayto`, `refisla`, `opina`, `valora`, `precio`, `datein`, `datemod`, `modera`) VALUES
(1, '2020.06.16.13.18.15', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 01 2020.06.16.13.18.15 opinion 1a Juan Barros', 5, 3, '2020-06-20', '2020-06-23', 'y'),
(2, '2020.06.16.13.18.15', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 01 2020.06.16.13.18.15 opinion 2', 3, 2, '2020-06-20', '00-00-00', 'y'),
(3, '2020.06.16.13.18.15', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 01 2020.06.16.13.18.15 opinion 3', 4, 3, '2020-06-20', '00-00-00', 'y'),
(4, '2020.06.16.13.18.15', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 01 2020.06.16.13.18.15 opinion 4', 5, 1, '2020-06-20', '00-00-00', 'y'),
(5, '2020.06.16.13.18.15', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 01 2020.06.16.13.18.15 opinion 5', 4, 2, '2020-06-20', '00-00-00', 'y'),
(6, '2020.06.16.13.36.02', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 02 2020.06.16.13.36.02 opinion 1', 3, 3, '2020-06-20', '00-00-00', 'y'),
(7, '2020.06.16.13.36.02', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 02 2020.06.16.13.36.02 opinion 2', 2, 4, '2020-06-20', '00-00-00', 'y'),
(11, '2020.06.16.13.47.17', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 04 2020.06.16.13.47.17 opinion 1', 4, 1, '2020-06-20', '00-00-00', 'y'),
(12, '2020.06.16.13.47.17', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 04 2020.06.16.13.47.17 opinion 2', 3, 5, '2020-06-20', '00-00-00', 'y'),
(14, '2020.06.20.09.29.39', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE XESCA JOAN 2020.06.20.09.29.39 opinion 1', 3, 2, '2020-06-20', '00-00-00', 'y'),
(15, '2020.06.20.09.29.39', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE XESCA JOAN 2020.06.20.09.29.39 opinion 2', 2, 3, '2020-06-20', '00-00-00', 'y'),
(16, '2020.06.20.09.33.53', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE XESCA BARROS 2020.06.20.09.33.53 opinion 1', 4, 3, '2020-06-20', '00-00-00', 'y'),
(18, '2020.06.16.13.18.19', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 7 2020.06.16.13.18.19 OPINION 1 .....', 4, 2, '2020-06-20', '00-00-00', 'y'),
(19, '2020.06.20.09.33.53', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE XESCA BARROS 2020.06.20.09.33.53 opinion 2', 4, 4, '2020-06-20', '00-00-00', 'y'),
(20, '2020.06.20.09.33.53', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE XESCA BARROS 2020.06.20.09.33.53 opinion 3', 3, 2, '2020-06-20', '00-00-00', 'y'),
(21, '2020.06.20.09.33.53', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE XESCA BARROS 2020.06.20.09.33.53 opinion 4', 3, 4, '2020-06-20', '00-00-00', 'y'),
(22, '2020.06.16.13.18.18', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 06 2020.06.16.13.18.18 opinion 1', 1, 5, '2020-06-20', '00-00-00', 'y'),
(23, '2020.06.16.13.18.18', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 06 2020.06.16.13.18.18 opinion 2', 3, 2, '2020-06-20', '00-00-00', 'y'),
(24, '2020.06.16.13.44.27', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 03 2020.06.16.13.44.27 opinion 1', 4, 3, '2020-06-20', '00-00-00', 'y'),
(25, '2020.06.16.13.44.27', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 03 2020.06.16.13.44.27 opinion 2', 5, 2, '2020-06-20', '00-00-00', 'y'),
(26, '2020.06.16.13.44.27', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 03 2020.06.16.13.44.27 opinion 3 JUAN BARROS', 2, 2, '2020-06-20', '2020-06-23', 'y'),
(27, '2020.06.16.13.18.17', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 05 2020.06.16.13.18.17 opinion 1', 4, 1, '2020-06-20', '00-00-00', 'y'),
(28, '2020.06.16.13.18.17', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 05 2020.06.16.13.18.17 opinion 2', 3, 2, '2020-06-20', '00-00-00', 'y'),
(29, '2020.06.16.13.18.17', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 05 2020.06.16.13.18.17 opinion 3', 4, 2, '2020-06-20', '00-00-00', 'y'),
(30, '2020.06.16.13.18.17', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 05 2020.06.16.13.18.17 opinion 4', 3, 3, '2020-06-20', '00-00-00', 'y'),
(31, '2020.06.20.09.33.53', 'anonymous', 'plma', 'mall', 'RESTAURANTE XESCA BARROS 2020.06.20.09.33.53 opinion 5', 5, 3, '2020-06-22', '00-00-00', 'n'),
(33, '2020.06.16.13.18.15', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 01 2020.06.16.13.18.15 opinion 6', 3, 4, '2020-06-22', '00-00-00', 'y'),
(34, '2020.06.16.13.18.15', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 01 2020.06.16.13.18.15 opinion 7', 3, 3, '2020-06-22', '00-00-00', 'n'),
(36, '2020.06.20.09.33.53', 'jbp55555555k', 'plma', 'mall', 'RESTAURANTE XESCA BARROS opinion 6 y tal y tal, bla bla  bla bla bla bla bla bla', 3, 2, '2020-06-23', '00-00-00', 'y'),
(40, '2020.06.20.09.33.53', 'anonymous', 'plma', 'mall', 'RESTAURANTE XESCA BARROS 2020.06.20.09.33.53 opinion 5E', 5, 3, '2020-06-22', '00-00-00', 'y'),
(42, '2020.06.20.09.33.53', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE XESCA BARROS 2020.06.20.09.33.53 opinion 4b', 1, 4, '2020-06-20', '00-00-00', 'y'),
(43, '2020.06.16.13.18.15', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 01 2020.06.16.13.18.15 opinion 6b', 3, 3, '2020-06-22', '00-00-00', 'y'),
(45, '2020.06.16.13.18.15', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 01 2020.06.16.13.18.15 opinion 6d', 3, 3, '2020-06-22', '00-00-00', 'n'),
(46, '2020.06.16.13.18.15', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 01 2020.06.16.13.18.15 opinion 4b', 5, 2, '2020-06-20', '00-00-00', 'y'),
(50, '2020.06.16.13.18.15', 'anonymous', 'sedr', 'ibiz', 'RESTAURANTE 01 2020.06.16.13.18.15 opinion 4 JUAN BARROS PAZOS', 3, 3, '2020-06-20', '2020-06-23', 'y');


CREATE TABLE IF NOT EXISTS `gch_tipologia` (
	`id` int(2) NOT NULL auto_increment,
		`tipo` varchar(16) collate utf8_spanish2_ci NOT NULL,
		`reftipo` varchar(4) collate utf8_spanish2_ci NOT NULL,
		PRIMARY KEY  (`id`),
		UNIQUE KEY `id` (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gch_tipologia` (`id`, `tipo`, `reftipo`) VALUES
('1', 'Restaurante', 'rs01'),
('2', 'Restaurante 2T', 'rs02'),
('3', 'Restaurante 3T', 'rs03'),
('4', 'Bar Cafeteria', 'cafb'),
('5', 'Parrillada', 'parr'),
('6', 'Burger', 'burg'),
('7', 'Otros', 'otrs');


CREATE TABLE `gch_ipcontrol` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `ref` varchar(20) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'anonimo',
  `nivel` varchar(8) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'anonimo',
  `ipn` varchar(22) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'lost',
  `error` varchar(4) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1',
  `acceso` varchar(4) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `date` varchar(12) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0000/00/00',
  `time` varchar(10) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '00:00:00',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `gch_visitasadmin` (
  `idv` int(2) NOT NULL,
  `visita` int(10) NOT NULL,
  `admin` int(10) NOT NULL,
  `deneg` int(10) NOT NULL,
  `acceso` int(10) NOT NULL,
  PRIMARY KEY (`idv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gch_visitasadmin` (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES
	(69, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;