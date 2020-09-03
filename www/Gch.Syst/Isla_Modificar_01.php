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

	if(isset($_POST['islaborra'])){ cancel_volver();
									conf_isla_borra();
										}

	elseif(isset($_POST['confislaborra'])){ cancel_volver();
											isla_borra();
											show_form();
											ver_todo();
					global $redir;
					 $redir = "<script type='text/javascript'>
									function redir(){
								window.location.href='Isla_Modificar_01.php?pagem=1';
									}
								 setTimeout('redir()',4000);
								</script>";
					print ($redir);
										}	

	elseif (isset($_GET['page'])) { show_form();
									ver_todo(); 
										}

	else {	unset($_SESSION['isla']);
			unset($_SESSION['refisla']);
			unset($_SESSION['islaid']);
 			show_form();
			ver_todo();}

} else { require '../Gch.Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function conf_isla_borra(){

	global $refid;
	$refid = $_POST['id'];
	global $refisla;
	$refisla = $_POST['refisla'];

	require 'Inclu_Name_Ref_to_Name.php';

	print("
	<table align='center' style=\"border:0px;margin-top:4px;width:auto\">
			<tr>
				<th>
					ISLA: ".$refisla." / ".$islaname." ID: ".$refid."
				</th>
			</tr>
		   <tr>
			<td align='center' class='BorderInf'>
				<form name='fconfaytoborra' action='$_SERVER[PHP_SELF]' method='POST'>
					<input type='hidden' name='id' value='".$refid."' />
					<input type='hidden' name='refisla' value='".$refisla."' />
					<input type='submit' value='CONFIRMAR EL BORRADO DE TODOS LOS DATOS RELACIONADOS' />
					<input type='hidden' name='confislaborra' value=1 />
				</form>
			</td>
		</tr>");

	global $db;
	global $db_name;
	global $vname;
	$vname = "gch_art";
	$sqlb =  "SELECT * FROM `$db_name`.`$vname` WHERE `refisla` = '$refisla'";

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
						ARTICULOS BORRADO DATOS ISLA <br> Y TODOS SUS AYUNTAMIENTOS
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

function isla_borra(){

	global $db;
	global $db_name;

	require 'Inclu_Name_Ref_to_Name.php';

	global $refisla;
	$refisla = $_POST['refisla'];
	global $refdel;
	$refdel = $_POST['id'];
	global $tablename;
	$tablename = "gch_islas";
	$tablename = "`".$tablename."`";

	$sqld = "DELETE FROM `$db_name`.$tablename WHERE $tablename.`id` = '$refdel' LIMIT 1 ";

	if(mysqli_query($db, $sqld)){

	print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<th>
						ISLA: ".$refisla." / ".$islaname."
					</th>
				</tr>");

		// BORRO LAS IMAGENES DE LOS ARTICULOS
		global $db;
		global $db_name;
		global $vname;
		$vname = "gch_art";
		$sqlb =  "SELECT * FROM `$db_name`.`$vname` WHERE `refisla` = '$refisla'";
		$qb = mysqli_query($db, $sqlb);
		if(!$qb){ print("<font color='#FF0000'>Consulte L.94: </font></br>".mysqli_error($db)."</br>");
		} else { if(mysqli_num_rows($qb)== 0){
				} else { while($rowdi = mysqli_fetch_assoc($qb)){
									unlink("../Gch.Img.Art/".$rowdi['myimg']);
										}
									}
								}

	// BORRO LOS ARTICULOS
	$sqld2 = "DELETE FROM `$db_name`.`gch_art` WHERE `gch_art`.`refisla` = '$refisla' ";
	if(mysqli_query($db, $sqld2)){}
	else {print("NO SE HAN ACTUALIZADO LAS ENTRADAS EN gch_art ".$refisla."* MODIFIQUE LA ENTRADA L.207: ".mysqli_error($db));}

	// BORRO LOS ayuntamientos
	$sqld3 = "DELETE FROM `$db_name`.`gch_aytos` WHERE `gch_aytos`.`refisla` = '$refisla' ";
	if(mysqli_query($db, $sqld3)){}
	else {print("NO SE HAN ACTUALIZADO LAS ENTRADAS EN gch_aytos ".$refisla."* MODIFIQUE LA ENTRADA L.207: ".mysqli_error($db));}

	print("<table align='center' style=\"margin-top:10px\">
		<tr>
			<th colspan=3 class='BorderInf'>
						HA BORRADO LA ISLA ID ".strtoupper($refdel)."
			</th>
		</tr>");
	} else {print("* MODIFIQUE LA ENTRADA L.175: ".mysqli_error($db));
		show_form ();
		}

}

function cancel_volver(){

	print ("<table align='center' style=\"border:0px;margin-top:4px;width:auto\">
	<tr>
		<th width=100% class='BorderInf BorderSup'>
			ISLAS
		</th>
	</tr>
	<tr>
		<td colspan=3 align='right' class='BorderSup BorderInf'>
			<form name='fvolver' action='Isla_Modificar_01.php'  \">
				<input type='submit' value='CANCELAR Y VOLVER INICIO ISLAS' />
				<input type='hidden' name='volver' value=1 />
			</form>
		</td>
	</tr>
</table>");
}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form(){
	
	print("<table align='center' style=\"border:0px;margin-top:4px;width:auto\">
				<tr>
					<th colspan=2 width=100% class='BorderInf BorderSup'>
						ISLAS
					</th>
				</tr>
			</table>");

	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;
	
	global $vname;
	$vname = "gch_islas";
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
    echo '<h7>* ISLAS: '.$nres.' de '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.'.</h7>';


	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `refisla` <> 'otrs'  ORDER BY `isla` ASC $limit";

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
										<th colspan=5 class='BorderInf'>
					ISLAS TODAS: ".$nres." de ".$num_total_rows."
										</th>
									</tr>
									<tr>
										<th colspan=5 class='BorderInf'>
							<form name='creaopina' action='Isla_Crear.php' method='POST'>
								<input type='submit' value='CREAR UNA NUEVA ISLA' />
								<input type='hidden' name='oculto2' value=1 />
							</form>
										</th>
									</tr>
									
									<tr>
										<th colspan=5 class='BorderInf'>
						Al eliminar una isla, esta se modifica
						<br> en gch_art por 'otrs' si existe
										</th>
									</tr>
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											ISLA
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
								".$rowb['isla']."
						</td>

						<td class='BorderInfDch'>
								".$rowb['refisla']."
						</td>

			<td align='center' class='BorderInfDch'>
				<form name='fislaborra2' action='$_SERVER[PHP_SELF]' method='POST'>
					<input type='hidden' name='id' value='".$rowb['id']."' />
					<input type='hidden' name='refisla' value='".$rowb['refisla']."' />
					<input type='submit' value='BORRAR' />
					<input type='hidden' name='islaborra' value=1 />
				</form>
			</td>	
			
			<td align='center' class='BorderInf'>
				<form name='fislamodif' action='Isla_Modificar_02.php' method='POST'>
					<input type='hidden' name='id' value='".$rowb['id']."' />
					<input type='hidden' name='isla' value='".$rowb['isla']."' />
					<input type='hidden' name='refisla' value='".$rowb['refisla']."' />
					<input type='submit' value='MODIFICAR' />
					<input type='hidden' name='islamodif' value=1 />
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
					<a href="Isla_Modificar_01.php?page='.($page-1).'">
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
						<a href="Isla_Modificar_01.php?page='.$i.'">'.$i.'</a>
					</div>';
            }
        }

        if ($page != $total_pages) {
			echo '<div class="paginacion">
					<a href="Isla_Modificar_01.php?page='.($page+1).'">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</div>';
			}
		}

	}

/////////////////////////////////////////////////////////////////////////////////////////////////

	function master_index(){

		require '../Gch.Inclu/Master_Index_Syst_Var.php';
		require '../Gch.Inclu/Master_Index_Total.php';
		
				} 

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gch.Inclu/Admin_Inclu_02.php';
		
/* Creado por Juan Barros Pazos 2019 */
