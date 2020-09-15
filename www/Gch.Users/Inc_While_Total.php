<?php

global $text;
$text = "<table align='center' style=\"margin-top:-16px;\">
			<tr>
				<td align='center'>
					<font color='#FF0000'>
						SUS DATOS SE GESTIONAN DESDE LA ZONA ADMIN
						<br>
						SOLO PUEDE CONSULTAR USUARIOS BÁSICOS
					</font>
				</td>
			</tr>
		</table>";

	if(!$qb){
			print("<font color='#FF0000'>
				Se ha producido un error: ".mysqli_error($db)." </font></br>");
			//show_form();	
	} else {
			
		if(mysqli_num_rows($qb)== 0){
			if(@$_SESSION['uNivel'] == 'adminu'){ global $text;
												  echo $text;		
			} else { }

			print ("<table align='center' style=\"border:0px\">
						<tr>
							<td align='center'>
								<font color='#FF0000'>
									NO HAY DATOS
								</font>
							</td>
						</tr>
					</table>");

			global $winclose;
			echo "$winclose";

		} else {
			if(@$_SESSION['uNivel'] == 'adminu'){ global $text;
												  echo $text;

			echo "<div class=\"juancentra col-xs-12 col-sm-12 col-lg-6\" style=\"margin-bottom: 12px;\">
						<div style=\"text-align:center; display:inline-block; width:100%;\" class='BorderInf'>
							".$twhile.": ".mysqli_num_rows($qb).".
						</div>";												 		
			} else { 
				global $winclose;
				echo "$winclose";
			
				print ("<div class=\"juancentra col-xs-12 col-sm-12 col-lg-6\" style=\"border: solid 1px #343434;\">"); 
				}	
                                    
	while($rowb = mysqli_fetch_assoc($qb)){
    
    global $formularioh;
    global $formulariof;
	global $formulariohi;
	global $formulariofi;
	global $formulariod;
	global $formulariofd;

	require 'Inc_While_Total_Datos.php';

	 }  // FIN DEL WHILE

		print("</div>");
		
	 global $winclose;
	 echo "$winclose";
 
			
			} 
		} 

?>