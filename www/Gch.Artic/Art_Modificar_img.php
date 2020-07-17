<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_popup.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

	require '../Gch.Inclu/Only.rowd.php';

///////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin')|| ($_SESSION['Nivel'] == 'plus')){

			if($_POST['oculto2']){
									process_form();
								} 
								
			elseif(($_POST['mimg1'])||($_POST['mimg2'])||($_POST['mimg3'])||($_POST['mimg4'])){
									process_form();
								} 

			elseif($_POST['imagenmodif']){
									process_form();
								} 
			elseif($_POST['cero']){
									process_form();
								} 

		} else { require '../Gch.Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;

////////////////////

	$sesionref = $_SESSION['miseccion'];

	    if( file_exists("../cbj_Docs/docgastos_pendientes/untitled.png") ){
				print("** El archivo untitled.png. Existe en su directorio.</br>");
			//	$errors [] ="El archivo untitled.png. Existe en su directorio.";
			}
		else{	$rename_filename1 = "../cbj_Docs/docgastos_pendientes/untitled.png";								
				print("** El archivo untitled.png. NO existe y se ha generado en auto.</br>");
			//	$errors [] ="El archivo untitled.png. NO existe y se ha generado en auto.";
				copy("../cbj_Docs/untitled.png", $rename_filename1);
			}

	    if( file_exists("../cbj_Docs/docgastos_pendientes/pdf.png") ){
				print("** El archivo pdf.png. Existe en su directorio.</br>");
			//	$errors [] ="El archivo pdf.png. Existe en su directorio.";
			}
		else{	$rename_filename2 = "../cbj_Docs/docgastos_pendientes/pdf.png";								
				print("** El archivo pdf.png. NO existe y se ha generado en auto.</br>");
			//	$errors [] ="El archivo pdf.png. NO existe y se ha generado en auto.";
				copy("../cbj_Docs/pdf.png", $rename_filename2);
			}

////////////////////

	$errors = array();

	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','pdf','PDF','bmp','BMP');
	
	$extension = substr($_FILES['myimg']['name'],-3);
	// print($extension);
	// $extension = end(explode('.', $_FILES['myimg']['name']) );
	$ext_correcta = in_array($extension, $ext_permitidas);

	// $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg']['type']);

		if($_FILES['myimg']['size'] == 0){
			$errors [] = "Ha de seleccionar una fotograf&iacute;a.";
		}
		 
		elseif(!$ext_correcta){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg']['name'];
			}

	/*	elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg']['name'];
			}
	*/
	
	elseif ($_FILES['myimg']['size'] > $limite){
	$tamanho = $_FILES['myimg']['size'] / 1024;
	$errors [] = "El archivo".$_FILES['myimg']['name']." es mayor de 500 KBytes. ".$tamanho." KB";
			}
		
			elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				}
				
				elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					}
					
	return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function modifica_form(){
	
		global $db;
		global $db_name;
		global $img;
		global $imgcamp;

		global $ruta;
		$ruta = "../Gch.Img.Art/";
		$_SESSION['ruta'] = $ruta;

		$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
		$safe_filename = trim(str_replace('..', '', $safe_filename));

		$nombre = $_FILES['myimg']['name'];
		$nombre_tmp = $_FILES['myimg']['tmp_name'];
		$tipo = $_FILES['myimg']['type'];
		$tamano = $_FILES['myimg']['size'];

		global $destination_file;
		$destination_file = $ruta.$safe_filename;
		
	    if( file_exists($ruta.$nombre) ){
			unlink($ruta.$nombre);
			}
			
		elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){

		// Eliminar el archivo antiguo untitled.png
		if($_SESSION['myimg'] != 'untitled.png' ){
		unlink($ruta.$_SESSION['myimg']);
									}
		// Renombrar el archivo:
		$extension = substr($_FILES['myimg']['name'],-3);
		// print($extension);
		// $extension = end(explode('.', $_FILES['myimg']['name']) );
		//global $new_name;
		//	$new_name = $_SESSION['myimg'];
		date('H:i:s');
		date('Y_m_d');
		$dt = date('is');
		global $new_name;
		$new_name = $_SESSION['mivalor']."_".$dt.".".$extension;
		$rename_filename = $ruta.$new_name;								
		rename($destination_file, $rename_filename);
		
		global $db;
		global $db_name;

		global $mivalor;
		$imgcamp = $_SESSION['imgcamp'];
		$imgcamp = "`".$imgcamp."`";
		$mivalor = $_SESSION['mivalor'];
		
	global $vname;
	$vname = "gch_art";
	$vname = "`".$vname."`";
		
$sqla = "UPDATE `$db_name`.$vname SET $imgcamp = '$new_name'  WHERE $vname.`factnum` = '$mivalor' LIMIT 1 ";
		
		if(mysqli_query($db, $sqla)){}
		
					 else {
							print("* ERROR ".mysqli_error($db));
									show_form ();
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
																			}
						}
						
		else {print("NO SE HA PODIDO GUARDAR EN ../imgpro/imgpro".$_SESSION['miseccion']."/");}

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
				unset($_SESSION['miseccion']);	
				unset($_SESSION['miid']);	
				unset($_SESSION['mivalor']);	
				unset($_SESSION['minombre']);	
				unset($_SESSION['miref']);	
				unset($_SESSION['midyt1']);	
*/
				
	$_SESSION['miid'] = $_POST['id'];
	$_SESSION['mivalor'] = $_POST['refart'];

	$_SESSION['miseccion'] = $_SESSION['ref'];
	$_SESSION['minombre'] = $_POST['factnom'];
	$_SESSION['miref'] = $_POST['refprovee'];
	$_SESSION['midyt1'] = $_POST['dyt1'];
	
	global $ruta;
	$ruta = "../Gch.Img.Art/";
	$_SESSION['ruta'] = $ruta;
		
	global $vname;
	$vname = "gch_art";
	$vname = "`".$vname."`";

		$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `refart` = '$_POST[refart]'";
		$qc = mysqli_query($db, $sqlc);
		$rowsc = mysqli_fetch_assoc($qc);
	
		$ext_permitidas = array('pdf','PDF');
		
		$extension1 = substr($rowsc['myimg1'],-3);
		$ext_correcta1 = in_array($extension1, $ext_permitidas);
		if(!$ext_correcta1){ 	global $myimg1;
								$myimg1 = $rowsc['myimg1'];
								$_SESSION['myimg1'] = $myimg1;
							}
		else{	global $myimg1;
				$myimg1 = 'pdf.png';
				$_SESSION['myimg1'] = $myimg1;
			}

		$extension2 = substr($rowsc['myimg2'],-3);
		$ext_correcta2 = in_array($extension2, $ext_permitidas);
		if(!$ext_correcta2){ 	global $myimg2;
								$myimg2 = $rowsc['myimg2'];
								$_SESSION['myimg2'] = $myimg2;
							}
		else{	global $myimg2;
				$myimg2 = 'pdf.png';
				$_SESSION['myimg2'] = $myimg2;
			}

		$extension3 = substr($rowsc['myimg3'],-3);
		$ext_correcta3 = in_array($extension3, $ext_permitidas);
		if(!$ext_correcta3){ 	global $myimg3;
								$myimg3 = $rowsc['myimg3'];
								$_SESSION['myimg3'] = $myimg3;
							}
		else{	global $myimg3;
				$myimg3 = 'pdf.png';
				$_SESSION['myimg3'] = $myimg3;
			}

		$extension4 = substr($rowsc['myimg4'],-3);
		$ext_correcta4 = in_array($extension4, $ext_permitidas);
		if(!$ext_correcta4){ 	global $myimg4;
								$myimg4 = $rowsc['myimg4'];
								$_SESSION['myimg4'] = $myimg4;
							}
		else{	global $myimg4;
				$myimg4 = 'pdf.png';
				$_SESSION['myimg4'] = $myimg4;
			}

	
	} else {		
	
		global $ruta;
		$ruta = "../Gch.Img.Art/";
		$_SESSION['ruta'] = $ruta;

		global $vname;
		$vname = "cbj_gastos_pendientes";
		$vname = "`".$vname."`";

		$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `factnum` = '$_SESSION[mivalor]'";
		$qc = mysqli_query($db, $sqlc);
		$rowsc = mysqli_fetch_assoc($qc);
									
		$ext_permitidas = array('pdf','PDF');
		
		$extension1 = substr($rowsc['myimg1'],-3);
		$ext_correcta1 = in_array($extension1, $ext_permitidas);
		if(!$ext_correcta1){ 	global $myimg1;
								$myimg1 = $rowsc['myimg1'];
								$_SESSION['myimg1'] = $myimg1;
							}
		else{	global $myimg1;
				$myimg1 = 'pdf.png';
				$_SESSION['myimg1'] = $rowsc['myimg1'];
			}

		$extension2 = substr($rowsc['myimg2'],-3);
		$ext_correcta2 = in_array($extension2, $ext_permitidas);
		if(!$ext_correcta2){ 	global $myimg2;
								$myimg2 = $rowsc['myimg2'];
								$_SESSION['myimg2'] = $myimg2;
							}
		else{	global $myimg2;
				$myimg2 = 'pdf.png';
				$_SESSION['myimg2'] = $rowsc['myimg2'];
			}

		$extension3 = substr($rowsc['myimg3'],-3);
		$ext_correcta3 = in_array($extension3, $ext_permitidas);
		if(!$ext_correcta3){ 	global $myimg3;
								$myimg3 = $rowsc['myimg3'];
								$_SESSION['myimg3'] = $myimg3;
							}
		else{	global $myimg3;
				$myimg3 = 'pdf.png';
				$_SESSION['myimg3'] = $rowsc['myimg3'];
			}

		$extension4 = substr($rowsc['myimg4'],-3);
		$ext_correcta4 = in_array($extension4, $ext_permitidas);
		if(!$ext_correcta4){ 	global $myimg4;
								$myimg4 = $rowsc['myimg4'];
								$_SESSION['myimg4'] = $myimg4;
							}
		else{	global $myimg4;
				$myimg4 = 'pdf.png';
				$_SESSION['myimg4'] = $rowsc['myimg4'];
			}

		}

		print(" <table class='detalle' align='center'>
				<tr>
					<th colspan=4 class='BorderInf'>
		SECCION: ".strtoupper("cbj_gastos_".$_SESSION['midyt1']).".
							</br> 
FACTURA Nº: ".$_SESSION['mivalor'].". R. Social: ".$_SESSION['minombre'].". ID: ".$_SESSION['miid']."
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
       </tr>");
       
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
					global $style;
					$style = 'margin-top:60px';
					show_form();
	} elseif($_POST['imagenmodif']){
					if($form_errors = validate_form()){
										global $style;
										$style = 'margin-top:60px';
										show_form($form_errors);
											} else {modifica_form();
													show_form();
													info();
																				}
	}
	elseif($_POST['cero']){	global $style;
							$style = 'margin-top:408px';
							print($printimg);
							
	} 
	else {	global $style;
			$style = 'margin-top:408px';
			print($printimg);
								}
	print("	
			<tr>
				<div>
					<td colspan=4 align='center' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
						<input type='submit' value='CERRAR VENTANA' />
						<input type='hidden' name='oculto2' value=1 />
	</form>
				</div>
					</td>
			</tr>
	</table>
	
	<div style='clear:both'></div>
	
	<!-- Inicio footer -->
	<div id='footer' style=".$style.">&copy; Juan Barr&oacute;s Pazos 2020.</div>
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
				$defaults = array ( 'seccion' => '',
									'id' => '',
									'valor' => '',
									'nombre' => '',
									'ref' => '',																														
									'myimg' => '',
													);
								   						}
								   
	elseif(($_POST['mimg1'])||($_POST['mimg2'])||($_POST['mimg3'])||($_POST['mimg4'])){
				$defaults = array ( 'seccion' => $_SESSION['miseccion'],
									'id' => $_SESSION['miid'],
									'valor' => $_SESSION['mivalor'],
									'nombre' => $_SESSION['minombre'],
									'ref' => $_SESSION['miref'],																														
									'myimg' => $_SESSION['myimg'],
													);
														}

	elseif($_POST['imagenmodif']){
				$defaults = array ( 'seccion' => $_SESSION['miseccion'],
									'id' => $_SESSION['miid'],
									'valor' => $_SESSION['mivalor'],
									'nombre' => $_SESSION['minombre'],
									'ref' => $_SESSION['miref'],																														
									'myimg' => $_SESSION['myimg'],
													);
														}

	if ($errors){
		print("	<div width='90%' style='float:left'>
					<table align='left' style='border:none'>
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
				</table>
				</div>
				<div style='clear:both'></div>");
		}
	
		$ext_permitidas = array('pdf','PDF');
		
		$extension = substr($defaults['myimg'],-3);
		$ext_correcta = in_array($extension, $ext_permitidas);
		if(!$ext_correcta){ 	global $myimg1;
								$myimg = $defaults['myimg'];
							}
		else{	global $myimg;
				$myimg = 'pdf.png';
			}

	print(" <tr>
					<th colspan=4 class='BorderInf' style='padding-top:60px'>
						SELECCIONE UNA NUEVA IMAGEN.
					</th>
			</tr>
				
			<tr>
					<th colspan=3 class='BorderInf'>
LA IMAGEN ACTUAL </br>".strtoupper($defaults['seccion'])." / ".strtoupper($defaults['nombre'])." / ".strtoupper($_SESSION['myimg']).".
</br></br>
<form name='cero' method='post' action='$_SERVER[PHP_SELF]'>
						<input type='submit' value='ACTUALIZAR VISTAS IMAGEN' />
						<input type='hidden' name='cero' value=1 />
</form>														

					</th>
			
					<th class='BorderInf'>
<img src='".$ruta.$myimg."' height='120px' width='90px' />
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

				");
	
		}	
			
/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Gch.Inclu/Master_Index_Admin.php';
		
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