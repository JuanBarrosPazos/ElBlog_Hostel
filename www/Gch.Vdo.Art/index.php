<?php

	//require '../Gch.Inclu/error_hidden.php';
	require '../Gch.Inclu/Admin_Inclu_01a.php';

//////////////////////////////////////////////////////////////////////////////////////////////

print ("<table align='center'>
			<tr>
				<td align='center'>
					<h2>ACCESO RESTRINGIDO</h2>
					<h4>
						<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
								JUAN BARROS PAZOS
						</a>
					</h4>
				</td>
			</tr>
		</table>");

global $redir;
// 600000 microsegundos 10 minutos
// 60000 microsegundos 1 minuto
$redir = "<script type='text/javascript'>
                function redir(){
                window.location.href='../index.php';
            }
            setTimeout('redir()',2000);
            </script>";
print ($redir);

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Gch.Inclu/Admin_Inclu_02.php';
	
/////////////////////////////////////////////////////////////////////////////////////////////////

/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>