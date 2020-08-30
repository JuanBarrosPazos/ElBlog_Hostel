<?php

///////////////////////////////////////////////////////////////////////////////////////////////

	if(isset($_POST['ocultomail'])){
			if($form_errors = validate_form()){
						show_form($form_errors);
										
			} else {process_Mail();
					//show_form();
					   }
					}	/* Fin del if $_POST['ocultomail']*/
										
			else {show_form();}
												
/////////////////////////////////////////////////////////////////////////////////////////

 function validate_form(){
	 
	 $errors = array();
		
	/* Validamos el campo Nombre. */
	
		if(strlen(trim($_POST['nombre'])) == 0){
		$errors [] = "NOMBRE: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
	
	elseif (strlen(trim($_POST['nombre'])) < 3 ){
		$errors [] = "NOMBRE: <font color='#FF0000'>MÁS DE 2 CARACTÉRES</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['nombre'])){
		$errors [] = "NOMBRE: <font color='#FF0000'>SÓLO TEXTO</font>";
		}
		
	/* Validamos el campo Apellidos. */
	
		if(strlen(trim($_POST['apellidos'])) == 0){
		$errors [] = "APELLIDOS: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
	
	elseif (strlen(trim($_POST['apellidos'])) < 3 ){
		$errors [] = "APELLIDOS: <font color='#FF0000'>MÁS DE 2 CARACTÉRES</font>";
		}
		
	elseif (!preg_match('/^[^0-9@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:\.\*]+$/',$_POST['apellidos'])){
		$errors [] = "APELLIDOS: <font color='#FF0000'>SÓLO TEXTO</font>";
		}

    /* Validamos el campo telefono. */

	if(strlen(trim($_POST['tlf'])) == 0){
		$errors [] = "TLF: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
        }
        
	elseif (!preg_match('/^[\d]+$/',$_POST['tlf'])){
		$errors [] = "TLF: <font color='#FF0000'>SÓLO NÚMEROS</font>";
		}

	elseif (strlen(trim($_POST['tlf'])) < 9){
		$errors [] = "TLF: <font color='#FF0000'>MÍNIMO 9 NÚMEROS</font>";
		}


        /* Validamos el campo mail. */
	
	if(strlen(trim($_POST['Email'])) == 0){
		$errors [] = "EMAIL: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
	
	elseif (strlen(trim($_POST['Email'])) < 5 ){
		$errors [] = "EMAIL: <font color='#FF0000'>MÁS DE 5 CARACTÉRES</font>";
		}
		
	elseif (!preg_match('/^[^@#$&%<>:"·\(\)=¿?!¡\[\]\{\};,:*\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/',$_POST['Email'])){
		$errors [] = "EMAIL: <font color='#FF0000'>DIRECCIÓN NO VÁLIDA</font>";
		}

	/* Validamos el campo FECHA HORA COMENSALES. */
	
    if(strlen(trim($_POST['fecha'])) == 0){
		$errors [] = "FECHA: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

    if(strlen(trim($_POST['hora'])) == 0){
		$errors [] = "HORA: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

    if(strlen(trim($_POST['numero'])) == 0){
		$errors [] = "COMENSALES: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}

	/* Validamos el campo Mensaje. */
	
		if(strlen(trim($_POST['mensaje'])) == 0){
		$errors [] = "COMENT. <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
	
	elseif (strlen(trim($_POST['mensaje'])) < 30 ){
		$errors [] = "COMENT. <font color='#FF0000'>MÁS DE 30 CARACTÉRES</font>";
		}
		
	elseif (!preg_match('/^[^$<>\[\]\{\}]+$/',$_POST['mensaje'])){
		$errors [] = "COMENT. <font color='#FF0000'>NO PERMITIDOS $<>[]{}</font>";
		}

	return $errors;
	
 			}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=''){
	
	if(isset($_POST['ocultomail'])){
				$defaults = $_POST;
									} 
		else {	$defaults = array (	'nombre' => isset($_POST['nombre']),
									'apellidos' => isset($_POST['apellidos']),
									'Email' => isset($_POST['Email']),	
                                    'tlf' => isset($_POST['tlf']),
									'asunto' => 'RESERVA DE MESA',	
                                    'fecha' => isset($_POST['fecha']),
                                    'hora' => isset($_POST['hora']),
                                    'numero' => isset($_POST['numero']),
                                    'mensaje' => isset($_POST['mensaje']),
                                    'portfolio' => isset($_POST['portfolio']),
                                    'mailto' => isset($_POST['mailto']),
                                                        );
        									}
	
	if ($errors){
		
    print("<div style=\"clear:both; display: block; margin: -6.6em 0em 5.4em 0em;\" id=\"anclaform\"></div>
    <div class=\"row\">
            <div class=\"juancentraerror\">
                <div style=\"display: block;\">
                        <font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font>
                </div>
                <div style=\"display: block; text-align: left;\">");
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FFFFFF'>* </font>".$errors [$a]."<br/>");
                    }
    print("</div>
                </div>
                    </div>");
				}
    else { 
        print ("<div style=\"clear:both; display: block; margin: -6.8em 0em 7.2em 0em;\" id='formlink' >
        </div>");
            }

	//echo $_SESSION['mailto'];
	 
print("<div class=\"row\">
            <div class=\"col-lg-12 text-center\" style=\"margin:0.6em 0em 2em 0em;\">
  <h2 class=\"section-heading text-uppercase\" style=\"text-align: center; margin: -1.6em 0em 0.3em 0em\">
          FORMULARIO DE RESERVAS
  </h2>

    <div class=\"juancentramail\">
        <form name='contacto' method='post' action='$_SERVER[PHP_SELF]#anclaform'>
        <div style=\"display: block;\">
            <input name='nombre' id='nombre' type='text' size='31' maxlength='35' placeholder=\"&nbsp;NOMBRE\" value='".$defaults['nombre']."'/>
        </div>

        <div style=\"display: block;\">
            <input name='apellidos' id='apellidos' type='text' size='31' maxlength='35' placeholder=\"&nbsp;APELLIDOS\" value='".$defaults['apellidos']."'/>
        </div>

        <div style=\"display: block;\">
            <input name='Email' id='Email' type='text' size='31' maxlength='40' placeholder=\"&nbsp;SU EMAIL\" value='".$defaults['Email']."'/>
        </div>

        <div style=\"display: block;\">
            <input name='tlf' id='tlf' type='text' size='31' maxlength='9' placeholder=\"&nbsp;TELEFONO CONTACTO\" value='".$defaults['tlf']."'/>
        </div>

        <input name='asunto' type='hidden' id='asunto' value='RESERVA DE MESA'/>
        <input name='portfolio' type='hidden' id='portfolio' value='".$_SESSION['refartop']."'/>
        <input name='mailto' type='hidden' id='portfolio' value='".$_SESSION['mailto']."'/>
		      
        <div style=\"display: block; text-align: left;\">
            <label for='fecha'>FECHA </label>
            <input id='fecha' name='fecha' type='date' value='".$defaults['fecha']."'>
        </div>

        <div style=\"display: inline-block; text-align: left;\">
            <label for='hora'>HORA </label>
            <input id='hora' name='hora' type='time' value='".$defaults['hora']."'>
        </div>

        <div style=\"display: inline-block; text-align: left;\">
            <label for='numero'>COMENSALES </label>
            <input id='numero' name='numero' type='number' min='2' max='20' step='1' size='4' value='".$defaults['numero']."'>
        </div>

        <div style=\"display: block;\">
<textarea onkeypress='return limita(event, 200)' onkeyup='actualizaInfo(200)' name='mensaje' id='mensaje' cols='34' rows='6' placeholder=\"&nbsp;COMENTARIOS ADICIONALES\">".$defaults['mensaje']."</textarea>
       </div>

 		<div id=\"info\" style=\"display: block; text-align: center; color: #343434;\">
			  		Maximum 200 characters            
		</div>          

        <div style=\"display: block; text-align: center;\">
            <input type='submit' value='ENVIAR FORMULARIO DE RESERVAS' />
			<input type='hidden' name='ocultomail' value=1 />
        </div>
    </form>	
    </div>
    
          </div>
    </div>"); /* Fin del print */

	}	/* Fin de la función show_form(); */

/////////////////////////////////////////////////////////////////////////////////////////////////

 function process_Mail(){	

	global $mail_from;
    $mail_from = $_POST['mailto'];
    //echo $mail_from;

	 $text_body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
						<html>
						<head>
						<title>Untitled Document</title>
						<meta http-equiv="content-type" content="text/html" charset="utf-8" />
						<meta http-equiv="Content-Language" content="es-es">
						<META NAME="Language" CONTENT="Spanish">
						</head>
						
						<body bgcolor="#D7F0E7">
						
						<STYLE>
						body {
							font-family: "Times New Roman", Times, serif;
						}
						body a {
							text-decoration:none;
						}
						table a {
							color: #666666;
							text-decoration: none;
							font-family: "Times New Roman", Times, serif;
						}
						table a:hover {
							color: #FF9900;
							text-decoration: none;
						}
						tr {
							margin: 0px;
							padding: 0px;
						}
						td {
							margin: 0px;
							padding: 6px;
						}
						th {
							padding: 6px;
							margin: 0px;
							text-align: center;
							color: #666666;
						}
						
						</STYLE>

	<table font-family="Times New Roman" width="600px" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<th colspan="3">FORMULARIO DE RESERVAS '.$_SESSION['titulo'].'</th>
						  </tr>
						  <tr>
							<td align="right" width="40px">Asunto:</td>
							<td width="12" width="12px">&nbsp;</td>
							<td align="left">'.$_POST['asunto'].'</td>
						  </tr>
						  <tr>
						  <tr>
							<td align="right">Nombre:</td>
							<td width="12">&nbsp;</td>
							<td align="left">'.$_POST['nombre'].'</td>
						  </tr>
						  <tr>
							<td align="right">Apellidos:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['apellidos'].'</td>
						  </tr>
						  <tr>
							<td align="right">Email:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['Email'].'</td>
						  </tr>
						  <tr>
							<td align="right">Teléfono:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['tlf'].'</td>
						  </tr>
						  <tr>
							<td align="right">Fecha:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['fecha'].'</td>
						  </tr>
						  <tr>
							<td align="right">Hora:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['hora'].'</td>
						  </tr>
						  <tr>
							<td align="right">Comensales:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['numero'].'</td>
						  </tr>
						  <tr>
							<td align="right" valign="top">Mensaje:</td>
							<td>&nbsp;</td>
							<td align="left">'.$_POST['mensaje'].'</td>
						  </tr>
					</table>
						</body>
							</html>';
			
	$headers = array ('From' => $mail_from,
					  'Subject' => $_POST['asunto']);
					  
		# datos del mensaje
	 
				global $destinatario;
				$destinatario = $mail_from; /*../INCLU/MISDATOS.PHP // MISDATOS.PHP */
				$titulo= $_POST['asunto']." ".$_POST['nombre']." ".$_POST['apellidos'].".";
				$responder= $_POST['Email'];
				$remite= $_POST['Email'];
				$remitente= $_POST['nombre']." ".$_POST['apellidos']."."; //sin tilde para evitar errores de servidor

				$separador = "_separador".md5 (uniqid (rand()));
				
		# cabecera
				global $cabecera;
				$cabecera = "Date: ".date("l j F Y, G:i")."\n";
				$cabecera .="MIME-Version: 1.0\n";
				$cabecera .="From: ".$remitente."<".$destinatario.">\n";
				$cabecera .="Return-path: ". $remite."\n";
				$cabecera .="Reply-To: ".$responder."\n";
				$cabecera .="X-Mailer: PHP/". phpversion()."\n";
				$cabecera .="Content-Type: multipart/mixed;"."\n";
				
				$cabecera .= " boundary=$separador"."\r\n\r\n";	/**/
				
	 			global $texto_html;
				$texto_html ="\n"."--$separador"."\n";			/**/
				$texto_html .="Content-Type:text/html; charset=\"utf-8\""."\n";
				$texto_html .="Content-Transfer-Encoding: 7bit"."\r\n\r\n";
				
				# Añado la cadena que contiene el mensaje
				$texto_html .= $text_body;
				
				/* Le pasamos a la variable $mensaje el valor de $texto_html*/
	 			global $mensaje;
				$mensaje= $texto_html;
				
	if( mail($destinatario, $titulo, $mensaje, $cabecera)){

        print("<div style=\"clear:both; display: block; margin: -6.8em 0em 5.4em 0em;\" id=\"anclaform\"></div>
                    <table align='center' style=\"margin-top:2px; margin-bottom: 6.6em\">
						<tr>
						    <td align='center'>
								<font color='#0080C0'>
									SU MENSAJE HA SIDO ENVIADO.
									<br/>
									MUCHAS GRACIAS. ".$_POST['nombre']." ".$_POST['apellidos'].".
								</font>
							</td>
						 </tr>
						<tr>
							<td align='center'>
								<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
                                    Juan Barros Pazos 2020
								</a>
							</td>
						</tr>
					<table>");
        }
        
    else{   global $head_footer;
            
    print("<div style=\"clear:both; display: block; margin: -6.8em 0em 5.4em 0em;\" id=\"anclaform\"></div>
            <table align='center' style=\"margin-top:2px;margin-bottom:8.6em\">
						<tr>
							<td align='center'>
								<font color='#FF0000'>
									EL MENSAJE NO HA PODIDO ENVIARSE,<br>
									".$_POST['nombre']." ".$_POST['apellidos'].".<br>
									MUCHAS GRACIAS.
								</font>
							</td>
						</tr>
						<tr>
							<td align='center'>
								<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
                                    Juan Barros Pazos 2020
								</a>
							</td>
						</tr>
					<table>");
			show_form();											
					} /*Fin del if del mail*/
														
	 		}	/* Fin funcion process_Mail(); */
			
/////////////////////////////////////////////////////////////////////////////////////////////////
	
/* Creado por Juan Barros Pazos 2020 */
?>

<div style="clear:both"></div>

</body>
</html>