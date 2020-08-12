<?php

	global $formularioh;
	$formularioh = "<form name='modifica' action='User_Modificar_02.php' method='POST'>";
	
	global $formulariof;
	$formulariof = "<div style=\"text-align:left; display:inline-block;\" >
						<input type='submit' value='MODIFICAR DATOS' />
						<input type='hidden' name='oculto2' value=1 />
					</form>
					</div>";

	global $formulariohi;
	$formulariohi = "<div style=\"text-align:left; display:inline-block;\">
	<form name='modifica_img' action='User_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=540px,height=680px')\">";

	global $formulariofi;
	$formulariofi = "<input type='submit' value='MODIFICAR IMAGEN' />
					 <input type='hidden' name='oculto2' value=1 />
						</form>
					</div>";

	global $formulariod;
	$formulariod = "<div style=\"text-align:left; display:inline-block;\">
						<form name='borrar' action='User_Borrar_02.php' method='POST'>";

	global $formulariofd;
	$formulariofd = "<input type='submit' value='BORRAR DATOS' />
					 <input type='hidden' name='oculto2' value=1 />
					</form>
				</div>";

?>