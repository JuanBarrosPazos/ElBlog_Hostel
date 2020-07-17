<?php

	if ($page > 1){
		global $pg;
		$pg = "<input type='hidden' name='page' value=".$page." />";
	}else{	global $pg;
			$pg = "<input type='hidden' name='page' value=1 />";
			}

	global $db;
	$sqlra =  "SELECT * FROM `gch_admin` WHERE `ref`='$rowb[refuser]' LIMIT 1 ";
	$qra = mysqli_query($db, $sqlra);
	
	if(!$qra){ print("* ".mysqli_error($db)."</br>");
	} else { 
			while($rowaut = mysqli_fetch_assoc($qra)){
				global $autor;
				$autor = "<h6>".$rowaut['Nombre']." ".$rowaut['Apellidos']."</h6>";
				}
			}

	$sqlra2 =  "SELECT * FROM `gch_art` WHERE `refart`='$rowb[refart]' LIMIT 1 ";
	$qra2 = mysqli_query($db, $sqlra2);
	
	if(!$qra2){ print("* ".mysqli_error($db)."</br>");
	} else { 
		while($rowaut2 = mysqli_fetch_assoc($qra2)){
			global $mapa;
			$mapa = "<a style=\"display: inline-block;\" href=\"".$rowaut2['map']."\" target=\"_blank\">VER MAPA ONLINE</a>";
			global $calle;
			$calle = "C/. ".$rowaut2['calle']." &nbsp;&nbsp;".$mapa." <br>";
			global $url;
			$url = "<a style=\"display: inline-block;\" href=\"".$rowaut2['url']."\" target=\"_blank\">WEB SITE</a>&nbsp;&nbsp;";
			global $email;
			$email = "<a style=\"display: inline-block;\" href=\"Gch.Www/portfolio.php?portfolio=".$rowb['refart']."#formlink\">FORMULARIO RESERVAS</a>";
			global $tlf;
			$tlf = "<br>Tfl: ".$rowaut2['Tlf1']." / ".$rowaut2['Tlf2']."<br>";
				}
			}

	global $veropina;
	$veropina = "<form style=\"display: inline-block;\" name='veropina' action='Gch.Syst/Opina_Cliente_Ver.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=420px, height=580px')\">
		<input name='refart' type='hidden' value='".$rowb['refart']."' />
		<input name='tit' type='hidden' value='".$rowb['tit']."' />
		<input name='isla' type='hidden' value='ISLA ".$islaname."' />
		<input name='ayto' type='hidden' value='AYUNTAMIENTO ".@$aytoname."' />
		<input type='submit' value='OPINIONES' />
		<input type='hidden' name='oculto2' value=1 />
	</form>";
	global $opina;
	$opina = "<form style=\"display: inline-block;\" name='creaopina' action='Gch.Syst/Opina_Cliente.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=420px, height=580px')\">
		<input name='id' type='hidden' value='".$rowb['id']."' />
		<input name='refart' type='hidden' value='".$rowb['refart']."' />
		<input name='tit' type='hidden' value='".$rowb['tit']."' />
		<input name='titsub' type='hidden' value='".$rowb['titsub']."' />
		<input name='isla' type='hidden' value='".$rowb['refisla']."' />
		<input name='ayto' type='hidden' value='".$rowb['refayto']."' />
		<input name='myimg1' type='hidden' value='".$rowb['myimg1']."' />
		<input type='submit' value='VALORAR' />
		<input type='hidden' name='oculto2' value=1 />
	</form>";
	global $contem;
	//$contem = substr($rowb['conte'],0,100);
	$contem = "";
	$contem = $contem."<!-- ...&nbsp; -->
	".$veropina.$opina."<form style=\"display: inline-block;\" name='ver' name='ver' action=\"index.php#".$rowb['refart']."\" method='post' >
				<input name='id' type='hidden' value='".$rowb['id']."' />
				<input name='refart' type='hidden' value='".$rowb['refart']."' />
				<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
				<input name='myimg1' type='hidden' value='".$rowb['myimg1']."' />
				<input type='submit' value='LEER MÁS...' />
				<input type='hidden' name='leermas' id=\"".$rowb['refart']."\" value=1 />
				".$pg."
			</form>";

    global $contep;
	$contep = $rowb['conte'];
	$contep = /*$autor.*/$calle.$url.$email.$tlf.$contep."
	<img src='".$rut."Gch.Img.Art/".@$_POST['myimg1']."' style=\" width:98%; max-width:700px; height:auto\" />
	".$veropina.$opina."<form style=\"display: inline-block;\" name='ver' name='ver' action=\"index.php#".$rowb['refart']."\" method='post' >
				<input type='hidden' name='id' value='".$rowb['id']."' />
				<input type='hidden' name='refart' value='".$rowb['refart']."' />
				<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
				<input type='hidden' name='myimg1' value='".$rowb['myimg1']."' />
				<input type='hidden' name='leermenos' id=\"".$rowb['refart']."\" value=1 />
				<input type='submit' value='LEER MENOS' />
				".$pg."
			</form>";

	global $refart;
	$refart = @$_POST['refart'];

	if((isset($_POST['leermas'])) && ($refart == $rowb['refart'])){
		global $contep;
		global $conte;
		$conte = $contep/*."<div id=\"".$refart."\"></div>"*/;
		}
	elseif((isset($_POST['leermenos'])) && ($refart == $rowb['refart'])){
		global $contem;
		global $conte;
		$conte = $contem/*."<div id=\"".$refart."\"></div>"*/;
		}
	else{
		global $contem;
		global $conte;
		$conte = $contem/*."<div id=\"".$refart."\"></div>"*/;
	}

?>