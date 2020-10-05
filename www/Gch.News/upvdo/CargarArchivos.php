<?php
    @session_start();

    require_once '../../Gch.Connet/conection.php';
    require_once '../../Gch.Connet/conect.php';
    
    global $errora;
    $errora = "<script>$(\"#progressDivId\").hide();</script><div class=\"error\">";
    global $errorb;
    $errorb = "</div>";

if (isset($_POST['btnSubmit'])) {

    global $uploadfile;
    $uploadfile = $_FILES["uploadImage"]["tmp_name"];
    global $folderRuta;
    //$folderRuta = "subidas/";
    $folderRuta = "../../Gch.Vdo.News/";

    // LIMITE 1000 KBytes (1Megabyte) * 1000 BYTES 
    global $limitimg;
    //$limitimg = 500 * 1000;
    $limitimg = 1000 * 1000;
    // LIMITE 50000 KBytes (50Megabyte) * 1000 BYTES
    global $limitvid;
    $limitvid= 60000 * 1000;
    /*
    LIMITE SERVIDOR KB
    global $limit_serv;
    $limit_serv = 70000 * 1000;
    */

    // SIZE DEL ARCHIVO EN KB
    global $tamanho;
    $tamanho = $_FILES['uploadImage']['size'];
    //echo $tamanho;
    // SIZE DEL ARCHIVO EN MB
    global $tamanhom;
    $tamanhom = number_format(($tamanho / 1000),2,",",".");

    $myimg = $_FILES["uploadImage"]["name"];
    global $myimg;
    $myimg = str_replace(" ","_",$myimg);

    global $extension;
    $extension = substr($_FILES["uploadImage"]["name"],-4);
    $extension = strtolower($extension);
    //print($extension)." Extension<br>";

    global $extvdo;
    $extvdo = str_replace(".","",$extension);
    global $new_name;
    $new_name = $_SESSION['myvdo'].".".$extvdo;

    //$ext_img = array('.jpg','.gif','.png','.bmp','jpeg');
    //$ext_imgok = in_array($extension, $ext_img);
    $ext_vid = array('.mp4','.avi','webm');
    $ext_vidok = in_array($extension, $ext_vid);

    
    echo "<h6>".$myimg."</h6>";
    //echo isset($ext_imgok)." Imagen <br>";
    //echo isset($ext_vidok)." Video <br>";
    
    /* PASE LO QUE PASE VALIDO EL LIMITE DEL SERVIDOR
    if($tamanho > $limit_serv){
        global $tamanhom;
        echo $errora."SUPERADO LIMITE SERVIDOR, MAYOR DE 70 MB: ".$tamanhom." MBytes".$errorb;
    }

    else*/
    if ((!is_writable($folderRuta)) || (!is_dir($folderRuta))) {
        echo $errora."error".$errorb;
    }
    // NO SE ADMITE LA EXTENSION
    elseif/*((!$ext_imgok)&&*/(!$ext_vidok)/*)*/{
        echo $errora."TIPO DE ARCHIVO NO ADMITIDO".$errorb;
    }
    // SE ADMITE LA EXTENSIÓN
    /*
    // SI EXISTE YA ESTE ARCHIVO
    elseif(file_exists(($folderRuta.$myimg))){
        echo $errora."ESTE ARCHIVO YA EXISTE".$errorb;
    }
    // SI ES IMGEN LIMITE DE SIZE
    elseif(($ext_imgok)&&($tamanho > $limitimg)){
            global $tamanhom;
            echo $errora."ARCHIVO NO PERMITIDO, MAYOR DE 1 MB: ".$tamanhom." MBytes".$errorb;
    }
    */
    // SI ES VIDEO LIMITE DE SIZE
    elseif(($ext_vidok)&&($tamanho > $limitvid)){
            global $tamanho;
            echo $errora."ARCHIVO NO PERMITIDO, MAYOR DE 50 MB: ".$tamanhom." MBytes".$errorb;
    }

    // SE PROCESA EL ARCHIVO
    // CARGA ETIQUETA IMG O VIDEO SEGUN TIPO ARCHIVO
    elseif(file_exists(($folderRuta.$myimg))){
            unlink($folderRuta.$myimg);

        if (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $folderRuta.$myimg)) {           
            if($ext_vidok){

            rename($folderRuta.$myimg, $folderRuta.$new_name);

            echo '<video class="myimg" controls><source src="'.$folderRuta.$new_name.'" /></video>';
            print("<!-- PARA CERRAR VENTANA POPUP  -->
        <form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
                <button type='submit' class=\"btn btn-primary mb-2\">CERRAR VENTANA</button>
        </form>
           
        <!-- PARA VOLVER SIN POPUP
        <form name='closewindow' action='../News_Modificar_01.php' >
                <button type='submit' class=\"btn btn-primary mb-2\">CERRAR Y VOLVER ADMIN SYST</button>
        </form> -->");

        global $db;
        global $db_name;
        global $tablename;
        $tablename = "gch_news";
        $tablename = "`".$tablename."`";
        $sqlc = "UPDATE `$db_name`.$tablename SET `myvdo` = '$new_name' WHERE $tablename.`refnews` = '$_SESSION[myvdo]' LIMIT 1 ";
        if(mysqli_query($db, $sqlc)){}
        else{   print("<font color='#FF0000'>
                            * ESTOS DATOS NO SON VALIDOS, MODIFIQUE ESTA ENTRADA: </font>
                            </br>
                            &nbsp;&nbsp;&nbsp;".mysqli_error($db))."
                            </br>";
                }
                exit();

            }else{  unlink($folderRuta.$new_name);
                    unlink($folderRuta.$myimg);
                    echo '<h6>NO HAY VISTA PREVIA</h6>';
                    exit();
                }
            }  // FIN UPLOADED_FILE                  
        }  // FIN IF FILE EXISTS

    elseif (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $folderRuta.$myimg)) {

        rename($folderRuta.$myimg, $folderRuta.$new_name);

        // SI LA EXTENSION ES DISTINTA BORRO EL ANTIGUO
        global $zvdo;
        $zvdo = $folderRuta.$_SESSION['myvdo'].".".$_SESSION['extdelvdo'];
        //echo "<br>*** ".$zvdo."<br>";
        if (($_SESSION['extdelvdo'] != $extvdo)&&(file_exists($zvdo))){
                unlink($zvdo);
        }else{}

        /*
        if($ext_imgok){
            echo "<img class='myimg' src='".$folderRuta.$myimg."' >";
            exit();
        }else*/if($ext_vidok){
           echo '<video class="myimg" controls><source src="'.$folderRuta.$new_name.'" /></video>';
        print("<!-- PARA CERRAR VENTANA POPUP -->
        <form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
                <button type='submit' class=\"btn btn-primary mb-2\">CERRAR VENTANA</button>
        </form>
        <!-- PARA VOLVER SIN POPUP
        <form name='closewindow' action='../News_Modificar_01.php' >
                <button type='submit' class=\"btn btn-primary mb-2\">CERRAR Y VOLVER ADMIN SYST</button>
        </form> -->");
        
        global $db;
        global $db_name;
        global $tablename;
        $tablename = "gch_news";
        $tablename = "`".$tablename."`";
        $sqlc = "UPDATE `$db_name`.$tablename SET `myvdo` = '$new_name' WHERE $tablename.`refnews` = '$_SESSION[myvdo]' LIMIT 1 ";
        if(mysqli_query($db, $sqlc)){}
        else{   print("<font color='#FF0000'>
                            * ESTOS DATOS NO SON VALIDOS, MODIFIQUE ESTA ENTRADA: </font>
                            </br>
                            &nbsp;&nbsp;&nbsp;".mysqli_error($db))."
                            </br>";
                }
           exit();

        }else{  unlink($folderRuta.$new_name);
                unlink($folderRuta.$myimg);
                echo '<h6>NO HAY VISTA PREVIA</h6>';
                exit();
            }
        } // FIN UPLOADED_FILE
    // SI NO SE PROCESA LA IMAGEN
    else {
        echo $errora."NO SE HA PODIDO GUARDAR EN ".$folderRuta.$myimg.$errorb;
    }

} // FIN isset($_POST['btnSubmit']

?>
