<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require 'Inc_Header_Nav_Heado.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

	/*
	// FORMULARIO PARA ACCEDER A ESTE SCRIPT, OPINAR Y PUNTUAR
	<!--
	<form name='creaopina' action='Gch.Syst/Opina_Cliente.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=520px, height=600px')\">
	<form name='creaopina' action='Gch.Syst/Opina_Cliente.php' method='POST'>
		<input name='id' type='hidden' value='".$rowb['id']."' />
		<input name='refart' type='hidden' value='".$rowb['refart']."' />
		<input name='tit' type='hidden' value='".$rowb['tit']."' />
		<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
		<input name='isla' type='hidden' value='".$rowb['refisla']."' />
		<input name='ayto' type='hidden' value='".$rowb['refayto']."' />
		<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
		<input type='submit' value='CREAR OPINION' />
		<input type='hidden' name='oculto2' value=1 />
	</form>
	-->
	*/

///////////////////////////////////////////////////////////////////////////////////////////////
//echo "**** ".$_SESSION['uNivel'];
if((@$_SESSION['uNivel'] == 'useru')||(@$_SESSION['uNivel'] == 'adminu')){ 

	if (isset($_POST['oculto2'])){ show_form(); }
	elseif(isset($_POST['oculto'])){
			if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
											//accion_Log();
										}
								}
	else {show_form();}

	} else { require '../Gch.Inclu/table_permisos.php'; 
				global $redir;
				$redir = "<script type='text/javascript'>
							function redir(){
								window.close();
									}
							setTimeout('redir()',6000);
						</script>";
				print ($redir);
	}

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $db;
	global $db_name;

	$errors = array();

	if(strlen(trim($_POST['valora'])) == 0){
		$errors [] = "VALORACIÓN <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	if(strlen(trim($_POST['precio'])) == 0){
		$errors [] = "PRECIOS <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

		///////////////////////////////////////////////////////////////////////////////////

	if(strlen(trim($_POST['coment'])) == 0){
		$errors [] = "DESCRIPCION <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	elseif(strlen(trim($_POST['coment'])) <= 50){
		$errors [] = "DESCRIPCION <font color='#FF0000'>Mas de 50 carácteres.</font>";
		}

	elseif(strlen(trim($_POST['coment'])) >= 402){
		$errors [] = "DESCRIPCION <font color='#FF0000'>Excedió más de 400 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^#$&<>\(\)\[\]\{\}]+$/',$_POST['coment'])){
		$errors [] = "DESCRIPCION <font color='#FF0000'>No Permitidos #$&<>()[]{}</font>";
		}
		
	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;	
	global $secc;
	
	require 'Inclu_Name_Ref_to_Name.php';

		/* GRABAMOS LOS DATOS EN LA TABLA DE RESTAURANTES */

		global $db;
		global $db_name;

		global $tablename;
		$tablename = "gch_opiniones";
		$tablename = "`".$tablename."`";

		$ActionTime = date('Y-m-d');

	$sqla = "INSERT INTO `$db_name`.$tablename (`refart`,`refuser`,`refayto`,`refisla`,`opina`,`valora`,`precio`,`datein`,`datemod`,`modera`) VALUES ('$_SESSION[refart]', '$_SESSION[uref]', '$_SESSION[ayto]', '$_SESSION[isla]', '$_POST[coment]', '$_POST[valora]', '$_POST[precio]', '$ActionTime', '00-00-00', 'n')";

	if(mysqli_query($db, $sqla)){

			global $carpetaimg;
			global $new_name;

			print("<table align='center' style='margin-top:10px'>
												
				<tr>
					<td width=120px>
						REFERENCIA
					</td>
					<td width=100px>"
						.$_POST['refart'].
					"</td>
				</tr>
				
				<tr>
					<td>
						RESTAURANTE
					</td>
					<td>"
						.$_SESSION['tit'].
					"</td>
				</tr>				
				
				<tr>
					<td>	
						SUBTITULO
					</td>
					<td>"
						.$_SESSION['titsub'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						ISLA
					</td>
					<td colspan=2>"
						.$_POST['isla']." / ".$islaname.
					"</td>
				</tr>
				
				<tr>
					<td>	
						AYUNTAMIENTO
					</td>
					<td colspan=2>"
						.$_POST['ayto']." / ".$aytoname.
					"</td>
				</tr>
				
				<tr>
					<td>	
						DATE IN
					</td>
					<td>"
						.$ActionTime.
					"</td>
				</tr>
				
				<tr>
					<td>	
						VALORACIÓN SERVICIO
					</td>
					<td colspan=2>"
						.$_POST['valora'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						VALORACIÓN PRECIOS
					</td>
					<td colspan=2>"
						.$_POST['precio'].
					"</td>
				</tr>
				
				<tr>
					<td colspan=3  align='center'>
						MY OPINION
					</td>
				</tr>

				<tr>
					<td colspan=3>"
						.$_POST['coment'].
					"</td>
				</tr>
				<tr>
			<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
					<th colspan=3 class='BorderSup' valign='middle' align='right'>
				<input type='submit' value='CERRAR VENTANA' />
				<input type='hidden' name='oculto2' value=1 />
					</th>
			</form>
				</tr>
			</table>");

	require '..\Gch.Artic\Inclu_Valora_Calculos.php';
	global $tablename;
	$tablename = "gch_art";
	$tablename = "`".$tablename."`";

	$sqlpv = "UPDATE `$db_name`.$tablename SET `iprecio` = '$val2x100', `ivalora` = '$valx100' WHERE $tablename.`refart` = '$_SESSION[refart]' ";
		if(mysqli_query($db, $sqlpv)){	} 
		else {print("* MODIFIQUE LA ENTRADA L.212: ".mysqli_error($db));
			show_form ();
			}

		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.close();
					}
					setTimeout('redir()',6000);
				</script>";
		print ($redir);

	} 	else {print("* MODIFIQUE LA ENTRADA L.207: ".mysqli_error($db));
						show_form ();
						//global $texerror;
						//$texerror = "\n\t ".mysqli_error($db);
					}
		
	}	/* FINAL process_form(); */

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if(isset($_POST['oculto2'])){
		//$defaults = $_POST;
		
		$_SESSION['modid'] = $_POST['id'];
		$_SESSION['refart'] = $_POST['refart'];
		$_SESSION['tit'] = $_POST['tit'];
		$_SESSION['titsub'] = $_POST['titsub'];
		$_SESSION['isla'] = $_POST['isla'];
		$_SESSION['ayto'] = $_POST['ayto'];

		$defaults = array ( 'refart' => $_SESSION['refart'], // Referencia articulo
							'titulo' => $_SESSION['tit'], // Titulo
							'subtitul' => $_SESSION['titsub'], // Sub Titulo
							'isla' => $_SESSION['isla'],  // refisla
							'ayto' => $_SESSION['ayto']);

		} elseif(isset($_POST['oculto1'])){
				//$defaults = $_POST;
				$defaults = array ( 'refart' => $_SESSION['refart'], // Referencia articulo
									'titulo' => $_SESSION['tit'], // Titulo
									'subtitul' => $_SESSION['titsub'], // Sub Titulo
									'isla' => $_SESSION['isla'],  // refisla
									'ayto' => $_SESSION['ayto'],  // refayto
									'coment' => $_POST['coment'],
									'valora' => $_POST['valora'],
									'precio' => isset($_POST['precio']),
											);	

		} 
	elseif(isset($_POST['oculto'])){
					$defaults = $_POST;
		} else {
				$defaults = array ( 'refart' => $_SESSION['refart'], // Referencia articulo
									'titulo' => $_SESSION['tit'], // Titulo
									'subtitul' => $_SESSION['titsub'], // Sub Titulo
									'isla' => $_SESSION['isla'],  // refisla
									'ayto' => $_SESSION['ayto'],  // refayto
									'coment' => isset($_POST['coment']),
									'valora' => isset($_POST['valora']),
									'precio' => isset($_POST['precio']),
											);	
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

		$precio = array ('' => 'EUROS / SERVICIO',
						 '1' => '1 de 5 MUY MALOS',
						 '2' => '2 de 5 MALOS',
						 '3' => '3 de 5 NORMALES',
						 '4' => '4 de 5 BUENOS',
						 '5' => '5 de 5 MUY BUENOS');														

		$valora = array ('' => 'ATENCIÓN / LOCAL',
						'1' => '1 de 5 MUY MALOS',
						'2' => '2 de 5 MALOS',
						'3' => '3 de 5 NORMALES',
						'4' => '4 de 5 BUENOS',
						'5' => '5 de 5 MUY BUENOS');														

	global $db;
	global $db_name;

	require 'Inclu_Name_Ref_to_Name.php';

	print("
		<table align='center' style=\"margin-top:10px\">
			<tr>
				<th style=\"text-align:center;\" colspan=2 class='BorderInf'>
				".strtoupper($_SESSION['uNombre'])." ".strtoupper($_SESSION['uApellidos'])."<br>
		CREE UNA VALORACIÓN PARA <br>".strtoupper($_SESSION['refart']." / ".$_SESSION['tit'])."
						<br>RESTAURANTE EN ".strtoupper($_SESSION['isla']." / ".$_SESSION['ayto'])."
				</th>
			</tr>
			
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
					
		<tr>								
					<td align='right' width=100px>
						REF ISLA
					</td>
					<td>
	<input name='isla' type='hidden' value='".$defaults['isla']."' />".$_SESSION['isla']." / ".$islaname."
					</td>
		</tr>

			<tr>
				<td align='right'>
					AYUNTAMIENTO
				</td>
				<td align='left'>
	<input name='ayto' type='hidden' value='".@$defaults['ayto']."' />".$_SESSION['ayto']." / ".$aytoname."

				</td>
		</tr>
			<tr>

				<td align='right'>
					RESTAURANTE
				</td>
				<td>

	<input name='titulo' type='hidden' value='".@$defaults['titulo']."' />".$_SESSION['tit']."

				</td>
			</tr>
								
			<tr>
				<td align='right'>						
					SUBTITULO
				</td>
				<td>
	<input  name='subtitul' type='hidden' value='".@$defaults['subtitul']."' />".$_SESSION['titsub']."
				</td>
			</tr>
								
            <tr>
					<td align='right'>						
						REFERENCIA
					</td>
					<td>
		<input name='refart' type='hidden' value='".$_SESSION['refart']."' />".$_SESSION['refart']."
					</td>
			</tr>

				<tr>
					<td align='right'>
						PRECIOS
					</td>
					<td>
	
			<select name='precio'>");
				foreach($precio as $optionp => $labelp){
					print ("<option value='".$optionp."' ");
					if($optionp == @$defaults['precio']){
							print ("selected = 'selected'");
												}
							print ("> $labelp </option>");
									}	
	print ("</select>
					</td>
				</tr>

				<tr>
					<td align='right'>
						SERVICIOS
					</td>
					<td>
	
			<select name='valora'>");
				foreach($valora as $optionv => $labelv){
					print ("<option value='".$optionv."' ");
					if($optionv == @$defaults['valora']){
							print ("selected = 'selected'");
												}
							print ("> $labelv </option>");
									}	
	print ("</select>
					</td>
				</tr>
			<tr>
				<td colspan=2 align='center'>
					TU OPINION PERSONAL
				</td>
			</tr>
			<tr>
				<td colspan=2 align='center'>
<textarea cols='34' rows='6' onkeypress='return limitac(event, 200);' onkeyup='actualizaInfo(200)' name='coment' id='coment'>".@$defaults['coment']."</textarea>

		</br>
			<div id='info' align='center' style='color:#0080C0;'>
						Maximum 200 characters            
			</div>

				</td>
			</tr>
							
			<tr>
				<td colspan='2' align='right' valign='middle'  class='BorderSup'>
					<input type='submit' value='CREAR VALORACION' />
					<input type='hidden' name='oculto' value=1 />
				</td>
	</form>														
			</tr>
			<tr>
				<td colspan='2' align='right' valign='middle'  class='BorderSup'>
		<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
			<input type='submit' value='CERRAR VENTANA' />
			<input type='hidden' name='oculto2' value=1 />
			</td>
		</form>
	</tr>
		</table>"); 
	
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

require '../Gch.Users/Inc_Footer.php';

require '../Gch.Www/Inc_Jquery_Boots_Foot.php';

?>