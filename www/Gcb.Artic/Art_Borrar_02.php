<?php
session_start();

  	//require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_01b.php';

	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';

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
} else {  require '../Gcb.Inclu/table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;

	global $secc;	
	$secc = $_POST['autor'];
	$sqlx =  "SELECT * FROM `gcb_admin` WHERE `ref` = '$_POST[autor]'";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	global $_sec;
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];
	//echo $rowautor['Nombre']." ".$rowautor['Apellidos']."</br>";
	
	/* BORRAMOS LOS DATOS EN LA TABLA DE ARTICULOS DE ESTE AÑO */

	global $dyt1;
	$dyt1 = trim($_SESSION['dyt1']);
	global $tablename;
	$tablename = "gcb_art";
	$tablename = "`".$tablename."`";

	$sqla = "DELETE FROM `$db_name`.$tablename WHERE $tablename.`refart` = '$_SESSION[refart]' LIMIT 1 ";

	if(mysqli_query($db, $sqla)){

	$sqlv = "DELETE FROM `$db_name`.`gcb_opiniones` WHERE `gcb_opiniones`.`refart` = '$_SESSION[refart]' ";
	if(mysqli_query($db, $sqlv)){}else {print("* MODIFIQUE LA ENTRADA L.57: ".mysqli_error($db));}

	print("<table align='center' style=\"margin-top:10px\">
		<tr>
			<th colspan=3 class='BorderInf'>
						HA BORRADO EL ARTICULO DE ".strtoupper($_sec)."
			</th>
		</tr>
		<tr>								
				<td width=100px>
						REF AUTOR
				</td>
				<td width=140px>
					".$_SESSION['refuser']."
				</td>
				<td rowspan='7' align='right' width='120px'>
					<img src='../Gcb.Img.Art/".$_SESSION['myimg1']."' height='180px' width='auto' />
				</td>
			</tr>
			<tr>
				<td>
					RESTAURANTE
				</td>
				<td>
					".$_SESSION['tit']."
				</td>
			</tr>
			<tr>
				<td>						
					SUBTITULO
				</td>
				<td>
					".$_SESSION['titsub']."
				</td>
			</tr>
			<tr>
				<td>						
					REFERENCIA
				</td>
				<td>
					".$_SESSION['refart']."
				</td>
			</tr>
			<tr>
				<td>						
					ISLA
				</td>
				<td>
					".$_SESSION['isla']."
				</td>
			</tr>
			<tr>
				<td>						
					AYUNTAMIENTO
				</td>
				<td>
					".$_SESSION['ayto']."
				</td>
			</tr>
			<tr>
				<td>						
					DATE IN
				</td>
				<td>
					".$_SESSION['datein']."
				</td>
			</tr>
			<tr>
				<td colspan=3  align='center'>
					ARTICULO
				</td>
			</tr>
			<tr>
				<td colspan=3>
					".$_SESSION['conte']."
				</td>
			</tr>
			<tr>
			<th colspan=3 class='BorderSup'>
				<a href=Art_Borrar_01.php>ELIMINAR OTRO RESTAURANTE</a>
			</th>
		</tr>

		</table>"); 
			
	} 	else {print("* MODIFIQUE LA ENTRADA L.53: ".mysqli_error($db));
						show_form ();
						//global $texerror;
						//$texerror = "\n\t ".mysqli_error($db);
					}
		
	}	/* FINAL process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){
	
	if(isset($_POST['oculto2'])){
		//$defaults = $_POST;
		
		$_SESSION['modid'] = $_POST['id'];
		$_SESSION['refuser'] = $_POST['refuser'];
		$_SESSION['refart'] = $_POST['refart'];
		$_SESSION['tit'] = $_POST['tit'];
		$_SESSION['titsub'] = $_POST['titsub'];
		$_SESSION['datein'] = $_POST['datein'];
		$_SESSION['timein'] = $_POST['datein'];
		$_SESSION['datemod'] = date('Y-m-d');
		$_SESSION['timemod'] = date('H:i:s');

		$_SESSION['isla'] = $_POST['isla'];
		$_SESSION['ayto'] = $_POST['ayto'];

		$_SESSION['conte'] = $_POST['conte'];
		$_SESSION['myimg1'] = $_POST['myimg1'];
		$_SESSION['myimg2'] = $_POST['myimg2'];
		$_SESSION['myimg3'] = $_POST['myimg3'];
		$_SESSION['myimg4'] = $_POST['myimg4'];

		$_SESSION['tipo'] = $_POST['tipo'];
		$_SESSION['espec1'] = $_POST['espec1'];
		$_SESSION['espec2'] = $_POST['espec2'];
		$_SESSION['iprecio'] = $_POST['iprecio'];
		$_SESSION['ivalora'] = $_POST['ivalora'];
		$_SESSION['url'] = $_POST['url'];
		$_SESSION['map'] = $_POST['map'];
		$_SESSION['calle'] = $_POST['calle'];
		$_SESSION['Email'] = $_POST['Email'];
		$_SESSION['Tlf1'] = $_POST['Tlf1'];
		$_SESSION['Tlf2'] = $_POST['Tlf2'];
		

		}
		
	global $db;
	global $db_name;
	global $autor;
	$autor = $_SESSION['refuser'];
	/* CONSULTAMOS LA TABLA ADMIN = AUTORES */
	$sqlx =  "SELECT * FROM `gcb_admin` WHERE `ref` = '$autor' ";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	global $_sec;
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];

		print("
			<table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
				<tr>
					<th colspan='2'>
						ELIMINAR EL RESTAURANTE ".strtoupper($_SESSION['tit'])."
					</th>
				</tr>		
			
			</table>				
						");
				

	if ((@$_POST['autor'] != '') || ($_SESSION['refuser'] != '')) { 
		
	print("<table align='center' style=\"margin-top:10px; text-align:left; width:96%; max-width:500px\" >
				<tr>
					<th colspan=3 class='BorderInf'>

							SERÁ IMPOSIBLE RECUPERAR ESTE RESTAURANTE
					</th>
				</tr>
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' >
						
			<tr>								
				<td width=100px>
							REF AUTOR
				</td>
				<td width=140px>
			<input name='autor' type='hidden' value='".$_SESSION['refuser']."' />".$_SESSION['refuser']."
				</td>
				<td rowspan='7' align='right' width='auto'>
			<img src='../Gcb.Img.Art/".$_SESSION['myimg1']."' height='180px' width='auto' />
				</td>
			</tr>

			<tr>
				<td>
					RESTAURANTE
				</td>
				<td>
		<input type='hidden' name='titulo' value='".$_SESSION['tit']."' />".$_SESSION['tit']."
				</td>
			</tr>
									
			<tr>
				<td>						
					SUBTITULO
				</td>
				<td>
		<input type='hidden' name='subtitul' value='".$_SESSION['titsub']."' />".$_SESSION['titsub']."
				</td>
			</tr>
									
			<tr>
				<td>						
					REFERENCIA
				</td>
				<td>
		<input type='hidden' name='refart' value='".$_SESSION['refart']."' />".$_SESSION['refart']."
				</td>
			</tr>

			<tr>
				<td>						
					ISLA
				</td>
				<td>
		<input type='hidden' name='refart' value='".$_SESSION['isla']."' />".$_SESSION['isla']."
				</td>
			</tr>

			<tr>
				<td>						
					AYUNTAMIENTO
				</td>
				<td>
		<input type='hidden' name='refart' value='".$_SESSION['ayto']."' />".$_SESSION['ayto']."
				</td>
			</tr>

			<tr>
				<td>						
					DATE IN
				</td>
				<td>
		<input type='hidden' name='datein' value='".$_SESSION['datein']."' />".$_SESSION['datein']."
				</td>
			</tr>

			<tr>
				<td colspan=3  align='center'>
					ARTICULO
				</td>
			</tr>

			<tr>
				<td colspan=3>
		<input type='hidden' name='coment' value='".$_SESSION['conte']."' />".$_SESSION['conte']."
				</td>
			</tr>
								
			<input name='myimg1' type='hidden' value='".$_SESSION['myimg1']."' />

			<tr>
				<td colspan=3 align='right' valign='middle'  class='BorderSup'>
					<input type='submit' value='BORRADO TOTAL RESTAURANTE' />
					<input type='hidden' name='oculto' value=1 />
				</td>
			</tr>
		</form>														
			</table>"); 
						}
	
			}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function deleteimg(){
	
	global $ruta1;
	$ruta1 = "../Gcb.Img.Art/".$_SESSION['myimg1'];
	if(file_exists($ruta1)){unlink($ruta1);
		$data1 = "\n \t UNLINK ".$ruta1;}
			else {print("ERROR UNLINK ".$ruta1."</br>");
					$data1 = "\n \t ERROR UNLINK ".$ruta1;}

	global $ruta2;
	$ruta2 = "../Gcb.Img.Art/".$_SESSION['myimg2'];
	if(file_exists($ruta2)){unlink($ruta2);
		$data2 = "\n \t UNLINK ".$ruta2;}
			else {print("ERROR UNLINK ".$ruta2."</br>");
					$data2 = "\n \t ERROR UNLINK ".$ruta2;}

	global $ruta3;
	$ruta3 = "../Gcb.Img.Art/".$_SESSION['myimg3'];
	if(file_exists($ruta3)){unlink($ruta3);
		$data3 = "\n \t UNLINK ".$ruta3;}
			else {print("ERROR UNLINK ".$ruta3."</br>");
					$data3 = "\n \t ERROR UNLINK ".$ruta3;}

	global $ruta4;
	$ruta4 = "../Gcb.Img.Art/".$_SESSION['myimg4'];
	if(file_exists($ruta4)){unlink($ruta4);
		$data4 = "\n \t UNLINK ".$ruta4;}
			else {print("ERROR UNLINK ".$ruta4."</br>");
					$data4 = "\n \t ERROR UNLINK ".$ruta4;}

	global $ddr;
	$ddr = "\t* ".$data1." \n\t* ".$data2." \n\t* ".$data3." \n\t* ".$data4." \n";
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
		
				require '../Gcb.Inclu/Master_Index_Artic.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='../Admin/mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gcb.Inclu/Admin_Inclu_02.php';

?>