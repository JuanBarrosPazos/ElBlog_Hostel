<?php

	require 'Gch.Connet/conection.php';
	require 'Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

	global $inforut;
	$inforut = "";
	require 'Gch.Users/Only.index.user.php';

	ayear();

	if (isset($_POST['salir'])) { 
                    require 'Gch.Connet/conection.php';
                    require 'Gch.Connet/conect.php';
					infoout();
					sale_usuario();
					salirf();
					//session_destroy();
					global $redir;
					$redir = "<script type='text/javascript'>
								function redir(){
								 window.location.href='index.php';
								}
								setTimeout('redir()',1);
								</script>";
							print ($redir);
					}

	if(isset($_POST['login'])){
				//process_login();
				/**/
				if ($_SESSION['logpage'] == ''){$_SESSION['logpage'] = '?page=1';}
				global $redir;
				$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='index.php".$_SESSION['logpage']."';
					}
					setTimeout('redir()',1);
					</script>";
				print ($redir);
				
			}

	if ((isset($_POST['oculto'])) || (isset($_POST['oculto1']))) {
													show_form();
													process_form();
													} 
	elseif (isset($_GET['pagef'])) { show_form();
									 process_form();
											}
	elseif ((isset($_GET['page'])) || (isset($_POST['page'])) || (isset($_SESSION['logpage']))) {
											show_form();
											ver_todo();
										}
	else { 	unset($_SESSION['isla']);
			unset($_SESSION['ayto']);
			unset($_SESSION['tipo']);
			unset($_SESSION['espec1']);
			unset($_SESSION['nombre']);
			unset($_SESSION['refartop']);
			unset($_SESSION['mailto']);
			unset($_SESSION['titulo']);
			unset($_SESSION['logpage']);
			unset($_SESSION['a']);
			
			show_form();
			ver_todo();
		}
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif(){
									   							
	$filename = "Gch.Config/ayear.php";
	$fw1 = fopen($filename, 'r+');
	$cyear = fread($fw1,filesize($filename));
	fclose($fw1);
	
	$cyear = explode("\n",$cyear);
	$cyear[2] = "'' => 'YEAR',\n'".date('y')."' => '".date('Y')."',";
	$cyear = implode("\n",$cyear);
	
	//fseek($fw, 37);
	$fw = fopen($filename, 'w+');
	fwrite($fw, $cyear);
	fclose($fw);
	}

function modif2(){
	$filename = "Gch.Config/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
	}


function ayear(){
	$filename = "Gch.Config/year.txt";
	$fw2 = fopen($filename, 'r+');
	$fget = fgets($fw2);
	fclose($fw2);
	
	if($fget == date('Y')){
		/*
		print(" <div style='clear:both'></div>
				<div style='width:200px'>* EL AÑO ES EL MISMO </div>".date('Y')." == ".$fget );
		*/
			}
	elseif($fget != date('Y')){ 
		/*
		print(" <div style='clear:both'></div>
				<div style='width:200px'>* EL AÑO HA CAMBIADO </div>".date('Y')." != ".$fget );
		*/
		modif();
		modif2();
		}
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function infoout() {

    global $dateadout;
    $dateadout = date('Y-m-d/H:i:s');

	global $logtext;
    $logtext = PHP_EOL.PHP_EOL."** FIN DE SESION ".$_SESSION['uNombre']." ".$_SESSION['uApellidos']." => ".$dateadout.PHP_EOL.PHP_EOL;
	
	global $logdate;
	$logdate = date('Y_m_d');
	global $filename;
    $filename = "Gch.Log/".$logdate."_".$_SESSION['uref'].".log";
    $log = fopen($filename, 'ab+');
    fwrite($log, $logtext);
    fclose($log);
}

function sale_usuario(){

    global $db;
    global $db_name;
    global $userid;
    $userid = $_SESSION['uid'];
        
    global $dateadout;
    $dateadout = date('Y-m-d/H:i:s');
        
    $sqladout = "UPDATE `$db_name`.`gch_user` SET `lastout` = '$dateadout' WHERE `gch_user`.`id` = '$userid' LIMIT 1 ";
            
    if(mysqli_query($db, $sqladout)){

	 } else { print("</br>
                <font color='#FF0000'>
            * FATAL ERROR funcion sale_usuario(): ".mysqli_error($db))."</font>
                </br>";
                  }

	//salirf();

		  }

function salirf() {	unset($_SESSION['uid']);
                    unset($_SESSION['uNivel']);
                    unset($_SESSION['uNombre']);
                    unset($_SESSION['uApellidos']);
                    unset($_SESSION['uEmail']);
                    unset($_SESSION['uUsuario']);
                    unset($_SESSION['uPassword']);
                    unset($_SESSION['uDireccion']);
					unset($_SESSION['uTlf1']);
					unset($_SESSION['logpage']);
				}

function process_login(){
                if((@$_SESSION['uNivel'] == 'useru')||(@$_SESSION['uNivel'] == 'adminu')){}
                else { print("Acceso no permitido");}
            }

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;
	
	//echo @$_SESSION['ayto']."<br>";

	global $nombre;
	global $ayto;
	global $isla;
	global $tipo;
	global $espec1;

	if (strlen(trim(@$_SESSION['nombre'])) == 0){
		$nombre = '';
	}else{
		$nombre = trim($_SESSION['nombre']);
		$nombre = "%".$nombre."%";
		$nombre = "AND `tit` LIKE '$nombre'";
	}

	if (strlen(trim(@$_SESSION['ayto'])) == 0){
		$ayto = '';
	}else{
		$ayto = trim($_SESSION['ayto']);
		$ayto = "AND `refayto` = '$ayto'";
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

	global $orden;
	if (strlen(trim(@$_SESSION['orden'])) == 0){
		$orden = 'ORDER BY `id` DESC';
	}else{
		$orden = trim($_SESSION['orden']);
		}

	global $isla;
	$isla = @$_SESSION['isla'];

	global $vname;
	$vname = "gch_art";
	$vname = "`".$vname."`";

	if (strlen(trim(@$_SESSION['isla'])) == 0){
		global $result;
		$result =  "SELECT * FROM $vname $orden";
	}else{
		global $result;
		$result =  "SELECT * FROM `$db_name`.$vname WHERE `refisla` = '$isla' $nombre $ayto  $tipo $espec1 $orden ";
	}

	//$result =  "SELECT * FROM `$db_name`.$vname WHERE `refisla` = '$isla' $ayto  $tipo $espec1 ";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 3;
	
	global $pagef;

	if (isset($_POST["pagef"])) {
		global $pagef;
        $pagef = $_POST["pagef"];
    }

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET['pagef'])) {
        $pagef = $_GET['pagef'];
    }

    if (!$pagef) {
        $start = 0;
        $pagef = 1;
    } else {
        $start = ($pagef - 1) * $nitem;
    }
    
    //calculo el total de paginas
	$total_pages = ceil($num_total_rows / $nitem);
	
	// CALCULO CUANTOS RESUSTALDOS DEL TOTAL EN LA PAGINACIÓN
	global $nres;
	$nres = $pagef * $nitem;
	if($nres < $num_total_rows){ 
								 $nres = $nres;}
	else{ $nres = $num_total_rows;}

	//pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
	echo '<div style="clear:both"></div>
		<h7>* Restaurantes: '.$nres.' de '.$num_total_rows.' * P&aacute;gina '.$pagef.' de ' .$total_pages.'.</h7>';

	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	if (strlen(trim(@$_SESSION['isla'])) == 0){
		global $sqlb;
		$sqlb =  "SELECT * FROM `$db_name`.$vname $orden $limit";
	}else{
		global $sqlb;
		$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `refisla` = '$isla' $nombre $ayto $tipo $espec1 $orden $limit";
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
									
		} else {
			print ("<div class='row'> <!-- isla -->
					<div class='col-lg-12 text-center'>
					  <h2 class='section-heading text-uppercase'>Restaurantes</h2>
					  <!--
					  <h3 class='section-subheading text-muted'>Lorem ipsum dolor sit amet consectetur.</h3>
					  -->
					</div>
				  	</div>
					<div class='row'> <!-- Inicio class row-->
					<div class='col-lg-12'>  <!-- Inicio class col-lg-12 -->
					<ul class='timeline'> <!-- Inicio Ul class timeline -->
									");
			
				global $estilo;
				$estilo = array('timeline','timeline-inverted');
				global $estiloin;
				$estiloin = 0;
	
	while($rowb = mysqli_fetch_assoc($qb)){

	require 'Gch.Artic/Inclu_Name_Ref_to_Name.php';

	// DEFINO LA RECTIFICACIÓN DE LA RUTA IMG
    global $rut;
    $rut = "";
    //$rut = "../";

	require 'Gch.Artic/Inclu_Valora_Calculos.php';

	require 'Gch.Artic/Inc_Art_Index_Form.php';

	require 'Gch.Artic/Inc_Centra_Img.php';

	print ("
		<li  class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
		<img class='<!--rounded-circle--> img-fluid' ".$centra." src='Gch.Img.Art/".$rowb['myimg1']."' alt=''>
			</div>

		<div class='timeline-panel'>
			<div class='timeline-heading'>
						<h6>
				<a href=\"Gch.Www/portfolio.php?portfolio=".$rowb['refart']."\">".$rowb['tit']."</a>
						</h6>
						".$islaname." / ".$aytoname."<br>
						".$tipname." / ".$espec1name." / ".$espec2name."<br>
						N.Val: ".$num_val." Local Servicio: ".$valx100."%
					<div class=\"progresa\">
						<div class=\"progresab\" style=\"width:".$valx100."%;\">
						</div>
						<img class=\"star\" src='Gch.Img.Sys/5Star.png' />
					</div>
					<br>

					Indice de Precios ".$val2x100."%
					<div class=\"progresa\">
						<div class=\"progresab\" style=\"width:".$val2x100."%;\">
						</div>
						<img class=\"star\" src='Gch.Img.Sys/5Star.png' />
					</div>
					<div style='display:block;'>".$url.$email."</div>
					<div style='display:block;'>".$mapa."</div>
					<div style='dixplay:inline-block'>
					<a href=\"Gch.Www/portfolio.php?portfolio=".$rowb['refart']."\">VER MÁS...</a>
					</div>
		</li> <!-- Final Li contenedor -->
		");
		$estiloin = 1 - $estiloin;	

		} // Fin While

	print(" </ul> <!-- Fin Ul class timeline -->
			</div> <!-- Fin class col-lg-12 -->
  			</div> <!-- Fin class row-->
			");
				} 
    echo '<nav>';
    echo '<ul class="pagination">';

    if ($total_pages > 1) {
        if ($pagef != 1) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($pagef-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($pagef == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$pagef.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="index.php?pagef='.$i.'">'.$i.'</a></li>';
            }
        }

        if ($pagef != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="index.php?pagef='.($pagef+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';
			} 

		$_SESSION['logpage'] = '?pagef='.$pagef;

	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){

	global $db;
	global $defaults;

	/* SELECCIONO LA ISLA*/
	if((isset($_POST['oculto1']))||(isset($_GET['inicio']))){	
									$_SESSION['isla'] = @$_POST['isla'];
									unset($_SESSION['ayto']);
									unset($_SESSION['tipo']);
									unset($_SESSION['espec1']);
									unset($_SESSION['nombre']);
									unset($_SESSION['orden']);
										}
	/* SELECCIONO LOS FILTROS */
	if(isset($_POST['oculto'])){ $_SESSION['isla'] = $_POST['isla'];
								 $_SESSION['ayto'] = $_POST['ayto'];
								 $_SESSION['tipo'] = $_POST['tipo'];
								 $_SESSION['espec1'] = $_POST['espec1'];
								 $_SESSION['nombre'] = $_POST['nombre'];
								 $_SESSION['orden'] = $_POST['orden'];

								 //$defaults = $_POST;
									}
	/* SELECCIONO LOS FILTROS */
	if(isset($_GET['page'])){ }

	//echo "**** ".$_SESSION['isla']."<br>";

	$ordenar = array (	'ORDER BY `id` ASC' => 'Mas Antiguo',
						'ORDER BY `id` DESC' => 'Mas Reciente',
						'ORDER BY `tit` ASC' => 'Nombre Ascendente',
						'ORDER BY `tit` DESC' => 'Nombre Descendente',
						'ORDER BY `ivalora` ASC' => 'Valoracion Ascenedente',
						'ORDER BY `ivalora` DESC' => 'Valoracion Descendente',
						'ORDER BY `iprecio` ASC' => 'Precios Ascendente',
						'ORDER BY `iprecio` DESC' => 'Precios Descendente',);

	global $isla;
	//$isla = @$_POST['isla'];
	$isla = @$_SESSION['isla'];
	
	print(" <div  style='float:left'>
				<form name='form_tabla' action='$_SERVER[PHP_SELF]' method='POST'>
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

	<input type='submit' value='APLICAR FILTROS' />
	<input type='hidden' name='oculto' value=1 />

	<input type='text' name='nombre' size=24 maxlength=22 pattern=\"[a-zA-Z0-9\s]{2,20}\" placeholder=\"&nbsp;&nbsp;OPCION POR NOMBRE\" value='".@$_SESSION['nombre']."' autofocus />

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

	<select name='orden'>
	<option value=''>ORDENAR POR</option>");

	foreach($ordenar as $option => $label){
			print ("<option value='".$option."' ");
			if($option == @$_SESSION['orden']){ print ("selected = 'selected'"); }
								print ("> $label </option>");
						}
	print ("</select>

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
	
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 3;
	
	global $page;

    if (isset($_POST["page"])) {
		global $page;
        $page = $_POST["page"];
    }

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["page"])) {
		global $page;
        $page = $_GET["page"];
    }

    if (!$page) {
		global $page;
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * $nitem;
    }
    
    //calculo el total de paginas
	$total_pages = ceil($num_total_rows / $nitem);
	
	// CALCULO CUANTOS RESUSTALDOS DEL TOTAL EN LA PAGINACIÓN
	global $nres;
	$nres = $page * $nitem;
	if($nres < $num_total_rows){ 
								 $nres = $nres;}
	else{ $nres = $num_total_rows;}

	//pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
	echo '<div style="clear:both"></div>
	<h7>* Restaurantes: '.$nres.' de '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.'.</h7>';

	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname ORDER BY `id` DESC $limit";
	
	/*
	$sqlb =  "SELECT * FROM `gch_admin` WHERE `gch_admin`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
	*/
	$qb = mysqli_query($db, $sqlb);

	if(!$qb){
			print("<font color='#FF0000'>Consulte L.75: </font></br>".mysqli_error($db)."</br>");
			
	} else {
		if(mysqli_num_rows($qb)== 0){
			print ("<table align='center'>
						<tr>
							<td style='text-align:center'>
								<h4>
									<a href='Gch.Admin/access.php' target='_blank'>
								NO HAY DATOS
									<br>
								CREE SU PRIMER RESTAURANTE
									</a>
								</h4>
							</td>
						</tr>
					</table>");
	} else { 	

	print ("<div class='row'> <!-- Titulo -->
				<div class='col-lg-12 text-center'>
				<h2 class='section-heading text-uppercase'>Restaurantes</h2>
				<!--
				<h3 class='section-subheading text-muted'>Lorem ipsum dolor sit amet consectetur.</h3>
				-->
				</div>
		  	</div>
			<div class='row'> <!-- Inicio class row-->
			<div class='col-lg-12'>  <!-- Inicio class col-lg-12 -->
			<ul class='timeline'> <!-- Inicio Ul class timeline -->
				");
			
	global $estilo;
	$estilo = array('timeline','timeline-inverted');
	
	global $estiloin;
	$estiloin = 0;

	while($rowb = mysqli_fetch_assoc($qb)){

	require 'Gch.Artic/Inclu_Name_Ref_to_Name.php';

    // DEFINO LA RECTIFICACIÓN DE LA RUTA IMG
    global $rut;
    $rut = "";
	//$rut = "../";
	
	require 'Gch.Artic/Inclu_Valora_Calculos.php';

	require 'Gch.Artic/Inc_Art_Index_Form.php';

	require 'Gch.Artic/Inc_Centra_Img.php';

	print ("
	<li class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
		<img class='<!--rounded-circle--> img-fluid' ".$centra." src='Gch.Img.Art/".$rowb['myimg1']."' alt=''>
			</div>

		<div class='timeline-panel'>
				<div class='timeline-heading'>
						<h6>
				<a href=\"Gch.Www/portfolio.php?portfolio=".$rowb['refart']."\">".$rowb['tit']."</a>
						</h6>
						".$islaname." / ".@$aytoname."</h6>
						".$tipname." / ".$espec1name." / ".$espec2name."<br>
						N.Val: ".$num_val." Local Servicio: ".$valx100."%
					<div class=\"progresa\">
						<div class=\"progresab\" style=\"width:".$valx100."%;\">
						</div>
						<img class=\"star\" src='Gch.Img.Sys/5Star.png' />
					</div>
					<br>

					Indice de Precios ".$val2x100."%
					<div class=\"progresa\">
						<div class=\"progresab\" style=\"width:".$val2x100."%;\">
						</div>
						<img class=\"star\" src='Gch.Img.Sys/5Star.png' />
					</div>
					<br>

				</div>
				<div class='timeline-body'>
					<p class='text-muted'>".$conte."</p>
				</div>
		<div id=\"".$refart."\"></div>
			</div>
		</li> <!-- Final Li contenedor -->
		");
		$estiloin = 1 - $estiloin;	


	} // Fin While

	print(" </ul> <!-- Fin Ul class timeline -->
			</div> <!-- Fin class col-lg-12 -->
  			</div> <!-- Fin class row-->
			");
			
						} 
    echo '<nav>';
    echo '<ul class="pagination">';

    if ($total_pages > 1) {
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';

			} 

	$_SESSION['logpage'] = '?page='.$page;

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

/* Creado por Juan Barros Pazos 2020 */
