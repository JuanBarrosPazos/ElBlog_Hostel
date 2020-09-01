<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_01b.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'userpro')){

	master_index();

	if(isset($_POST['oculto'])){
		if($form_errors = validate_form()){
				show_form($form_errors);
		} else { process_form();
				 //accion_Log();
								}
	} else { show_form();}

} else { require '../Gch.Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form() {
	
	global $db;
	global $db_name;
	global $sqld;
	global $qd;
	global $rowd;

	$errors = array();

		require 'Validate_Artic.php';

	return $errors;

		} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;	
	global $secc;

	global $redir;
	$redir = "";

global $_sec;
	$secc = $_POST['autor'];
	$sqlx =  "SELECT * FROM `gch_admin` WHERE `ref` = '$_POST[autor]'";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	$_sec = $rowautor['Nombre']." ".$rowautor['Apellidos'];
	//echo $rowautor['Nombre']." ".$rowautor['Apellidos']."</br>";
	
	/* TRATAMOS EL NOMBRE DE LAS IMAGENES */
	global $carpetaimg;
	$carpetaimg = "../Gch.Img.Art";

	global $extension1;
	$extension1 = substr($_FILES['myimg1']['name'],-4);
	$extension1 = strtolower($extension1);
	global $extension1;
	$extension1 = str_replace(".","",$extension1);

	global $new_name1;
	$new_name1 = $_POST['refart']."_01.".$extension1;

	if($_FILES['myimg2']['size'] == 0){
		global $new_name2;
		$new_name2 = $_POST['refart']."_02.png";
	}
	else{
	global $extension2;
	$extension2 = substr($_FILES['myimg2']['name'],-4);
	$extension2 = strtolower($extension2);
	global $extension2;
	$extension2 = str_replace(".","",$extension2);
	global $new_name2;
	$new_name2 = $_POST['refart']."_02.".$extension2;
	}

	if($_FILES['myimg3']['size'] == 0){
		global $new_name3;
		$new_name3 = $_POST['refart']."_03.png";
	}
	else{
	global $extension3;
	$extension3 = substr($_FILES['myimg3']['name'],-4);
	$extension3 = strtolower($extension3);
	global $extension3;
	$extension3 = str_replace(".","",$extension3);
	global $new_name3;
	$new_name3 = $_POST['refart']."_03.".$extension3;
	}

	if($_FILES['myimg4']['size'] == 0){
		global $new_name4;
		$new_name4 = $_POST['refart']."_04.png";
	}
	else{
	global $extension4;
	$extension4 = substr($_FILES['myimg4']['name'],-4);
	$extension4 = strtolower($extension4);
	global $extension4;
	$extension4 = str_replace(".","",$extension4);
	global $new_name4;
	$new_name4 = $_POST['refart']."_04.".$extension4;
	}

	require 'Inclu_Name_Ref_to_Name.php';

		/* GRABAMOS LOS DATOS EN LA TABLA DE RESTAURANTES */

		global $db;
		global $db_name;

		global $tablename;
		$tablename = "gch_art";
		$tablename = "`".$tablename."`";
		global $titulo;
		$titulo = strtoupper($_POST['titulo']);
		global $subtitul;
		$subtitul = strtoupper($_POST['subtitul']);

	$sqla = "INSERT INTO `$db_name`.$tablename (`refuser`, `refart`, `tit`, `titsub`, `datein`, `timein`,`datemod`, `timemod`, `conte`, `myimg1`, `myimg2`, `myimg3`, `myimg4`, `refayto`, `refisla`, `reftipo`,`refespec1`, `refespec2`, `iprecio`, `ivalora`, `url`, `map`, `mapiframe`, `latitud`, `longitud`, `calle`, `Email`, `Tlf1`, `Tlf2`) VALUES ('$_POST[autor]', '$_POST[refart]', '$titulo', '$subtitul', '$_POST[datein]', '$_POST[timein]', '0000-00-00', '00:00:00', '$_POST[coment]', '$new_name1', '$new_name2', '$new_name3', '$new_name4', '$_POST[ayto]', '$_POST[isla]', '$_POST[tipo]', '$_POST[espec1]', '$_POST[espec2]', '$_POST[precio]', '$_POST[valora]', '$_POST[url]', '$_POST[map]', '$_POST[mapiframe]', '$_POST[latitud]', '$_POST[longitud]', '$_POST[calle]', '$_POST[Email]', '$_POST[Tlf1]', '$_POST[Tlf2]')";

	if(mysqli_query($db, $sqla)){

		global $carpetaimg;
		global $new_name1;

	/************* CREAMOS LAS IMAGENES DEL RESTAURANTE EN EL DIRECTORIO Gch.Img.Art ***************/

		require 'Inc_Crea_Img.php';

	/* FIN CREAMOS IMAGENES */

		print("<table align='center' style='margin-top:10px'>
			<tr>
				<th colspan=3 class='BorderInf'>
					CREADO POR ".strtoupper($_sec)."
				</th>
			</tr>
												
			<tr>
				<td width=120px>REFERENCIA</td>
				<td width=100px>".$_POST['refart']."</td>
				<td rowspan='5' align='center' width='120px'>
			<img src='".$carpetaimg."/".$new_name1."'  width='90px' height='auto'/>
				</td>
			</tr>
				
			<tr>
				<td>TITULO</td>
				<td>".$_POST['titulo']."</td>
			</tr>				
				
			<tr>
				<td>SUBTITULO</td>
				<td>".$_POST['subtitul']."</td>
			</tr>
				
			<tr>
				<td>DATE IN</td>
				<td>".$_POST['datein']."</td>
			</tr>
				
			<tr>
				<td>TIME IN</td>
				<td>".$_POST['timein']."</td>
			</tr>
				
			<tr>
				<td>ISLA</td>
				<td colspan=2>".$_POST['isla']." / ".$islaname."</td>
			</tr>
				
			<tr>
				<td>AYUNTAMIENTO</td>
				<td colspan=2>".$_POST['ayto']." / ".$aytoname."</td>
			</tr>
				
			<tr>
				<td>TIPO</td>
				<td colspan=2>".$_POST['tipo']." / ".$tipname."</td>
			</tr>
				
			<tr>
				<td>ESPECIALIDAD 1</td>
				<td colspan=2>".$_POST['espec1']." / ".$espec1name."</td>
			</tr>
				
			<tr>
				<td>ESPECIALIDAD 2</td>
				<td colspan=2>".$_POST['espec2']." / ".$espec1name."</td>
			</tr>
				
			<tr>
				<td>URL WEB</td>
				<td colspan=2>".$_POST['url']."</td>
			</tr>
				
			<tr>
				<td>CALLE</td>
				<td colspan=2>".$_POST['calle']."</td>
			</tr>
				
			<tr>
				<td>EMAIL</td>
				<td colspan=2>".$_POST['Email']."</td>
			</tr>
				
			<tr>
				<td>TELEFONO 1</td>
				<td colspan=2>".$_POST['Tlf1']."</td>
			</tr>
				
			<tr>
				<td>TELEFONO 2</td>
				<td colspan=2>".$_POST['Tlf2']."</td>
			</tr>
				
			<tr>
				<td colspan=3  align='center'>DESCRIPCION</td>
			</tr>
			<tr>
				<td colspan=3>".$_POST['coment']."</td>
			</tr>
			<tr>
				<th colspan=3 class='BorderSup'>
					<a href=Art_Crear.php>CREAR UN NUEVO RESTAURANTE</a>
				</th>
			</tr>
		</table>");
			
	} 	// NO SE CUMPLE EL QUERY
	else {print("* MODIFIQUE LA ENTRADA L.147: ".mysqli_error($db));
						show_form ();
					}
		
	}	/* FINAL process_form(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){

	unset($_SESSION['myimg']);

	$ctemp = "../Gch.Temp";
	if(file_exists($ctemp)){$dir1 = $ctemp."/";
							$handle1 = opendir($dir1);
							while ($file1 = readdir($handle1))
									{if (is_file($dir1.$file1))
										{unlink($dir1.$file1);}
										}	
						} else {}

	if(isset($_POST['oculto1'])){
		$defaults = $_POST;
		$_SESSION['refart'] = date('Y.m.d.H.i.s');
		$_SESSION['datein'] = date('Y-m-d');
		$_SESSION['timein'] = date('H:i:s');
		} 
	elseif(isset($_POST['oculto'])){
		$defaults = $_POST;
		 
	} else { $defaults = array ( 'autor' => isset($_POST['autor']),  // refautor
								 'titulo' => '', // Nombre restaurante
								 'subtitul' => '', // Sub Titulo
								 //'refart' => @$_SESSION['refart'],  Referencia articulo
								 'coment' => '',
								 'valora' => isset($_POST['valora']),
								 'precio' => isset($_POST['precio']),
								 'myimg1' => isset($_POST['myimg1']),
								 'myimg2' => isset($_POST['myimg2']),
								 'myimg3' => isset($_POST['myimg3']),
								 'myimg4' => isset($_POST['myimg4']),
								 'isla' => isset($_POST['isla']),  // refisla
								 'ayto' => isset($_POST['ayto']),  // refayto
								 'tipo' => isset($_POST['tipo']),
								 'espec1' => isset($_POST['espec1']),
								 'espec2' => isset($_POST['espec2']),									
								 'url' => isset($_POST['url']),
								 'map' => isset($_POST['map']),
								 'mapiframe' => isset($_POST['mapiframe']),
								 'latitud' => isset($_POST['latitud']),
								 'longitud' => isset($_POST['longitud']),
								 'calle' => isset($_POST['calle']),
								 'Email' => 'Solo letras minúsculas',
								 'Tlf1' => '',
								 'Tlf2' => '');

			$ctemp = "../Gch.Temp";
			if(file_exists($ctemp)){$dir1 = $ctemp."/";
									$handle1 = opendir($dir1);
									while ($file1 = readdir($handle1))
											{if (is_file($dir1.$file1))
												{unlink($dir1.$file1);}
												}	
								} else {}

			}
													   
		$precio = array ('' => 'RELACIÓN EUROS / SERVICIO',
						 '1' => '1 de 5 MUY MALOS',
						 '25' => '2 de 5 MALOS',
						 '50' => '3 de 5 NORMALES',
						 '75' => '4 de 5 BUENOS',
						 '100' => '5 de 5 MUY BUENOS');														

		$valora = array ('' => 'RELACIÓN ATENCIÓN / LOCAL',
						'1' => '1 de 5 MUY MALOS',
						'25' => '2 de 5 MALOS',
						'50' => '3 de 5 NORMALES',
						'75' => '4 de 5 BUENOS',
						'100' => '5 de 5 MUY BUENOS');														
	
	if ($errors){
		print("	<table align='center'>
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
		
	global $db;
	global $_sec;

	global $autor;
	$autor = @$_POST['autor'];

	/* CONSULTAMOS LA TABLA ADMIN = AUTORES */
	$sqlx =  "SELECT * FROM `gch_admin` WHERE `ref` = '$autor' ";
	$q = mysqli_query($db, $sqlx);
	$rowautor = mysqli_fetch_assoc($q);
	$_sec = @$rowautor['Nombre'];

	global $isla;
	$isla = @$_POST['isla'];

	/* CONSULTAMOS LA TABLA AYUNAMIENTOS = ISLA */
	$sqlis =  "SELECT * FROM `gch_islas` WHERE `refisla` = '$isla' ";
	$qis = mysqli_query($db, $sqlis);
	$rowisla = mysqli_fetch_assoc($qis);
	$_secis = @$rowisla['isla'];

	print(" <table align='center' style=\"border:0px;margin-top:4px\" width='400px'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<th colspan='2'>
						CREAR RESTAURANTE PARA ISLA ".strtoupper($_secis)."
					</th>
				</tr>		
				<tr>
					<td align='right'>
						<input type='submit' value='SELECCIONE UNA ISLA' />
						<input type='hidden' name='oculto1' value=1 />
					</td>
					<td align='left'>

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
					</td>
			</tr>
		</form>	
			</table>");
				
	if (isset($_POST['oculto1']) || isset($_POST['oculto'])) {
	if ($_POST['isla'] == '0') { 
						print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
										HA DE SELECCIONAR UNA ISLA PARA CREAR UN RESTAURANTE.
											</font>
										</td>
									</tr>
								</table>");
												}	

			////////////////////		**********  		////////////////////

		if ($_POST['isla'] == ''){print("
								<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													SELECCIONE UNA ISLA.
											</font>
										</td>
									</tr>
								</table>");} 
								
	elseif ($_POST['isla'] != '') { 
		
	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							NUEVO RESTAURANTE EN ".strtoupper($_secis)."
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
						
			<tr>								
						<td align='right' width=100px>
							REF ISLA
						</td>
						<td>
	<input name='isla' type='hidden' value='".$defaults['isla']."' />".$defaults['isla']." / ".$_secis."
						</td>
			</tr>

				<tr>
					<td align='right'>
						AYUNTAMIENTO
					</td>
					<td align='left'>

		<select name='ayto'>
		<option value=''>AYUNTAMIENTOS</option>");
						
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
					</td>
			</tr>
				<tr>

					<td align='right'>
						RESTAURANTE
					</td>
					<td>

		<input type='text' name='titulo' size=20 maxlength=20 value='".@$defaults['titulo']."' />

					</td>
				</tr>
									
				<tr>
					<td align='right'>						
						SUBTITULO
					</td>
					<td>
		<input type='text' name='subtitul' size=20 maxlength=20 value='".@$defaults['subtitul']."' />
					</td>
				</tr>
									
				<tr>
					<td align='right'>						
						PAGINA WEB
					</td>
					<td>
		<input type='text' name='url' size=40 maxlength=40 value='".@$defaults['url']."' placeholder='WEB URL'/>
					</td>
				</tr>

				<tr>
					<td align='right'>						
						MAPA WEB
					</td>
					<td>
		<input type='text' name='map' size=50 maxlength=49 value='".@$defaults['map']."' placeholder='MAP SHORT URL' />
					</td>
				</tr>

				<tr>
					<td align='right'>						
						MAPA IFRAME
					</td>
					<td>
		<input type='text' name='mapiframe' size=50 maxlength=340 value='".@$defaults['mapiframe']."' placeholder='MAP IFRAME URL' />
					</td>
				</tr>

				<tr>
					<td align='right'>						
						LATITUD
					</td>
					<td>
		<input type='text' name='latitud' size=18 maxlength=10 value='".@$defaults['latitud']."' placeholder='MAP LATITUD' />
					</td>
				</tr>

				<tr>
					<td align='right'>						
						LONGITUD
					</td>
					<td>
		<input type='text' name='longitud' size=18 maxlength=10 value='".@$defaults['longitud']."' placeholder='MAP LONGITUD' />
					</td>
				</tr>

				<tr>
					<td align='right'>						
						CALLE
					</td>
					<td>
		<input type='text' name='calle' size=50 maxlength=40 value='".@$defaults['calle']."' />
					</td>
				</tr>

				<tr>
					<td align='right'>
						Mail:
					</td>
					<td>
		<input type='text' name='Email' size=52 maxlength=50 value='".@$defaults['Email']."' />
					</td>
				</tr>	

				<tr>
					<td align='right'>
						Teléfono 1:
					</td>
					<td>
		<input type='text' name='Tlf1' size=12 maxlength=9 value='".@$defaults['Tlf1']."' />
					</td>
				</tr>
				
				<tr>
					<td align='right'>
						Teléfono 2:
					</td>
					<td>
		<input type='text' name='Tlf2' size=12 maxlength=9 value='".@$defaults['Tlf2']."' />
					</td>
				</tr>

				<tr>
					<td align='right'>
						CATEGORIA
					</td>
					<td align='left'>

		<select name='tipo'>
		<option value=''>CATEGORIAS ...</option>");
						
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

	print ("	</select>
					</td>
			</tr>

			<tr>
				<td align='right'>
						ESPECIALIDAD 1
				</td>
				<td align='left'>

		<select name='espec1'>
		<option value=''>ESPECIALIDADES ...</option>");
						
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

	print ("	</select>
					</td>
			</tr>


			<tr>
				<td align='right'>
						ESPECIALIDAD 2
				</td>
				<td align='left'>

		<select name='espec2'>
		<option value=''>ESPECIALIDADES ...</option>");
						
	/* SELECT ESPECIALIDAD */	

	global $db;
	$sqlespec2 =  "SELECT * FROM `gch_especialidad` ORDER BY `espec` ASC ";
	$qespec2 = mysqli_query($db, $sqlespec2);
	if(!$qespec2){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rowespec2 = mysqli_fetch_assoc($qespec2)){
					
					print ("<option value='".$rowespec2['refespec']."' ");
					
					if($rowespec2['refespec'] == @$defaults['espec2']){
															print ("selected = 'selected'");
																								}
									print ("> ".$rowespec2['espec']."</option>");
				}
		
			}  

	print ("</select>
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
				<td align='right'>						
					REFERENCIA
				</td>
				<td>
		<input type='hidden' name='refart' value='".$_SESSION['refart']."' />".$_SESSION['refart']."
				</td>
			</tr>
			<tr>
				<td align='right'>						
					DATE IN
				</td>
				<td>
		<input type='hidden' name='datein' value='".$_SESSION['datein']."' />".$_SESSION['datein']."
				</td>
			</tr>
			<tr>
				<td align='right'>						
					TIME IN
				</td>
				<td>
		<input type='hidden' name='timein' value='".$_SESSION['timein']."' />".$_SESSION['timein']."
				</td>
			</tr>
					
			<tr>
				<td align='right'>
					AUTOR
				</td>
				<td align='left'>

			<select name='autor'>
			<option value=''>POSIBLES AUTORES</option>");
						
	/* SELECT AUTOR DE LA ENTRADA */	
			
	global $db;
	$sqlb =  "SELECT * FROM `gch_admin` ORDER BY `Apellidos` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
					
					print ("<option value='".$rows['ref']."' ");
					
					if($rows['ref'] == @$defaults['autor']){
															print ("selected = 'selected'");
																								}
									print ("> ".$rows['Apellidos']." ".$rows['Nombre']."</option>");
				}
		
			}  

	print ("	</select>
					</td>
			</tr>

			<tr>
				<td colspan=2 align='center'>
					DESCRIPCION DEL RESTAURANTE
				</td>
			</tr>
			<tr>
				<td colspan=2 align='center'>
	<textarea cols='41' rows='9' onkeypress='return limitac(event, 400);' onkeyup='actualizaInfoc(400)' name='coment' id='coment'>".@$defaults['coment']."</textarea>
	
			</br>
	            <div id='infoc' align='center' style='color:#0080C0;'>
        					Maximum 400 characters            
				</div>

				</td>
			</tr>
								
			<tr>
				<td>
					FOTOGRAFÍA 1
				</td>
				<td>
		<input type='file' name='myimg1' value='".@$defaults['myimg1']."' />						
				</td>
			</tr>

			<tr>
				<td>
					FOTOGRAFÍA 2
				</td>
				<td>
		<input type='file' name='myimg2' value='".@$defaults['myimg2']."' />						
				</td>
			</tr>

			<tr>
				<td>
					FOTOGRAFÍA 3
				</td>
				<td>
		<input type='file' name='myimg3' value='".@$defaults['myimg3']."' />						
				</td>
			</tr>
			<tr>
				<td>
					FOTOGRAFÍA 4
				</td>
				<td>
		<input type='file' name='myimg4' value='".@$defaults['myimg4']."' />						
				</td>
			</tr>

			<tr>
				<td colspan='2' align='right' valign='middle'  class='BorderSup'>
					<input type='submit' value='CREAR RESTAURANTE' />
					<input type='hidden' name='oculto' value=1 />
				</td>
			</tr>
		</form>														
			</table>"); 
						}
							}
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
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

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../Gch.Inclu/Master_Index_Artic.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	require '../Gch.Inclu/Admin_Inclu_02.php';

?>