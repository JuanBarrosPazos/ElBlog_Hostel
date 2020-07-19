
<?php

if((isset($_POST['Usuario'])&&(isset($_POST['Password'])))){
	$sql =  "SELECT * FROM `gch_user` WHERE `Usuario` = '$_POST[Usuario]' AND `Password` = '$_POST[Password]'";
	$q = mysqli_query($db, $sql);
	global $row;
	$row = mysqli_fetch_assoc($q);
	global $countq;
	$countq = mysqli_num_rows($q);
	global $userid;
	global $uservisita;

	if($countq < 1){}
	else{
	$_SESSION['uid'] = $row['id'];
	$_SESSION['uref'] = $row['ref'];
	$_SESSION['uNivel'] = $row['Nivel'];
	$_SESSION['uNombre'] = $row['Nombre'];
	$_SESSION['uApellidos'] = $row['Apellidos'];
	$_SESSION['uEmail'] = $row['Email'];
	$_SESSION['uUsuario'] = $row['Usuario'];
	$_SESSION['uPassword'] = $row['Password'];
	$_SESSION['uDireccion'] = $row['Direccion'];
	$_SESSION['uTlf1'] = $row['Tlf1'];
	$_SESSION['ulastin'] = $row['lastin'];
	$_SESSION['ulastout'] = $row['lastout'];
	$_SESSION['uvisituser'] = $row['visituser'];

	$userid = $_SESSION['uid'];
	$uservisita = $_SESSION['uvisituser'];
		}
	}

?>