<?php

global $text;
$text = "<tr>
			<td align='center'>
				<font color='#FF0000'>
					SUS DATOS SE GESTIONAN DESDE LA ZONA ADMIN
					<br>
					SOLO PUEDE CONSULTAR USUARIOS BÁSICOS
				</font>
			</td>
		</tr>";

	if(!$qb){
			print("<font color='#FF0000'>
				Se ha producido un error: ".mysqli_error($db)." </font></br>");
			//show_form();	
	} else {
			
		if(mysqli_num_rows($qb)== 0){
			if($_SESSION['uNivel'] == 'adminu'){ echo "<table align='center'>";
												 global $text;
												 echo $text;
												 echo "</table>";		
			} else {
				print ("<table align='center' style=\"border:0px\">
						<tr>
							<td align='center'>
								<font color='#FF0000'>
									NO HAY DATOS
								</font>
							</td>
						</tr>
					</table>");
				}

		} else {
			if($_SESSION['uNivel'] == 'adminu'){ echo "<table align='center'>";
												 global $text;
												 echo $text;
												 echo "</table>
									<table align='center'>
										<tr>
									<td colspan=7 class='BorderInf' align='center'>
						".$twhile.": ".mysqli_num_rows($qb).".
									</td>
										</tr>";												 		
												}	
					else { print ("<table align='center'>"); }	
			print ("<tr>
						<td class='BorderInfDch' align='center'>
							Nivel
						</td>
								
						<td class='BorderInfDch' align='center'>
							Referencia
						</td>
										
						<td class='BorderInfDch' align='center'>
							Nombre
						</td>
								
						<td class='BorderInfDch' align='center'>
							Apellidos
						</td>
										
						<td class='BorderInfDch' align='center'>
						</td>
										
						<td class='BorderInfDch' align='center'>
							Usuario
						</td>
										
						<td class='BorderInfDch' align='center'>
							Password
						</td>
                    </tr>");
                                    
	while($rowb = mysqli_fetch_assoc($qb)){
    
    global $formularioh;
    global $formulariof;
	global $formulariohi;
	global $formulariofi;

	print (	"<tr align='center'>".$formularioh."

            <!-- AQUÍ VA LA CABECERA DEL FORMULARIO -->

	<input name='id' type='hidden' value='".$rowb['id']."' />
						
				<td class='BorderInfDch'>
	<input name='Nivel' type='hidden' value='".$rowb['Nivel']."' />".$rowb['Nivel']."
				</td>
							
				<td class='BorderInfDch'>
	<input name='ref' type='hidden' value='".$rowb['ref']."' />".$rowb['ref']."
				</td>
							
				<td class='BorderInfDch'>
	<input name='Nombre' type='hidden' value='".$rowb['Nombre']."' />".$rowb['Nombre']."
				</td>
							
				<td class='BorderInfDch'>
	<input name='Apellidos' type='hidden' value='".$rowb['Apellidos']."' />".$rowb['Apellidos']."
				</td>
						
				<td class='BorderInfDch'>
	<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
	<img src='../Gch.Img.User/".$rowb['myimg']."' height='40px' width='30px' />
				</td>
												
	<input name='Email' type='hidden' value='".$rowb['Email']."' />
													
				<td class='BorderInfDch'>
	<input name='Usuario' type='hidden' value='".$rowb['Usuario']."' />".$rowb['Usuario']."
				</td>
						
				<td class='BorderInfDch'>
	<input name='Password' type='hidden' value='".$rowb['Password']."' />".$rowb['Password']."
				</td>
						
	<input name='Direccion' type='hidden' value='".$rowb['Direccion']."' />
	<input name='Tlf1' type='hidden' value='".$rowb['Tlf1']."' />
	<input name='lastin' type='hidden' value='".$rowb['lastin']."' />
	<input name='lastout' type='hidden' value='".$rowb['lastout']."' />
	<input name='visituser' type='hidden' value='".$rowb['visituser']."' />
			</tr>
					
            <tr>".$formulariof.$formulariohi."

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
	<input name='visitauser' type='hidden' value='".$rowb['visitauser']."' />
                                     
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
	<input name='visitauser' type='hidden' value='".$rowb['visitauser']."' />
                                     
		".$formulariofd."</tr>");
                    
	 }  // FIN DEL WHILE

	    print("</table>");
			
			} 
		} 

?>