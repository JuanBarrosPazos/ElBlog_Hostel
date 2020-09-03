<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_popup.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

	require '../Gch.Inclu/Only.rowd.php';

///////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){

	if (isset($_POST['oculto2'])){
				show_form();
				//info_01();
	} elseif($_POST['imagenmodif']){
			if($form_errors = validate_form()){
						show_form($form_errors);
			} else { process_form();
					 //info_02();
					 $ctemp = "../Gch.Temp";
					 if(file_exists($ctemp)){$dir1 = $ctemp."/";
											 $handle1 = opendir($dir1);
											 while ($file1 = readdir($handle1))
													 {if (is_file($dir1.$file1))
														 {unlink($dir1.$file1);}
														 }	
												 } else {}
					global $redir;
					$redir = "<script type='text/javascript'>
								function redir(){
									window.close();
										}
								setTimeout('redir()',8000);
							</script>";
					print ($redir);
						}
	} else { show_form(); }

} else { require '../Gch.Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	$errors = array();

	$limite = 1400 * 1024;
	

	$ext_permitidas = array('.jpg','.JPG','.gif','.GIF','.png','.PNG', 'jpeg', 'JPEG');
	$extension = substr($_FILES['myimg']['name'],-4);
	// print($extension);
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
		$errors [] = "El archivo".$_FILES['myimg']['name']." es mayor de 140 KBytes. ".$tamanho." KB";
		global $img2;
		$img2 = 'untitled.png';
			}

		elseif ($_FILES['myimg']['size'] <= $limite){
			copy($_FILES['myimg']['tmp_name'], $ctemp."/ini1v.".$extension1); 
			global $ancho;
			global $alto;
			list($ancho, $alto, $tipo, $atributos) = getimagesize($ctemp."/ini1v.".$extension1);

			if($ancho < 400){
				$errors [] = "IMAGEN ".$_FILES['myimg']['name']." ANCHURA MENOR DE 400 ".$ancho;
			}
			elseif(($ancho > 400)&&($alto < 400)){
				$errors [] = "IMAGEN ".$_FILES['myimg']['name']." ALTURA MENOR DE 400 ".$alto;
			}
		}

			elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "LA CARGA DEL ARCHIVO SE HA INTERRUMPIDO";
				}
				
				elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "EL ARCHIVO NO SE HA CARGADO";
                    }
					
		return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;

	global $secc;	
	$secc = $_SESSION['refuser'];
	$sqlx =  "SELECT * FROM `gch_admin` WHERE `ref` = '$_SESSION[refuser]'";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	global $_sec;
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];
	//echo $rowautor['Nombre']." ".$rowautor['Apellidos']."</br>";

		// RENOMBRAR ARCHIVO
		global $extension;
		$extension = substr($_FILES['myimg']['name'],-4);
		$extension = strtolower($extension);
		global $extension;
		$extension = str_replace(".","",$extension);
		// print($extension);
		date('H:i:s');
		date('Y_m_d');
		$dt = date('is');
		global $new_name;
		$new_name = $_SESSION['srefnews']."_".$dt.".".$extension;

	global $tablename;
	$tablename = "gch_news";
	$tablename = "`".$tablename."`";

	$sqlc = "UPDATE `$db_name`.$tablename SET `myimg` = '$new_name' WHERE $tablename.`refnews` = '$_SESSION[srefnews]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){

		global $redir;
		$redir = "";

		require 'Inc_Modificar_Img.php';

	print("MODIFICADO CORRECTAMENTE");
	print( "<table align='center' style=\"margin-top:20px; width:96%; max-width:500px\" >
				<tr>
					<td colspan=2 class='BorderInf' style=\"text-align:center;\">
						ARTICULO CREADO POR ".strtoupper($_sec)."
					</td>
				</tr>
				
				<tr>
					<td colspan=2 style=\"text-align:center;\" width='auto'>
			<img src='../Gch.Img.News/".$new_name."'' width='98%' height='auto' />
					</td>
				</tr>

				<tr>
					<td style=\"text-align:right;\">REFERENCIA</td>
					<td>".$_SESSION['srefnews']."</td>
				</tr>
				
				<tr>
					<td style=\"text-align:right;\">TITULO</td>
					<td>".$_POST['tit']."</td>
				</tr>				
				
				<tr>
					<td style=\"text-align:right;\">SUBTITULO</td>
					<td>".$_POST['titsub']."</td>
				</tr>
				
				<tr>
					<td colspan=2 style=\"text-align:right;\" class='BorderSup'>
			<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
						<input type='submit' value='CERRAR VENTANA' />
						<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
		</table>");
	}// FIN CONDICIONAL SE CUMPLE EL QUERY
		else { print("<font color='#FF0000'>
						* ESTOS DATOS NO SON VALIDOS, MODIFIQUE ESTA ENTRADA: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
				} // FIN ELSE SI NO SE CUMPLE EL QUERY

	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	global $db; 	
	global $db_name;

	unset($_SESSION['smyimg']);
	unset($_SESSION['myimg']);
	
	global $ruta;
	$ruta = "../Gch.Img.News/";
	$_SESSION['ruta'] = $ruta;

	global $id;
	$id = $_POST['id'];
	global $img;
	$img = 	$_POST['myimg'];

	if(isset($_POST['oculto2'])){

	$_SESSION['smyimg'] = $_POST['myimg'];
	$_SESSION['srefnews'] = $_POST['refnews'];
	$_SESSION['refuser'] = $_POST['refuser'];
	
				$defaults = array ( 'id' => $_POST['id'],
									'dyt1' => $_POST['dyt1'],
									'refuser' => $_SESSION['refuser'],
									'refnews' =>  $_SESSION['srefnews'],
									'tit' => $_POST['tit'],
								    'titsub' => $_POST['titsub'],
									'myimg' => $img,
									);
								   		}
								   
		elseif($_POST['imagenmodif']){

				$defaults = array ( 'id' => $_POST['id'],
									'dyt1' => $_POST['dyt1'],
									'refuser' => $_SESSION['refuser'],
									'refnews' =>  $_SESSION['srefnews'],
									'tit' => $_POST['tit'],
								    'titsub' => $_POST['titsub'],
									'myimg' => $_POST['myimg'],
									 );
										}
								   
	if ($errors){
		print("<table align='center' style=\"margin-top:12px;\">
					<th style='text-align:center'>
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					</th>
					<tr>
					<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
		}
		
	print("<table align='center' style=\"margin-top:12px; text-align:left; width:96%; max-width:500px;\">
				<tr>
					<th class='BorderInf'>
						SELECCIONE UNA NUEVA IMAGEN.
					</th>
				</tr>
				
				<tr>
					<td class='BorderInf' align='center'>
				<img src='../Gch.Img.News/".$_SESSION['smyimg']."' width='98%' height='auto' />
					</td>
				</tr>
				<tr>
					<td class='BorderInf'>
						REFERENCIA: ".$_SESSION['srefnews']."</br>
						TITULO: ".$_POST['tit'].".
					</td>
				</tr>
				
				<tr>
					<td>
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
			<input type='file' name='myimg' value='".$defaults['myimg']."' />						
					</td>
				</tr>

				<tr align='center' height=30px>
					<td >

						<input name='id' type='hidden' value='".$defaults['id']."' />
						<input name='dyt1' type='hidden' value='".$defaults['dyt1']."' />
						<input name='refuser' type='hidden' value='".$_SESSION['refuser']."' />
						<input name='refnews' type='hidden' value='".$_SESSION['srefnews']."' />
						<input name='tit' type='hidden' value='".$defaults['tit']."' />
						<input name='titsub' type='hidden' value='".$defaults['titsub']."' />
						<input name='myimg' type='hidden' value='".$defaults['myimg']."' />
			
						<input type='submit' value='MODIFICAR IMAGEN' />
						<input type='hidden' name='imagenmodif' value=1 />
		</form>																				
					</td>
				</tr>
			
				<tr>
					<td align='right' class='BorderSup'>
			<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
			</table>");

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
/*
function info_02(){

	global $db;
	global $rowout;
	
	global $destination_file;	
	global $rename_filename;

global $nombre;
global $apellido;

	$ActionTime = date('H:i:s');

	$rf = $_POST['ref'];

	global $dir;
	$dir = "../Gch.Log";

global $text;
$text = PHP_EOL."- ADMIN MODIFICAR IMG MODIFICADA ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".@$nombre." ".@$apellido.PHP_EOL."\t Ref: ".$rf.PHP_EOL."\t Upload Imagen: ".$destination_file.PHP_EOL."\t Rename Imagen: ".$rename_filename;

	$logdocu = $_SESSION['srefuser'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}
*/
/////////////////////////////////////////////////////////////////////////////////////////////////

function info_01(){

	global $db;
	global $rowout;
	
	global $nombre;
	global $apellido;
	global $destination_file;	

	$ActionTime = date('H:i:s');

	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	global $dir;
	$dir = "../Gch.Log";

global $text;
$text = PHP_EOL."- ADMIN MODIFICAR IMG SELECCIONADA ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.PHP_EOL."\t Imagen: ".$_POST['myimg'];

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gch.Inclu/Admin_Inclu_02.php';
		
/* Creado por Juan Barros Pazos 2019 */
?>