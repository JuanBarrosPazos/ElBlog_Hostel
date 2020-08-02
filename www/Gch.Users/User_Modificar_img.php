<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	require 'Inc_Header_Nav_Headu.php';
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['uNivel'] == 'adminu')||($_SESSION['uNivel'] == 'useru')){

	if (isset($_POST['oculto2'])){ show_form();
								   info_01();
							}
	elseif($_POST['imagenmodif']){
			if($form_errors = validate_form()){
				show_form($form_errors);
					} else { process_form();
							 info_02();
							 global $redir;
							 $redir = "<script type='text/javascript'>
										 function redir(){
											 window.close();
												 }
										 setTimeout('redir()',6000);
									 </script>";
							 print ($redir);
		 
								}
		} else { show_form(); }
	} else { require '../Gch.Inclu/table_permisos.php'; 
			 require 'Inc_Footer.php';
			 require '../Gch.Www/Inc_Jquery_Boots_Foot.php';
				}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	$errors = array();

	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG');
	$extension = substr($_FILES['myimg']['name'],-3);
	$ext_correcta = in_array($extension, $ext_permitidas);

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

		elseif ($_FILES['myimg']['size'] > $limite){
		$tamanho = $_FILES['myimg']['size'] / 1024;
		$errors [] = "El archivo".$_FILES['myimg']['name']." es mayor de 500 KBytes. ".$tamanho." KB";
		global $img2;
		$img2 = 'untitled.png';
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
		  
	global $destination_file;
	$destination_file = '../Gch.Img.User/'.$safe_filename;
	

	if( file_exists( '../Gch.Img.User/'.$safe_filename) ){
		unlink('../Gch.Img.User/'.$safe_filename);
			}
			
	elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
		
		if( file_exists( '../Gch.Img.User/'.$_SESSION['smyimg'])){
			unlink('../Gch.Img.User/'.$_SESSION['smyimg']);
		}else{}

		$extension = substr($_FILES['myimg']['name'],-3);
		date('H:i:s');
		date('Y_m_d');
		$dt = date('is');
		global $new_name;
		$nn = $_SESSION['sref'];
		$new_name = $nn."_".$dt.".".$extension;
		global $rename_filename;
		$rename_filename = "../Gch.Img.User/".$new_name;	
		rename($destination_file, $rename_filename);
		$_SESSION['new_name'] = $new_name;

	global $db;
	global $db_name;
	global $nombre;
	global $apellido;
	
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	$sqlc = "UPDATE `$db_name`.`gch_user` SET `myimg` = '$new_name' WHERE `gch_user`.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){
			print( "<table align='center' style=\"margin-top:20px\">
				<tr>
					<td colspan=3  class='BorderInf' align='center'>
						NUEVOS DATOS
					</td>
				</tr>
				
				<tr>
					<td width=120px>
						NOMBRE
					</td>
					<td width=160px>"
						.$_POST['Nombre'].
					"</td>
					<td rowspan='5' align='center'>
	<img src='../Gch.Img.User/".$_SESSION['new_name']."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						APELLIDOS
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
						Teléfono 1:
					</td>
					<td>"
						.$_POST['Tlf1'].
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
						* ESTOS DATOS NO SON VALIDOS, MODIFIQUE ESTA ENTRADA: </font>
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
							'Email' => $_POST['Email'],
							'Usuario' => $_POST['Usuario'],
							'Password' => $_POST['Password'],
							'Direccion' => $_POST['Direccion'],
							'Tlf1' => $_POST['Tlf1'],
						);
								   		}
								   
	elseif($_POST['imagenmodif']){

		$defaults = array ( 'id' => $_POST['id'],
							'Nombre' => $_POST['Nombre'],
							'Apellidos' => $_POST['Apellidos'],
							'ref' => $_SESSION['sref'],
							'myimg' => isset($_POST['myimg']),
							'Nivel' => $_POST['Nivel'],
							'Email' => $_POST['Email'],
							'Usuario' => $_POST['Usuario'],
							'Password' => $_POST['Password'],
							'Direccion' => $_POST['Direccion'],
							'Tlf1' => $_POST['Tlf1'],
						);
								}
	
	if ($errors){
		print("	<table align='center'>
					<tr>
						<td style='text-align:center'>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</td>
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
					<td colspan=2 class='BorderInf' align='center'>
				SELECCIONE UNA NUEVA IMAGEN.<br>
				LA IMAGEN ACTUAL DE : </br>".$defaults['Nombre']." ".$defaults['Apellidos'].".
					</td>
				</tr>
				
				<tr>
					<td colspan=2 class='BorderInf' align='center'>
		<img src='../Gch.Img.User/".$_SESSION['smyimg']."' width='240px' height='auto' />
					</td>
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
						<input type='hidden' name='Email' value='".$defaults['Email']."' />
						<input type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
						<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
						<input type='hidden' name='Password' value='".$defaults['Password']."' />
						<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
						<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />

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

	global $dir;
	$dir = "../Gch.Log";

	global $text;
	$text = PHP_EOL."- ADMIN MODIFICAR IMG MODIFICADA ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.PHP_EOL."\t Upload Imagen: ".$destination_file.PHP_EOL."\t Rename Imagen: ".$rename_filename;

	$logdocu = $_SESSION['uref'];
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

	
	global $nombre;
	global $apellido;

	$ActionTime = date('H:i:s');

	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	global $dir;
	$dir = "../Gch.Log";

	global $text;
	$text = PHP_EOL."- ADMIN MODIFICAR IMG SELECCIONADA ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.PHP_EOL."\t Imagen: ".$_POST['myimg'];

	$logdocu = $_SESSION['uref'];
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

	require 'Inc_Footer.php';

	require '../Gch.Www/Inc_Jquery_Boots_Foot.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2020 */
?>