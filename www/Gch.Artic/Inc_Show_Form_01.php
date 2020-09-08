<?php

global $db;
global $defaults;

if(isset($_POST['todo'])){
			$defaults = array (	'isla' => @$_SESSION['isla'],
								'ayto' => @$_SESSION['ayto'],
								'tipo' => @$_SESSION['tipo'],
								'espec1' => @$_SESSION['espec1'],
								'Orden' => @$_POST['Orden'],
								'dy' => @$_POST['dy'],
								'dm' => @$_POST['dm'],
								'dd' => @$_POST['dd'],);
							}

elseif(isset($_POST['oculto1'])){	$_SESSION['isla'] = $_POST['isla'];
									$defaults = $_POST;	
									unset($_SESSION['ayto']);
									unset($_SESSION['tipo']);
									unset($_SESSION['espec1']);
									}
									
elseif(isset($_POST['oculto'])){ 	$_SESSION['ayto'] = $_POST['ayto'];
									$_SESSION['tipo'] = $_POST['tipo'];
									$_SESSION['espec1'] = $_POST['espec1'];
									$defaults = $_POST;
								}

else {	$defaults = array (	'isla' => @$_SESSION['isla'],
							'ayto' => @$_SESSION['ayto'],
							'tipo' => @$_SESSION['tipo'],
							'espec1' => @$_SESSION['espec1'],
							'Orden' => '',
							'dy' => '',
							'dm' => '',
                            'dd' => '',);

		$ctemp = "../Gch.Temp";
		if(file_exists($ctemp)){$dir1 = $ctemp."/";
								$handle1 = opendir($dir1);
								while ($file1 = readdir($handle1))
										{if (is_file($dir1.$file1))
											{unlink($dir1.$file1);}
											}	
							} else {}
					}

					require "../Gch.Config/ayear.php";
			
	$dm = array (	'' => 'MES TODOS', 	'01' => 'ENERO',	'02' => 'FEBRERO',
					'03' => 'MARZO',	'04' => 'ABRIL',	'05' => 'MAYO',
					'06' => 'JUNIO',	'07' => 'JULIO',	'08' => 'AGOSTO',
					'09' => 'SEPTIEMB',	'10' => 'OCTUBRE',	'11' => 'NOVIEMBRE',
					'12' => 'DICIEMBRE',);
					
	$dd = array (	'' => 'DÍA TODOS',	'01' => '01',	'02' => '02',
					'03' => '03',	'04' => '04',	'05' => '05',
					'06' => '06',	'07' => '07',	'08' => '08',
					'09' => '09',	'10' => '10',	'11' => '11',
					'12' => '12',	'13' => '13',	'14' => '14',
					'15' => '15',	'16' => '16',	'17' => '17',
					'18' => '18',	'19' => '19',	'20' => '20',
					'21' => '21',	'22' => '22',	'23' => '23',
					'24' => '24',	'25' => '25',	'26' => '26',
					'27' => '27',	'28' => '28',	'29' => '29',
					'30' => '30',	'31' => '31',);
														
	$ordenar = array (  '`id` ASC' => 'ID Ascendente',
						'`id` DESC' => 'ID Descendente',
						'`refart` ASC' => 'REF Ascendente',
						'`refart` DESC' => 'REF Descendente',);
		

	global $isla;
	//$isla = @$_POST['isla'];
	$isla = @$_SESSION['isla'];
	
	/* CONSULTAMOS LA TABLA AYUNAMIENTOS = ISLA */
	$sqlis =  "SELECT * FROM `gch_islas` WHERE `refisla` = '$isla' ";
	$qis = mysqli_query($db, $sqlis);
	$rowisla = mysqli_fetch_assoc($qis);
	$_secis = @$rowisla['isla'];

	print("<table align='center' style=\"border:0px;margin-top:4px;width:auto\">
				<tr>
					<th colspan=2 width=100% class='BorderInf BorderSup'>
						".$cart."
					</th>
				</tr>
				<tr>
					<th colspan=2 width=100% class='BorderInf BorderSup'>
						".$titulo."
					</th>
				</tr>
	
						<!--	**********		**********	-->
						<!--	**********		**********	-->
				<tr>
					<td align='center' class='BorderInf'>
				<div  style='width:auto; text-align:center;'>
		<form name='vertodo' method='post' action='$_SERVER[PHP_SELF]' style=\"display:inline-block;\">
						<input type='submit' value='RESTAURANTES VER TODOS' />
						<input type='hidden' name='todo' value=1 />
		
			<select name='Orden'>");
				foreach($ordenar as $option => $label){
						print ("<option value='".$option."' ");
						if($option == @$defaults['Orden']){
										print ("selected = 'selected'");}
										print ("> $label </option>");
									}	
		print ("</select>
			<select name='dy'>");
					
			foreach($dy as $optiondy => $labeldy){
				print ("<option value='".$optiondy."' ");
				if($optiondy == @$defaults['dy']){
										print ("selected = 'selected'");}
										print ("> $labeldy </option>");
									}	
															
		print ("</select>
				<select name='dm'>");
		
			foreach($dm as $optiondm => $labeldm){
				print ("<option value='".$optiondm."' ");
				if($optiondm == @$defaults['dm']){
										print ("selected = 'selected'");}
										print ("> $labeldm </option>");
									}	
															
		print ("</select>
				<select name='dd'>");
		
			foreach($dd as $optiondd => $labeldd){
				print ("<option value='".$optiondd."' ");
				if($optiondd == @$defaults['dd']){
										print ("selected = 'selected'");}
										print ("> $labeldd </option>");
									}	
															
		print ("</select>
					</div>
						</td>
							</form>
								</tr>
			
								<!--	**********		**********	-->
								<!--	**********		**********	-->
		
			<tr>
				<td class='BorderInf BorderSup'>
				
				<div style='width:auto; text-align:center;'>
				<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
					<input type='submit' value='SELECCIONE UNA ISLA' />
					<input type='hidden' name='oculto1' value=1 />

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
		print(" <div  style='margin-top:6px; margin-left:6px; text-align:center;' >
							<font color='red'>
								SELECCIONE UNA ISLA.
							</font>
				</div></td></tr>");} 
								
	elseif ((@$_POST['isla'] != '')||($_SESSION['isla'] != '')) { 
		
	print("<div style='width:auto; text-align:center;'>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
						
	<input type='hidden' name='isla' value='".$defaults['isla']."' />
	
	<input type='submit' value='APLICAR FILTROS' />
	<input type='hidden' name='oculto' value=1 />

		<select name='ayto'>
		<option value=''>AYUNTAMIENTO</option>");
						
	/* SELECT AYUNTAMIENTO */	
			
	global $db;
	$sqlayt =  "SELECT * FROM `gch_aytos` WHERE `refisla` = '$isla' ORDER BY `ayto` ASC ";
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
	$sqltipo =  "SELECT * FROM `gch_tipologia` ORDER BY `tipo` ASC ";
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
	$sqlespec =  "SELECT * FROM `gch_especialidad` ORDER BY `espec` ASC ";
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
				</form>
					</div>
				</td>
			</tr>");
		
		}
			} else { print ("</td></tr>"); }
			
////////////////////			
	print("</table>");

?>