<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_01b.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){ 

					master_index();

							if (isset($_POST['oculto2'])){
										show_form();
										//accion_Log();
									}
							elseif(isset($_POST['oculto'])){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
											//accion_Log();
											}
							} else {
										show_form();
								}
} else { require '../Gch.Inclu/table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $db;
	global $db_name;

	$errors = array();

/*
	if(strlen(trim($_POST['refnews'])) != 0){	
			$secc1 = "gch_news";
			$secc1 = "`".$secc1."`";
			$sqlc =  "SELECT * FROM `$db_name`.$secc1 WHERE `refnews` = '$_POST[refnews]'";
			$qc = mysqli_query($db, $sqlc);
			global $conutc;
			$countc = mysqli_num_rows($qc);
			if($countc > 0){
				$errors [] = "YA EXISTE EL NOTICIA.";
				}
		}
*/
		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['titulo'])) == 0){
		$errors [] = "TITULO <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['titulo'])) < 6){
		$errors [] = "TITULO <font color='#FF0000'>Más de 5 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['titulo'])){
		$errors [] = "TITULO <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z,0-9\s]+$/',$_POST['titulo'])){
		$errors [] = "TITULO  <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}
	
	if(strlen(trim($_POST['subtitul'])) == 0){
		$errors [] = "SUBTITULO  <font color='#FF0000'>Campo es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['subtitul'])) < 5){
		$errors [] = "SUBTITULO  <font color='#FF0000'>Más de 4 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\.\*\']+$/',$_POST['subtitul'])){
		$errors [] = "SUBTITULO  <font color='#FF0000'>Caracteres no válidos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z,0-9\s]+$/',$_POST['subtitul'])){
		$errors [] = "SUBTITULO  <font color='#FF0000'>Solo mayusculas o números sin acentos.</font>";
		}
	
	
	if(strlen(trim($_POST['coment'])) == 0){
		$errors [] = "NOTICIA <font color='#FF0000'>Campo obligatorio.</font>";
		}

	elseif(strlen(trim($_POST['coment'])) <= 50){
		$errors [] = "NOTICIA <font color='#FF0000'>Mas de 50 carácteres.</font>";
		}

	elseif(strlen(trim($_POST['coment'])) >= 402){
		$errors [] = "NOTICIA <font color='#FF0000'>Excedió más de 400 carácteres.</font>";
		}
		

	elseif (!preg_match('/^[a-z A-Z 0-9 \s ,.;:\'-()¡!¿?@ áéíóúñ €]+$/',$_POST['coment'])){
			$errors [] = "NOTICIA  <font color='#FF0000'>Caracteres no permitidos. { } [ ] $ < >  # ...</font>";
			}

	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;

	global $secc;	
	$secc = $_POST['autor'];
	$sqlx =  "SELECT * FROM `gch_admin` WHERE `ref` = '$_POST[autor]'";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	global $_sec;
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];
	//echo $rowautor['Nombre']." ".$rowautor['Apellidos']."</br>";
	
	global $carpetaimg;
	$carpetaimg = "../Gch.Img.News";

	/* GRABAMOS LOS DATOS EN LA TABLA DE NOTICIAS DE ESTE AÑO */

	global $dyt1;
	$dyt1 = trim($_SESSION['dyt1']);
	global $tablename;
	$tablename = "gch_news";
	$tablename = "`".$tablename."`";

	$sqla = "UPDATE `$db_name`.$tablename SET `refuser` = '$_POST[autor]', `tit` = '$_POST[titulo]', `titsub` = '$_POST[subtitul]', `datemod` = '$_POST[datemod]', `timemod` = '$_POST[timemod]', `conte` = '$_POST[coment]' WHERE $tablename.`refnews` = '$_SESSION[refnews]' LIMIT 1 ";

	if(mysqli_query($db, $sqla)){

			global $carpetaimg;
			global $new_name;

			print("<table align='center' style=\"margin-top:10px; text-align:left; width:96%; max-width:500px\" >
				<tr>
					<th colspan=3 class='BorderInf'>
						CREADO POR ".strtoupper($_sec)."
					</th>
				</tr>
												
				<tr>
					<td width=100px>REFERENCIA</td>
					<td width=140px>".$_SESSION['refnews']."</td>
					<td rowspan='4' align='center' width='auto'>
				<img src='".$carpetaimg."/".$_SESSION['myimg']."' width='98% height='auto' />
					</td>
				</tr>
				
				<tr>
					<td>TITULO</td>
					<td>".$_POST['titulo']."</td>
				</tr>				
				
				<tr>
					<td>SUBTITULO</td>
					<td>".$_POST['subtitul']."</td>
				</tr>
				
				<tr>
					<td>DATE IN</td>
					<td>".$_POST['datein']."</td>
				</tr>
				
				<tr>
					<td>TIME IN</td>
					<td>".$_POST['timein']."</td>
				</tr>
				
				<tr>
					<td colspan=3 align='center'>NOTICIA</td>
				</tr>
					<td colspan=3 align='left'>".$_POST['coment']."</td>
				</tr>
				<tr>
					<th colspan=3 class='BorderSup'>
						<a href=News_Modificar_01.php>MODIFICAR OTRO NOTICIA</a>
					</th>
				</tr>
			</table>");
			
	} 	else {print("* MODIFIQUE LA ENTRADA L.152: ".mysqli_error($db));
						show_form ();
						//global $texerror;
						//$texerror = "\n\t ".mysqli_error($db);
					}
		
	}	/* FINAL process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if(isset($_POST['oculto2'])){
		//$defaults = $_POST;
		
		$_SESSION['dyt1'] = $_POST['dyt1'];
		$_SESSION['refuser'] = $_POST['refuser'];
		$_SESSION['tit'] = $_POST['tit'];
		$_SESSION['titsub'] = $_POST['titsub'];
		$_SESSION['refnews'] = $_POST['refnews'];
		$_SESSION['datein'] = $_POST['datein'];
		$_SESSION['timein'] = $_POST['datein'];
		$_SESSION['datemod'] = date('Y-m-d');
		$_SESSION['timemod'] = date('H:i:s');
		$_SESSION['conte'] = $_POST['conte'];
		$_SESSION['myimg'] = $_POST['myimg'];
		
		$defaults = array ( 'autor' => $_SESSION['refuser'],  // ref autor
							'titulo' => $_SESSION['tit'], // Titulo
							'subtitul' => $_SESSION['titsub'], // Sub Titulo
							'refnews' => $_SESSION['refnews'], 
							'datein' => $_SESSION['datein'], // Sub Titulo
							'timein' => $_SESSION['timein'], // Sub Titulo
							'datemod' => $_SESSION['datemod'], // Sub Titulo
							'timemod' => $_SESSION['timemod'], // Sub Titulo
							'coment' => $_SESSION['conte'],
							'myimg' => $_SESSION['myimg'],	
									);

		} elseif(isset($_POST['oculto1'])){
				//$defaults = $_POST;
				$_SESSION['refuser'] = $_POST['autor'];
				$_SESSION['datemod'] = date('Y-m-d');
				$_SESSION['timemod'] = date('H:i:s');
				$defaults = array ( 'autor' => $_POST['autor'],  // ref autor
									'titulo' => $_SESSION['tit'], // Titulo
									'subtitul' => $_SESSION['titsub'], // Sub Titulo
									'refnews' => $_SESSION['refnews'], 
									'datein' => $_SESSION['datein'], // Sub Titulo
									'timein' => $_SESSION['timein'], // Sub Titulo
									'datemod' => $_SESSION['datemod'], // Sub Titulo
									'timemod' => $_SESSION['timemod'], // Sub Titulo
									'coment' => $_SESSION['conte'],
									'myimg' => $_SESSION['myimg'],	
									);


		} 
	elseif(isset($_POST['oculto'])){
					$defaults = $_POST;
		} else {
				$defaults = array ( 'autor' => isset($_POST['autor']),  // ref autor
									'titulo' => '', // Titulo
								   	'subtitul' => '', // Sub Titulo
								   	//'refnews' => @$_SESSION['refnews'],
								   	'coment' => '',
									'myimg' => '',	
												);
								   					}
	
	if ($errors){
		print("	<div  class='errors'>
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
		
	global $db;
	global $db_name;
	global $autor;
	$autor = $_SESSION['refuser'];
	/* CONSULTAMOS LA TABLA ADMIN = AUTORES */
	$sqlx =  "SELECT * FROM `gch_admin` WHERE `ref` = '$autor' ";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	global $_sec;
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];

		print("
			<table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<th colspan='2'>
						MODIFICAR NOTICIA DE ".strtoupper($_sec)."
					</th>
				</tr>		
				<tr>
					<td align='right'>
						<input type='submit' value='SELECCIONE UN AUTOR' />
						<input type='hidden' name='oculto1' value=1 />
					</td>
					<td align='left'>

						<select name='autor'>");
						
	/* RECORREMOS LOS VALORES DE LA TABLA PARA CONSTRUIR CON ELLOS UN SELECT */	
			
	global $db;
	$sqlb =  "SELECT * FROM `gch_admin` ORDER BY `Apellidos` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['ref']."' ");
					
					if($rows['ref'] == $defaults['autor']){
															print ("selected = 'selected'");
																								}
									print ("> ".$rows['Apellidos']." ".$rows['Nombre']."</option>");
				}
		
			}  

	print ("	</select>
					</td>
			</tr>
	
		</form>	
			
			</table>				
						");
				
	if ((strlen(trim(@$_POST['autor'])) == 0) && (strlen(trim($_SESSION['refuser']))) == 0) { 
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
										HA DE SELECCIONAR UN AUTOR PARA CREAR NOTICIAS.
											</font>
										</td>
									</tr>
								</table>");
												}	

	elseif ((@$_POST['autor'] != '') || ($_SESSION['refuser'] != '')) { 
		
	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>
							NUEVO NOTICIA DE ".strtoupper($_sec)."
					</th>
				</tr>
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' >
						
			<tr>								
				<td>REF AUTOR</td>
				<td>
			<input name='autor' type='hidden' value='".$defaults['autor']."' />".$defaults['autor']."
				</td>
			</tr>

			<tr>
				<td>TITULO</td>
				<td>
		<input type='text' name='titulo' size=20 maxlength=20 value='".$defaults['titulo']."' />
				</td>
			</tr>
									
			<tr>
				<td>SUBTITULO</td>
				<td>
		<input type='text' name='subtitul' size=20 maxlength=20 value='".$defaults['subtitul']."' />
				</td>
			</tr>
									
			<tr>
				<td>REFERENCIA</td>
				<td>
		<input type='hidden' name='refnews' value='".$_SESSION['refnews']."' />".$_SESSION['refnews']."
				</td>
			</tr>
			<tr>
				<td>DATE IN</td>
				<td>
		<input type='hidden' name='datein' value='".$_SESSION['datein']."' />".$_SESSION['datein']."
				</td>
			</tr>
			<tr>
				<td>TIME IN</td>
				<td>
		<input type='hidden' name='timein' value='".$_SESSION['timein']."' />".$_SESSION['timein']."
				</td>
			</tr>
					
			<tr>
				<td>						
					DATE MOD
				</td>
				<td>
		<input type='hidden' name='datemod' value='".$defaults['datemod']."' />".$defaults['datemod']."
				</td>
			</tr>
			<tr>
				<td>						
					TIME MOD
				</td>
				<td>
		<input type='hidden' name='timemod' value='".$defaults['timemod']."' />".$defaults['timemod']."
				</td>
			</tr>

			<tr>
				<td colspan=2 align='center'>
					NOTICIA
				</td>
			</tr>
			<tr>
				<td colspan=2 align='center'>
	<textarea cols='41' rows='9' onkeypress='return limitac(event, 400);' onkeyup='actualizaInfoc(400)' name='coment' id='coment'>".$defaults['coment']."</textarea>
			</br>
	            <div id='infoc' align='center' style='color:#0080C0;'>
        					Maximum 400 characters            
				</div>

				</td>
			</tr>

		<input name='myimg' type='hidden' value='".$_SESSION['myimg']."' />

			<tr>
				<td colspan='2' align='right' valign='middle'  class='BorderSup'>
					<input type='submit' value='MODIFICAR NOTICIA' />
					<input type='hidden' name='oculto' value=1 />
				</td>
			</tr>
		</form>	

		<tr>
			<td colspan=2 align='center' class='BorderSup' >
				<form name='fcancel' method='post' action='News_Modificar_01' >
							<input type='submit' value='CANCELAR Y VOLVER' />
							<input type='hidden' name='cancel' value=1 />
				</form>
			</td>
		</tr>
			</table>"); 
		}
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////
/*
function accion_Log(){

	global $db;
	global $rowout;
	global $secc;
	global $_sec;
	$secc = $_sec;	

	$ActionTime = date('H:i:s');

	global $dir;
	if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){ $dir = 'Admin';}
	elseif ($_SESSION['Nivel'] == 'cliente'){ $dir = 'Clientes';}
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'caja')){ $dir = 'User';}
	
global $text;
$text = "- PRODUCTO CREAR ".$ActionTime.". ".$secc.".\n\t Pro Name: ".$_POST['subtitul'].".\n\t Pro titulo: ".$_POST['titulo'].".\n\t Pro Ref: ".$_POST['ref'].".\n\t Coment: ".$_POST['coment'];

		$logname = $_SESSION['Nombre'];	
		$logape = $_SESSION['Apellidos'];	
		$logname = trim($logname);	
		$logape = trim($logape);	
		$logdocu = $logname."_".$logape;
		$logdate = date('Y_m_d');
		$logtext = $text."\n";
		$filename = "../logs/".$dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}
*/
/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
		require '../Gch.Inclu/Master_Index_News_Var.php';
		require '../Gch.Inclu/Master_Index_Total.php';
		
		} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	require '../Gch.Inclu/Admin_Inclu_02.php';

?>