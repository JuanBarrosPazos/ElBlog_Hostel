<?php
  session_start();

  /* Creado por Juan Manuel Barros Pazos 2020/21 */

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Juan Barros Pazos - Clients</title>

  <?php 
  
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

  global $head;
  $head = "head2";
  require 'Inc_Header_Nav_Head_Total.php'; 
  //require 'Inc_Header_Nav_Head2.php'; 
  
  ?>

  <!-- Clients -->
  <section  class="page-section" id="clients">
    <div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Clients</h2>
          <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-3 col-sm-6">
          <a href="#">
            <img class="img-fluid d-block mx-auto" src="../img/logos/envato.jpg" alt="">
          </a>
        </div>
        <div class="col-md-3 col-sm-6">
          <a href="#">
            <img class="img-fluid d-block mx-auto" src="../img/logos/designmodo.jpg" alt="">
          </a>
        </div>
        <div class="col-md-3 col-sm-6">
          <a href="#">
            <img class="img-fluid d-block mx-auto" src="../img/logos/themeforest.jpg" alt="">
          </a>
        </div>
        <div class="col-md-3 col-sm-6">
          <a href="#">
            <img class="img-fluid d-block mx-auto" src="../img/logos/creative-market.jpg" alt="">
          </a>
        </div>
      </div>
    </div>
  </section>

  <?php require 'Inc_Footer.php';  ?> 

  <?php require 'Inc_Jquery_Boots_Foot.php';  ?>

</body>

</html>
