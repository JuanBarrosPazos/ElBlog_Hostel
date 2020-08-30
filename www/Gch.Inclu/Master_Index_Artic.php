<?php

	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/mydni.php';

	global $db_name;

	if ($_SESSION['Nivel'] == 'admin') {	
		
	require '../Gch.Inclu/Master_Index_Header.php';

print("
<nav class='sidebar-nav'>

<ul>
");
if ($_SESSION['dni'] == $_SESSION['mydni']) {

	global $backup;
	$backup = "	<li>
					<a href='../Gch.upbbdd/export_bbdd_backups.php'>
						<i class='ic ico22'></i>BACKUP bbdd
					</a>
				</li>";
	
print("
		
	<li>
		<a href='#'><i class='ic ico22'></i> <span>WEB MASTER</span></a>
			<ul class='nav-flyout'>
		<li>
			<a href='../Gch.News/News_Modificar_01.php'>
				<i class='ic ico22'></i>NEWS MODIF
			</a>
		</li>
		<li>
			<a href='../Gch.Admin/cnemp.php'>
				<i class='ic ico22'></i>N. ADMIN
			</a>
		</li>
		<li>
			<a href='../Gch.Syst/Tipo_Modificar_01.php'>
				<i class='ic ico22'></i>CATEGORIA
			</a>
		</li>
		<li>
			<a href='../Gch.Syst/Espec_Modificar_01.php'>
				<i class='ic ico22'></i>PLATOS
			</a>
		</li>
		<li>
			<a href='../Gch.Syst/Isla_Modificar_01.php'>
				<i class='ic ico22'></i>ISLAS
			</a>
		</li>
		<li>
			<a href='../Gch.Syst/Ayto_Modificar_01.php'>
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
		<a href='#'><i class='ic ico13'></i> <span>ADMIN SYSTM</span></a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434; padding-top: 31px'>
						<i class='ic ico19b'></i>ADMIN SYST
					</a>
				</li>
				<li>
					<a href='../Gch.Admin/Admin_Ver.php'>
						<i class='ic ico15b'></i>CONSULTAR
					</a>
				</li>
				<li>
					<a href='../Gch.Admin/Admin_Crear.php'>
						<i class='ic ico14b'></i>CREAR
					</a>
				</li>
				<li>
					<a href='../Gch.Admin/Admin_Modificar_01.php'>
						<i class='ic ico02b'></i>MODIFICAR
					</a>
				</li>
				<li>
					<a href='../Gch.Admin/Admin_Borrar_01.php'>
						<i class='ic ico19b'></i>BORRAR
					</a>
				</li>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 4px;'>
						<i class='ic'></i>
					</a>
				</li>
			</ul>
	</li>
	
	<li>
		<a href='#'><i class='ic ico02'></i> <span>RESTAURANTES</span></a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434;'>
						<i class='ic ico19b'></i>LOCALES
					</a>
				</li>
				<li>
					<a href='Art_Ver.php'>
						<i class='ic ico15b'></i>CONSULTAR
					</a>
				</li>
				<li>
					<a href='Art_Crear.php'>
						<i class='ic ico14b'></i>CREAR
					</a>
				</li>
				<li>
					<a href='Art_Modificar_01.php'>
						<i class='ic ico02b'></i>MODIFICAR
					</a>
				</li>
				<li>
					<a href='Art_Borrar_01.php'>
						<i class='ic ico19b'></i>BORRAR
					</a>
				</li>
				<li>
					<a href='../Gch.Syst/Opina_Modificar_01.php'>
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
		<a href='#'><i class='ic ico03'></i> <span>RESPALDO DATOS</span></a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434; padding-top: 59px;'>
						<i class='ic ico19b'></i>BACKUPS
					</a>
				</li>
				".$backup."
				<li>
					<a href='../Gch.upbbdd/bbdd.php'>
						<i class='ic ico02b'></i>TABLAS bbdd
					</a>
				</li>
				<li>
					<a href='../Gch.upbbdd/export_log.php'>
						<i class='ic ico02b'></i>SYSTEM .log
					</a>
				</li>
				<li>
					<a href='#' style='background-color: #343434;'>
						<i class='ic'></i>
					</a>
				</li>
			</ul>
	</li>
	
	<li>
		<a href='../Gch.Mail/index.php'  target='_blank'>	
		<i class='ic ico16'></i>NOTIFICACIONES
		</a>
	</li>
	
	<li>
		<a href='#'>
		<form name='cerrar' action='../Gch.Admin/mcgexit.php' method='post'>
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
				<a href='../Gch.Admin/Admin_Modificar_01.php'><i class='ic ico13'></i>MIS DATOS</a>
			</li>
	
			<li>
			<a href='#'><i class='ic ico02'></i> <span>RESTAURANTES</span></a>
				<ul class='nav-flyout'>
					<li>
						<a href='#' style='background-color: #343434;'>
							<i class='ic ico19b'></i>LOCALES
						</a>
					</li>
					<li>
						<a href='Art_Ver.php'>
							<i class='ic ico15b'></i>CONSULTAR
						</a>
					</li>
					<li>
						<a href='Art_Crear.php'>
							<i class='ic ico14b'></i>CREAR
						</a>
					</li>
					<li>
						<a href='Art_Modificar_01.php'>
							<i class='ic ico02b'></i>MODIFICAR
						</a>
					</li>
					<li>
						<a href='Art_Borrar_01.php'>
							<i class='ic ico19b'></i>BORRAR
						</a>
					</li>
					<li>
						<a href='../Gch.Syst/Opina_Modificar_01.php'>
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
		<a href='../Gch.Mail/index.php'  target='_blank'>	
		<i class='ic ico16'></i>NOTIFICACIONES
		</a>
	</li>
	
	<li>
		<a href='#'>
		<form name='cerrar' action='../Gch.Admin/mcgexit.php' method='post'>
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
				<a href='../Gch.Admin/Admin_Modificar_01.php'><i class='ic ico13'></i>MIS DATOS</a>
			</li>
	
	<li>
		<a href='#'><i class='ic ico02'></i> <span>RESTAURANTES</span></a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434;'>
						<i class='ic'></i>
					</a>
				</li>
				<li>
					<a href='Art_Ver.php'>
						<i class='ic ico15b'></i>CONSULTAR
					</a>
				</li>
				<li>
					<a href='Art_Crear.php'>
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
		<a href='../Gch.Mail/index.php'  target='_blank'>	
		<i class='ic ico16'></i>NOTIFICACIONES
		</a>
	</li>
	
	<li>
		<a href='#'>
		<form name='cerrar' action='../Gch.Admin/mcgexit.php' method='post'>
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
	
/* Creado por Juan Barros Pazos 2020*/
?>