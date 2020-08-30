<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Juan Barros Pazos - Inicio</title>

  <link href="Gch.Img.Sys/favicon.png" type='image/ico' rel='shortcut icon' />

  <link href="Gch.Css/conta.css" rel="stylesheet" type="text/css">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/agency.min.css" rel="stylesheet">

  <meta name="google-site-verification" content="mOfK4hpECAN7aBamd4ARwyO6Ap2UWpNwlFALRwbC9kk" />
  
</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">

      <a class="navbar-brand js-scroll-trigger" href="index.php?inicio=1">
        <!-- Juan Barros Pazos -->
        <img src="Gch.Img.Sys/LogoBMoll.png" class="imglogo" />
      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php?inicio=1">VER TODOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="Gch.Www/mapas.php">MAPAS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="Gch.Www/contact.php">CONTACTO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="Gch.Www/team.php">NOSOTROS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="Gch.Www/services.php">SERVICIOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="Gch.Www/news.php">NOTICIAS</a>
        </li>

        <?php
            if((@$_SESSION['uNivel'] == 'useru')||(@$_SESSION['uNivel'] == 'adminu')){ 
            print(" <li class=\"nav-item\">
                      <a class=\"nav-link js-scroll-trigger\" href=\"Gch.Users/User_Modificar_01.php\">
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
          print ("<h6 style=\"color: #fbaf00\">
                        ".$m.strtoupper($_SESSION['uNombre'])." ".strtoupper($_SESSION['uApellidos'])."
                  </h6>");
            } else { }
      ?>
      </div>
    </div>
  </header>

  <!-- About -->
  <section class="page-section" id="about">
    <div class="container">

      <?php 
      
        require 'Gch.Artic/Art_Ver_index.php'; 

      ?>

    </div> <!-- Fin container -->
  </section>

<!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <span class="copyright">Copyright &copy; Juan Barros Pazos 2020</span>
        </div>
        <div class="col-md-4">
        <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="https://twitter.com/JuanBarrosPazos" target="_blank">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.facebook.com/juan.barrospazos" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.linkedin.com/in/juan-barros-pazos-b0072a152/" target="_blank">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="list-inline quicklinks">
            <li class="list-inline-item">
              <a href="index.php?inicio=1">Privacy Policy</a>
            </li>
            <li class="list-inline-item">
              <a href="index.php?inicio=1">Terms of Use</a>
            </li>
            <li class="list-inline-item">
              <a href="Gch.Admin/access.php" target="_blank">Admin Access</a>
            </li>
         </ul>
        </div>
      </div>
    </div>
  </footer>

  <?php
    require 'Gch.Www/Inc_Boton_Modali.php';
  ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Contact form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/agency.min.js"></script>

</body>

</html>
