﻿<?php

	//require $req.'Gch.Inclu/error_hidden.php';
	require $req.'Gch.Inclu/mydni.php';

	global $db_name;

	if ($_SESSION['Nivel'] == 'admin') {	
		
	require $req.'Gch.Inclu/Master_Index_Header.php';

print("
<nav class='sidebar-nav'>

<ul>
");
if ($_SESSION['dni'] == $_SESSION['mydni']) {

	global $backup;
	$backup = "	<li>
					<a href= '".$rtbbdd."export_bbdd_backups.php'>
						<i class='ic ico22'></i>BACKUP bbdd
					</a>
				</li>";
	
print("
		
	<li>
		<a href='#'><i class='ic ico22'></i> <span>WEB MASTER</span></a>
			<ul class='nav-flyout'>
		<li>
			<a href='#'>
				<i class='ic ico19b'></i>WEB MASTER
			</a>
		</li>
		<li>
			<a href='".$rtadmin."cnemp.php'>
				<i class='ic ico22'></i>N. ADMIN
			</a>
		</li>
		<li>
			<a href='".$rtsyst."Tipo_Modificar_01.php'>
				<i class='ic ico22'></i>CATEGORIAS
			</a>
		</li>
		<li>
			<a href='".$rtsyst."Espec_Modificar_01.php'>
				<i class='ic ico22'></i>PLATOS
			</a>
		</li>
		<li>
			<a href='".$rtsyst."Isla_Modificar_01.php'>
				<i class='ic ico22'></i>PROVINCIAS
			</a>
		</li>
		<li>
			<a href='".$rtsyst."Ayto_Modificar_01.php'>
				<i class='ic ico22'></i>MUNICIPIOS
			</a>
		</li>
		<li>
			<a href='#' style='background-color: #343434;padding-bottom: 4px;'>
				<i class='ic'></i>
			</a>
		</li>
			</ul>
	</li>");
					}else{

	global $backup;
	$backup = "	<li>
					<a href='#'>
						<i class='ic'></i>
					</a>
				</li>";
	
print("<li>
			<a href='#'>	
			<i class='ic ico22'></i>
			</a>
		</li>");
	
					} // Fin condicional web master
print("
	
	<li>
		<a href='".$rtadmin."Admin_Modificar_01.php'><i class='ic ico13'></i> <span>ADMIN SYSTM</span></a>
	</li>
	
	<li>
		<a href='#'><i class='ic ico02'></i> <span>CONTENIDOS</span></a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434;padding-top: 31px;'>
						<i class='ic'></i>
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico19b'></i>CONTENIDOS
					</a>
				</li>
				<li>
					<a href='".$rtartic."Art_Modificar_01.php'>
						<i class='ic ico02b'></i>LOCALES
					</a>
				</li>
				<li>
					<a href='".$rtsyst."Opina_Modificar_01.php'>
						<i class='ic ico02b'></i>OPINIONES</a>
				</li>
				<li>
					<a href='".$rtnews."News_Modificar_01.php' style='padding-bottom: 6px;'>
						<i class='ic ico02b'></i>NOTICIAS
					</a>
				</li>
			</ul>
	</li>

	<li>
		<a href='#'><i class='ic ico03'></i> <span>RESPALDO DATOS</span></a>
			<ul class='nav-flyout'>
				".$backup."
				<li>
					<a href='".$rtbbdd."bbdd.php'>
						<i class='ic ico02b'></i>TABLAS bbdd
					</a>
				</li>
				<li>
					<a href='".$rtbbdd."export_log.php'>
						<i class='ic ico02b'></i>SYSTEM .log
					</a>
				</li>
				<li>
					<a href='#' padding-bottom: 62px;'>
						<i class='ic ico19b'></i>BACKUPS
					</a>
				</li>
				<li>
					<a href='#' style='background-color: #343434; padding-bottom: 34px;'>
						<i class='ic'></i>
					</a>
				</li>
			</ul>
	</li>
	
	<li>
		<a href='".$req."Gch.Mail/index.php'  target='_blank'>	
		<i class='ic ico16'></i>NOTIFICACIONES
		</a>
	</li>
	
	<li>
		<a href='#'>
		<form name='cerrar' action='".$rtadmin."mcgexit.php' method='post'>
		<i class='ic ico01'></i>
					<input type='submit' value='CLOSE SESSION'  style='margin-top:-2px; margin-left:2px;' />
					<input type='hidden' name='cerrar' value=1 />
		</form>
		</a>
	</li>
	
</ul>
	
</nav>
	
</aside>
	
</section>

</div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						  FIN NIVEL ADMIN
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

");
	
	} elseif ($_SESSION['Nivel'] == 'plus') {
						
	global $niv;
	$niv = 'Usuario Plus';
		
		print("

<div style='clear:both'></div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						   INICIO NIVEL PLUS
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

<div class='MenuVertical'>

<section class='app'>

<aside class='sidebar'>

	<header>
 ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']."</br>
 Level: ".$niv.".</br>
 <a href='#'><i class='ic icoh'></i>
		<span style='color:#FFFFFF;vertical-align:middle'>MENU APP</span>
 </a>
	</header>
	
<nav class='sidebar-nav'>

<ul>
	
			<li>
				<a href= '".$rtadmin."Admin_Modificar_01.php'><i class='ic ico13'></i>MIS DATOS</a>
			</li>
	
			<li>
			<a href='#'><i class='ic ico02'></i> <span>CONTENIDOS</span></a>
				<ul class='nav-flyout'>
					<li>
						<a href='#' style='background-color: #343434;'>
							<i class='ic ico19b'></i>LOCALES
						</a>
					</li>
					<li>
						<a href='".$rtnews."News_Modificar_01.php'>
							<i class='ic ico22'></i>NOTICIAS
						</a>
					</li>
					<li>
						<a href='".$rtartic."Art_Modificar_01.php'>
							<i class='ic ico02b'></i>LOCALES
						</a>
					</li>
					<li>
						<a href='".$rtsyst."Opina_Modificar_01.php'>
							<i class='ic ico19b'></i>OPINIONES</a>
					</li>
					<li>
						<a href='#' style='background-color: #343434;padding-bottom: 4px;'>
							<i class='ic'></i>
						</a>
					</li>
				</ul>
		</li>
			
	<li>
		<a href='".$req."Gch.Mail/index.php'  target='_blank'>	
		<i class='ic ico16'></i>NOTIFICACIONES
		</a>
	</li>
	
	<li>
		<a href='#'>
		<form name='cerrar' action='".$rtadmin."mcgexit.php' method='post'>
		<i class='ic ico01'></i>
				<input type='submit' value='CLOSE SESSION'  style='margin-top:-2px; margin-left:2px;' />
				<input type='hidden' name='cerrar' value=1 />
		</form>
		</a>
	</li>
	
</ul>
	
</nav>
	
</aside>
	
</section>

</div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						  FIN NIVEL PLUS
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

");

	}elseif ($_SESSION['Nivel'] == 'user') {
						
	global $niv;
	$niv = 'Usuario';

		print("

<div style='clear:both'></div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						   INICIO NIVEL USER
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

<div class='MenuVertical'>

<section class='app'>

<aside class='sidebar'>

	<header>
 ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']."</br>
 Level: ".$niv.".</br>
 <a href='#'><i class='ic icoh'></i>
		<span style='color:#FFFFFF;vertical-align:middle'>MENU APP</span>
 </a>
	</header>
	
<nav class='sidebar-nav'>

<ul>
	
			<li>
				<a href= '".$rtadmin."Admin_Modificar_01.php'><i class='ic ico13'></i>MIS DATOS</a>
			</li>
	
	<li>
		<a href='#'><i class='ic ico02'></i> <span>CONTENIDOS</span></a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434;'>
						<i class='ic'></i>
					</a>
				</li>
				<li>
					<a href='".$rtartic."Art_Ver.php'>
						<i class='ic ico15b'></i>CONSULTAR
					</a>
				</li>
				<li>
					<a href='".$rtartic."Art_Crear.php'>
						<i class='ic ico14b'></i>CREAR
					</a>
				</li>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 61px;'>
						<i class='ic'></i>
					</a>
				</li>
			</ul>
	</li>

	<li>
		<a href='".$req."Gch.Mail/index.php'  target='_blank'>	
		<i class='ic ico16'></i>NOTIFICACIONES
		</a>
	</li>
	
	<li>
		<a href='#'>
		<form name='cerrar' action='".$rtadmin."mcgexit.php' method='post'>
		<i class='ic ico01'></i>
				<input type='submit' value='CLOSE SESSION'  style='margin-top:-2px; margin-left:2px;' />
				<input type='hidden' name='cerrar' value=1 />
		</form>
		</a>
	</li>
	
</ul>
	
</nav>
	
</aside>
	
</section>

</div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						  FIN NIVEL USER
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

");
	
	} 
	
/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>