<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_popup.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'plus')){
				
	if(isset($_POST['oculto2'])){ 
				show_form();
				//info();
		}
	elseif(isset($_POST['oculto'])){ process_form(); } 
	else { show_form(); }
								
} else { require '../Gch.Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){

	global $db;
	global $db_name;

	global $tablename;
	$tablename = "gch_news";
	$tablename = "`".$tablename."`";

	$sqla = "UPDATE `$db_name`.$tablename SET `myvdo` = '' WHERE $tablename.`myvdo` = '$_SESSION[myvdo]' LIMIT 1 ";

	if(mysqli_query($db, $sqla)){

		global $rutav;
		$rutav = "../Gch.Vdo.News/".$_SESSION['myvdo'];
		if(file_exists($rutav)){unlink($rutav);}
		else {}

		if(file_exists($rutav)){
			global $errordelv;
			$errordelv = "<tr>
							<td colspan=2 class='BorderInf' style=\"text-align:center;\">
								ERROR UNLINK ".$rutav."
							</td>
						</tr>";
						}
		else {	global $errordelv;
				$errordelv = "";}

	print("<table align='center' style=\"text-align:left; margin-top:40px;\">
			".$errordelv."
		<tr>
			<td colspan=2 class='BorderInf' style=\"text-align:center;\">
					HA BORRADO EL VIDEO ".strtoupper($_SESSION['myvdo'])."
			</td>
		</tr>
		<tr>
			<td width=100px style=\"text-align:right;\">ID</td>
			<td width=140px>".$_SESSION['nid']."</td>
		</tr>
		<tr>								
			<td width=100px style=\"text-align:right;\">REF ARTICULO</td>
			<td width=140px>".$_SESSION['refnews']."</td>
		</tr>
		<tr>								
			<td width=100px style=\"text-align:right;\">REF AUTOR</td>
			<td width=140px>".$_SESSION['refuser']."</td>
		</tr>

		<tr>
			<td colspan=2 style=\"text-align:right;\" class='BorderSup'>
				<form name='closewindow' action='$_SERVER[PHP_SELF]' onsubmit=\"window.close()\">
					<input type='submit' value='CERRAR VENTANA' />
					<input type='hidden' name='oculto2' value=1 />
				</form>
			</td>
		</tr>
	</table>"); 

	global $redir;
	$redir = "<script type='text/javascript'>
				function redir(){
					window.close();
						}
				setTimeout('redir()',6000);
			</script>";
	print ($redir);

			
	} 	else {print("* MODIFIQUE LA ENTRADA L.33: ".mysqli_error($db));
						show_form ();
					}

}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){

	if(isset($_POST['oculto2'])){
					$_SESSION['nid'] = $_POST['id'];
					$_SESSION['refuser'] = $_POST['refuser'];
					$_SESSION['refnews'] = $_POST['refnews'];
					$_SESSION['myvdo'] = $_POST['myvdo'];
		} else{ }

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
	
	print("<table align='center' style=\"text-align:left; width:96%; max-width:500px; margin-top:20px;\" >
			<tr>
				<td colspan=2  class='BorderInf' style=\"text-align:center;\">
					DETALLES DEL VIDEO
				</td>
			</tr>
				
			<tr>	
				<td colspan=2 style=\"text-align:center;\">
					<video controls width='98%' height='auto'>
						<source src='../Gch.Vdo.News/".$_SESSION['myvdo']."' />
					</video>					
				</td>
			</tr>

			<tr>
				<td width=100px style=\"text-align:right;\">VIDEO NAME</td>
				<td width=140px>".$_SESSION['myvdo']."</td>
			</tr>
				
			<tr>
				<td style=\"text-align:right;\">VIDEO REF</td>
				<td>".$_POST['refnews']."</td>
			</tr>

			<tr>
				<td width=100px style=\"text-align:right;\">NEWS ID</td>
				<td width=140px>".$_SESSION['nid']."</td>
			</tr>
				
			<tr>
				<td style=\"text-align:right;\">AUTOR NAME</td>
				<td>".$_sec."</td>
			</tr>
				
			<tr>
				<td style=\"text-align:right;\">AUTOR REF</td>
				<td>".$_SESSION['refuser']."</td>
			</tr>
				
			<tr>
				<td colspan=2 align='center' valign='middle'  class='BorderSup'>
					<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' >
						<input name='myvdo' type='hidden' value='".$_SESSION['myvdo']."' />
						<input type='submit' value='BORRAR ESTE VIDEO' />
						<input type='hidden' name='oculto' value=1 />
					</form>	
				</td>
			</tr>

			<tr>
				<td colspan=2 align='right' class='BorderSup'>
					<form name='closewindow' action='$_SERVER[PHP_SELF]' onsubmit=\"window.close()\">
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
