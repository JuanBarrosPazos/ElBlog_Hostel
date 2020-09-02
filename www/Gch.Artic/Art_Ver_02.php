<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_popup.php';
	require '../Gch.Inclu/mydni.php';

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
	global $_sec;
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];
	
	if(strlen(trim($_POST['myvdo'])) > 0){
		global $visual;
		$visual = "<video controls width='98%' height='auto'>
						<source src='../Gch.Vdo.Art/".$_POST['myvdo']."' />
					</video>";
	} else { global $visual;
			 $visual = "<img src='../Gch.Img.Art/untitled.png' width='92%' height='auto' />";
				}

	print("<table align='center' style=\"text-align:left; width:96%; min-width:340px\" >
				<tr>
					<th colspan=3  class='BorderInf'>
						DETALLES DEL RESTAURANTE
					</th>
				</tr>
				
				<tr>
					<td width=100px >ID</td>
					<td>".$_POST['id']."</td>
					<td rowspan='5' align='center' width='auto'>
	<img src='../Gch.Img.Art/".$_POST['myimg1']."'  width='90%' height='auto' />
					</td>
				</tr>
				
				<tr>
					<td>AUTOR REF</td>
					<td>".$_POST['refuser']."</td>
				</tr>
				
				<tr>
					<td>AUTOR</td>
					<td>".$_sec."</td>
				</tr>
				
				<tr>
					<td>ART REF</td>
					<td>".$_POST['refart']."</td>
				</tr>
				
				<tr>
					<td>NAME</td>
					<td>".$_POST['tit']."</td>
				</tr>
				
				<tr>
					<td>SUBTIT</td>
					<td>".$_POST['titsub']."</td>
					<td rowspan='5' align='center' width='auto'>
						".$visual."
					</td>
				</tr>				
				
				<tr>
					<td>ISLA</td>
					<td>".$_POST['isla']."</td>
				</tr>				
				
				<tr>
					<td>AYTO</td>
					<td>".$_POST['ayto']."</td>
				</tr>				
				
				<tr>
					<td>LOCAL</td>
					<td>".$_POST['tipo']."</td>
				</tr>				
				
				<tr>
					<td>COCINA</td>
					<td>".$_POST['espec1']." / ".$_POST['espec2']."</td>
				</tr>				
				
				<tr>
					<td>DIRECCION</td>
					<td colspan='2'>".$_POST['calle']."</td>
				</tr>				
				
				<tr>
					<td>WEB</td>
					<td colspan='2'>".$_POST['url']."</td>
				</tr>				
				
				<tr>
					<td>EMAIL</td>
					<td colspan='2'>".$_POST['Email']."</td>
				</tr>				
				
				<tr>
					<td>TELEFONO</td>
					<td colspan='2'>".$_POST['Tlf1']." / ".$_POST['Tlf2']."</td>
				</tr>				
				
				<tr>
					<td>DATE IN</td>
					<td colspan='2'>".$_POST['datein']." / ".$_POST['timein']."</td>
				</tr>				
				
				<tr>
					<td>DATE MOD</td>
					<td colspan='2'>".$_POST['datemod']." / ".$_POST['timemod']."</td>
				</tr>				
				
				<tr>
					<td colspan='3' align='center'>ARTICULO</td>
				</tr>
				<tr>
					<td colspan='3' align='left'>".$_POST['conte']."</td>
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
