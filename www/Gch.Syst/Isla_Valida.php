<?php

	global $visla;
	$visla = trim(str_replace(' ', '', $_POST['isla']));
	$sqlisla =  "SELECT * FROM `$db_name`.`gch_islas` WHERE `gch_islas`.`isla` = '$visla'";
	$qisla = mysqli_query($db, $sqlisla);
	$rowisla = mysqli_fetch_assoc($qisla);
	$counisla = mysqli_num_rows($qisla);

	global $vrefisla;
    $vrefisla = trim(str_replace(' ', '', $_POST['refisla']));
	$sqlrefisla =  "SELECT * FROM `$db_name`.`gch_islas` WHERE `gch_islas`.`refisla` = '$vrefisla'";
	$qrefisla = mysqli_query($db, $sqlrefisla);
	$rowrefisla = mysqli_fetch_assoc($qrefisla);
	$counrefisla = mysqli_num_rows($qrefisla);

	if (isset($_POST['id']) == $rowisla['id']){}
	elseif($counisla != 0){
		$errors [] = "ISLA: <font color='#FF0000'>YA EXISTE.</font>";
		}
	if(strlen(trim($_POST['isla'])) == 0){
		$errors [] = "ISLA: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif(strlen(trim($visla)) <= 5){
		$errors [] = "ISLA: <font color='#FF0000'>Mas de 5 carácteres.</font>";
		}

	elseif(strlen(trim($_POST['isla'])) >= 17){
		$errors [] = "ISLA: <font color='#FF0000'>Menos de 17 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^#$&<>\(\)\[\]\{\}]+$/',$_POST['isla'])){
		$errors [] = "ISLA: <font color='#FF0000'>No Permitidos #$&<>()[]{}</font>";
		}


	if (isset($_POST['id']) == $rowrefisla['id']){}
	elseif($counrefisla != 0){
		$errors [] = "REF ISLA: <font color='#FF0000'>YA EXISTE.</font>";
		}

	if(strlen(trim($_POST['refisla'])) == 0){
		$errors [] = "REF ISLA: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif(strlen(trim($vrefisla)) <= 3){
		$errors [] = "REF ISLA: <font color='#FF0000'>Mas de 3 carácteres.</font>";
		}

	elseif(strlen(trim($_POST['refisla'])) >= 5){
		$errors [] = "REF ISLA: <font color='#FF0000'>Menos de 5 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^#$&<>\(\)\[\]\{\}]+$/',$_POST['refisla'])){
		$errors [] = "REF ISLA: <font color='#FF0000'>No Permitidos #$&<>()[]{}</font>";
		}

?>