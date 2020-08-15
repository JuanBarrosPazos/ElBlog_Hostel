<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	require 'Art_Inclu_popup_img.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

	require '../Gch.Inclu/Only.rowd.php';

///////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin')|| ($_SESSION['Nivel'] == 'plus')){

		if($_POST['oculto2']){ process_form(); } 
								
		elseif(($_POST['mimg1'])||($_POST['mimg2'])||($_POST['mimg3'])||($_POST['mimg4'])){
									process_form();
								} 

		elseif($_POST['imagenmodif']){ process_form(); } 
		elseif(($_POST['cero'])||($_GET['cero'])){ process_form(); } 

	} else { require '../Gch.Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	if( file_exists("../Gch.Img.Art/untitled.png") ){ }
	else{ $rename_filename1 = "../Gch.Img.Art/untitled.png";								
		  copy("../Gch.Img.Sys/untitled.png", $rename_filename1);
			}

////////////////////

	$errors = array();

	$limite = 900 * 1024;
	
	$ext_permitidas = array('.jpg','.JPG','.gif','.GIF','.png','.PNG', 'jpeg', 'JPEG');
	$extension = substr($_FILES['myimg']['name'],-4);
	// print($extension);
	$ext_correcta = in_array($extension, $ext_permitidas);

	global $extension1;
	$extension1 = strtolower($extension);
	$extension1 = str_replace(".","",$extension1);
	global $ctemp;
	$ctemp = "../Gch.Temp";

	// $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg']['type']);

		if($_FILES['myimg']['size'] == 0){
			$errors [] = "SELECCIONE UNA FOTOGRAFÍA";
		}
		 
		elseif(!$ext_correcta){
			$errors [] = "EXTENSION NO ADMITIDA ".$_FILES['myimg']['name'];
			}

	/*	elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg']['name'];
			}
	*/
	
	elseif ($_FILES['myimg']['size'] > $limite){
	$tamanho = $_FILES['myimg']['size'] / 1024;
	$errors [] = "IMAGEN ".$_FILES['myimg']['name']." MAYOR DE 90 KBytes. ".$tamanho." KB";
			}
		
		elseif ($_FILES['myimg']['size'] <= $limite){
			//copy($_FILES['myimg']['tmp_name'], $ctemp."/ini1v.".$extension1); 
			global $ancho;
			global $alto;
			//list($ancho, $alto, $tipo, $atributos) = getimagesize($ctemp."/ini1v.".$extension1);
			list($ancho, $alto, $tipo, $atributos) = getimagesize($_FILES['myimg']['name']);

			if($ancho < 400){
				$errors [] = "IMAGEN ".$_FILES['myimg']['name']." ANCHURA MENOR DE 400 ".$ancho;
			}
			elseif(($ancho > 900)&&($alto < 400)){
				$errors [] = "IMAGEN ".$_FILES['myimg']['name']." ALTURA MENOR DE 400 ".$alto;
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

function modifica_form(){
	
		global $db;
		global $db_name;
		
		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='Art_Modificar_img.php?cero=1';
					}
					setTimeout('redir()',1000);
					</script>";

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
			$new_name = $_SESSION['refart']."_".$dt.".".$extension;

			global $ruta;
			$ruta = "../Gch.Img.Art/";
			$_SESSION['ruta'] = $ruta;

		global $imgcamp;
		$imgcamp = $_SESSION['imgcamp'];
		$imgcamp = "`".$imgcamp."`";
		global $refart;
		$refart = $_SESSION['refart'];
		
	global $vname;
	$vname = "gch_art";
	$vname = "`".$vname."`";
		
$sqla = "UPDATE `$db_name`.$vname SET $imgcamp = '$new_name'  WHERE $vname.`refart` = '$refart' LIMIT 1 ";
		
		if(mysqli_query($db, $sqla)){

			require 'Inc_Modificar_Img.php';

		} // FIN SI SE CUMPLE EL QUERY

		else { 	print("* ERROR ".mysqli_error($db));
			   	show_form();
				global $texerror;
				$texerror = "\n\t ".mysqli_error($db);
				}

	} 
	
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;

	if($_POST['oculto2']){
		
/*
				unset($_SESSION['myimg']);	
				unset($_SESSION['myimg1']);
				unset($_SESSION['myimg2']);
				unset($_SESSION['myimg3']);
				unset($_SESSION['myimg4']);	
				unset($_SESSION['miid']);	
				unset($_SESSION['refart']);	
*/
				
	$_SESSION['miid'] = $_POST['id'];
	$_SESSION['refart'] = $_POST['refart'];

		global $ruta;
		$ruta = "../Gch.Img.Art/";
		$_SESSION['ruta'] = $ruta;
		
		global $myimg1;
		$myimg1 = $_POST['myimg1'];
		$_SESSION['myimg1'] = $myimg1;

		global $myimg2;
		$myimg2 = $_POST['myimg2'];
		$_SESSION['myimg2'] = $myimg2;

		global $myimg3;
		$myimg3 = $_POST['myimg3'];
		$_SESSION['myimg3'] = $myimg3;

		global $myimg4;
		$myimg4 = $_POST['myimg4'];
		$_SESSION['myimg4'] = $myimg4;

	// FIN OCULTO 2
	} else {		
	
		global $ruta;
		$ruta = "../Gch.Img.Art/";
		$_SESSION['ruta'] = $ruta;

		global $vname;
		$vname = "gch_art";
		$vname = "`".$vname."`";
		$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `refart` = '$_SESSION[refart]'";
		$qc = mysqli_query($db, $sqlc);
		$rowsc = mysqli_fetch_assoc($qc);
									
		global $myimg1;
		$myimg1 = $rowsc['myimg1'];
		$_SESSION['myimg1'] = $rowsc['myimg1'];

		global $myimg2;
		$myimg2 = $rowsc['myimg2'];
		$_SESSION['myimg2'] = $rowsc['myimg2'];

		global $myimg3;
		$myimg3 = $rowsc['myimg3'];
		$_SESSION['myimg3'] = $rowsc['myimg3'];

		global $myimg4;
		$myimg4 = $rowsc['myimg4'];
		$_SESSION['myimg4'] = $rowsc['myimg4'];

		}
	
	global $imagenes;
	$imagenes = " <table class='detalle' align='center'>
				<tr>
					<th colspan=4 class='BorderInf'>
		ARTICULO REF: ".$_SESSION['refart'].". ID: ".$_SESSION['miid']."
					</th>
				</tr>
				
        <tr>
          <td class='img1'>
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		  <img src='".$ruta.$myimg1."'  onclick=\"MM_showHideLayers('contenedor','','show','foto1A','','show','foto2A','','hide','foto3A','','hide','foto4A','','hide')\" onload=\"MM_showHideLayers('foto1A','','show','foto2A','','hide','foto3A','','hide','foto4A','','hide')\" /> 
			<input name='mimg1' type='hidden' value='".$_SESSION['myimg1']."' />
			<input type='submit' value='MODIF IMG 1' />
			<input type='hidden' name='mimg1' value=1 />
</form>		  
		  </td>
		  
          <td class='img1'>
 <form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		  <img src='".$ruta.$myimg2."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','show','foto3A','','hide','foto4A','','hide')\" /> 
			<input name='mimg2' type='hidden' value='".$_SESSION['myimg2']."' />
			<input type='submit' value='MODIF IMG 2' />
			<input type='hidden' name='mimg2' value=1 />
</form>		  
		  </td>
		  
          <td class='img1'>
 <form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		  <img src='".$ruta.$myimg3."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','hide','foto3A','','show','foto4A','','hide')\" /> 
			<input name='mimg3' type='hidden' value='".$_SESSION['myimg3']."' />
			<input type='submit' value='MODIF IMG 3' />
			<input type='hidden' name='mimg3' value=1 />
</form>		  
		  </td>
		  
          <td class='img1'>
 <form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		  <img src='".$ruta.$myimg4."' onclick=\"MM_showHideLayers('foto1A','','hide','foto2A','','hide','foto3A','','hide','foto4A','','show')\" /> 
			<input name='mimg4' type='hidden' value='".$_SESSION['myimg4']."' />
			<input type='submit' value='MODIF IMG 4' />
			<input type='hidden' name='mimg4' value=1 />
</form>		  
		  </td>
       </tr>";
       
$printimg =	"<div id='foto1A' class='img2'> 
				<img src='".$ruta.$myimg1."' /> 
			</div>
			
            <div id='foto2A' class='img2'> 
				<img src='".$ruta.$myimg2."' /> 
			</div>
			
            <div id='foto3A' class='img2'> 
				<img src='".$ruta.$myimg3."' /> 
			</div>
			
            <div id='foto4A' class='img2'> 
				<img src='".$ruta.$myimg4."' /> 
			</div>";
			
	if(($_POST['mimg1'])||($_POST['mimg2'])||($_POST['mimg3'])||($_POST['mimg4'])){
					show_form();
	} elseif($_POST['imagenmodif']){
		if($form_errors = validate_form()){
						show_form($form_errors);
							} else { modifica_form();
									 show_form();
									 info();
										}
									}
	//elseif($_POST['cero']){ print($printimg); } 
	else { //echo $printimg; 
		   echo $imagenes; }

	print("	<tr>
				<div>
					<td colspan=4 align='center' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
						<input type='submit' value='CERRAR VENTANA' />
						<input type='hidden' name='closewin' value=1 />
	</form>
				</div>

					</td>
			</tr>
	</table>
	<div style='clear:both'></div>
	
	<!-- Inicio footer -->
	<div id='footer' >&copy; Juan Barr&oacute;s Pazos 2020.</div>
	<!-- Fin footer -->
	</div>
	
	");	 

			}


//////////////////////////////////////////////////////////////////////////////////////////////
					
function show_form($errors=''){
	
	global $db; 	
		
	global $ruta;
	$ruta = "../Gch.Img.Art/";
	$_SESSION['ruta'] = $ruta;

	if($_POST['mimg1']){$_SESSION['myimg'] = $_SESSION['myimg1'];
						$_SESSION['imgcamp'] = "myimg1";}
	if($_POST['mimg2']){$_SESSION['myimg'] = $_SESSION['myimg2'];
						$_SESSION['imgcamp'] = "myimg2";}
	if($_POST['mimg3']){$_SESSION['myimg'] = $_SESSION['myimg3'];
						$_SESSION['imgcamp'] = "myimg3";}
	if($_POST['mimg4']){$_SESSION['myimg'] = $_SESSION['myimg4'];
						$_SESSION['imgcamp'] = "myimg4";}

	if($_POST['oculto2']){
				$defaults = array ( 'id' => '',
									'valor' => '',
									'nombre' => '',
									'ref' => '',										
									'myimg' => '',
											);

		$ctemp = "../Gch.Temp";
		if(file_exists($ctemp)){$dir1 = $ctemp."/";
								$handle1 = opendir($dir1);
								while ($file1 = readdir($handle1))
										{if (is_file($dir1.$file1))
											{unlink($dir1.$file1);}
											}	
							} else {}
		}
								   
	elseif(($_POST['mimg1'])||($_POST['mimg2'])||($_POST['mimg3'])||($_POST['mimg4'])){
				$defaults = array ( 'id' => $_SESSION['miid'],
									'valor' => $_SESSION['refart'],
									'myimg' => $_SESSION['myimg'],
													);
														}

	elseif($_POST['imagenmodif']){
				$defaults = array ( 'id' => $_SESSION['miid'],
									'valor' => $_SESSION['refart'],
									'myimg' => $_SESSION['myimg'],
													);
														}

	if ($errors){
		print("	<table align='center'>
					<th style='text-align:left'>
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
			} else { }
	
	global $myimg;
	$myimg = $defaults['myimg'];

	print(" <table align='center'><tr>
					<th colspan=4 class='BorderInf' style='padding-top:10px'>
						SELECCIONE UNA NUEVA IMAGEN.
					</th>
			</tr>
				
			<tr>
					<th colspan=3 class='BorderInf'>
				LA IMAGEN ACTUAL ".strtoupper($_SESSION['myimg']).".
	</br></br>
		<form name='cero' method='post' action='$_SERVER[PHP_SELF]'>
						<input type='submit' value='ACTUALIZAR VISTAS IMAGEN' />
						<input type='hidden' name='cero' value=1 />
		</form>														

					</th>
			
					<th class='BorderInf'>
<img src='".$ruta.$_SESSION['myimg']."' style=\"width:14em; height:auto\" />
					</th>
			</tr>
			
			<tr>
					<td colspan=2>
							SELECCIONE IMAGEN	
					</td>
					<td colspan=2>
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		<input size=14 type='file' name='myimg' value='".$defaults['myimg']."' />						
					</td>
				</tr>

				<tr align='center'>
					<td colspan=4 align='right'>
				
						<input type='submit' value='MODIFICAR IMAGEN' />
						<input type='hidden' name='imagenmodif' value=1 />
			</form>														
						
					</td>
					
				</tr>
				
				<tr>
					<td class='BorderInf' colspan=4>
					</td>
				</tr>

				</table>
				");
	
		}	
			
/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				//require '../Gch.Inclu/Master_Index_Admin.php';
		
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

	//require '../Gch.Inclu/Admin_Inclu_02.php';
		
/* Creado por Juan Barros Pazos 2019 */
?>