<?php
//session_start();

	//require 'error_hidden.php';
	require 'Admin_Inclu_01b.php';
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

		if(isset($_POST['oculto'])){
			if($form_errors = validate_form()){
												
					show_form($form_errors);
										
					} else {print("<table align='center' style=\"margin-top:20px\">
									<tr>
										<td>
											<font color='#0080C0'>
												SE HA PROCESADO SU PETICION CORRECTAMENTE.
											</font>
										</td>
									</tr>
								</table>
				<embed src='../Gch.audi/ip_confirm_unlock.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
				</embed>
					");
											
					process_form();
											}
					}	/* Fin del if $_POST['oculto']*/
										
			elseif(isset($_POST['oculto2'])){ desbloqueo(); }
			else {show_form();}
												

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

 function validate_form(){
	 
	global $sql;
	global $q;
	global $row;
	global $db;
	global $db_name;
		
$sql =  "SELECT * FROM `$db_name`.`gch_admin` WHERE `Email` = '$_POST[Email]' AND `dni` = '$_POST[dni]' AND `ldni` = '$_POST[ldni]' ";
 	
	$q = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($q);
	$_SESSION['L_Email'] = $row['Email'];
	$_SESSION['L_dni'] = $row['dni'];
	$_SESSION['L_ldni'] = $row['ldni'];

	 $errors = array();
		
	if (($row['Nivel'] == 'close')||($row['Nivel'] == 'user')){
		$errors [] = "ACCESO RESTRINGIDO POR EL WEB MASTER";
		}
	 
	 /* Validamos el campo mail. */
	
	elseif(strlen(trim($_POST['Email'])) == 0){
		/*$errors [] = "Mail: <font color='#FF0000'>CAMPO OBLIGATORIO.</font>";*/
		$errors [] = "@ / Nº / LETRA";
		}
	
	elseif (strlen(trim($_POST['Email'])) < 5 ){
		/*$errors [] = "Mail: <font color='#FF0000'>MÁS DE 5 CARÁCTERES.</font>";*/
		$errors [] = "@ / Nº / LETRA";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/',$_POST['Email'])){
		/*$errors [] = "Mail: <font color='#FF0000'>@ NO VÁLIDO</font>";*/
		$errors [] = "@ / Nº / LETRA";
		}
		
	/* Validamos el campo dni */
	
	elseif(strlen(trim($_POST['dni'])) == 0){
		/*$errors [] = "Nº DNI: <font color='#FF0000'>CAMPO OBLIGATORIO.</font>";*/
		$errors [] = "@ / Nº / LETRA";
		}
	
	elseif (!preg_match('/^[A-Z\d]+$/',$_POST['dni'])){
		/*$errors [] = "Nº DNI: <font color='#FF0000'>SÓLO NÚMEROS O LETRAS MAYÚSCULAS</font>";*/
		$errors [] = "@ / Nº / LETRA";
		}

	elseif (strlen(trim($_POST['dni'])) < 8){
		/*$errors [] = "Nº DNI: <font color='#FF0000'>MAS DE 7 DÍGITOS</font>";*/
		$errors [] = "@ / Nº / LETRA";
		}

	/* Validamos el campo ldni */
	
	elseif(strlen(trim($_POST['ldni'])) == 0){
		/*$errors [] = "Letra DNI: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";*/
		$errors [] = "@ / Nº / LETRA";
		}
	
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['ldni'])){
		/*$errors [] = "Letra DNI: <font color='#FF0000'>SÓLO TEXTO</font>";*/
		$errors [] = "@ / Nº / LETRA";
		}

	elseif (!preg_match('/^[^a-z]+$/',$_POST['ldni'])){
		/*$errors [] = "Letra DNI: <font color='#FF0000'>SÓLO MAYÚSCULAS</font>";*/
		$errors [] = "@ / Nº / LETRA";
		}

	/* Realizamos un condicional de validacion de campos Nombre y dni.*/
		
	elseif(trim($_POST['Email'] != $_SESSION['L_Email'])){
		$errors [] = "@ / Nº / LETRA";
		}
		
	elseif(trim($_POST['dni'] != $_SESSION['L_dni'])){
		$errors [] = "@ / Nº / LETRA";
		} 
		
	elseif(trim($_POST['ldni'] != $_SESSION['L_ldni'])){
		$errors [] = "@ / Nº / LETRA";
		} 
	 
	return $errors;
	 
 			}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){
	
	global $sql;
	global $q;
	global $row;
	
	if(isset($_POST['oculto2'])){
				$defaults = array (	'Asunto' => 'FORMULARIO DESBLOQUEO IP.',
									'Email' => $_POST['Email'],
									'dni' => $_POST['dni'],	
									'ldni' => $_POST['ldni']);
								   }
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {
				$defaults = array (	'Asunto' => 'FORMULARIO DESBLOQUEO IP.',
									'Email' => '',
									'dni' => '',
									'ldni' => isset($_POST['ldni']));
									}
	
	if ($errors){
		print("<table align='center'>
					<tr>
						<td style='text-align:center'>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</td>
					</tr>
					<tr>
						<td style='text-align:left'>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>* </font>".$errors [$a]."<br/>	");
				}
				print("</td>
						 </tr>
		<embed src='../Gch.audi/user_lost.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
		</embed>
				</table>");

		}elseif(isset($_POST['oculto2']) != 1){
		print("<embed src='../Gch.audi/ip_unlock_form.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' ></embed>");
				}
	
	print("<table align='center' style=\"border:0px;margin_bottom:6px;margin-top:2px\">
				<tr>
			<form name='Perdidos' method='post' action='$_SERVER[PHP_SELF]'>
					<th colspan=2>
		<input name='Asunto' type='hidden' value='".$defaults['Asunto']."' />".$defaults['Asunto']."
					</th>
				</tr>

				<tr>
					<td>	
						Su E Mail:
					</td>
					<td>
		<input type='text' name='Email' size=30 value='".$defaults['Email']."' />
					</td>
				</tr>
	
				<tr>
					<td>	
						Su DNI:
					</td>
					<td>
		<input type='text' name='dni' size=30 maxlength=8 value='".$defaults['dni']."' />
					</td>
				</tr>
	
				<tr>
					<td>	
						Su Letra DNI:
					</td>
					<td>
		<input type='text' name='ldni' size=30 maxlength=1 value='".$defaults['ldni']."' />
					</td>
				</tr>
				
				<tr align='center'>
				
					<td colspan='2' align='center'>
		<input type='submit' value='SOLICITAR DEBLOQUEO DE SU IP' />
		<input type='hidden' name='oculto' value=1 />
					</td>
		</form>	
				</tr>
				
				<tr>
					<td colspan='2' align='center'>
						<a href='../Gch.Admin/access.php'>
							VOLVER A ADMIN ACCESS
						</a>
					</td>
				</tr>
		</table>"); /* Fin del print */

	}	/* Fin de la función show_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;
	

	// print ("* ".$_POST['Email']." / ".$_POST[dni].$_POST[ldni].". ".$_SESSION['refdesb']." / ".$_SESSION['nivdesb']);
	
	$sqlc =  "SELECT * FROM `$db_name`.`gch_admin` WHERE `Email` = '$_POST[Email]' AND `dni` = '$_POST[dni]' AND `ldni` = '$_POST[ldni]' ";
	$qc = mysqli_query($db, $sqlc);
	$rowqc = mysqli_fetch_assoc($qc);
	$_SESSION['refdesb'] = $rowqc['ref'];
	$_SESSION['nivdesb'] = $rowqc['Nivel'];
	
	if(!$qc){	print("Se ha producido un error: ".mysqli_error($db)."<br/><br/>");
			
		} else {	if(mysqli_num_rows($qc) == 0){
					print ("No hay datos.");
							
		} else { print ("
			<table align='center' style=\"border:0px;margin_bottom:4px;margin-top:4px\">
		<tr>
			<td colspan=2 align='center'>
						SUS DATOS DE USUARIO
			</td>
		</tr>
		<tr>
			<td colspan=2 align='center'>
				<img src='../Gch.Img.Admin/".$rowqc['myimg']."' height='60px' width='45px' />
			</td>
		</tr>
		<tr>
			<td colspan=2 align='center'>
				".$rowqc['Nombre']." ".$rowqc['Apellidos'].".
			</td>
		</tr>
		<tr>
			<td colspan=2 align='center'>
			<form name='modifica' action='$_SERVER[PHP_SELF]' method='POST'>
				<input type='submit' value='DESBLOQUEAR SU IP' />
				<input type='hidden' name='oculto2' value=1 />
				<input type='hidden' name='refdesb' value=".$rowqc['ref']." />
				<input type='hidden' name='nivdesb' value=".$rowqc['Nivel']." />
			</form>
			</td>
		</tr>
		<tr>
			<td colspan=2 align='center'>
			<form name='fcancel' method='post' action='$_SERVER[PHP_SELF]' >
						<input type='submit' value='CANCELAR Y VOLVER' />
						<input type='hidden' name='cancel' value=1 />
			</form>
			</td>
		</tr>
		</table>");
								} /* Fin segundo else anidado en if */
							} /* Fin de primer else . */
	}	/* Final de la función process_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function desbloqueo(){
	
	require_once('../geo_class/geoplugin.class.php');
	$geoplugin = new geoPlugin();
	$geoplugin->locate();
	
	global $db;
	global $db_name;

	/*
		<input type='hidden' name='refdesb' value=".$rowqc['ref']." />
		<input type='hidden' name='nivdesb' value=".$rowqc['Nivel']." />
	*/
	
	// DESBLOQUEO TODAS LAS IPs IGUALES A LA MIA
	$desb = "UPDATE `$db_name`.`gch_ipcontrol` SET `ref` = '$_POST[refdesb]', `nivel` = '$_POST[nivdesb]', `error` = 'des', `acceso` = 'des' WHERE `gch_ipcontrol`.`ipn` = '{$geoplugin->ip}' AND `gch_ipcontrol`.`acceso` = 'x' OR `gch_ipcontrol`.`acceso` = '0' ";
	if(mysqli_query($db, $desb)){ $_SESSION['showf'] = 0;
								print("<table align='center' style=\"margin-top:2px; margin-bottom:2px\" >
											<tr>
												<td align='center'>
													SU IP {$geoplugin->ip} HA SIDO DESBLOQUEADA
												</td>
											</tr>
											<tr>
												<td align='center'>
													<a href='../Gch.Admin/access.php'>
														VOLVER A ADMIN ACCESS
													</a>
												</td>
											</tr>
										</table>
				<embed src='../Gch.audi/ip_unlocked_ok.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
				</embed>");
								 
		 	global $redir;
			$redir = "<script type='text/javascript'>
							function redir(){
							window.location.href='../Gch.Admin/access.php';
						}
						setTimeout('redir()',4000);
						</script>";
			print ($redir);

		} else { print("* ERROR ENTRADA 294: ".mysqli_error($db))."."; }
	
}
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	require 'Admin_Inclu_02.php';

					   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>
