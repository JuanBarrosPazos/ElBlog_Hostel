<?php

	global $db;
	global $db_name;
	global $valor;
	$valor = strtolower($_POST['tabla']);
	global $valort;
	$valort = "`".$valor."`";
	global $datein;
	$datein = date('Y.m.d_H.i.s');
//	$datein = date('Y.m.d');
	
//	print("* EXPORTADA TABLA: ".strtoupper($db_name." => ".$valor).".");

	global $id;
	global $campo;
	global $texc;
	global $c3;
	global $c4;
	global $numr;
				
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

		/* TABLAS DE LOS USUARIOS */

		global $tcuf;
		$tcuf = trim($_POST['tabla']);
		$ctuf = strtolower($tcuf);
		global $tcufs;
		$tcufs = trim($_SESSION['tablas']);
		$tcufs = strtolower($tcufs);

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// EXPORTA LA TABLA ADMIN DEL SISTEMA //

if (trim($_POST['tabla']) == "gch_admin" ){
$campo = 'id,ref,Nivel,Nombre,Apellidos,myimg,doc,dni,ldni,Email,Usuario,Password,Direccion,Tlf1,Tlf2,lastin,lastout,visitadmin';
$texc = '`id`, `ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`, `lastin`, `lastout`, `visitadmin`';
$id = "`id`";
$c3 = "\n\t`id` int(4) NOT NULL auto_increment,
\t`ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
\t`Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'amd',
\t`Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
\t`Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
\t`myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
\t`doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
\t`dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
\t`ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
\t`Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
\t`Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
\t`Password` varchar(10) collate utf8_spanish2_ci NOT NULL,
\t`Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
\t`Tlf1`varchar(9) NOT NULL default '0',
\t`Tlf2`varchar(9) NOT NULL default '0',
\t`lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
\t`lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
\t`visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
\tUNIQUE KEY `id` (`id`),
\tUNIQUE KEY `ref` (`ref`),
\tUNIQUE KEY `dni` (`dni`),
\tUNIQUE KEY `Email` (`Email`),
\tUNIQUE KEY `Usuario` (`Usuario`)";

	$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qc = mysqli_query($db, $sqlc);
	$numr = mysqli_num_rows($qc);

$c4 = "\n ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
		 		}	
				
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// EXPORTA LA TABLA USUARIOS REGISTRADOS //

if (trim($_POST['tabla']) == "gch_user" ){
	$campo = 'id,ref,Nivel,Nombre,Apellidos,myimg,Email,Usuario,Password,Direccion,Tlf1,lastin,lastout,visitadmin';
	$texc = '`id`, `ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `lastin`, `lastout`, `visitadmin`';
	$id = "`id`";
	$c3 = "\n\t`id` int(4) NOT NULL auto_increment,
	\t`ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
	\t`Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'amd',
	\t`Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
	\t`Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
	\t`myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
	\t`Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
	\t`Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
	\t`Password` varchar(10) collate utf8_spanish2_ci NOT NULL,
	\t`Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
	\t`Tlf1`varchar(9) NOT NULL default '0',
	\t`lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
	\t`lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
	\t`visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
	\tUNIQUE KEY `id` (`id`),
	\tUNIQUE KEY `ref` (`ref`),
	\tUNIQUE KEY `Email` (`Email`),
	\tUNIQUE KEY `Usuario` (`Usuario`)";
	
		$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
		$qc = mysqli_query($db, $sqlc);
		$numr = mysqli_num_rows($qc);
	
	$c4 = "\n ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
					 }	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// EXPORTA LA TABLA RESTAURANTES //

if (trim($_POST['tabla']) == "gch_art" ){
$campo = 'id,refuser,refart,tit,titsub,datein,timein,datemod,timemod,conte,myimg1,myimg2,myimg3,myimg4,myvdo,refayto,refisla,reftipo,refespec1,refespec2,iprecio,ivalora,url,map,mapiframe,latitud,longitud,calle,Email,Tlf1,Tlf2';
$texc = '`id`, `refuser`, `refart`, `tit`, `titsub`, `datein`, `timein`, `datemod`, `timemod`, `conte`, `myimg1`, `myimg2`, `myimg3`, `myimg4`, `myvdo`, `refayto`, `refisla`, `reftipo`, `refespec1`, `refespec2`, `iprecio`, `ivalora`, `url`, `map`, `mapiframe`, `latitud`, `longitud`, `calle`, `Email`, `Tlf1`, `Tlf2`';
		$id = "`id`";
$c3 = "\n\t`id` int(6) NOT NULL auto_increment,
\t`refuser` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
\t`refart` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
\t`tit` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
\t`titsub` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
\t`datein` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
\t`timein` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
\t`datemod` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
\t`timemod` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
\t`conte` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
\t`myimg1` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',
\t`myimg2` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',
\t`myimg3` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',
\t`myimg4` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',
\t`myvdo` varchar(30) collate utf8_spanish2_ci DEFAULT NULL,
\t`refayto` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
\t`refisla` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
\t`reftipo` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
\t`refespec1` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
\t`refespec2` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
\t`iprecio` int(4) NOT NULL DEFAULT '50',
\t`ivalora` int(4) NOT NULL DEFAULT '50',
\t`url` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'http://juanbarrospazos.blogspot.com.es/',
\t`map` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'https://goo.gl/maps/63M96me7YdBkhJLf7',
\t`mapiframe` varchar(340) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3075.5997770189756!2d2.6670561!3d39.568631!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x55bc574de040df4a!2sCIFP%20Francesc%20de%20Borja%20Moll!5e0!3m2!1ses!2ses!4v1593844861566!5m2!1ses!2ses',
\t`latitud` float(10,6) NOT NULL DEFAULT 39.569065,
\t`longitud` float(10,6) NOT NULL DEFAULT 2.667335,
\t`calle` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
\t`Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
\t`Tlf1` varchar(9) NOT NULL DEFAULT '0',
\t`Tlf2` varchar(9) NOT NULL DEFAULT '0',
\tPRIMARY KEY  (`id`),
\tUNIQUE KEY `id` (`id`),
\tUNIQUE KEY `refart` (`refart`)";
	$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qc = mysqli_query($db, $sqlc);
			while($rowc = mysqli_fetch_row($qc)){
				global $numr;
				$numr = ($rowc[0]+1);}
$c4 = "\nENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// EXPORTA LA TABLA NEWS //

if (trim($_POST['tabla']) == "gch_news" ){
	$campo = 'id,refuser,refnews,tit,titsub,datein,timein,datemod,timemod,conte,myimg,myvdo';
	$texc = '`id`, `refuser`, `refnews`, `tit`, `titsub`, `datein`, `timein`, `datemod`, `timemod`, `conte`, `myimg`, `myvdo`';
			$id = "`id`";
	$c3 = "\n\t`id` int(6) NOT NULL auto_increment,
	\t`refuser` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
	\t`refnews` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
	\t`tit` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
	\t`titsub` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
	\t`datein` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
	\t`timein` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
	\t`datemod` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
	\t`timemod` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
	\t`conte` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
	\t`myimg` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'untitled.png',
	\t`myvdo` varchar(30) collate utf8_spanish2_ci DEFAULT NULL,
	\tPRIMARY KEY  (`id`),
	\tUNIQUE KEY `id` (`id`),
	\tUNIQUE KEY `refnews` (`refnews`)";
		$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
		$qc = mysqli_query($db, $sqlc);
				while($rowc = mysqli_fetch_row($qc)){
					global $numr;
					$numr = ($rowc[0]+1);}
	$c4 = "\nENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// EXPORTA LA TABLA ISLAS / PROVINCIAS //

if (trim($_POST['tabla']) == "gch_islas" ){
	$campo = 'id,isla,refisla';
	$texc = '`id`, `isla`, `refisla`';
			$id = "`id`";
	$c3 = "\n\t`id` int(3) NOT NULL auto_increment,
	\t`isla` varchar(12) collate utf8_spanish2_ci NOT NULL,
	\t`refisla` varchar(4) collate utf8_spanish2_ci NOT NULL,
	\tPRIMARY KEY  (`id`),
	\tUNIQUE KEY `id` (`id`)";
		$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
		$qc = mysqli_query($db, $sqlc);
				while($rowc = mysqli_fetch_row($qc)){
					global $numr;
					$numr = ($rowc[0]+1);}
	$c4 = "\nENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// EXPORTA LA TABLA AYUNTAMIENTOS //

if (trim($_POST['tabla']) == "gch_aytos" ){
	$campo = 'id,ayto,refayto,refisla';
	$texc = '`id`, `ayto`, `refayto`, `refisla`';
			$id = "`id`";
	$c3 = "\n\t`id` int(3) NOT NULL auto_increment,
	\t`ayto` varchar(26) collate utf8_spanish2_ci NOT NULL,
	\t`refayto` varchar(4) collate utf8_spanish2_ci NOT NULL,
	\t`refisla` varchar(4) collate utf8_spanish2_ci NOT NULL,
	\tPRIMARY KEY  (`id`),
	\tUNIQUE KEY `id` (`id`)";
		$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
		$qc = mysqli_query($db, $sqlc);
				while($rowc = mysqli_fetch_row($qc)){
					global $numr;
					$numr = ($rowc[0]+1);}
	$c4 = "\nENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// EXPORTA LA TABLA TIPOLOGIAS DE LOCALES //

if (trim($_POST['tabla']) == "gch_tipologia" ){
	$campo = 'id,tipo,reftipo';
	$texc = '`id`, `tipo`, `reftipo`';
			$id = "`id`";
	$c3 = "\n\t`id` int(2) NOT NULL auto_increment,
	\t`tipo` varchar(16) collate utf8_spanish2_ci NOT NULL,
	\t`reftipo` varchar(4) collate utf8_spanish2_ci NOT NULL,
	\tPRIMARY KEY  (`id`),
	\tUNIQUE KEY `id` (`id`)";
		$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
		$qc = mysqli_query($db, $sqlc);
				while($rowc = mysqli_fetch_row($qc)){
					global $numr;
					$numr = ($rowc[0]+1);}
	$c4 = "\nENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// EXPORTA LA TABLA ESPECIALIDADES CULINARIAS DE LOS LOCALES //

if (trim($_POST['tabla']) == "gch_especialidad" ){
	$campo = 'id,espec,refespec';
	$texc = '`id`, `espec`, `refespec`';
			$id = "`id`";
	$c3 = "\n\t`id` int(2) NOT NULL auto_increment,
	\t`espec` varchar(18) collate utf8_spanish2_ci NOT NULL,
	\t`refespec` varchar(4) collate utf8_spanish2_ci NOT NULL,
	\tPRIMARY KEY  (`id`),
	\tUNIQUE KEY `id` (`id`),
	\tUNIQUE KEY `espec` (`espec`),
	\tUNIQUE KEY `refespec` (`refespec`)";
		$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
		$qc = mysqli_query($db, $sqlc);
				while($rowc = mysqli_fetch_row($qc)){
					global $numr;
					$numr = ($rowc[0]+1);}
	$c4 = "\nENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// EXPORTA LA TABLA OPINIONES //

if (trim($_POST['tabla']) == "gch_opiniones" ){
	$campo = 'id,refart,refuser,refayto,refisla,opina,valora,precio,datein,datemod,modera';
	$texc = '`id`, `refart`, `refuser`, `refayto`, `refisla`, `opina`, `valora`, `precio`, `datein`, `datemod`, `modera`';
			$id = "`id`";
	$c3 = "\n\t`id` int(4) NOT NULL auto_increment,
	\t`refart` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
	\t`refuser` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'anonymous',
	\t`refayto` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
	\t`refisla` varchar(4) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
	\t`opina` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
	\t`valora` int(4) NOT NULL,
	\t`precio` int(4) NOT NULL,
	\t`datein` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '00-00-00',
	\t`datemod` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT '00-00-00',
	\t`modera` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'n',
	\tPRIMARY KEY  (`id`),
	\tUNIQUE KEY `id` (`id`)";
		$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
		$qc = mysqli_query($db, $sqlc);
				while($rowc = mysqli_fetch_row($qc)){
					global $numr;
					$numr = ($rowc[0]+1);}
	$c4 = "\nENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
	}


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

global $filename;
$filename = "bbdd/TBL_".$valor."_DT_".$datein.".sql";
	//echo $valort;
	global $sqlb;
	global $qb;
	$sqlb =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qb = mysqli_query($db, $sqlb);
	global $numr;
	global $nentradas;
	$nentradas = mysqli_num_rows($qb);
	global $nrw;
	$nrw = mysqli_num_rows($qb);
	//$_SESSION['numr'] = $numr;
		if(!$qb){
	print("<font color='#FF0000'>214 Se ha producido un error: </form><br/>".mysqli_error($db)."<br/>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){
						print("
			<table align='center' style='border:1; margin-top:2px' width='auto'>
				
				<tr>
					<td align='center'>
							NO HAY DATOS EN ESTA TABLA.
					</td>
				</tr>
			</table>");	

		} else { 
			
			$campos = explode(',',$campo);
			$count = count($campos);
				
			print ("<table align='center' width='auto'>
						<tr>
							<th colspan=".$count." class='BorderInf'>
				UPDATE OK. || BBDD: ".strtoupper($db_name)." || TABLA: ".strtoupper($valor)."
							</th>
						</tr>
						<tr>");
						
			print("<td>* Nº Campos:".$count/*.".<br/>||  "*/);
				for($a=0; $c=$count, $a<$c; $a++){
				//print($campos[$a]." || ");
					}
				print("<br/>* Nº Entradas: ".$nentradas." &nbsp; * Nº Id. Max: ".($numr-1)."
				<br/>* Ruta Documento: ".$filename."</td>");
									
			for($a=0; $c=$count, $a<$c; $a++){
				//print(	"<td class='BorderInfDch'>".$campos[$a]."</td>");
					}
				print("</tr>");
									
//$_SESSION['ruta'] = $filename;
$fh = fopen($filename,'w+');
$c1 ='SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";';
$c2 ='SET time_zone = "+00:00";';
$linec = "\n-- Servidor: ".$_SERVER['SERVER_NAME'].
"\n-- Tiempo de generación: ".date('Y/m/d')." a las ".date('H:i:s').
"\n-- Versión del servidor: ".$_SERVER['SERVER_SOFTWARE'].
"\n\n".$c1."\n".$c2."\n
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
\n--\n-- Base de datos: `".$db_name."`\n--
\n-- --------------------------------------------------------
\n--\n-- Estructura de tabla para la tabla `".$valor."`\n--\n
CREATE TABLE IF NOT EXISTS `".$valor."` (".$c3.")".$c4.";
\n--\n-- Volcado de datos para la tabla `".$valor."`\n--\n";
		$line0 = "\nINSERT INTO `".$valor."` (";
		$line1 = ") VALUES";
		$line = $linec.$line0.$texc.$line1;
fwrite($fh, $line);
fclose($fh);

			while($rowb = mysqli_fetch_row($qb)){
				//$_SESSION['numr'] = ($rowb[0]+1);
$fh = fopen($filename,'ab+');
		$line0 = "\n(";
fwrite($fh, $line0);
fclose($fh);
				//print (	"<tr align='center'>");
					for($i=0; $c=$count, $i<$c; $i++){
				//	print(	"<td class='BorderInfDch'>".$rowb[$i]."</td>");
$fh = fopen($filename,'ab+');
		$line2 = "'".$rowb[$i]."', ";
fwrite($fh, $line2);
fclose($fh);
						 }
$fh = fopen($filename,'ab+');
		$line3 = "),";
fwrite($fh, $line3);
fclose($fh);
						//print("	</tr>")
						;}
						 
$fh = fopen($filename,'ab+');
		$line3 = ";\n
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
fwrite($fh, $line3);
fclose($fh);
				} 

print("</table>");
			
			} 

if($nrw == 0){}
else{
$line = file_get_contents($filename);
$line = str_replace(', ),','),',$line);
$line = str_replace('),;',');',$line);

$fh = fopen($filename,'w+');
fwrite($fh, $line);
@$tot[$d] = @$data[$d];
fclose($fh);
//print($_SESSION['numr']);

	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
		
/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>