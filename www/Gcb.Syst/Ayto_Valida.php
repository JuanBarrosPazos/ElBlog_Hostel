<?php

	global $vayto;
	$vayto = trim(str_replace(' ', '', $_POST['ayto']));
	$sqlayto =  "SELECT * FROM `$db_name`.`gcb_aytos` WHERE `gcb_aytos`.`ayto` = '$vayto'";
	$qayto = mysqli_query($db, $sqlayto);
	$rowayto = mysqli_fetch_assoc($qayto);
	$counayto = mysqli_num_rows($qayto);

	global $vrefayto;
    $vrefayto = trim(str_replace(' ', '', $_POST['refayto']));
	$sqlrefayto =  "SELECT * FROM `$db_name`.`gcb_aytos` WHERE `gcb_aytos`.`refayto` = '$vrefayto'";
	$qrefayto = mysqli_query($db, $sqlrefayto);
	$rowrefayto = mysqli_fetch_assoc($qrefayto);
	$counrefayto = mysqli_num_rows($qrefayto);

	if(strlen(trim($_POST['isla'])) == 0){
		$errors [] = "ISLA: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
	
	if (isset($_POST['id']) == $rowayto['id']){}
	elseif($counayto != 0){
		$errors [] = "AYUNTAMIENTO: <font color='#FF0000'>YA EXISTE.</font>";
		}
	if(strlen(trim($_POST['ayto'])) == 0){
		$errors [] = "AYUNTAMIENTO: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif(strlen(trim($vayto)) <= 5){
		$errors [] = "AYUNTAMIENTO: <font color='#FF0000'>Mas de 5 carácteres.</font>";
		}

	elseif(strlen(trim($_POST['ayto'])) >= 17){
		$errors [] = "AYUNTAMIENTO: <font color='#FF0000'>Menos de 17 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^#$&<>\(\)\[\]\{\}]+$/',$_POST['ayto'])){
		$errors [] = "AYUNTAMIENTO: <font color='#FF0000'>No Permitidos #$&<>()[]{}</font>";
		}


	if (isset($_POST['id']) == $rowrefayto['id']){}
	elseif($counrefayto != 0){
		$errors [] = "REF AYUNTAMIENTO: <font color='#FF0000'>YA EXISTE.</font>";
		}

	if(strlen(trim($_POST['refayto'])) == 0){
		$errors [] = "REF AYUNTAMIENTO: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif(strlen(trim($vrefayto)) <= 3){
		$errors [] = "REF AYUNTAMIENTO: <font color='#FF0000'>Mas de 3 carácteres.</font>";
		}

	elseif(strlen(trim($_POST['refayto'])) >= 5){
		$errors [] = "REF AYUNTAMIENTO: <font color='#FF0000'>Menos de 5 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^#$&<>\(\)\[\]\{\}]+$/',$_POST['refayto'])){
		$errors [] = "REF AYUNTAMIENTO: <font color='#FF0000'>No Permitidos #$&<>()[]{}</font>";
		}

?>