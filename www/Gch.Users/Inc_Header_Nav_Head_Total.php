<?php
  //session_start();

if ($headtot == "headu2") { session_start();
                            global $headbutton;
                            $headtot = "";
                            global $stylea;
                            $stylea = "";
                            global $styleb;
                            $styleb = "";
} elseif ($headtot == "head") {
    global $headbutton;
    $headbutton = "<button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">Menu<i class=\"fas fa-bars\"></i></button>";
    global $stylea;
    $stylea = "";
    global $styleb;
    $styleb = "";
} elseif ($headtot == "headu") { global $headbutton;
                                 $headtot = ""; 
                                 global $stylea;
                                 $stylea = "style=\"background-color:transparent !important;\"";
                                 global $styleb;
                                 $styleb = "style=\"padding-top: 12px !important;\"";
}  else { session_start();
        global $headbutton;
        $headbutton = "<button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">Menu<i class=\"fas fa-bars\"></i></button>";
        global $stylea;
        $stylea = "";
        global $styleb;
        $styleb = "";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Juan Barros Pazos - Users</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="../Gch.Img.Sys/favicon.png" type='image/ico' rel='shortcut icon' />
  
  <link href="../Gch.Css/conta.css" rel="stylesheet" type="text/css">

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="../css/agency.min.css" rel="stylesheet">

</head>

<?php
      require 'Only.index.user.php';

      if (isset($_POST['salir'])) { 
                      require '../Gch.Connet/conection.php';
                      require '../Gch.Connet/conect.php';
                      infoout();
                      sale_usuario();
                      salirf();
                      //session_destroy();
                      global $redir;
                      $redir = "<script type='text/javascript'>
                          function redir(){
                          window.location.href='../index.php';
                        }
                        setTimeout('redir()',1);
                        </script>";
                      print ($redir);
                  }

      if(isset($_POST['login'])){
            //process_login();
            /**/
            global $redir;
            $redir = "<script type='text/javascript'>
                function redir(){
                window.location.href='#';
                }
                setTimeout('redir()',1);
                </script>";
            print ($redir);
            
          }

//////////////////////////////////////////////////////////////////////////////////////////////

  function infoout() {

    global $ActionTime;
    $ActionTime = date('Y-m-d/H:i:s');

    global $logtext;
    $logtext = PHP_EOL.PHP_EOL."** FIN DE SESION => ".$ActionTime.PHP_EOL.".\t USER REF: ".$_SESSION['uref'].PHP_EOL.".\t USER NIVEL: ".$_SESSION['uNivel'].PHP_EOL.".\t USER: ".$_SESSION['uNombre']." ".$_SESSION['uApellidos'].PHP_EOL;

    require 'Inc_Log_Total.php';
    
 }

 function sale_usuario(){

    global $db;
    global $db_name;
    global $userid;
    $userid = $_SESSION['uid'];
        
    global $dateadout;
    $dateadout = date('Y-m-d/H:i:s');
        
    $sqladout = "UPDATE `$db_name`.`gch_user` SET `lastout` = '$dateadout' WHERE `gch_user`.`id` = '$userid' LIMIT 1 ";
            
    if(mysqli_query($db, $sqladout)){

	 } else { print("</br>
                <font color='#FF0000'>
            * FATAL ERROR funcion sale_usuario(): ".mysqli_error($db))."</font>
                </br>";
                  }

    }

    function salirf() {	unset($_SESSION['uid']);
                        unset($_SESSION['uNivel']);
                        unset($_SESSION['uNombre']);
                        unset($_SESSION['uApellidos']);
                        unset($_SESSION['uEmail']);
                        unset($_SESSION['uUsuario']);
                        unset($_SESSION['uPassword']);
                        unset($_SESSION['uDireccion']);
                        unset($_SESSION['uTlf1']);
                        unset($_SESSION['a']);
                      }

    function process_login(){
                      if((@$_SESSION['uNivel'] == 'useru')||(@$_SESSION['uNivel'] == 'adminu')){}
                      else { print("Acceso no permitido");}
                    }

//////////////////////////////////////////////////////////////////////////////////////////////

?>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav"
        <?php echo $stylea; ?>
    > <!-- FIN NAV -->

    <div class="container">

      <a class="navbar-brand js-scroll-trigger" href="../index.php?inicio=1">
        <!-- Juan Barros Pazos</a> -->
        <img src="../Gch.Img.Sys/LogoBMoll.png" class="imglogo" />
      </a>

    <?php echo $headbutton; ?>  

    <!-- 
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
    -->  

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="../index.php?inicio=1">INICIO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="../Gch.Www/mapas.php">MAPAS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="../Gch.Www/contact.php">CONTACTO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="../Gch.Www/team.php">NOSOTROS</a>
         </li>
         <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="../Gch.Www/services.php">SERVICIOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="../Gch.Www/news.php">NOTICIAS</a>
        </li>

        <?php
            if((@$_SESSION['uNivel'] == 'useru')||(@$_SESSION['uNivel'] == 'adminu')){ 
            print("<li class=\"nav-item\">
                      <a class=\"nav-link js-scroll-trigger\" href=\"User_Modificar_01.php\">
                        MIS DATOS
                      </a>
                    </li>
              <form name='cerrar' action='$_SERVER[PHP_SELF]' method='POST'>
                  <input type='submit' value='CLOSE SESSION' class=\"btn btn-primary\" />
                  <input type='hidden' name='salir' value=1 />
              </form>
                ");
            }
            else { 
              print("
              <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#exampleModalCenter\">
                        INICIAR SESION
               </button>");
                }
          ?>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="container">
    <div class="intro-text" <?php echo $styleb; ?> > <!-- FINAL DIV -->
        <!--
        <div class="intro-lead-in">Welcome To Juan Barros Pazos</div>
        -->
        <div class="intro-heading text-uppercase">IB FOOD</div>
        <?php
        if((@$_SESSION['uNivel'] == 'useru')||(@$_SESSION['uNivel'] == 'adminu')){ 
          global $h;
          $h = date('H');
          global $m;
          if(($h >= 6 )&&($h <= 13 )){ $m = "BUENOS DÍAS: "; }
          elseif(($h >= 14 )&&($h <= 21 )){ $m = "BUENAS TARDES: "; }
          elseif(($h >= 22 )&&($h <= 5 )){ $m = "BUENAS NOCHES: "; }
          print ("<h6 style=\"color: #fbaf00\">
                        ".$m.strtoupper($_SESSION['uNombre'])." ".strtoupper($_SESSION['uApellidos'])."
                  </h6>");
            } else { }

      /* Creado por Juan Manuel Barros Pazos 2020/21 */

      ?>
      </div>
    </div>
  </header>

