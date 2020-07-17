<?php
session_start();

  	//require '../Gcb.Inclu/error_hidden.php';
	require '../Gcb.Inclu/Admin_Inclu_01b.php';
	require '../Gcb.Inclu/mydni.php';

	require '../Gcb.Connet/conection.php';
	require '../Gcb.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ 

	master_index();

	/*	*/
	if((isset($_POST['oculto']))||(isset($_POST['oculto1']))||(isset($_GET['pageb']))){
												show_form();
												process_form();
											}	

	elseif((isset($_POST['modera']))||(isset($_GET['pagem']))){ 
												cancel_volver();
												ver_modera();
											}	

	elseif(isset($_POST['opinaborra'])){ cancel_volver();
										 opina_borra();
										 ver_modera();
					global $redir;
					 $redir = "<script type='text/javascript'>
									function redir(){
								window.location.href='Opina_Modificar_01.php?pagem=1';
									}
								 setTimeout('redir()',4000);
								</script>";
					print ($redir);
										}	

	elseif(isset($_POST['opinaborra2'])){ cancel_volver();
										  opina_borra();
										global $redir;
					 $redir = "<script type='text/javascript'>
									function redir(){
								window.location.href='Opina_Modificar_01.php?pagedel=1';
									}
								 setTimeout('redir()',4000);
								</script>";
					print ($redir);

										}	

	elseif((isset($_POST['veropinaborra']))||(isset($_GET['pagedel']))){ 
										 cancel_volver();
										 ver_del_opiniones();
										}	

	elseif(isset($_POST['opinamodera'])){ cancel_volver();
										  opina_modera();
									 	  //ver_modera();
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

} else { require '../Gcb.Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function ver_del_opiniones(){

		global $db;
		global $db_name;
		
		if(isset($_POST['veropinaborra'])){
						$_SESSION['titopina'] =	$_POST['tit'];
						$_SESSION['islaopina'] = $_POST['isla'];
						$_SESSION['aytoopina'] = $_POST['ayto'];
						$_SESSION['refopina'] = $_POST['refart'];
		}else{}

		global $opirefart;
		$opirefart = $_SESSION['refopina'];
	
		require 'Inclu_Name_Ref_to_Name.php';

		global $vname;
		$vname = "gcb_opiniones";
		$vname = "`".$vname."`";
	
		$result =  "SELECT * FROM $vname WHERE `refart` = '$opirefart' AND `modera` = 'y' ";
		$q = mysqli_query($db, $result);
		$row = mysqli_fetch_assoc($q);
		$num_total_rows = mysqli_num_rows($q);
		
		// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
		global $nitem;
		$nitem = 4;
		
		global $pagedel;
	
		//examino la pagina a mostrar y el inicio del registro a mostrar
		if (isset($_GET["pagedel"])) {
			global $pagedel;
			$pagedel = $_GET["pagedel"];
		}
	
		if (!$pagedel) {
			global $pagedel;
			$start = 0;
			$pagedel = 1;
		} else {
			$start = ($pagedel - 1) * $nitem;
		}
		
		//calculo el total de paginas
		$total_pages = ceil($num_total_rows / $nitem);
		
		// CALCULO CUANTOS RESUSTALDOS DEL TOTAL EN LA PAGINACIÓN
		global $nres;
		$nres = $pagedel * $nitem;
		if($nres < $num_total_rows){ 
									 $nres = $nres;}
		else{ $nres = $num_total_rows;}
	
		//pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
		echo '<h7>* Opiniones: '.$nres.' de '.$num_total_rows.' * P&aacute;gina '.$pagedel.' de ' .$total_pages.'.</h7>';
	
	
		global $limit;
		$limit = " LIMIT ".$start.", ".$nitem;
	
		$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `refart` = '$opirefart' AND `modera` = 'y'  ORDER BY `id` ASC $limit";
	
		/*
		$sqlb =  "SELECT * FROM `gcb_admin` WHERE `gcb_admin`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
		*/
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
										
					} else { 	print ("<table align='center'>
									<tr>
										<th colspan=6 class='BorderInf'>
							OPINIONES MODERADAS: ".$nres." de ".$num_total_rows."
										</th>
									</tr>
									<tr>
										<th colspan=6 class='BorderInf'>
							RESTAURANTE: ".$_SESSION['titopina']."
										</th>
									</tr>
									<tr>
										<th colspan=6 class='BorderInf'>
							".$_SESSION['islaopina']." :: ".$_SESSION['aytoopina']."
										</th>
									</tr>

									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											VALOR
										</th>
																				
										<th class='BorderInfDch'>
											PUNTOS
										</th>
																				
										<th width=260px  class='BorderInfDch'>
											OPINIÓN
										</th>

										<th colspan=2 class='BorderInf'>
										</th>
									</tr>");
				
		while($rowb = mysqli_fetch_assoc($qb)){
					
		print (	"<tr align='center'>
								
							<td class='BorderInfDch'>
									".$rowb['id']."
							</td>
	
							<td class='BorderInfDch'>
									".$rowb['datein']."
							</td>
	
							<td class='BorderInfDch'>
									".$rowb['valora']." de 5
							</td>
	
							<td class='BorderInfDch' align='left'>
									".$rowb['opina']."
							</td>
	
							<td class='BorderInfDch' align='center'>
								<form name='fopinaborra2' action='$_SERVER[PHP_SELF]' method='POST'>
									<input type='hidden' name='id' value='".$rowb['id']."' />
									<input type='submit' value='BORRAR' />
									<input type='hidden' name='opinaborra2' value=1 />
								</form>
							</td>

				<td class='BorderInf' align='center'>
					<form name='fopinamodif' action='Opina_Modificar_02.php' method='POST'>
						<input name='id' type='hidden' value='".$rowb['id']."' />
						<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
						<input name='refart' type='hidden' value='".$rowb['refart']."' />
						<input name='isla' type='hidden' value='".$rowb['refisla']."' />
						<input name='ayto' type='hidden' value='".$rowb['refayto']."' />
						<input name='valora' type='hidden' value='".$rowb['valora']."' />
						<input name='opina' type='hidden' value='".$rowb['opina']."' />

						<input type='submit' value='MODIFICAR' />
						<input type='hidden' name='opinamodif' value=1 />
					</form>
				</td>
			</tr>");
					}
	
		print("</table>");
							} 
				} 
	
		if ($total_pages > 1) {
			if ($pagedel != 1) {
				echo '<div class="paginacion">
						<a href="Opina_Modificar_01.php?pagedel='.($pagedel-1).'">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</div>';
			}
	
			for ($i=1;$i<=$total_pages;$i++) {
				if ($pagedel== $i) {
					echo '<div class="paginacion">
							<a href="#">'.$pagedel.'</a>
						</div>';
				} else {
					echo '<div class="paginacion">
							<a href="Opina_Modificar_01.php?pagedel='.$i.'">'.$i.'</a>
						</div>';
				}
			}
	
			if ($pagedel != $total_pages) {
				echo '<div class="paginacion">
						<a href="Opina_Modificar_01.php?pagedel='.($pagedel+1).'">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</div>';
				}
			}
	
		}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////
	
function opina_modera(){

	global $db;
	global $db_name;

	global $refmodera;
	$refmodera = $_POST['id'];
	global $tablename;
	$tablename = "gcb_opiniones";
	$tablename = "`".$tablename."`";

	//$sqld = "DELETE FROM `$db_name`.$tablename WHERE $tablename.`id` = '$refmodera' LIMIT 1 ";

	$sqld = "UPDATE `$db_name`.$tablename SET `modera` = 'y' WHERE $tablename.`id` = '$refmodera' LIMIT 1 ";

	if(mysqli_query($db, $sqld)){

	print("<table align='center' style=\"margin-top:10px\">
		<tr>
			<th colspan=3 class='BorderInf'>
						HA PERMITIDO LA OPINION ID ".strtoupper($refmodera)."
			</th>
		</tr>");
		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='Opina_Modificar_01.php?pagem=1';
					}
					setTimeout('redir()',4000);
					</script>";
		print ($redir);


	} else {print("* MODIFIQUE LA ENTRADA L.79: ".mysqli_error($db));
		show_form ();
		}

}

function opina_borra(){

	global $db;
	global $db_name;

	global $refdel;
	$refdel = $_POST['id'];
	global $tablename;
	$tablename = "gcb_opiniones";
	$tablename = "`".$tablename."`";

	$sqld = "DELETE FROM `$db_name`.$tablename WHERE $tablename.`id` = '$refdel' LIMIT 1 ";

	if(mysqli_query($db, $sqld)){

	print("<table align='center' style=\"margin-top:10px\">
		<tr>
			<th colspan=3 class='BorderInf'>
						HA BORRADO LA OPINION ID ".strtoupper($refdel)."
			</th>
		</tr>");
	} else {print("* MODIFIQUE LA ENTRADA L.116: ".mysqli_error($db));
		show_form ();
		}

}

function cancel_volver(){

		global $titulo;

		if((isset($_POST['veropinaborra']))||(isset($_GET['pagedel']))){

						$titulo = "OPINIONES MODERADAS";
		}
		else {
					$titulo = "OPINIONES SIN MODRERAR";
				}

		print ("<table align='center' style=\"border:0px;margin-top:4px;width:auto\">
		<tr>
			<th width=100% class='BorderInf BorderSup'>
				".$titulo."
			</th>
		</tr>
		<tr>
			<td colspan=3 align='right' class='BorderSup BorderInf'>
				<form name='fvolver' action='Opina_Modificar_01.php'  \">
					<input type='submit' value='CANCELAR Y VOLVER INICIO OPINIONES' />
					<input type='hidden' name='volver' value=1 />
				</form>
			</td>
		</tr>
	</table>");
}

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
	$vname = "gcb_art";
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
	$nitem = 3;
	
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
									
		} else { 	print ("<table align='center'>
									<tr>
										<th colspan=5 class='BorderInf'>
					Restaurantes Filtro: ".$nres." de ".$num_total_rows."
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											Nombre
										</th>
										
										<th class='BorderInfDch'>
											Isla
										</th>
																				
										<th class='BorderInfDch'>
											Ayuntamiento
										</th>

										<th class='BorderInfDch'>
											Clase
										</th>

										<th class='BorderInfDch'>
											Imagen
										</th>
									</tr>");
			
	while($rowb = mysqli_fetch_assoc($qb)){
				global $conte;
				$conte = substr($rowb['conte'],0,56);
				$conte = $conte." ...";	

	require 'Inclu_Name_Ref_to_Name.php';
				
	print (	"<tr align='center'>
									

						<td class='BorderInfDch'>
	<input name='tit' type='hidden' value='".$rowb['tit']."' />".$rowb['tit']."
						</td>

						<td class='BorderInfDch'>
	<input name='isla' type='hidden' value='".$rowb['refisla']."' />".$rowb['refisla']." / ".$islaname."
						</td>

						<td class='BorderInfDch'>
	<input name='ayto' type='hidden' value='".$rowb['refayto']."' />".$rowb['refayto']." / ".$aytoname."
						</td>

						<td class='BorderInfDch' align='left'>
	<input name='conte' type='hidden' value='".$rowb['reftipo']."' />".$rowb['reftipo']." / ".$tipname."
						</td>

						<td class='BorderInf' width='50px'>
	<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
	<img src='../Gcb.Img.Art/".$rowb['myimg']."'  width='60%' height='auto' />
						</td>
		</tr>

		<tr>
			<td colspan=3 align='right' class='BorderInfDch'>
				<form name='creaopina' action='Opina_Crear.php' method='POST'>
					<input name='id' type='hidden' value='".$rowb['id']."' />
					<input name='refart' type='hidden' value='".$rowb['refart']."' />
					<input name='tit' type='hidden' value='".$rowb['tit']."' />
					<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
					<input name='isla' type='hidden' value='".$rowb['refisla']."' />
					<input name='ayto' type='hidden' value='".$rowb['refayto']."' />
					<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
					<input type='submit' value='CREAR OPINION' />
					<input type='hidden' name='oculto2' value=1 />
				</form>
			</td>

			<td colspan=2 align='center' class='BorderInf'>
						
				<form name='fveropinaborra' action='$_SERVER[PHP_SELF]' method='POST'>
					<input name='refart' type='hidden' value='".$rowb['refart']."' />
					<input name='tit' type='hidden' value='".$rowb['tit']."' />
					<input name='isla' type='hidden' value='".$rowb['refisla']." / ".$islaname."' />
					<input name='ayto' type='hidden' value='".$rowb['refayto']." / ".$aytoname."' />
					<input type='submit' value='BORRAR MODIFICAR OPINIONES' />
					<input type='hidden' name='veropinaborra' value=1 />
				</form>
			</td>	
		</tr>");
					}

		print("	<tr>
					<td colspan=5 align='right' class='BorderSup BorderInf'>
						<form name='fvolver' action='Opina_Modificar_01.php' \">
							<input type='submit' value='CANCELAR Y VOLVER INICIO OPINIONES' />
							<input type='hidden' name='volver' value=1 />
						</form>
					</td>
				</tr>
		
		</table>");
		
			} 
		} 

		    if ($total_pages > 1) {
        if ($pageb != 1) {
			echo '<div class="paginacion">
					<a href="Opina_Modificar_01.php?pageb='.($pageb-1).'">
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
						<a href="Opina_Modificar_01.php?pageb='.$i.'">'.$i.'</a>
					</div>';
            }
        }

        if ($pageb != $total_pages) {
			echo '<div class="paginacion">
					<a href="Opina_Modificar_01.php?pageb='.($pageb+1).'">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</div>';
			}
		}

	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){
	
	global $titulo;
	$titulo = "OPINIONES VALORACIONES";

	require 'Inc_Show_Form_Opina.php';
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;
	
	global $vname;
	$vname = "gcb_art";
	$vname = "`".$vname."`";

	$result =  "SELECT * FROM $vname";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 3;
	
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

	$sqlb =  "SELECT * FROM `$db_name`.$vname  ORDER BY `refart` ASC $limit";

	/*
	$sqlb =  "SELECT * FROM `gcb_admin` WHERE `gcb_admin`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
	*/
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
									
				} else { 	print ("<table align='center'>
									<tr>
										<th colspan=5 class='BorderInf'>
					Restaurantes Todos: ".$nres." de ".$num_total_rows."
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											Nombre
										</th>
										
										<th class='BorderInfDch'>
											Isla
										</th>
																				
										<th class='BorderInfDch'>
											Ayuntamiento
										</th>

										<th class='BorderInfDch'>
											Clase
										</th>

										<th class='BorderInfDch'>
											Imagen
										</th>
									</tr>");
			
			
	while($rowb = mysqli_fetch_assoc($qb)){
				global $conte;
				$conte = substr($rowb['conte'],0,70);
				$conte = $conte." ...";	
				
	require 'Inclu_Name_Ref_to_Name.php';

	print (	"<tr align='center'>
									

						<td class='BorderInfDch'>
	<input name='tit' type='hidden' value='".$rowb['tit']."' />".$rowb['tit']."
						</td>

						<td class='BorderInfDch'>
	<input name='isla' type='hidden' value='".$rowb['refisla']."' />".$rowb['refisla']." / ".$islaname."
						</td>

						<td class='BorderInfDch'>
	<input name='ayto' type='hidden' value='".$rowb['refayto']."' />".$rowb['refayto']." / ".$aytoname."
						</td>

						<td class='BorderInfDch' align='left'>
	<input name='conte' type='hidden' value='".$rowb['reftipo']."' />".$rowb['reftipo']." / ".$tipname."
						</td>

						<td class='BorderInf' width='50px'>
	<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
	<img src='../Gcb.Img.Art/".$rowb['myimg']."'  width='60%' height='auto' />
						</td>
		</tr>

		<tr>
			<td colspan=3 align='right' class='BorderInfDch'>
				<form name='creaopina' action='Opina_Crear.php' method='POST'>
					<input name='id' type='hidden' value='".$rowb['id']."' />
					<input name='refart' type='hidden' value='".$rowb['refart']."' />
					<input name='tit' type='hidden' value='".$rowb['tit']."' />
					<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
					<input name='isla' type='hidden' value='".$rowb['refisla']."' />
					<input name='ayto' type='hidden' value='".$rowb['refayto']."' />
					<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
					<input type='submit' value='CREAR OPINION' />
					<input type='hidden' name='oculto2' value=1 />
				</form>
			</td>

			<td colspan=2 align='center' class='BorderInf'>
						
				<form name='fveropinaborra' action='$_SERVER[PHP_SELF]' method='POST'>
					<input name='refart' type='hidden' value='".$rowb['refart']."' />
					<input name='tit' type='hidden' value='".$rowb['tit']."' />
					<input name='isla' type='hidden' value='".$rowb['refisla']." / ".$islaname."' />
					<input name='ayto' type='hidden' value='".$rowb['refayto']." / ".$aytoname."' />
					<input type='submit' value='BORRAR MODIFICAR OPINIONES' />
					<input type='hidden' name='veropinaborra' value=1 />
				</form>
			</td>	
		</tr>");
					}

	print("</table>");
						} 
			} 

    if ($total_pages > 1) {
        if ($page != 1) {
			echo '<div class="paginacion">
					<a href="Opina_Modificar_01.php?page='.($page-1).'">
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
						<a href="Opina_Modificar_01.php?page='.$i.'">'.$i.'</a>
					</div>';
            }
        }

        if ($page != $total_pages) {
			echo '<div class="paginacion">
					<a href="Opina_Modificar_01.php?page='.($page+1).'">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</div>';
			}
		}

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_modera(){
		
	global $db;
	global $db_name;
	
	global $vname;
	$vname = "gcb_opiniones";
	$vname = "`".$vname."`";

	$result =  "SELECT * FROM $vname WHERE `modera` = 'n'";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 3;
	
	global $pagem;

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["pagem"])) {
		global $pagem;
        $pagem = $_GET["pagem"];
    }

    if (!$pagem) {
		global $pagem;
        $start = 0;
        $pagem = 1;
    } else {
        $start = ($pagem - 1) * $nitem;
    }
    
    //calculo el total de paginas
	$total_pages = ceil($num_total_rows / $nitem);
	
	// CALCULO CUANTOS RESUSTALDOS DEL TOTAL EN LA PAGINACIÓN
	global $nres;
	$nres = $pagem * $nitem;
	if($nres < $num_total_rows){ 
								 $nres = $nres;}
	else{ $nres = $num_total_rows;}

    //pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
    echo '<h7>* Restaurantes: '.$nres.' de '.$num_total_rows.' * P&aacute;gina '.$pagem.' de ' .$total_pages.'.</h7>';


	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `modera` = 'n'  ORDER BY `id` ASC $limit";

	/*
	$sqlb =  "SELECT * FROM `gcb_admin` WHERE `gcb_admin`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
	*/
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
									
				} else { 	print ("<table align='center'>
									<tr>
										<th colspan=7 class='BorderInf'>
							OPINIONES SIN MODERAR: ".$nres." de ".$num_total_rows."
										</th>
									</tr>

									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											FECHA
										</th>
										
										<th class='BorderInfDch'>
											VALOR
										</th>
																				
										<th width=260px  class='BorderInfDch'>
											OPINIÓN
										</th>

										<th colspan=2 class='BorderInf'>
										</th>
									</tr>");
			
	while($rowb = mysqli_fetch_assoc($qb)){
				
	require 'Inclu_Name_Ref_to_Name.php';

	print (	"<tr align='center'>
							
						<td class='BorderInfDch'>
								".$rowb['id']."
						</td>

						<td class='BorderInfDch'>
								".$rowb['datein']."
						</td>

						<td class='BorderInfDch'>
								".$rowb['valora']." de 5
						</td>

						<td class='BorderInfDch' align='left'>
								".$rowb['opina']."
						</td>

						<td class='BorderInfDch' align='center'>
						<form name='fopinaMmodera' action='$_SERVER[PHP_SELF]' method='POST'>
							<input type='hidden' name='id' value='".$rowb['id']."' />
							<input type='submit' value='PERMITIR' />
							<input type='hidden' name='opinamodera' value=1 />
						</form>
						</td>

						<td class='BorderInf' align='center'>
							<form name='fopinaborra' action='$_SERVER[PHP_SELF]' method='POST'>
								<input type='hidden' name='id' value='".$rowb['id']."' />
								<input type='submit' value='BORRAR' />
								<input type='hidden' name='opinaborra' value=1 />
							</form>
						</td>
			</tr>");
					}

	print("</table>");
						} 
			} 

    if ($total_pages > 1) {
        if ($pagem != 1) {
			echo '<div class="paginacion">
					<a href="Opina_Modificar_01.php?pagem='.($pagem-1).'">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</div>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($pagem == $i) {
				echo '<div class="paginacion">
						<a href="#">'.$pagem.'</a>
					</div>';
            } else {
				echo '<div class="paginacion">
						<a href="Opina_Modificar_01.php?pagem='.$i.'">'.$i.'</a>
					</div>';
            }
        }

        if ($pagem != $total_pages) {
			echo '<div class="paginacion">
					<a href="Opina_Modificar_01.php?pagem='.($pagem+1).'">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</div>';
			}
		}

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

	function master_index(){
		
				require '../Gcb.Inclu/Master_Index_Syst.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gcb.Inclu/Admin_Inclu_02.php';
		
/* Creado por Juan Barros Pazos 2019 */
