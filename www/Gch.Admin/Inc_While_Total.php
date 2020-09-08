<?php

	if(!$qb){
		print("<font color='#FF0000'>
				* ERROR: </font>".mysqli_error($db)."</br></br>");
					
		//show_form();	
			
		} else {
			
		if(mysqli_num_rows($qb)== 0){
			print ("<table align='center' style=\"border:0px\">
						<tr>
							<td align='center'>
								<font color='#FF0000'>
									NO HAY DATOS
								</font>
							</td>
						</tr>
					</table>");
		} else { 
			print ("<div class=\"BorderSup\" style=\"text-align:center; display:block; margin-top:8px; padding: 10px 0px 10px 0px; border-top: #fff solid 1px;\">

			<div style=\"text-align:center; display:block;\">
					".$twhile." ".mysqli_num_rows($qb).".
			</div>");
                                    
	while($rowb = mysqli_fetch_assoc($qb)){
    
		global $formularioh;
		global $formulariof;
		global $formulariohi;
		global $formulariofi;

	print (	"<div class=\"BorderSup\" style=\"text-align:center; display:block; margin-top:8px; padding-top: 0px; border-top: #fff solid 1px;\">

            <!-- AQUÍ VA LA CABECERA DEL FORMULARIO -->

				<div class='whiletotala'>
						NIVEL<br>".strtoupper($rowb['Nivel'])."
				</div>
							
				<div class='whiletotala'>
						REF<br>".strtoupper($rowb['ref'])."
				</div>
							
				<div class='whiletotala'>
						NOMBRE<br>".strtoupper($rowb['Nombre'])."
				</div>
							
				<div class='whiletotala'>
						APELLIDOS<br>".strtoupper($rowb['Apellidos'])."
				</div>
						
				<div class='whiletotala'>
	<img src='../Gch.Img.Admin/".$rowb['myimg']."' height='40px' width='30px' />
				</div>
												
				<div class='whiletotala '>
						USUARIO<br>".$rowb['Usuario']."
				</div>
						
				<div class='whiletotala '>
						PASSWORD<br>".$rowb['Password']."
				</div>
		</div>
		
		<div class=\"BorderInf\" style=\"text-align:center; display:block;\">

		<form name='ver' action='Admin_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=340px,height=620px')\" class='whiletotala'>

		");

			require 'Inc_Admin_While_Total_Rows.php';
	
		print("	<input type='submit' value='VER DETALLES' />
				<input type='hidden' name='oculto2' value=1 />
			</form>

		<form name='modifica' action='Admin_Modificar_02.php' method='POST' class='whiletotala'>

		");

			require 'Inc_Admin_While_Total_Rows.php';
	
		print("	<input type='submit' value='MODIFICA DATOS' />
				<input type='hidden' name='oculto2' value=1 />
		</form>

		<form name='borra' action='Admin_Borrar_02.php' method='POST' class='whiletotala'>
			
		");

			require 'Inc_Admin_While_Total_Rows.php';
	
		print(" <input type='submit' value='BORRAR DATOS' />
				<input type='hidden' name='oculto2' value=1 />
		</form>

	<form name='modifica_img' action='Admin_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=540px,height=370px')\" class='whiletotala'>

                <!-- AQUÍ VA LA BOTONERA -->

		");

			require 'Inc_Admin_While_Total_Rows.php';
	
		print("	<input type='submit' value='MODIFICA IMAGEN' />
				<input type='hidden' name='oculto2' value=1 />
			</form>

		</div>");
                    
	}  // FIN DEL WHILE

	    print("</div>");
			
		} 
	} 

?>