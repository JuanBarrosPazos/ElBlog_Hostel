<?php

	if(strlen(trim($rowb['myvdo'])) > 0){
		global $visual;
		$visual = "<video controls width='98%' height='auto'>
						<source src='../Gch.Vdo.News/".$rowb['myvdo']."' />
					</video>";
		global $delvdo;
		$delvdo = "<input type='submit' value='BORRAR VIDEO' />";
		global $upvdo;
		$upvdo = "<input type='submit' value='MODIFICA VIDEO' />";
	} else { global $visual;
			 $visual = "<img src='../Gch.Img.News/untitled.png' width='92%' height='auto' />";
			 global $delvdo;
			 $delvdo = "";
			 global $upvdo;
			 $upvdo = "<input type='submit' value='CREAR VIDEO' />";
				}

	print (	"<div class=\"BorderSup\" style=\"text-align:center; display:block; margin-top: 4px;\">

		<div  class='whiletotala'>
			AUTOR<br>".$rowb['refuser']."
		</div>
							
		<div class='whiletotala'>
			REFERENCIA<br>".$rowb['refnews']."
		</div>
							
		<div class='whiletotala'>
			TITULO<br>".$rowb['tit']."
		</div>
						
		<div class='whiletotala'>
			FECHA IN".$rowb['datein']."
		</div>

		<div class='whiletotala' style=\"width:180px !important; text-align:left;\">
			<span style=\"display:block; text-align:center;\">
				DESCRIPCION
			</span>
			".$conte."
		</div>

		<div class='whiletotala'>
	<img src='../Gch.Img.News/".$rowb['myimg']."' width='92%' height='auto' />
		</div>
												
		<div class='whiletotala'>
			".$visual."
		</div>

		</div>

		<div class=\"BorderInf\" style=\"text-align:center; display:block;\">

	<form name='ver' action='News_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=520px, height=auto')\" class='whiletotala'>
			");

			require 'Inc_News_While_Total_Rows.php';

	print(" <input type='submit' value='VER DETALLES' />
			<input type='hidden' name='oculto2' value=1 />
		</form>

		<form name='ver' action='News_Modificar_02.php' method='POST' class='whiletotala' >
			");

			require 'Inc_News_While_Total_Rows.php';
			
	print(" <input type='submit' value='MODIFICA NOTICIA' />
			<input type='hidden' name='oculto2' value=1 />
		</form>

	<form name='borrar' action='News_Borrar_02.php' method='POST' class='whiletotala' >
			");

			require 'Inc_News_While_Total_Rows.php';
			
	print(" <input type='submit' value='BORRA NOTICIA' />
			<input type='hidden' name='oculto2' value=1 />
		</form>
						
		<form name='modifica_img' action='News_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=540px,height=auto')\" class='whiletotala' >
			");

			require 'Inc_News_While_Total_Rows.php';
			
	print(" <input type='submit' value='MODIFICA IMAGEN' />
			<input type='hidden' name='oculto2' value=1 />
		</form>

						
		<form name='videonews' action='upvdo/upvdo.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=400px,height=560px')\" class='whiletotala'>
			");

			require 'Inc_News_While_Total_Rows.php';
			
	print( $upvdo."
			<input type='hidden' name='oculto2' value=1 />
		</form>

		<form name='videonews' action='News_Vdo_Borrar.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=400px,height=560px')\" class='whiletotala'>
			");

			require 'Inc_News_While_Total_Rows.php';
			
	print( $delvdo."
			<input type='hidden' name='oculto2' value=1 />
		</form>

		</div>");

?>