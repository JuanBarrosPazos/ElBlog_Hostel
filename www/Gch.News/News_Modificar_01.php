<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_01b.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){ 

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
			print("<font color='#FF0000'>Consulte L.587: </font></br>".mysqli_error($db)."</br>");
			
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
									
				} else { 	print ("<table align='center'>
									<tr>
										<th colspan=6 class='BorderInf'>
									Nº NOTICIAS ".mysqli_num_rows($qc).".
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											Autor
										</th>

										<th class='BorderInfDch'>
											Referencia
										</th>
										
										<th class='BorderInfDch'>
											Titulo
										</th>
										
										<th class='BorderInfDch'>
											Fecha In
										</th>
										
										<th class='BorderInfDch'>
											Contenido
										</th>
																				
										<th class='BorderInfDch'>
											Imagen
										</th>
									</tr>");
			
			while($rowc = mysqli_fetch_assoc($qc)){
				global $conte;
				$conte = substr($rowc['conte'],0,70);
				$conte = $conte." ...";		
	print (	"<tr align='center'>
									
	<form name='ver' action='News_Modificar_02.php' method='POST'>

	<input name='id' type='hidden' value='".$rowc['id']."' />
	<input name='dyt1' type='hidden' value='".$dyt1."' />
							
						<td class='BorderInfDch'>
	<input name='refuser' type='hidden' value='".$rowc['refuser']."' />".$rowc['refuser']."
						</td>
							
						<td class='BorderInfDch'>
	<input name='refnews' type='hidden' value='".$rowc['refnews']."' />".$rowc['refnews']."
						</td>
							
						<td class='BorderInfDch'>
	<input name='tit' type='hidden' value='".$rowc['tit']."' />".$rowc['tit']."
						</td>
	<input name='titsub' type='hidden' value='".$rowc['titsub']."' />
						
						<td class='BorderInfDch'>
	<input name='datein' type='hidden' value='".$rowc['datein']."' />".$rowc['datein']."
						</td>
	<input name='timein' type='hidden' value='".$rowc['timein']."' />

	<input name='datemod' type='hidden' value='".$rowc['datemod']."' />
	<input name='timemod' type='hidden' value='".$rowc['timemod']."' />

						<td class='BorderInfDch' width='250px'align='left'>
	<input name='conte' type='hidden' value='".$rowc['conte']."' />".$conte."
						</td>

						<td class='BorderInf' width='80px'>
	<input name='myimg' type='hidden' value='".$rowc['myimg']."' />
	<img src='../Gch.Img.News/".$rowc['myimg']."'  width='70%' height='auto' />
						</td>
												
						</tr>
						<tr>
							<td colspan=3 class='BorderInf'>
												&nbsp;
							</td>
							<td colspan=2 align='right' class='BorderInfDch'>
								<input type='submit' value='MODIFICAR DATOS' />
							<input type='hidden' name='oculto2' value=1 />
					</form>
							</td>
							<td align='center' class='BorderInf'>
						
	<form name='modifica_img' action='News_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=540px, height=auto')\">

			<input name='id' type='hidden' value='".$rowc['id']."' />
			<input name='dyt1' type='hidden' value='".$dyt1."' />
			<input name='refuser' type='hidden' value='".$rowc['refuser']."' />
			<input name='refnews' type='hidden' value='".$rowc['refnews']."' />
			<input name='tit' type='hidden' value='".$rowc['tit']."' />
			<input name='titsub' type='hidden' value='".$rowc['titsub']."' />
			<input name='datein' type='hidden' value='".$rowc['datein']."' />
			<input name='timein' type='hidden' value='".$rowc['timein']."' />
			<input name='datemod' type='hidden' value='".$rowc['datemod']."' />
			<input name='timemod' type='hidden' value='".$rowc['timemod']."' />
			<input name='conte' type='hidden' value='".$rowc['conte']."' />						
			<input name='myimg' type='hidden' value='".$rowc['myimg']."' />

			<input type='submit' value='MODIFICAR IMAGEN' />
			<input type='hidden' name='oculto2' value=1 />
			
			</form>
				</td>	
			</tr>");
					}

		print("</table>");
			
						} 
			} 
	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	global $cnews;
	$cnews = "<form name='creanews' action='News_Crear.php' style=\"display:inline-block;\">
					<input type='submit' value='CREAR NUEVA NOTICIA' />
					<input type='hidden' name='volver' value=1 />
				</form>";
	global $bnews;
	$bnews = "<form name='borranews' action='News_Borrar_01.php' style=\"display:inline-block;\">
					<input type='submit' value='BORRAR UNA NOTICIA' />
					<input type='hidden' name='volver' value=1 />
				</form>";
	global $titulo;
	$titulo = "MODIFICAR NOTICIAS";

	require 'Inc_Show_Form_01.php';
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;
	$orden = $_POST['Orden'];

	global $dyt1;
	global $dm1;
	global $dd1;
	
	if ($_POST['dy'] == ''){ $dy1 = date('Y');
							 $dyt1 = date('Y');} 
							 				else {	$dy1 = "20".$_POST['dy'];
													$dyt1 = "20".$_POST['dy'];
													}
	if ($_POST['dm'] == ''){ $dm1 = '';} 
							 				else {	$dm1 = "-".$_POST['dm']."-";
													}
	if ($_POST['dd'] == ''){ $dd1 = '';} else {	$dd1 = $_POST['dd'];}
	
	/**/
	if (($_POST['dm'] == '')&&($_POST['dd'] != '')){//$dm1 = date('m');
													$dm1 = '';
													$dd1 = $_POST['dd'];
													global $fil;
													$fil = $dy1."-%".$dm1."%-".$dd1."%";
																					}
												else{ global $fil;												  $fil = $dy1.$dm1.$dd1."%";
														}
	global $vname;
	$vname = "gch_news";
	$vname = "`".$vname."`";

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `datein` LIKE '$fil'  ORDER BY $orden  ";

	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("<font color='#FF0000'>Consulte L.587: </font></br>".mysqli_error($db)."</br>");
			
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
									
				} else { 	print ("<table align='center'>
									<tr>
										<th colspan=6 class='BorderInf'>
									Nº NOTICIAS ".mysqli_num_rows($qb).".
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											Autor
										</th>

										<th class='BorderInfDch'>
											Referencia
										</th>
										
										<th class='BorderInfDch'>
											Titulo
										</th>
										
										<th class='BorderInfDch'>
											Fecha In
										</th>
										
										<th class='BorderInfDch'>
											Contenido
										</th>
																				
										<th class='BorderInf'>
											Imagen
										</th>
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){
				global $conte;
				$conte = substr($rowb['conte'],0,70);
				$conte = $conte." ...";		
	print (	"<tr align='center'>
									
	<form name='ver' action='News_Modificar_02.php' method='POST'>

	<input name='id' type='hidden' value='".$rowb['id']."' />
	<input name='dyt1' type='hidden' value='".$dyt1."' />

						<td class='BorderInfDch'>
	<input name='refuser' type='hidden' value='".$rowb['refuser']."' />".$rowb['refuser']."
						</td>
							
						<td class='BorderInfDch'>
	<input name='refnews' type='hidden' value='".$rowb['refnews']."' />".$rowb['refnews']."
						</td>
							
						<td class='BorderInfDch'>
	<input name='tit' type='hidden' value='".$rowb['tit']."' />".$rowb['tit']."
						</td>
	<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
						
						<td class='BorderInfDch'>
	<input name='datein' type='hidden' value='".$rowb['datein']."' />".$rowb['datein']."
						</td>
	<input name='timein' type='hidden' value='".$rowb['timein']."' />

	<input name='datemod' type='hidden' value='".$rowb['datemod']."' />
	<input name='timemod' type='hidden' value='".$rowb['timemod']."' />

						<td class='BorderInfDch' width='250px'align='left'>
	<input name='conte' type='hidden' value='".$rowb['conte']."' />".$conte."
						</td>

						<td class='BorderInf' width='80px'>
	<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
	<img src='../Gch.Img.News/".$rowb['myimg']."'  width='70%' height='auto' />
						</td>
												
						</tr>
						<tr>
					<td colspan=3 class='BorderInf'>
												&nbsp;
					</td>
					<td colspan=2 align='right' class='BorderInfDch'>
							<input type='submit' value='MODIFICAR DATOS' />
							<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				<td align='center' class='BorderInf'>
						
		<form name='modifica_img' action='News_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=540px, height=auto')\">

			<input name='id' type='hidden' value='".$rowb['id']."' />
			<input name='dyt1' type='hidden' value='".$dyt1."' />
			<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
			<input name='refnews' type='hidden' value='".$rowb['refnews']."' />
			<input name='tit' type='hidden' value='".$rowb['tit']."' />
			<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
			<input name='datein' type='hidden' value='".$rowb['datein']."' />
			<input name='timein' type='hidden' value='".$rowb['timein']."' />
			<input name='datemod' type='hidden' value='".$rowb['datemod']."' />
			<input name='timemod' type='hidden' value='".$rowb['timemod']."' />
			<input name='conte' type='hidden' value='".$rowb['conte']."' />						
			<input name='myimg' type='hidden' value='".$rowb['myimg']."' />

			<input type='submit' value='MODIFICAR IMAGEN' />
			<input type='hidden' name='oculto2' value=1 />
			
		</form>
				</td>	
			</tr>");
					}

	print("</table>");
			
						} 

			} 
		
	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Gch.Inclu/Master_Index_Artic.php';
		
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
		
/* Creado por Juan Barros Pazos 2019 */
