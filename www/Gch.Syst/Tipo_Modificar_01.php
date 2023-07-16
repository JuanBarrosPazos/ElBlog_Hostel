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

	if(isset($_POST['tipoborra'])){ cancel_volver();
									tipo_borra();
									ver_todo();
		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
					window.location.href='Tipo_Modificar_01.php?pagem=1';
						}
				 setTimeout('redir()',4000);
					</script>";
		print ($redir);
						}	

	elseif (isset($_GET['page'])) { show_form();
									ver_todo(); 
										}

	else {	unset($_SESSION['tipo']);
			unset($_SESSION['reftipo']);
			unset($_SESSION['tipoid']);
 			//show_form();
			ver_todo();}

} else { require '../Gch.Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function tipo_borra(){

	global $db;
	global $db_name;

	global $refdel;
	$refdel = $_POST['id'];
	global $tablename;
	$tablename = "gch_tipologia";
	$tablename = "`".$tablename."`";

	$sqld = "DELETE FROM `$db_name`.$tablename WHERE $tablename.`id` = '$refdel' LIMIT 1 ";

	if(mysqli_query($db, $sqld)){

	$sqld2 = "UPDATE `$db_name`.`gch_art` SET `reftipo` = 'otrs' WHERE `gch_art`.`reftipo` = '$_POST[reftipo]' ";
	if(mysqli_query($db, $sqld2)){}
	else {print("NO SE HAN ACTUALIZADO LAS ENTRADAS EN gch_art ".$_POST['reftipo']."* MODIFIQUE LA ENTRADA L.61: ".mysqli_error($db));}

	print("<table align='center' style=\"margin-top:10px\">
		<tr>
			<th colspan=3 class='BorderInf'>
						HA BORRADO LA TIPOLOGÍA ID ".strtoupper($refdel)."
			</th>
		</tr>");
	} else {print("* MODIFIQUE LA ENTRADA L.57: ".mysqli_error($db));
		show_form ();
		}

}

function cancel_volver(){

	print ("<table align='center' style=\"border:0px;margin-top:4px;width:auto\">
	<tr>
		<th width=100% class='BorderInf BorderSup'>
			TIPOLOGÍAS
		</th>
	</tr>
	<tr>
		<td colspan=3 align='right' class='BorderSup BorderInf'>
			<form name='fvolver' action='Tipo_Modificar_01.php'  \">
				<input type='submit' value='CANCELAR Y VOLVER INICIO TIPOLOGIAS' />
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
						TIPOLOGIAS DE LOCALES
					</th>
				</tr>
			</table>");

	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;
	
	global $vname;
	$vname = "gch_tipologia";
	$vname = "`".$vname."`";

	$result =  "SELECT * FROM $vname WHERE `reftipo` <> 'otrs'";
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
    echo '<h7>* TIPOLOGIAS: '.$nres.' de '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.'.</h7>';


	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `reftipo` <> 'otrs'  ORDER BY `tipo` ASC $limit";

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
					TIPOLOGIAS TODAS: ".$nres." de ".$num_total_rows."
										</th>
									</tr>
									<tr>
										<th colspan=5 class='BorderInf'>
							<form name='creaopina' action='Tipo_Crear.php' method='POST'>
								<input type='submit' value='CREAR UNA NUEVA TIPOLOGÍA DE LOCAL' />
								<input type='hidden' name='oculto2' value=1 />
							</form>
										</th>
									</tr>
									
									<tr>
										<th colspan=5 class='BorderInf'>
						Al eliminar una tipología, esta se modifica
						<br> en gch_art por 'otrs' si existe
										</th>
									</tr>
									<tr>
										<th class='BorderInfDch'>
											ID
										</th>
										
										<th class='BorderInfDch'>
											TIPO
										</th>
																				
										<th class='BorderInfDch'>
											REF TIPO
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
								".$rowb['tipo']."
						</td>

						<td class='BorderInfDch'>
								".$rowb['reftipo']."
						</td>

			<td align='center' class='BorderInfDch'>
				<form name='ftipoborra2' action='$_SERVER[PHP_SELF]' method='POST'>
					<input type='hidden' name='id' value='".$rowb['id']."' />
					<input type='hidden' name='reftipo' value='".$rowb['reftipo']."' />
					<input type='submit' value='BORRAR' />
					<input type='hidden' name='tipoborra' value=1 />
				</form>
			</td>	
			
			<td align='center' class='BorderInf'>
				<form name='ftipomodif' action='Tipo_Modificar_02.php' method='POST'>
					<input type='hidden' name='id' value='".$rowb['id']."' />
					<input type='hidden' name='tipo' value='".$rowb['tipo']."' />
					<input type='hidden' name='reftipo' value='".$rowb['reftipo']."' />
					<input type='submit' value='MODIFICAR' />
					<input type='hidden' name='tipomodif' value=1 />
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
					<a href="Tipo_Modificar_01.php?page='.($page-1).'">
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
						<a href="Tipo_Modificar_01.php?page='.$i.'">'.$i.'</a>
					</div>';
            }
        }

        if ($page != $total_pages) {
			echo '<div class="paginacion">
					<a href="Tipo_Modificar_01.php?page='.($page+1).'">
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
		
/* Creado por Juan Manuel Barros Pazos 2020/21 */
