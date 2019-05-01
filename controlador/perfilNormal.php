<?php
if(isset($_GET['ced']) && !$_GET['ced'] == null){

require_once('controlador/conexion2.php');

$cedulaPersona = $_GET['ced'];

$result = mysqli_query($conn, "select id from persona where cedula = $cedulaPersona");
$row = mysqli_fetch_assoc($result);
$idPersona = $row['id'];
$_SESSION['idPersona'] = $idPersona;
$_SESSION['cedulaPersona'] = $cedulaPersona;
echo 
"<div display='none'>
    <script type='text/javascript'>
        console.log('$idPersona');
    </script>
</div>";

$result2 = mysqli_query($conn, "CALL infoPersona('$idPersona')"); 
$row2 = mysqli_fetch_assoc($result2);

$nombre = $row2['nombre'];
$ape01 = $row2['ape01'];
$ape02 = $row2['ape02'];
$cedula= $row2['cedula'];
$fechaNacimiento = $row2['fechaNacimiento'];
$correo = $row2['correo'];
$telefono = $row2['telefono'];
$img = $row2['img'];
$volver = "cancelarModificacionAdmin()";
echo 
"<div display='none'>
    <script type='text/javascript'>
        console.log('$nombre+$ape01+$ape02+$cedula+$fechaNacimiento+$correo+$telefono+$img');
    </script>
</div>";
}else{

  $nombre = $_SESSION['nombre'];
  $ape01 = $_SESSION['ape01'];
  $ape02 = $_SESSION['ape02'];
  $cedula= $_SESSION['cedula'];
  $fechaNacimiento = $_SESSION['fechaNacimiento'];
  $correo = $_SESSION['correo'];
  $telefono = $_SESSION['telefono'];
  $img = $_SESSION['img'];
  $volver = "cancelarModificacionPerfil()";
}

?>




<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePassword" aria-hidden="true" style="position: absolute;">
  <div class="modal-dialog" role="document" style="margin-top: 100px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiando contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form method="POST" action="controlador/updatePerfil.php?action=2" role="form" enctype="multipart/form-data">
      <div class="modal-body">

          <div class="form-group" style="width: 75%;margin: 10px auto;">
          <input type="password" class="form-control"  name="pass" required placeholder="Nueva contraseña" >
        </div>
        <div class="form-group" style="width: 75%;margin: 10px auto;">
          <input type="password" class="form-control"  name="passConfirm" required placeholder="Confirmar contraseña" >
        </div>
        </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>

    </div>
  </div>
</div>

<div class="modal fade" id="changeImage" tabindex="-1" role="dialog" aria-labelledby="changePassword" aria-hidden="true" style="position: absolute;">
  <div class="modal-dialog" role="document" style="margin-top: 100px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiando imagen de perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form method="POST" action="controlador/updatePerfil.php?action=3" role="form" enctype="multipart/form-data">
      <div class="modal-body">

          <div class="form-group">
               <input type="file" class="form-control-file" name="imgPerfil" required />
          </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>

    </div>
  </div>
</div>


<?php
     require_once('controlador/seguridad.php');
     require_once('controlador/header.php');
?>


<?php if (isset($_GET['log']) && $_GET['log'] == 'error'){     ?>
  <div class="alert alert-danger" role="alert">
    <h2 style="text-align: center;">Cedula existente. No hubo actualizacion</h2>
  </div>
<?php }else if (isset($_GET['log'])  && $_GET['log'] == 'exito'){     ?>
    <div class="alert alert-success" role="alert">
    <h2 style="text-align: center;">Perfil actualizado exitosamente</h2>
  </div>
<?php }else if (isset($_GET['log'])  && $_GET['log'] == 'exitopass'){     ?>
    <div class="alert alert-success" role="alert">
    <h2 style="text-align: center;">Contraseña cambiada exitosamente</h2>
  </div>
<?php }else if (isset($_GET['log'])  && $_GET['log'] == 'exitoimg'){     ?>
    <div class="alert alert-success" role="alert">
    <h2 style="text-align: center;">Foto de perfil cambiada exitosamente</h2>
  </div>
<?php }else if (isset($_GET['log']) && $_GET['log'] == 'errorpass'){     ?>
  <div class="alert alert-danger" role="alert">
    <h2 style="text-align: center;">Las contraseña no coinciden. Intenta de nuevo</h2>
  </div>
<?php } ?>

<div class="container">
  <!--<div class="btnVolver">
  <button type="submit" class="btn btn-secondary btn-lg" onclick="cancelarPerfil()">Volver</button>
  </div> -->

    <div class="cardPerfil">
      <div class="imagenPerfil">
         <div>
           <img src="<?php  echo $img; ?>" class="img-responsive" style="width: 100%;height: 100%; border-radius:20px ;">
         </div>

        <div class="botonesPerfil">
          <button type="button" data-toggle="modal" data-target="#changeImage" class="btn btn-primary btn-sm" style="width: 200px;">Cambiar imagen</button>
        </div>
         <div class="botonesPerfil">
          <button type="button" data-toggle="modal" data-target="#changePassword" class="btn btn-primary btn-sm" style="width: 200px;">Cambiar contraseña</button>
        </div>


    </div>
       
       <div style='margin-left: 350px;'>

      <div class="formPerfil">
       <form method="POST" id="crearPerfil" action="controlador/updatePerfil.php?action=1" role="form" enctype="multipart/form-data">

        <div class="card-body">
          
              <h3 style="text-align: center;"> Informacion Personal </h3>
              <hr>
              <label for="exampleFormControlInput1">Nombre Completo</label><br>
         <div class="row">
          <div class="col">
            <input type="text" class="form-control" name="name" placeholder="Nombre" value="<?php echo $nombre; ?>">
          </div>
          <div class="col">
            <input type="text" class="form-control" name="ape01" placeholder="Primer apellido" value="<?php echo $ape01; ?>"  required pattern="[A-Za-z]+">
          </div>
          <div class="col">
            <input type="text" class="form-control" name="ape02" placeholder="Segundo apellido" value="<?php echo $ape02; ?>"  required pattern="[A-Za-z]+">
          </div>
        </div>


        <div class="form-group">
          <label for="exampleFormControlInput1">Fecha de nacimiento</label>
          <input type="date" class="form-control"  name="fechaNacimiento" value="<?php echo $fechaNacimiento; ?>" required >
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">Cedula</label>
          <input type="text" class="form-control"  name="cedula" placeholder="Cedula" value="<?php echo $cedula; ?>"  required pattern="[0-9]+">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Telefono</label>
          <input type="text" class="form-control"  name="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>" required pattern="[0-9]+">
        </div>
           <div class="form-group">
          <label for="exampleFormControlInput1">Correo</label>
          <input type="text" class="form-control"  name="correo" placeholder="Correo" value="<?php  echo $correo; ?>">
        </div>

        <table style="margin:0px auto;">

            <tr>
              <td><button type="submit" class="btn btn-primary btn-sm">Actualizar</button></td>
              <td><button type="button" class="btn btn-secondary btn-sm" onclick="<?php echo $volver; ?>">Volver</button></td>
            </tr>

        </table>
        <br><hr>
      </div>
</form>

       </div>

      </div>

  </div>
    </div>

  </div>