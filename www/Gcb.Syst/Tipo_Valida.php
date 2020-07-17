<?php

	global $vtipo;
	$vtipo = trim(str_replace(' ', '', $_POST['tipo']));
	$sqltipo =  "SELECT * FROM `$db_name`.`gcb_tipologia` WHERE `gcb_tipologia`.`tipo` = '$vtipo'";
	$qtipo = mysqli_query($db, $sqltipo);
	$rowtipo = mysqli_fetch_assoc($qtipo);
	$countipo = mysqli_num_rows($qtipo);

	global $vreftipo;
    $vreftipo = trim(str_replace(' ', '', $_POST['reftipo']));
	$sqlreftipo =  "SELECT * FROM `$db_name`.`gcb_tipologia` WHERE `gcb_tipologia`.`reftipo` = '$vreftipo'";
	$qreftipo = mysqli_query($db, $sqlreftipo);
	$rowreftipo = mysqli_fetch_assoc($qreftipo);
	$counreftipo = mysqli_num_rows($qreftipo);

	if (isset($_POST['id']) == $rowtipo['id']){}
	elseif($countipo != 0){
		$errors [] = "TIPOLOGIA: <font color='#FF0000'>YA EXISTE.</font>";
		}
	if(strlen(trim($_POST['tipo'])) == 0){
		$errors [] = "TIPOLOGIA <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif(strlen(trim($vtipo)) <= 5){
		$errors [] = "TIPOLOGIA <font color='#FF0000'>Mas de 5 carácteres.</font>";
		}

	elseif(strlen(trim($_POST['tipo'])) >= 17){
		$errors [] = "TIPOLOGIA <font color='#FF0000'>Menos de 17 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^#$&<>\(\)\[\]\{\}]+$/',$_POST['tipo'])){
		$errors [] = "TIPOLOGIA <font color='#FF0000'>No Permitidos #$&<>()[]{}</font>";
		}


	if (isset($_POST['id']) == $rowreftipo['id']){}
	elseif($counreftipo != 0){
		$errors [] = "REF TIPOLOGIA: <font color='#FF0000'>YA EXISTE.</font>";
		}

	if(strlen(trim($_POST['reftipo'])) == 0){
		$errors [] = "REF TIPOLOGIA <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif(strlen(trim($vreftipo)) <= 3){
		$errors [] = "REF TIPOLOGIA <font color='#FF0000'>Mas de 3 carácteres.</font>";
		}

	elseif(strlen(trim($_POST['reftipo'])) >= 5){
		$errors [] = "REF TIPOLOGIA <font color='#FF0000'>Menos de 5 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^#$&<>\(\)\[\]\{\}]+$/',$_POST['reftipo'])){
		$errors [] = "REF TIPOLOGIA <font color='#FF0000'>No Permitidos #$&<>()[]{}</font>";
		}

?>