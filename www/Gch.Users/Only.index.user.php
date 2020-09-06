
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

	global $userid;
	$userid = $_SESSION['uid'];
	global $uservisita;
	$uservisita = $_SESSION['uvisituser'];

	user_entrada();

		}
	}


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function user_entrada(){

	global $db;
	global $db_name;
	global $userid;
	$userid = $_SESSION['uid'];
	
	global $uservisita;
	$uservisita = $_SESSION['uvisituser'];
	$total = $uservisita + 1;
	
	global $datein;
	$datein = date('Y-m-d/H:i:s');

	$sqladin = "UPDATE `$db_name`.`gch_user` SET `lastin` = '$datein', `visituser` = '$total' WHERE `gch_user`.`id` = '$userid' LIMIT 1 ";
		
	if(mysqli_query($db, $sqladin)){
			// print("* ");
				} else {
				print("</br>
				<font color='#FF0000'>
		* FATAL ERROR funcion admin_entrada(): </font></br> ".mysqli_error($db))."
				</br>";
							}
					
	global $dir;
	$dir = "../Gch.Log";

	global $datos;
	global $logdocu;
	$logdocu = $_SESSION['uref'];
	global $logdate;
	$logdate = date('Y_m_d');
	//echo 	$_SESSION['ref'];
	global $logtext;
	$logtext = PHP_EOL."** INICIO SESION => ".$datein;
	$logtext = $logtext.PHP_EOL.".\t User Ref: ".$_SESSION['uref'];
	$logtext = $logtext.PHP_EOL.".\t User Name: ".$_SESSION['uNombre']." ".$_SESSION['uApellidos'];
	$logtext = $logtext.PHP_EOL.$datos;

	global $filename;
	global $log;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	//echo $filename;
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


?>