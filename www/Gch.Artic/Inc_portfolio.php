<?php
session_start();

    require '../Gch.Connet/conection.php';
    require '../Gch.Connet/conect.php';

    process_form();

function process_form(){

    global $db;
    global $db_name;

    if ((isset($_GET['portfolio'])) || (isset($_POST['portfolio']))) {

            global $refrest;
            
        if ((!isset($_GET['portfolio'])) && (isset($_POST['portfolio']))){
            $refrest = $_POST['portfolio'];
            $_SESSION['a'] = $_POST['portfolio'];
                                }
        elseif (isset($_GET['portfolio'])){
            $refrest = $_GET['portfolio'];
            $_SESSION['a'] = $_GET['portfolio'];
                                }
        else { $refrest = $_SESSION['refartop']; 
                $_SESSION['a'] = $_SESSION['refartop'];
                                        }
           //$refrest = "2020.06.16.13.18.15";
           global $sqla;
          $sqla =  " SELECT * FROM `$db_name`.`gch_art` WHERE `refart` = '$refrest' LIMIT 1 ";
         //echo "TENEMOS DATOS GET".$_GET['portfolio'];
                        }
    else {  global $sqla;
            $sqla=  "SELECT * FROM `$db_name`.`gch_art` ORDER BY `id` ASC LIMIT 1 ";
            //echo "NO HAY DATOS GET";
                }

    $qa = mysqli_query($db, $sqla);

if(!$qa){ print("* ".mysqli_error($db)."</br>");
} else { 
        while($rowb = mysqli_fetch_assoc($qa)){

            require '../Gch.Artic/Inclu_Name_Ref_to_Name.php';
            require '../Gch.Artic/Inclu_Valora_Calculos.php';

            $_SESSION['refartop'] = $rowb['refart'];
            $_SESSION['mailto'] = $rowb['Email'];
            $_SESSION['titulo'] = $rowb['tit'];

            // DEFINO EL BOTON DE VALORACIONES
            global $opina;
            $opina = "<form style=\"display: block; margin:0.4em 0em -4em 0em;\" name='creaopina' action='../Gch.Syst/Opina_Cliente.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px, height=580px')\">
                <input name='id' type='hidden' value='".$rowb['id']."' />
                <input name='refart' type='hidden' value='".$rowb['refart']."' />
                <input name='tit' type='hidden' value='".$rowb['tit']."' />
                <input name='titsub' type='hidden' value='".$rowb['titsub']."' />
                <input name='isla' type='hidden' value='".$rowb['refisla']."' />
                <input name='ayto' type='hidden' value='".$rowb['refayto']."' />
                <input name='myimg1' type='hidden' value='".$rowb['myimg1']."' />
                <input type='submit' value='VALORAR ESTE RESTAURANTE' />
                <input type='hidden' name='oculto2' value=1 />
            </form>";

            global $nombrerest;
            $nombrerest = $rowb['tit'];

            // DEFINO LAS IMAGENES
            global $img1;
            $img1 = "<div class='protfolioimg'>
                        <img class='img-fluid'  src='../Gch.Img.Art/".$rowb['myimg1']."' alt=''>
                    </div>";
            global $img1b;
            $img1b = "<img class='img-fluid d-block mx-auto' src='../Gch.Img.Art/".$rowb['myimg1']."' alt=''>";
            global $img2;
            $img2 = "<div class='protfolioimg'>
                        <img class='img-fluid' src='../Gch.Img.Art/".$rowb['myimg2']."' alt=''>
                    </div>";
            global $img2b;
            $img2b = "<img class='img-fluid d-block mx-auto' src='../Gch.Img.Art/".$rowb['myimg2']."' alt=''>";
            global $img3;
            $img3 = "<div class='protfolioimg'>
                        <img class='img-fluid' src='../Gch.Img.Art/".$rowb['myimg3']."' alt=''>
                    </div>";
            global $img3b;
            $img3b = "<img class='img-fluid d-block mx-auto' src='../Gch.Img.Art/".$rowb['myimg3']."' alt=''>";
            global $img4;
            $img4 = "<div class='protfolioimg'>
                        <img class='img-fluid' src='../Gch.Img.Art/".$rowb['myimg4']."' alt=''>
                    </div>";
            global $img4b;
            $img4b = "<img class='img-fluid d-block mx-auto' src='../Gch.Img.Art/".$rowb['myimg4']."' alt=''>";

            global $especialidades;
            $especialidades = "Tipo de Local: ".$tipname."<br> Especialidades: ".$espec1name." / ".$espec2name."<br>";

            // DEFINO EL MAPA
            /* PARA CARGAR EL MAPA EN LA WEB PODEMOS UTILIZAR LAS DOS FORMAS, CON IFRAME O CON EMBED.
            EN LOS DOS CASOS PASAMOS LA URL DEL IFRAME QUE NOS DA GOOGLE AL COMPARTIR EL MAPA,
            LA URL CORTA O NORMAL LO UTILIZO SÓLO PARA UN ENLACE DIRECTO AL MAPA GOOGLE.*/
            global $mapa;
           // $mapa = "<embed class='vidf'src='".$rowb['mapiframe']."' frameborder='0' style='border:0;' allowfullscreen=''></embed>";
            $mapa = "<iframe class='vidf' src='".$rowb['mapiframe']."' frameborder='0' style='border:0;' allowfullscreen=''></iframe>";

            // DEFINO LAS VARIABLES DE INFORMACIÓN GENERAL
            global $calle;
            $calle = "C/. ".$rowb['calle']." &nbsp;&nbsp;<a style=\"display: inline-block;\" href=\"".$rowb['map']."\" target=\"_blank\">DÓNDE ESTAMOS</a> <br>";
            global $url;
            $url = "<a href=\"".$rowb['url']."\" target=\"_blank\">WEB SITE</a><br>";
            global $email;
            $email = "<a href=\"portfolio.php?portfolio=".$rowb['refart']."#formlink\">FORMULARIO DE RESERVAS</a><br>";
            global $tlf;
            $tlf = "Tfl1: ".$rowb['Tlf1']." / Tlf2".$rowb['Tlf2']."&nbsp;&nbsp;";
            } // FIN WHILE MASTER
        } // FIN ELSE WHILE MASTER


} // FIN PROCESS_FOMR()

?>