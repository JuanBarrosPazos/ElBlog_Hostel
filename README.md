
# ElBlog_Hostel

----

## MIS AGRADECIMIENTOS A
## JOSEP LLUIS HUERTA GRÁFIA Y MIQUEL ÁNGEL CABOT NADAL.
## POR LA AYUDA Y EL BUEN TRATO QUE ME HAN PRESTADO
## EN CIFP F. BORJA MOLL (IFCD_0210) 2020.

----

## * EN EL DIRECTORIO Gch.Tutorial SE ENCUENTRA UNA GUÍA GENERAL DE LA APP.

----

## * REPOSITORIO MEGA.NZ: 

* https://mega.nz/folder/K8thzLTC#hGByFrZ83XqvY0U6b_w8eQ


----

### 2020.09.08
## ElBlog_Hostel.F6.V39 ESTABLE

* SE MODIFICA EL MENU BACKEND

* SE MODIFICA LA GESTION DE ADMIN

----

### 2020.09.07
## ElBlog_Hostel.F6.V38 ESTABLE

## METODO 02 SE CREA UNA JS COOKIE AL CARGAR EL INDEX CON EL VALOR DEL SCREEN.W

```
<?php

    // GENERO LA COOKIE POR SI QUIERO UTILIZARLA EN EL INC_CENTRA.PHP
  	$wcook = "<script type='text/javascript'>
                function setCookie() {
                    var cname = 'wancho';
                    var cvalue = screen.width;
                    var d = new Date();
                    // EXPIRA EN CUATRO HORAS
                    d.setTime(d.getTime() + (4*60*60*1000));
                    var expires = 'expires='+d.toUTCString();
                    document.cookie = cname + '=' + cvalue + '; '+expires+';path=/';
        }
                    //setCookie();
              </script>";
    print ($wcook);
?>

</head>

<body id="page-top" onresize="setCookie()">

```

* SE CENTRAN LAS IMAGENES EN EL FRONTEND TAL QUE:

```
	/*	METODO 02 SE CREA UNA JS COOKIE AL CARGAR EL INDEX CON EL VALOR DEL SCREEN.W */
		if (isset($_COOKIE['wancho'])){
			// echo 'COOKIE: '. $_COOKIE['wancho'];
			$wancho = $_COOKIE['wancho'];
		}else{ $wancho = 100; }
	
	global $ancho;
    global $alto;
    list($ancho, $alto, $tipo, $atributos) = getimagesize("Gch.Img.Art/".$rowb['myimg1']);

	global $wwref;

	if ($wancho >= 992){ $wwref = 170; }
	elseif (($wancho < 992)&&($wancho >= 768)){ $wwref = 94; }
	elseif ($wancho < 768){ $wwref = 80; }
	else { $wwref = 100; }

	if ($alto > $ancho){
				// ME CENTRA LA IMAGEN VERTICALMENTE
				// PORCENTAJE DE REDUCCIÓN DEL ALTURA IMAGEN
				$porcenth = round((($wwref * 100) / $ancho),2);
				$newalto = round((($alto * $porcenth) / 100),2);
				$mrgtop = round((($newalto - $wwref) / 2),2); // para px
				$mrgtop = str_replace("-","",$mrgtop);
	$centra = "style=\"width: 100% !important; height: auto !important; margin-top: -".$mrgtop."px;\" ";

	} else { 	// ME CENTRA LA IMAGEN HORIZONTALMENTE
				// PORCENTAJE DE REDUCCIÓN DE ANCHURA IMAGEN
				$porcentw = round((($wwref * 100) / $alto),2);
				$newancho = round((($ancho * $porcentw) / 100),2);
				$mrgleft = round((($newancho - $wwref) / 2),2); // para px
				$mrgleft = str_replace("-","",$mrgleft);
				$centra = "style=\"margin-left: -".$mrgleft."px;\" ";
			}

```
----

### 2020.09.06
## ElBlog_Hostel.F6.V38 ESTABLE

## METODO 01 EN RELACIÓN A FLEX Y screen.width GET['wancho'] AL ACCEDER A INDEX O NEWS
* SE CENTRAN LAS IMAGENES EN EL FRONTEND TAL QUE:

```
	global $ancho;
    global $alto;
    list($ancho, $alto, $tipo, $atributos) = getimagesize("Gch.Img.Art/".$rowb['myimg1']);

	global $wwref;
	global $wancho;
	if((!isset($_GET['wancho']))&&(!isset($_POST['leermas']))&&(!isset($_POST['leermenos']))&&(!isset($_POST['login']))&&(!isset($_GET['page']))&&(!isset($_GET['pagef']))&&(!isset($_POST['pagef']))&&(!isset($_POST['oculto1']))&&(!isset($_POST['oculto']))){

		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='index.php?wancho='+screen.width;
					}
					redir();
					//setTimeout('redir()',10);
					</script>";
				print ($redir);
				$wancho = $_SESSION['wancho'];
		} else { if(isset($_GET['wancho'])) { // echo "ANCHO: ".$_GET['ancho'];
			$wancho = $_GET['wancho'];
			$_SESSION['wancho'] = $_GET['wancho'];
				} else { // echo "NO SE HA DETECTADO";
						 $wancho = $_SESSION['wancho'];
							}
						}

	if ($wancho >= 992){ $wwref = 170; }
	elseif (($wancho < 992)&&($wancho >= 768)){ $wwref = 94; }
	elseif ($wancho < 768){ $wwref = 80; }
	else { $wwref = 100; }

	if ($alto > $ancho){
				// ME CENTRA LA IMAGEN VERTICALMENTE
				// PORCENTAJE DE REDUCCIÓN DEL ALTURA IMAGEN
				$porcenth = round((($wwref * 100) / $ancho),2);
				$newalto = round((($alto * $porcenth) / 100),2);
				$mrgtop = round((($newalto - $wwref) / 2),2); // para px
				$mrgtop = str_replace("-","",$mrgtop);
	$centra = "style=\"width: 100% !important; height: auto !important; margin-top: -".$mrgtop."px;\" ";

	} else { 	// ME CENTRA LA IMAGEN HORIZONTALMENTE
				// PORCENTAJE DE REDUCCIÓN DE ANCHURA IMAGEN
				$porcentw = round((($wwref * 100) / $alto),2);
				$newancho = round((($ancho * $porcentw) / 100),2);
				$mrgleft = round((($newancho - $wwref) / 2),2); // para px
				$mrgleft = str_replace("-","",$mrgleft);
				$centra = "style=\"margin-left: -".$mrgleft."px;\" ";
			}
```
----

### 2020.09.05
## ElBlog_Hostel.F6.V36 ESTABLE

* SE MODIFICA EL MENU BACKEND

----

### 2020.09.04
## ElBlog_Hostel.F6.V35 ESTABLE

## METODO 00 BUSCANDO UNA APROXIMACIÓN EN RELACIÓN A FLEX
* SE CENTRAN LAS IMAGENES EN EL FRONTEND TAL QUE:

```
	global $ancho;
    global $alto;
    list($ancho, $alto, $tipo, $atributos) = getimagesize("Gch.Img.Art/".$rowb['myimg1']);

	if(!isset($_GET['ancho'])) {
		echo "<script language=\"JavaScript\">
		<!-- 
		document.location=\"$_SERVER[PHP_SELF]?ancho=\"+screen.width;
		-->
		</script>";
		} else { if(isset($_GET['ancho'])) { } else { } }

	global $z;
	if ($_GET['ancho'] >= 992) { $z = 170; }
	elseif (($_GET['ancho'] > 766) && ($_GET['ancho'] < 992)) { $z = 94; }
	elseif ($_GET['ancho'] <= 766) { $z = 80; }
	else { $z = 9000; }

	if ($alto > $ancho){
				// ME CENTRA LA IMAGEN VERTICALMENTE
				// PORCENTAJE DE REDUCCIÓN DEL ALTURA IMAGEN
				$porcenth = round((($z * 100) / $ancho),2);
				$newalto = round((($alto * $porcenth) / 100),2);
				$mrgtop = round((($newalto - $z) / 2),2); // para px
				$mrgtop = str_replace("-","",$mrgtop);
	$centra = "style=\"width: 100% !important; height: auto !important; margin-top: -".$mrgtop."px;\" ";

	} else { 	// ME CENTRA LA IMAGEN HORIZONTALMENTE
				// PORCENTAJE DE REDUCCIÓN DE ANCHURA IMAGEN
				$porcentw = round((($z * 100) / $alto),2);
				$newancho = round((($ancho * $porcentw) / 100),2);
				$mrgleft = round((($newancho - $z) / 2),2); // para px
				$mrgleft = str_replace("-","",$mrgleft);
				$centra = "style=\"margin-left: -".$mrgleft."px;\" ";
		}

	print ("
		<li  class='".$estilo[$estiloin]."'> <!-- Inicio Li contenedor -->
			<div class='timeline-image'>
		<img class='<!--rounded-circle--> img-fluid' ".$centra." src='Gch.Img.Art/".$rowb['myimg1']."' alt=''>
			</div>
```

----

### 2020.09.03
## ElBlog_Hostel.F06.V34 ESTABLE

* SE MODIFICA LA ESTRUCTURA DE ARCHIVOS DEL MENÚ MASTER INDEX BACKEND

* SE MODIFICA LA EXPORTACIÓN DE BBDD Y TABLAS

----

### 2020.09.02
## ElBlog_Hostel.F06.V33b ESTABLE

* SE MODIFICA LA VISUALIZACIÓN DE ARTICULOS DE RESTAURANTES EN EL BACKEND

* SE MODIFICA LA ESTRUCTURA DE ARCHIVOS EN Gch.Art/

* SE CREA EL DIRECTORIO Gch.Vdo.Art/ PARA LOS VIDEOS DE LA SECCION RESTAURANTES

* SE MODIFICA LA TABLA gch_art  PARA RESTAURANTES 

```

      //`myimg4`...

  `myvdo` varchar(30) collate utf8_spanish2_ci DEFAULT NULL,

      //`refayto`...

```

* SE INTEGRA LA CARGA, BORRADO Y MODIFICACIÓN DE VIDEO EN LA SECCIÓN RESTAURANTES BACKEND

* SE INTEGRA LA VISUALIZACIÓN DE VIDEO EN EL INDEX Y DETALLES DEL RESTAURANTE, FRONTEND

----

### 2020.09.01
## ElBlog_Hostel.F05.V32 ESTABLE

* SE MODIFICA LA VISUALIZACIÓN DE NEWS EN EL BACKEND

* SE INTEGRA EL RECORTE DE IMAGENES AUTOMÁTICO EN LA SECCIÓN NEWS

* SE CREA LA ELIMINACIÓN DE VIDEOS DE LA SECCIÓN NEWS

----

### 2020.08.31
## ElBlog_Hostel.F05.V31 ESTABLE

* SE INTEGRA LA VISUALIZACIÓN DE VIDEO EN LA SECCIÓN NEWS FRONTEND

* SE MODIFICA LA TABLA gch_news   

```

`myvdo` varchar(30) collate utf8_spanish2_ci DEFAULT NULL,

```

* SE CREA EL DIRECTORIO Gch.Vdo.News/ PARA LOS VIDEOS DE LA SECCION NEWS

----

### 2020.08.30
## ElBlog_Hostel.F05.V30 ESTABLE

* SE INTEGRA LA SECCIÓN NEWS PARA NOTICIAS DESTACADAS DE LA EMPRESA

* SE MODIFICA LA BBDD
```
CREATE TABLE IF NOT EXISTS `gch_news` (
  `id` int(6) NOT NULL auto_increment,
  `refuser` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `refnews` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `tit` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `titsub` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `datein` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `timein` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `datemod` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `timemod` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `conte` text(402) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `refnews` (`refnews`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

```

* MODIFICADO index_Play_System(Docker).php SOBREESCRIBIR Y RENOMBRAR A index.php.

----

### 2020.08.19
## ElBlog_Hostel.F04.V28 ESTABLE

* SE HA MODIFICADO LA VALIDACIÓN DE IMAGENES EN User_Modificar_img.php, Admin_Modificar_img.php, Art_Modificar_img.php, TAL QUE:

```
  <?PHP
	global $extension1;
	$extension1 = strtolower($extension);
	$extension1 = str_replace(".","",$extension1);
	global $ctemp;
	$ctemp = "../Gch.Temp";

		elseif ($_FILES['myimg']['size'] <= $limite){
      // COPIAMOS LA IMAGEN AL DIRECTORIO TEMPORAL DESIGNADO ../Gch.Temp
			copy($_FILES['myimg']['tmp_name'], $ctemp."/ini1v.".$extension1); 
			global $ancho;
			global $alto;
      // EXTRAEMOS LOS VALORES DE LA IMAGEN COPIADA A NUESTRO TEMP DIR
			list($ancho, $alto, $tipo, $atributos) = getimagesize($ctemp."/ini1v.".$extension1);
      // VALIDAMOS LOS PARAMETROS SEGÚN NUESTRO INTERES

			if($ancho < 100){
				$errors [] = "IMAGEN ".$_FILES['myimg']['name']." ANCHURA MENOR DE 100 * IMG = ".$ancho;
			}
			elseif($ancho > 600){
				$errors [] = "IMAGEN ".$_FILES['myimg']['name']." ANCHURA MAYOR DE 600 * IMG = ".$ancho;
			}
			elseif(($ancho <= 600)&&($alto < 100)){
				$errors [] = "IMAGEN ".$_FILES['myimg']['name']." ALTURA MENOR DE 100 * IMG = ".$alto;
			}
			elseif(($ancho <= 600)&&($alto > 700)){
				$errors [] = "IMAGEN ".$_FILES['myimg']['name']." ALTURA MAYOR DE 700 * IMG = ".$alto;
			}
		}

  ?>
```
* Y TENIENDO EN CUENTA QUE EN Art_Modificar_img.php, SE REALIZARA LA REDUCCION DE LA IMAGEN UNA VEZ SUPERADA LA VALIDACIÓN DE LA SIGUIENTE MANERA:

```
// L.143
require 'Inc_Modificar_Img.php';

/* ***** */

global $anchomax;
$anchomax = 900;
global $altomax;
$altomax = 400;

$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
$safe_filename = trim(str_replace('..', '', $safe_filename));
global $nombre;
$nombre = $_FILES['myimg']['name'];
global $destination_file;
$destination_file = $ruta.$safe_filename;	

global $destination_file;
$destination_file = $ruta.$safe_filename;

if( file_exists($ruta.$nombre) ){
    unlink($ruta.$nombre);
    print("* ".$nombre." YA EXISTE, SELECCIONE OTRA IMAGEN.</br>");
    
} else {

    // Eliminar el archivo antiguo untitled.png
    if($_SESSION['myimg'] != 'untitled.png' ){
        unlink($ruta.$_SESSION['myimg']);
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

```
* EN CREAR Art_Crear.php SE REALIZA UNA REDUCCION DE LAS IMAGENES DE FORMA SIMILAR EN L.248 require 'Inc_Crea_Img.php';

----
----
----

## ** ARCHIVOS QUE NO SE TIENEN QUE SOBRE ESCRIBIR SI LA APLICACIÓN ESTA EN PRODUCCIÓN EN EL SERVIDOR:

* EL ARCHIVO INDEX.PHP DE LA INSTALACIÓN "CONEXIÓN BBDD" INICIAL SE ELIMINA Y SE SUSTITUYE POR CONFIG/INDEX_PLAY_SYSTEM.PHP

* INDEX.PHP
* Gch.Connet/conection.php
* Gch.Config/ayear.php
* Gch.Config/year.txt
* Gch.Inclu/mydni.php
* Gch.Admin/nemp.php
* LOS DIRECTORIOS DE USUARIO Y SUS ARCHIVOS LOS GENERA/ELIMINA EL SISTEMA AUTOMÁTICAMENTE.

** DICHO ESTO, DICHO TODO. 

----

EN ESTA APP CUANDO HABLAMOS DE ISLAS PODRÍAMOS INTERPRETARLO COMO PROVINCIAS.
Y AYUNTAMIENTOS SEGUIR LA MISMA DINÁMICA.
DE ESTA FORMA PODRÍAMOS UTILIZAR LA APP DENTRO DE CUALQUIER CONTEXTO POSIBLE.

----

1º. DESCOMPRIMIR EL ZIP O RAR CON TODOS LOS ARCHIVOS.

2º. COPIAR EL DIRECTORIO CON TODOS LOS ARCHIVOS EN EL SERVIDOR REMOTO O LOCAL.

3º. ACCEDER A ARCHIVO DE CONEXIONES EN RUTASERVER/index.php

    - Mediante este archivo se configura la conexión a la bbdd y se crean las carpetas que 
      necesita el sistema, para poder trabajar.
      Gch.Config/index_Init_System.php actua como copia de index.php con las mismas RUTASERVER
      Gch.Config/config.php actua como index.php desde la ruta Gch.Config/

    - Gch.Config/config2.php
      Se accede directamente a él depués de haber superado el paso anterior y haber generado
      los archivos de conexión al servidor y las tablas de bbdd.
      Mediante este archivo crearemos el primer administrador con categoría de WebMaster.

4º. UNA VEZ SUPERADOS ESTOS DOS PASOS CON ÉXITO PODREMOS ACCEDER AL LOGIN ZONA DE ADMINISTRACIÓN:
    
    - Mediante el enlace que se muestra tras crear el primer admin o webmaster.

    - En la ruta: RUTASERVER/Gch.Admin/access.php
    
    - EL index.php QUE NOS HA PROPORCIONADO LA CONEXIÓN A BBDD Y LA GENERACIÓN DE TABLAS 
      ES ELIMINADO POR EL SISTEMA Y REEMPLAZADO POR UN NUEVO index.php (Gch.Config/index_Init_System.php)
      Y NOS PRESENTA EL FRONT PAGE DEL BLOG.

5º. EN CASO DE DETECTARSE UNA INSTALACIÓN ANTERIOR, SEGUIR LOS PASOS QUE NOS INTERESEN.

6º. 
