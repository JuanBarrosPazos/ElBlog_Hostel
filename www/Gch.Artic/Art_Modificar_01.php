<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_01b.php';
	require '../Gch.Inclu/mydni.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ 

	master_index();

	/*	*/
	if((isset($_POST['oculto']))||(isset($_POST['oculto1']))){
												show_form();
												process_form();
												//info();
											}	

	elseif (isset($_GET['pageb'])) { show_form();
									 process_form(); 
										}

	elseif (isset($_GET['page'])) { show_form();
									ver_todo(); 
										}

	else { 	unset($_SESSION['isla']);
			unset($_SESSION['ayto']);
			unset($_SESSION['tipo']);
			unset($_SESSION['espec1']);	
			unset($_SESSION['modid']);
			show_form();
			ver_todo();}

} else { require '../Gch.Inclu/table_permisos.php'; }

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
	}else{
		$ayto = trim($_SESSION['ayto']);
		$ayto = "AND `refayto` = '$ayto'";
	}

	if (strlen(trim(@$_SESSION['tipo'])) == 0){
		$tipo = '';
		$g = 'AND';
	}else{
		$tipo = trim($_SESSION['tipo']);
		$tipo = "AND `reftipo` = '$tipo'";
	}

	if (strlen(trim(@$_SESSION['espec1'])) == 0){
		$espec1 = '';
	}else{
		$espec1 = trim($_SESSION['espec1']);
		$espec1 = "AND `refespec1` = '$espec1'";
	}

	global $orden;
	$orden = "`id` DESC";

	global $isla;
	$isla = @$_SESSION['isla'];

	//$fil = $dy1."-%".$dm1."%";
	global $vname;
	$vname = "gch_art";
	$vname = "`".$vname."`";

	global $dm1;
	$dm1 = ''; 
	global $dyt1;
	$dyt1 = date('Y');
	global $fil;
	$fil = $dyt1."-%";

	if (strlen(trim(@$_SESSION['isla'])) == 0){
		global $result;
		$result =  "SELECT * FROM $vname WHERE `datein` LIKE '$fil'";
	}else{
		global $result;
		$result =  "SELECT * FROM `$db_name`.$vname WHERE `refisla` = '$isla' $ayto  $tipo $espec1 ";
	}

	//$result =  "SELECT * FROM `$db_name`.$vname WHERE `refisla` = '$isla' $ayto  $tipo $espec1 ";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 5;
	
	global $pageb;

	if (isset($_POST["pageb"])) {
		global $pageb;
        $pageb = $_POST["pageb"];
    }

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET['pageb'])) {
        $pageb = $_GET['pageb'];
    }

    if (!$pageb) {
        $start = 0;
        $pageb = 1;
    } else {
        $start = ($pageb - 1) * $nitem;
    }
    
    //calculo el total de paginas
	$total_pages = ceil($num_total_rows / $nitem);
	
	// CALCULO CUANTOS RESUSTALDOS DEL TOTAL EN LA PAGINACIÓN
	global $nres;
	$nres = $pageb * $nitem;
	if($nres < $num_total_rows){ 
								 $nres = $nres;}
	else{ $nres = $num_total_rows;}

	//pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
	echo '<div style="clear:both"></div>
		<h7>* Restaurantes: '.$nres.' de '.$num_total_rows.' * P&aacute;gina '.$pageb.' de ' .$total_pages.'.</h7>';

	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	if (strlen(trim(@$_SESSION['isla'])) == 0){
		global $sqlb;
		$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `datein` LIKE '$fil' ORDER BY `id` DESC $limit";
	}else{
		global $sqlb;
		$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `refisla` = '$isla' $ayto $tipo $espec1  ORDER BY $orden $limit";
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
			print ("<div class=\"juancentra col-xs-12 col-sm-12 col-lg-6\" style=\"	vertical-align: top !important; margin-top: 6px;\">

			RESTAURANTES ".$nres." de ".$num_total_rows."<br>");
			
	while($rowb = mysqli_fetch_assoc($qb)){

	require 'Inclu_Name_Ref_to_Name.php';
				
	global $actionforma;
	$actionforma = "<form name='ver' action='Art_Modificar_02.php' method='POST'>";
	global $formbotona;
	$formbotona = "<div class='whiletotala' style=\"width:41% !important; min-width:124px !important;\";>
						<input type='submit' value='MODIFICAR DATOS' style=\"width:122px;\" />
						<input type='hidden' name='oculto2' value=1 />
				</form>";
	global $actionformb;
	$actionformb = "<form name='modifica_img' action='Art_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=550px,height=400px')\"  style=\"display: inline-block;\">";
	global $formbotonb;
	$formbotonb = "	<input type='submit' value='MODIF IMG' style=\"width:122px;\" />
					<input type='hidden' name='oculto2' value=1 />
				</div>
			</form>";

	require 'Inc_Art_While_Total.php';

			} // FIN DEL WHILE

		print("</div>");
		
			} 
		} 

		    if ($total_pages > 1) {
        if ($pageb != 1) {
			echo '<div class="paginacion">
					<a href="Art_Modificar_01.php?pageb='.($pageb-1).'">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</div>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($pageb == $i) {
				echo '<div class="paginacion">
						<a href="#">'.$pageb.'</a>
					</div>';
            } else {
				echo '<div class="paginacion">
						<a href="Art_Modificar_01.php?pageb='.$i.'">'.$i.'</a>
					</div>';
            }
        }

        if ($pageb != $total_pages) {
			echo '<div class="paginacion">
					<a href="Art_Modificar_01.php?pageb='.($pageb+1).'">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</div>';
			}
		}

	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){

	global $cart;
	$cart = "<form name='creanews' method='post' action='Art_Crear.php' style=\"display:inline-block;\">
					<input type='submit' value='CREAR NUEVO RESTAURANTE' />
					<input type='hidden' name='volver' value=1 />
				</form>";
	global $titulo;

	global $titulo;
	$titulo = "MODIFICAR RESTAURANTES";

	require 'Inc_Show_Form_01.php';
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;

	if (isset($_POST['Orden'])){ $orden = $_POST['Orden']; }
	else { $orden = '`id` ASC'; }

	global $dyt1;
	global $dm1;
	global $dd1;
	
	if (@$_POST['dy'] == ''){ $dy1 = date('Y');
							 $dyt1 = date('Y');} 
		else {	$dy1 = "20".$_POST['dy'];
				$dyt1 = "20".$_POST['dy'];}
	if (@$_POST['dm'] == ''){ $dm1 = '';} 
		else { $dm1 = "-".$_POST['dm']."-"; }
	if (@$_POST['dd'] == ''){ $dd1 = '';} else { $dd1 = $_POST['dd'];}
	if ((@$_POST['dm'] == '')&&(@$_POST['dd'] != '')){
				//$dm1 = date('m');
				$dm1 = '';
				$dd1 = $_POST['dd'];
				global $fil;
				$fil = $dy1."-%".$dm1."%-".$dd1."%";
					}
		else{ 	global $fil;
				$fil = $dy1.$dm1.$dd1."%";
					}

	global $vname;
	$vname = "gch_art";
	$vname = "`".$vname."`";

	$result =  "SELECT * FROM $vname ";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 5;
	
	global $page;

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
    echo '<h7>* Restaurantes: '.$nres.' de '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.'.</h7>';


	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `datein` LIKE '$fil' ORDER BY $orden $limit ";
	//$sqlb =  "SELECT * FROM `$db_name`.$vname  ORDER BY `refart` ASC $limit";

	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("<font color='#FF0000'>Consulte L.587: </font></br>".mysqli_error($db)."</br>");
			
	} else {
		if(mysqli_num_rows($qb)== 0){
			print ("<table align='center'>
						<tr>
							<td>
								<font color='#FF0000'>
									NO HAY DATOS
								</font>
							</td>
						</tr>
					</table>");
		} else { 

	print ("<div class=\"juancentra col-xs-12 col-sm-12 col-lg-6\" style=\"	vertical-align: top !important; margin-top: 6px;\">

		RESTAURANTES ".$nres." de ".$num_total_rows."<br>");
					
	while($rowb = mysqli_fetch_assoc($qb)){
				
				require 'Inclu_Name_Ref_to_Name.php';

				require 'Inc_Art_While_Total.php';

		} // FIN DEL WHILE

		print("</div>");

		} 
	} 

    if ($total_pages > 1) {
        if ($page != 1) {
			echo '<div class="paginacion">
					<a href="Art_Modificar_01.php?page='.($page-1).'">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</div>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
				echo '<div class="paginacion">
						<a href="#">'.$page.'</a>
					</div>';
            } else {
				echo '<div class="paginacion">
						<a href="Art_Modificar_01.php?page='.$i.'">'.$i.'</a>
					</div>';
            }
        }

        if ($page != $total_pages) {
			echo '<div class="paginacion">
					<a href="Art_Modificar_01.php?page='.($page+1).'">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</div>';
			}
		}

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
		require '../Gch.Inclu/Master_Index_Artic_Var.php';
		require '../Gch.Inclu/Master_Index_Total.php';
		
		} 

/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $db;
	global $rowout;
	global $nombre;
	global $apellido;
	global $orden;
	
	$orden = isset($_POST['Orden']);
	
	if (isset($_POST['todo'])){$nombre = "TODOS LOS USUARIOS ".$orden;};	

	$rf = isset($_POST['ref']);
	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){	
										$nombre = $_SESSION['Nombre'];
										$apellido = $_SESSION['Apellidos'];}
	
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Gch.Log";
	
	global $text;
	$text = PHP_EOL."- ADMIN VER ".$ActionTime.PHP_EOL."\t Filtro => ".$nombre." ".$apellido;

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gch.Inclu/Admin_Inclu_02.php';
		
/* Creado por Juan Barros Pazos 2019 */
