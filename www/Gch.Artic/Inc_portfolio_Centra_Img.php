<?php

	/*
		METODO CON LA SUPER GLOBAL Y EL VALOR GET DEL SCREEN.W
		SE APROXIMA PARA AJUSTARSE A LA PANTALLA Y COMPENSAR EL GIRO
	*/

	global $wancho;
	$wancho = $_SESSION['wancho'];

	global $wwref;

	if ($wancho >= 1200){ $wwref = 280; }
	elseif (($wancho < 1200)&&($wancho >= 992)){ $wwref = 230; }
	elseif (($wancho < 992)&&($wancho >= 768)){ $wwref = 170; }
	elseif (($wancho < 768)&&($wancho >= 576)){ $wwref = 260; }
	elseif (($wancho < 576)&&($wancho > 360)){ $wwref = 540; }
	elseif ($wancho <= 360){ $wwref = 310; }
	else { $wwref = 260; }

		////////////////////		**********  		////////////////////
	
	global $ancho1;
    global $alto1;
    list($ancho1, $alto1, $tipo1, $atributos1) = getimagesize("../Gch.Img.Art/".$rowb['myimg1']);

			// ME CENTRA LA IMAGEN VERTICALMENTE
			// PORCENTAJE DE REDUCCIÓN DEL ALTURA IMAGEN
			$porcenth1 = round((($wwref * 100) / $ancho1),2);
			$newalto1 = round((($alto1 * $porcenth1) / 100),2);
			$mrgtop1 = round((($newalto1 - 160) / 2),2); // para px
			$mrgtop1 = str_replace("-","",$mrgtop1);
			$centra1 = "style=\" margin-top: -".$mrgtop1."px;\" ";

		////////////////////		**********  		////////////////////

	global $ancho2;
    global $alto2;
    list($ancho2, $alto2, $tipo2, $atributos2) = getimagesize("../Gch.Img.Art/".$rowb['myimg2']);

			// ME CENTRA LA IMAGEN VERTICALMENTE
			// PORCENTAJE DE REDUCCIÓN DEL ALTURA IMAGEN
			$porcenth2 = round((($wwref * 100) / $ancho2),2);
			$newalto2 = round((($alto2 * $porcenth2) / 100),2);
			$mrgtop2 = round((($newalto2 - 160) / 2),2); // para px
			$mrgtop2 = str_replace("-","",$mrgtop2);
			$centra2 = "style=\" margin-top: -".$mrgtop2."px;\" ";

		////////////////////		**********  		////////////////////

	global $ancho3;
    global $alto3;
    list($ancho3, $alto3, $tipo3, $atributos3) = getimagesize("../Gch.Img.Art/".$rowb['myimg3']);

			// ME CENTRA LA IMAGEN VERTICALMENTE
			// PORCENTAJE DE REDUCCIÓN DEL ALTURA IMAGEN
			$porcenth3 = round((($wwref * 100) / $ancho3),2);
			$newalto3 = round((($alto3 * $porcenth3) / 100),2);
			$mrgtop3 = round((($newalto3 - 160) / 2),2); // para px
			$mrgtop3 = str_replace("-","",$mrgtop3);
			$centra3 = "style=\" margin-top: -".$mrgtop3."px;\" ";

		////////////////////		**********  		////////////////////

	global $ancho4;
    global $alto4;
    list($ancho4, $alto4, $tipo4, $atributos4) = getimagesize("../Gch.Img.Art/".$rowb['myimg4']);

			// ME CENTRA LA IMAGEN VERTICALMENTE
			// PORCENTAJE DE REDUCCIÓN DEL ALTURA IMAGEN
			$porcenth4 = round((($wwref * 100) / $ancho4),2);
			$newalto4 = round((($alto4 * $porcenth4) / 100),2);
			$mrgtop4 = round((($newalto4 - 160) / 2),2); // para px
			$mrgtop4 = str_replace("-","",$mrgtop4);
			$centra4 = "style=\" margin-top: -".$mrgtop4."px;\" ";

		////////////////////		**********  		////////////////////

?>