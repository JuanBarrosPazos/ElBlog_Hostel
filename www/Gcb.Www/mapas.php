<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Juan Barros Pazos - Portfolio</title>

  <?php 

      require '../Gcb.Connet/conection.php';
      require '../Gcb.Connet/conect.php';

      require 'Inc_Header_Nav_Head2.php'; 

      global $opina;

      if (@$_SESSION['Nivel'] == 'user'){ }
      else {
      $opina = "<br>
       <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#exampleModalCenter\" style=\"margin: 0.6em 0em -3.0em -0em;\">
                PARA OPINAR SOBRE ESTE LOCAL INICIAR SESION 
       </button>";
        }
  ?>

  
  <!-- Portfolio Grid -->
  <section class="bg-light page-section" id="portfolio">
    <div class="container">

      <?php

        require 'Inc_mapas_form.php';

      ?>

<!--
<script type="text/javascript">

    var map;
		var centerll = {lat: 39.401008, lng: 2.756768};
    
    function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    center: centerll,
    zoom: 8
    });
    
    var marker1 = new google.maps.Marker({
    position: centerll,
    map:map
    });
    
    var marker2 = new google.maps.Marker({
    position: {lat: 38.912259, lng: 1.424649},
    map:map
    });

    var marker3 = new google.maps.Marker({
    position: {lat: 39.591669, lng: 2.647381},
    map:map
    });
    
    var marker4 = new google.maps.Marker({
    position: {lat: 38.705490, lng: 1.428705},
    map:map
    });
    
    var marker5 = new google.maps.Marker({
    position: {lat: 38.907347, lng: 1.429541},
    map:map
    });
    
    var marker6 = new google.maps.Marker({
    position: {lat: 38.914086, lng: 1.443087},
    map:map
    });
    
    var marker7 = new google.maps.Marker({
    position: {lat: 38.917723, lng: 1.443813},
    map:map
    });
    
    var marker8 = new google.maps.Marker({
    position: {lat: 38.928570, lng: 1.452452},
    map:map
    });
    
    var marker9 = new google.maps.Marker({
    position: {lat: 39.563928, lng: 2.658283},
    map:map
    });
    
    var marker10 = new google.maps.Marker({
    position: {lat: 39.569065, lng: 2.667335},
    map:map
    });
    
    }
  
 </script>
-->

<div style="clear:both"></div>
<div class="row">
        <div class="juancentra">
          
          <!-- VISUALIZO EL MAPA CON LAS POSICIONES
                YA SEAN MEDIANTE BBDD O CON DATOS MANUALES -->
                <div class='vidf' id="map" style="display:block !important" ></div>

        </div>
</div>

    </div> <!-- FIN CONTAINER -->
  </section>
  

<script async defer 
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARE4CKZ7TaoIjACPRduNigIzlCAiezuFE&callback=initMap" type="text/javascript"></script>


  <?php 
  
  require 'Inc_Footer.php';  
  require 'Inc_Jquery_Boots_Foot.php';  
  
  ?>

</body>

</html>
