<?php
@session_start();

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

	if(isset($_POST['oculto'])){
				if($form_errors = validate_form()){
						show_form($form_errors);
				} else {show_form();
						process_form();
						//info();
							}
			}	

	elseif ((isset($_GET['page'])) || (isset($_POST['page']))) { 
												show_form();
												process_form(); 
											}

	else { 	unset($_SESSION['titulo']);
			unset($_SESSION['autor']);
			unset($_SESSION['dy']);
			unset($_SESSION['dm']);	
			show_form();
			ver_todo();}

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	$errors = array();
	
	if (strlen(trim($_POST['titulo'])) > 0) {
		
		if (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['titulo'])){
			$errors [] = "<font color='#FF0000'>CARACTERES NO VALIDOS</font>";
			}
		}
	
	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;
	
	//echo @$_SESSION['autor']."<br>";

	global $autor;
	global $g;
	global $titulo;

	if (strlen(trim(@$_SESSION['titulo'])) == 0){
		$titulo = '';
		$g = 'AND';
	}else{
		$titulo = trim($_SESSION['titulo']);
		$titulo = "AND `tit` LIKE '%".$titulo."%' ";
		$g = 'OR';
	}

	if (strlen(trim(@$_SESSION['autor'])) == 0){
		$autor = '';
	}else{
		$autor = trim($_SESSION['autor']);
		$autor = "$g `refuser` LIKE '%".$autor."%' ";
	}

	global $orden;
	$orden = "`id` DESC";

	global $dyt1;
	global $dm1;
	//global $dd1;
	
	if (@$_POST['dy'] == ''){ $dy1 = date('Y');
							 $dyt1 = $dy1;} 
							 				else {	$dy1 = "20".$_SESSION['dy'];
													$dyt1 = $dy1;
													}
	if (@$_POST['dm'] == ''){ $dm1 = '';} 
							 				else {	$dm1 = "-".$_SESSION['dm'];
													}
	global $fil;
	$fil = $dy1.$dm1."%";
	//$fil = $dy1."-%".$dm1."%";
	global $vname;
	$vname = "gch_news";
	$vname = "`".$vname."`";

	$result =  "SELECT * FROM `$db_name`.$vname WHERE `datein` LIKE '$fil' $titulo $autor ";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	// DEFINO EL NUMERO DE NOTICIAS POR PÁGINA
	global $nitem;
	$nitem = 3;
	
	global $page;

	if (isset($_POST["page"])) {
		global $page;
        $page = $_POST["page"];
    }

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    if (!$page) {
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * $nitem;
    }
    
    //calculo el total de paginas
	$total_pages = ceil($num_total_rows / $nitem);
	
    //pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
    echo '<h7>* NOTICIAS '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.'.</h7>';

	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `datein` LIKE '$fil' $titulo $autor  ORDER BY $orden $limit";
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
			print ("<div class='row'> <!-- Titulo -->
					<div class='col-lg-12 text-center'>
					  <h2 class='section-heading text-uppercase'>Noticias</h2>
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

	// DEFINO LA RECTIFICACIÓN DE LA RUTA IMG
    global $rut;
    //$rut = "";
    $rut = "../";

	require '../Gch.News/Inc_News_Form.php';

	require '../Gch.News/Inc_Centra_Img.php';

	print ("
		<li  class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
	<img class='<!--rounded-circle--> img-fluid' ".$centra."  src='../Gch.Img.News/".$rowb['myimg']."' alt=''>
			</div>

		<div class='timeline-panel'>
			<div class='timeline-heading'>
				<h6>".$rowb['datein']."</h6>
				<h5>".$rowb['tit']."</h5>
			</div>
			<div class='timeline-body'>
				<p class='text-muted'>".$conte."</p>
			</div>
		<div id=\"".$refnews."\"></div>
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
            echo '<li class="page-item"><a class="page-link" href="news.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="news.php?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="news.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';

			} 
		}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){

	global $page;
	global $defaults;

	if(isset($_POST['oculto'])){$_SESSION['titulo'] = $_POST['titulo'];
								$_SESSION['autor'] = $_POST['autor'];
								$_SESSION['dy'] = $_POST['dy'];
								$_SESSION['dm'] = $_POST['dm'];
								$defaults = $_POST;
		}
	else {	$defaults = array ('titulo' => @$_SESSION['titulo'],
							   'autor' => @$_SESSION['autor'],
							   'dy' => @$_SESSION['dy'],
							   'dm' => @$_SESSION['dm']
							);
										}
										
//echo $_SESSION['autor'];

	if ($errors){
		print("	<div  class='errors'>
					<table align='left' style='border:none'>
					<th style='text-align:left'>
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					</th>
					<tr>
					<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>
				</div>
				<div style='clear:both'></div>");
		}
		
		require "../Gch.Config/ayear.php";
			
		$dm = array (	'' => 'MES TODOS',
						'01' => 'ENERO',
						'02' => 'FEBRERO',
						'03' => 'MARZO',
						'04' => 'ABRIL',
						'05' => 'MAYO',
						'06' => 'JUNIO',
						'07' => 'JULIO',
						'08' => 'AGOSTO',
						'09' => 'SEPTIEMBRE',
						'10' => 'OCTUBRE',
						'11' => 'NOVIEMBRE',
						'12' => 'DICIEMBRE',
										);
		
		$dd = array (	'' => 'DÍA TODOS',
						'01' => '01',
						'02' => '02',
						'03' => '03',
						'04' => '04',
						'05' => '05',
						'06' => '06',
						'07' => '07',
						'08' => '08',
						'09' => '09',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31',
						);
											
	if($defaults['autor'] == 'admindel'){ 
						global $selc;
						$selc = "selected = 'selected'";
						}
	else {	global $selc;
			$selc = "";
			}

	print("<div style='width:auto; text-align:center; padding: 8px 0px 8px 0px;'>
				
						
		<div style='display:inline-block;'>
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
					<input type='submit' value='FILTRO NOTICIAS' />
					<input type='hidden' name='oculto' value=1 />

		<input type='hidden' name='titulo' size=20 maxlenth=10 value='".$defaults['titulo']."' />

		<select name='autor'>
			
		<option value=''>SELECCIONE AUTOR</option>
		<option value='admindel' ".$selc.">Autores Eliminados</option>");
						
	/* RECORREMOS LOS VALORES DE LA TABLA PARA CONSTRUIR CON ELLOS UN SELECT */	
			
	global $db;
	$sqlb =  "SELECT * FROM `gch_admin` ORDER BY `Apellidos` ASC ";
	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("* ".mysqli_error($db)."</br>");
	} else {
					
		while($rows = mysqli_fetch_assoc($qb)){
			if($defaults['autor'] == 'admindel'){
				print ("<option value='".$rows['ref']."'> "
				.$rows['Apellidos']." ".$rows['Nombre']."</option>");
			}
			else{	print ("<option value='".$rows['ref']."' ");
					if($rows['ref'] == $defaults['autor']){
										print ("selected = 'selected'");
														}
						print ("> ".$rows['Apellidos']." ".$rows['Nombre']."</option>");
					}
			} // FIN WHILE
		
		} // FIN QUERY

	print ("	</select>
		</div>

		<div style='display:inline-block;'>
				<select name='dy'>"
				);
							
					foreach($dy as $optiondy => $labeldy){
						
						print ("<option value='".$optiondy."' ");
						
						if($optiondy == @$defaults['dy']){print ("selected = 'selected'");}
														print ("> $labeldy </option>");
													}	
																	
			print ("	</select>
						<select name='dm'>");
		
				foreach($dm as $optiondm => $labeldm){
					
					print ("<option value='".$optiondm."' ");
					
					if($optiondm == @$defaults['dm']){
															print ("selected = 'selected'");
																								}
													print ("> $labeldm </option>");
												}	
																
		print ("</select>
			</form>	
					</div>
				</div>
			");
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function ver_todo(){
		
	global $db;
	global $db_name;

	global $dyt1;
	$dyt1 = date('Y');
	global $fil;
	$fil = $dyt1."-%";
	//$fil = $dy1.$dm1.$dd1."%";
	global $vname;
	$vname = "gch_news";
	$vname = "`".$vname."`";

	$result =  "SELECT * FROM $vname WHERE `datein` LIKE '$fil'";
	$q = mysqli_query($db, $result);
	$row = mysqli_fetch_assoc($q);
	$num_total_rows = mysqli_num_rows($q);
	
	global $nitem;
	$nitem = 3;
	
	global $page;

     if (isset($_POST["page"])) {
		global $page;
        $page = $_POST["page"];
	}
	
   //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    }

    if (!$page) {
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * $nitem;
    }
    
    //calculo el total de paginas
	$total_pages = ceil($num_total_rows / $nitem);
	
    //pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
    echo '<h7>* NOTICIAS '.$num_total_rows.' * P&aacute;gina '.$page.' de ' .$total_pages.'.</h7>';

	global $limit;
	$limit = " LIMIT ".$start.", ".$nitem;

	$sqlb =  "SELECT * FROM `$db_name`.$vname WHERE `datein` LIKE '$fil' ORDER BY `id` DESC $limit";

	$qb = mysqli_query($db, $sqlb);
	if(!$qb){
			print("<font color='#FF0000'>Consulte L.496: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){
				print ("<table align='center'>
						<tr>
							<td style='text-align:center'>
								<h4>
									<a href='../Gch.Admin/access.php' target='_blank'>
								NO HAY DATOS
									<br>
								CREE SU PRIMERA NOTICIA
									</a>
								</h4>
							</td>
						</tr>
				</table>");
	} else {
		print ("<div class='row'> <!-- Titulo -->
				<div class='col-lg-12 text-center'>
				  <h2 class='section-heading text-uppercase'>Noticias</h2>
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

	// DEFINO LA RECTIFICACIÓN DE LA RUTA IMG
    global $rut;
    //$rut = "";
    $rut = "../";

	require '../Gch.News/Inc_News_Form.php';

	require '../Gch.News/Inc_Centra_Img.php';

	print ("
		<li  class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
	<img class='<!--rounded-circle--> img-fluid' ".$centra." src='../Gch.Img.News/".$rowb['myimg']."' alt=''>
			</div>

		<div class='timeline-panel'>
			<div class='timeline-heading'>
				<h6>".$rowb['datein']."</h6>
				<h5>".$rowb['tit']."</h5>
			</div>
			<div class='timeline-body'>
				<p class='text-muted'>".$conte."</p>
			</div>
		<div id=\"".$refnews."\"></div>
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
            echo '<li class="page-item"><a class="page-link" href="news.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="news.php?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="news.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';

			} 
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

	//require '../Gch.Inclu/Admin_Inclu_02.php';
		
/* Creado por Juan Barros Pazos 2019 */
