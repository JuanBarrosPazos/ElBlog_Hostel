<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_popup.php';
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

/*
$sqld =  "SELECT * FROM `gch_admin` WHERE `ref` = '$_SESSION[ref]' AND `Usuario` = '$_SESSION[Usuario]'";
$qd = mysqli_query($db, $sqld);
$rowd = mysqli_fetch_assoc($qd);
*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){

 		//print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".</br>");
				
			if (isset($_POST['oculto2'])){ show_form();
										   info_01();
									}
							elseif($_POST['imagenmodif']){
									if($form_errors = validate_form()){
										show_form($form_errors);
											} else { process_form();
													 info_02();
														}
								} else { show_form(); }
			} else { require '../Gch.Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	$errors = array();

	$limite = 600 * 1024;
	
	$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','bmp','BMP');
	$extension = substr($_FILES['myimg']['name'],-3);
	$ext_correcta = in_array($extension, $ext_permitidas);

	global $extension1;
	$extension1 = strtolower($extension);
	$extension1 = str_replace(".","",$extension1);
	global $ctemp;
	$ctemp = "../Gch.Temp";

		if($_FILES['myimg']['size'] == 0){
			$errors [] = "Ha de seleccionar una fotograf&iacute;a.";
			global $img2;
			$img2 = 'untitled.png';
		}
		 
		elseif(!$ext_correcta){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}
	/*
		elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}
	*/
		elseif ($_FILES['myimg']['size'] > $limite){
		$tamanho = $_FILES['myimg']['size'] / 1024;
		$errors [] = "El archivo".$_FILES['myimg']['name']." es mayor de 60 KBytes. ".$tamanho." KB";
		global $img2;
		$img2 = 'untitled.png';
			}
			
		elseif ($_FILES['myimg']['size'] <= $limite){
			copy($_FILES['myimg']['tmp_name'], $ctemp."/ini1v.".$extension1);
			global $ancho;
			global $alto;
			list($ancho, $alto, $tipo, $atributos) = getimagesize($ctemp."/ini1v.".$extension1);

			if($ancho < 100){
				$errors [] = "IMAGEN ".$_FILES['myimg']['name']." ANCHURA MENOR DE 100 * IMG = ".$ancho;
			}
			elseif($ancho > 600){
				$errors [] = "IMAGEN ".$_FILES['myimg']['name']." ANCHURA MAYOR DE 600 * IMG = ".$ancho;
			}
			elseif(($ancho <= 600)&&($alto < 100)){
				$errors [] = "IMAGEN ".$_FILES['myimg']['name']." ALTURA MENOR DE 100 * IMG = ".$alto;
			}
			elseif(($ancho <= 600)&&($alto > 700)){
				$errors [] = "IMAGEN ".$_FILES['myimg']['name']." ALTURA MAYOR DE 700 * IMG = ".$alto;
			}
		}
		
			elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				global $img2;
				$img2 = 'untitled.png';
				}
				
				elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					global $img2;
					$img2 = 'untitled.png';
					}
					
		return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $safe_filename;
	
	$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
	$safe_filename = trim(str_replace('..', '', $safe_filename));

	$nombre = $_FILES['myimg']['name'];
	//$nombre_tmp = $_FILES['myimg']['tmp_name'];
	//$tipo = $_FILES['myimg']['type'];
	//$tamano = $_FILES['myimg']['size'];
		  
	global $destination_file;
	$destination_file = '../Gch.Img.Admin/'.$safe_filename;
	

	if( file_exists( '../Gch.Img.Admin/'.$safe_filename) ){
		unlink('../Gch.Img.Admin/'.$safe_filename);
			}
			
	elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
		
		if( file_exists( '../Gch.Img.Admin/'.$_SESSION['smyimg'])){
			unlink('../Gch.Img.Admin/'.$_SESSION['smyimg']);
		}else{}

		// Renombrar el archivo:
		$extension = substr($_FILES['myimg']['name'],-3);
		// print($extension);
		// Presuntamente deprecated
		// $extension = end(explode('.', $_FILES['myimg']['name']) );
		date('H:i:s');
		date('Y_m_d');
		$dt = date('is');
		global $new_name;
		$nn = $_SESSION['sref'];
		$new_name = $nn."_".$dt.".".$extension;
		global $rename_filename;
		$rename_filename = "../Gch.Img.Admin/".$new_name;	
		rename($destination_file, $rename_filename);
		$_SESSION['new_name'] = $new_name;

	global $db;
	global $db_name;
	global $nombre;
	global $apellido;
	
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	$sqlc = "UPDATE `$db_name`.`gch_admin` SET `myimg` = '$new_name' WHERE `gch_admin`.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){

		///
		$sqlus = "SELECT * FROM $db_name.`gch_user` WHERE `ref` = '$_POST[ref]' ";
		$qus = mysqli_query($db, $sqlus);
		global $countus;
		$countus = mysqli_num_rows($qus);
		if ($countus >= 1){
			$sqlimgus = "UPDATE `$db_name`.`gch_user` SET `myimg` = '$new_name' WHERE `gch_user`.`ref` = '$_POST[ref]' LIMIT 1 ";
			if (mysqli_query($db, $sqlimgus)){
				if( file_exists( '../Gch.Img.User/'.$_SESSION['smyimg'])){
					unlink('../Gch.Img.User/'.$_SESSION['smyimg']);
					}else{}
				copy($rename_filename, "../Gch.Img.User/".$new_name);
			} else { }
		} else { }
		///

		print( "<table align='center' style=\"margin-top:20px\">
			<tr>
				<th colspan=3  class='BorderInf'>
					SUS NUEVOS DATOS DE REGISTRO
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
	<img src='../Gch.Img.Admin/".$_SESSION['new_name']."' height='120px' width='90px' />
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
					Tipo Usuario
				</td>
				<td>"
					.$_POST['Nivel'].
				"</td>
			</tr>
				
			<tr>
				<td>
					Usuario:
				</td>
				<td>"
					.$_POST['Usuario'].
				"</td>
			</tr>
				
			<tr>
				<td>
					Password:
				</td>
				<td>"
					.$_POST['Password'].
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
		</table>" );

				} else {
				print("<font color='#FF0000'>
						* MODIFIQUE ESTA ENTRADA L.149: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
							}
					// print("El archivo se ha guardado en: ".$destination_file);
			}else {
					print("No se ha podido guardar el archivo en el direcctorio img_admin/");
					}

	} // FIN PROCESS FORM

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){
	
	global $dt;

	$id = $_POST['id'];
	$img = 	isset($_POST['myimg']);
	$dt = $_POST['doc'];

	if(isset($_POST['oculto2'])){

	$_SESSION['smyimg'] = $_POST['myimg'];
	$_SESSION['sref'] = $_POST['ref'];
	$_SESSION['sid'] = $_POST['id'];
	$_SESSION['sdni'] = $_POST['dni'];
	
				$defaults = array ( 'id' => $_POST['id'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $img,
									'ref' =>  $_SESSION['sref'],
									'Nivel' => $_POST['Nivel'],
								    'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Usuario2' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Password2' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2']);
								   		}
								   
		elseif($_POST['imagenmodif']){

				$defaults = array ( 'id' => $_POST['id'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'ref' => $_SESSION['sref'],
									'myimg' => isset($_POST['myimg']),
									'Nivel' => $_POST['Nivel'],
								    'doc' => $_POST['doc'],
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Usuario2' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Password2' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2']);
										}
	
	if ($errors){
		print("	<table align='center'>
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
		
	print("<table align='center'  border=0 style='margin-top:20px; width:95.5%'>
				<tr>
					<th colspan=2 class='BorderInf'>
						SELECCIONE UNA NUEVA IMAGEN.
					</th>
				</tr>
				
				<tr>
					<th class='BorderInf'>
				LA IMAGEN ACTUAL DE : </br>".$defaults['Nombre']." ".$defaults['Apellidos'].".
					</th>
					<th class='BorderInf'>
<img src='../Gch.Img.Admin/".$_SESSION['smyimg']."' height='120px' width='90px' />
					</th>
				</tr>
				
				<tr>
					<td>
							Seleccione una Fotografía:	
					</td>
					<td>
					<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
						<input type='file' name='myimg' value='".$defaults['myimg']."' />						
					</td>
				</tr>

				<tr align='center' height=30px>
					<td>
					</td>
					<td >
						<input type='hidden' name='id' value='".$defaults['id']."' />					
						<input type='hidden' name='ref' value='".$_SESSION['sref']."' />					
						<input type='hidden' name='Nombre' value='".$defaults['Nombre']."' />
						<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
						<input type='hidden' name='doc' value='".$defaults['doc']."' />
						<input type='hidden' name='dni' value='".$defaults['dni']."' />
						<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
						<input type='hidden' name='Email' value='".$defaults['Email']."' />
						<input type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
						<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
						<input type='hidden' name='Usuario2' value='".$defaults['Usuario2']."' />
						<input type='hidden' name='Password' value='".$defaults['Password']."' />
						<input type='hidden' name='Password2' value='".$defaults['Password2']."' />
						<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
						<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
						<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />

						<input type='submit' value='MODIFICAR IMAGEN' />
						<input type='hidden' name='imagenmodif' value=1 />
		</form>																				
					</td>
				</tr>
			
				<tr>
					<td class='BorderSup'>
					</td>
					<td align='right' class='BorderSup'>
					</td>
				</tr>
				
				<tr>
					<td class='BorderSup'>
					</td>
					<td align='right' class='BorderSup'>
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
	
function info_02(){

	global $nombre;
	global $apellido;
	global $destination_file;	
	global $rename_filename;

	$ActionTime = date('H:i:s');

	$rf = $_POST['ref'];

	global $logtext;
	$logtext = PHP_EOL."- ADMIN MODIFICAR IMG MODIFICADA ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.PHP_EOL."\t Upload Imagen: ".$destination_file.PHP_EOL."\t Rename Imagen: ".$rename_filename.PHP_EOL;

	require 'Inc_Log_Total.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_01(){

	
	global $nombre;
	global $apellido;

	$ActionTime = date('H:i:s');

	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	global $logtext;
	$logtext = PHP_EOL."- ADMIN MODIFICAR IMG SELECCIONADA ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.PHP_EOL."\t Imagen: ".$_POST['myimg'].PHP_EOL;

	require 'Inc_Log_Total.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

		require '../Gch.Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Manuel Barros Pazos 2020/21 */
?>