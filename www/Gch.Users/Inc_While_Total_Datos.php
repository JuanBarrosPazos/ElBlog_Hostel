<?php

	print (	"<div style=\"margin-top:12px;\">".$formularioh."

            <!-- AQUÍ VA LA CABECERA DEL FORMULARIO -->

				<div class='whiletotal'>
				NIVEL<br>
	<input name='Nivel' type='hidden' value='".$rowb['Nivel']."' />".$rowb['Nivel']."
				</div>
							
				<div class='whiletotal'>
				REF<br>
	<input name='ref' type='hidden' value='".$rowb['ref']."' />".$rowb['ref']."
				</div>
							
				<div class='whiletotal'>
				NOMBRE<br>
	<input name='Nombre' type='hidden' value='".$rowb['Nombre']."' />".$rowb['Nombre']."
				</div>
							
				<div class='whiletotal'>
				APELLIDO<br>
	<input name='Apellidos' type='hidden' value='".$rowb['Apellidos']."' />".$rowb['Apellidos']."
				</div>
						
				<div class='whiletotal' style=\"vertical-align: top;\">
	<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
	<img src='../Gch.Img.User/".$rowb['myimg']."' style=\"height:40px; width:30px; margin-top:5px;\" />
				</div>
													
				<div class='whiletotal'>
				USUARIO<br>
	<input name='Usuario' type='hidden' value='".$rowb['Usuario']."' />".$rowb['Usuario']."
				</div>
						
				<div class='whiletotal'>
				PASSWORD<br>
	<input name='Password' type='hidden' value='".$rowb['Password']."' />".$rowb['Password']."
				</div>

	<input type='hidden' name='id' value='".$rowb['id']."' />
	<input type='hidden' name='Email' value='".$rowb['Email']."' />
	<input type='hidden' name='Direccion' value='".$rowb['Direccion']."' />
	<input type='hidden' name='Tlf1' value='".$rowb['Tlf1']."' />
	<input type='hidden' name='lastin' value='".$rowb['lastin']."' />
	<input type='hidden' name='lastout' value='".$rowb['lastout']."' />
	<input type='hidden' name='visituser' value='".$rowb['visituser']."' />
			</div>
					
            <div style=\"clear:both\"></div>

		<div class='BorderInf' style=\"margin:4px 0px 2px 0px; padding-bottom:4px;\">
			".$formulariof.$formulariohi."

                <!-- AQUÍ VA LA BOTONERA -->

	<input name='id' type='hidden' value='".$rowb['id']."' />
	<input name='ref' type='hidden' value='".$rowb['ref']."' />
	<input name='Nivel' type='hidden' value='".$rowb['Nivel']."' />
	<input name='Nombre' type='hidden' value='".$rowb['Nombre']."' />
	<input name='Apellidos' type='hidden' value='".$rowb['Apellidos']."' />
	<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
	<input name='Email' type='hidden' value='".$rowb['Email']."' />
	<input name='Usuario' type='hidden' value='".$rowb['Usuario']."' />
	<input name='Password' type='hidden' value='".$rowb['Password']."' />						
	<input name='Direccion' type='hidden' value='".$rowb['Direccion']."' />
	<input name='Tlf1' type='hidden' value='".$rowb['Tlf1']."' />
	<input name='lastin' type='hidden' value='".$rowb['lastin']."' />
	<input name='lastout' type='hidden' value='".$rowb['lastout']."' />
	<input name='visitauser' type='hidden' value='".$rowb['visituser']."' />
                                     
		".$formulariofi.$formulariod."

                <!-- AQUÍ VA LA BOTONERA -->

	<input name='id' type='hidden' value='".$rowb['id']."' />
	<input name='ref' type='hidden' value='".$rowb['ref']."' />
	<input name='Nivel' type='hidden' value='".$rowb['Nivel']."' />
	<input name='Nombre' type='hidden' value='".$rowb['Nombre']."' />
	<input name='Apellidos' type='hidden' value='".$rowb['Apellidos']."' />
	<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
	<input name='Email' type='hidden' value='".$rowb['Email']."' />
	<input name='Usuario' type='hidden' value='".$rowb['Usuario']."' />
	<input name='Password' type='hidden' value='".$rowb['Password']."' />						
	<input name='Direccion' type='hidden' value='".$rowb['Direccion']."' />
	<input name='Tlf1' type='hidden' value='".$rowb['Tlf1']."' />
	<input name='lastin' type='hidden' value='".$rowb['lastin']."' />
	<input name='lastout' type='hidden' value='".$rowb['lastout']."' />
	<input name='visitauser' type='hidden' value='".$rowb['visituser']."' />
                                     
		".$formulariofd."
		</div>");

?>