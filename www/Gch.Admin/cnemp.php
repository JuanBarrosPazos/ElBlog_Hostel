<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_01b.php';
	require '../Gch.Inclu/mydni.php';
	require 'nemp.php';
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

					master_index();

						if(isset($_POST['oculto'])){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
											show_form();
												}
							} else {
										show_form();
								}
			} else { require '../Gch.Inclu/table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	$errors = array();
	
	/* VALIDAMOS EL CAMPO NUMERO DE ADMIN SYS. */
	global $db;

	$sqlb =  "SELECT * FROM `gch_admin` ";
	$qb = mysqli_query($db, $sqlb);
	$cqb = mysqli_num_rows($qb);

	if(strlen(trim($_POST['nemp'])) == 0){
		$errors [] = "<font color='#FF0000'>SELECCIONE NUMERO EMPLEADOS</font>";
		}
	elseif($cqb > $_POST['nemp']){
		$errors [] = "<font color='#FF0000'>EXISTEN MÁS ADMIN SYS EN LA BBDD .".$cqb."</font>";
	}

	return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
		$filename = "nemp.php";
		$fw2 = fopen($filename, 'w+');
		$mydni = '<?php $_SESSION[\'nuser\'] = '.$_POST['nemp'].'; ?>';
		fwrite($fw2, $mydni);
		fclose($fw2);
	
		$_SESSION['nuser'] = $_POST['nemp'];

	/**************************************/

	print( "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 class='BorderInf'>
						SE HA GRABADO CORRETAMENTE
					</th>
				</tr>
								
				<tr>
					<td  align='center'>
						Nº ADMIN SYS PERMITIDOS: "
						.$_POST['nemp'].
					"</td>
				</tr>
				
			</table>");

		}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {$defaults = array ( 'nemp' => ''); }
	
	if ($errors){
		print("<table align='center'>
					<tr>
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
		
	$nemp = array (	'' => 'ADMIN SYS PERMITIDOS',
					'1' => '<= 1 ADMIN SYS',
					'3' => '<= 3 ADMIN SYS',
					'5' => '<= 5 ADMIN SYS',
					'10' => '<= 10 ADMIN SYS',
					'20' => '<= 20 ADMIN SYS',
					'50' => '<= 50 ADMIN SYS',
					'100' => '<= 100 ADMIN SYS',
											);														

/*******************************/

		print("<table align='center' style=\"margin-top:4px\">
				<tr>
					<th colspan=2 class='BorderInf'>
							Nº ADMIN SYS PERMITIDOS: ".$_SESSION['nuser']."
					</th>
				</tr>
				
				<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' >
						
				<tr>
					<td>
						Nº 
					</td>
					<td>
				<select name='nemp'>");

				foreach($nemp as $optionnv => $labelnv){
					
					print ("<option value='".$optionnv."' ");
					
					if($optionnv == $defaults['nemp']){
															print ("selected = 'selected'");
																								}
													print ("> $labelnv </option>");
												}	
						
	print ("</select>
					</td>
				</tr>
				
				<tr>
					<td colspan='2'  align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='GRABAR Nº ADMIN SYS PERMITIDOS' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
				</tr>
		</form>														
			</table>"); 
	
	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
		
		require '../Gch.Inclu/Master_Index_Admin.php';
		
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gch.Inclu/Admin_Inclu_02.php';
		
/* Creado por Juan Barros Pazos 2020 */
?>
