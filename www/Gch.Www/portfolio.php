<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<script type="text/JavaScript">

// Esta función limita el número de carácteres del text area de comentarios.
function limita(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("mensaje");
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  // Permitir utilizar las teclas con flecha horizontal
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }
 
  // Permitir borrar con la tecla Backspace y con la tecla Supr.
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 
function actualizaInfo(maximoCaracteres) {
  var elemento = document.getElementById("mensaje");
  var info = document.getElementById("info");
 
  if(elemento.value.length >= maximoCaracteres ) {
    info.innerHTML = "Máximo "+maximoCaracteres+"caracteres";
  }
  else {
    info.innerHTML = "You can write up to "+(maximoCaracteres-elemento.value.length)+" additional characters";
  }
}
// Tendremos que dar el id que tenga el text area y añadir onkeypress="return limita(event, 200);" onkeyup="actualizaInfo(200)" para limitar los caracteres a 200 en este caso.
function MM_validateForm() { 
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }

</script>


  <title>Juan Barros Pazos - Portfolio</title>

  <?php 

      require '../Gch.Connet/conection.php';
      require '../Gch.Connet/conect.php';

      require '../Gch.Users/Only.index.user.php';

      require '../Gch.Artic/Inc_portfolio.php';

      global $head;
      $head = "headp";
      require 'Inc_Header_Nav_Head_Total.php'; 
      //require 'Inc_Header_Nav_Headp.php'; 

    /*
      if((@$_SESSION['uNivel'] == 'useru')||(@$_SESSION['uNivel'] == 'adminu')){ }
      else {
      global $opina;
      $opina = "<br>
       <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#exampleModalCenter\" style=\"margin: 0.6em 0em -3.0em -0em;\">
                PARA OPINAR SOBRE ESTE LOCAL INICIAR SESION 
       </button>";
        }
    */
  ?>

  
  <!-- Portfolio Grid -->
  <section class="bg-light page-section" id="portfolio">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">
              <?php echo $nombrerest; ?>
          </h2>
          <h3 class="section-subheading text-muted">
              <?php 
              echo $especialidades.$islaname." / ".$aytoname."<br>
                  N.Val: ".$num_val." Local Servicio: ".$valx100."%
                  <div class=\"progresa\">
                    <div class=\"progresab\" style=\"width:".$valx100."%;\">
                    </div>
                    <img class=\"star2\" src='../Gch.Img.Sys/5Star.png' />
                  </div>
                  <br>
        
                  Indice de Precios ".$val2x100."%
                  <div class=\"progresa\">
                    <div class=\"progresab\" style=\"width:".$val2x100."%;\">
                    </div>
                    <img class=\"star2\" src='../Gch.Img.Sys/5Star.png' />
                  </div>
                  <br>".$calle.$url.$email.$tlf.$opina; ?>
          </h3>
        </div>
      </div>

          <!-- DEFINO EL VIDEO SI EXISTE -->
          <?php echo $vdonw; ?>

      <div class="row">

        <div class="col-md-3 col-sm-6 portfolio-item" style="padding:0px 2px 0px 2px">
                <?php echo $img1; ?>
        </div>

        <div class="col-md-3 col-sm-6 portfolio-item" style="padding:0px 2px 0px 2px">
                <?php echo $img2; ?>
        </div>

        <div class="col-md-3 col-sm-6 portfolio-item" style="padding:0px 2px 0px 2px">
                <?php echo $img3; ?>
        </div>

        <div class="col-md-3 col-sm-6 portfolio-item" style="padding:0px 2px 0px 2px">
                <?php echo $img4; ?>
        </div>

        <div class="juancentra">
                <?php echo $mapa; ?>
        </div>
    </div>
    

    <!-- LLAMO AL FORMULARIO -->
    <?php

    // LLAMO AL FORMULARIO DE CONTACTO

      require '../Gch.Artic/Inc_portfolio_mail_form.php';

    ?>
    <!-- FIN LLAMO FORMULARIO -->


    <div class="row">
        <div class="col-lg-12 text-center" style="margin:0.1em 0em 2em 0em;">
            <h2 class="section-heading text-uppercase" style="text-align: center; margin: -1.6em 0em 0.3em 0em">
                OPINIONES Y VALORACIONES
            </h2>
    <?php

     // DEFINO LAS OPINIONES QUE ESTAN VALIDADAS OK POR EL ADMINISTRADOR
        global $db;
        global $db_name;
        global $refartop;
        $refartop = $_SESSION['refartop'];
        //echo "******** ".$refartop;
        $sqlop =  "SELECT * FROM `$db_name`.`gch_opiniones` WHERE `refart` = '$refartop' AND `modera` = 'y' ORDER BY `id` DESC ";
        $qop = mysqli_query($db, $sqlop);
        if(!$qop){
			print("<font color='#FF0000'>Consulte L.106: </font></br>".mysqli_error($db)."</br>");
		} else {
			if(mysqli_num_rows($qop )== 0){
				print ("<table align='center'>
							<tr><td>
								<font color='#FF0000'>** NO HAY DATOS</font>
							</td></tr>
					    </table>");
			} else { 
          while($rowop = mysqli_fetch_assoc($qop)){
    //require '../Gch.Artic/Inclu_Name_Ref_to_Name.php';
    print ("<div  class=\"col-xs-12 col-sm-12 col-md-8 juancentracoment\" >
                    <div style=\"display: inline-block;\";>
                      * FECHA ".$rowop['datein']."
                    </div> 
                    <div style=\"display: inline-block;\";>
                      * USUARIO ".$rowop['refuser']."
                    </div> 
                    <div style=\"display: inline-block;\";>
                      * SERVICIO Y LOCAL ".$rowop['valora']." DE 5
                    </div> 
                    <div style=\"display: inline-block;\";>
                      * PRECIOS ".$rowop['precio']." DE 5
                    </div>
                    <div style=\"display: inline-block;\";>
                      * COMENTARIOS : ".$rowop['opina']."
                    </div>
            </div>");
                    } // FIN WHILE DATOS
                } // FIN ELSE wHILE
            } // FIN ELSE OPINIONES OK
        ?>
    </div> <!-- FIN OPINIONES Y VALORACIONES -->

    </div>

    </div>
  </section>

  <?php require 'Inc_Footer.php';  ?> 

  <?php require 'Inc_Jquery_Boots_Foot.php';  ?>

  <!-- Dependencias LightBox -->
  <link rel="stylesheet" href="css/lightbox.min.css">
  <script src="js/lightbox-plus-jquery.min.js"></script>
</body>

</html>
