<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Juan Barros Pazos - Contact</title>

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
                      //session_destroy();
                      salirf();
                      /**/
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

    function salirf() {	unset($_SESSION['uid']);
                        unset($_SESSION['uNivel']);
                        unset($_SESSION['uNombre']);
                        unset($_SESSION['uApellidos']);
                        unset($_SESSION['udoc']);
                        unset($_SESSION['uEmail']);
                        unset($_SESSION['uUsuario']);
                        unset($_SESSION['uPassword']);
                        unset($_SESSION['uDireccion']);
                        unset($_SESSION['uTlf1']);
                    }

    function process_login(){
                      if((@$_SESSION['uNivel'] == 'useru')||(@$_SESSION['uNivel'] == 'adminu')){}
                      else { print("Acceso no permitido");}
                    }

//////////////////////////////////////////////////////////////////////////////////////////////

?>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" >
    <div class="container">

      <a class="navbar-brand js-scroll-trigger" href="../index.php">
        <!-- Juan Barros Pazos</a> -->
        <img src="../Gch.Img.Sys/LogoBMoll.png" class="imglogo" />
      </a>

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

        <!--
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="../Gch.Www/portfolio.php">PORTFOLIO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="../Gch.Www/clients.php">CLIENTES</a>
          </li>
        -->
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
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
          print ("<h6 style=\"color: #cfcfcf\">
                        ".$m.$_SESSION['uNombre']." ".$_SESSION['uApellidos']."
                  </h6>");
            } else { }
      ?>
      </div>
    </div>
  </header>

