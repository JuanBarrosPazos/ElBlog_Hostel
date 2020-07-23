<?php

// DEFINO LAS VALORACIONES Y LOS CALCULOS.
	if(!$rowb['refart']){ global $refartval;
						  $refartval = $_SESSION['refart'];
								}
	else { global $refartval;
			$refartval = $rowb['refart'];
				}

	$sqlval =  "SELECT * FROM `gch_opiniones` WHERE `refart` = '$refartval'";
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

	$sqlval0 =  "SELECT * FROM `gch_art` WHERE `refart` = '$refartval'";
	$qval0 = mysqli_query($db, $sqlval0);
	global $rowval0;
	$rowval0 = mysqli_fetch_assoc($qval0);

 	global $valpunt;
	if(($valpunt == 0)||($num_val == 0)){	$valpunt = 0;
											$num_val = 0;
											global $valx100;
											//$valx100 = 0;
											$valx100 = $rowval0['ivalora'];
											global $valmartx100;
											//$valmartx100 = 0;
											$valmartx100 = $_POST['valora'];
	} else {
		global $valx100;
		$valx100 = round((($valpunt * 100) / ($num_val * 5)), 0);
		global $valmartx100;
		$valmartx100 = round((($valpunt * 100) / ($num_val * 5)), 0);
	}

	global $valpunt2;
	if(($valpunt2 == 0)||($num_val == 0)){	$valpunt2 = 0;
											$num_val = 0;
											global $val2x100;
											//$val2x100 = 0;
											$val2x100 = $rowval0['iprecio'];
											global $valmart2x100;
											//$valmart2x100 = 0;
											$valmart2x100 = $_POST['precio'];
	} else {
		global $val2x100;
		$val2x100 = round((($valpunt2 * 100) / ($num_val * 5)), 0);
		global $valmart2x100;
		$valmart2x100 = round((($valpunt2 * 100) / ($num_val * 5)), 0);
	}


?>