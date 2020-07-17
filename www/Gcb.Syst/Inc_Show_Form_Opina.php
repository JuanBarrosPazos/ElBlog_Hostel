<?php

global $db;
global $defaults;

if(isset($_POST['oculto1'])){	$_SESSION['isla'] = $_POST['isla'];
								$defaults = $_POST;	
								unset($_SESSION['ayto']);
								unset($_SESSION['tipo']);
								unset($_SESSION['espec1']);
									}
if(isset($_POST['oculto'])){ 	$_SESSION['ayto'] = $_POST['ayto'];
								$_SESSION['tipo'] = $_POST['tipo'];
								$_SESSION['espec1'] = $_POST['espec1'];
								$defaults = $_POST;
									}
else {	$defaults = array (	'isla' => @$_SESSION['isla'],
							'ayto' => @$_SESSION['ayto'],
							'tipo' => @$_SESSION['tipo'],
							'espec1' => @$_SESSION['espec1']
								);
									}

	global $isla;
	//$isla = @$_POST['isla'];
	$isla = @$_SESSION['isla'];
	
	/* CONSULTAMOS LA TABLA AYUNAMIENTOS = ISLA */
	$sqlis =  "SELECT * FROM `gcb_islas` WHERE `refisla` = '$isla' ";
	$qis = mysqli_query($db, $sqlis);
	$rowisla = mysqli_fetch_assoc($qis);
	$_secis = @$rowisla['isla'];


	print("<table align='center' style=\"border:0px;margin-top:4px;width:auto\">
				<tr>
					<th width=100% class='BorderInf BorderSup'>
						".$titulo."
					</th>
				</tr>
				<tr>
					<form name='fmodera' method='post' action='Opina_Modificar_01.php' >
						<td valign='middle'  align='center' width=100% class='BorderInf BorderSup'>
								<input type='submit' value='PERMITIR O BORRAR OPINIONES SIN MODERAR' />
								<input type='hidden' name='modera' value=1 />
						</td>
					</form>
				</tr>

			<tr>
				<td class='BorderInf BorderSup' align='center'>
				
				<div>
				<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
					<input type='submit' value='SELECCIONE UNA ISLA' />
					<input type='hidden' name='oculto1' value=1 />

			<select name='isla'>
			<option value=''>ISLAS</option>");
						
	/* RECORREMOS LOS VALORES DE LA TABLA ISLAS PARA CONSTRUIR CON ELLOS UN SELECT */	
			
	global $db;
	$sqlb =  "SELECT * FROM `gcb_islas` ORDER BY `isla` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['refisla']."' ");
					
					if($rows['refisla'] == $defaults['isla']){
															print ("selected = 'selected'");
																								}
									print ("> ".$rows['isla']."</option>");
				}
		
			}  

	print ("</select>
				</form>	
					</div>");
				
	if (isset($_POST['oculto1']) || isset($_POST['oculto'])||(isset($_SESSION['isla']))) {

		
	if ((@$_POST['isla'] == '')&&($_SESSION['isla'] == '')){
		print(" <div  style='margin-top:6px; margin-left:6px' >
							<font color='red'>
						<b>
								SELECCIONE UNA ISLA.
							</font>
				</div></td></tr></table>");} 
								
	elseif ((@$_POST['isla'] != '')||($_SESSION['isla'] != '')) { 
		
	print("<div style='float:left'>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
						
	<input name='isla' type='hidden' value='".$defaults['isla']."' />

		<select name='ayto'>
		<option value=''>AYUNTAMIENTO</option>");
						
	/* SELECT AYUNTAMIENTO */	
			
	global $db;
	$sqlayt =  "SELECT * FROM `gcb_aytos` WHERE `refisla` = '$isla' ORDER BY `ayto` ASC ";
	$qayt = mysqli_query($db, $sqlayt);
	if(!$qayt){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rowsayt = mysqli_fetch_assoc($qayt)){
					
			print ("<option value='".$rowsayt['refayto']."' ");
					
			if($rowsayt['refayto'] == @$defaults['ayto']){
						print ("selected = 'selected'");
					}
				print ("> ".$rowsayt['ayto']."</option>");
			}
		}  

	print ("	</select>

		<select name='tipo'>
		<option value=''>CATEGORIA</option>");
						
	/* SELECT CATEGORIA DE LOCAL */	
			
	global $db;
	$sqltipo =  "SELECT * FROM `gcb_tipologia` ORDER BY `tipo` ASC ";
	$qtipo = mysqli_query($db, $sqltipo);
	if(!$qtipo){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rowtipo = mysqli_fetch_assoc($qtipo)){
					
					print ("<option value='".$rowtipo['reftipo']."' ");
					
					if($rowtipo['reftipo'] == @$defaults['tipo']){
															print ("selected = 'selected'");
																								}
									print ("> ".$rowtipo['tipo']."</option>");
				}
		
			}  

	print ("</select>

		<select name='espec1'>
		<option value=''>ESPECIALIDAD</option>");
						
	/* SELECT ESPECIALIDAD 1 */	
			
	global $db;
	$sqlespec =  "SELECT * FROM `gcb_especialidad` ORDER BY `espec` ASC ";
	$qespec = mysqli_query($db, $sqlespec);
	if(!$qespec){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rowespec1 = mysqli_fetch_assoc($qespec)){
					
					print ("<option value='".$rowespec1['refespec']."' ");
					
					if($rowespec1['refespec'] == @$defaults['espec1']){
															print ("selected = 'selected'");
																								}
									print ("> ".$rowespec1['espec']."</option>");
				}
		
			}  

	print ("</select>

				<input type='submit' value='APLICAR FILTRO' />
				<input type='hidden' name='oculto' value=1 />
		</form>
		</div>
		</td>
				</tr>
		</table>");
		
				}
					}	else {print ("</td></tr></table>");}			
				

?>