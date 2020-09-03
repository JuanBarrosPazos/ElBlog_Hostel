<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_01b.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ 

					master_index();

							if (isset($_POST['oculto2'])){
										show_form();
										//accion_Log();
									}
							elseif(isset($_POST['oculto'])){
											process_form();
											accion_Log();
											deleteimg();
							} else {
										show_form();
								}
} else {  require '../Gch.Inclu/table_permisos.php'; } 

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
	
	/* BORRAMOS LOS DATOS EN LA TABLA DE NOTICIAS DE ESTE AÑO */

	global $dyt1;
	$dyt1 = trim($_SESSION['dyt1']);
	global $tablename;
	$tablename = "gch_news";
	$tablename = "`".$tablename."`";

	$sqla = "DELETE FROM `$db_name`.$tablename WHERE $tablename.`refnews` = '$_SESSION[refnews]' LIMIT 1 ";

	if(mysqli_query($db, $sqla)){

			global $new_name;

	print("<table align='center' style=\"margin-top:10px\">
		<tr>
			<th colspan=3 class='BorderInf'>
						HA BORRADO EL ARTICULO DE ".strtoupper($_sec)."
			</th>
		</tr>
		<tr>								
				<td width=100px>REF AUTOR</td>
				<td width=140px>".$_SESSION['refuser']."</td>
				<td rowspan='5' align='right' width='120px'>
					<img src='../Gch.Img.News/".$_SESSION['myimg']."' height='120px' width='90px' />
				</td>
			</tr>
			<tr>
				<td>TITULO</td>
				<td>".$_SESSION['tit']."</td>
			</tr>
			<tr>
				<td>SUBTITULO</td>
				<td>".$_SESSION['titsub']."</td>
			</tr>
			<tr>
				<td>REFERENCIA</td>
				<td>".$_SESSION['refnews']."</td>
			</tr>
			<tr>
				<td>DATE IN</td>
				<td>".$_SESSION['datein']."</td>
			</tr>
			<tr>
				<td>TIME IN</td>
				<td>".$_SESSION['timein']."</td>
			</tr>
			<tr>
				<td>DATE MOD</td>
				<td>".$_SESSION['datemod']."</td>
			</tr>
			<tr>
				<td>TIME MOD</td>
				<td>".$_SESSION['timemod']."</td>
			</tr>
			<tr>
				<td colspan=3  align='center'>ARTICULO</td>
			</tr>
			<tr>
				<td colspan=3>".$_SESSION['conte']."</td>
			</tr>
		</table>"); 
			
	} 	else {print("* MODIFIQUE LA ENTRADA L.70: ".mysqli_error($db));
						show_form ();
						//global $texerror;
						//$texerror = "\n\t ".mysqli_error($db);
					}
		
	}	/* FINAL process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){
	
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
		$_SESSION['myvdo'] = $_POST['myvdo'];
		
		$defaults = array ( 'autor' => $_SESSION['refuser'],  // ref autor
							'titulo' => $_SESSION['tit'], // Titulo
							'subtitul' => $_SESSION['titsub'], // Sub Titulo
							'refnews' => $_SESSION['refnews'], // Referencia articulo
							'datein' => $_SESSION['datein'], // Sub Titulo
							'timein' => $_SESSION['timein'], // Sub Titulo
							'datemod' => $_SESSION['datemod'], // Sub Titulo
							'timemod' => $_SESSION['timemod'], // Sub Titulo
							'coment' => $_SESSION['conte'],
							'myimg' => $_SESSION['myimg'],	
							'myvdo' => $_SESSION['myvdo'],	
									);

		} elseif(isset($_POST['oculto'])){
					$defaults = $_POST;
		} else {
		$defaults = array ( 'autor' => $_SESSION['refuser'],  // ref autor
							'titulo' => $_SESSION['tit'], // Titulo
							'subtitul' => $_SESSION['titsub'], // Sub Titulo
							'refnews' => $_SESSION['refnews'], // Referencia articulo
							'datein' => $_SESSION['datein'], // Sub Titulo
							'timein' => $_SESSION['timein'], // Sub Titulo
							'datemod' => $_SESSION['datemod'], // Sub Titulo
							'timemod' => $_SESSION['timemod'], // Sub Titulo
							'coment' => $_SESSION['conte'],
							'myimg' => $_SESSION['myimg'],	
									);
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
				<tr>
					<th colspan='2'>
						ELIMINAR ARTICULO DE ".strtoupper($_sec)."
					</th>
				</tr>		
			</table>");
				
	if ((@$_POST['autor'] != '') || ($_SESSION['refuser'] != '')) { 
		
	print("<table align='center' style=\"margin-top:10px; text-align:left; width:96%; max-width:500px\" >
				<tr>
					<th colspan=3 class='BorderInf'>
							SERÁ IMPOSIBLE RECUPERAR ESTE ARTICULO
					</th>
				</tr>

				<tr>
					<td colspan=3 align='center' class='BorderInf' >
						<form name='fcancel' method='post' action='News_Modificar_01' >
								<input type='submit' value='CANCELAR Y VOLVER' />
								<input type='hidden' name='cancel' value=1 />
						</form>
					</td>
				</tr>
					
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' >
						
			<tr>								
				<td width=100px>REF AUTOR</td>
				<td width=140px>
			<input name='autor' type='hidden' value='".$_SESSION['refuser']."' />".$_SESSION['refuser']."
						</td>
					<td rowspan='5' align='right' width='auto'>
			<img src='../Gch.Img.News/".$_SESSION['myimg']."' width='90%' height='auto' />
					</td>
			</tr>

			<tr>
				<td>TITULO</td>
				<td>
		<input type='hidden' name='titulo' value='".$_SESSION['tit']."' />".$_SESSION['tit']."
					</td>
				</tr>
									
				<tr>
					<td>SUBTITULO</td>
					<td>
		<input type='hidden' name='subtitul' value='".$_SESSION['titsub']."' />".$_SESSION['titsub']."
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
					<td>DATE MOD</td>
					<td>
		<input type='hidden' name='datemod' value='".$_SESSION['datemod']."' />".$_SESSION['datemod']."
					</td>
				</tr>
				<tr>
					<td>TIME MOD</td>
					<td>
		<input type='hidden' name='timemod' value='".$_SESSION['timemod']."' />".$_SESSION['timemod']."
					</td>
				</tr>

				<tr>
					<td colspan=3  align='center'>ARTICULO</td>
				</tr>

				<tr>
					<td colspan=3>
		<input type='hidden' name='coment' value='".$_SESSION['conte']."' />".$_SESSION['conte']."
					</td>
				</tr>
								
			<input name='myimg' type='hidden' value='".$_SESSION['myimg']."' />
			<input name='myvdo' type='hidden' value='".$_SESSION['myvdo']."' />

				<tr>
					<td colspan=3 align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='BORRADO TOTAL ARTICULO' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
		</form>	

				<tr>
					<td colspan=3 align='center' class='BorderSup' >
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

function deleteimg(){
	
	global $ruta;
	$ruta = "../Gch.Img.News/".$_SESSION['myimg'];

	if(file_exists($ruta)){unlink($ruta);
		$data1 = "\n \t UNLINK ".$ruta;}
			else {print("ERROR UNLINK ".$ruta."</br>");
					$data1 = "\n \t ERROR UNLINK ".$ruta;}

	global $rutav;
	$rutav = "../Gch.Vdo.News/".$_SESSION['myvdo'];

	if(file_exists($rutav)){unlink($rutav);
		$datav1 = "\n \t UNLINK ".$rutav;}
			else {print("ERROR UNLINK ".$rutav."</br>");
					$datav1 = "\n \t ERROR UNLINK ".$rutav;}
					
	global $ddr;
	$ddr = "\t* ".$data1." \n\t* ".$datav1." \n";
}

//////////////////////////////////////////////////////////////////////////////////////////////
function accion_Log(){}
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