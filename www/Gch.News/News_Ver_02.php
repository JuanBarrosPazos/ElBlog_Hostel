<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_popup.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){
				
				if($_POST['oculto2']){ process_form();
										//info();
								} 
								
} else { require '../Gch.Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;

	$sqlx =  "SELECT * FROM `gch_admin` WHERE `ref` = '$_POST[refuser]'";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	if($rowautor['Nombre'] == ''){
		global $_sec;
		$_sec = "ANOMINO";
	} else {
	global $_sec;
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];
	}
	
	print("<table align='center' style=\"text-align:left; width:96%; max-width:500px\" >
				<tr>
					<th colspan=3  class='BorderInf'>
						DETALLES DEL ARTICULO
					</th>
				</tr>
				
				<tr>
					<td width=100px >
						ID:
					</td>
					<td width=140px>"
						.$_POST['id'].
					"</td>
					<td rowspan='5' align='center' width='auto'>
	<img src='../Gch.Img.News/".$_POST['myimg']."'  width='90%' height='auto' />
					</td>
				</tr>
				
				<tr>
					<td>
						AUTOR REF:
					</td>
					<td>"
						.$_POST['refuser'].
					"</td>
				</tr>
				
				<tr>
					<td>
						AUTOR NAME:
					</td>
					<td>"
					.$_sec.
					"</td>
				</tr>
				
				<tr>
					<td>
						REFERENCIA
					</td>
					<td>"
						.$_POST['refnews'].
					"</td>
				</tr>
				
				<tr>
					<td>
						TITULO
					</td>
					<td>"
						.$_POST['tit'].
					"</td>
				</tr>
				
				<tr>
					<td>
						SUBTITULO
					</td>
					<td>"
						.$_POST['titsub'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						DATE IN
					</td>
					<td>"
						.$_POST['datein'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						TIME IN
					</td>
					<td colspan='2'>"
						.$_POST['timein'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						DATE MOD
					</td>
					<td colspan='2'>"
						.$_POST['datemod'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						TIME MOD
					</td>
					<td colspan='2'>"
						.$_POST['timemod'].
					"</td>
				</tr>
				
				<tr>
					<td colspan='3' align='center'>
						ARTICULO
					</td>
				</tr>
				<tr>
					<td colspan='3' align='left'>"
						.$_POST['conte'].
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
								
			</table>"); 

			}
			
/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
		
	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');
	
	global $dir;
	$dir = "../Gch.Log";
	
	global $text;
	$text = PHP_EOL."- ADMIN VER DETALLES ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido;

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
		
/* Creado por Juan Barros Pazos 2020 */

?>
