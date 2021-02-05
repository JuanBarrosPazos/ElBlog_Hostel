<?php

		global $anchomax;
		$anchomax = 900;
		global $altomax;
		$altomax = 400;
	
	/* GRABAMOS LA IMAGEN 1 */
	if($_FILES['myimg1']['size'] == 0){
				global $carpetaimg;
				global $new_name1;
				copy("../Gch.Img.Sys/untitled.png", $carpetaimg."/".$new_name1);
	} else { $safe_filename = trim(str_replace('/', '', $_FILES['myimg1']['name']));
			 $safe_filename = trim(str_replace('..', '', $safe_filename));
			 $nombre = $_FILES['myimg1']['name'];
			 global $destination_file;
			 $destination_file = $carpetaimg.'/'.$safe_filename;

			if(file_exists( $carpetaimg.'/'.$nombre)){
					unlink($carpetaimg."/".$nombre);
					print("* ".$nombre." YA EXISTE, SELECCIONE OTRA IMAGEN.</br>");

			} else {

				global $extension1;
				global $ctemp;
				$ctemp = "../Gch.Temp";
				if (!file_exists($ctemp)) {
				  mkdir($ctemp, 0777, true);
				  copy($_FILES['myimg1']['tmp_name'], $ctemp."/ini1.".$extension1); 
				}else{
				  copy($_FILES['myimg1']['tmp_name'], $ctemp."/ini1.".$extension1); 
				}
			
				global $ancho;
				global $alto;
				list($ancho, $alto, $tipo, $atributos) = getimagesize($_FILES['myimg1']['tmp_name']);
			
				if($ancho > $anchomax){   

					global $extension1;
					global $destination_file; 
					global $anchomax;
					global $ancho;
					global $anchodif;
					$anchodif = ($ancho - $anchomax);
					global $porcent;
					$porcent = round((($anchodif * 100)/$ancho),2);
					//echo " % ".$porcent;
					global $anchonew;
					$anchonew = ($ancho - $anchodif);
					//echo " New Width: ".$anchonew;
					global $altonew;
					$altonew = ($alto - (($alto * $porcent)/100));
					$altonew = round($altonew,0);
			  
					// SE RECORTA EL ANCHO DE LA IMAGEN
					if(($extension1 == 'jpg')||($extension1 == 'jpeg')||($extension1 == '')){
					  $img= imagecreatefromjpeg($ctemp."/ini1.".$extension1);
					}elseif($extension1 == 'png'){ $img= imagecreatefrompng($ctemp."/ini1.".$extension1); }

					$dst = ImageCreateTrueColor($anchonew, $altonew);
					imagecopyresampled($dst, $img, 0, 0, 0, 0, $anchonew, $altonew, $ancho, $alto);

					if(($extension1 == 'jpg')||($extension1 == 'jpeg')||($extension1 == '')){
							  imagejpeg($dst, $destination_file);
							  global $carpetaimg;
							  global $new_name1;
							  $rename_filename = $carpetaimg."/".$new_name1;								
							  rename($destination_file, $rename_filename);
							}
					  elseif($extension1 == 'png'){ 
							imagepng($dst, $destination_file);
							global $carpetaimg;
							global $new_name1;
							$rename_filename = $carpetaimg."/".$new_name1;								
							rename($destination_file, $rename_filename);
					  }else{ }
			  
				  } // FIN RECORTA EL ANCHO
			  
				  elseif($alto > $altomax){ 

					global $extension1;
					global $destination_file; 
					global $altomax;
					global $alto;     
					global $altodif;
					$altodif = ($alto - $altomax);
					global $porcent;
					$porcent = round((($altodif * 100)/$alto),2);
					global $altonew;
					$altonew = ($alto - $altodif);
				
					global $anchonew;
					$anchonew = ($ancho - (($ancho * $porcent)/100));
					$anchonew = round($anchonew,0);
				
					// SE RECORTA EL ALTO DE LA IMAGEN
					if(($extension1 == 'jpg')||($extension1 == 'jpeg')||($extension1 == '')){
					  $img= imagecreatefromjpeg($ctemp."/ini1.".$extension1);
					}elseif($extension1 == 'png'){ $img= imagecreatefrompng($ctemp."/ini1.".$extension1); }

					$dst = ImageCreateTrueColor($anchonew, $altonew);
					imagecopyresampled($dst, $img, 0, 0, 0, 0, $anchonew, $altonew, $ancho, $alto);

					if(($extension1 == 'jpg')||($extension1 == 'jpeg')||($extension1 == '')){
							  imagejpeg($dst, $destination_file);
							  global $carpetaimg;
							  global $new_name1;
							  $rename_filename = $carpetaimg."/".$new_name1;								
							  rename($destination_file, $rename_filename);
  
							}
					elseif($extension1 == 'png'){ 
						imagepng($dst, $destination_file);
						global $carpetaimg;
						global $new_name1;
						$rename_filename = $carpetaimg."/".$new_name1;								
                        rename($destination_file, $rename_filename);
                        
					  }else{ }
				  }
				  // FIN SI NO SE REDUCE LA IMAGEN
				  else {  global $destination_file;
						  move_uploaded_file($_FILES['myimg1']['tmp_name'], $destination_file);
						  global $carpetaimg;
						  global $new_name1;
						  $rename_filename = $carpetaimg."/".$new_name1;								
						  rename($destination_file, $rename_filename);
						} 
					} // FIN SI NO EXISTE LA IMAGEN

            } // FIN SI EL CAMPO NO ESTA VACIO

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* GRABAMOS LA IMAGEN 2 */
	if($_FILES['myimg2']['size'] == 0){
        global $carpetaimg;
        global $new_name2;
        copy("../Gch.Img.Sys/untitled.png", $carpetaimg."/".$new_name2);
} else { $safe_filename = trim(str_replace('/', '', $_FILES['myimg2']['name']));
     $safe_filename = trim(str_replace('..', '', $safe_filename));
     $nombre = $_FILES['myimg2']['name'];
     global $destination_file;
     $destination_file = $carpetaimg.'/'.$safe_filename;

    if(file_exists( $carpetaimg.'/'.$nombre)){
            unlink($carpetaimg."/".$nombre);
            print("* ".$nombre." YA EXISTE, SELECCIONE OTRA IMAGEN.</br>");

    } else {

        global $extension2;
        global $ctemp;
        $ctemp = "../Gch.Temp";
        if (!file_exists($ctemp)) {
          mkdir($ctemp, 0777, true);
          copy($_FILES['myimg2']['tmp_name'], $ctemp."/ini2.".$extension2); 
        }else{
          copy($_FILES['myimg2']['tmp_name'], $ctemp."/ini2.".$extension2); 
        }
    
        global $ancho;
        global $alto;
        list($ancho, $alto, $tipo, $atributos) = getimagesize($_FILES['myimg2']['tmp_name']);
    
        if($ancho > $anchomax){   

            global $extension2;
            global $destination_file; 
            global $anchomax;
            global $ancho;
            global $anchodif;
            $anchodif = ($ancho - $anchomax);
            global $porcent;
            $porcent = round((($anchodif * 100)/$ancho),2);
            //echo " % ".$porcent;
            global $anchonew;
            $anchonew = ($ancho - $anchodif);
            //echo " New Width: ".$anchonew;
            global $altonew;
            $altonew = ($alto - (($alto * $porcent)/100));
            $altonew = round($altonew,0);
      
            // SE RECORTA EL ANCHO DE LA IMAGEN
            if(($extension2 == 'jpg')||($extension2 == 'jpeg')||($extension2 == '')){
              $img= imagecreatefromjpeg($ctemp."/ini2.".$extension2);
            }elseif($extension2 == 'png'){ $img= imagecreatefrompng($ctemp."/ini2.".$extension2); }

            $dst = ImageCreateTrueColor($anchonew, $altonew);
            imagecopyresampled($dst, $img, 0, 0, 0, 0, $anchonew, $altonew, $ancho, $alto);

            if(($extension2 == 'jpg')||($extension2 == 'jpeg')||($extension2 == '')){
                      imagejpeg($dst, $destination_file);
                      global $carpetaimg;
                      global $new_name2;
                      $rename_filename = $carpetaimg."/".$new_name2;								
                      rename($destination_file, $rename_filename);
                    }
              elseif($extension2 == 'png'){ 
                    imagepng($dst, $destination_file);
                    global $carpetaimg;
                    global $new_name2;
                    $rename_filename = $carpetaimg."/".$new_name2;								
                    rename($destination_file, $rename_filename);
              }else{ }
      
          } // FIN RECORTA EL ANCHO
      
          elseif($alto > $altomax){ 

            global $extension2;
            global $destination_file; 
            global $altomax;
            global $alto;     
            global $altodif;
            $altodif = ($alto - $altomax);
            global $porcent;
            $porcent = round((($altodif * 100)/$alto),2);
            global $altonew;
            $altonew = ($alto - $altodif);
        
            global $anchonew;
            $anchonew = ($ancho - (($ancho * $porcent)/100));
            $anchonew = round($anchonew,0);
        
            // SE RECORTA EL ALTO DE LA IMAGEN
            if(($extension2 == 'jpg')||($extension2 == 'jpeg')||($extension2 == '')){
              $img= imagecreatefromjpeg($ctemp."/ini2.".$extension2);
            }elseif($extension2 == 'png'){ $img= imagecreatefrompng($ctemp."/ini2.".$extension2); }

            $dst = ImageCreateTrueColor($anchonew, $altonew);
            imagecopyresampled($dst, $img, 0, 0, 0, 0, $anchonew, $altonew, $ancho, $alto);

            if(($extension2 == 'jpg')||($extension2 == 'jpeg')||($extension2 == '')){
                      imagejpeg($dst, $destination_file);
                      global $carpetaimg;
                      global $new_name2;
                      $rename_filename = $carpetaimg."/".$new_name2;								
                      rename($destination_file, $rename_filename);

                    }
            elseif($extension2 == 'png'){ 
                imagepng($dst, $destination_file);
                global $carpetaimg;
                global $new_name2;
                $rename_filename = $carpetaimg."/".$new_name2;								
                rename($destination_file, $rename_filename);
                
              }else{ }
          }
          // FIN SI NO SE REDUCE LA IMAGEN
          else {  global $destination_file;
                  move_uploaded_file($_FILES['myimg2']['tmp_name'], $destination_file);
                  global $carpetaimg;
                  global $new_name2;
                  $rename_filename = $carpetaimg."/".$new_name2;								
                  rename($destination_file, $rename_filename);
                } 
            } // FIN SI NO EXISTE LA IMAGEN

        } // FIN SI EL CAMPO NO ESTA VACIO

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* GRABAMOS LA IMAGEN 3 */
	if($_FILES['myimg3']['size'] == 0){
				global $carpetaimg;
				global $new_name3;
				copy("../Gch.Img.Sys/untitled.png", $carpetaimg."/".$new_name3);
	} else { $safe_filename = trim(str_replace('/', '', $_FILES['myimg3']['name']));
			 $safe_filename = trim(str_replace('..', '', $safe_filename));
			 $nombre = $_FILES['myimg3']['name'];
			 global $destination_file;
			 $destination_file = $carpetaimg.'/'.$safe_filename;

			if(file_exists( $carpetaimg.'/'.$nombre)){
					unlink($carpetaimg."/".$nombre);
					print("* ".$nombre." YA EXISTE, SELECCIONE OTRA IMAGEN.</br>");

			} else {

				global $extension3;
				global $ctemp;
				$ctemp = "../Gch.Temp";
				if (!file_exists($ctemp)) {
				  mkdir($ctemp, 0777, true);
				  copy($_FILES['myimg3']['tmp_name'], $ctemp."/ini3.".$extension3); 
				}else{
				  copy($_FILES['myimg3']['tmp_name'], $ctemp."/ini3.".$extension3); 
				}
			
				global $ancho;
				global $alto;
				list($ancho, $alto, $tipo, $atributos) = getimagesize($_FILES['myimg3']['tmp_name']);
			
				if($ancho > $anchomax){   

					global $extension3;
					global $destination_file; 
					global $anchomax;
					global $ancho;
					global $anchodif;
					$anchodif = ($ancho - $anchomax);
					global $porcent;
					$porcent = round((($anchodif * 100)/$ancho),2);
					//echo " % ".$porcent;
					global $anchonew;
					$anchonew = ($ancho - $anchodif);
					//echo " New Width: ".$anchonew;
					global $altonew;
					$altonew = ($alto - (($alto * $porcent)/100));
					$altonew = round($altonew,0);
			  
					// SE RECORTA EL ANCHO DE LA IMAGEN
					if(($extension3 == 'jpg')||($extension3 == 'jpeg')||($extension3 == '')){
					  $img= imagecreatefromjpeg($ctemp."/ini3.".$extension3);
					}elseif($extension3 == 'png'){ $img= imagecreatefrompng($ctemp."/ini3.".$extension3); }

					$dst = ImageCreateTrueColor($anchonew, $altonew);
					imagecopyresampled($dst, $img, 0, 0, 0, 0, $anchonew, $altonew, $ancho, $alto);

					if(($extension3 == 'jpg')||($extension3 == 'jpeg')||($extension3 == '')){
							  imagejpeg($dst, $destination_file);
							  global $carpetaimg;
							  global $new_name3;
							  $rename_filename = $carpetaimg."/".$new_name3;								
							  rename($destination_file, $rename_filename);
							}
					  elseif($extension3 == 'png'){ 
							imagepng($dst, $destination_file);
							global $carpetaimg;
							global $new_name3;
							$rename_filename = $carpetaimg."/".$new_name3;								
							rename($destination_file, $rename_filename);
					  }else{ }
			  
				  } // FIN RECORTA EL ANCHO
			  
				  elseif($alto > $altomax){ 

					global $extension3;
					global $destination_file; 
					global $altomax;
					global $alto;     
					global $altodif;
					$altodif = ($alto - $altomax);
					global $porcent;
					$porcent = round((($altodif * 100)/$alto),2);
					global $altonew;
					$altonew = ($alto - $altodif);
				
					global $anchonew;
					$anchonew = ($ancho - (($ancho * $porcent)/100));
					$anchonew = round($anchonew,0);
				
					// SE RECORTA EL ALTO DE LA IMAGEN
					if(($extension3 == 'jpg')||($extension3 == 'jpeg')||($extension3 == '')){
					  $img= imagecreatefromjpeg($ctemp."/ini3.".$extension3);
					}elseif($extension3 == 'png'){ $img= imagecreatefrompng($ctemp."/ini3.".$extension3); }

					$dst = ImageCreateTrueColor($anchonew, $altonew);
					imagecopyresampled($dst, $img, 0, 0, 0, 0, $anchonew, $altonew, $ancho, $alto);

					if(($extension3 == 'jpg')||($extension3 == 'jpeg')||($extension3 == '')){
							  imagejpeg($dst, $destination_file);
							  global $carpetaimg;
							  global $new_name3;
							  $rename_filename = $carpetaimg."/".$new_name3;								
							  rename($destination_file, $rename_filename);
  
							}
					elseif($extension3 == 'png'){ 
						imagepng($dst, $destination_file);
						global $carpetaimg;
						global $new_name3;
						$rename_filename = $carpetaimg."/".$new_name3;								
                        rename($destination_file, $rename_filename);
                        
					  }else{ }
				  }
				  // FIN SI NO SE REDUCE LA IMAGEN
				  else {  global $destination_file;
						  move_uploaded_file($_FILES['myimg3']['tmp_name'], $destination_file);
						  global $carpetaimg;
						  global $new_name3;
						  $rename_filename = $carpetaimg."/".$new_name3;								
						  rename($destination_file, $rename_filename);
						} 
					} // FIN SI NO EXISTE LA IMAGEN

                } // FIN SI EL CAMPO NO ESTA VACIO
        
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* GRABAMOS LA IMAGEN 4 */
	if($_FILES['myimg4']['size'] == 0){
				global $carpetaimg;
				global $new_name4;
				copy("../Gch.Img.Sys/untitled.png", $carpetaimg."/".$new_name4);
	} else { $safe_filename = trim(str_replace('/', '', $_FILES['myimg4']['name']));
			 $safe_filename = trim(str_replace('..', '', $safe_filename));
			 $nombre = $_FILES['myimg4']['name'];
			 global $destination_file;
			 $destination_file = $carpetaimg.'/'.$safe_filename;

			if(file_exists( $carpetaimg.'/'.$nombre)){
					unlink($carpetaimg."/".$nombre);
					print("* ".$nombre." YA EXISTE, SELECCIONE OTRA IMAGEN.</br>");

			} else {

				global $extension4;
				global $ctemp;
				$ctemp = "../Gch.Temp";
				if (!file_exists($ctemp)) {
				  mkdir($ctemp, 0777, true);
				  copy($_FILES['myimg4']['tmp_name'], $ctemp."/ini4.".$extension4); 
				}else{
				  copy($_FILES['myimg4']['tmp_name'], $ctemp."/ini4.".$extension4); 
				}
			
				global $ancho;
				global $alto;
				list($ancho, $alto, $tipo, $atributos) = getimagesize($_FILES['myimg4']['tmp_name']);
			
				if($ancho > $anchomax){   

					global $extension4;
					global $destination_file; 
					global $anchomax;
					global $ancho;
					global $anchodif;
					$anchodif = ($ancho - $anchomax);
					global $porcent;
					$porcent = round((($anchodif * 100)/$ancho),2);
					//echo " % ".$porcent;
					global $anchonew;
					$anchonew = ($ancho - $anchodif);
					//echo " New Width: ".$anchonew;
					global $altonew;
					$altonew = ($alto - (($alto * $porcent)/100));
					$altonew = round($altonew,0);
			  
					// SE RECORTA EL ANCHO DE LA IMAGEN
					if(($extension4 == 'jpg')||($extension4 == 'jpeg')||($extension4 == '')){
					  $img= imagecreatefromjpeg($ctemp."/ini4.".$extension4);
					}elseif($extension4 == 'png'){ $img= imagecreatefrompng($ctemp."/ini4.".$extension4); }

					$dst = ImageCreateTrueColor($anchonew, $altonew);
					imagecopyresampled($dst, $img, 0, 0, 0, 0, $anchonew, $altonew, $ancho, $alto);

					if(($extension4 == 'jpg')||($extension4 == 'jpeg')||($extension4 == '')){
							  imagejpeg($dst, $destination_file);
							  global $carpetaimg;
							  global $new_name4;
							  $rename_filename = $carpetaimg."/".$new_name4;								
							  rename($destination_file, $rename_filename);
							}
					  elseif($extension4 == 'png'){ 
							imagepng($dst, $destination_file);
							global $carpetaimg;
							global $new_name4;
							$rename_filename = $carpetaimg."/".$new_name4;								
							rename($destination_file, $rename_filename);
					  }else{ }
			  
				  } // FIN RECORTA EL ANCHO
			  
				  elseif($alto > $altomax){ 

					global $extension4;
					global $destination_file; 
					global $altomax;
					global $alto;     
					global $altodif;
					$altodif = ($alto - $altomax);
					global $porcent;
					$porcent = round((($altodif * 100)/$alto),2);
					global $altonew;
					$altonew = ($alto - $altodif);
				
					global $anchonew;
					$anchonew = ($ancho - (($ancho * $porcent)/100));
					$anchonew = round($anchonew,0);
				
					// SE RECORTA EL ALTO DE LA IMAGEN
					if(($extension4 == 'jpg')||($extension4 == 'jpeg')||($extension4 == '')){
					  $img= imagecreatefromjpeg($ctemp."/ini4.".$extension4);
					}elseif($extension4 == 'png'){ $img= imagecreatefrompng($ctemp."/ini4.".$extension4); }

					$dst = ImageCreateTrueColor($anchonew, $altonew);
					imagecopyresampled($dst, $img, 0, 0, 0, 0, $anchonew, $altonew, $ancho, $alto);

					if(($extension4 == 'jpg')||($extension4 == 'jpeg')||($extension4 == '')){
							  imagejpeg($dst, $destination_file);
							  global $carpetaimg;
							  global $new_name4;
							  $rename_filename = $carpetaimg."/".$new_name4;								
							  rename($destination_file, $rename_filename);
  
							}
					elseif($extension4 == 'png'){ 
						imagepng($dst, $destination_file);
						global $carpetaimg;
						global $new_name4;
						$rename_filename = $carpetaimg."/".$new_name4;								
                        rename($destination_file, $rename_filename);
                        
					  }else{ }
				  }
				  // FIN SI NO SE REDUCE LA IMAGEN
				  else {  global $destination_file;
						  move_uploaded_file($_FILES['myimg4']['tmp_name'], $destination_file);
						  global $carpetaimg;
						  global $new_name4;
						  $rename_filename = $carpetaimg."/".$new_name4;								
						  rename($destination_file, $rename_filename);
						} 
					} // FIN SI NO EXISTE LA IMAGEN

                } // FIN SI EL CAMPO NO ESTA VACIO

	/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>