<?php
session_start();
 
	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Inclu_Menu_00.php';
	require '../Gch.Inclu/mydni.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Gch.Inclu/Only.index.php';


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	desbloqueo();

	if(isset($_POST['oculto'])){
		if($form_errors = validate_form()){
						  suma_denegado();
					if(@$_SESSION['showf'] == 69){table_desblock();}
						else{show_form($form_errors);
							 show_visit();}
							}

		else {	process_form();
				ayear();
				ver_todo();
				suma_acces();
				}
	
	}// FIN POST OCULTO

	elseif (isset($_GET["page"])) { master_index();
									ver_todo();}

	elseif (isset($_GET['salir'])) { salir();
									 show_form();
									 show_visit();
									 session_destroy();
									}

	else{ if(@$_SESSION['showf'] == 69){table_desblock();}
					else{show_form();
						 show_visit();}
						 suma_visit();
						 bbdd_backup();
					}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function bbdd_backup(){
	
	global $db;
	global $db_name;
	
	global $dated;
	$dated = date('d');
	global $datem;
	$datem = date('m');
	global $datey;
	$datey = date('Y');
	global $datebbddx;
	$datebbddx = date("Ymd");
	
	// SI HAY MAS DE OCHO COPIAS DE SEGURIDAD BORRARLAS.
	global $ruta;
	$ruta ="../Gch.upbbdd/bbdd_export_tot";
	//print("RUTA: ".$ruta.".</br>");
	global $rutag;
	$rutag = "../Gch.upbbdd/bbdd_export_tot/{*}";
	//print("RUTA G: ".$rutag.".</br>");
	$directorio = opendir($ruta);
	global $num;
	$num=count(glob($rutag,GLOB_BRACE));
	
	if($num > 8){	if(file_exists($ruta)){ $dir = $ruta."/";
						$handle = opendir($dir);
						// Si el mes es distinto a Febrero y el dia 12
						if(($datem != 2)&&($dated == 12)){
							$name0 = $db_name.'_'.($datebbddx-6).'.sql';
							$name1 = $db_name.'_'.($datey.($datem-1).'30').'.sql';
							   	}
						// Si el mes es igual a Febrero y el día 12
						elseif(($datem == 2)&&($dated == 12)){
								$name0 = $db_name.'_'.($datebbddx-6).'.sql';
								$name1 = $db_name.'_'.($datey.($datem-1).'24').'.sql';
							   	}
						// Si el mes es distinto a Febrero y el día 6
						if(($datem != 2)&&($dated == 6)){
								$name0 = $db_name.'_'.($datey.($datem-1).'30').'.sql';
								$name1 = $db_name.'_'.($datey.($datem-1).'24').'.sql';
							   	}
						// Si el mes es igual a Febrero y el día 6
						elseif(($datem == 2)&&($dated == 6)){
								$name0 = $db_name.'_'.($datey.($datem-1).'24').'.sql';
								$name1 = $db_name.'_'.($datey.($datem-1).'18').'.sql';
							   	}
						else{	$name0 = $db_name.'_'.($datebbddx-6).'.sql';
								$name1 = $db_name.'_'.($datebbddx-12).'.sql';
							   	}
							   
		if(file_exists($dir.$name0)){copy($dir.$name0, "../Gch.upbbdd/temp/".$name0);}else{}
		if(file_exists($dir.$name1)){copy($dir.$name1, "../Gch.upbbdd/temp/".$name1);}else{}
		// Borra los archivos temporales
		while ($file = readdir($handle)){if (is_file($dir.$file)) {unlink($dir.$file);}}
			} else { }
		if(file_exists("../Gch.upbbdd/temp/".$name0)){rename("../Gch.upbbdd/temp/".$name0, $dir.$name0);}else{}
		if(file_exists("../Gch.upbbdd/temp/".$name1)){rename("../Gch.upbbdd/temp/".$name1, $dir.$name1);}else{}
		}

			////////////////////		**********  		////////////////////

	// SI EXISTE EL RESPALDO CORRESPONDIENTE A HOY NO HACER NADA.
	if(file_exists('../Gch.upbbdd/bbdd_export_tot/'.$db_name.'_'.$datebbddx.'.sql')){ }

	// DE LO CONTRARIO HACER EL RESPALDO.
	elseif(!file_exists('../Gch.upbbdd/bbdd_export_tot/'.$db_name.'_'.$datebbddx.'.sql')){
		if(($dated == "6") || ($dated == "12") || ($dated == "18") || ($dated == "24") || ($dated == "30")){ 
			require '../Gch.upbbdd/bbdd_export_tot.php';
			} else { }
	} // Fin del condicional que realiza el respaldo
	
} // Fin function respado automatico bbdd.

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function table_desblock(){
	
global $db_name;
global $table_desblock;
global $uip;
$uip = $_SERVER['REMOTE_ADDR'];

$table_desblock = print("<table align='center' style=\"margin-top:2px; margin-bottom:2px\" >
				<tr>
					<th colspan=2 width=100% valign=\"bottom\" class='BorderInf'>
						* IP ".$uip." BLOQUEADA HASTA LAS ".$_SESSION['desbloqh']."
					</th>
				</tr>
				<tr>
					<td colspan='2' align='center' valign='middle' class='BorderSup' style='padding-top: 10px'>
						<a href='../Gch.Inclu/desblock_ip.php'>
							FORMULARIO DESBLOQUEO IP
						</a>
					</td>
				</tr>
				<tr>
					<td colspan='2' align='center' valign='middle' class='BorderSup' style='padding-top: 10px'>
						<a href='Claves_Perdidas.php'>
							HE PERDIDO MIS CLAVES
						</a>
					</td>
				</tr>
				<tr>
					<td colspan='2' align='center' valign='middle' class='BorderSup' style='padding-top: 10px'>
						<a href='../Gch.Mail/index.php'  target='_blank'>
							WEBMASTER @ CONTACTO
						</a>
					</td>
				</tr>
			</table>");
	
			global $redir;
			// 600000 microsegundos 10 minutos
			// 60000 microsegundos 1 minuto
			$redir = "<script type='text/javascript'>
							function redir(){
							window.location.href='index.php';
						}
						setTimeout('redir()',600000);
						</script>";
			print ($redir);

}


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	global $db;
	global $db_name;
	/*
	$sqlp =  "SELECT * FROM `gch_admin` WHERE `Usuario` = '$_POST[Usuario]' AND `Password` = '$_POST[Password]'";
	$qp = mysqli_query($db, $sqlp);
	$rn = mysqli_fetch_assoc($qp);
	*/

	$errors = array();
	
		// global $sql;
		// global $q;
		global $row;
		
		if (strlen(trim($_POST['Usuario'])) == 0){
			//$errors [] = "Usuario: Campo obligatorio.";
			$errors [] = "USER ACCES ERROR";
			}

		elseif (strlen(trim($_POST['Password'])) == 0){
			//$errors [] = "Password: Campo Obligatorio:";
			$errors [] = "USER ACCES ERROR";
			}

		elseif(trim($_POST['Usuario']) != $row['Usuario']){
			//$errors [] = "Nombre o Password incorrecto.";
			$errors [] = "USER ACCES ERROR";
			}

		elseif(trim($_POST['Password']) != $row['Password']){
			//$errors [] = "Nombre o Password incorrecto.";
			$errors [] = "USER ACCES ERROR";
			}
		
		elseif ($row['Nivel'] == 'close'){
			$errors [] = "ACCESO RESTRINGIDO POR EL WEB MASTER";
			}
	
	return $errors;

		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){
	
	global $db;
	global $db_name;
					
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){				 
			//print("Wellcome: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
			master_index();
			admin_entrada();
	
		$sqlus = "SELECT * FROM $db_name.`gch_user` WHERE `Nivel` = 'adminu' ";
		$qus = mysqli_query($db, $sqlus);
		$countus = mysqli_num_rows($qus);
		if ($countus < 1){ echo "NO EXISTE NINGUN ADMINISTRADOR EN LA TABLA USUARIOS";}
		/* else {echo "NUMERO DE ADMINISTRADORES DE USUARIOS: ".$countus."<br>";} */
		

		}else { require '../Gch.Inclu/table_permisos.php'; }
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function desbloqueo(){
	
	require_once('../geo_class/geoplugin.class.php');
	$geoplugin = new geoPlugin();
	$geoplugin->locate();
	
	global $db;
	global $db_name;

	$date = date('Y/m/d');
	$time = date('H:i:s');
	$time1 = date('H');
	$time1 = ($time1+1).date(':i:s');

	// BORRO LAS ENTRADAS DEL DÍA ANTERIOR.
	$sdip =  "SELECT * FROM `$db_name`.`gch_ipcontrol` WHERE `date` <> '$date' ";
	$qdip = mysqli_query($db, $sdip);
	$cdip = mysqli_num_rows($qdip);
	if($cdip > 0){
	$sqlxd = "DELETE FROM `$db_name`.`gch_ipcontrol` WHERE `date` <> '$date' ";
	if(mysqli_query($db, $sqlxd)){
			// SI SE CUMPLE EL QUERY Y NO HAY DATOS EN LA TABLA LE PASO EL ID 1.
			$sx =  "SELECT * FROM `gch_ipcontrol` ";
			$qx = mysqli_query($db, $sx);
			$cx = mysqli_num_rows($qx);
				if($cx < 1){
				$sx1 = "ALTER TABLE `$db_name`.`gch_ipcontrol` AUTO_INCREMENT=1";
						if(mysqli_query($db, $sx1)){ }
						else { print("* MODIFIQUE LA ENTRADA L.1565: ".mysqli_error($db));}
							}
		} else {}
	}else{} // Fin borrado de las entradas del día anterior.
	
		// SELECCIONO LAS IPs == A LA MIA, BLOQUEADAS CON "ACCESO X".
	
	$sqlx =  "SELECT * FROM `gch_ipcontrol` WHERE `ipn` = '{$geoplugin->ip}' AND `acceso` = 'x' ORDER BY `id` ASC ";
	
	/*	
		// SELECCIONO LAS IPs == A LA MIA, BLOQUEADAS CON "ACCESO X".
	global $uip;
	$uip = $_SERVER['REMOTE_ADDR'];

	$sqlx =  "SELECT * FROM `gch_ipcontrol` WHERE `ipn` = '$uip' AND `acceso` = 'x' ORDER BY `id` ASC ";
	*/
	
	$qx = mysqli_query($db, $sqlx);
	$cx = mysqli_num_rows($qx);
	$rowx = mysqli_fetch_assoc($qx);
	$timex = date('Hi');
	
	// VERIFICO IP BLOQUEO DE LA IP
	if(($cx >= 1)&&($rowx['error'] > $timex)){ $_SESSION['showf'] = 69;}
	elseif((($cx >= 1)&&($rowx['error'] <= $timex))||((strlen(trim($rowx['error'] >= 3)))&&($rowx['error'] <= $timex))){ 
		
		// DESBLOQUEO TODAS LAS IPs IGUALES A LA MIA
	$desb = "UPDATE `$db_name`.`gch_ipcontrol` SET `error` = 'des', `acceso` = 'des' WHERE `gch_ipcontrol`.`ipn` = '{$geoplugin->ip}' ";

	/*
	$desb = "UPDATE `$db_name`.`gch_ipcontrol` SET `error` = 'des', `acceso` = 'des' WHERE `gch_ipcontrol`.`ipn` = '$uip' ";

	*/

	$_SESSION['showf'] = 0;	
	if(mysqli_query($db, $desb)){ } else { print("* ERROR ENTRADA 316: ".mysqli_error($db))."."; }
	} elseif($cx < 1) { $_SESSION['showf'] = 0; }	
	
	global $blocker;
	$blocker = $rowx['error'];
	if(strlen(trim($rowx['error'])) < 4){ $rowx['error'] = "0".$rowx['error'];}
	$dbloqh = substr($rowx['error'],0,2);
	$dbloqm = substr($rowx['error'],2,2);
	$_SESSION['desbloqh'] = $dbloqh.":".$dbloqm.":00";

	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function bloqueo(){
	
	require_once('../geo_class/geoplugin.class.php');
	$geoplugin = new geoPlugin();
	$geoplugin->locate();

	global $db;
	global $db_name;
	
	$date = date('Y/m/d');
	
	/*
	$time = date('H:i:s');
	$time1 = date('H');
	// BLOQUEA UNA HORA:
	//$time1 = ($time1+1).date(':i:s');
	//BLOQUEA UN MINUTO:
	$time1 = $time1.":".(date('i')+1).date(':s');
	*/

	// SELECCIONO LAS IPs == A LA MIA, CON MÁS DE TRES ACCESOS DENEGADOS.

	$sqlip =  "SELECT * FROM `gch_ipcontrol` WHERE `ipn` = '{$geoplugin->ip}' AND `error` = '1' AND `acceso` = '0' AND `date` = '$date' ORDER BY `id` DESC ";

	/*
	global $uip;
	$uip = $_SERVER['REMOTE_ADDR'];
	$sqlip =  "SELECT * FROM `gch_ipcontrol` WHERE `ipn` = '$uip' AND `error` = '1' AND `acceso` = '0' AND `date` = '$date' ORDER BY `id` DESC ";
	*/

	$qip = mysqli_query($db, $sqlip);
	global $cip;
	$cip = mysqli_num_rows($qip);
	$_SESSION['cip'] = $cip;
	
	$rowip = mysqli_fetch_assoc($qip);

	/*
	// CALCULO LA FECHA DE DESBLOQUEO.
	$bloqy = substr($rowip['date'],0,4);
	$bloqm = substr($rowip['date'],5,2);
	$bloqm = str_replace("/","0",$bloqm);
	$bloqd = substr($rowip['date'],-2);
	$bloqd = str_replace("/","0",$bloqd);
	$bloqd = $bloqd + 1;
	global $desbloq;
	$desbloq = $bloqy."/".$bloqm."/".$bloqd;
	*/	
	
	// CALCULO LA HORA DE DESBLOQUEO
	global $bloqh;
	$bloqh = substr($rowip['time'],0,2);
	$bloqh = str_replace(":","",$bloqh);
	/* BLOQUEA UNA HORA */
	$bloqh = $bloqh + 1;
	$bloqh = $bloqh;
	global $bloqm;
	$bloqm = substr($rowip['time'],3,2);
	$bloqm = str_replace(":","",$bloqm);
	/* MODIFICADO PARA DESBLOQUEAR EN UN MINUTO 
	$bloqm = $bloqm + 1; */
	$_SESSION['bloqh'] = $bloqh.$bloqm;
	if($_SESSION['bloqh'] >= 2300){$_SESSION['bloqh'] = 2359;}
	
	$_SESSION['ipid'] = $rowip['id'];
	
	/* 
	IMPRIMO LOS DATOS EN PANTALLA.
	print("** ACCESO DENEGADO ERRORES: ".$cip.".</br>- BBDD Id: ".$rowip['id']."</br>- BBDD Time: ".$rowip['time'].".</br>- Real Time: ".$time.".</br>- Real Time +1 ".$time1.".</br>- BBDD Date: ".$rowip['date'].".</br>- BBDD DesBloq: ".$desbloq.".");
	*/
	
	// MARCO LA ULTIMA ENTRADA ERROR CON "ERROR HORA BBDD+1" Y "ACCESO x" PARA BLOQUEAR LA IP
	if($_SESSION['cip'] >= 3){
	$emarc = "UPDATE `$db_name`.`gch_ipcontrol` SET `error` = '$_SESSION[bloqh]', `acceso` = 'x' WHERE `gch_ipcontrol`.`id` = '$_SESSION[ipid]' LIMIT 1 ";
			$_SESSION['showf'] = 69;
			global $bloqh;
			global $bloqm;
			if($_SESSION['bloqh'] >= 2300){$_SESSION['desbloqh'] = "23:59:00"; } 
			elseif(strlen(trim($_SESSION['bloqh'] <= 3))){  $_SESSION['desbloqh'] = "0".$bloqh.":".$bloqm.":00";}
			else{ $_SESSION['desbloqh'] = $bloqh.":".$bloqm.":00";}

		if(mysqli_query($db, $emarc)){ }else {print("* ERROR ENTRADA 95: ".mysqli_error($db)).".";}
	}else{ $_SESSION['showf'] = 0;}
		
} // FIN FUCNTION BLOQUEO

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){
	
	/*
	unset($_SESSION['usuarios']);
	unset($_SESSION['ref']);
	unset ($_SESSION['dni']);
	unset ($_SESSION['mydni']);
	*/
	
	global $db_name;
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {
				$defaults = array ('Usuario' => '',
								   'Password' => '');
								   }
	
	if ($errors){	
		print("<table align='center'>
					<!--
					<tr>
					<td style='text-align:center'>
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					<font color='#FF0000'>ERROR ACCESO USER</font>
					</td>
					</tr>
					-->
					<tr>
					<td style='text-align:left'>
					");

		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>".$errors [$a]."</font><br/>");
			}
		
		print("</td>
				</tr>
				</table>");
		}
	
	print("<table align='center' style=\"margin-top:2px; margin-bottom:2px; width=100%;\" >
				<tr>
					<th colspan=2 valign=\"bottom\" class='BorderInf'>
						SUS DATOS DE ACCESO
					</th>
				</tr>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td>	
						USUARIO
					</td>
					<td>
<input type='Password' name='Usuario' size=20 maxlength=50 value='".$defaults['Usuario']."' />
					</td>
				</tr>
	
				<tr>
					<td>	
						PASSWORD
					</td>
					<td>
<input type='Password' name='Password' size=20 maxlength=50 value='".$defaults['Password']."' />
					</td>
				</tr>
	
				<tr>
					<td valign='middle' align='right' colspan='2'>
						<input type='submit' value='ACCEDER' />
						<input type='hidden' name='oculto' value=1 />
		</form>	
					</td>
					
				</tr>
				
				<tr>
					<td colspan='2' align='center' valign='middle' class='BorderSup' style='padding-top: 10px'>
						<a href='Claves_Perdidas.php'>
							HE PERDIDO MIS CLAVES
						</a>
					</td>
				</tr>
				<tr>
					<td colspan='2' align='center' valign='middle' class='BorderSup' style='padding-top: 10px'>
						<a href='../Gch.Mail/index.php'  target='_blank'>
							WEBMASTER @ CONTACTO
						</a>
					</td>
				</tr>
			</table>
				"); 
	
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function admin_entrada(){

	global $db;
	global $db_name;
	global $userid;
	$userid = $_SESSION['id'];
	
	global $uservisita;
	$uservisita = $_SESSION['visitadmin'];
	$total = $uservisita + 1;
	
	global $datein;
	$datein = date('Y-m-d/H:i:s');

	$sqladin = "UPDATE `$db_name`.`gch_admin` SET `lastin` = '$datein', `visitadmin` = '$total' WHERE `gch_admin`.`id` = '$userid' LIMIT 1 ";
		
	if(mysqli_query($db, $sqladin)){
			// print("* ");
				} else {
				print("</br>
				<font color='#FF0000'>
		* FATAL ERROR funcion admin_entrada(): </font></br> ".mysqli_error($db))."
				</br>";
							}
					
global $datos;

//echo 	$_SESSION['ref'];
global $logtext;
$logtext = PHP_EOL."** INICIO SESION => ".$datein.PHP_EOL.".\t User Ref: ".$_SESSION['ref'].PHP_EOL.".\t User Name: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].PHP_EOL.$datos;

	require 'Inc_Log_Total.php';
	
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function suma_acces(){

	global $db;
	global $db_name;
	global $rowa;
	global $sumaacces;
	

	$sqla =  "SELECT * FROM `gch_visitasadmin`";
	$qa = mysqli_query($db, $sqla);
	$rowa = mysqli_fetch_assoc($qa);
	
	$_SESSION['acceso'] = $rowa['acceso'];
	
	$tota = $rowa['acceso'];

	global $sumaacces;
	$sumaacces = $tota + 1;

	$idv = 69;
	
	$sqla = "UPDATE `$db_name`.`gch_visitasadmin` SET `acceso` = '$sumaacces' WHERE `gch_visitasadmin`.`idv` = '$idv' LIMIT 1 ";

	if(mysqli_query($db, $sqla)){ print ('</br>');
													} 
				
				 else {
				print("<font color='#FF0000'>
						* Error: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."
						</br>");
						
							}

			////////////////////		**********  		////////////////////
	
	$date = date('Y/m/d');
	$time = date('H:i:s');
	global $uip;
	$uip = $_SERVER['REMOTE_ADDR'];

	$sqlip = "INSERT INTO `$db_name`.`gch_ipcontrol` (`ref`, `nivel`, `ipn`, `error`, `acceso`, `date`, `time`) VALUES ('$_SESSION[ref]', '$_SESSION[Nivel]', '$uip', '0', '1', '$date', '$time')";
	if(mysqli_query($db, $sqlip)){ } else { print("* MODIFIQUE LA ENTRADA L.457: ".mysqli_error($db));}

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function suma_denegado(){

	global $db;
	global $db_name;
	global $rowd;
	global $sumadeneg;
	
	$sqld =  "SELECT * FROM `gch_visitasadmin`";
	$qd = mysqli_query($db, $sqld);
	$rowd = mysqli_fetch_assoc($qd);
	
	$_SESSION['deneg'] = $rowd['deneg'];
	
	$dng = $rowd['deneg'];
	
	global $sumadeneg;
	$sumadeneg = $dng + 1;

	$idd = 69;
	
	$sqld = "UPDATE `$db_name`.`gch_visitasadmin` SET `deneg` = '$sumadeneg' WHERE `gch_visitasadmin`.`idv` = '$idd' LIMIT 1 ";

	if(mysqli_query($db, $sqld)){/*	print("	</br>");*/
		
				}  else {	print("<font color='#FF0000'>
									* Error: suma denegado</font>
									</br>
									&nbsp;&nbsp;&nbsp;".mysqli_error($db)."
									</br>");
								}
			////////////////////		**********  		////////////////////
	
	$date = date('Y/m/d');
	$time = date('H:i:s');
	global $uip;
	$uip = $_SERVER['REMOTE_ADDR'];

	$sqlip = "INSERT INTO `$db_name`.`gch_ipcontrol` (`ref`, `nivel`, `ipn`, `error`, `acceso`, `date`, `time`) VALUES ('anonimo', 'anonimo', '$uip', '1', '0', '$date', '$time')";
	if(mysqli_query($db, $sqlip)){ } else { print("* MODIFIQUE LA ENTRADA L.600: ".mysqli_error($db));}

	bloqueo();
	
	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_visit(){

	global $db;
	global $db_name;
	global $rowv;
	global $sumavisit;
	
	$sqlv =  "SELECT * FROM `gch_visitasadmin`";
	$qv = mysqli_query($db, $sqlv);
	
	$rowv = mysqli_fetch_assoc($qv);
	
	$_SESSION['admin'] = $rowv['admin'];
	
	$tot = $rowv['admin'];

	global $sumavisit;
	$sumavisit = $tot + 1;

	$idv = 69;
	
	if(mysqli_query($db, $sqlv)){
		print(" <table align='center'>
					
						<tr>	
							<td align='right'>
								<font color='#59746A'>
									VISITS:
								</font>
							</td>
							<td  align='right'>
								<font color='#59746A'>
														".$tot."
								</font>
							</td>
						</tr>
						
						<tr>
							<td align='right'>
								<font color='#59746A'>
									AUTHORIZED:
								</font>
							</td>
							<td align='right'>
								<font color='#59746A'>
														".$rowv['acceso']."
								</font>
							</td>
						</tr>

						<tr>
							<td align='right'>
								<font color='#59746A'>
									FORBIDDEN:
								</font>
							</td>
							<td align='right'>
								<font color='#59746A'>
														".$rowv['deneg']."
								</font>
							</td>
							
						</tr>
					</table>");
										} 
				
				 else {
				print("<font color='#FF0000'>
						* Error: show visit</font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."
						</br>");
						
							}

					}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function suma_visit(){

	global $db;
	global $db_name;
	global $rowv;
	global $sumavisit;
	

	$sqlv =  "SELECT * FROM `gch_visitasadmin`";
	$qv = mysqli_query($db, $sqlv);
	$rowv = mysqli_fetch_assoc($qv);
	
	$_SESSION['admin'] = $rowv['admin'];
	
	$tot = $rowv['admin'];

	global $sumavisit;
	$sumavisit = $tot + 1;

	$idv = 69;
	
	$sqlv = "UPDATE `$db_name`.`gch_visitasadmin` SET `admin` = '$sumavisit' WHERE `gch_visitasadmin`.`idv` = '$idv' LIMIT 1 ";

	if(mysqli_query($db, $sqlv)){
		/**/	print(" </br>");
										} 
				
				 else {
				print("<font color='#FF0000'>
						* Error: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db)."
						</br>");
						
							}
								}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $db;
	global $db_name;
	
	global $vname;
	$vname = "gch_art";
	$vname = "`".$vname."`";

	$result =  "SELECT * FROM $vname ";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 5;
	
	global $page;

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["page"])) {
		global $page;
        $page = $_GET["page"];
    }

    if (!$page) {
		global $page;
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * $nitem;
    }
    
    //calculo el total de paginas
	$total_pages = ceil($num_total_rows / $nitem);
	
	// CALCULO CUANTOS RESUSTALDOS DEL TOTAL EN LA PAGINACIÓN
	global $nres;
	$nres = $page * $nitem;
	if($nres < $num_total_rows){ 
								 $nres = $nres;}
	else{ $nres = $num_total_rows;}

    //pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
    echo '<h7>* Restaurantes: '.$nres.' de '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.'.</h7>';


	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname  ORDER BY `refart` ASC $limit";

	/*
	$sqlb =  "SELECT * FROM `gch_admin` WHERE `gch_admin`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
	*/
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("<font color='#FF0000'>Consulte L.587: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>");
									
				} else { 	
					
	print ("<div class=\"juancentra col-xs-12 col-sm-12 col-lg-6\" style=\"	vertical-align: top !important; margin-top: 6px;\">

			RESTAURANTES ".$nres." de ".$num_total_rows."<br>");
			
	while($rowb = mysqli_fetch_assoc($qb)){

	require '../Gch.Artic/Inclu_Name_Ref_to_Name.php';

	global $actionforma;
	$actionforma = "<form name='ver' action='../Gch.Artic/Art_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=520px,height=640px')\">";
	global $formbotona;
	$formbotona = "<div class='whiletotala'>
						<input type='submit' value='VER DETALLES' />
						<input type='hidden' name='oculto2' value=1 />
					</div>
				</form>";
	global $actionformb;
	$actionformb = "";
	global $formbotonb;
	$formbotonb = "";

	global $rut;
	$rut = "../Gch.Artic/";

	require '../Gch.Artic/Inc_Art_While_Total.php';

	} // FIN WHILE

		print("</div>");

		} 
	} 

    if ($total_pages > 1) {
        if ($page != 1) {
			echo '<div class="paginacion">
					<a href="access.php?page='.($page-1).'">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</div>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
				echo '<div class="paginacion">
						<a href="#">'.$page.'</a>
					</div>';
            } else {
				echo '<div class="paginacion">
						<a href="access.php?page='.$i.'">'.$i.'</a>
					</div>';
            }
        }

        if ($page != $total_pages) {
			echo '<div class="paginacion">
					<a href="access.php?page='.($page+1).'">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</div>';
			}
		}

	}	/* Final ver_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif(){
									   							
	$filename = "../Gch.Config/ayear.php";
	$fw1 = fopen($filename, 'r+');
	$contenido = fread($fw1,filesize($filename));
	fclose($fw1);
	
	$contenido = explode("\n",$contenido);
	$contenido[2] = "'' => 'YEAR',\n'".date('y')."' => '".date('Y')."',";
	$contenido = implode("\n",$contenido);
	
	//fseek($fw, 37);
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
	global $dat1;
	$dat1 = "\tMODIFICADO Y ACTUALIZADO ".$filename.".\n";
}

function modif2(){

	$filename = "../Gch.Config/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
	global $dat2;
	$dat2 = "\tMODIFICADO Y ACTUALIZADO ".$filename.".\n";
}


function ayear(){
	$filename = "../Gch.Config/year.txt";
	$fw2 = fopen($filename, 'r+');
	$fget = fgets($fw2);
	fclose($fw2);
	
	if($fget == date('Y')){
		/*print(" <div style='clear:both'></div>
				<div style='width:200px'>* EL AÑO ES EL MISMO </div>".date('Y')." == ".$fget );
		*/		}
	elseif($fget != date('Y')){ 
		print(" <div style='clear:both'></div>
				<div style='width:200px'>* EL AÑO HA CAMBIADO </div>"/*.date('Y')." != ".$fget */);
		modif();
		modif2();
		global $dat1;	global $dat2;	global $dat3;
		global $datos;
		$datos = $dat1.$dat2.$dat3."\n";
		}
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function salir() {	unset($_SESSION['id']);
						unset($_SESSION['Nivel']);
						unset($_SESSION['Nombre']);
						unset($_SESSION['Apellidos']);
						unset($_SESSION['doc']);
						unset($_SESSION['dni']);
						unset($_SESSION['ldni']);
						unset($_SESSION['Email']);
						unset($_SESSION['Usuario']);
						unset($_SESSION['Password']);
						unset($_SESSION['Direccion']);
						unset($_SESSION['Tlf1']);
						unset($_SESSION['Tlf2']);
						unset($_SESSION['nclient']);

						echo "YOU HAVE CLOSE SESSION";
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function master_index(){

		require '../Gch.Inclu/Master_Index_Admin_Var.php';
		require '../Gch.Inclu/Master_Index_Total.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	require '../Gch.Inclu/Inclu_Footer_01.php';
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>
