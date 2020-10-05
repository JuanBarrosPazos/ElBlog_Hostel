<?php

		global $conte;
		$conte = substr($rowb['conte'],0,56);
		$conte = $conte." ...";	
		
	if(strlen(trim($rowb['myvdo'])) > 0){
		global $visual;
		$visual = "<video controls width='98%' height='auto'>
						<source src='../Gch.Vdo.Art/".$rowb['myvdo']."' />
					</video>";
		global $delvdo;
		$delvdo = "<input type='submit' value='BORRAR VIDEO' />";
		global $upvdo;
		$upvdo = "<input type='submit' value='MODIFICA VIDEO' />";
	} else { global $visual;
			 $visual = "<img src='../Gch.Img.Art/untitled.png' width='92%' height='auto' />";
			 global $delvdo;
			 $delvdo = "";
			 global $upvdo;
			 $upvdo = "<input type='submit' value='CREAR VIDEO' />";
				}

	print (	"<div class=\"BorderSup\" style=\"text-align:center; display:block; margin-top:8px; padding-top: 0px; border-top: #fff solid 1px;\">

		<div class='whiletotala'>
			NOMBRE<br>".strtoupper($rowb['tit'])."
		</div>

		<div class='whiletotala'>
			ISLA<br>".strtoupper($rowb['refisla'])." / ".strtoupper($islaname)."
		</div>

		<div class='whiletotala'>
			AYUNTAMIENTO<br>".strtoupper($rowb['refayto'])." / ".strtoupper($aytoname)."
		</div>

		<div class='whiletotala' style=\"width:180px !important; text-align:left;\">
			<span style=\"display:block; text-align:center;\">
				DESCRIPCION
			</span>".strtoupper($conte)."
		</div>

		<div class='whiletotala'>
			<img src='../Gch.Img.Art/".$rowb['myimg1']."' width='92%' height='auto' />
		</div>

		<div class='whiletotala'>
			".$visual."
		</div>

		</div>

		<div class=\"BorderInf\" style=\"text-align:center; display:block;\">
		
	<form name='ver' action='".$rut."Art_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=520px,height=640px')\" class='whiletotala'>
		");

			require 'Inc_Art_While_Total_Rows.php';

		print(" <input type='submit' value='VER DETALLES' />
				<input type='hidden' name='oculto2' value=1 />
			</form>

			<form name='ver' action='".$rut."Art_Modificar_02.php' method='POST' class='whiletotala'>
			");

			require 'Inc_Art_While_Total_Rows.php';

		print("	<input type='submit' value='MODIFICA DATOS' />
				<input type='hidden' name='oculto2' value=1 />
			</form>

			<form name='ver' action='".$rut."Art_Borrar_02.php' method='POST' class='whiletotala'>
			");

			require 'Inc_Art_While_Total_Rows.php';

		print("	<input type='submit' value='BORRA DATOS' />
				<input type='hidden' name='oculto2' value=1 />
			</form>


	<form name='modifica_img' action='".$rut."Art_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=550px,height=400px')\" class='whiletotala' >
			");
			
			require 'Inc_Art_While_Total_Rows.php';

		print(" <input type='submit' value='MODIFICA IMAGEN' />
				<input type='hidden' name='oculto2' value=1 />
	</form>

		<form name='videonews' action='".$rut."upvdo/upvdo.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=400px,height=560px')\" class='whiletotala'>
			");

			require 'Inc_Art_While_Total_Rows.php';
			
	print( $upvdo."
			<input type='hidden' name='oculto2' value=1 />
		</form>

		<form name='videonews' action='".$rut."Art_Vdo_Borrar.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=400px,height=560px')\" class='whiletotala'>
			");

			require 'Inc_Art_While_Total_Rows.php';
			
	print( $delvdo."
			<input type='hidden' name='oculto2' value=1 />
		</form>	
	</div>");


?>