<?php
  session_start();

  /* Creado por Juan Manuel Barros Pazos 2020/21 */

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Juan Barros Pazos - Team</title>

  <?php 
  
	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

  global $head;
  $head = "head2";
  require 'Inc_Header_Nav_Head_Total.php'; 
  //require 'Inc_Header_Nav_Head2.php'; 
  
  ?>

  <!-- Team -->
  <section class="bg-light page-section" id="team">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 text-center">
        <h2 class="section-heading text-uppercase">QUIENES SOMOS</h2>
          <h3 >
              DISEÑO, POSICIONAMIENTO Y PROGRAMACIÓN WEB
          </h3>
          <h6>
                  C/. UNA CALLE DE PALMA <br>
              <a href="contact.php#mapalink">IR AL MAPA DÓNDE ESTAMOS</a><br>
                  Tlf: 666666666 <br>
                  Email: ibfood@ibfood.es<br>
              <a href="contact.php#formlink">IR AL FORMULARIO DE CONTACTO</a>
          </h6>

          <h3 class="section-heading text-uppercase">NUESTRA HISTORIA</h3>
          <h5 class="text-muted">Lorem ipsum dolor sit amet consectetur.</h5>

          <h3 class="section-heading text-uppercase">NUESTROS VALORES</h3>
          <h5 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h5>

          <h3 class="section-heading text-uppercase">NUESTRA VISIÓN</h3>
          <h5 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h5>


          <h3 class="section-heading text-uppercase">NUESTRO EQUIPO</h3>
          <h5 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h5>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-4">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="../img/team/1.jpg" alt="">
            <h4>Kay Garland</h4>
            <p class="text-muted">Lead Designer</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="../img/team/2.jpg" alt="">
            <h4>Larry Parker</h4>
            <p class="text-muted">Lead Marketer</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="../img/team/3.jpg" alt="">
            <h4>Diana Pertersen</h4>
            <p class="text-muted">Lead Developer</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 mx-auto text-center">
          <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
        </div>
      </div>
    </div>
  </section>

  <?php require 'Inc_Footer.php';  ?> 

  <?php require 'Inc_Jquery_Boots_Foot.php';  ?>

</body>

</html>
