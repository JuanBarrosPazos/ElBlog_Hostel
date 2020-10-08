<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	if (@$_SESSION['Nivel'] == 'admin'){ 
			global $headtot;
			$headtot = "headu";
			require 'Inc_Header_Nav_Head_Total.php';
			//require 'Inc_Header_Nav_Headu.php';
			global $winclose;
			$winclose = "<div align='right' class='BorderSup BorderInf'>
			<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
							<input type='submit' value='CERRAR VENTANA' />
							<input type='hidden' name='oculto2' value=1 />
			</form>
				</div>";
					}
	else{ 	global $headtot;
			$headtot = "head";
			require 'Inc_Header_Nav_Head_Total.php';
			//require 'Inc_Header_Nav_Head.php';
			global $winclose;
			$winclose = ""; 
				}
	
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (@$_SESSION['uNivel'] == 'useru'){ ver_todo(); } 

	elseif ((@$_SESSION['uNivel'] == 'adminu')||(@$_SESSION['Nivel'] == 'admin')){ 
		
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
	   	//require 'Inc_Footer.php';
	   	//require '../Gch.Www/Inc_Jquery_Boots_Foot.php';
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
	
	if (@$_SESSION['uNivel'] == 'useru'){ 
	$sqlb =  "SELECT * FROM `gch_user` WHERE `ref` = '$_SESSION[uref]' LIMIT 1  ";
	$qb = mysqli_query($db, $sqlb);
				}

	if ((@$_SESSION['uNivel'] == 'adminu')||(@$_SESSION['Nivel'] == 'admin')) { 
		global $orden;
		if(@$_POST['Orden'] == ''){ $orden = '`id` ASC'; }
		else {$orden = @$_POST['Orden'];}
	$sqlb =  "SELECT * FROM `gch_user` WHERE `Nivel` = 'useru' AND (`Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape')  ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
				}

				////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "USUARIOS";
	
	require 'Inc_While_Total_Form.php';

	require 'Inc_While_Total.php';
	
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){
	
	//global $winclose;
	//echo "$winclose";

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

	if (@$_SESSION['uNivel'] == 'useru'){ 
				$ref = $_SESSION['uref'];
				$sqlb =  "SELECT * FROM `gch_user` WHERE `ref` = '$ref'";
				$qb = mysqli_query($db, $sqlb);
	}
	
	elseif ((@$_SESSION['uNivel'] == 'adminu')||(@$_SESSION['Nivel'] == 'admin')) { 
				global $orden;
				if(@$_POST['Orden'] == ''){ $orden = '`id` ASC'; }
				else {$orden = @$_POST['Orden'];}
				$sqlb =  "SELECT * FROM `gch_user` WHERE `Nivel` = 'useru' ORDER BY $orden ";
				$qb = mysqli_query($db, $sqlb);
			}
	
			////////////////////		**********  		////////////////////
	
	global $twhile;
	$twhile = "USUARIOS";
	
	require 'Inc_While_Total_Form.php';
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
