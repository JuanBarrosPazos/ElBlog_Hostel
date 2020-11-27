<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_01b.php';
	require '../Gch.Inclu/mydni.php';
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){ 
 					
					master_index();
					ver_todo();
					info();
								}

elseif ($_SESSION['Nivel'] == 'admin'){

	master_index();

	require 'Inc_Logica_01.php';

} else { require '../Gch.Inclu/table_permisos.php'; }

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
		
	if (($_SESSION['Nivel'] == 'admin') && ($_SESSION['dni'] == $_SESSION['mydni'])) { 
	$sqlb =  "SELECT * FROM `gch_admin` WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape'  ORDER BY `Nombre` ASC  ";
	$qb = mysqli_query($db, $sqlb);
				}
	elseif (($_SESSION['Nivel'] == 'admin') && ($_SESSION['dni'] != $_SESSION['mydni'])){ 
	$sqlb =  "SELECT * FROM `gch_admin` WHERE  `dni` <> '$_SESSION[mydni]' AND  `Nombre` LIKE '$nom' OR `dni` <> '$_SESSION[mydni]' AND `Apellidos` LIKE '$ape' ORDER BY `Nombre` ASC  ";
	$qb = mysqli_query($db, $sqlb);
				}
	
			////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "FILTRO USUARIOS ";
	
	require 'Inc_While_Total.php';
		
			////////////////////		**********  		////////////////////
				
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){

	global $uptitulo;
	$uptitulo = "<div class=\"BorderInf\" style=\"text-align:center; display:block;\">
						<form name='closewindow' action='Admin_Crear.php'  class='form' \">
							<input type='submit' value='CREAR NUEVO ADMIN' />
							<input type='hidden' name='volver' value=1 />
						</form>
					<form name='ver' action='../Gch.Users/User_Modificar_01.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=840px,height=600px')\" class='form'>
						<input type='submit' value='MODIFICAR USUARIOS COMUNES' />
					</form>
				</div>";

	global $titulo;
	$titulo = "CONSULTA MODIFICAR ADMINISTRADORES";

	require 'Inc_Show_Form_01.php';

}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $db;
	global $db_name;

	global $orden;
	if (!isset($_POST['Orden'])){ $orden = '`id` ASC'; }
	else { $orden = $_POST['Orden']; }

	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){ 
				$ref = $_SESSION['ref'];
				$sqlb =  "SELECT * FROM `gch_admin` WHERE `ref` = '$ref'";
				$qb = mysqli_query($db, $sqlb);
	}
	
	elseif (($_SESSION['Nivel'] == 'admin') && ($_SESSION['dni'] == $_SESSION['mydni'])) { 
				//$orden = @$_POST['Orden'];
				$sqlb =  "SELECT * FROM `gch_admin` ORDER BY $orden ";
				$qb = mysqli_query($db, $sqlb);
				}
	elseif (($_SESSION['Nivel'] == 'admin') && ($_SESSION['dni'] != $_SESSION['mydni'])){ 
				//$orden = $_POST['Orden'];
				$sqlb =  "SELECT * FROM `gch_admin` WHERE `gch_admin`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
				$qb = mysqli_query($db, $sqlb);
				}
	
			////////////////////		**********  		////////////////////
	
	global $twhile;
	$twhile = "TODOS USUARIOS";
	
	require 'Inc_While_Total.php';

			////////////////////		**********  		////////////////////
		
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		require '../Gch.Inclu/Master_Index_Admin_Var.php';
		require '../Gch.Inclu/Master_Index_Total.php';
		
				}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $nombre;
	global $apellido;
	global $orden;
	
	$orden = isset($_POST['Orden']);
	
	if (isset($_POST['todo'])){$nombre = "TODOS LOS USUARIOS. ORDEN: ".$orden;
						$apellido ="";	}	

	$rf = isset($_POST['ref']);
	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){	
										$nombre = $_SESSION['Nombre'];
										$apellido = $_SESSION['Apellidos'];}
		
	$ActionTime = date('H:i:s');

	global $logtext;
	$logtext = PHP_EOL."- USER MODIFICAR BUSCAR ".$ActionTime.PHP_EOL."\t Filtro => ".$nombre." ".$apellido.PHP_EOL;

	require 'Inc_Log_Total.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Gch.Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2020 */
?>
