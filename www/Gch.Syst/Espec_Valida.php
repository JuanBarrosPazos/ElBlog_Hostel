<?php

	global $vespec;
	$vespec = trim(str_replace(' ', '', $_POST['espec']));
	$sqlespec =  "SELECT * FROM `$db_name`.`gch_especialidad` WHERE `gch_especialidad`.`espec` = '$vespec'";
	$qespec = mysqli_query($db, $sqlespec);
	$rowespec = mysqli_fetch_assoc($qespec);
	$counespec = mysqli_num_rows($qespec);

	global $vrefespec;
    $vrefespec = trim(str_replace(' ', '', $_POST['refespec']));
	$sqlrefespec =  "SELECT * FROM `$db_name`.`gch_especialidad` WHERE `gch_especialidad`.`refespec` = '$vrefespec'";
	$qrefespec = mysqli_query($db, $sqlrefespec);
	$rowrefespec = mysqli_fetch_assoc($qrefespec);
	$counrefespec = mysqli_num_rows($qrefespec);

	if (isset($_POST['id']) == $rowespec['id']){}
	elseif($counespec != 0){
		$errors [] = "ESPECIALIDAD: <font color='#FF0000'>YA EXISTE.</font>";
		}
	if(strlen(trim($_POST['espec'])) == 0){
		$errors [] = "ESPECIALIDAD <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif(strlen(trim($vespec)) <= 5){
		$errors [] = "ESPECIALIDAD <font color='#FF0000'>Mas de 5 carácteres.</font>";
		}

	elseif(strlen(trim($_POST['espec'])) >= 17){
		$errors [] = "ESPECIALIDAD <font color='#FF0000'>Menos de 17 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^#$&<>\(\)\[\]\{\}]+$/',$_POST['espec'])){
		$errors [] = "ESPECIALIDAD <font color='#FF0000'>No Permitidos #$&<>()[]{}</font>";
		}


	if (isset($_POST['id']) == $rowrefespec['id']){}
	elseif($counrefespec != 0){
		$errors [] = "REF ESPECIALIDAD: <font color='#FF0000'>YA EXISTE.</font>";
		}

	if(strlen(trim($_POST['refespec'])) == 0){
		$errors [] = "REF ESPECIALIDAD <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif(strlen(trim($vrefespec)) <= 3){
		$errors [] = "REF ESPECIALIDAD <font color='#FF0000'>Mas de 3 carácteres.</font>";
		}

	elseif(strlen(trim($_POST['refespec'])) >= 5){
		$errors [] = "REF ESPECIALIDAD <font color='#FF0000'>Menos de 5 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^#$&<>\(\)\[\]\{\}]+$/',$_POST['refespec'])){
		$errors [] = "REF ESPECIALIDAD <font color='#FF0000'>No Permitidos #$&<>()[]{}</font>";
		}

?>