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

		require 'Ayto_Valida.php';

	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	/* GRABAMOS LOS DATOS EN LA TABLA AYUNTAMIENTOS */

		global $db;
		global $db_name;

		require 'Inclu_Name_Ref_to_Name.php';

		global $vayto;
		$vayto = trim($_POST['ayto']);
		global $vrefayto;
		$vrefayto = trim(str_replace(' ', '', $_POST['refayto']));

		global $visla;
		$visla = $_POST['isla'];

		global $tablename;
		$tablename = "gch_aytos";
		$tablename = "`".$tablename."`";
		
	$sqla = "INSERT INTO `$db_name`.$tablename (`ayto`,`refayto`,`refisla`) VALUES ('$vayto', '$vrefayto', '$visla' )";

	if(mysqli_query($db, $sqla)){

		print("<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 width=120px>
						CREADO EL AYUNTAMIENTO
					</th>
				</tr>

				<tr>
					<td width=120px>
						AYUNTAMIENTO
					</td>
					<td width=100px>"
						.$vayto.
					"</td>
				</tr>
				
				<tr>
					<td>
						REF AYTO
					</td>
					<td>"
						.$vrefayto.
					"</td>
				</tr>				
				
				<tr>
					<td>
						REF ISLA
					</td>
					<td>"
						.$_POST['isla']." / ".$islaname.
					"</td>
				</tr>				
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
						<form name='fvolver' action='Ayto_Modificar_01.php'  \">
							<input type='submit' value='CANCELAR Y VOLVER INICIO AYUNTAMIENTOS' />
							<input type='hidden' name='volver' value=1 />
						</form>
					</td>
				</tr>
		</table>");

			global $redir;
			$redir = "<script type='text/javascript'>
							function redir(){
							window.location.href='Ayto_Modificar_01.php';
						}
						setTimeout('redir()',6000);
						</script>";
			print ($redir);
				
	} 	else {print("* MODIFIQUE LA ENTRADA L.64: ".mysqli_error($db));
						show_form ();
						//global $texerror;
						//$texerror = "\n\t ".mysqli_error($db);
					}
		
	}	/* FINAL process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if(isset($_POST['oculto2'])){ unset($_SESSION['ayto']);
								  unset($_SESSION['refayto']);
								  unset($_SESSION['refisla']);
										} 
	elseif(isset($_POST['oculto'])){ 	$defaults = $_POST;
										$_SESSION['isla'] = $_POST['isla'];
									    $_SESSION['ayto'] = $_POST['ayto'];
										$_SESSION['refayto'] = $_POST['refayto'];
										} 
	else { $defaults = array (  'ayto' => @$_SESSION['ayto'],
								'refayto' => @$_SESSION['refayto'],	
								'isla' => @$_SESSION['refisla']);
								}
	
	global $db;
	global $isla;
	//$isla = @$_POST['isla'];
	$isla = @$_SESSION['isla'];
	
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
						CREE UN AYUNTAMIENTO
				</th>
			</tr>
			
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
					
		<tr>								
			<td align='right' width=100px>
				ISLA
			</td>
			<td>

			<select name='isla'>
			<option value=''>ISLAS</option>");
						
	/* RECORREMOS LOS VALORES DE LA TABLA ISLAS PARA CONSTRUIR CON ELLOS UN SELECT */	
			
	global $db;
	$sqlb =  "SELECT * FROM `gch_islas` ORDER BY `isla` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['refisla']."' ");
					
					if($rows['refisla'] == @$defaults['isla']){
															print ("selected = 'selected'");
																								}
									print ("> ".$rows['isla']."</option>");
				}
			}  

	print ("</select>
			</td>
		</tr>

		<tr>								
			<td align='right' width=100px>
				AYUNTAMIENTO
			</td>
			<td>
		<input type='text' name='ayto' size=16 maxlength=16 value='".@$defaults['ayto']."' />
			</td>
		</tr>

		<tr>
			<td align='right'>
				REFERENCIA
			</td>
			<td align='left'>
		<input type='text' name='refayto' size=16 maxlength=4 value='".@$defaults['refayto']."' />
			</td>
		</tr>

		<tr>
			<td colspan='2' align='right' valign='middle'  class='BorderSup'>
				<input type='submit' value='CREAR AYUNTAMIENTO' />
				<input type='hidden' name='oculto' value=1 />
			</td>
		</tr>
	</form>														

		<tr>
			<td colspan=3 align='right' class='BorderSup'>
				<form name='fvolver' action='Ayto_Modificar_01.php'  \">
					<input type='submit' value='CANCELAR Y VOLVER INICIO AYUNTAMIENTOS' />
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