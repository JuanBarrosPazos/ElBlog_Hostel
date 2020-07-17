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
    require '../Gch.Users/Only.index.user.php';

//echo $_SESSION['a'];

    if (isset($_POST['salir'])) { 
                    session_destroy();
                    salir();
                    global $redir;
                    $redir = "<script type='text/javascript'>
                        function redir(){
                        window.location.href='portfolio.php?portfolio=".$_SESSION['a']."';
                      }
                      setTimeout('redir()',1);
                      </script>";
                    print ($redir);
                }

    if(isset($_POST['login'])){
          //process_login();
          global $redir;
          $redir = "<script type='text/javascript'>
              function redir(){
              window.location.href='portfolio.php?portfolio=".$_SESSION['a']."';
              }
              setTimeout('redir()',1);
              </script>";
          print ($redir);
        }


  function salir() {  unset($_SESSION['id']);
                      unset($_SESSION['Nivel']);
                      unset($_SESSION['Nombre']);
                      unset($_SESSION['Apellidos']);
                      unset($_SESSION['doc']);
                      unset($_SESSION['Email']);
                      unset($_SESSION['Usuario']);
                      unset($_SESSION['Password']);
                      unset($_SESSION['Direccion']);
                      unset($_SESSION['Tlf1']);
                    }

  function process_login(){
                    if ($_SESSION['Nivel'] == 'user'){}
                    else { print("Acceso no permitido");}
                  }

//////////////////////////////////////////////////////////////////////////////////////////////

?>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">

      <a class="navbar-brand js-scroll-trigger" href="../index.php">
        <!-- Juan Barros Pazos</a> -->
        <img src="../Gch.Img.Sys/LogoBMoll.png" class="imglogo" />
      </a>

      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="../index.php?inicio=1">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="mapas.php">MAPAS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="contact.php">CONTACTO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="team.php">NOSOTROS</a>
         </li>
         <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="services.php">SERVICIOS</a>
        </li>

        <?php
            if($_SESSION['Nivel'] == 'user'){ 
            print(" <li class=\"nav-item\">
              <a class=\"nav-link js-scroll-trigger\" href=\"../Gch.Users/User_Modificar_01.php\">
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
            <a class="nav-link js-scroll-trigger" href="portfolio.php">PORTFOLIO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="clients.php">CLIENTES</a>
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
        if(@$_SESSION['Nivel'] == 'user'){ 
          global $h;
          $h = date('H');
          global $m;
          if(($h >= 6 )&&($h <= 13 )){ $m = "BUENOS DÍAS: "; }
          elseif(($h >= 14 )&&($h <= 21 )){ $m = "BUENAS TARDES: "; }
          elseif(($h >= 22 )||($h <= 5 )){ $m = "BUENAS NOCHES: "; }
          print ("<h6 style=\"color: #cfcfcf\">
                        ".$m.$_SESSION['Nombre']." ".$_SESSION['Apellidos']."
                  </h6>");
            } else { }
      ?>
      </div>
    </div>
  </header>

