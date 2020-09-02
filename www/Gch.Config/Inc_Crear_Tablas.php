<?php

	/************** CREAMOS LA TABLA ADMIN ***************/

	$admin = "CREATE TABLE IF NOT EXISTS `$db_name`.`gch_admin` (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'close',
  `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Password` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1`varchar(9) NOT NULL default '0',
  `Tlf2`varchar(9) NOT NULL default '0',
  `lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db , $admin)){
					global $table1;
					$table1 = "\t* OK TABLA ADMIN.".PHP_EOL;
				} else {
					global $table1;
					$table1 = "\t* NO OK TABLA ADMIN. ".mysqli_error($db).PHP_EOL;
					
					}

	/************** CREAMOS LA TABLA USER ***************/

	$user = "CREATE TABLE IF NOT EXISTS `$db_name`.`gch_user` (
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
	  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
			  
		  if(mysqli_query($db , $user)){
						  global $table1b;
						  $table1b = "\t* OK TABLA USER.".PHP_EOL;
					  } else {
						  global $table1b;
						  $table1b = "\t* NO OK TABLA USER. ".mysqli_error($db).PHP_EOL;
						  
						  }
	  
		  /************** CREAMOS LA TABLA RESTAURANTES ***************/

	$art = "gch_art";
	$art = "`".$art."`";
	
	$tg = "CREATE TABLE IF NOT EXISTS `$db_name`.$art (
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
  `myvdo` varchar(30) collate utf8_spanish2_ci DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $tg)){
					global $table2;
					$table2 = "\t* OK TABLA ".$art."\n";
				} else {
					print( "* NO OK TABLA ".$art.". ".mysqli_error($db)."\n");
					global $table2;
					$table2 = "\t* NO OK TABLA ".$art.". ".mysqli_error($db)."\n";
				}

	/************** CREAMOS LA TABLA NEWS ***************/

	$news = "gch_news";
	$newss = "`".$news."`";
	
	$tnw = "CREATE TABLE IF NOT EXISTS `$db_name`.$news (
  `id` int(6) NOT NULL auto_increment,
  `refuser` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `refnews` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `tit` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `titsub` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `datein` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `timein` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `datemod` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `timemod` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `conte` text(402) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myvdo` varchar(30) collate utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `refnews` (`refnews`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $tnw)){
					global $nw;
					$nw = "\t* OK TABLA ".$news."\n";
				} else {
					print( "* NO OK TABLA ".$news.". ".mysqli_error($db)."\n");
					global $nw;
					$nw = "\t* NO OK TABLA ".$news.". ".mysqli_error($db)."\n";
				}

	/************* CREAMOS LA TABLA ISLAS / PROVINCIAS ****************/

	$islas = "CREATE TABLE IF NOT EXISTS `$db_name`.`gch_islas` (
  `id` int(3) NOT NULL auto_increment,
  `isla` varchar(12) collate utf8_spanish2_ci NOT NULL,
  `refisla` varchar(4) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $islas)){
		global $table4;
		$table4 = "\t* OK TABLA ISLAS.".PHP_EOL;

	$vi = "INSERT INTO `$db_name`.`gch_islas` (`id`, `isla`, `refisla`) VALUES
	(1, 'Mallorca', 'mall'),
	(2, 'Menorca', 'menr'),
	(3, 'Ibiza', 'ibiz'),
	(4, 'Formentera', 'form')";
		if(mysqli_query($db, $vi)){
						global $table5;
						$table5 = "\t* OK INIT VALUES EN ISLAS.".PHP_EOL;
		} else { global $table5;
				 $table5 = "\t* NO OK INIT VALUES EN ISLAS. ".mysqli_error($db).PHP_EOL;
						}

	} else {global $table4;
			$table4 = "\t* NO OK TABLA ISLAS. ".mysqli_error($db).PHP_EOL;
			global $table5;
			$table5 = "\t* NO OK INIT VALUES EN TABLA ISLAS. ".mysqli_error($db).PHP_EOL;
			}

	/************* CREAMOS LA TABLA AYUNTAMIENTOS ****************/

	$aytos = "CREATE TABLE IF NOT EXISTS `$db_name`.`gch_aytos` (
  `id` int(3) NOT NULL auto_increment,
  `ayto` varchar(26) collate utf8_spanish2_ci NOT NULL,
  `refayto` varchar(4) collate utf8_spanish2_ci NOT NULL,
  `refisla` varchar(4) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $aytos)){
		global $table6;
		$table6 = "\t* OK TABLA AYUNTAMIENTOS.".PHP_EOL;

	$vay = "INSERT INTO `$db_name`.`gch_aytos` (`id`, `ayto`, `refayto`, `refisla`) VALUES
	(1, 'Formentera', 'form', 'form'),
	(2, 'Eivissa', 'eivi', 'ibiz'),
	(3, 'Sant Antoni Portmany', 'sapr', 'ibiz'),
	(4, 'Sant Josep Sa Talaia', 'sjst', 'ibiz'),
	(5, 'Sant Joan Labritja', 'sjlb', 'ibiz'),
	(6, 'Santa Eularia Riu', 'sedr', 'ibiz'),
	(7, 'Alaro', 'alar', 'mall'),
	(8, 'Alcudia', 'alcu', 'mall'),
	(9, 'Algaida', 'alga', 'mall'),
	(10, 'Andratx', 'andr', 'mall'),
	(11, 'Ariany', 'aria', 'mall'),
	(12, 'Arta', 'arta', 'mall'),
	(13, 'Banyalbufar', 'bnya', 'mall'),
	(14, 'Binissalem', 'bini', 'mall'),
	(15, 'Buger', 'bugr', 'mall'),
	(16, 'Bunyola', 'bnyo', 'mall'),
	(17, 'Calvia', 'clvi', 'mall'),
	(18, 'Campanet', 'cmpn', 'mall'),
	(19, 'Campos', 'camp', 'mall'),
	(20, 'Capdepera', 'cpdp', 'mall'),
	(21, 'Consell', 'cnsl', 'mall'),
	(22, 'Costitx', 'cstx', 'mall'),
	(23, 'Deia', 'deia', 'mall'),
	(24, 'Escorca', 'escr', 'mall'),
	(25, 'Esporles', 'espr', 'mall'),
	(26, 'Estellencs', 'estl', 'mall'),
	(27, 'Felanitx', 'flni', 'mall'),
	(28, 'Fornalutx', 'frnl', 'mall'),
	(29, 'Inca', 'inca', 'mall'),
	(30, 'Lloret Vistalegre', 'lldv', 'mall'),
	(31, 'Lloseta', 'llst', 'mall'),
	(32, 'Llubi', 'llbi', 'mall'),
	(33, 'Llucmajor', 'llmj', 'mall'),
	(34, 'Manacor', 'mncr', 'mall'),
	(35, 'Mancor la Vall', 'mdlv', 'mall'),
	(36, 'Maria la Salut', 'mdls', 'mall'),
	(37, 'Marratxi', 'mrtx', 'mall'),
	(38, 'Montuiri', 'mntr', 'mall'),
	(39, 'Muro', 'muro', 'mall'),
	(40, 'Palma', 'plma', 'mall'),
	(41, 'Petra', 'ptra', 'mall'),
	(42, 'Pollenca', 'pllc', 'mall'),
	(43, 'Porreres', 'pres', 'mall'),
	(44, 'Sa Pobla', 'spob', 'mall'),
	(45, 'Puigpunyent', 'ppny', 'mall'),
	(46, 'Ses Salines', 'ssal', 'mall'),
	(47, 'Sant Joan', 'sjan', 'mall'),
	(48, 'S. Llorenc Cardassar', 'sldc', 'mall'),
	(49, 'Sencelles', 'scls', 'mall'),
	(50, 'Santa Eugenia', 'segn', 'mall'),
	(51, 'Santa Margalida', 'smrg', 'mall'),
	(52, 'Santa Maria Cami', 'smdc', 'mall'),
	(53, 'Santanyi', 'sntn', 'mall'),
	(54, 'Selva', 'slva', 'mall'),
	(55, 'Sineu', 'sneu', 'mall'),
	(56, 'Soller', 'sllr', 'mall'),
	(57, 'Son Servera', 'ssrv', 'mall'),
	(58, 'Valldemossa', 'vdsa', 'mall'),
	(59, 'Vilafranca Bonany', 'vdby', 'mall'),
	(60, 'Alaior', 'alor', 'menr'),
	(61, 'Ciutadella Menorca', 'cdmn', 'menr'),
	(62, 'Ferreries', 'frrs', 'menr'),
	(63, 'Maho', 'maho', 'menr'),
	(64, 'Es Mercadal', 'emrc', 'menr'),
	(65, 'Es Migjorn Gran', 'emjg', 'menr'),
	(66, 'Sant Lluis', 'slls', 'menr'),
	(67, 'Es Castell', 'ecst', 'menr')";
		if(mysqli_query($db, $vay)){
						global $table7;
						$table7 = "\t* OK INIT VALUES EN AYUNTAMIENTOS.".PHP_EOL;
		} else { global $table7;
				 $table7 = "\t* NO OK INIT VALUES EN AYUNTAMIENTOS. ".mysqli_error($db).PHP_EOL;
						}

	} else {global $table6;
			$table6 = "\t* NO OK TABLA AYUNTAMIENTOS. ".mysqli_error($db).PHP_EOL;
			global $table7;
			$table7 = "\t* NO OK INIT VALUES EN TABLA AYUNTAMIENTOS. ".mysqli_error($db).PHP_EOL;
			}

	/************* CREAMOS LA TABLA TIPOLOGIA ****************/

	$tipologia = "CREATE TABLE IF NOT EXISTS `$db_name`.`gch_tipologia` (
  `id` int(2) NOT NULL auto_increment,
  `tipo` varchar(16) collate utf8_spanish2_ci NOT NULL,
  `reftipo` varchar(4) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $tipologia)){
		global $table8;
		$table8 = "\t* OK TABLA TIPOLOGIA.".PHP_EOL;

	$vi2 = "INSERT INTO `$db_name`.`gch_tipologia` (`id`, `tipo`, `reftipo`) VALUES
	(1, 'Restaurante', 'rs01'),
	(2, 'Restaurante 2T', 'rs02'),
	(3, 'Restaurante 3T', 'rs03'),
	(4, 'Bar Cafeteria', 'cafb'),
	(5, 'Parrillada', 'parr'),
	(6, 'Burger', 'burg'),
	(7, 'Otros', 'otrs')";
		if(mysqli_query($db, $vi2)){
						global $table9;
						$table9 = "\t* OK INIT VALUES EN TIPOLOGIA.".PHP_EOL;
		} else { global $table9;
				 $table9 = "\t* NO OK INIT VALUES EN TIPOLOGIA. ".mysqli_error($db).PHP_EOL;
						}

	} else {global $table8;
			$table8 = "\t* NO OK TABLA TIPOLOGIA. ".mysqli_error($db).PHP_EOL;
			global $table9;
			$table9 = "\t* NO OK INIT VALUES EN TABLA TIPOLOGIA. ".mysqli_error($db).PHP_EOL;
			}

	/************* CREAMOS LA TABLA ESPECIALIDAD ****************/

	$especialidad = "CREATE TABLE IF NOT EXISTS `$db_name`.`gch_especialidad` (
  `id` int(2) NOT NULL auto_increment,
  `espec` varchar(18) collate utf8_spanish2_ci NOT NULL,
  `refespec` varchar(4) collate utf8_spanish2_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `espec` (`espec`),
  UNIQUE KEY `refespec` (`refespec`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $especialidad)){
		global $table10;
		$table10 = "\t* OK TABLA ESPECIALIDAD.".PHP_EOL;

	$vi3 = "INSERT INTO `$db_name`.`gch_especialidad` (`id`, `espec`, `refespec`) VALUES
	(1, 'Carta Clasica', 'clas'),
	(2, 'Fusion', 'fusi'),
	(3, 'Degustacion', 'degu'),
	(4, 'Casera', 'case'),
	(5, 'Pescados Mariscos', 'pesc'),
	(6, 'Carnes Caza', 'carn'),
	(7, 'Platos Convinados', 'conv'),
	(8, 'Etnica', 'etni'),
	(9, 'Otros', 'otrs')";
		if(mysqli_query($db, $vi3)){
						global $table11;
						$table11 = "\t* OK INIT VALUES EN ESPECIALIDAD.".PHP_EOL;
		} else { global $table11;
				 $table11 = "\t* NO OK INIT VALUES EN ESPECIALIDAD. ".mysqli_error($db).PHP_EOL;
						}

	} else {global $table10;
			$table10 = "\t* NO OK TABLA ESPECIALIDAD. ".mysqli_error($db).PHP_EOL;
			global $table11;
			$table11 = "\t* NO OK INIT VALUES EN TABLA ESPECIALIDAD. ".mysqli_error($db).PHP_EOL;
			}

	/************* CREAMOS LA TABLA OPINIONES ****************/

	$opiniones = "CREATE TABLE IF NOT EXISTS `$db_name`.`gch_opiniones` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $opiniones)){
		global $table12;
		$table12 = "\t* OK TABLA ESPECIALIDAD.".PHP_EOL;
	} else {global $table12;
			$table12 = "\t* NO OK TABLA ESPECIALIDAD. ".mysqli_error($db).PHP_EOL;
			}

	/************* CREAMOS LA TABLA VISITAS ADMIN ****************/

	$visitas = "CREATE TABLE IF NOT EXISTS `$db_name`.`gch_visitasadmin` (
  `idv` int(2) NOT NULL,
  `visita` int(10) NOT NULL,
  `admin` int(10) NOT NULL,
  `deneg` int(10) NOT NULL,
  `acceso` int(10) NOT NULL,
  PRIMARY KEY  (`idv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
	if(mysqli_query($db, $visitas)){
		global $link;
		print ("<table align='center'>
							".$link."
				</table>");		

		global $table13;
		$table13 = "\t* OK TABLA VISITAS ADMIN.".PHP_EOL;

	$vd = "INSERT INTO `$db_name`.`gch_visitasadmin` (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES
	(69, 0, 0, 0, 0)";
		if(mysqli_query($db, $vd)){
						global $table14;
						$table14 = "\t* OK INIT VALUES EN VISITAS ADMIN.".PHP_EOL;
		} else { global $table14;
				 $table14 = "\t* NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
						}

	} else {global $table13;
			$table13 = "\t* NO OK TABLA VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
			global $table14;
			$table14 = "\t* NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
			}

	/************* CREAMOS LA TABLA IP CONTROL****************/

	$ipcontrol = "CREATE TABLE IF NOT EXISTS `$db_name`.`gch_ipcontrol` (
		`id` int(4) NOT NULL auto_increment,
		`ref` varchar(20) collate utf8_spanish2_ci NOT NULL default 'anonimo',
		`nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'anonimo',
		`ipn` varchar(22) collate utf8_spanish2_ci NOT NULL default 'lost',
		`error` varchar(4) collate utf8_spanish2_ci NOT NULL default '1',
		`acceso` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
		`date` varchar(12) collate utf8_spanish2_ci NOT NULL default '0000/00/00',
		`time` varchar(10) collate utf8_spanish2_ci NOT NULL default '00:00:00',
		UNIQUE KEY `id` (`id`)
	  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
			  
		  if(mysqli_query($db, $ipcontrol)){
						  global $table3;
						  $table3 = "\t* OK TABLA IP CONTROL. \n";
					  } else {
						  global $table3;
						  $table3 = "\t* NO OK TABLA IP CONTROL. ".mysqli_error($db)." \n";
						  }
	  
	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
		global $data0;
		global $cfone;
		$datein = date('Y-m-d/H:i:s');

		$logdate = date('Y_m_d');
		$logtext = $cfone.PHP_EOL;
		$logtext = $logtext.PHP_EOL."- CONFIG INIT ".$datein;
		$logtext = $logtext.PHP_EOL." * ".$db_name;
		$logtext = $logtext.PHP_EOL." * ".$db_host;
		$logtext = $logtext.PHP_EOL." * ".$db_user;
		$logtext = $logtext.PHP_EOL." * ".$db_pass;
		$logtext = $logtext.PHP_EOL.$dbconecterror;
		$logtext = $logtext.PHP_EOL.$data0.$table1.$table1b.$table2.$table3.$table4.$table5.$table6.$table7.$table8.$table9.$table10.$table11.$table12.$table13.$table14.PHP_EOL;

?>