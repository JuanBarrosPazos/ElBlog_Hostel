<?php


if ($_SESSION['dni'] == $_SESSION['mydni']) { global $niv;
											  $niv = 'Web Master';
												}
elseif ($_SESSION['Nivel'] == 'admin') { global $niv;
										 $niv = 'Administrador';
												 }

print ("
<div style='clear:both'></div>


<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						   INICIO NIVEL ADMIN
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

<div class='MenuVertical'>

<section class='app'>

<aside class='sidebar'>

	<header>
".$_SESSION['Nombre'][0].". ".$_SESSION['Apellidos']."</br>
 Level: ".$niv.".</br>
 <a href='#'><i class='ic icoh'></i>
		<span style='color:#FFFFFF;vertical-align:middle'>MENU APP</span>
 </a>
    </header>
    ");

	/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>