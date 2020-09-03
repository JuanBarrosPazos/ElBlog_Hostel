<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_01b.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ 

	master_index();

	if (isset($_POST['tipomodif'])){  show_form();
									//accion_Log();
									}
	elseif(isset($_POST['oculto'])){
							
		if($form_errors = validate_form()){
						show_form($form_errors);
							} else {
									process_form();
									//accion_Log();
										}
	} else { show_form(); }

} else { require '../Gch.Inclu/table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $db;
	global $db_name;

	$errors = array();

		require 'Tipo_Valida.php';
		
	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	/* GRABAMOS LOS DATOS EN LA TABLA TIPOLOGIAS */

	global $db;
	global $db_name;

	global $vtipo;
	$vtipo = trim($_POST['tipo']);
	global $vreftipo;
	$vreftipo = trim(str_replace(' ', '', $_POST['reftipo']));

	global $tablename;
	$tablename = "gch_tipologia";
	$tablename = "`".$tablename."`";

	$sqla = "UPDATE `$db_name`.$tablename SET `tipo` = '$vtipo', `reftipo` = '$vreftipo' WHERE $tablename.`id` = '$_SESSION[tipoid]' ";

	if(mysqli_query($db, $sqla)){

	$sqld = "UPDATE `$db_name`.`gch_art` SET `reftipo` = '$vreftipo' WHERE `gch_art`.`reftipo` = '$_SESSION[reftipo]' ";
	if(mysqli_query($db, $sqld)){}
	else{echo "NO SE HAN ACTUALIZADO LAS ENTRADAS EN gch_art ".$vreftipo."<br> * MODIFIQUE LA ENTRADA L.89: ".mysqli_error($db);}

		print("<table align='center' style='margin-top:10px'>
				<tr>
					<td width=120px>
						TIPOLOGIA
					</td>
					<td width=100px>"
						.$vtipo.
					"</td>
				</tr>
				
				<tr>
					<td>
						REF TIPOLOGIA
					</td>
					<td>"
						.$vreftipo.
					"</td>
				</tr>				
				<tr>
					<td colspan=3 align='center' class='BorderSup BorderInf'>
						<form name='fvolver' action='Tipo_Modificar_01.php'  \">
							<input type='submit' value='VOLVER INICIO TIPOLOGIAS' />
							<input type='hidden' name='volver' value=1 />
						</form>
					</td>
				</tr>
		</table>");

		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='Tipo_Modificar_01.php';
					}
					setTimeout('redir()',6000);
					</script>";
		print ($redir);
				
	} 	else {print("* MODIFIQUE LA ENTRADA L.85: ".mysqli_error($db));
						show_form ();
					}
		
	}	/* FINAL process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	global $db;
	
	if(isset($_POST['tipomodif'])){
		//$defaults = $_POST;
		
		$_SESSION['tipoid'] = $_POST['id'];
		$_SESSION['reftipo'] = $_POST['reftipo'];
		$_SESSION['tipo'] = $_POST['tipo'];

		$defaults = array ( 'tipo' => $_SESSION['tipo'],
							'reftipo' => $_SESSION['reftipo']);

		} 
	elseif(isset($_POST['oculto'])){
					$defaults = $_POST;
		} else {
				$defaults = array ( 'tipo' => $_SESSION['tipo'],
									'reftipo' => $_SESSION['reftipo']);	
						}
	
	if ($errors){
		print("<table align='center'>
					<th style='text-align:center'>
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
		}

	print("
		<table align='center' style=\"margin-top:10px\">
			<tr>
				<th colspan=2 class='BorderInf'>
						MODIFIQUE LA TIPOLOGIA DE NEGOCIO
				</th>
			</tr>
			
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
					
		<tr>								
			<td align='right' width=100px>
				TIPOLOGIA
			</td>
			<td>
		<input type='text' name='tipo' size=16 maxlength=16 value='".@$defaults['tipo']."' />
			</td>
		</tr>

		<tr>
			<td align='right'>
				REFERENCIA
			</td>
			<td align='left'>
		<input type='text' name='reftipo' size=16 maxlength=4 value='".@$defaults['reftipo']."' />
			</td>
		</tr>

		<tr>
			<td colspan='2' align='right' valign='middle'  class='BorderSup'>
				<input type='hidden' name='id' value='".@$_SESSION['tipoid']."' />
				<input type='submit' value='MODIFICAR TIPOLOGIA' />
				<input type='hidden' name='oculto' value=1 />
			</td>
		</tr>
	</form>														

		<tr>
			<td colspan=3 align='center' class='BorderSup'>
				<form name='fvolver' action='Tipo_Modificar_01.php'  \">
					<input type='submit' value='CANCELAR Y VOLVER INICIO TIPOLOGIAS' />
					<input type='hidden' name='volver' value=1 />
				</form>
			</td>
		</tr>

	</table>"); 
	
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

		require '../Gch.Inclu/Master_Index_Syst_Var.php';
		require '../Gch.Inclu/Master_Index_Total.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gch.Inclu/Admin_Inclu_02.php';

?>