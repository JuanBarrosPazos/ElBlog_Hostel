<?php

global $anchomax;
$anchomax = 900;
global $altomax;
$altomax = 400;

global $ruta;
$ruta = "../Gch.Img.News/";
$_SESSION['ruta'] = $ruta;

$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
$safe_filename = trim(str_replace('..', '', $safe_filename));
global $nombre;
$nombre = $_FILES['myimg']['name'];
global $destination_file;
$destination_file = $ruta.$safe_filename;	

global $destination_file;
$destination_file = $ruta.$safe_filename;

if( file_exists($ruta.$nombre)){
    unlink($ruta.$nombre);
    print("* ".$nombre." YA EXISTE, SELECCIONE OTRA IMAGEN.</br>");
    
} else {

    // Eliminar el archivo antiguo untitled.png
    if($_SESSION['smyimg'] != 'untitled.png' ){
      if( file_exists($ruta.$_SESSION['smyimg'])){
            unlink($ruta.$_SESSION['smyimg']);
              } else {}
            }

    global $extension;
    global $ctemp;
    $ctemp = "../Gch.Temp";
    if (!file_exists($ctemp)) {
      mkdir($ctemp, 0777, true);
      copy($_FILES['myimg']['tmp_name'], $ctemp."/inim.".$extension); 
    }else{
      copy($_FILES['myimg']['tmp_name'], $ctemp."/inim.".$extension); 
    }

    global $ancho;
    global $alto;
    list($ancho, $alto, $tipo, $atributos) = getimagesize($_FILES['myimg']['tmp_name']);

    if($ancho > $anchomax){   

        global $extension;
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
        if(($extension == 'jpg')||($extension == 'jpeg')||($extension == '')){
          $img= imagecreatefromjpeg($ctemp."/inim.".$extension);
        }elseif($extension == 'png'){ $img= imagecreatefrompng($ctemp."/inim.".$extension); }

        $dst = ImageCreateTrueColor($anchonew, $altonew);
        imagecopyresampled($dst, $img, 0, 0, 0, 0, $anchonew, $altonew, $ancho, $alto);

        if(($extension == 'jpg')||($extension == 'jpeg')||($extension == '')){
                  imagejpeg($dst, $destination_file);
                  global $ruta;
                  global $new_name;
                  $rename_filename = $ruta.$new_name;								
                  rename($destination_file, $rename_filename);
                  $_SESSION['myimg'] = $new_name;
                  //print (@$redir);
                }
          elseif($extension == 'png'){ 
                imagepng($dst, $destination_file);
                global $ruta;
                global $new_name;
                $rename_filename = $ruta.$new_name;								
                rename($destination_file, $rename_filename);
                $_SESSION['myimg'] = $new_name;
                //print (@$redir);
          }else{ }
  
      } // FIN RECORTA EL ANCHO

      elseif($alto > $altomax){ 

        global $extension;
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
        if(($extension == 'jpg')||($extension == 'jpeg')||($extension == '')){
          $img= imagecreatefromjpeg($ctemp."/inim.".$extension);
        }elseif($extension == 'png'){ $img= imagecreatefrompng($ctemp."/inim.".$extension); }

        $dst = ImageCreateTrueColor($anchonew, $altonew);
        imagecopyresampled($dst, $img, 0, 0, 0, 0, $anchonew, $altonew, $ancho, $alto);

        if(($extension == 'jpg')||($extension == 'jpeg')||($extension == '')){
                  imagejpeg($dst, $destination_file);
                  global $ruta;
                  global $new_name;
                  $rename_filename = $ruta.$new_name;								
                  rename($destination_file, $rename_filename);
                  $_SESSION['myimg'] = $new_name;
                  print ($redir);
                }
        elseif($extension == 'png'){ 
            imagepng($dst, $destination_file);
            global $ruta;
            global $new_name;
            $rename_filename = $ruta.$new_name;								
            rename($destination_file, $rename_filename);
            $_SESSION['myimg'] = $new_name;
            print ($redir);
        }else{ }
      }
      // FIN SI NO SE REDUCE LA IMAGEN
      else {  global $destination_file;
              move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file);
              global $ruta;
              global $new_name;
              $rename_filename = $ruta.$new_name;								
              rename($destination_file, $rename_filename);
              $_SESSION['myimg'] = $new_name;
              print ($redir);
            } 

} // FIN SI NO EXISTE LA IMAGEN

/* Creado por Juan Manuel Barros Pazos 2020/21 */

?>