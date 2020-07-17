<?php

	global $db;
	global $dbname;

	// DEFINO LOS NOMBRES REALES DE LAS ISLAS Y LOS PUEBLOS
	if(isset($rowb['refisla'])){$isref = $rowb['refisla'];}
	elseif(strlen(trim(@$_POST['isla'])) == 0){$isref = @$_POST['refisla'];}
	elseif(!isset($rowb['refisla'])){$isref = @$_POST['isla'];}
	else{ }
	$sqlisna=  "SELECT * FROM `gcb_islas` WHERE `refisla` = '$isref'";
	$qisna = mysqli_query($db, $sqlisna);
	while($rowisna = mysqli_fetch_assoc($qisna)){
		global $islaname;
		$islaname = $rowisna['isla'];
	}// fin while probando

	if(isset($rowb['refayto'])){$ayref = $rowb['refayto'];}
	elseif(!isset($rowb['refayto'])){$ayref = @$_POST['ayto'];}
	else{ }
	$sqlayna=  "SELECT * FROM `gcb_aytos` WHERE `refayto` = '$ayref'";
	$qayna = mysqli_query($db, $sqlayna);
	while($rowayna = mysqli_fetch_assoc($qayna)){
		global $aytoname;
		$aytoname = $rowayna['ayto'];
	}// fin while probando

	// DEFINO LOS NOMBRES REALES DEL TIPO DE RESTAURANTE Y ESPECIALIDADES.accordion
	if(isset($rowb['reftipo'])){$tipref = $rowb['reftipo'];}
	elseif(!isset($rowb['reftipo'])){$tipref= @$_POST['tipo'];}
	else{ }
	$sqltip=  "SELECT * FROM `gcb_tipologia` WHERE `reftipo` = '$tipref'";
	$qtip = mysqli_query($db, $sqltip);
	while($rowtip = mysqli_fetch_assoc($qtip)){
		global $tipname;
		$tipname = $rowtip['tipo'];
	}

	if(isset($rowb['refespec1'])){$espec1ref = $rowb['refespec1'];}
	elseif(!isset($rowb['refespec1'])){$espec1ref = @$_POST['espec1'];}
	else{ }
	$sqlespec1=  "SELECT * FROM `gcb_especialidad` WHERE `refespec` = '$espec1ref'";
	$qespec1 = mysqli_query($db, $sqlespec1);
	while($rowespec1 = mysqli_fetch_assoc($qespec1)){
		global $espec1name;
		$espec1name = $rowespec1['espec'];
	}

	if(isset($rowb['refespec2'])){$espec2ref = $rowb['refespec2'];}
	elseif(!isset($rowb['refespec2'])){$espec2ref = @$_POST['espec2'];}
	else{ }
	$sqlespec2=  "SELECT * FROM `gcb_especialidad` WHERE `refespec` = '$espec2ref'";
	$qespec2 = mysqli_query($db, $sqlespec2);
	while($rowespec2 = mysqli_fetch_assoc($qespec2)){
		global $espec2name;
		$espec2name = $rowespec2['espec'];
	}

?>
