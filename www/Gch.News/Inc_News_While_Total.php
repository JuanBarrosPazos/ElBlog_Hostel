<?php

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
			<video controls width='98%' height='auto'>
				<source src='../Gch.Vdo.News/".$rowb['myvdo']."' />
			</video>
		</div>

		</div>

		<div class=\"BorderInf\" style=\"text-align:center; display:block;\">

	<form name='ver' action='News_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=520px, height=auto')\" class='whiletotala'>

			<input name='dyt1' type='hidden' value='".$dyt1."' />
			<input name='id' type='hidden' value='".$rowb['id']."' />
			<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
			<input name='refnews' type='hidden' value='".$rowb['refnews']."' />
			<input name='tit' type='hidden' value='".$rowb['tit']."' />
			<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
			<input name='datein' type='hidden' value='".$rowb['datein']."' />
			<input name='timein' type='hidden' value='".$rowb['timein']."' />
			<input name='datemod' type='hidden' value='".$rowb['datemod']."' />
			<input name='timemod' type='hidden' value='".$rowb['timemod']."' />
			<input name='conte' type='hidden' value='".$rowb['conte']."' />						
			<input name='myimg' type='hidden' value='".$rowb['myimg']."' />

			<input type='submit' value='VER DETALLES' />
			<input type='hidden' name='oculto2' value=1 />
		</form>

		<form name='ver' action='News_Modificar_02.php' method='POST' class='whiletotala' >

			<input type='hidden' name='id' value='".$rowb['id']."' />
			<input type='hidden' name='dyt1' value='".$dyt1."' />
			<input type='hidden' name='refuser' value='".$rowb['refuser']."' />
			<input type='hidden' name='refnews' value='".$rowb['refnews']."' />
			<input type='hidden' name='datein' value='".$rowb['datein']."' />
			<input type='hidden' name='tit' value='".$rowb['tit']."' />
			<input type='hidden' name='titsub' value='".$rowb['titsub']."' />
			<input type='hidden' name='timein' value='".$rowb['timein']."' />
			<input type='hidden' name='datemod' value='".$rowb['datemod']."' />
			<input type='hidden' name='timemod' value='".$rowb['timemod']."' />
			<input type='hidden' name='conte' value='".$rowb['conte']."' />
			<input type='hidden' name='myimg' value='".$rowb['myimg']."' />
			<input name='myvdo' type='hidden' value='".$rowb['myvdo']."' />

			<input type='submit' value='MODIFICA DATOS' />
			<input type='hidden' name='oculto2' value=1 />
		</form>

	<form name='borrar' action='News_Borrar_02.php' method='POST' class='whiletotala' >

			<input name='dyt1' type='hidden' value='".$dyt1."' />
			<input name='id' type='hidden' value='".$rowb['id']."' />
			<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
			<input name='refnews' type='hidden' value='".$rowb['refnews']."' />
			<input name='tit' type='hidden' value='".$rowb['tit']."' />
			<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
			<input name='datein' type='hidden' value='".$rowb['datein']."' />
			<input name='timein' type='hidden' value='".$rowb['timein']."' />
			<input name='datemod' type='hidden' value='".$rowb['datemod']."' />
			<input name='timemod' type='hidden' value='".$rowb['timemod']."' />
			<input name='conte' type='hidden' value='".$rowb['conte']."' />						
			<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
			<input name='myvdo' type='hidden' value='".$rowb['myvdo']."' />

			<input type='submit' value='BORRA ARTICULO' />
			<input type='hidden' name='oculto2' value=1 />
		</form>
						
		<form name='modifica_img' action='News_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=540px, height=auto')\" class='whiletotala' >

			<input name='id' type='hidden' value='".$rowb['id']."' />
			<input name='dyt1' type='hidden' value='".$dyt1."' />
			<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
			<input name='refnews' type='hidden' value='".$rowb['refnews']."' />
			<input name='tit' type='hidden' value='".$rowb['tit']."' />
			<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
			<input name='datein' type='hidden' value='".$rowb['datein']."' />
			<input name='timein' type='hidden' value='".$rowb['timein']."' />
			<input name='datemod' type='hidden' value='".$rowb['datemod']."' />
			<input name='timemod' type='hidden' value='".$rowb['timemod']."' />
			<input name='conte' type='hidden' value='".$rowb['conte']."' />						
			<input name='myimg' type='hidden' value='".$rowb['myimg']."' />

			<input type='submit' value='MODIFICA IMAGEN' />
			<input type='hidden' name='oculto2' value=1 />
		</form>

						
		<form name='videonews' action='upvdo/upvdo.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=400px,height=560px')\" class='whiletotala'>
			<input name='id' type='hidden' value='".$rowb['id']."' />
			<input name='dyt1' type='hidden' value='".$dyt1."' />
			<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
			<input name='refnews' type='hidden' value='".$rowb['refnews']."' />
			<input name='myvdo' type='hidden' value='".$rowb['myvdo']."' />

			<input type='submit' value='MODIFICA VIDEO' />
			<input type='hidden' name='oculto2' value=1 />
		</form>

		</div>");

?>