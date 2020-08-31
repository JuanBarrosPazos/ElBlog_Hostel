<?php
session_start();

	//require '../../Gch.Inclu/error_hidden.php';
	  require 'upvdo_head.php';

	  require '../../Gch.Connet/conection.php';
	  require '../../Gch.Connet/conect.php';
  
?>

<!-- Begin page content -->

<div class="container">

  <h5 class="mt-5">SOLO SE ADMINTEN VIDEOS INFERIORES A 50MG CON FORMATO MKV MP4 AVI WEBM</h5>
  <hr>

  <div class="row">
    <div class="col-12 col-md-12"> 

<!-- Contenido -->

<div class="form-container"> 

  <form class="form-inline" action="CargarArchivos.php" id="uploadForm" name="frmupload" method="post" enctype="multipart/form-data">

    <div class="form-group mx-sm-3 mb-2">
	  <input type="file" id="uploadImage" name="uploadImage" />
    </div>

    <button id="submitButton" type="submit" class="btn btn-primary mb-2" name='btnSubmit'>
      CARGAR VIDEO MKV MP4 AVI WEBM
    </button>
	  <button id="borrar" type="reset" class="btn btn-primary mb-2">BORRAR FORMULARIO</button>
  </form>

	<!-- PARA CERRAR VENTANA POPUP -->
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit="window.close()">
			<button type='submit' class="btn btn-primary mb-2">CERRAR VENTANA</button>
	</form>
	
	<!-- PARA VOLVER SIN POPUP 
	<form name='closewindow' action='../News_Modificar_01.php' >
			<button type='submit' class="btn btn-primary mb-2">CERRAR Y VOLVER ADMIN SYST</button>
	</form>
	-->

    <div class='progress' id="progressDivId">
        <div class='progress-bar' id='progressBar'></div>
        <div class='percent' id='percent'>0%</div>
    </div>
<!--   
    <div style="height: 10px;"></div>
-->
    <div id='salidaImagen'></div>

 </div>
 
 <!-- Fin Form-container -->  

      <!-- Fin Contenido --> 

    </div>
  </div>

  <!-- Fin row --> 
  
</div>
<!-- Fin container -->

<?php

	require 'upvdo_footer.php';

?>
