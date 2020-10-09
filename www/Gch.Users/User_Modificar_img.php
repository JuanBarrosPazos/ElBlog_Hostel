<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	global $headtot;
	$headtot = "headu";
	require 'Inc_Header_Nav_Head_Total.php';
	//require 'Inc_Header_Nav_Headu.php';
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ((@$_SESSION['uNivel'] == 'adminu')||(@$_SESSION['uNivel'] == 'useru')||(@$_SESSION['Nivel'] == 'admin')){

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
			 //require 'Inc_Footer.php';
			 //require '../Gch.Www/Inc_Jquery_Boots_Foot.php';
				}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	$errors = array();

	$limite = 600 * 1024;
	
	$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG');
	$extension = substr($_FILES['myimg']['name'],-3);
	$ext_correcta = in_array($extension, $ext_permitidas);

	global $extension1;
	$extension1 = strtolower($extension);
	$extension1 = str_replace(".","",$extension1);
	global $ctemp;
	$ctemp = "../Gch.Temp";

	if($_FILES['myimg']['size'] == 0){
			$errors [] = "SELECCIONE UNA IMAGEN";
			global $img2;
			$img2 = 'untitled.png';
		}
		 
		elseif(!$ext_correcta){
			$errors [] = "EXTENSION NO ADMITIDA ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}

		elseif ($_FILES['myimg']['size'] > $limite){
		$tamanho = $_FILES['myimg']['size'] / 1024;
		$errors [] = "IMAGEN ".$_FILES['myimg']['name']." MAYOR DE 60 KBytes. ".$tamanho." KB";
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
				$errors [] = "LA CARGA DEL ARCHIVO SE HA INTERRUMPIDO";
				global $img2;
				$img2 = 'untitled.png';
				}
				
				elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "EL ARCHIVO NO SE HA CARGADO";
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
			global $unlinkodlimg;
			$unlinkodlimg = "../Gch.Img.User/".$_SESSION['smyimg'];
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

		global $volvergestion;
		if (@$_SESSION['Nivel'] == 'admin'){
		$volvergestion = "<tr>
							<td colspan=3 align='right' class='BorderSup'>
								<form name='closewindow' action='User_Modificar_01.php'  \">
									<input type='submit' value='VOLVER A GESTION USUARIOS' />
									<input type='hidden' name='volver' value=1 />
								</form>
							</td>
						 </tr>";
		} else {$volvergestion = ""; }

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
						USER
					</td>
					<td>"
						.$_POST['Usuario'].
					"</td>
				</tr>
				
				<tr>
					<td>
						NIVEL
					</td>
					<td>"
						.$_POST['Nivel'].
					"</td>
				</tr>
				
				<tr>
					<td>
						TLF
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
				".$volvergestion."
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
	$dt = @$_POST['doc'];

	if(isset($_POST['oculto2'])){

	$_SESSION['smyimg'] = $_POST['myimg'];
	$_SESSION['sref'] = $_POST['ref'];
	$_SESSION['sid'] = $_POST['id'];
	
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
							'Usuario' => $_POST['Usuario'],
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

	if (@$_SESSION['Nivel'] == 'admin')	{ 
			global $cancelbuttom;
			$cancelbuttom = "<div align='right' class='BorderSup BorderInf'>
					<form name='closewindow' action='User_Modificar_01.php'class=\"form\">
									<input type='submit' value='CANCELAR Y VOLVER' />
									<input type='hidden' name='volver' value=1 />
					</form>
			<form name='closewindow' action='$_SERVER[PHP_SELF]' onsubmit=\"window.close()\" class=\"form\">
				<input type='submit' value='CERRAR VENTANA' />
				<input type='hidden' name='oculto2' value=1 />
			</form>
							</div>"; 
	} else { global $cancelbuttom;
			 $cancelbuttom = "<div align='right' class='BorderSup BorderInf'>
			 <form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\" >
					 <input type='submit' value='CERRAR VENTANA' />
					 <input type='hidden' name='oculto2' value=1 />
			 </form></div>";
				 }

	print("<div class=\"juancentra\" style=\"margin-top:20px; width:98vw !important;\">

			".$cancelbuttom."
			<div class='BorderInf' align='center'>
				SELECCIONE UNA NUEVA IMAGEN.<br>
				IMAGEN ACTUAL DE : </br>".$defaults['Nombre']." ".$defaults['Apellidos'].".
			</div>
				
			<div colspan=2 class='BorderInf' align='center'>
		<img src='../Gch.Img.User/".$_SESSION['smyimg']."' width='240px' height='auto' />
			</div>
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>

			<input style=\"font-size:0.9em;\" type='file' name='myimg' value='".$defaults['myimg']."' />						

			<div style=\"text-align:left;\">
				<input type='hidden' name='id' value='".$defaults['id']."' />					
				<input type='hidden' name='ref' value='".$_SESSION['sref']."' />					
				<input type='hidden' name='Nombre' value='".$defaults['Nombre']."' />
				<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
				<input type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
				<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
				<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />

				<input type='submit' value='MODIFICAR IMAGEN' />
				<input type='hidden' name='imagenmodif' value=1 />
		</form>																				
			</div>
			
		<div class='BorderSup'></div>
				
			".$cancelbuttom."

			</div>");
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_02(){

	global $destination_file;	
	global $rename_filename;
	global $unlinkodlimg;

	$ActionTime = date('H:i:s');

	global $logtext;
	$logtext = PHP_EOL."- USER WEB IMAGEN MODIFICADA ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t Ref: ".$_POST['ref'].PHP_EOL."\t Delete Old Imagen: ".$unlinkodlimg.PHP_EOL."\t Upload Imagen: ".$destination_file.PHP_EOL."\t Rename New Imagen: ".$rename_filename.PHP_EOL;

    require 'Inc_Log_Total.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_01(){

	$ActionTime = date('H:i:s');

	global $logtext;
	$logtext = PHP_EOL."- USER WEB MODIFICAR IMAGEN ACCESO ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t Ref: ".$_POST['ref'].PHP_EOL."\t Imagen: ".$_POST['myimg'].PHP_EOL;

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