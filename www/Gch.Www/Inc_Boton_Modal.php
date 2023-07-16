  <!-- BOTON MODAL -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">

      <h5 class="modal-title" id="exampleModalCenterTitle">

<form style="display: inline-block;" name='veropina' action='../Gch.Users/User_Crear.php' target='popup' method='POST' onsubmit="window.open('', 'popup', 'width=460px, height=680px')">
<input type='submit' value='REGISTRARME COMO USUARIO' />
</form>

      </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <!-- INICIO FORMULARIO INICIO SESION -->
        <?php
        print("
        <form class=\"form-signin text-center\" name='log' method='post' action='$_SERVER[PHP_SELF]'>
        ");

        /* Creado por Juan Manuel Barros Pazos 2020/21 */

        ?>

          <img class="mb-4" src="../Gch.Img.Sys/LogoBMoll.png" alt="" width="40%" height="40%">

          <input autofocus tabindex="1" type='Password' name='Usuario' class="form-control" placeholder="USUARIO" required>
          <input tabindex="2" type='Password' name='Password' class="form-control" placeholder="PASSWORD" required>

          <button  class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
				  <input type='hidden' name='login' value=1 />
        </form>
        <!-- FIN FORMULARIO INICIO SESION -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN BOTON MODAL -->
 
<!-- Optional JavaScript -->

    <!--
    <script src="js/jquery-3.2.1.slim.min.js"></script>
        
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
-->
