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
				}
	elseif(isset($_POST['oculto'])){
		if($form_errors = validate_form()){
			show_form($form_errors);
			} else {process_form();
					//accion_Log();
					}
	} else {show_form();}

} else { require '../Gch.Inclu/table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $db;
	global $db_name;

	$errors = array();

		require 'Espec_Valida.php';

	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	/* GRABAMOS LOS DATOS EN LA TABLA DE ESPECIALIDADES */

		global $db;
		global $db_name;

		global $vespec;
		$vespec = trim($_POST['espec']);
		global $vrefespec;
		$vrefespec = trim(str_replace(' ', '', $_POST['refespec']));

		global $tablename;
		$tablename = "gch_especialidad";
		$tablename = "`".$tablename."`";
		
	$sqla = "INSERT INTO `$db_name`.$tablename (`espec`,`refespec`) VALUES ('$vespec', '$vrefespec')";

	if(mysqli_query($db, $sqla)){

		print("<table align='center' style='margin-top:10px'>
												
				<tr>
					<td width=120px>
						ESPECIALIDAD
					</td>
					<td width=100px>"
						.$vespec.
					"</td>
				</tr>
				
				<tr>
					<td>
						REF ESPECIALIDAD
					</td>
					<td>"
						.$vrefespec.
					"</td>
				</tr>				
				
		</table>");

			global $redir;
			$redir = "<script type='text/javascript'>
							function redir(){
							window.location.href='Espec_Modificar_01.php';
						}
						setTimeout('redir()',6000);
						</script>";
			print ($redir);
				
	} 	else {print("* MODIFIQUE LA ENTRADA L.70: ".mysqli_error($db));
						show_form ();
						//global $texerror;
						//$texerror = "\n\t ".mysqli_error($db);
					}
		
	}	/* FINAL process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if(isset($_POST['oculto2'])){
					unset($_SESSION['espec']);
					unset($_SESSION['refespec']);
	} elseif(isset($_POST['oculto'])){
					$defaults = $_POST;
					$_SESSION['espec'] = $_POST['espec'];
					$_SESSION['refespec'] = $_POST['refespec'];

		} else {
				$defaults = array ( 'espec' => $_SESSION['espec'],
									'refespec' => $_SESSION['refespec']);	
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
						CREE UNA ESPECIALIDAD DE COCINA
				</th>
			</tr>
			
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
					
		<tr>								
			<td align='right' width=100px>
				ESPECIALIDAD
			</td>
			<td>
		<input type='text' name='espec' size=16 maxlength=16 value='".@$defaults['espec']."' />
			</td>
		</tr>

		<tr>
			<td align='right'>
				REFERENCIA
			</td>
			<td align='left'>
		<input type='text' name='refespec' size=16 maxlength=4 value='".@$defaults['refespec']."' />
			</td>
		</tr>

		<tr>
			<td colspan='2' align='right' valign='middle'  class='BorderSup'>
				<input type='submit' value='CREAR ESPECIALIDAD' />
				<input type='hidden' name='oculto' value=1 />
			</td>
		</tr>
	</form>														

		<tr>
			<td colspan=3 align='right' class='BorderSup'>
				<form name='fvolver' action='Espec_Modificar_01.php'  \">
					<input type='submit' value='CANCELAR Y VOLVER INICIO ESPECIALIDADES' />
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
		
				require '../Gch.Inclu/Master_Index_Syst.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gch.Inclu/Admin_Inclu_02.php';

?>