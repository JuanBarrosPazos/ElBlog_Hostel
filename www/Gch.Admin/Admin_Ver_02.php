<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_popup.php';
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){
				
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
							
				if($_POST['oculto2']){	process_form();
										info();
											} 
				} else { require '../Gch.Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	print("<table align='center' width='auto'>
				<tr>
					<th colspan=3  class='BorderInf'>
						DATOS DEL USUARIO
					</th>
				</tr>
				
				<tr>
					<td align='right' width=110px>
						ID:
					</td>
					<td align='left'>"
						.$_POST['id'].
					"</td>
					<td rowspan='5' align='right' width='120px'>
	<img src='../Gch.Img.Admin/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td align='right'>
						Nivel:
					</td>
					<td align='left'>"
						.$_POST['Nivel'].
					"</td>
				</tr>
				
				<tr>
					<td align='right'>
						Referencia:
					</td>
					<td align='left'>"
						.$_POST['ref'].
					"</td>
				</tr>
				
				<tr>
					<td align='right'>
						Nombre:
					</td>
					<td align='left'>"
						.$_POST['Nombre'].
					"</td>
				</tr>
				
				<tr>
					<td align='right'>
						Apellidos:
					</td>
					<td align='left'>"
						.$_POST['Apellidos'].
					"</td>
				</tr>				
				
				<tr>
					<td align='right'>
						Documento:
					</td>
					<td align='left'>"
						.$_POST['doc'].
					"</td>
				</tr>				
				
				<tr>
					<td align='right'>
						N&uacute;mero:
					</td>
					<td align='left' colspan='2'>"
						.$_POST['dni'].
					"</td>
				</tr>				
				
				<tr>
					<td align='right'>
						Control:
					</td>
					<td align='left' colspan='2'>"
						.$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td align='right'>
						Mail:
					</td>
					<td align='left' colspan='2'>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
					<td align='right'>
						Usuario:
					</td>
					<td align='left' colspan='2'>"
						.$_POST['Usuario'].
					"</td>
				</tr>
				
				<tr>
					<td align='right'>
						Password:
					</td>
					<td align='left' colspan='2'>"
						.$_POST['Password'].
					"</td>
				</tr>
				
				<tr>
					<td align='right'>
						Direcci&oacute;n:
					</td>
					<td align='left' colspan='2'>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td align='right'>
						Tel&eacute;fono 1:
					</td>
					<td align='left' colspan='2'>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td align='right'>
						Tel&eacute;fono 2:
					</td>
					<td align='left' colspan='2'>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
				
				<tr>
					<td align='right'>
						Last IN:
					</td>
					<td align='left' colspan='2'>"
						.$_POST['lastin'].
					"</td>
				</tr>
				
				<tr>
					<td align='right'>
						Last Out:
					</td>
					<td align='left' colspan='2'>"
						.$_POST['lastout'].
					"</td>
				</tr>
				
				<tr>
					<td align='right'>
						Nº Visitas:
					</td>
					<td align='left' colspan='2'>"
						.$_POST['visitadmin'].
					"</td>
				</tr>
				
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
			</table>"); 

		}
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $nombre;
	global $apellido;
		
	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');
	
	global $dir;
	$dir = "../Gch.Log";
	
	global $text;
	$text = PHP_EOL."- USERS VER DETALLES ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido;

	$logdocu = $_SESSION['ref'];
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

	require '../Gch.Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2020 */
?>
