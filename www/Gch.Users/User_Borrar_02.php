<?php
session_start();

	//require '../Gch.Inclu/error_hidden.php';
	global $headtot;
	$headtot = "head";
	require 'Inc_Header_Nav_Head_Total.php';
	//require 'Inc_Header_Nav_Head.php';
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// NIVEL PLUS NO TIENE PERMITIDO BORRAR OTROS USUARIOS NI EL MISMO
if ((@$_SESSION['uNivel'] == 'adminu')||(@$_SESSION['uNivel'] == 'useru')||(@$_SESSION['Nivel'] == 'admin')){

	if (isset($_POST['oculto2'])){	show_form();
									info_01();
				$ctemp = "../Gch.Temp";
				if(file_exists($ctemp)){$dir1 = $ctemp."/";
										$handle1 = opendir($dir1);
											while ($file1 = readdir($handle1))
												{if (is_file($dir1.$file1))
													{unlink($dir1.$file1);}
													}	
											//rmdir ($ctemp);
									} else {}
							}
	elseif($_POST['borrar']){ process_form();
							  global $refnorm;
							  $refnorm = $_SESSION['iniref'];
							  info_02();
							  if($_SESSION['uNivel'] == 'useru'){salirf();} else { }
							  global $redir;
							  $redir = "<script type='text/javascript'>
										  function redir(){
										  window.location.href='../index.php';
								  }
								  setTimeout('redir()',6000);
								  </script>";
							  print ($redir);

	} else { show_form(); }
		} else { require '../Gch.Inclu/table_permisos.php'; 
				 //require 'Inc_Footer.php';
				 //require '../Gch.Www/Inc_Jquery_Boots_Foot.php';
					}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


function process_form(){

	global $table;
	$table = "<table align='center'>
				<tr>
					<td colspan=3 class='BorderInf' align='center'>
						SE HA BORRADO ESTE USUARIO.
					</td>
				</tr>
				
				<tr>
					<td width=150px>ID</td>
					<td width=200px>".$_POST['id']."</td>
					
					<td rowspan=5 align='center'>
		<img src='../Gch.Temp/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>USER REF</td>
					<td>".$_POST['ref']."</td>
				</tr>
				
				<tr>
					<td>NIVEL</td>
					<td>".$_POST['Nivel']."</td>
				</tr>
				
				<tr>
					<td>NOMBRE</td>
					<td>".$_POST['Nombre']."</td>
				</tr>

				<tr>
					<td>APELLIDO</td>
					<td>".$_POST['Apellidos']."</td>
				</tr>				
				
				<tr>
					<td>Mail</td>
					<td colspan=2>".$_POST['Email']."</td>
				</tr>
				
				<tr>
					<td>Usuario</td>
					<td colspan=2>".$_POST['Usuario']."</td>
				</tr>
				
				<tr>
					<td>Password</td>
					<td colspan=2>".$_POST['Password']."</td>
				</tr>
				
				<tr>
					<td>Direcci&oacute;n</td>
					<td colspan=2>".$_POST['Direccion']."</td>
				</tr>
				
				<tr>
					<td>TELEFONO 1</td>
					<td colspan=2>".$_POST['Tlf1']."</td>
				</tr>
				
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
						<form name='closewindow' action='User_Modificar_01.php'  \">
							<input type='submit' value='VOLVER' />
							<input type='hidden' name='volver' value=1 />
						</form>
					</td>
				</tr>
			</table>";	

	global $db;
	global $db_name;
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	// BORRAMOS EL USUARIO
	$sql = "DELETE FROM `$db_name`.`gch_user` WHERE `gch_user`.`id` = '$_POST[id]' LIMIT 1 ";
	// SI SE CUMPLE EL QUERY
	if(mysqli_query($db, $sql)){
	
	global $ctemp;
	$ctemp = "../Gch.Temp";
	global $imgorg;
	$imgorg = "../Gch.Img.User/".$_POST['myimg'];
	
	if (!file_exists($ctemp)) {
		mkdir($ctemp, 0777, true);
		copy($imgorg, $ctemp."/".$_POST['myimg']);
	}else{
		copy($imgorg, $ctemp."/".$_POST['myimg']);
				}

	print ($table); // SE IMPRIME LA TABLA DE CONFIRMACION

	unlink("../Gch.Img.User/".$_POST['myimg']);

	/* CAMBIAMOS LA REFERENCIA DEL USUARIO BORRADO EN LA TABLA OPINIONES POR ADMINDEL */
	global $tablenameb;
	$tablenameb = "gch_opiniones";
	$tablenameb = "`".$tablenameb."`";
	$sqlab = "UPDATE `$db_name`.$tablenameb SET `refuser` = 'userdel' WHERE $tablenameb.`refuser` = '$_SESSION[delrefart]' ";
	if(mysqli_query($db, $sqlab)){
				global $modifref;
				$modifref = "Tabla Opiniones Modif ref user x userdel";
	} else { print("<font color='#FF0000'>L159: </font></br>&nbsp;&nbsp;".mysqli_error($db))."</br>"; 
				global $modifref;
				$modifref = "Error: Tabla Opiniones Modif ref user ".mysqli_error($db);
			}

	} // FIN PRIMER IF SI SE BORRA EL USER DE LA BBDD
	  // => ELSE BORRADO NO OK PRIMER QUERY
		else {print("<font color='#FF0000'>SE HA PRODUCIDO UN ERROR: </font>
					</br>&nbsp;&nbsp;".mysqli_error($db))."</br>";
					show_form ();
					global $texerror;
					$texerror = "ERROR BORRADO USER L.162\n\t ".mysqli_error($db);
					}
	
	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
					
function show_form(){

	if($_POST['oculto2']){
				$_SESSION['delrefart'] = $_POST['ref'];
				$defaults = array ( 'id' => $_POST['id'],
									'ref' => $_POST['ref'],
									'Nivel' => $_POST['Nivel'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $_POST['myimg'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],);
								   		}
	if(isset($_POST['borrar'])){
				$defaults = array ( 'id' => $_POST['id'],
									'ref' => $_POST['ref'],
									'Nivel' => $_POST['Nivel'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $_POST['myimg'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],);
								   		}
								   
	print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<td colspan=3 class='BorderInf' align='center'>
						<font color='#FF0000'>
						SE BORRARÁN ESTOS DATOS DEL REGISTRO.
						</br>
						TODAS LAS TABLAS Y DIRECTORIOS.
						</br>
						NO SE PODRÁN VOLVER A RECUPERAR.
						</font>
					</td>
				</tr>
				<tr>
					<td colspan=3 align='right' class='BorderInf'>
						<form name='closewindow' action='User_Modificar_01.php'>
							<input type='submit' value='CANCELAR Y VOLVER' />
							<input type='hidden' name='volver' value=1 />
						</form>
					</td>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
				<input name='id' type='hidden' value='".$defaults['id']."' />					
				<input name='ref' type='hidden' value='".$defaults['ref']."' />					
		<tr>
			<td width=120px>	
						NIVEL
			</td>
			<td width=100px>
				".$defaults['Nivel']."
				<input  type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
			</td>
			
			<td rowspan='5' align='center' width='94px'>
<img src='../Gch.Img.User/".$_POST['myimg']."' height='120px' width='90px' />
						<input name='myimg' type='hidden' value='".$_POST['myimg']."' />

			</td>
		</tr>
					
		<tr>
			<td>	
				NOMBRE
			</td>
			<td>
				".$defaults['Nombre']."
				<input  type='hidden' name='Nombre' value='".$defaults['Nombre']."' />
			</td>
		</tr>
					
		<tr>
			<td>
				APELLIDOS
			</td>
			<td>
				".$defaults['Apellidos']."
				<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
			</td>
		</tr>
				
		<tr>
			<td>
				MAIL
			</td>
			<td>
				".$defaults['Email']."
				<input type='hidden'' name='Email' value='".$defaults['Email']."' />
			</td>
		</tr>	
				
		<tr>
			<td>
				USUARIO
			</td>
			<td>
				".$defaults['Usuario']."
				<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
			</td>
		</tr>
							
		<tr>
			<td>
				PASSWORD
			</td>
			<td colspan='2'>
				".$defaults['Password']."
				<input type='hidden' name='Password' value='".$defaults['Password']."' />
			</td>
		</tr>

		<tr>
			<td>
				DIRECCION
			</td>
			<td colspan='2'>
				".$defaults['Direccion']."
				<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
			</td>
		</tr>
				
		<tr>
			<td>
				TELEFONO
			</td>
			<td colspan='2'>
				".$defaults['Tlf1']."
				<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
			</td>
		</tr>
				
		<tr align='right'>
			<td colspan='3'>
				<input type='submit' value='ELIMINAR DATOS PERMANENTEMENTE' />
				<input type='hidden' name='borrar' value=1 />
			</td>
		</tr>
	</form>														
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
						<form name='closewindow' action='User_Modificar_01.php'>
							<input type='submit' value='CANCELAR Y VOLVER' />
							<input type='hidden' name='volver' value=1 />
						</form>
					</td>
				</tr>
		</table>"); 
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_02(){

	global $modifref;
	global $texerror;

	global $imgorg;
	global $delimguser;
	if (!file_exists($imgorg)) {$delimguser = "BORRADA IMAGEN USER => ".$imgorg; }
	else { $delimguser = "ERROR BORRADO IMAGEN USER => ".$imgorg; }

	$ActionTime = date('H:i:s');

	global $logtext;	
	$logtext = PHP_EOL."- USER BORRARDO ".$ActionTime.PHP_EOL."\t ID: ".$_POST['id'].PHP_EOL."\t Nombre: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t Ref: ".$_POST['ref'].". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'].$delimguser.PHP_EOL.$modifref.PHP_EOL.$texerror.PHP_EOL;

    require 'Inc_Log_Total.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_01(){

	$ActionTime = date('H:i:s');

	global $logtext;	
	$logtext = PHP_EOL."- USER WEB BORRAR SELECCIONADO ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t Ref: ".$_POST['ref'].". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'].PHP_EOL;

    require 'Inc_Log_Total.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	require 'Inc_Footer.php';

	require '../Gch.Www/Inc_Jquery_Boots_Foot.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>
