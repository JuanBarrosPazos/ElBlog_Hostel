<?php

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

	if (isset($_POST['salir'])) { session_destroy();
								  salir();
							}

	if(isset($_POST['login'])){ 
				//process_login();
			}

	if ((isset($_POST['oculto'])) || (isset($_POST['oculto1']))) {
													show_form();
													process_form();
													//info();
													} 
	else { 	unset($_SESSION['isla']);
			unset($_SESSION['ayto']);
			unset($_SESSION['tipo']);
			unset($_SESSION['espec1']);
			unset($_SESSION['nombre']);
			unset($_SESSION['refartop']);
			unset($_SESSION['mailto']);
			unset($_SESSION['titulo']);
			show_form();
			ver_todo();
				}

//////////////////////////////////////////////////////////////////////////////////////////////

    /*
	function salir() {	unset($_SESSION['id']);
						unset($_SESSION['Nivel']);
						unset($_SESSION['Nombre']);
						unset($_SESSION['Apellidos']);
						unset($_SESSION['doc']);
						unset($_SESSION['Email']);
						unset($_SESSION['Usuario']);
						unset($_SESSION['Password']);
						unset($_SESSION['Direccion']);
						unset($_SESSION['Tlf1']);
	}

    function process_login(){
            if ($_SESSION['Nivel'] == 'user'){}
            else { print("Acceso no permitido");}
    }
    */

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;
	
	//echo @$_SESSION['ayto']."<br>";

	global $ayto;
	global $isla;
	global $tipo;
	global $espec1;

	if (strlen(trim(@$_SESSION['ayto'])) == 0){
		$ayto = '';
		global $zoom;
		$zoom = 9;
	}else{
		$ayto = trim($_SESSION['ayto']);
		$ayto = "AND `refayto` = '$ayto'";
		global $zoom;
		$zoom = 13;
	}

	if (strlen(trim(@$_SESSION['tipo'])) == 0){
		$tipo = '';
	}else{
		$tipo = trim($_SESSION['tipo']);
		$tipo = "AND `reftipo` = '$tipo'";
	}

	if (strlen(trim(@$_SESSION['espec1'])) == 0){
		$espec1 = '';
	}else{
		$espec1 = trim($_SESSION['espec1']);
		//$espec1 = "AND `refespec1` = '$espec1' ";
		$espec1 = "AND (`refespec1` = '$espec1' OR `refespec2` = '$espec1') ";
	}

	global $isla;
	$isla = @$_SESSION['isla'];

	global $vname;
	$vname = "gch_art";
	$vname = "`".$vname."`";

	if (strlen(trim(@$_SESSION['isla'])) == 0){
		global $result;
		$result =  "SELECT * FROM $vname ";
		global $zoom;
		$zoom = 8;
	}else{
		global $result;
		$result =  "SELECT * FROM `$db_name`.$vname WHERE `refisla` = '$isla' $ayto  $tipo $espec1 ";
	}

	//$result =  "SELECT * FROM `$db_name`.$vname WHERE `refisla` = '$isla' $ayto  $tipo $espec1 ";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
    if (strlen(trim(@$_SESSION['isla'])) == 0){
		global $sqlb;
		$sqlb =  "SELECT * FROM `$db_name`.$vname ";
	}else{
		global $sqlb;
		$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `refisla` = '$isla' $ayto $tipo $espec1 ";
	}

	//$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `refisla` = '$isla' $ayto $tipo $espec1  ORDER BY $orden $limit";
	$qb = mysqli_query($db, $sqlb);

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.116: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){
					print ("<table align='center'>
								<tr>
									<td aling='center'>
										<font color='#FF0000'>
											NO HAY DATOS
										</font>
									</td>
								</tr>
							</table>");
							ver_todo();
		} else {
			
			$qa = mysqli_query($db, $sqlb);
			$rowa = mysqli_fetch_assoc($qa);
			// IMPRIMO LA CABECERA DEL SCRIPT PARA POSICIONAR LAT LONG
			// Y LA POSICION INICIAL
			print (" <script type=\"text/javascript\">
						var map;
						var centerll = {lat: ".$rowa['latitud'].", lng: ".$rowa['longitud']."};
						
						function initMap() {
						map = new google.maps.Map(document.getElementById('map'), {
						center: centerll,
						zoom: ".$zoom."
						/*
						DESACTIVA DEFAUTLCONTROLS
						,
						disableDefaultUI: true
						*/
						});

						var marker1  = new google.maps.Marker({
							position: centerll,
							map:map
							});");
			
			// INICIALIZO A 1 PARA COMENZAR EL BUCLE EN 2
			global $p;
			$p = 1;

			while($rowb = mysqli_fetch_assoc($qb)) {

			// IMPRIMO EL BUCLE PARA POSICIONAR LAT Y LONG
			$p = $p + 1;
			//print ("* ".$p." Latitud: ".$rowb['latitud']." Longitud: ".$rowb['longitud']."<br>");

			print ("var marker".$p." = new google.maps.Marker({
				position: {lat: ".$rowb['latitud'].", lng: ".$rowb['longitud']."},
				map:map
				});");
			
			} // Fin While

			// CIERRO LA FUNCION JS INIT MAP
			print ("    }
					</script>");
				} 
					} 
	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){

	global $db;

	/* SELECCIONO LA ISLA*/
	if(isset($_POST['oculto1'])){	$_SESSION['isla'] = $_POST['isla'];
									unset($_SESSION['ayto']);
									unset($_SESSION['tipo']);
									unset($_SESSION['espec1']);
										}
	/* SELECCIONO LOS FILTROS */
	if(isset($_POST['oculto'])){ $_SESSION['isla'] = $_POST['isla'];
								 $_SESSION['ayto'] = $_POST['ayto'];
								 $_SESSION['tipo'] = $_POST['tipo'];
								 $_SESSION['espec1'] = $_POST['espec1'];

								 //$defaults = $_POST;
									}
	/* SELECCIONO LOS FILTROS */
	if(isset($_GET['page'])){ }

	//echo "**** ".$_SESSION['isla']."<br>";

	global $isla;
	//$isla = @$_POST['isla'];
	$isla = @$_SESSION['isla'];
	
	print(" <div  style='float:left; display: inline-block;'>
				<form name='form_tabla' action='$_SERVER[PHP_SELF]' method='POST'>
					<input type='submit' value='SELECCIONE UNA ISLA' />
					<input type='hidden' name='oculto1' value=1 />

			<select name='isla' style=\"display: inline-clock;\">
			<option value=''>ISLAS</option>");
						
	/* RECORREMOS LOS VALORES DE LA TABLA ISLAS PARA CONSTRUIR CON ELLOS UN SELECT */	
			
	global $db;
	$sqlb =  "SELECT * FROM `gch_islas`";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
		while($rows = mysqli_fetch_assoc($qb)){
					print ("<option value='".$rows['refisla']."' ");
					if($rows['refisla'] == @$_SESSION['isla']){
										print ("selected = 'selected'");
													}
						print ("> ".$rows['isla']."</option>");
				}
			}  

	print ("</select>
				</form>	
			</div>");
				
	if (isset($_POST['oculto1']) || isset($_POST['oculto'])||(isset($_SESSION['isla']))) {

	//////////////////////////

	if ((@$_POST['isla'] == '')&&($_SESSION['isla'] == '')){
		print(" <table align='center' style=\"margin-top:20px;margin-bottom:20px\">
					<tr align='center'>
						<td>
							<font color='red'>
						<b>
								SELECCIONE UNA ISLA.
							</font>
						</td>
					</tr>
				</table>");} 
								
	elseif ((@$_POST['isla'] != '')||($_SESSION['isla'] != '')) { 
		
	print("<div style='float:left'>
				
<form name='form_datos' action='$_SERVER[PHP_SELF]' method='POST'>
						
	<input type='hidden' name='isla' value='".$_SESSION['isla']."' />

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
					
			if($rowsayt['refayto'] == @$_SESSION['ayto']){
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
					if($rowtipo['reftipo'] == @$_SESSION['tipo']){
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
					if($rowespec1['refespec'] == @$_SESSION['espec1']){
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
		<div style='clear:both'></div>"); 
				}
					}
	
	}	// FIN FUNCTION

//////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;

	global $vname;
	$vname = "gch_art";
	$vname = "`".$vname."`";
	
	$result =  "SELECT * FROM $vname ";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	$sqlb =  "SELECT * FROM `$db_name`.$vname ORDER BY `id` ASC";
	$qb = mysqli_query($db, $sqlb);

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.75: </font></br>".mysqli_error($db)."</br>");
			
	} else {
		if(mysqli_num_rows($qb)== 0){
					print ("<table align='center'>
								<tr>
									<td aling='center'>
										<font color='#FF0000'>
											NO HAY DATOS
										</font>
									</td>
								</tr>
							</table>");
	} else { 	

	// IMPRIMO LA CABECERA DEL SCRIPT PARA POSICIONAR LAT LONG
	// Y LA POSICION INICIAL
	print (" <script type=\"text/javascript\">
				var map;
				var centerll = {lat: 39.401008, lng: 2.756768};
				
				function initMap() {
				map = new google.maps.Map(document.getElementById('map'), {
				center: centerll,
				zoom: 8
				/*
				DESACTIVA DEFAUTLCONTROLS
				,
				disableDefaultUI: true
				*/
				});

				var marker1  = new google.maps.Marker({
					position: centerll,
					map:map
					});");
	
	// INICIALIZO A 1 PARA COMENZAR EL BUCLE EN 2
	global $p;
	$p = 1;

	while($rowb = mysqli_fetch_assoc($qb)) {

	// IMPRIMO EL BUCLE PARA POSICIONAR LAT Y LONG
	$p = $p + 1;
	//print ("* ".$p." Latitud: ".$rowb['latitud']." Longitud: ".$rowb['longitud']."<br>");

	print ("var marker".$p." = new google.maps.Marker({
		position: {lat: ".$rowb['latitud'].", lng: ".$rowb['longitud']."},
		map:map
		});");
    
	} // Fin While

	// CIERRO LA FUNCION JS INIT MAP
	print ("    }
			</script>");
		} 
			} 
		
	} // FIN FUNCTION VER_TODO()

/////////////////////////////////////////////////////////////////////////////////////////////////

/* Creado por Juan Barros Pazos 2020 */
