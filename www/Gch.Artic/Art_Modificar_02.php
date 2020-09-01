<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_01b.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){ 

					master_index();

							if (isset($_POST['oculto2'])){
										show_form();
										//accion_Log();
									}
							elseif(isset($_POST['oculto'])){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
											//accion_Log();
											}
							} else {
										show_form();
								}
} else { require '../Gch.Inclu/table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $db;
	global $db_name;

	$errors = array();

		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['ayto'])) == 0){
		$errors [] = "AYUNTAMIENTO <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['titulo'])) == 0){
		$errors [] = "RESTAURANTE <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
	
	elseif (strlen(trim($_POST['titulo'])) < 6){
		$errors [] = "RESTAURANTE <font color='#FF0000'>Más de 5 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['titulo'])){
		$errors [] = "RESTAURANTE <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z,0-9\s]+$/',$_POST['titulo'])){
		$errors [] = "RESTAURANTE  <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}
	
	elseif((strlen(trim($_POST['titulo'])) != 0)||(strlen(trim($_POST['refart'])) != 0)){	
		$secc1 = "gch_art";
		$secc1 = "`".$secc1."`";
	$sqlc =  "SELECT * FROM `$db_name`.$secc1 WHERE `tit` = '$_POST[titulo]'";
		$qc = mysqli_query($db, $sqlc);
		$rowres = mysqli_fetch_assoc($qc);
		global $conutc;
		$countc = mysqli_num_rows($qc);
	if($countc > 0){
		if (@$_SESSION['modid'] == $rowres['id']){}
		else{$errors [] = "YA EXISTE ESTE RESTAURANTE".$_SESSION['modid']." / ".$rowres['id'];}
				}
		}

		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['subtitul'])) == 0){
		$errors [] = "SUBTITULO  <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
	
	elseif (strlen(trim($_POST['subtitul'])) < 5){
		$errors [] = "SUBTITULO  <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['subtitul'])){
		$errors [] = "SUBTITULO  <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z,0-9\s]+$/',$_POST['subtitul'])){
		$errors [] = "SUBTITULO  <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}
	
	elseif(strlen(trim($_POST['subtitul'])) != 0){	
			$secc1 = "gch_art";
			$secc1 = "`".$secc1."`";
			$sqlc =  "SELECT * FROM `$db_name`.$secc1 WHERE `titsub` = '$_POST[subtitul]'";
			$qc = mysqli_query($db, $sqlc);
			$rowsqc = mysqli_fetch_assoc($qc);
			global $conutc;
			$countc = mysqli_num_rows($qc);
			if (@$_SESSION['modid'] == $rowsqc['id']){}
			elseif($countc > 0){
			$errors [] = "YA EXISTE ESTE SUBTITULO";
				}
		}

		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['autor'])) == 0){
		$errors [] = "AUTOR <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['url'])) == 0){
		$errors [] = "URL PAGINA WEB <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif (strlen(trim($_POST['url'])) < 10){
		$errors [] = "URL PAGINA WEB  <font color='#FF0000'>Más de 10 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$<>´"·,\[\]\{\}\*]+$/',$_POST['url'])){
		$errors [] = "URL PAGINA WEB <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	if(strlen(trim($_POST['map'])) == 0){
		$errors [] = "URL MAPA WEB <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif (strlen(trim($_POST['map'])) < 10){
		$errors [] = "URL MAPA WEB  <font color='#FF0000'>Más de 10 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$<>´"·,\[\]\{\}\*]+$/',$_POST['map'])){
		$errors [] = "URL MAPA WEB <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	if(strlen(trim($_POST['mapiframe'])) == 0){
		$errors [] = "URL MAPIFRAME <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif (strlen(trim($_POST['mapiframe'])) < 10){
		$errors [] = "URL MAPIFRAME  <font color='#FF0000'>Más de 10 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$<>´"·,\[\]\{\}\*]+$/',$_POST['mapiframe'])){
		$errors [] = "URL MAPIFRAME <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	if(strlen(trim($_POST['latitud'])) == 0){
		$errors [] = "LATITUD <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif (strlen(trim($_POST['latitud'])) < 6){
		$errors [] = "LATITUD  <font color='#FF0000'>Más de 5 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};:\*\']+$/',$_POST['latitud'])){
		$errors [] = "LATITUD <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[.0-9]+$/',$_POST['latitud'])){
		$errors [] = "LATITUD  <font color='#FF0000'>Sólo números o ,</font>";
		}

	if(strlen(trim($_POST['longitud'])) == 0){
		$errors [] = "LONGITUD <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif (strlen(trim($_POST['longitud'])) < 6){
		$errors [] = "LONGITUD  <font color='#FF0000'>Más de 5 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};:\*\']+$/',$_POST['longitud'])){
		$errors [] = "LONGITUD <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[.0-9]+$/',$_POST['longitud'])){
		$errors [] = "LONGITUD  <font color='#FF0000'>Sólo números o ,</font>";
		}

		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['calle'])) == 0){
		$errors [] = "CALLE <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
		
	elseif (strlen(trim($_POST['calle'])) < 6){
		$errors [] = "CALLE <font color='#FF0000'>Más de 5 carácteres.</font>";
		}
			
	elseif (!preg_match('/^[^@#$&%<>"·\(\)=¿?!¡\[\]\{\};\*]+$/',$_POST['calle'])){
		$errors [] = "CALLE <font color='#FF0000'>Caracteres no válidos.</font>";
		}

		///////////////////////////////////////////////////////////////////////////////////

	/* Validamos el campo mail. */
	
	global $sqlml;
	global $qml;

	$sqlml =  "SELECT * FROM `$db_name`.`gch_art` WHERE `gch_art`.`Email` = '$_POST[Email]'";
	$qml = mysqli_query($db, $sqlml);
	$rowml = mysqli_fetch_assoc($qml);

	if (@$_SESSION['modid'] == $rowml['id']){}
	elseif(mysqli_num_rows($qml)!= 0){
		$errors [] = "MAIL <font color='#FF0000'>Ya Existe.</font>";
		}
		
	if(strlen(trim($_POST['Email'])) == 0){
		$errors [] = "MAIL <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['Email'])) < 5 ){
		$errors [] = "MAIL <font color='#FF0000'>Escriba más de cinco carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^A-Z]+$/',$_POST['Email'])){
		$errors [] = "MAIL <font color='#FF0000'>Solo Minusculas</font>";
		}

	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/',$_POST['Email'])){
		$errors [] = "MAIL <font color='#FF0000'>Esta dirección no es válida.</font>";
		}

		///////////////////////////////////////////////////////////////////////////////////

	/* Validamos el campo Tlf1 */
	
	$sqltlf1 =  "SELECT * FROM `$db_name`.`gch_art` WHERE `gch_art`.`Tlf1` = '$_POST[Tlf1]' OR `gch_art`.`Tlf2` = '$_POST[Tlf1]' ";
	$qtlf1 = mysqli_query($db, $sqltlf1);
	$rowtlf1 = mysqli_fetch_assoc($qtlf1);
	$countlf1 = mysqli_num_rows($qtlf1);

	if (@$_SESSION['modid'] == $rowtlf1['id']){}
	elseif($countlf1 != 0){
		$errors [] = "TELEFONO 1: <font color='#FF0000'>YA EXISTE.</font>";
		}

	if(strlen(trim($_POST['Tlf1'])) == 0){
		$errors [] = "TELEFONO 1: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif ((trim($_POST['Tlf1'])) == (trim($_POST['Tlf2']))){
		$errors [] = "TELEFONO 1 y 2: <font color='#FF0000'>SON IGUALES</font>";
		}

	elseif (!preg_match('/^[\d]+$/',$_POST['Tlf1'])){
		$errors [] = "TELEFONO 1: <font color='#FF0000'>Sólo se admiten números.</font>";
		}

	elseif (strlen(trim($_POST['Tlf1'])) < 9){
		$errors [] = "TELEFONO 1: <font color='#FF0000'>No menos de nueve números</font>";
		}

	if(strlen(trim($_POST['Tlf2'])) > 0){
	$sqltlf2 =  "SELECT * FROM `$db_name`.`gch_art` WHERE `gch_art`.`Tlf1` = '$_POST[Tlf2]' OR `gch_art`.`Tlf2` = '$_POST[Tlf2]' ";
	$qtlf2 = mysqli_query($db, $sqltlf2);
	$rowtlf2 = mysqli_fetch_assoc($qtlf2);
	$countlf2 = mysqli_num_rows($qtlf2);

	if (!preg_match('/^[\d]+$/',$_POST['Tlf2'])){
			$errors [] = "TELEFONO 2: <font color='#FF0000'>Sólo se admiten números.</font>";
			}
	elseif (@$_SESSION['modid'] == $rowtlf2['id']){}
	elseif($countlf2 != 0){
			$errors [] = "TELEFONO 2: <font color='#FF0000'>YA EXISTE.</font>";
			}
		}
	
		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['tipo'])) == 0){
		$errors [] = "CATEGORIA <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['espec1'])) == 0){
		$errors [] = "ESPECIALIDAD 1 Y 2 <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif(strlen(trim($_POST['espec2'])) == 0){
		$errors [] = "ESPECIALIDAD 2 <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif ((trim($_POST['espec1'])) == (trim($_POST['espec2']))){
		$errors [] = "ESPECIALIDADES <font color='#FF0000'>SON IGUALES</font>";
		}
	
		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['coment'])) == 0){
		$errors [] = "DESCRIPCION <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif(strlen(trim($_POST['coment'])) <= 50){
		$errors [] = "DESCRIPCION <font color='#FF0000'>Mas de 50 carácteres.</font>";
		}

	elseif(strlen(trim($_POST['coment'])) >= 402){
		$errors [] = "DESCRIPCION <font color='#FF0000'>Excedió más de 400 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^#$&<>\(\)\[\]\{\}]+$/',$_POST['coment'])){
		$errors [] = "DESCRIPCION <font color='#FF0000'>No Permitidos #$&<>()[]{}</font>";
		}
		
	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;

	global $secc;	
	$secc = $_POST['autor'];
	$sqlx =  "SELECT * FROM `gch_admin` WHERE `ref` = '$_POST[autor]'";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	global $_sec;
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];
	//echo $rowautor['Nombre']." ".$rowautor['Apellidos']."</br>";
	
	global $carpetaimg;
	$carpetaimg = "../Gch.Img.Art";

	require 'Inclu_Name_Ref_to_Name.php';

	/* GRABAMOS LOS DATOS EN LA TABLA DE RESTAURANTES */
	global $tablename;
	$tablename = "gch_art";
	$tablename = "`".$tablename."`";
	$sqla = "UPDATE `$db_name`.$tablename SET `refuser` = '$_POST[autor]', `tit` = '$_POST[titulo]', `titsub` = '$_POST[subtitul]', `datemod` = '$_POST[datemod]', `timemod` = '$_POST[timemod]', `conte` = '$_POST[coment]', `refayto` = '$_POST[ayto]', `refisla` = '$_POST[isla]', `reftipo` = '$_POST[tipo]', `refespec1` = '$_POST[espec1]', `refespec2` = '$_POST[espec2]', `url` = '$_POST[url]', `map` = '$_POST[map]', `mapiframe` = '$_POST[mapiframe]', `latitud` = '$_POST[latitud]', `longitud` = '$_POST[longitud]', `calle` = '$_POST[calle]', `Email` = '$_POST[Email]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$_POST[Tlf2]' WHERE $tablename.`refart` = '$_SESSION[refart]' LIMIT 1 ";
	if(mysqli_query($db, $sqla)){

		global $carpetaimg;

		print("<table align='center' style='margin-top:10px'>
			<tr>
				<th colspan=3 class='BorderInf'>
					CREADO POR ".strtoupper($_sec)."
				</th>
			</tr>
												
			<tr>
				<td width=120px>
					REFERENCIA
				</td>
				<td width=100px>"
					.$_POST['refart'].
				"</td>
				<td rowspan='5' align='center' width='120px'>
			<img src='".$carpetaimg."/".$_SESSION['myimg']."' width='98% height='auto' />
				</td>
			</tr>
				
			<tr>
				<td>TITULO</td>
				<td>".$_POST['titulo']."</td>
			</tr>				
				
			<tr>
				<td>SUBTITULO</td>
				<td>".$_POST['subtitul']."</td>
			</tr>
				
			<tr>
				<td>DATE IN</td>
				<td>".$_POST['datein']."</td>
			</tr>
				
			<tr>
				<td>TIME IN</td>
				<td>".$_POST['timein']."</td>
			</tr>
				
			<tr>
				<td>ISLA</td>
				<td colspan=2>".$_POST['isla']." / ".$islaname."</td>
			</tr>
				
			<tr>
				<td>AYUNTAMIENTO</td>
				<td colspan=2>".$_POST['ayto']." / ".$aytoname."</td>
			</tr>
				
			<tr>
				<td>TIPO</td>
				<td colspan=2>".$_POST['tipo']." / ".$tipname."</td>
			</tr>
				
			<tr>
				<td>ESPECIALIDAD 1</td>
				<td colspan=2>".$_POST['espec1']." / ".$espec1name."</td>
			</tr>
				
			<tr>
				<td>ESPECIALIDAD 2</td>
				<td colspan=2>".$_POST['espec2']." / ".$espec2name."</td>
			</tr>
				
			<tr>
				<td>URL WEB</td>
				<td colspan=2>".$_POST['url']."</td>
			</tr>
				
			<tr>
				<td>CALLE</td>
				<td colspan=2>".$_POST['calle']."</td>
			</tr>
				
			<tr>
				<td>EMAIL</td>
				<td colspan=2>".$_POST['Email']."</td>
			</tr>
				
			<tr>
				<td>TELEFONO 1</td>
				<td colspan=2>".$_POST['Tlf1']."</td>
			</tr>
				
			<tr>
				<td>TELEFONO 2</td>
				<td colspan=2>".$_POST['Tlf2']."</td>
			</tr>
				
			<tr>
				<td colspan=3  align='center'>DESCRIPCION</td>
			</tr>
			<tr>
				<td colspan=3>".$_POST['coment']."</td>
			</tr>
			<tr>
				<th colspan=3 class='BorderSup'>
					<a href=Art_Modificar_01.php>MODIFICAR UN NUEVO RESTAURANTE</a>
				</th>
			</tr>
		</table>");
			
	} 	else {print("* MODIFIQUE LA ENTRADA L.152: ".mysqli_error($db));
						show_form ();
						//global $texerror;
						//$texerror = "\n\t ".mysqli_error($db);
					}
		
	}	/* FINAL process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if(isset($_POST['oculto2'])){
		//$defaults = $_POST;
		
		$_SESSION['modid'] = $_POST['id'];
		$_SESSION['refuser'] = $_POST['refuser'];
		$_SESSION['refart'] = $_POST['refart'];
		$_SESSION['tit'] = $_POST['tit'];
		$_SESSION['titsub'] = $_POST['titsub'];
		$_SESSION['datein'] = $_POST['datein'];
		$_SESSION['timein'] = $_POST['datein'];
		$_SESSION['datemod'] = date('Y-m-d');
		$_SESSION['timemod'] = date('H:i:s');

		$_SESSION['isla'] = $_POST['isla'];
		$_SESSION['ayto'] = $_POST['ayto'];

		$_SESSION['conte'] = $_POST['conte'];
		$_SESSION['myimg'] = $_POST['myimg1'];

		$_SESSION['tipo'] = $_POST['tipo'];
		$_SESSION['espec1'] = $_POST['espec1'];
		$_SESSION['espec2'] = $_POST['espec2'];
		$_SESSION['valora'] = $_POST['valora'];
		$_SESSION['precio'] = $_POST['precio'];
		$_SESSION['url'] = $_POST['url'];
		$_SESSION['map'] = $_POST['map'];
		$_SESSION['mapiframe'] = $_POST['mapiframe'];
		$_SESSION['latitud'] = $_POST['latitud'];
		$_SESSION['longitud'] = $_POST['longitud'];
		$_SESSION['calle'] = $_POST['calle'];
		$_SESSION['Email'] = $_POST['Email'];
		$_SESSION['Tlf1'] = $_POST['Tlf1'];
		$_SESSION['Tlf2'] = $_POST['Tlf2'];
		

		$defaults = array ( 'autor' => $_SESSION['refuser'],  // ref autor
							'refart' => $_SESSION['refart'], // Referencia articulo
							'titulo' => $_SESSION['tit'], // Titulo
							'subtitul' => $_SESSION['titsub'], // Sub Titulo
							'datein' => $_SESSION['datein'], // Sub Titulo
							'timein' => $_SESSION['timein'], // Sub Titulo
							'datemod' => $_SESSION['datemod'], // Sub Titulo
							'timemod' => $_SESSION['timemod'], // Sub Titulo
							'isla' => $_SESSION['isla'],  // refisla
							'ayto' => $_SESSION['ayto'],  // refayto
							'coment' => $_SESSION['conte'],
							'myimg' => $_SESSION['myimg'],	
							'tipo' => $_SESSION['tipo'],
							'espec1' => $_SESSION['espec1'],
							'espec2' => $_SESSION['espec2'],									
							'valora' => $_SESSION['valora'],
							'precio' => $_SESSION['precio'],
							'url' => $_SESSION['url'],
							'map' => $_SESSION['map'],
							'mapiframe' => $_SESSION['mapiframe'],
							'latitud' => $_SESSION['latitud'],
							'longitud' => $_SESSION['longitud'],
							'calle' => $_SESSION['calle'],
							'Email' => $_SESSION['Email'],
							'Tlf1' => $_SESSION['Tlf1'],
							'Tlf2' => $_SESSION['Tlf2']);

		} elseif(isset($_POST['oculto1'])){
				//$defaults = $_POST;
				//$_SESSION['refuser'] = $_POST['autor'];
				$_SESSION['isla'] = $_POST['isla'];
				$_SESSION['datemod'] = date('Y-m-d');
				$_SESSION['timemod'] = date('H:i:s');
				$defaults = array ( 'autor' => $_SESSION['refuser'],  // ref autor
									'titulo' => $_SESSION['tit'], // Titulo
									'subtitul' => $_SESSION['titsub'], // Sub Titulo
									'refart' => $_SESSION['refart'], // Referencia articulo
									'datein' => $_SESSION['datein'], // Sub Titulo
									'timein' => $_SESSION['timein'], // Sub Titulo
									'datemod' => $_SESSION['datemod'], // Sub Titulo
									'timemod' => $_SESSION['timemod'], // Sub Titulo
									'isla' => $_SESSION['isla'],  // refisla
									'ayto' => $_SESSION['ayto'],  // refayto
									'coment' => $_SESSION['conte'],
									'myimg' => $_SESSION['myimg'],	
									'tipo' => $_SESSION['tipo'],
									'espec1' => $_SESSION['espec1'],
									'espec2' => $_SESSION['espec2'],									
									'valora' => $_SESSION['valora'],
									'precio' => $_SESSION['precio'],
									'url' => $_SESSION['url'],
									'map' => $_SESSION['map'],
									'mapiframe' => $_SESSION['mapiframe'],
									'latitud' => $_SESSION['latitud'],
									'longitud' => $_SESSION['longitud'],
									'calle' => $_SESSION['calle'],
									'Email' => $_SESSION['Email'],
									'Tlf1' => $_SESSION['Tlf1'],
									'Tlf2' => $_SESSION['Tlf2']);	

		} 
	elseif(isset($_POST['oculto'])){
					$defaults = $_POST;
		} else {
				$defaults = array ( 'autor' => isset($_POST['autor']),  // ref autor
									'titulo' => '', // Titulo
								   	'subtitul' => '', // Sub Titulo
								   	//'refart' => @$_SESSION['refart'],  Referencia articulo
								   	'coment' => '',
									'myimg' => '',	
												);
										}
													   
	if ($errors){
		print("	<table align='center'>
					<th style='text-align:center'>
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					</th>
					<tr>
					<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
		}
		
	global $db;
	global $db_name;
	global $autor;
	$autor = $_SESSION['refuser'];
	/* CONSULTAMOS LA TABLA ADMIN = AUTORES */
	$sqlx =  "SELECT * FROM `gch_admin` WHERE `ref` = '$autor' ";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	global $_sec;
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];

	global $isla;
	$isla = @$_POST['isla'];

	/* CONSULTAMOS LA TABLA AYUNAMIENTOS = ISLA */
	$sqlis =  "SELECT * FROM `gch_islas` WHERE `refisla` = '$isla' ";
	$qis = mysqli_query($db, $sqlis);
	$rowisla = mysqli_fetch_assoc($qis);
	$_secis = @$rowisla['isla'];

	print(" <table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<th colspan='2'>
						MODIFIQUE RESTAURANTE PARA ISLA ".strtoupper($_secis)."
					</th>
				</tr>		
				<tr>
					<td align='right'>
						<input type='submit' value='SELECCIONE UNA ISLA' />
						<input type='hidden' name='oculto1' value=1 />
					</td>
					<td align='left'>

			<select name='isla'>
			<option value=''>ISLAS</option>");
						
	/* RECORREMOS LOS VALORES DE LA TABLA ISLAS PARA CONSTRUIR CON ELLOS UN SELECT */	
			
	global $db;
	$sqlb =  "SELECT * FROM `gch_islas` ORDER BY `isla` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['refisla']."' ");
					
					if($rows['refisla'] == $defaults['isla']){
															print ("selected = 'selected'");
																								}
									print ("> ".$rows['isla']."</option>");
				}
		
			}  

	print ("	</select>
					</td>
			</tr>
		</form>	
			</table>");
				
	if ((strlen(trim(@$_POST['isla'])) == 0) && (strlen(trim($_SESSION['refuser']))) == 0) { 
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
										HA DE SELECCIONAR UNA ISLA PARA MODIFICAR LA ENTRADA .
											</font>
										</td>
									</tr>
								</table>");
												}	

	elseif ((@$_POST['isla'] != '') || ($_SESSION['refuser'] != '')) { 
		
		print("
		<table align='center' style=\"margin-top:10px\">
			<tr>
				<th colspan=2 class='BorderInf'>

						MODIFICAR DATOS DE ".$_SESSION['tit']."
				</th>
			</tr>
			<tr>
			<td colspan=3 class='BorderInf' style=\"text-align:right\">
					<a href='Art_Modificar_01.php' >
											CANCELAR MODIFICAR
					</a>
			</td>
		</tr>
	
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
					
		<tr>								
					<td align='right' width=100px>
						REF ISLA
					</td>
					<td>
<input name='isla' type='hidden' value='".$defaults['isla']."' />".$defaults['isla']." / ".$_secis."
					</td>
		</tr>

			<tr>
				<td align='right'>
					AYUNTAMIENTO
				</td>
				<td align='left'>

	<select name='ayto'>
	<option value=''>AYUNTAMIENTOS</option>");
					
/* SELECT AYUNTAMIENTO */	
		
global $db;
$sqlayt =  "SELECT * FROM `gch_aytos` WHERE `refisla` = '$isla' ORDER BY `ayto` ASC ";
$qayt = mysqli_query($db, $sqlayt);
if(!$qayt){
		print("* ".mysqli_error($db)."</br>");
} else {
				
	while($rowsayt = mysqli_fetch_assoc($qayt)){
				
				print ("<option value='".$rowsayt['refayto']."' ");
				
				if($rowsayt['refayto'] == @$defaults['ayto']){
														print ("selected = 'selected'");
																							}
								print ("> ".$rowsayt['ayto']."</option>");
			}
	
		}  

print ("	</select>
				</td>
		</tr>
			<tr>

				<td align='right'>
					RESTAURANTE
				</td>
				<td>

	<input type='text' name='titulo' size=20 maxlength=20 value='".@$defaults['titulo']."' />

				</td>
			</tr>
								
			<tr>
				<td align='right'>						
					SUBTITULO
				</td>
				<td>
	<input type='text' name='subtitul' size=20 maxlength=20 value='".@$defaults['subtitul']."' />
				</td>
			</tr>
								
			<tr>
				<td align='right'>						
					PAGINA WEB
				</td>
				<td>
	<input type='text' name='url' size=40 maxlength=40 value='".@$defaults['url']."' />
				</td>
			</tr>

				<tr>
					<td align='right'>						
						MAPA WEB
					</td>
					<td>
		<input type='text' name='map' size=50 maxlength=49 value='".@$defaults['map']."' placeholder='MAP SHORT URL' />
					</td>
				</tr>

				<tr>
					<td align='right'>						
						MAPA IFRAME
					</td>
					<td>
		<input type='text' name='mapiframe' size=50 maxlength=340 value='".@$defaults['mapiframe']."' placeholder='MAP IFRAME URL' />
					</td>
				</tr>

				<tr>
					<td align='right'>						
						LATITUD
					</td>
					<td>
		<input type='text' name='latitud' size=18 maxlength=10 value='".@$defaults['latitud']."' placeholder='MAP LATITUD' />
					</td>
				</tr>

				<tr>
					<td align='right'>						
						LONGITUD
					</td>
					<td>
		<input type='text' name='longitud' size=18 maxlength=10 value='".@$defaults['longitud']."' placeholder='MAP LONGITUD' />
					</td>
				</tr>

			<tr>
				<td align='right'>						
					CALLE
				</td>
				<td>
	<input type='text' name='calle' size=40 maxlength=40 value='".@$defaults['calle']."' />
				</td>
			</tr>

			<tr>
				<td align='right'>
					Mail:
				</td>
				<td>
	<input type='text' name='Email' size=52 maxlength=50 value='".@$defaults['Email']."' />
				</td>
			</tr>	

			<tr>
				<td align='right'>
					Teléfono 1:
				</td>
				<td>
	<input type='text' name='Tlf1' size=12 maxlength=9 value='".@$defaults['Tlf1']."' />
				</td>
			</tr>
			
			<tr>
				<td align='right'>
					Teléfono 2:
				</td>
				<td>
	<input type='text' name='Tlf2' size=12 maxlength=9 value='".@$defaults['Tlf2']."' />
				</td>
			</tr>

			<tr>
				<td align='right'>
					CATEGORIA
				</td>
				<td align='left'>

	<select name='tipo'>
	<option value=''>CATEGORIAS ...</option>");
					
/* SELECT CATEGORIA DE LOCAL */	
		
global $db;
$sqltipo =  "SELECT * FROM `gch_tipologia` ORDER BY `tipo` ASC ";
$qtipo = mysqli_query($db, $sqltipo);
if(!$qtipo){
		print("* ".mysqli_error($db)."</br>");
} else {
				
	while($rowtipo = mysqli_fetch_assoc($qtipo)){
				
				print ("<option value='".$rowtipo['reftipo']."' ");
				
				if($rowtipo['reftipo'] == @$defaults['tipo']){
														print ("selected = 'selected'");
																							}
								print ("> ".$rowtipo['tipo']."</option>");
			}
		}  

print ("	</select>
				</td>
		</tr>

		<tr>
			<td align='right'>
					ESPECIALIDAD 1
			</td>
			<td align='left'>

	<select name='espec1'>
	<option value=''>ESPECIALIDADES...</option>");
					
/* SELECT ESPECIALIDAD 1 */	
		
global $db;
$sqlespec =  "SELECT * FROM `gch_especialidad` ORDER BY `espec` ASC ";
$qespec = mysqli_query($db, $sqlespec);
if(!$qespec){
		print("* ".mysqli_error($db)."</br>");
} else {
				
	while($rowespec1 = mysqli_fetch_assoc($qespec)){
				
				print ("<option value='".$rowespec1['refespec']."' ");
				
				if($rowespec1['refespec'] == @$defaults['espec1']){
														print ("selected = 'selected'");
																							}
								print ("> ".$rowespec1['espec']."</option>");
			}
		}  

print ("	</select>
				</td>
		</tr>

		<tr>
			<td align='right'>ESPECIALIDAD 2</td>
			<td align='left'>

	<select name='espec2'>
	<option value=''>ESPECIALIDADES ...</option>");
					
/* SELECT ESPECIALIDAD */	

global $db;
$sqlespec2 =  "SELECT * FROM `gch_especialidad` ORDER BY `espec` ASC ";
$qespec2 = mysqli_query($db, $sqlespec2);
if(!$qespec2){
		print("* ".mysqli_error($db)."</br>");
} else {
				
	while($rowespec2 = mysqli_fetch_assoc($qespec2)){
				
		print ("<option value='".$rowespec2['refespec']."' ");
				
		if($rowespec2['refespec'] == @$defaults['espec2']){
								print ("selected = 'selected'");
																}
								print ("> ".$rowespec2['espec']."</option>");
			}
		}  

print ("	</select>
				</td>
		</tr>

        <tr>
			<td align='right'>SERVICIOS</td>
			<td>".$_SESSION['valora']."</td>
		</tr>

		<tr>
			<td align='right'>PRECIOS</td>
			<td>".$_SESSION['precio']."</td>
		</tr>

        <tr>
			<td align='right'>						
					REFERENCIA
			</td>
			<td>
		<input type='hidden' name='refart' value='".$_SESSION['refart']."' />".$_SESSION['refart']."
			</td>
		</tr>
				<tr>
					<td align='right'>						
						DATE IN
					</td>
					<td>
		<input type='hidden' name='datein' value='".$_SESSION['datein']."' />".$_SESSION['datein']."
					</td>
				</tr>
				<tr>
					<td align='right'>						
						TIME IN
					</td>
					<td>
		<input type='hidden' name='timein' value='".$_SESSION['timein']."' />".$_SESSION['timein']."
					</td>
				</tr>
					
				<tr>
					<td align='right'>						
						DATE MOD
					</td>
					<td>
		<input type='hidden' name='datemod' value='".$defaults['datemod']."' />".$defaults['datemod']."
					</td>
				</tr>
				<tr>
					<td align='right'>						
						TIME MOD
					</td>
					<td>
		<input type='hidden' name='timemod' value='".$defaults['timemod']."' />".$defaults['timemod']."
					</td>
				</tr>
				
			<tr>
				<td align='right'>
					AUTOR
				</td>
				<td align='left'>

		<select name='autor'>
		<option value=''>POSIBLES AUTORES</option>");
					
/* SELECT AUTOR DE LA ENTRADA */	
		
global $db;
$sqlb =  "SELECT * FROM `gch_admin` ORDER BY `Apellidos` ASC ";
$qb = mysqli_query($db, $sqlb);
if(!$qb){
		print("* ".mysqli_error($db)."</br>");
} else {
				
	while($rows = mysqli_fetch_assoc($qb)){
				
				print ("<option value='".$rows['ref']."' ");
				
				if($rows['ref'] == @$defaults['autor']){
														print ("selected = 'selected'");
																							}
								print ("> ".$rows['Apellidos']." ".$rows['Nombre']."</option>");
			}
	
		}  

print ("	</select>
				</td>
		</tr>

			<tr>
				<td colspan=2 align='center'>
					DESCRIPCION DEL RESTAURANTE
				</td>
			</tr>
			<tr>
				<td colspan=2 align='center'>
<textarea cols='41' rows='9' onkeypress='return limitac(event, 400);' onkeyup='actualizaInfoc(400)' name='coment' id='coment'>".@$defaults['coment']."</textarea>

		</br>
			<div id='infoc' align='center' style='color:#0080C0;'>
						Maximum 400 characters            
			</div>

				</td>
			</tr>
							
			<tr>
				<td colspan='2' align='right' valign='middle'  class='BorderSup'>
					<input type='submit' value='MODIFICAR DATOS RESTAURANTE' />
					<input type='hidden' name='oculto' value=1 />
				</td>
			</tr>
			
	</form>														
		</table>				
					"); 
										}
	
			}	

/////////////////////////////////////////////////////////////////////////////////////////////////
/*
function accion_Log(){

	global $db;
	global $rowout;
	global $secc;
	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- PRODUCTO CREAR ".$ActionTime.". ".$secc.".\n\t Pro Name: ".$_POST['subtitul'].".\n\t Pro titulo: ".$_POST['titulo'].".\n\t Pro Ref: ".$_POST['ref'].".\n\t Coment: ".$_POST['coment'];

		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $logname."_".$logape;
		$logdate = date('Y_m_d');
		$logtext = $text."\n";
		$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}
*/
/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Gch.Inclu/Master_Index_Artic.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gch.Inclu/Admin_Inclu_02.php';

?>