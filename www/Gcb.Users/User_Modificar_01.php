<?php
session_start();

	//require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';
	require 'Inc_Header_Nav_Headu.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'user'){ 
 					
					ver_todo();

} else { require '../Gcb.Inclu/table_permisos.php'; 
		 require 'Inc_Footer.php';
		 require '../Gcb.Www/Inc_Jquery_Boots_Foot.php';
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
	
	//$orden = $_POST['Orden'];
	//$doc = $_POST['doc'];
		
	if ($_SESSION['Nivel'] == 'user'){ 
	$sqlb =  "SELECT * FROM `user` WHERE  `ref` = '$_SESSION[ref]' LIMIT 1  ";
	$qb = mysqli_query($db, $sqlb);
				}
			////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "FILTRO USUARIOS MODIFICAR";
	
	global $formularioh;
	$formularioh = "<form name='modifica' action='User_Modificar_02.php' method='POST'>";
						
	global $formulariof;
	$formulariof = "<td align='right' colspan=3 class='BorderInf'></td>
					<td colspan=2 align='center' class='BorderInfDch'>
						<input type='submit' value='MODIFICAR ESTOS DATOS' />
						<input type='hidden' name='oculto2' value=1 />
				</form>
					</td>";
		
	global $formulariohi;
	$formulariohi = "<td colspan=2 align='center' class='BorderInf'>
	<form name='modifica_img' action='User_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=540px,height=470px')\">";

	global $formulariofi;
	$formulariofi = "<input type='submit' value='MODIFICAR IMAGEN' />
					 <input type='hidden' name='oculto2' value=1 />
						</form>
					</td>";

	require 'Inc_While_Total.php';
	
	
			////////////////////		**********  		////////////////////
				
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

	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){ 
				$ref = $_SESSION['ref'];
				$sqlb =  "SELECT * FROM `user` WHERE `ref` = '$ref'";
				$qb = mysqli_query($db, $sqlb);
	}
	
	elseif (($_SESSION['Nivel'] == 'user') && ($_SESSION['dni'] == $_SESSION['mydni'])) { 
				$orden = @$_POST['Orden'];
				$sqlb =  "SELECT * FROM `user` ORDER BY $orden ";
				$qb = mysqli_query($db, $sqlb);
				}
	elseif (($_SESSION['Nivel'] == 'user') && ($_SESSION['dni'] != $_SESSION['mydni'])){ 
				$orden = $_POST['Orden'];
				$sqlb =  "SELECT * FROM `user` WHERE `user`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
				$qb = mysqli_query($db, $sqlb);
				}
	
			////////////////////		**********  		////////////////////
	
	global $twhile;
	$twhile = "TODOS USUARIOS MODIFICAR";
	
	global $formularioh;
	$formularioh = "<form name='modifica' action='User_Modificar_02.php' method='POST'>";
	
	global $formulariof;
	$formulariof = "<td align='right' colspan=3 class='BorderInf'></td>
					<td colspan=2 align='center' class='BorderInfDch'>
						<input type='submit' value='MODIFICAR ESTOS DATOS' />
						<input type='hidden' name='oculto2' value=1 />
				</form>
					</td>";

	global $formulariohi;
	$formulariohi = "<td colspan=2 align='center' class='BorderInf'>
	<form name='modifica_img' action='User_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=540px,height=470px')\">";

	global $formulariofi;
	$formulariofi = "<input type='submit' value='MODIFICAR IMAGEN' />
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

	require '../Gcb.Www/Inc_Jquery_Boots_Foot.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2020 */
?>
