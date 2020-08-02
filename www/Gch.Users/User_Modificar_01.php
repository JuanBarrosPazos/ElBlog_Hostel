<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	require 'Inc_Header_Nav_Head.php';
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['uNivel'] == 'useru'){ ver_todo(); } 

	elseif ($_SESSION['uNivel'] == 'adminu'){ 
		
			if(isset($_POST['todo'])){  
				show_form();							
				ver_todo();
				//info();
				}
			
			elseif(isset($_POST['oculto'])){
			if($form_errors = validate_form()){
			show_form($form_errors);
			} else {  process_form();
			//info();
			}
		}
			else { show_form();
				   ver_todo();
				}
	} 

else { 	require '../Gch.Inclu/table_permisos.php'; 
	   	require 'Inc_Footer.php';
	   	require '../Gch.Www/Inc_Jquery_Boots_Foot.php';
			}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	require 'Inc_Show_Form_01_Val.php';
		
	return $errors;

		}
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	show_form();
		
	$nom = "%".$_POST['Nombre']."%";
	$ape = "%".$_POST['Apellidos']."%";

	if (strlen(trim($_POST['Apellidos'])) == 0){$ape = $nom;}
	if (strlen(trim($_POST['Nombre'])) == 0){ $nom = $ape;}
	
	if ($_SESSION['uNivel'] == 'useru'){ 
	$sqlb =  "SELECT * FROM `gch_user` WHERE `ref` = '$_SESSION[uref]' LIMIT 1  ";
	$qb = mysqli_query($db, $sqlb);
				}

	if ($_SESSION['uNivel'] == 'adminu') { 
	$sqlb =  "SELECT * FROM `gch_user` WHERE `Nivel` = 'useru' AND (`Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape')  ORDER BY `Nombre` ASC ";
	$qb = mysqli_query($db, $sqlb);
				}

				////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "USUARIOS";
	
	global $formularioh;
	$formularioh = "<form name='modifica' action='User_Modificar_02.php' method='POST'>";
						
	global $formulariof;
	$formulariof = "<td align='right' class='BorderInf'></td>
					<td colspan=2 align='center' class='BorderInfDch'>
						<input type='submit' value='MODIFICAR DATOS' />
						<input type='hidden' name='oculto2' value=1 />
				</form>
					</td>";
		
	global $formulariohi;
	$formulariohi = "<td colspan=2 align='center' class='BorderInf'>
	<form name='modifica_img' action='User_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=540px,height=680px')\">";

	global $formulariofi;
	$formulariofi = "<input type='submit' value='MODIFICAR IMAGEN' />
					 <input type='hidden' name='oculto2' value=1 />
						</form>
					</td>";

	require 'Inc_While_Total.php';
	
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){
	
	global $titulo;
	$titulo = "CONSULTA MODIFICAR USUARIOS";

	require 'Inc_Show_Form_01.php';

}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $db;
	global $db_name;

	if ($_SESSION['uNivel'] == 'useru'){ 
				$ref = $_SESSION['uref'];
				$sqlb =  "SELECT * FROM `gch_user` WHERE `ref` = '$ref'";
				$qb = mysqli_query($db, $sqlb);
	}
	
	elseif ($_SESSION['uNivel'] == 'adminu') { 
				global $orden;
				if($_POST['Orden'] == ''){ $orden = '`id` ASC'; }
				else {$orden = @$_POST['Orden'];}
				$sqlb =  "SELECT * FROM `gch_user` WHERE `Nivel` = 'useru' ORDER BY $orden ";
				$qb = mysqli_query($db, $sqlb);
			}
	
			////////////////////		**********  		////////////////////
	
	global $twhile;
	$twhile = "USUARIOS";
	
	global $formularioh;
	$formularioh = "<form name='modifica' action='User_Modificar_02.php' method='POST'>";
	
	global $formulariof;
	$formulariof = "<td align='right' class='BorderInf'></td>
					<td colspan=2 align='center' class='BorderInfDch'>
						<input type='submit' value='MODIFICAR ESTOS DATOS' />
						<input type='hidden' name='oculto2' value=1 />
					</form>
						</td>";

	global $formulariohi;
	$formulariohi = "<td colspan=2 align='center' class='BorderInfDch'>
	<form name='modifica_img' action='User_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=540px,height=680px')\">";

	global $formulariofi;
	$formulariofi = "<input type='submit' value='MODIFICAR IMAGEN' />
					 <input type='hidden' name='oculto2' value=1 />
						</form>
					</td>";

	global $formulariod;
	$formulariod = "<form name='borrar' action='User_Borrar_02.php' method='POST'>";

	global $formulariofd;
	$formulariofd = "<td colspan=2 align='center' class='BorderInf'>
						<input type='submit' value='BORRAR DATOS' />
						<input type='hidden' name='oculto2' value=1 />
					</form>
						</td>";


	require 'Inc_While_Total.php';

			////////////////////		**********  		////////////////////
		
	}


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require 'Inc_Footer.php';

	require '../Gch.Www/Inc_Jquery_Boots_Foot.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2020 */
?>
