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
			while($rowautor = mysqli_fetch_assoc($qra)){
				global $autor;
				$autor = "<h6>".$rowautor['Nombre']." ".$rowautor['Apellidos']."</h6>";
				}
			}

	global $contem;
	$contem = substr($rowb['conte'],0,100);
	$contem = $contem." ...&nbsp;
			<form name='ver' name='ver' action=\"news.php#".$rowb['refnews']."\" method='post' >
				<input name='id' type='hidden' value='".$rowb['id']."' />
				<input name='refnews' type='hidden' value='".$rowb['refnews']."' />
				<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
				<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
				<input type='submit' value='LEER MÁS...' />
				<input type='hidden' name='leermas' id=\"".$rowb['refnews']."\" value=1 />
				".$pg."
			</form>";

    global $contep;
	$contep = $rowb['conte'];
	global $autor;
	$contep = $autor.$contep."
	<img src='".$rut."Gch.Img.News/".@$_POST['myimg']."' style=\" width:98%; max-width:700px; height:auto\" />
	<form name='ver' name='ver' action=\"news.php#".$rowb['refnews']."\" method='post' >
				<input type='hidden' name='id' value='".$rowb['id']."' />
				<input type='hidden' name='refnews' value='".$rowb['refnews']."' />
				<input name='refuser' type='hidden' value='".$rowb['refuser']."' />
				<input type='hidden' name='myimg' value='".$rowb['myimg']."' />
				<input type='hidden' name='leermenos' id=\"".$rowb['refnews']."\" value=1 />
				<input type='submit' value='LEER MENOS' />
				".$pg."
			</form>";

	global $refnews;
	$refnews = @$_POST['refnews'];

	if((isset($_POST['leermas'])) && ($refnews == $rowb['refnews'])){
		global $contep;
		global $conte;
		$conte = $contep/*."<div id=\"".$refnews."\"></div>"*/;
		}
	elseif((isset($_POST['leermenos'])) && ($refnews == $rowb['refnews'])){
		global $contem;
		global $conte;
		$conte = $contem/*."<div id=\"".$refnews."\"></div>"*/;
		}
	else{
		global $contem;
		global $conte;
		$conte = $contem/*."<div id=\"".$refnews."\"></div>"*/;
	}

?>