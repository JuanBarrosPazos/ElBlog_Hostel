<?php

// DEFINO LAS VALORACIONES Y LOS CALCULOS.
	if(!$rowb['refart']){ global $refartval;
						  $refartval = $_SESSION['refart'];
								}
	else { global $refartval;
			$refartval = $rowb['refart'];
				}
				
	$sqlval =  "SELECT * FROM `gcb_opiniones` WHERE `refart` = '$refartval'";
	$qval = mysqli_query($db, $sqlval);
	global $num_val;
	$num_val = mysqli_num_rows($qval);

	$valpunt = 0;
	$valpunt2 = 0;

	while($rowval = mysqli_fetch_assoc($qval)){

			//$valpunta = $rowval['valora'];
			//echo $valpunta.", ";
			//var_dump($valpunta);

			global $valpunt;
			$valpunt = $valpunt + $rowval['valora'];

			global $valpunt2;
			$valpunt2 = $valpunt2 + $rowval['precio'];

		}// FIN WHILE

 	global $valpunt;
	if(($valpunt == 0)||($num_val == 0)){	$valpunt = 0;
											$num_val = 0;
											global $valx100;
											$valx100 = 0;
	} else {
		global $valx100;
		$valx100 = round((($valpunt * 100) / ($num_val * 5)), 0);
	
	}

	global $valpunt2;
	if(($valpunt2 == 0)||($num_val == 0)){	$valpunt2 = 0;
											$num_val = 0;
											global $val2x100;
											$val2x100 = 0;
	} else {
		global $val2x100;
		$val2x100 = round((($valpunt2 * 100) / ($num_val * 5)), 0);
	
	}


?>