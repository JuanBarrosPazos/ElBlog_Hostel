<?php
session_start();

  	//require '../Gch.Inclu/error_hidden.php';
	require 'Inc_Header_Nav_Heado.php';

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

	if (isset($_GET['page'])) { ver_todo(); }

	elseif(isset($_POST['oculto2'])) { 	$_SESSION['refopina'] = $_POST['refart'];
										$_SESSION['titopina'] =	$_POST['tit'];
										$_SESSION['islaopina'] = $_POST['isla'];
										$_SESSION['aytoopina'] = $_POST['ayto'];
										ver_todo();
									}

	elseif(isset($_POST['closew'])){unset($_SESSION['refopina']);
									unset($_SESSION['titopina']);
									unset($_SESSION['islaopina']);
									unset($_SESSION['aytoopina']);
								}

	else {	unset($_SESSION['refopina']);
		  	unset($_SESSION['titopina']);
			unset($_SESSION['islaopina']);
			unset($_SESSION['aytoopina']);
			global $redir;
			$redir = "<script type='text/javascript'>
						function redir(){
							window.close();
								}
						setTimeout('redir()',2000);
					</script>";
			print ($redir);
		}

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;
	
	global $opirefart;
	$opirefart = $_SESSION['refopina'];

	global $vname;
	$vname = "gch_opiniones";
	$vname = "`".$vname."`";

	$result =  "SELECT * FROM $vname WHERE `refart` = '$opirefart' AND `modera` = 'y' ";
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
    echo '<h7>* OPINIONES: '.$nres.' de '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.'.</h7>';

	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `refart` = '$opirefart' AND `modera` = 'y'  ORDER BY `refart` ASC $limit";

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
						<td colspan=3 class='BorderInf' align='center'>
							RESTAURANTE: ".$_SESSION['titopina']."
						</td>
					</tr>
					<tr>
						<td colspan=3 class='BorderInf' align='center'>
							".$_SESSION['islaopina']." || ".$_SESSION['aytoopina']."
						</td>
					</tr>
					<tr>
						<td align='center'>
							<font color='#FF0000'>
								NO HAY DATOS
							</font>
						</td>
					</tr>
					<tr>
							<form name='closewindow' action='$_SERVER[PHP_SELF]' onsubmit=\"window.close()\">
						<td colspan=3 class='BorderSup' valign='middle' align='center'>
								<input type='submit' value='CERRAR VENTANA' />
								<input type='hidden' name='closew' value=1 />
						</td>
							</form>
					</tr>
				</table>");
					global $redir;
					// 600000 microsegundos 10 minutos
					// 60000 microsegundos 1 minuto
					$redir = "<script type='text/javascript'>
								function redir(){
									window.close();
										}
								setTimeout('redir()',6000);
							</script>";
					print ($redir);
									
				} else { 	
					print ("<table align='center'>
								<tr>
									<td colspan=4 class='BorderInf' align='center'>
							OPINIONES MODERADAS: ".$nres." de ".$num_total_rows."
									</td>
								</tr>
								<tr>
									<td colspan=4 class='BorderInf' align='center'>
							RESTAURANTE: ".$_SESSION['titopina']."
									</td>
								</tr>
								<tr>
									<td colspan=4 class='BorderInf' align='center'>
							".$_SESSION['islaopina']." || ".$_SESSION['aytoopina']."
									</td>
								</tr>
								<tr>
									<td class='BorderInfDch' align='center'>
										FECHA
									</td>
										
									<td class='BorderInfDch' align='center'>
										LOCAL
									</td>
																				
									<td class='BorderInfDch' align='center'>
										EUROS
									</td>
																				
									<td class='BorderInf' align='center'>
										OPINIÓN
									</td>
								</tr>");
			
			
	while($rowb = mysqli_fetch_assoc($qb)){
				
	require 'Inclu_Name_Ref_to_Name.php';

	print (	"<tr align='center'>
							
						<td class='BorderInfDch'>
								".$rowb['datein']."
						</td>

						<td class='BorderInfDch'>
								".$rowb['valora']." de 5
						</td>

						<td class='BorderInfDch'>
								".$rowb['precio']." de 5
						</td>

						<td class='BorderInfDch' align='left'>
								".$rowb['opina']."
						</td>
			</tr>");
					}

	print("</table>");
						} 
			} 

    if ($total_pages > 1) {
        if ($page != 1) {
			echo '<div class="paginacion">
					<a href="Opina_Cliente_Ver.php?page='.($page-1).'">
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
						<a href="Opina_Cliente_Ver.php?page='.$i.'">'.$i.'</a>
					</div>';
            }
        }

        if ($page != $total_pages) {
			echo '<div class="paginacion">
					<a href="Opina_Cliente_Ver.php?page='.($page+1).'">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</div>';
			}
		}
		print("<div style='float:right'>
				<form name='closewindow' action='$_SERVER[PHP_SELF]' onsubmit=\"window.close()\">
					<input type='submit' value='CERRAR VENTANA' />
					<input type='hidden' name='closew' value=1 />
				</form>
			</div>
			<div style='clear:both'></div>");
			global $redir;
			$redir = "<script type='text/javascript'>
						function redir(){
							window.close();
								}
						setTimeout('redir()',30000);
					</script>";
			print ($redir);


	} // FIN FUNCION

/////////////////////////////////////////////////////////////////////////////////////////////////

require '../Gch.Users/Inc_Footer.php';

require '../Gch.Www/Inc_Jquery_Boots_Foot.php';
		
/* Creado por Juan Manuel Barros Pazos 2020/21 */
