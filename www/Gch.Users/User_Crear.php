<?php
//session_start();

	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';
	require 'Inc_Header_Nav_Headu.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if(isset($_POST['oculto'])){
		if($form_errors = validate_form()){
				show_form($form_errors);
		} else { process_form(); }
	} else {show_form();}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	/*
		global $sqld;
		global $qd;
		global $rowd;
	*/
		
	require 'validate.php';	
		
	return $errors;

	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;
	
/*	REFERENCIA DE USUARIO	*/

if (preg_match('/^(\w{1})/',$_POST['Nombre'],$ref1)){	$rf1 = $ref1[1];
														$rf1 = trim($rf1);
														/*print($ref1[1]."</br>");*/
																					}
if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['Nombre'],$ref2)){	$rf2 = $ref2[2];
																$rf2 = trim($rf2);
																/*print($ref2[2]."</br>");*/
																						}
if (preg_match('/^(\w{1})/',$_POST['Apellidos'],$ref3)){	$rf3 = $ref3[1];
															$rf3 = trim($rf3);
																/*print($ref3[1]."</br>");*/
																						}
if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['Apellidos'],$ref4)){	$rf4 = $ref4[2];
																	$rf4 = trim($rf4);
																/*print($ref4[2]."</br>");*/
																						}

	global $rf;
	$rf = $rf1.$rf2.$rf3.$rf4.date('hms');
	$rf = trim($rf);
	$rf = strtolower($rf);

	$_SESSION['iniref'] = $rf;

	// CREA IMAGEN DE USUARIO.

	global $trf;
	$trf = $_SESSION['iniref'];
	global $carpetaimg;
	$carpetaimg = "../Gch.Img.User";
	global $new_name;
	$new_name = $trf.".png";
	copy("../Gch.Img.Sys/untitled.png", $carpetaimg."/".$new_name);

	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	global $db_name;

	$sql = "INSERT INTO `$db_name`.`user` (`ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`) VALUES ('$rf', '$_POST[Nivel]', '$_POST[Nombre]', '$_POST[Apellidos]', '$new_name', '$_POST[Email]', '$_POST[Usuario]', '$_POST[Password]', '$_POST[Direccion]', '$_POST[Tlf1]')";
		
	if(mysqli_query($db, $sql)){
		
	/*	$fil = "%".$rf."%";
		$pimg =  "SELECT * FROM `$db_name`.`user` WHERE `ref` = '$rf' ";
		$qpimg = mysqli_query($db, $pimg);
		$rowpimg = mysqli_fetch_assoc($qpimg);
		$_SESSION['dudas'] = $rowpimg['myimg'];
		global $dudas;
		$dudas = trim($_SESSION['dudas']);
		print("** ".$rowpimg['myimg']);
	*/
	print( "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=3 class='BorderInf'>
						SE HA REGISTRADO CON ESTOS DATOS.
					</th>
				</tr>
								
				<tr>
					<td width=150px>
						Nombre:
					</td>
					<td width=200px>"
						.$_POST['Nombre'].
					"</td>
					<td rowspan='5' align='center'>
				<img src='".$carpetaimg."/".$new_name."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						Apellidos:
					</td>
					<td>"
						.$_POST['Apellidos'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Mail:
					</td>
					<td colspan='2'>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tipo Usuario
					</td>
					<td colspan='2'>"
						.$_POST['Nivel'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Referencia Usuario
					</td>
					<td colspan='2'>"
						.$rf.
					"</td>
				</tr>
				
				<tr>
					<td>
						Usuario:
					</td>
					<td colspan='2'>"
						.$_POST['Usuario'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Password:
					</td>
					<td colspan='2'>"
						.$_POST['Password'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Pais:
					</td>
					<td colspan='2'>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Teléfono 1:
					</td>
					<td colspan='2'>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
						<form name='closewindow' action='$_SERVER[PHP_SELF]' onsubmit=\"window.close()\">
							<input type='submit' value='CERRAR VENTANA' />
							<input type='hidden' name='cerrar' value=1 />
						</form>
					</td>
				</tr>
			</table>");
			global $redir;
			$redir = "<script type='text/javascript'>
						function redir(){
							window.close();
								}
						setTimeout('redir()',6000);
					</script>";
			print ($redir);

	$datein = date('Y-m-d/H:i:s');
	
	global $dir;
	$dir = "../Gch.Log";

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = PHP_EOL."- CREADO NUEVO USUARIO ".$datein.PHP_EOL."\t User Ref: ".$rf.PHP_EOL."\t Name: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t User: ".$_POST['Usuario'].PHP_EOL."\t Pass: ".$_POST['Password'].PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	} else { print("</br>
				<font color='#FF0000'>
			* Estos datos no son validos, modifique esta entrada: </font></br> ".mysqli_error($db))."
				</br>";
				show_form ();
					}
		} // FIN FUNCTION PROCESS_FORM

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {$defaults = array ( 'Nombre' => '',
									'Apellidos' => '',
									'Nivel' => 'user',
									'ref' => '',
									'Email' => 'Solo letras minúsculas',
									'Usuario' => '',
									'Usuario2' => '',
									'Password' => '',
									'Password2' => '',
									'Direccion' => '',
									'Tlf1' => '',);
								   }
	
	if ($errors){
		print("	<table align='center'>
					<tr>
						<th style='text-align:center>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					</tr>
					<tr>
						<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
					}
		
////////////////////				////////////////////				////////////////////

	global $db;
	global $db_name;
	$nu =  "SELECT * FROM `$db_name`.`user` WHERE `user`.`dni` <> '$_SESSION[mydni]'";
		$user = mysqli_query($db, $nu);
		//$ruser = mysqli_fetch_assoc($user);
		$nuser = mysqli_num_rows($user);
	

	print("<table align='center' style=\"margin-top:4px\">
				<tr>
					<th colspan=2 class='BorderInf'>
							DATOS DEL NUEVO USUARIO
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
						
				<tr>
					<td width=130px>	
						<font color='#FF0000'>*</font>
						Ref User:
					</td>
					<td width=280px>
						SE GENERA LA CLAVE AUTO.
					</td>
				</tr>
					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						Nombre:
					</td>
					<td>
		<input type='text' name='Nombre' size=28 maxlength=25 value='".$defaults['Nombre']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Apellidos:
					</td>
					<td>
	<input type='text' name='Apellidos' size=28 maxlength=25 value='".$defaults['Apellidos']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Mail:
					</td>
					<td>
		<input type='text' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' />
					</td>
				</tr>	
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nivel Usuario:
					</td>
					<td>
	<input type='hidden' name='Nivel' value='".$defaults['Nivel']."' />".$defaults['Nivel']."
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nombre Usuario:
					</td>
					<td>
		<input type='text' name='Usuario' size=12 maxlength=10 value='".$defaults['Usuario']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme Usuario:
					</td>
					<td>
		<input type='text' name='Usuario2' size=12 maxlength=10 value='".$defaults['Usuario2']."' />
					</td>
				</tr>
							
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Password:
					</td>
					<td>
		<input type='text' name='Password' size=12 maxlength=10 value='".$defaults['Password']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme Password:
					</td>
					<td>
	<input type='text' name='Password2' size=12 maxlength=10 value='".$defaults['Password2']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Dirección:
					</td>
					<td>
	<input type='text' name='Direccion' size=52 maxlength=60 value='".$defaults['Direccion']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 1:
					</td>
					<td>
		<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
					</td>
				</tr>
				
				<tr>
					<td colspan='2'  align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='REGISTRAR CON ESTOS DATOS' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
				</tr>
		</form>														

				<tr>
					<td colspan=2 align='right' class='BorderSup'>
						<form name='closewindow' action='$_SERVER[PHP_SELF]' onsubmit=\"window.close()\">
							<input type='submit' value='CERRAR VENTANA' />
							<input type='hidden' name='cerrar' value=1 />
						</form>
					</td>
				</tr>
			</table>"); 
	
	} // FIN FUNCTION SHOW_FORM

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	

	require 'Inc_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
		
/* Creado por Juan Barros Pazos 2020 */
?>
