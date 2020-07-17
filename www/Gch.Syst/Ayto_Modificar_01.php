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
	if((strlen(trim(@$_POST['isla'])) != 0) || (isset($_POST['volver']))){ 
											show_form();
											process_form();
												}

	elseif (isset($_GET['pagei'])) { show_form();
									 process_form(); 
										}

	elseif(isset($_POST['aytoborra'])){ cancel_volver();
										conf_ayto_borra();
										}

	elseif(isset($_POST['confaytoborra'])){ cancel_volver();
											ayto_borra();
											show_form();
											ver_todo();
					global $redir;
					 $redir = "<script type='text/javascript'>
									function redir(){
								window.location.href='Ayto_Modificar_01.php?pagem=1';
									}
								 setTimeout('redir()',4000);
								</script>";
					print ($redir);
										}	

	elseif (isset($_GET['page'])) { show_form();
									ver_todo(); 
										}

	else {	unset($_SESSION['ayto']);
			unset($_SESSION['refayto']);
			unset($_SESSION['aytoid']);
			unset($_SESSION['isla']);
			show_form();
			ver_todo();}

} else { require '../Gch.Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function conf_ayto_borra(){

	global $refid;
	$refid = $_POST['id'];
	global $refayto;
	$refayto = $_POST['refayto'];
	global $ayto;
	$ayto = $_POST['ayto'];
	global $refisla;
	$refisla = $_POST['refisla'];

	print("
	<table align='center' style=\"border:0px;margin-top:4px;width:auto\">
			<tr>
				<th>
					AYUNTAMIENTO: ".$ayto." / ".$refayto." / ".$refisla."
				</th>
			</tr>
		   <tr>
			<td align='center' class='BorderInf'>
				<form name='fconfaytoborra' action='$_SERVER[PHP_SELF]' method='POST'>
					<input type='hidden' name='id' value='".$refid."' />
					<input type='hidden' name='refayto' value='".$refayto."' />
					<input type='hidden' name='ayto' value='".$ayto."' />
					<input type='hidden' name='refisla' value='".$refisla."' />
					<input type='submit' value='CONFIRMAR EL BORRADO DE TODOS LOS DATOS RELACIONADOS' />
					<input type='hidden' name='confaytoborra' value=1 />
				</form>
			</td>
		</tr>");

	global $db;
	global $db_name;
	global $vname;
	$vname = "gch_art";
	$sqlb =  "SELECT * FROM `$db_name`.`$vname` WHERE `refayto` = '$refayto'";

	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("<font color='#FF0000'>Consulte L.94: </font></br>".mysqli_error($db)."</br>");
			
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
										<th colspan=4 class='BorderInf'>
						ARTICULOS BORRADO DATOS AYUNTAMIENTO
										</th>
									</tr>
									
									<tr>
										<th colspan=4 class='BorderInf'>
						NO SE PODRÁN RECUPERAR
										</th>
									</tr>
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											REF ARTICULO
										</th>
																				
										<th class='BorderInfDch'>
											REF ISLA
										</th>

										<th class='BorderInfDch'>
											REF AYTO
										</th>

									</tr>");
			
	while($rowb = mysqli_fetch_assoc($qb)){
				
				print (	"<tr align='center'>
									<td class='BorderInfDch'>
											".$rowb['id']."
									</td>

									<td class='BorderInfDch'>
											".$rowb['refart']."
									</td>

									<td class='BorderInfDch'>
											".$rowb['refisla']."
									</td>

									<td class='BorderInfDch'>
											".$rowb['refayto']."
									</td>
					</tr>");
								}

							}
						}
		

	print("</table>");

} // FIN FUNCTION CONF_AYTO_BORRA

function ayto_borra(){

	global $db;
	global $db_name;

	global $refisla;
	$refisla = $_POST['refisla'];
	global $ayto;
	$ayto = $_POST['ayto'];
	global $refayto;
	$refayto = $_POST['refayto'];

	global $refdel;
	$refdel = $_POST['id'];
	global $tablename;
	$tablename = "gch_aytos";
	$tablename = "`".$tablename."`";

	$sqld = "DELETE FROM `$db_name`.$tablename WHERE $tablename.`id` = '$refdel' LIMIT 1 ";

	if(mysqli_query($db, $sqld)){

	print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<th>
						AYUNTAMIENTO: ".$_POST['ayto']." / ".$_POST['refayto']." / ".$_POST['refisla']."
					</th>
				</tr>
				<tr>
					<th colspan=3 class='BorderInf'>
								HA BORRADO EL AYUNTAMIENTO ID ".strtoupper($refdel)."
					</th>
				</tr>");

		// BORRO LAS IMAGENES DE LOS ARTICULOS
		global $db;
		global $db_name;
		global $vname;
		$vname = "gch_art";
		$sqlb =  "SELECT * FROM `$db_name`.`$vname` WHERE `refayto` = '$refayto'";
		$qb = mysqli_query($db, $sqlb);
		if(!$qb){ print("<font color='#FF0000'>Consulte L.94: </font></br>".mysqli_error($db)."</br>");
		} else { if(mysqli_num_rows($qb)== 0){
				} else { while($rowdi = mysqli_fetch_assoc($qb)){
									unlink("../Gch.Img.Art/".$rowdi['myimg']);
										}
									}
								}

	// BORRO LOS ARTICULOS
	$sqld2 = "DELETE FROM `$db_name`.`gch_art` WHERE `gch_art`.`refayto` = '$_POST[refayto]' ";
	if(mysqli_query($db, $sqld2)){}
	else {print("NO SE HAN BORRADO LOS DATOS EN gch_art ".$_POST['refayto']."* MODIFIQUE LA ENTRADA L.108: ".mysqli_error($db));}

	} else {print("* MODIFIQUE LA ENTRADA L.104: ".mysqli_error($db));
		show_form ();
		}

} // FIN FUCNTION BORRO LOS ARTICULOS

function cancel_volver(){

	print ("<table align='center' style=\"border:0px;margin-top:4px;width:auto\">
				<tr>
					<th width=100% class='BorderInf BorderSup'>
						AYUNTAMIENTOS
					</th>
				</tr>
				<tr>
					<td colspan=3 align='right' class='BorderSup BorderInf'>
						<form name='fvolver' action='Ayto_Modificar_01.php'  \">
							<input type='submit' value='CANCELAR Y VOLVER INICIO AYUNTAMIENTOS' />
							<input type='hidden' name='volver' value=1 />
						</form>	
					</td>
				</tr>
			</table>");
	}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){
	
	if(isset($_POST['todo'])){ unset($_SESSION['isla']);}

	if(strlen(trim(@$_POST['isla'])) != 0){ $defaults = $_POST;
											$_SESSION['isla'] = $_POST['isla'];
											} 
	else { $defaults = array (  'isla' => @$_SESSION['isla']); }
	
	print("<table align='center' style=\"border:0px;margin-top:4px;width:auto\">
				<tr>
					<th colspan=3 width=100% class='BorderInf BorderSup'>
						AYUNTAMIENTOS
					</th>
				</tr>
				
				<tr>

<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
								
				<td align='right' width=100px class='BorderInf'>
					<input type='submit' value='FILTRAR ISLA' />
					<input type='hidden' name='isla' value=1 />
				</td>
				<td class='BorderInf'>
	
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
						if($rows['refisla'] == @$defaults['isla']){
											print ("selected = 'selected'");
																	}
										print ("> ".$rows['isla']."</option>");
									}
								}  
		print ("</select>
				</td>
					</form>");

	if(isset($_SESSION['isla'])){
			print("<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						<td align='center' width=auto class='BorderInf'>
							<input type='submit' value='VER TODO' />
							<input type='hidden' name='todo' value=1 />
						</td>
					</form>");
			}

	print("	</tr>
				</table>");

	}	
/////////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
		
	global $db;
	global $db_name;
	
	global $vname;
	$vname = "gch_aytos";
	$vname = "`".$vname."`";

	$result =  "SELECT * FROM $vname WHERE `refisla` = '$_SESSION[isla]' ";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 6;
	
	global $pagei;

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["pagei"])) {
		global $pagei;
        $pagei = $_GET["pagei"];
    }

    if (!$pagei) {
		global $pagei;
        $start = 0;
        $pagei = 1;
    } else {
        $start = ($pagei - 1) * $nitem;
    }
    
    //calculo el total de paginas
	$total_pages = ceil($num_total_rows / $nitem);
	
	// CALCULO CUANTOS RESUSTALDOS DEL TOTAL EN LA PAGINACIÓN
	global $nres;
	$nres = $pagei * $nitem;
	if($nres < $num_total_rows){ 
								 $nres = $nres;}
	else{ $nres = $num_total_rows;}

    //pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
    echo '<h7>* AYUNTAMIENTOS: '.$nres.' de '.$num_total_rows.' * P&aacute;gina '.$pagei.' de ' .$total_pages.'.</h7>';


	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `refisla` = '$_SESSION[isla]' AND `refayto` <> 'otrs'  ORDER BY `ayto` ASC $limit";

	/*
	$sqlb =  "SELECT * FROM `gch_admin` WHERE `gch_admin`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
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
					AYUNTAMIENTOS TODOS: ".$nres." de ".$num_total_rows."
										</th>
									</tr>
									<tr>
										<th colspan=6 class='BorderInf'>
							<form name='creaopina' action='Ayto_Crear.php' method='POST'>
								<input type='submit' value='CREAR UNA NUEVO AYUNTAMIENTO' />
								<input type='hidden' name='oculto2' value=1 />
							</form>
										</th>
									</tr>
									
									<tr>
										<th colspan=6 class='BorderInf'>
						Al eliminar un ayuntamiento, se borraran 
						<br>todas las entradas realcionadas en restaurantes
										</th>
									</tr>
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											AYUNTAMIENTO
										</th>
																				
										<th class='BorderInfDch'>
											REF AYTO
										</th>

										<th class='BorderInfDch'>
											REF ISLA
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
								".$rowb['ayto']."
						</td>

						<td class='BorderInfDch'>
								".$rowb['refayto']."
						</td>

						<td class='BorderInfDch'>
								".$rowb['refisla']." / ".$islaname."
						</td>

			<td align='center' class='BorderInfDch'>
				<form name='faytoborra2' action='$_SERVER[PHP_SELF]' method='POST'>
					<input type='hidden' name='id' value='".$rowb['id']."' />
					<input type='hidden' name='ayto' value='".$rowb['ayto']."' />
					<input type='hidden' name='refayto' value='".$rowb['refayto']."' />
					<input type='hidden' name='refisla' value='".$rowb['refisla']."' />
					<input type='submit' value='BORRAR' />
					<input type='hidden' name='aytoborra' value=1 />
				</form>
			</td>	
			
			<td align='center' class='BorderInf'>
				<form name='faytomodif' action='Ayto_Modificar_02.php' method='POST'>
					<input type='hidden' name='id' value='".$rowb['id']."' />
					<input type='hidden' name='ayto' value='".$rowb['ayto']."' />
					<input type='hidden' name='refayto' value='".$rowb['refayto']."' />
					<input type='hidden' name='refisla' value='".$rowb['refisla']."' />
					<input type='submit' value='MODIFICAR' />
					<input type='hidden' name='aytomodif' value=1 />
			</form>
			</td>	
		</tr>");
					}

	print("</table>");
						} 
			} 

    if ($total_pages > 1) {
        if ($pagei != 1) {
			echo '<div class="paginacion">
					<a href="Ayto_Modificar_01.php?pagei='.($pagei-1).'">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</div>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($pagei == $i) {
				echo '<div class="paginacion">
						<a href="#">'.$pagei.'</a>
					</div>';
            } else {
				echo '<div class="paginacion">
						<a href="Ayto_Modificar_01.php?pagei='.$i.'">'.$i.'</a>
					</div>';
            }
        }

        if ($pagei != $total_pages) {
			echo '<div class="paginacion">
					<a href="Ayto_Modificar_01.php?pagei='.($pagei+1).'">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</div>';
			}
		}

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;
	
	global $vname;
	$vname = "gch_aytos";
	$vname = "`".$vname."`";

	$result =  "SELECT * FROM $vname";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	// DEFINO EL NUMERO DE ARTICULOS POR PÁGINA
	global $nitem;
	$nitem = 6;
	
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
    echo '<h7>* AYUNTAMIENTOS: '.$nres.' de '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.'.</h7>';


	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `refayto` <> 'otrs'  ORDER BY `ayto` ASC $limit";

	/*
	$sqlb =  "SELECT * FROM `gch_admin` WHERE `gch_admin`.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";
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
					AYUNTAMIENTOS TODOS: ".$nres." de ".$num_total_rows."
										</th>
									</tr>
									<tr>
										<th colspan=6 class='BorderInf'>
							<form name='creaopina' action='Ayto_Crear.php' method='POST'>
								<input type='submit' value='CREAR UNA NUEVO AYUNTAMIENTO' />
								<input type='hidden' name='oculto2' value=1 />
							</form>
										</th>
									</tr>
									
									<tr>
										<th colspan=6 class='BorderInf'>
						Al eliminar un ayuntamiento, esta se modifica
						<br> en gch_art por 'otrs' si existe
										</th>
									</tr>
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											AYUNTAMIENTO
										</th>
																				
										<th class='BorderInfDch'>
											REF AYTO
										</th>

										<th class='BorderInfDch'>
											REF ISLA
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
								".$rowb['ayto']."
						</td>

						<td class='BorderInfDch'>
								".$rowb['refayto']."
						</td>

						<td class='BorderInfDch'>
								".$rowb['refisla']." / ".$islaname."
						</td>

			<td align='center' class='BorderInfDch'>
				<form name='faytoborra2' action='$_SERVER[PHP_SELF]' method='POST'>
					<input type='hidden' name='id' value='".$rowb['id']."' />
					<input type='hidden' name='ayto' value='".$rowb['ayto']."' />
					<input type='hidden' name='refayto' value='".$rowb['refayto']."' />
					<input type='hidden' name='refisla' value='".$rowb['refisla']."' />
					<input type='submit' value='BORRAR' />
					<input type='hidden' name='aytoborra' value=1 />
				</form>
			</td>	
			
			<td align='center' class='BorderInf'>
				<form name='faytomodif' action='Ayto_Modificar_02.php' method='POST'>
					<input type='hidden' name='id' value='".$rowb['id']."' />
					<input type='hidden' name='ayto' value='".$rowb['ayto']."' />
					<input type='hidden' name='refayto' value='".$rowb['refayto']."' />
					<input type='hidden' name='refisla' value='".$rowb['refisla']."' />
					<input type='submit' value='MODIFICAR' />
					<input type='hidden' name='aytomodif' value=1 />
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
					<a href="Ayto_Modificar_01.php?page='.($page-1).'">
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
						<a href="Ayto_Modificar_01.php?page='.$i.'">'.$i.'</a>
					</div>';
            }
        }

        if ($page != $total_pages) {
			echo '<div class="paginacion">
					<a href="Ayto_Modificar_01.php?page='.($page+1).'">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</div>';
			}
		}

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

	function master_index(){
		
				require '../Gch.Inclu/Master_Index_Syst.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gch.Inclu/Admin_Inclu_02.php';
		
/* Creado por Juan Barros Pazos 2019 */
