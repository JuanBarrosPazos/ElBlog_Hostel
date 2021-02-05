<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_01b.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ((@$_SESSION['Nivel'] == 'admin') || (@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){ 

	master_index();

	require 'Inc_Logica_01.php';

} else { require '../Gch.Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	require 'Inc_Show_Form_01_Val.php';
	
	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	unset($_SESSION['nid']);
	unset($_SESSION['myvdo']);
	unset($_SESSION['refuser']);
	unset($_SESSION['refnews']);

	global $db;
	global $db_name;
	
	show_form();
		
	global $autor;
	$autor = trim($_POST['autor']);
	
	global $titulo;
	$titulo = trim($_POST['titulo']);
	$titulo = "%".$titulo."%";
	
	$orden = @$_POST['Orden'];

	global $dyt1;
	global $dm1;
	//global $dd1;

	if ($_POST['dy'] == ''){ $dy1 = date('Y');
							 $dyt1 = $dy1;} 
							 				else {	$dy1 = "20".$_POST['dy'];
													$dyt1 = $dy1;
													}
	if ($_POST['dm'] == ''){ $dm1 = '';} 
							 				else {	$dm1 = "-".$_POST['dm'];
													}
	global $fil;
	$fil = $dy1.$dm1."%";
	//$fil = $dy1."-%".$dm1."%";
	global $vname;
	$vname = "gch_news";
	$vname = "`".$vname."`";
	//echo $dyt1;	

	if (strlen(trim($_POST['titulo'])) == 0){ 
		$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `refuser` = '$autor' AND `datein` LIKE '$fil' ORDER BY $orden ";
	}
	else{
	$sqlc =  "SELECT * FROM `$db_name`.$vname WHERE `tit` LIKE '$titulo' AND `refuser` = '$autor' AND `datein` LIKE '$fil' ORDER BY $orden ";
	}
	$qc = mysqli_query($db, $sqlc);

	if(!$qc){
			print("<font color='#FF0000'>Consulte L.77: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			if(mysqli_num_rows($qc)== 0){
					print ("<table align='center'>
								<tr>
									<td>
										<font color='#FF0000'>
											NO HAY DATOS
										</font>
									</td>
								</tr>
							</table>");
									
			} else { 
	print ("<div class=\"juancentra col-xs-12 col-sm-12 col-lg-6\" style=\"	vertical-align: top !important; margin-top: 6px;\">
				Nº NOTICIAS ".mysqli_num_rows($qc).".<br>");

			while($rowb = mysqli_fetch_assoc($qc)){
				global $conte;
				$conte = substr($rowb['conte'],0,70);
				$conte = $conte." ...";		

		require 'Inc_News_While_Total.php';

		} // FIN WHILE

		print("</div>");
			
						} 
			} 
	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	global $cnews;
	$cnews = "<form name='creanews' method='post' action='News_Crear.php' style=\"display:inline-block;\">
					<input type='submit' value='CREAR NUEVA NOTICIA' />
					<input type='hidden' name='volver' value=1 />
				</form>";
	global $titulo;
	$titulo = "MODIFICAR NOTICIAS";

	require 'Inc_Show_Form_01.php';
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
	
	unset($_SESSION['myimg']);
	unset($_SESSION['nid']);
	unset($_SESSION['myvdo']);
	unset($_SESSION['refuser']);
	unset($_SESSION['refnews']);

	global $db;
	global $db_name;
	if (isset($_POST['Orden'])){ $orden = $_POST['Orden']; }
	else { $orden = '`id` ASC'; }
	

	global $dyt1;
	global $dm1;
	global $dd1;
	
	if (@$_POST['dy'] == ''){ $dy1 = date('Y');
							 $dyt1 = date('Y');} 
		else {	$dy1 = "20".$_POST['dy'];
				$dyt1 = "20".$_POST['dy'];}
	if (@$_POST['dm'] == ''){ $dm1 = '';} 
		else { $dm1 = "-".$_POST['dm']."-"; }
	if (@$_POST['dd'] == ''){ $dd1 = '';} else { $dd1 = $_POST['dd'];}
	if ((@$_POST['dm'] == '')&&(@$_POST['dd'] != '')){
				//$dm1 = date('m');
				$dm1 = '';
				$dd1 = $_POST['dd'];
				global $fil;
				$fil = $dy1."-%".$dm1."%-".$dd1."%";
					}
		else{ 	global $fil;
				$fil = $dy1.$dm1.$dd1."%";
					}
					
	global $vname;
	$vname = "gch_news";
	$vname = "`".$vname."`";

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `datein` LIKE '$fil'  ORDER BY $orden  ";

	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("<font color='#FF0000'>Consulte L.171: </font></br>".mysqli_error($db)."</br>");
			
	} else {
		if(mysqli_num_rows($qb)== 0){
			print ("<table align='center'>
						<tr>
							<td>
								<font color='#FF0000'>
									NO HAY DATOS
								</font>
							</td>
						</tr>
					</table>");
									
	} else { 
	print ("<div class=\"juancentra col-xs-12 col-sm-12 col-lg-6\" style=\"	vertical-align: top !important; margin-top: 6px;\">
			Nº NOTICIAS ".mysqli_num_rows($qb).".<br>");
			
		while($rowb = mysqli_fetch_assoc($qb)){
				global $conte;
				$conte = substr($rowb['conte'],0,70);
				$conte = $conte." ...";	
				
		require 'Inc_News_While_Total.php';

	} // FIN WHILE

	print("</div>");
			
			} 
		} 
		
	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
		require '../Gch.Inclu/Master_Index_News_Var.php';
		require '../Gch.Inclu/Master_Index_Total.php';
		
		} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
	global $orden;
	
	$orden = isset($_POST['Orden']);
	
	if (isset($_POST['todo'])){$nombre = "TODOS LOS USUARIOS ".$orden;};	

	$rf = isset($_POST['ref']);
	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){	
										$nombre = $_SESSION['Nombre'];
										$apellido = $_SESSION['Apellidos'];}
	
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Gch.Log";
	
	global $text;
	$text = PHP_EOL."- ADMIN VER ".$ActionTime.PHP_EOL."\t Filtro => ".$nombre." ".$apellido;

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
		
/* Creado por Juan Manuel Barros Pazos 2020/21 */
