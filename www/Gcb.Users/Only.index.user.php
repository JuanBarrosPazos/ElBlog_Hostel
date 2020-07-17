
<?php

if((isset($_POST['Usuario'])&&(isset($_POST['Password'])))){
	$sql =  "SELECT * FROM `user` WHERE `Usuario` = '$_POST[Usuario]' AND `Password` = '$_POST[Password]'";
	$q = mysqli_query($db, $sql);
	global $row;
	$row = mysqli_fetch_assoc($q);
	global $countq;
	$countq = mysqli_num_rows($q);
	global $userid;
	global $uservisita;

	if($countq < 1){}
	else{
	$_SESSION['id'] = $row['id'];
	$_SESSION['ref'] = $row['ref'];
	$_SESSION['Nivel'] = $row['Nivel'];
	$_SESSION['Nombre'] = $row['Nombre'];
	$_SESSION['Apellidos'] = $row['Apellidos'];
	$_SESSION['Email'] = $row['Email'];
	$_SESSION['Usuario'] = $row['Usuario'];
	$_SESSION['Password'] = $row['Password'];
	$_SESSION['Direccion'] = $row['Direccion'];
	$_SESSION['Tlf1'] = $row['Tlf1'];
	$_SESSION['lastin'] = $row['lastin'];
	$_SESSION['lastout'] = $row['lastout'];
	$_SESSION['visituser'] = $row['visituser'];

	$userid = $_SESSION['id'];
	$uservisita = $_SESSION['visituser'];
		}
	}

?>