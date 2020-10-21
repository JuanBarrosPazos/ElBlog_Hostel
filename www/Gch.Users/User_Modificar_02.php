<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	global $headtot;
	$headtot = "head";
	require 'Inc_Header_Nav_Head_Total.php';
	//require 'Inc_Header_Nav_Head.php';
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if((@$_SESSION['uNivel'] == 'useru')||(@$_SESSION['uNivel'] == 'adminu')||($_SESSION['Nivel'] == 'admin')){ 
		if (isset($_POST['oculto2'])){
			show_form();
			info_01();
			}
		elseif($_POST['modifica']){
				if($form_errors = validate_form()){
					show_form($form_errors);
							} else {
							process_form();
							info_02();
							unset($_SESSION['refcl']);
							global $redir;
							$redir = "<script type='text/javascript'>
										function redir(){
										window.location.href='User_Modificar_01.php';
								}
								setTimeout('redir()',6000);
								</script>";
							print ($redir);
							}
			} else { show_form(); }
	} else { require '../Gch.Inclu/table_permisos.php';
			 //require 'Inc_Footer.php';
			 //require '../Gch.Www/Inc_Jquery_Boots_Foot.php';
			 }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
		require 'validate.php';	
		
		return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;

	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	global $tabla;							 
	$tabla = "<table align='center' style=\"margin-top:20px\">
				<tr>
					<td colspan=3  class='BorderInf' align='center'>
						NUEVOS DATOS DEL USUARIO.
					</td>
				</tr>
				
				<tr>
					<td width=120px>
						NOMBRE
					</td>
					<td width=160px>"
						.$_POST['Nombre'].
					"</td>
					<td rowspan='4' align='center'>
		<img src='../Gch.Img.User/".$_SESSION['myimgcl']."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>APELLIDOS</td>
					<td>".$_POST['Apellidos']."</td>
				</tr>				
				
				<tr>
					<td>MAIL</td>
					<td>".$_POST['Email']."</td>
				</tr>
				
				<tr>
					<td>NIVEL</td>
					<td>".$_POST['Nivel']."</td>
				</tr>
				
				<tr>
					<td>USER REF</td>
					<td colspan=2>".$_SESSION['refcl']."</td>
				</tr>
				
				<tr>
					<td>USER</td>
					<td colspan=2>".$_POST['Usuario']."</td>
				</tr>
				
				<tr>
					<td>PASSWORD</td>
					<td colspan=2>".$_POST['Password']."</td>
				</tr>
				
				<tr>
					<td>DIRECCION</td>
					<td colspan=2>".$_POST['Direccion']."</td>
				</tr>
				
				<tr>
					<td>TELEFONO</td>
					<td colspan=2>".$_POST['Tlf1']."</td>
				</tr>
				
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
						<form name='closewindow' action='User_Modificar_01.php'  \">
							<input type='submit' value='VOLVER' />
							<input type='hidden' name='volver' value=1 />
						</form>
					</td>
				</tr>
			</table>"; 

	if (($_SESSION['uNivel'] == 'adminu')||($_SESSION['uNivel'] == 'useru')||($_SESSION['Nivel'] == 'admin')) {
		
	$sqlc = "UPDATE `$db_name`.`gch_user` SET `Nombre` = '$_POST[Nombre]', `Apellidos` = '$_POST[Apellidos]', `Email` = '$_POST[Email]', `Usuario` = '$_POST[Usuario]', `Password` = '$_POST[Password]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]' WHERE `gch_user`.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){ 	
		
				global $tabla;
				print( $tabla );

				} else {
				print("<font color='#FF0000'>
						* MODIFIQUE LA ENTRADA 141: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
						global $texerror;
						$texerror = "ERROR MODIFICAR USER L.141\n\t ".mysqli_error($db);
							}
		
		} // FIN CONDICIONAL ADMIN
		else { }
	
 	} // FIN FUNCTION PROCESS_FORM

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
			
function show_form($errors=''){
	
	if($_POST['oculto2']){

		$_SESSION['refcl'] = $_POST['ref'];
		$_SESSION['myimgcl'] = $_POST['myimg'];
			
		$defaults = array ( 'id' => $_POST['id'],
							'ref' => $_POST['ref'],
							'Nombre' => $_POST['Nombre'],
							'Apellidos' => $_POST['Apellidos'],
							'myimg' => $_SESSION['myimgcl'],
							'Nivel' => $_POST['Nivel'],			
							'Email' => $_POST['Email'],
							'Usuario' => $_POST['Usuario'],
							'Usuario2' => $_POST['Usuario'],
							'Password' => $_POST['Password'],
							'Password2' => $_POST['Password'],
							'Direccion' => $_POST['Direccion'],
							'Tlf1' => $_POST['Tlf1']);
												}
								   
		elseif($_POST['modifica']){
			
			$defaults = array ( 'id' => $_POST['id'],
								'ref' => $_SESSION['refcl'],
								'Nombre' => $_POST['Nombre'],
								'Apellidos' => $_POST['Apellidos'],
								'myimg' => $_SESSION['myimgcl'],
								'Nivel' => $_POST['Nivel'],						
								'Email' => $_POST['Email'],
								'Usuario' => $_POST['Usuario'],
								'Usuario2' => $_POST['Usuario2'],
								'Password' => $_POST['Password'],
								'Password2' => $_POST['Password2'],
								'Direccion' => $_POST['Direccion'],
								'Tlf1' => $_POST['Tlf1']);
												}
	
	if ($errors){
		print("<table align='center'>
					<tr>
						<th style='text-align:center'>
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
		
	if((@$_SESSION['uNivel'] == 'adminu')||(@$_SESSION['uNivel'] == 'useru')||(@$_SESSION['Nivel'] == 'admin')){
	
	print("<div class=\"juancentramail\" style=\"margin-top:4px; width: 70vw !important; max-width: 440px\">
	
			<div align='right' class='BorderSup BorderInf'>
				<form name='closewindow' action='User_Modificar_01.php'>
					<input type='submit' value='CANCELAR Y VOLVER' />
					<input type='hidden' name='volver' value=1 />
				</form>
			</div>

		<div class='BorderInf' align='center'>
			<img src='../Gch.Img.User/".$_POST['myimg']."' height='44px' width='33px' />
						INTRODUZCA LOS NUEVOS DATOS.
		</div>
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
		<input type='hidden' name='id' value='".$defaults['id']."' />					
		<input type='hidden' name='myimg' value='".$_POST['myimg']."' />	

		<label style=\"width:96px;\">REFERENCIA</label>			
		<input type='hidden' name='ref' value='".$defaults['ref']."' />".$defaults['ref']."

		<div style='clear:both'></div>

		<label style=\"width:90px;\">NOMBRE</label>
		<input type='text' name='Nombre' size=30 maxlength=25 value='".$defaults['Nombre']."' />
		
		<label style=\"width:90px;\">APELLIDOS</label>
		<input type='text' name='Apellidos' size=30 maxlength=25 value='".$defaults['Apellidos']."' />

		<label style=\"width:90px;\">EMAIL</label>
		<input type='text' name='Email' size=30 maxlength=50 value='".$defaults['Email']."' />
				
		<label style=\"width:96px;\">NIVEL</label>
		<input name='Nivel' type='hidden' value='".$defaults['Nivel']."' />".$defaults['Nivel']."

		<div style='clear:both'></div>

		<label style=\"width:140px;\">USER</label>
		<input type='text' name='Usuario' size=12 maxlength=10 value='".$defaults['Usuario']."' />
				
		<div style='clear:both'></div>

		<label style=\"width:140px;\">USER REPEAT</label>
		<input type='text' name='Usuario2' size=12 maxlength=10 value='".$defaults['Usuario2']."' />
							
		<div style='clear:both'></div>

		<label style=\"width:140px;\">PASSWORD</label>
		<input type='text' name='Password' size=12 maxlength=10 value='".$defaults['Password']."' />

		<div style='clear:both'></div>

		<label style=\"width:140px;\">PASSWORD REPEAT</label>
	<input type='text' name='Password2' size=12 maxlength=10 value='".$defaults['Password2']."' />

	<div style='clear:both'></div>

		<label style=\"width:90px;\">DIRECCIÓN</label>
		<input type='text' name='Direccion' size=30 maxlength=60 value='".$defaults['Direccion']."' />
				
		<label style=\"width:90px;\">TELEFONO</label>
	<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />

			<div align='right' class='BorderSup'>
				<input type='submit' value='MODIFICAR DATOS' />
				<input type='hidden' name='modifica' value=1 />
			</div>
		</form>														
		
			<div align='right' class='BorderSup BorderInf'>
				<form name='closewindow' action='User_Modificar_01.php'>
					<input type='submit' value='CANCELAR Y VOLVER' />
					<input type='hidden' name='volver' value=1 />
				</form>
			</div>
	</div>");

	} else{ }
	
	} // FIN FUNCTION SHOW_FOMR

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_02(){

	global $texerror;

	$ActionTime = date('H:i:s');
	
	global $logtext;
	$logtext = PHP_EOL."- USER WEB MODIFICADO ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t Ref: ".$_POST['ref'].PHP_EOL."\t Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].".\n\t Pass: ".$_POST['Password'].".\n\t Email: ".$_POST['Email'].PHP_EOL."\t Direccion: ".$_POST['Direccion'].PHP_EOL."\t Telefono 1: ".$_POST['Tlf1'].PHP_EOL."\t Imagen: ".$_POST['myimg'].PHP_EOL.$texerror.PHP_EOL;

    require 'Inc_Log_Total.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_01(){

	$ActionTime = date('H:i:s');

	global $logtext;
	$logtext = PHP_EOL."- USER WEB MODIFICAR SELECCIONADO ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t Ref: ".$_POST['ref'].PHP_EOL."\t Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].".\n\t Pass: ".$_POST['Password'].".\n\t Email: ".$_POST['Email'].PHP_EOL."\t Direccion: ".$_POST['Direccion'].PHP_EOL."\t Telefono 1: ".$_POST['Tlf1'].PHP_EOL."\t Imagen: ".$_POST['myimg'].PHP_EOL;

    require 'Inc_Log_Total.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require 'Inc_Footer.php';

	require '../Gch.Www/Inc_Jquery_Boots_Foot.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2020 */
?>