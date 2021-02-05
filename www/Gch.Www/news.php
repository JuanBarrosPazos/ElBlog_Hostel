<?php
  session_start();

  /* Creado por Juan Manuel Barros Pazos 2020/21 */

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Juan Barros Pazos - News</title>

  <?php 

	require '../Gch.Connet/conection.php';
	require '../Gch.Connet/conect.php';

  global $head;
  $head = "head2";
  require 'Inc_Header_Nav_Head_Total.php'; 
  //require 'Inc_Header_Nav_Head2.php'; 
 
  ?>

  <!-- About -->
  <section class="page-section" id="about">
    <div class="container">

    <?php require '../Gch.News/News_Ver_news.php'; ?>

  </div> <!-- Fin container -->
</section>

  <?php require 'Inc_Footer.php';  ?> 

  <?php require 'Inc_Jquery_Boots_Foot.php';  ?>

</body>

</html>
