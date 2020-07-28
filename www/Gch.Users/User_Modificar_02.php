<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	require 'Inc_Header_Nav_Head.php';
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

/* OJO SOLO PARA VALIDATE.PHP
$sqld =  "SELECT * FROM `gch_admin` WHERE `ref` = '$_SESSION[uref]' AND `Usuario` = '$_SESSION[Usuario]'";
$qd = mysqli_query($db, $sqld);
$rowd = mysqli_fetch_assoc($qd);
*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if((@$_SESSION['uNivel'] == 'user')||(@$_SESSION['uNivel'] == 'adminu')){ 
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
												}
								} else { show_form(); }
				} else { require '../Gch.Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
		/*
		global $sqld;
		global $qd;
		global $rowd;
		*/
	
		require '../Gch.Inclu/validate.php';	
		
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
					<th colspan=3  class='BorderInf'>
						NUEVOS DATOS DEL USUARIO.
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
		<img src='../Gch.Img.User/".$_SESSION['myimgcl']."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>Apellidos:</td>
					<td>".$_POST['Apellidos']."</td>
				</tr>				
				
				<tr>
					<td>Tipo Documento:</td>
					<td>".$_POST['doc']."</td>
				</tr>				
				
				<tr>
					<td>N&uacute;mero:</td>
					<td>".$_POST['dni']."</td>
				</tr>				
				
				<tr>
					<td>Control:</td>
					<td>".$_POST['ldni']."</td>
				</tr>				
				
				<tr>
					<td>Mail:</td>
					<td colspan=2>".$_POST['Email']."</td>
				</tr>
				
				<tr>
					<td>Tipo Usuario</td>
					<td colspan=2>".$_POST['Nivel']."</td>
				</tr>
				
				<tr>
					<td>Referencia Usuario</td>
					<td colspan=2>".$_SESSION['refcl']."</td>
				</tr>
				
				<tr>
					<td>Usuario:</td>
					<td colspan=2>".$_POST['Usuario']."</td>
				</tr>
				
				<tr>
					<td>Password:</td>
					<td colspan=2>".$_POST['Password']."</td>
				</tr>
				
				<tr>
					<td>Dirección:</td>
					<td colspan=2>".$_POST['Direccion']."</td>
				</tr>
				
				<tr>
					<td>Teléfono 1:</td>
					<td colspan=2>".$_POST['Tlf1']."</td>
				</tr>
				
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
						<form name='closewindow' action='User_Modificar_01.php'  \">
							<input type='submit' value='VOLVER A ADMIN MODIFICAR' />
							<input type='hidden' name='volver' value=1 />
						</form>
					</td>
				</tr>
			</table>"; 

	if ($_SESSION['uNivel'] == 'adminu') {
		
	$sqlc = "UPDATE `$db_name`.`gch_admin` SET `Nivel` = '$_POST[Nivel]', `Nombre` = '$_POST[Nombre]', `Apellidos` = '$_POST[Apellidos]', `doc` = '$_POST[doc]', `dni` = '$_POST[dni]', `ldni` = '$_POST[ldni]', `Email` = '$_POST[Email]', `Usuario` = '$_POST[Usuario]', `Password` = '$_POST[Password]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$_POST[Tlf2]' WHERE `gch_admin`.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){ 	
		
	if (($_SESSION['dni'] == $_SESSION['mydni']) && ($_SESSION['uid'] == $_POST['id']) && ($_POST['dni'] != $_SESSION['mydni'])) { 	$_SESSION['dni'] = $_POST['dni'];
							// CREA EL ARCHIVO MYDNI.TXT $_SESSION['mydni'].
							$filename = "../Gch.Inclu/mydni.php";
							$fw2 = fopen($filename, 'w+');
							$mydni = '<?php $_SESSION[\'mydni\'] = '.$_POST['dni'].'; ?>';
							fwrite($fw2, $mydni);
							fclose($fw2);
										}
	elseif (($_SESSION['dni'] != $_SESSION['mydni']) && ($_SESSION['uid'] == $_POST['id']) && ($_POST['dni'] != $_SESSION['dni'])) { 
							$_SESSION['dni'] = $_POST['dni'];
					}else{ }
								 
					require '../Gch.Inclu/mydni.php';

				global $tabla;
				print( $tabla );

				} else {
				print("<font color='#FF0000'>
						* MODIFIQUE LA ENTRADA 206: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
							}
		
					} // FIN CONDICIONAL ADMIN
	
	elseif (($_SESSION['uNivel'] == 'useru') || ($_SESSION['uNivel'] == 'plusu')){
		
			$sqlc = "UPDATE `$db_name`.`gch_admin` SET `Nivel` = '$_POST[Nivel]', `Nombre` = '$_POST[Nombre]', `Apellidos` = '$_POST[Apellidos]', `Email` = '$_POST[Email]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$_POST[Tlf2]' WHERE `gch_admin`.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){ global $tabla;
								  print( $tabla );
				} else {
				print("<font color='#FF0000'>
						* MODIFIQUE LA ENTRADA 241: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
							}
					} // FIN CONDICIONAL USER / PLUS
	
 	} // FIN FUNCTION PROCESS_FORM

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
			
function show_form($errors=''){
	
			require '../Gch.Inclu/mydni.php';

	if($_POST['oculto2']){

				$_SESSION['refcl'] = $_POST['ref'];
				$_SESSION['myimgcl'] = $_POST['myimg'];
				
				global $dt;
				$dt = $_POST['doc'];
		
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
		
	if($_SESSION['uNivel'] == 'adminu'){
	
	print("<table align='center' border=0>

		<tr>
			<td colspan=2 class='BorderInf' align='center'>
				<img src='../Gch.Img.User/".$_POST['myimg']."' height='44px' width='33px' />
								INTRODUZCA LOS NUEVOS DATOS.
			</td>
		</tr>
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
		<input name='id' type='hidden' value='".$defaults['id']."' />					
		<input name='myimg' type='hidden' value='".$_POST['myimg']."' />	

		<tr>
			<td> REFERENCIA </td>
			<td>".$defaults['ref']."</td>			
		</tr>			

		<tr>
			<td>NOMBRE</td>
			<td>
		<input type='text' name='Nombre' size=30 maxlength=25 value='".$defaults['Nombre']."' />
			</td>	
		</tr>
		
		<tr>
			<td>APELLIDOS</td>
			<td>	
		<input type='text' name='Apellidos' size=30 maxlength=25 value='".$defaults['Apellidos']."' />
			</td>
		</tr>

		<tr>
			<td>EMAIL</td>
			<td>
			<input type='text' name='Email' size=30 maxlength=50 value='".$defaults['Email']."' />
			</td>
		</tr>
				
		<tr>
			<td>NIVEL </td>
			<td>".$defaults['Nivel']."</td>
		</tr>
					
		<tr>
			<td>USUARIO  </td>
			<td>".$defaults['Usuario']."</td>	
		</tr>
				
		<tr>
			<td>PASSWORD </td>
			<td>".$defaults['Password']."</td>
		</tr>

		<tr>
			<td>DIRECCIÓN</td>
			<td>
	<input type='text' name='Direccion' size=30 maxlength=60 value='".$defaults['Direccion']."' />
			</td>
		</tr>
				
		<tr>
			<td>TELEFONO</td>
			<td>
	<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
			</td>
		</tr>

		<tr>
			<td colspan=2 align='right'>
				<input type='submit' value='MODIFICAR DATOS' />
				<input type='hidden' name='modifica' value=1 />
			</td>
		</tr>
			</form>														
		</table>");

			} // FIN ELSE IF USER / PLUS
	
	elseif($_SESSION['uNivel'] == 'useru'){
	
		print("<table align='center' border=0>

		<tr>
			<td colspan=2 class='BorderInf' align='center'>
				<img src='../Gch.Img.User/".$_POST['myimg']."' height='44px' width='33px' />
								INTRODUZCA LOS NUEVOS DATOS.
			</td>
		</tr>
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
		<input name='id' type='hidden' value='".$defaults['id']."' />					
		<input name='myimg' type='hidden' value='".$_POST['myimg']."' />	

		<tr>
			<td> REFERENCIA </td>
			<td>".$defaults['ref']."</td>			
		</tr>			

		<tr>
			<td>NOMBRE</td>
			<td>
		<input type='text' name='Nombre' size=30 maxlength=25 value='".$defaults['Nombre']."' />
			</td>	
		</tr>
		
		<tr>
			<td>APELLIDOS</td>
			<td>	
		<input type='text' name='Apellidos' size=30 maxlength=25 value='".$defaults['Apellidos']."' />
			</td>
		</tr>

		<tr>
			<td>EMAIL</td>
			<td>
			<input type='text' name='Email' size=30 maxlength=50 value='".$defaults['Email']."' />
			</td>
		</tr>
				
		<tr>
			<td>NIVEL </td>
			<td>".$defaults['Nivel']."</td>
		</tr>
					
		<tr>
			<td>USUARIO  </td>
			<td>".$defaults['Usuario']."</td>	
		</tr>
				
		<tr>
			<td>PASSWORD </td>
			<td>".$defaults['Password']."</td>
		</tr>

		<tr>
			<td>DIRECCIÓN</td>
			<td>
	<input type='text' name='Direccion' size=30 maxlength=60 value='".$defaults['Direccion']."' />
			</td>
		</tr>
				
		<tr>
			<td>TELEFONO</td>
			<td>
	<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
			</td>
		</tr>

		<tr>
			<td colspan=2 align='right'>
				<input type='submit' value='MODIFICAR DATOS' />
				<input type='hidden' name='modifica' value=1 />
			</td>
		</tr>
			</form>														
		</table>");

			} // FIN ELSE IF USERU
	
	} // FIN FUNCTION SHOW_FOMR

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_02(){

	global $ruta;
	
	$ActionTime = date('H:i:s');
	
	if($_SESSION['refcl'] == $_SESSION['uref']){	global $ruta;
												$ruta = $_SESSION['refcl'];}
	elseif($_SESSION['refcl'] != $_SESSION['uref']){	global $ruta;
													$ruta = $_SESSION['uref'];}
	
	global $dir;
	$dir = "../Gch.Log";
	
	global $text;
	$text = PHP_EOL."- USER MODIFICADO ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t Ref: ".$_SESSION['uref'].PHP_EOL."\t Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].".\n\t Pass: ".$_POST['Password'].".\n\t ".$_POST['doc'].": ".$_POST['dni'].$_POST['ldni'].".\n\t Email: ".$_POST['Email'].PHP_EOL."\t Direccion: ".$_POST['Direccion'].PHP_EOL."\t Telefono 1: ".$_POST['Tlf1'].PHP_EOL."\t Telefono 2: ".$_POST['Tlf2'].PHP_EOL."\t Imagen: ".$_POST['myimg'];

	$logdocu = $ruta;
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_01(){

	global $texerror;

	global $orden;
	$orden = isset($_POST['Orden']);	

	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Gch.Log";
	
	global $text;
	$text = PHP_EOL."- USER MODIFICAR SELECCIONADO ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t Ref: ".$_POST['ref'].PHP_EOL."\t Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].".\n\t Pass: ".$_POST['Password'].".\n\t ".$_POST['doc'].": ".$_POST['dni'].$_POST['ldni'].".\n\t Email: ".$_POST['Email'].PHP_EOL."\t Direccion: ".$_POST['Direccion'].PHP_EOL."\t Telefono 1: ".$_POST['Tlf1'].PHP_EOL."\t Telefono 2: ".$_POST['Tlf2'].PHP_EOL."\t Imagen: ".$_POST['myimg'];

	$logdocu = $_SESSION['uref'];
	$logdate = date('Y_m_d');
	$logtext = $text.$texerror.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

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