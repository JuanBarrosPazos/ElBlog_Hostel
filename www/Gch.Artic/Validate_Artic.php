<?php

/*
	if(strlen(trim($_POST['refart'])) != 0){	
			$secc1 = "gch_art";
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
			////////////////////		**********  		////////////////////

	if(strlen(trim($_POST['ayto'])) == 0){
		$errors [] = "AYUNTAMIENTO <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

			////////////////////		**********  		////////////////////

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
	$sqlc =  "SELECT * FROM `$db_name`.$secc1 WHERE `tit` = '$_POST[titulo]' OR `refart` = '$_POST[refart]'";
		$qc = mysqli_query($db, $sqlc);
		global $conutc;
		$countc = mysqli_num_rows($qc);
	if($countc > 0){
			$errors [] = "YA EXISTE ESTE RESTAURANTE";
				}
		}

			////////////////////		**********  		////////////////////

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
			global $conutc;
			$countc = mysqli_num_rows($qc);
			if($countc > 0){
			$errors [] = "YA EXISTE ESTE SUBTITULO";
				}
		}

			////////////////////		**********  		////////////////////

	if(strlen(trim($_POST['autor'])) == 0){
		$errors [] = "AUTOR <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

			////////////////////		**********  		////////////////////

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

			////////////////////		**********  		////////////////////

	if(strlen(trim($_POST['calle'])) == 0){
		$errors [] = "CALLE <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
		
	elseif (strlen(trim($_POST['calle'])) < 6){
		$errors [] = "CALLE <font color='#FF0000'>Más de 5 carácteres.</font>";
		}
			
	elseif (!preg_match('/^[^@#$&%<>"·\(\)=¿?!¡\[\]\{\};\*]+$/',$_POST['calle'])){
		$errors [] = "CALLE <font color='#FF0000'>Caracteres no válidos.</font>";
		}

			////////////////////		**********  		////////////////////

	/* VALIDO CAMPO MAIL */
	
	global $sqlml;
	global $qml;

	$sqlml =  "SELECT * FROM `$db_name`.`gch_art` WHERE `gch_art`.`Email` = '$_POST[Email]'";
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

			////////////////////		**********  		////////////////////

	/* Validamos el campo Tlf1 */
	
	$sqltlf1 =  "SELECT * FROM `$db_name`.`gch_art` WHERE `gch_art`.`Tlf1` = '$_POST[Tlf1]' OR `gch_art`.`Tlf2` = '$_POST[Tlf1]' ";
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
	$sqltlf2 =  "SELECT * FROM `$db_name`.`gch_art` WHERE `gch_art`.`Tlf1` = '$_POST[Tlf2]' OR `gch_art`.`Tlf2` = '$_POST[Tlf2]' ";
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
	
			////////////////////		**********  		////////////////////

	if(strlen(trim($_POST['tipo'])) == 0){
		$errors [] = "CATEGORIA <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

			////////////////////		**********  		////////////////////

	if(strlen(trim($_POST['espec1'])) == 0){
		$errors [] = "ESPECIALIDAD 1 Y 2 <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif(strlen(trim($_POST['espec2'])) == 0){
		$errors [] = "ESPECIALIDAD 2 <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif ((trim($_POST['espec1'])) == (trim($_POST['espec2']))){
					$errors [] = "ESPECIALIDADES <font color='#FF0000'>SON IGUALES</font>";
		}
	
	if(strlen(trim($_POST['precio'])) == 0){
		$errors [] = "PRECIOS <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	if(strlen(trim($_POST['valora'])) == 0){
		$errors [] = "SERVICIOS <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

			////////////////////		**********  		////////////////////

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
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    /* INICIO LA VALIDACION DE LAS IMAGENES */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    global $limite;
    $limite = 900 * 1024;

	/* VALIDO IMAGEN 1 */
	if($_FILES['myimg1']['size'] == 0){
		$errors [] = "FOTOGRAFÍA 1 ES OBLIGATORIA";
		}
	
	else{
    
	$ext_permitidas = array('.jpg','.JPG','.gif','.GIF','.png','.PNG', 'jpeg', 'JPEG');
	$extension = substr($_FILES['myimg1']['name'],-4);
	// print($extension);
	$ext_correcta = in_array($extension, $ext_permitidas);

	global $extension1;
	$extension1 = strtolower($extension);
	$extension1 = str_replace(".","",$extension1);
	global $ctemp;
	$ctemp = "../Gch.Temp";

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
		$errors [] = "IMAGEN ".$_FILES['myimg1']['name']." MAYOR DE 90 KBytes. ".$tamanho." KB";
			}

		elseif ($_FILES['myimg1']['size'] <= $limite){
			//copy($_FILES['myimg1']['tmp_name'], $ctemp."/ini1v.".$extension1); 
			global $ancho;
			global $alto;
			//list($ancho, $alto, $tipo, $atributos) = getimagesize($ctemp."/ini1v.".$extension1);
			list($ancho, $alto, $tipo, $atributos) = getimagesize($_FILES['myimg1']['name']);

			if($ancho < 400){
				$errors [] = "IMAGEN ".$_FILES['myimg1']['name']." ANCHURA MENOR DE 400 ".$ancho;
			}
			elseif(($ancho > 900)&&($alto < 400)){
				$errors [] = "IMAGEN ".$_FILES['myimg1']['name']." ALTURA MENOR DE 400 ".$alto;
			}
			elseif(($ancho > 400)&&($alto < 400)){
				$errors [] = "IMAGEN ".$_FILES['myimg1']['name']." ALTURA MENOR DE 400 ".$alto;
			}
		}
			elseif ($_FILES['myimg1']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "LA CARGA DEL ARCHIVO SE HA INTERRUMPIDO";
				}
				
				elseif ($_FILES['myimg1']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "EL ARCHIVO NO SE HA CARGADO";
                    }

    } // FIN ELSE HAY DATOS

			////////////////////		**********  		////////////////////

	/* VALIDO IMAGEN 2 */
	if($_FILES['myimg2']['size'] == 0){}
	
	else{
			
	$ext_permitidas = array('.jpg','.JPG','.gif','.GIF','.png','.PNG', 'jpeg', 'JPEG');
	$extension = substr($_FILES['myimg2']['name'],-4);
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
		$errors [] = "IMAGEN ".$_FILES['myimg2']['name']." MAYOR DE 90 KBytes. ".$tamanho." KB";
			}
		
		elseif ($_FILES['myimg2']['size'] <= $limite){
			//copy($_FILES['myimg2']['tmp_name'], $ctemp."/ini2v.".$extension2); 
			global $ancho;
			global $alto;
			//list($ancho, $alto, $tipo, $atributos) = getimagesize($ctemp."/ini2v.".$extension2);
			list($ancho, $alto, $tipo, $atributos) = getimagesize($_FILES['myimg2']['name']);

			if($ancho < 400){
				$errors [] = "IMAGEN ".$_FILES['myimg2']['name']." ANCHURA MENOR DE 400 ".$ancho;
			}
			elseif(($ancho > 900)&&($alto < 400)){
				$errors [] = "IMAGEN ".$_FILES['myimg2']['name']." ALTURA MENOR DE 400 ".$alto;
			}
			elseif(($ancho > 400)&&($alto < 400)){
				$errors [] = "IMAGEN ".$_FILES['myimg2']['name']." ALTURA MENOR DE 400 ".$alto;
			}
		}
			elseif ($_FILES['myimg2']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "LA CARGA DEL ARCHIVO SE HA INTERRUMPIDO";
				}
				
				elseif ($_FILES['myimg2']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "EL ARCHIVO NO SE HA CARGADO";
                    }
                    
	} // FIN ELSE HAY DATOS

        ////////////////////		**********  		////////////////////

	/* VALIDO IMAGEN 3 */
	if($_FILES['myimg3']['size'] == 0){}
	
	else{
			
	$ext_permitidas = array('.jpg','.JPG','.gif','.GIF','.png','.PNG', 'jpeg', 'JPEG');
	$extension = substr($_FILES['myimg3']['name'],-4);
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
		$errors [] = "IMAGEN ".$_FILES['myimg3']['name']." MAYOR DE 90 KBytes. ".$tamanho." KB";
			}
		
		elseif ($_FILES['myimg3']['size'] <= $limite){
			//copy($_FILES['myimg3']['tmp_name'], $ctemp."/ini3v.".$extension3); 
			global $ancho;
			global $alto;
			//list($ancho, $alto, $tipo, $atributos) = getimagesize($ctemp."/ini3v.".$extension3);
			list($ancho, $alto, $tipo, $atributos) = getimagesize($_FILES['myimg3']['name']);

			if($ancho < 400){
				$errors [] = "IMAGEN ".$_FILES['myimg3']['name']." ANCHURA MENOR DE 400 ".$ancho;
			}
			elseif(($ancho > 900)&&($alto < 400)){
				$errors [] = "IMAGEN ".$_FILES['myimg3']['name']." ALTURA MENOR DE 400 ".$alto;
			}
			elseif(($ancho > 400)&&($alto < 400)){
				$errors [] = "IMAGEN ".$_FILES['myimg3']['name']." ALTURA MENOR DE 400 ".$alto;
			}
		}
			elseif ($_FILES['myimg3']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "LA CARGA DEL ARCHIVO SE HA INTERRUMPIDO";
				}
				
				elseif ($_FILES['myimg3']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "EL ARCHIVO NO SE HA CARGADO";
					}
	} // FIN ELSE HAY DATOS

    ////////////////////		**********  		////////////////////

	/* VALIDO IMAGEN 4 */
	if($_FILES['myimg4']['size'] == 0){}
	
	else{
			
	$ext_permitidas = array('.jpg','.JPG','.gif','.GIF','.png','.PNG', 'jpeg', 'JPEG');
	$extension = substr($_FILES['myimg4']['name'],-4);
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
		$errors [] = "IMAGEN ".$_FILES['myimg4']['name']." MAYOR DE 90 KBytes. ".$tamanho." KB";
			}
		
		elseif ($_FILES['myimg4']['size'] <= $limite){
			//copy($_FILES['myimg1']['tmp_name'], $ctemp."/ini4v.".$extension4); 
			global $ancho;
			global $alto;
			//list($ancho, $alto, $tipo, $atributos) = getimagesize($ctemp."/ini4v.".$extension4);
			list($ancho, $alto, $tipo, $atributos) = getimagesize($_FILES['myimg4']['name']);

			if($ancho < 400){
				$errors [] = "IMAGEN ".$_FILES['myimg4']['name']." ANCHURA MENOR DE 400 ".$ancho;
			}
			elseif(($ancho > 900)&&($alto < 400)){
				$errors [] = "IMAGEN ".$_FILES['myimg4']['name']." ALTURA MENOR DE 400 ".$alto;
			}
			elseif(($ancho > 400)&&($alto < 400)){
				$errors [] = "IMAGEN ".$_FILES['myimg4']['name']." ALTURA MENOR DE 400 ".$alto;
			}
		}
			elseif ($_FILES['myimg4']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "LA CARGA DEL ARCHIVO SE HA INTERRUMPIDO";
				}
				
				elseif ($_FILES['myimg4']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "EL ARCHIVO NO SE HA CARGADO";
					}
		} // FIN ELSE HAY DATOS

        ////////////////////		**********  		////////////////////


?>