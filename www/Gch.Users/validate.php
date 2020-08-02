	<?php

error_reporting (0);

$errors = array();

						/////////////////////////
	/////////////////////////			/////////////////////////
					/////////////////////////

	/* VALIDAMOS EL CAMPO NOMBRE. */
	
	if(strlen(trim($_POST['Nombre'])) == 0){
		$errors [] = "NOMBRE: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['Nombre'])) < 3){
		$errors [] = "NOMBRE: <font color='#FF0000'>Escriba más de dos carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['Nombre'])){
		$errors [] = "NOMBRE: <font color='#FF0000'>Solo se admite texto, sin acentos.</font>";
		}

		/* VALIDAMOS EL CAMPO APELLIDOS. */
	
		if(strlen(trim($_POST['Apellidos'])) == 0){
		$errors [] = "APELLIDOS: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['Apellidos'])) < 4){
		$errors [] = "APELLIDOS: <font color='#FF0000'>Escriba más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^0-9@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['Apellidos'])){
		$errors [] = "APELLIDOS: <font color='#FF0000'>Solo se admite texto, sin acentos.</font>";
		}
		

						/////////////////////////
	/////////////////////////			/////////////////////////
					/////////////////////////

	/* Validamos el campo mail. */
	
	global $db;
	global $sqlml;
	global $qml;
	global $db_name;

	$sqlml =  "SELECT * FROM `$db_name`.`gch_user` WHERE `gch_user`.`Email` = '$_POST[Email]'";
	$qml = mysqli_query($db, $sqlml);
	$rowml = mysqli_fetch_assoc($qml);

	if ($_POST['id'] == $rowml['id']){}
	elseif(mysqli_num_rows($qml)!= 0){
		$errors [] = "MAIL: <font color='#FF0000'>Ya Existe.</font>";
		}
		
	if(strlen(trim($_POST['Email'])) == 0){
		$errors [] = "MAIL: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['Email'])) < 5 ){
		$errors [] = "MAIL: <font color='#FF0000'>Escriba más de cinco carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^A-Z]+$/',$_POST['Email'])){
		$errors [] = "MAIL: <font color='#FF0000'>Solo Minusculas</font>";
		}

	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/',$_POST['Email'])){
		$errors [] = "MAIL: <font color='#FF0000'>Esta dirección no es válida.</font>";
		}
		
/* if(trim($_POST['id'] == $rowd['id'])&&(!strcasecmp($_POST['Email'] , $rowd['Email']))){}
			elseif(!strcasecmp($_POST['Email'] , $rowd['Email'])){
				$errors [] = "Mail: <font color='#FF0000'>No se puede registrar con este Mail.</font>";
				}	
	
	elseif(!strcasecmp($_POST['Email'] , $rowd['Email'])){
		$errors [] = "Mail: <font color='#FF0000'>No se puede registrar con este Mail.</font>";
		}	
*/
						/////////////////////////
	/////////////////////////			/////////////////////////
					/////////////////////////

	/* VALIDAMOS EL CAMPO NIVEL. */
	
	if(strlen(trim($_POST['Nivel'])) == 0){
		$errors [] = "NIVEL: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
		/* Validamos el campo usuario. */
	
	global $db;
	global $sqlus;
	global $qus;
	global $db_name;

	$sqlus =  "SELECT * FROM `$db_name`.`gch_user` WHERE `gch_user`.`Usuario` = '$_POST[Usuario]'";
	$qus = mysqli_query($db, $sqlus);
	$rowus = mysqli_fetch_assoc($qus);

	if ($_POST['id'] == $rowus['id']){

	}
	elseif(mysqli_num_rows($qus)!= 0){
		$errors [] = "USUARIO: <font color='#FF0000'>Ya Existe.</font>";
		}

	if(strlen(trim($_POST['Usuario'])) == 0){
		$errors [] = "USUARIO: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['Usuario'])) < 3){
		$errors [] = "USUARIO: <font color='#FF0000'>Escriba más de tres caracteres.</font>";
		}
			
	elseif (!preg_match('/^\b[^@#$%&<>\?\[\]\{\}\+\s]+$/',$_POST['Usuario'])){
		$errors [] = "USUARIO: <font color='#FF0000'>No se admiten carácteres especiales.</font>";
		}

	elseif(trim($_POST['Usuario'] != $_POST['Usuario2'])){
		$errors [] = "USUARIO: <font color='#FF0000'>No son iguales los dos campos usuario.</font>";
		}
		
		
/*	if(trim($_POST['id'] == $rowd['id'])&&(!strcasecmp($_POST['Usuario'] , $rowd['Usuario']))){}
			elseif(!strcasecmp($_POST['Usuario'] , $rowd['Usuario'])){
				$errors [] = "USUARIO: <font color='#FF0000'>No se puede registrar con este nombre de usuario.</font>";
				}

	elseif(!strcasecmp($_POST['Usuario'] , $rowd['Usuario'])){
		$errors [] = "USUARIO: <font color='#FF0000'>No se puede registrar con este nombre de usuario.</font>";
		}	
*/
						/////////////////////////
	/////////////////////////			/////////////////////////
					/////////////////////////

	/* Validamos el campo password. */
	
		if(strlen(trim($_POST['Password'])) == 0){
		$errors [] = "PASSWORD: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['Password'])) < 3){
		$errors [] = "PASSWORD: <font color='#FF0000'>Escriba más de tres caracteres.</font>";
		}
			
	elseif (!preg_match('/^\b[^@#$%&<>\?\[\]\{\}\+\s]+$/',$_POST['Password'])){
		$errors [] = "PASSWORD: <font color='#FF0000'>No se admiten carácteres especiales.</font>";
		}

	elseif(trim($_POST['Password'] != $_POST['Password2'])){
		$errors [] = "PASSWORD: <font color='#FF0000'>No son iguales los dos campos password.</font>";
		}
	

						/////////////////////////
	/////////////////////////			/////////////////////////
					/////////////////////////

	/* Validamos el campo Dirección. */
	
		if(strlen(trim($_POST['Direccion'])) == 0){
		$errors [] = "DIRECCION: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (!preg_match('/^\b[^@#$%&<>\?\[\]\{\}\+]+$/',$_POST['Direccion'])){
		$errors [] = "DIRECCION: <font color='#FF0000'>No se admiten carácteres especiales.</font>";
		}
		
						/////////////////////////
	/////////////////////////			/////////////////////////
					/////////////////////////

	/* Validamos el campo Tlf1 */
	
	global $db;
	global $db_name;

	$sqltlf1 =  "SELECT * FROM `$db_name`.`gch_user` WHERE `gch_user`.`Tlf1` = '$_POST[Tlf1]' ";
	$qtlf1 = mysqli_query($db, $sqltlf1);
	$rowtlf1 = mysqli_fetch_assoc($qtlf1);
	$countlf1 = mysqli_num_rows($qtlf1);

	if ($_POST['id'] == $rowtlf1['id']){}
	elseif($countlf1 >= 1){
		$errors [] = "TELEFONO: <font color='#FF0000'>YA EXISTE.</font>";
		}

	if(strlen(trim($_POST['Tlf1'])) == 0){
		$errors [] = "TELEFONO: <font color='#FF0000'>Este campo es obligatorio.</font>";
		}
	
	elseif (!preg_match('/^[\d]+$/',$_POST['Tlf1'])){
		$errors [] = "TELEFONO: <font color='#FF0000'>Sólo se admiten números.</font>";
		}

	elseif (strlen(trim($_POST['Tlf1'])) < 9){
		$errors [] = "TELEFONO: <font color='#FF0000'>No menos de nueve números</font>";
		}
		
						/////////////////////////
	/////////////////////////			/////////////////////////
					/////////////////////////

/* La función devuelve el array errors. */
	
/* Creado por Juan Barros Pazos 2020 */
?>