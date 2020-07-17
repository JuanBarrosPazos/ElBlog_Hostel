<?php
session_start();

  	//require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_01b.php';

	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){

					master_index();

						if(isset($_POST['oculto'])){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
											//accion_Log();
											}
							} else {
										show_form();
								}
} else { require '../Gcb.Inclu/table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $db;
	global $db_name;
	global $sqld;
	global $qd;
	global $rowd;

	$errors = array();

/*
	if(strlen(trim($_POST['refart'])) != 0){	
			$secc1 = "gcb_art";
			$secc1 = "`".$secc1."`";
			$sqlc =  "SELECT * FROM `$db_name`.$secc1 WHERE `refart` = '$_POST[refart]'";
			$qc = mysqli_query($db, $sqlc);
			global $conutc;
			$countc = mysqli_num_rows($qc);
			if($countc > 0){
				$errors [] = "YA EXISTE EL RESTAURANTE.";
				}
		}
*/
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
		$secc1 = "gcb_art";
		$secc1 = "`".$secc1."`";
	$sqlc =  "SELECT * FROM `$db_name`.$secc1 WHERE `tit` = '$_POST[titulo]' OR `refart` = '$_POST[refart]'";
		$qc = mysqli_query($db, $sqlc);
		global $conutc;
		$countc = mysqli_num_rows($qc);
	if($countc > 0){
			$errors [] = "YA EXISTE ESTE RESTAURANTE";
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
			$secc1 = "gcb_art";
			$secc1 = "`".$secc1."`";
			$sqlc =  "SELECT * FROM `$db_name`.$secc1 WHERE `titsub` = '$_POST[subtitul]'";
			$qc = mysqli_query($db, $sqlc);
			global $conutc;
			$countc = mysqli_num_rows($qc);
			if($countc > 0){
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

	if(strlen(trim($_POST['map'])) == 0){
		$errors [] = "URL MAPA WEB <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['calle'])) == 0){
		$errors [] = "CALLE <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
		
	elseif (strlen(trim($_POST['calle'])) < 6){
		$errors [] = "CALLE <font color='#FF0000'>Más de 5 carácteres.</font>";
		}
			
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};\*\']+$/',$_POST['calle'])){
		$errors [] = "CALLE <font color='#FF0000'>Caracteres no válidos.</font>";
		}

		///////////////////////////////////////////////////////////////////////////////////

	/* Validamos el campo mail. */
	
	global $sqlml;
	global $qml;

	$sqlml =  "SELECT * FROM `$db_name`.`gcb_art` WHERE `gcb_art`.`Email` = '$_POST[Email]'";
	$qml = mysqli_query($db, $sqlml);
	$rowml = mysqli_fetch_assoc($qml);

	if (isset($_POST['id']) == $rowml['id']){}
	elseif(mysqli_num_rows($qml)!= 0){
		$errors [] = "Mail: <font color='#FF0000'>Ya Existe.</font>";
		}
		
	if(strlen(trim($_POST['Email'])) == 0){
		$errors [] = "Mail: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['Email'])) < 5 ){
		$errors [] = "Mail: <font color='#FF0000'>Escriba más de cinco carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^A-Z]+$/',$_POST['Email'])){
		$errors [] = "Mail: <font color='#FF0000'>Solo Minusculas</font>";
		}

	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/',$_POST['Email'])){
		$errors [] = "Mail: <font color='#FF0000'>Esta dirección no es válida.</font>";
		}
		
/* 
	if(trim($_POST['id'] == $rowd['id'])&&(!strcasecmp($_POST['Email'] , $rowd['Email']))){}
			elseif(!strcasecmp($_POST['Email'] , $rowd['Email'])){
				$errors [] = "Mail: <font color='#FF0000'>No se puede registrar con este Mail.</font>";
				}	
	
	elseif(!strcasecmp($_POST['Email'] , $rowd['Email'])){
		$errors [] = "Mail: <font color='#FF0000'>No se puede registrar con este Mail.</font>";
		}	
*/

		///////////////////////////////////////////////////////////////////////////////////

	/* Validamos el campo Tlf1 */
	
	$sqltlf1 =  "SELECT * FROM `$db_name`.`gcb_art` WHERE `gcb_art`.`Tlf1` = '$_POST[Tlf1]' OR `gcb_art`.`Tlf2` = '$_POST[Tlf1]' ";
	$qtlf1 = mysqli_query($db, $sqltlf1);
	$rowtlf1 = mysqli_fetch_assoc($qtlf1);
	$countlf1 = mysqli_num_rows($qtlf1);

	if (@$_POST['id'] == $rowtlf1['id']){}
	elseif($countlf1 != 0){
		$errors [] = "Teléfono 1: <font color='#FF0000'>YA EXISTE.</font>";
		}

	if(strlen(trim($_POST['Tlf1'])) == 0){
		$errors [] = "Teléfono 1: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif ((trim($_POST['Tlf1'])) == (trim($_POST['Tlf2']))){
					$errors [] = "Teléfono 1 y 2: <font color='#FF0000'>SON IGUALES</font>";
		}

	elseif (!preg_match('/^[\d]+$/',$_POST['Tlf1'])){
		$errors [] = "Teléfono 1: <font color='#FF0000'>Sólo se admiten números.</font>";
		}

	elseif (strlen(trim($_POST['Tlf1'])) < 9){
		$errors [] = "Teléfono 1: <font color='#FF0000'>No menos de nueve números</font>";
		}

	if(strlen(trim($_POST['Tlf2'])) > 0){
	$sqltlf2 =  "SELECT * FROM `$db_name`.`gcb_art` WHERE `gcb_art`.`Tlf1` = '$_POST[Tlf2]' OR `gcb_art`.`Tlf2` = '$_POST[Tlf2]' ";
	$qtlf2 = mysqli_query($db, $sqltlf2);
	$rowtlf2 = mysqli_fetch_assoc($qtlf2);
	$countlf2 = mysqli_num_rows($qtlf2);

	if (!preg_match('/^[\d]+$/',$_POST['Tlf2'])){
			$errors [] = "Teléfono 2: <font color='#FF0000'>Sólo se admiten números.</font>";
			}
	elseif (@$_POST['id'] == $rowtlf2['id']){}
	elseif($countlf2 != 0){
			$errors [] = "Teléfono 2: <font color='#FF0000'>YA EXISTE.</font>";
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
		

		///////////////////////////////////////////////////////////////////////////////////
	
	/* VALIDO IMAGEN 1 */
	if($_FILES['myimg1']['size'] == 0){
		$errors [] = "FOTOGRAFÍA 1 ES OBLIGATORIA";
		}
	
	else{
			
	$limite = 500 * 1024;
	
	$ext_permitidas = array('.jpg','JPG','.gif','.GIF','.png','.PNG');
	$extension = substr($_FILES['myimg1']['name'],-3);
	// print($extension);
	$ext_correcta = in_array($extension, $ext_permitidas);

	// $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg1']['type']);

		 
		if(!$ext_correcta){
			$errors [] = "EXTENSIÓN NO ADMITIDA: ".$_FILES['myimg1']['name'];
			}
	/*
		elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg1']['name'];
			}
	*/
		elseif ($_FILES['myimg1']['size'] > $limite){
		$tamanho = $_FILES['myimg1']['size'] / 1024;
		$errors [] = "El archivo".$_FILES['myimg1']['name']." MAYOR 500 KBytes. ".$tamanho." KB";
			}
		
			elseif ($_FILES['myimg1']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg1']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
		}

	//////////////

	/* VALIDO IMAGEN 2 */
	if($_FILES['myimg2']['size'] == 0){}
	
	else{
			
	$limite = 500 * 1024;
	
	$ext_permitidas = array('.jpg','JPG','.gif','.GIF','.png','.PNG');
	$extension = substr($_FILES['myimg2']['name'],-3);
	// print($extension);
	$ext_correcta = in_array($extension, $ext_permitidas);

	// $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg2']['type']);

		 
		if(!$ext_correcta){
			$errors [] = "EXTENSIÓN NO ADMITIDA: ".$_FILES['myimg2']['name'];
			}
	/*
		elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg2']['name'];
			}
	*/
		elseif ($_FILES['myimg2']['size'] > $limite){
		$tamanho = $_FILES['myimg2']['size'] / 1024;
		$errors [] = "El archivo".$_FILES['myimg2']['name']." MAYOR 500 KBytes. ".$tamanho." KB";
			}
		
			elseif ($_FILES['myimg2']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg2']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
		}

	//////////////

	/* VALIDO IMAGEN 3 */
	if($_FILES['myimg3']['size'] == 0){}
	
	else{
			
	$limite = 500 * 1024;
	
	$ext_permitidas = array('.jpg','JPG','.gif','.GIF','.png','.PNG');
	$extension = substr($_FILES['myimg3']['name'],-3);
	// print($extension);
	$ext_correcta = in_array($extension, $ext_permitidas);

	// $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg3']['type']);

		 
		if(!$ext_correcta){
			$errors [] = "EXTENSIÓN NO ADMITIDA: ".$_FILES['myimg3']['name'];
			}
	/*
		elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg3']['name'];
			}
	*/
		elseif ($_FILES['myimg3']['size'] > $limite){
		$tamanho = $_FILES['myimg3']['size'] / 1024;
		$errors [] = "El archivo".$_FILES['myimg3']['name']." MAYOR 500 KBytes. ".$tamanho." KB";
			}
		
			elseif ($_FILES['myimg3']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg3']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
		}

	//////////////

	/* VALIDO IMAGEN 4 */
	if($_FILES['myimg4']['size'] == 0){}
	
	else{
			
	$limite = 500 * 1024;
	
	$ext_permitidas = array('.jpg','JPG','.gif','.GIF','.png','.PNG');
	$extension = substr($_FILES['myimg4']['name'],-3);
	// print($extension);
	$ext_correcta = in_array($extension, $ext_permitidas);

	// $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg4']['type']);

		 
		if(!$ext_correcta){
			$errors [] = "EXTENSIÓN NO ADMITIDA: ".$_FILES['myimg4']['name'];
			}
	/*
		elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg4']['name'];
			}
	*/
		elseif ($_FILES['myimg4']['size'] > $limite){
		$tamanho = $_FILES['myimg4']['size'] / 1024;
		$errors [] = "El archivo".$_FILES['myimg4']['name']." MAYOR 500 KBytes. ".$tamanho." KB";
			}
		
			elseif ($_FILES['myimg4']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg4']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
		}

	//////////////

	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;	
	global $secc;
	
	global $_sec;
	$secc = $_POST['autor'];
	$sqlx =  "SELECT * FROM `admin` WHERE `ref` = '$_POST[autor]'";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];
	//echo $rowautor['Nombre']." ".$rowautor['Apellidos']."</br>";
	

	/* TRATAMOS EL NOMBRE DE LAS IMAGENES */
	global $carpetaimg;
	$carpetaimg = "../Gcb.Img.Art";

	$extension1 = substr($_FILES['myimg1']['name'],-3);
	global $new_name1;
	$new_name1 = $_POST['refart']."_01.".$extension1;

	if($_FILES['myimg2']['size'] == 0){
		global $new_name2;
		$new_name2 = $_POST['refart']."_02.png";
	}
	else{
	$extension2 = substr($_FILES['myimg2']['name'],-3);
	global $new_name2;
	$new_name2 = $_POST['refart']."_01.".$extension2;
	}

	if($_FILES['myimg3']['size'] == 0){
		global $new_name3;
		$new_name3 = $_POST['refart']."_03.png";
	}
	else{
	$extension3 = substr($_FILES['myimg3']['name'],-3);
	global $new_name3;
	$new_name3 = $_POST['refart']."_03.".$extension3;
	}

	if($_FILES['myimg4']['size'] == 0){
		global $new_name4;
		$new_name4 = $_POST['refart']."_04.png";
	}
	else{
	$extension4 = substr($_FILES['myimg4']['name'],-3);
	global $new_name4;
	$new_name4 = $_POST['refart']."_04.".$extension4;
	}

	require 'Inclu_Name_Ref_to_Name.php';

		/* GRABAMOS LOS DATOS EN LA TABLA DE RESTAURANTES */

		global $db;
		global $db_name;

		global $tablename;
		$tablename = "gcb_art";
		$tablename = "`".$tablename."`";
		global $titulo;
		$titulo = strtoupper($_POST['titulo']);
		global $subtitul;
		$subtitul = strtoupper($_POST['subtitul']);

	$sqla = "INSERT INTO `$db_name`.$tablename (`refuser`, `refart`,`tit`,`titsub`,`datein`,`timein`,`datemod`,`timemod`,`conte`,`myimg1`,`myimg2`,`myimg3`,`myimg4`,`refayto`,`refisla`,`reftipo`,`refespec1`,`refespec2`,`url`,`calle`,`Email`,`Tlf1`,`Tlf2`) VALUES ('$_POST[autor]', '$_POST[refart]', '$titulo', '$subtitul', '$_POST[datein]', '$_POST[timein]', '0000-00-00', '00:00:00', '$_POST[coment]', '$new_name1', '$new_name2', '$new_name3', '$new_name4', '$_POST[ayto]', '$_POST[isla]', '$_POST[tipo]', '$_POST[espec1]', '$_POST[espec2]', '$_POST[url]', '$_POST[calle]', '$_POST[Email]', '$_POST[Tlf1]', '$_POST[Tlf2]')";

	if(mysqli_query($db, $sqla)){

			global $carpetaimg;
			global $new_name;

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
				<img src='".$carpetaimg."/".$new_name1."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						TITULO
					</td>
					<td>"
						.$_POST['titulo'].
					"</td>
				</tr>				
				
				<tr>
					<td>	
						SUBTITULO
					</td>
					<td>"
						.$_POST['subtitul'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						DATE IN
					</td>
					<td>"
						.$_POST['datein'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						TIME IN
					</td>
					<td>"
						.$_POST['timein'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						ISLA
					</td>
					<td colspan=2>"
						.$_POST['isla']." / ".$islaname.
					"</td>
				</tr>
				
				<tr>
					<td>	
						AYUNTAMIENTO
					</td>
					<td colspan=2>"
						.$_POST['ayto']." / ".$aytoname.
					"</td>
				</tr>
				
				<tr>
					<td>	
						TIPO
					</td>
					<td colspan=2>"
						.$_POST['tipo']." / ".$tipname.
					"</td>
				</tr>
				
				<tr>
					<td>	
						ESPECIALIDAD 1
					</td>
					<td colspan=2>"
						.$_POST['espec1']." / ".$espec1name.
					"</td>
				</tr>
				
				<tr>
					<td>	
						ESPECIALIDAD 2
					</td>
					<td colspan=2>"
						.$_POST['espec2']." / ".$espec1name.
					"</td>
				</tr>
				
				<tr>
					<td>	
						URL WEB
					</td>
					<td colspan=2>"
						.$_POST['url'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						CALLE
					</td>
					<td colspan=2>"
						.$_POST['calle'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						EMAIL
					</td>
					<td colspan=2>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						TELEFONO 1
					</td>
					<td colspan=2>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						TELEFONO 2
					</td>
					<td colspan=2>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
				
				<tr>
					<td colspan=3  align='center'>
						DESCRIPCION
					</td>
				</tr>
				<tr>
					<td colspan=3>"
						.$_POST['coment'].
					"</td>
				</tr>
				<tr>
					<th colspan=3 class='BorderSup'>
						<a href=Art_Crear.php>CREAR UN NUEVO RESTAURANTE</a>
					</th>
				</tr>
			</table>");
			
		/************* CREAMOS LAS IMAGENES DEL RESTAURANTE EN EL DIRECTORIO Gcb.Img.Art ***************/

	/* GRABAMOS LA IMAGEN 1 */
	if($_FILES['myimg1']['size'] == 0){
				global $carpetaimg;
				global $new_name1;
				copy("../Gcb.Img.Sys/untitled.png", $carpetaimg."/".$new_name1);
		} 	
		else{	$safe_filename = trim(str_replace('/', '', $_FILES['myimg1']['name']));
				$safe_filename = trim(str_replace('..', '', $safe_filename));

				$nombre = $_FILES['myimg1']['name'];
				$destination_file = $carpetaimg.'/'.$safe_filename;

	 if( file_exists( $carpetaimg.'/'.$nombre) ){
			unlink($carpetaimg."/".$nombre);
		//	print("* El archivo ".$nombre." ya existe, seleccione otra imagen.</br>");
												}
			
	elseif (move_uploaded_file($_FILES['myimg1']['tmp_name'], $destination_file)){
			
			global $carpetaimg;
			global $new_name1;
			$rename_filename = $carpetaimg."/".$new_name1;								
			rename($destination_file, $rename_filename);
			// print("El archivo se ha guardado en: ".$destination_file);
			}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file);}
		}

	/* GRABAMOS LA IMAGEN 2 */
	if($_FILES['myimg2']['size'] == 0){
				global $carpetaimg;
				global $new_name2;
				copy("../Gcb.Img.Sys/untitled.png", $carpetaimg."/".$new_name2);
		} 	
		else{	$safe_filename = trim(str_replace('/', '', $_FILES['myimg2']['name']));
				$safe_filename = trim(str_replace('..', '', $safe_filename));

				$nombre = $_FILES['myimg2']['name'];
				$destination_file = $carpetaimg.'/'.$safe_filename;

	 if( file_exists( $carpetaimg.'/'.$nombre) ){
			unlink($carpetaimg."/".$nombre);
		//	print("* El archivo ".$nombre." ya existe, seleccione otra imagen.</br>");
												}
			
	elseif (move_uploaded_file($_FILES['myimg2']['tmp_name'], $destination_file)){
			
			global $carpetaimg;
			global $new_name2;
			$rename_filename = $carpetaimg."/".$new_name2;								
			rename($destination_file, $rename_filename);
			// print("El archivo se ha guardado en: ".$destination_file);
			}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file);}
		}

	/* GRABAMOS LA IMAGEN 3 */
	if($_FILES['myimg3']['size'] == 0){
				global $carpetaimg;
				global $new_name3;
				copy("../Gcb.Img.Sys/untitled.png", $carpetaimg."/".$new_name3);
		} 	
		else{	$safe_filename = trim(str_replace('/', '', $_FILES['myimg3']['name']));
				$safe_filename = trim(str_replace('..', '', $safe_filename));

				$nombre = $_FILES['myimg3']['name'];
				$destination_file = $carpetaimg.'/'.$safe_filename;

	 if( file_exists( $carpetaimg.'/'.$nombre) ){
			unlink($carpetaimg."/".$nombre);
		//	print("* El archivo ".$nombre." ya existe, seleccione otra imagen.</br>");
												}
			
	elseif (move_uploaded_file($_FILES['myimg3']['tmp_name'], $destination_file)){
			
			global $carpetaimg;
			global $new_name3;
			$rename_filename = $carpetaimg."/".$new_name3;								
			rename($destination_file, $rename_filename);
			// print("El archivo se ha guardado en: ".$destination_file);
			}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file);}
		}

	/* GRABAMOS LA IMAGEN 4 */
	if($_FILES['myimg4']['size'] == 0){
				global $carpetaimg;
				global $new_name4;
				copy("../Gcb.Img.Sys/untitled.png", $carpetaimg."/".$new_name4);
		} 	
		else{	$safe_filename = trim(str_replace('/', '', $_FILES['myimg4']['name']));
				$safe_filename = trim(str_replace('..', '', $safe_filename));

				$nombre = $_FILES['myimg4']['name'];
				$destination_file = $carpetaimg.'/'.$safe_filename;

	 if( file_exists( $carpetaimg.'/'.$nombre) ){
			unlink($carpetaimg."/".$nombre);
		//	print("* El archivo ".$nombre." ya existe, seleccione otra imagen.</br>");
												}
			
	elseif (move_uploaded_file($_FILES['myimg4']['tmp_name'], $destination_file)){
			
			global $carpetaimg;
			global $new_name4;
			$rename_filename = $carpetaimg."/".$new_name4;								
			rename($destination_file, $rename_filename);
			// print("El archivo se ha guardado en: ".$destination_file);
			}
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file);}
		}

	} 	// NO SE CUMPLE EL QUERY
	else {print("* MODIFIQUE LA ENTRADA L.512: ".mysqli_error($db));
						show_form ();
						//global $texerror;
						//$texerror = "\n\t ".mysqli_error($db);
					}
		
	}	/* FINAL process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if(isset($_POST['oculto1'])){
		$defaults = $_POST;
		$_SESSION['refart'] = date('Y.m.d.H.i.s');
		$_SESSION['datein'] = date('Y-m-d');
		$_SESSION['timein'] = date('H:i:s');
		} 
	elseif(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'autor' => isset($_POST['autor']),  // refautor
									'titulo' => '', // Nombre restaurante
									'subtitul' => '', // Sub Titulo
								   	//'refart' => @$_SESSION['refart'],  Referencia articulo
								   	'coment' => '',
									'myimg1' => '',
									'myimg2' => '',
									'myimg3' => '',
									'myimg4' => '',
									'isla' => isset($_POST['isla']),  // refisla
									'ayto' => isset($_POST['ayto']),  // refayto
									'tipo' => isset($_POST['tipo']),
									'espec1' => isset($_POST['espec1']),
									'espec2' => isset($_POST['espec2']),									
									'url' => isset($_POST['url']),
									'map' => isset($_POST['url']),
									'calle' => isset($_POST['calle']),
									'Email' => 'Solo letras minúsculas',
									'Tlf1' => '',
									'Tlf2' => '');
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
	global $_sec;

	global $autor;
	$autor = @$_POST['autor'];

	/* CONSULTAMOS LA TABLA ADMIN = AUTORES */
	$sqlx =  "SELECT * FROM `admin` WHERE `ref` = '$autor' ";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	$_sec = @$rowautor['Nombre'];

	global $isla;
	$isla = @$_POST['isla'];

	/* CONSULTAMOS LA TABLA AYUNAMIENTOS = ISLA */
	$sqlis =  "SELECT * FROM `gcb_islas` WHERE `refisla` = '$isla' ";
	$qis = mysqli_query($db, $sqlis);
	$rowisla = mysqli_fetch_assoc($qis);
	$_secis = @$rowisla['isla'];

	print(" <table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<th colspan='2'>
						CREAR RESTAURANTE PARA ISLA ".strtoupper($_secis)."
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
	$sqlb =  "SELECT * FROM `gcb_islas` ORDER BY `isla` ASC ";
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
				
	if (isset($_POST['oculto1']) || isset($_POST['oculto'])) {
	if ($_POST['isla'] == '0') { 
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
										HA DE SELECCIONAR UNA ISLA PARA CREAR UN RESTAURANTE.
											</font>
										</td>
									</tr>
								</table>");
												}	

//////////////////////////

		if ($_POST['isla'] == ''){print("
								<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													SELECCIONE UNA ISLA.
											</font>
										</td>
									</tr>
								</table>");} 
								
	elseif ($_POST['isla'] != '') { 
		
	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							NUEVO RESTAURANTE EN ".strtoupper($_secis)."
					</th>
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
	$sqlayt =  "SELECT * FROM `gcb_aytos` WHERE `refisla` = '$isla' ORDER BY `ayto` ASC ";
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
		<input type='text' name='map' size=50 maxlength=49 value='".@$defaults['map']."' />
					</td>
				</tr>

				<tr>
					<td align='right'>						
						CALLE
					</td>
					<td>
		<input type='text' name='calle' size=50 maxlength=40 value='".@$defaults['calle']."' />
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
	$sqltipo =  "SELECT * FROM `gcb_tipologia` ORDER BY `tipo` ASC ";
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
		<option value=''>ESPECIALIDADES ...</option>");
						
	/* SELECT ESPECIALIDAD 1 */	
			
	global $db;
	$sqlespec =  "SELECT * FROM `gcb_especialidad` ORDER BY `espec` ASC ";
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
				<td align='right'>
						ESPECIALIDAD 2
				</td>
				<td align='left'>

		<select name='espec2'>
		<option value=''>ESPECIALIDADES ...</option>");
						
	/* SELECT ESPECIALIDAD */	

	global $db;
	$sqlespec2 =  "SELECT * FROM `gcb_especialidad` ORDER BY `espec` ASC ";
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
						AUTOR
					</td>
					<td align='left'>

			<select name='autor'>
			<option value=''>POSIBLES AUTORES</option>");
						
	/* SELECT AUTOR DE LA ENTRADA */	
			
	global $db;
	$sqlb =  "SELECT * FROM `admin` ORDER BY `Apellidos` ASC ";
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
					<td>
						FOTOGRAFÍA 1
					</td>
					<td>
		<input type='file' name='myimg1' value='".@$defaults['myimg1']."' />						
					</td>
				</tr>

				<tr>
					<td>
						FOTOGRAFÍA 2
					</td>
					<td>
		<input type='file' name='myimg2' value='".@$defaults['myimg2']."' />						
					</td>
				</tr>

				<tr>
					<td>
						FOTOGRAFÍA 3
					</td>
					<td>
		<input type='file' name='myimg3' value='".@$defaults['myimg3']."' />						
					</td>
				</tr>
				<tr>
					<td>
						FOTOGRAFÍA 4
					</td>
					<td>
		<input type='file' name='myimg4' value='".@$defaults['myimg4']."' />						
					</td>
				</tr>

				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='CREAR RESTAURANTE' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>


		</form>														
			</table>				
						"); 
											}
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
		
				require '../Gcb.Inclu/Master_Index_Artic.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gcb.Inclu/Admin_Inclu_02.php';

?>