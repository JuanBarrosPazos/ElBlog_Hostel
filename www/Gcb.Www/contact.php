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

  <title>Juan Barros Pazos - Contact</title>

  <?php 

    require '../Gcb.Connet/conection.php';
    require '../Gcb.Connet/conect.php';

    require 'Inc_Header_Nav_Head2.php';

  ?>

  <!-- Contact -->
  <section class="page-section" id="contact">
    <div class="container">



    <div class="row">
        <div class="col-lg-12 text-center" style="color: #ababab">
          <div style="clear:both; display: block; margin: 0.6em 0em 0.6em 0em;" id='mapalink' ></div>
          <h4 >
              DISEÑO, POSICIONAMIENTO Y PROGRAMACIÓN WEB
          </h4>
          <h6>
              C/. UNA CALLE DE PALMA <br>
              Tlf: 666666666 <br>
              Email: ibfood@ibfood.es<br>
              <a href="#formlink">IR AL FORMULARIO DE CONTACTO</a>
              
          </h6>
        </div>

      <!-- MAPA -->
        <div class="juancentra">
        <!--
          <embed class='vidf'src='https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3075.5997770189756!2d2.6670561!3d39.568631!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x55bc574de040df4a!2sCIFP%20Francesc%20de%20Borja%20Moll!5e0!3m2!1ses!2ses!4v1593844861566!5m2!1ses!2ses' frameborder='0' style='border:0;' allowfullscreen=''>
          </embed>
        -->

        <iframe class='vidf' src='https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3075.5997770189756!2d2.6670561!3d39.568631!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x55bc574de040df4a!2sCIFP%20Francesc%20de%20Borja%20Moll!5e0!3m2!1ses!2ses!4v1593844861566!5m2!1ses!2ses' frameborder='0' style='border:0;' allowfullscreen=''>
        </iframe>

        </div>
      </div>

  <?php 

    // LLAMO AL FORMULARIO DE CONTACTO
    require 'Inc_Contact_Form.php';

  ?>

    </div>
  </section>

  <?php require 'Inc_Footer.php';  ?> 

  <?php require 'Inc_Jquery_Boots_Foot.php';  ?>

</body>

</html>
