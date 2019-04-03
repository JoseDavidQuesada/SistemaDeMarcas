<?php
session_start();
?>

<html>
<head>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <link rel="stylesheet" type="text/css" href="css/style.css"/>
 <link rel="stylesheet" type="text/css" href="css/custom.css"/>
  <link rel="stylesheet" type="text/css" href="css/reloj.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>

<?php 
     require_once('controlador/seguridad.php');
     require_once('controlador/header.php');

    if(!isset($_GET['log'])){
      
      $_SESSION['Fnombre'] = null;
      $_SESSION['Fape01'] = null;
      $_SESSION['Fape02'] = null;
      $_SESSION['Fnacimiento'] = null;
      $_SESSION['Fcedula'] = null;
      $_SESSION['Ftipo'] = null;
      $_SESSION['Fuser'] = null;
    }
   

    if(isset($_SESSION['Fnombre'])){
        $nombre = $_SESSION['Fnombre']; 
    }else{
      $nombre = null;
   }
    if(isset($_SESSION['Fape01'])){
        $ape01 = $_SESSION['Fape01']; 
    }else{
      $ape01 = null;
   }
    if(isset($_SESSION['Fape02'])){
       $ape02 = $_SESSION['Fape02']; 
    }else{
      $ape02 = null;
   }
    if(isset($_SESSION['Fnacimiento'])){
        $FechaNacimiento = $_SESSION['Fnacimiento']; 
    }else{
      $FechaNacimiento = null;
   }
     if(isset($_SESSION['Fcedula'])){
        $cedula = $_SESSION['Fcedula']; 
    }else{
      $cedula = null;
   }

    if(isset($_SESSION['Ftipo'])){
        $tipo = $_SESSION['Ftipo']; 
    }else{
      $tipo = null;
   }
    if(isset($_SESSION['Fuser'])){
      $user = $_SESSION['Fuser']; 
  }else{
    $user = null;
    
 }
 /*if(isset($_SESSION['Fimg'])){
  $img = $_SESSION['Fimg']; var_dump($img);

  /*$resultado = "'<input type='file' class='form-control-file' name='imgPerfil' value='<pre class='xdebug-var-dump' dir='ltr'>"
   
   . "<b>array</b> <i>(size=5)</i>"
   . "'name' <font color='#888a85'>=></font> <small>string</small> <font color='#cc0000'>'Hola como estas'</font> <i>(length=0)</i>"
   . "'type' <font color='#888a85'>=></font> <small>string</small> <font color='#cc0000'></font> <i>(length=0)</i>"
   . "'tmp_name' <font color='#888a85'>=></font> <small>string</small> <font color='#cc0000'>''</font> <i>(length=0)</i>"
   . "'error' <font color='#888a85'>=></font> <small>int</small> <font color='#4e9a06'>4</font>"
   . "'size' <font color='#888a85'>=></font> <small>int</small> <font color='#4e9a06'>0</font>"
   . "</pre>"; 
   //$resultado = $img;
 }else{
  $img = "";
  $resultado = "";
 }*/

?>

<?php if (isset($_GET['log']) && $_GET['log'] == 'errorUser'){     ?>
  <div class="alert alert-danger" role="alert">
    <h2 style="text-align: center;">El usuario ya existe. Intenta con otro nombre de usuario</h2>
  </div>
<?php }else if (isset($_GET['log'])  && $_GET['log'] == 'errorPass'){     ?>
    <div class="alert alert-danger" role="alert">
    <h2 style="text-align: center;">Las contraseñas no coinciden</h2>
  </div>
<?php }else if (isset($_GET['log'])  && $_GET['log'] == 'exito'){     ?>
    <div class="alert alert-success" role="alert">
    <h2 style="text-align: center;">Perfil creado exitosamente</h2>
  </div>
  <?php } ?>

<div class="container">
  <div class="btnVolver">
  <button type="submit" class="btn btn-secondary btn-lg" onclick="cancelarPerfil()">Volver</button>
  </div>

  <div class="cardAdmin">

  <form method="POST" id="crearPerfil" action="controlador/crearPerfil.php" role="form" enctype="multipart/form-data">

    <div class="card-body">
      
          <h1 style="text-align: center; padding-bottom: 35px;"> Creando perfil </h1>
          <label for="exampleFormControlInput1">Nombre Completo</label><br>
     <div class="row">
      <div class="col">
        <input type="text" class="form-control" name="name" placeholder="Nombre"  value="<?php echo $nombre; ?>" required pattern="[A-Za-z]+">
      </div>
      <div class="col">
        <input type="text" class="form-control" name="ape01" placeholder="Primer apellido" value="<?php echo $ape01; ?>" required pattern="[A-Za-z]+">
      </div>
      <div class="col">
        <input type="text" class="form-control" name="ape02" placeholder="Segundo apellido" value="<?php echo $ape02; ?>" required pattern="[A-Za-z]+">
      </div>
    </div>


    <div class="form-group">
      <label for="exampleFormControlInput1">Fecha de nacimiento</label>
      <input type="date" class="form-control"  name="fechaNacimiento" value="<?php echo $FechaNacimiento; ?>" required >
    </div>

    <div class="form-group">
      <label for="exampleFormControlInput1">Cedula</label>
      <input type="text" class="form-control"  name="cedula" placeholder="Cedula" value="<?php echo $cedula; ?>" required pattern="[0-9]+">
    </div>

    
    <div class="form-group">
      <label for="exampleFormControlFile1">Foto de perfil</label>
      <input type="file" class="form-control-file" name="imgPerfil" required/>
    </div>
    <br><hr>

    <h1 style="text-align: center; padding-bottom: 35px;"> Creando Usuario </h1>

    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Tipo de usuario</label>
    <select class="custom-select my-1 mr-sm-2" name="tipo"style="width:50%;" required>
      <option selected value="1">Normal</option>
      <option value="2">Administrador</option>
      <option value="3">Jefe</option>
    </select><br><br>

    <?php if (isset($_GET['log']) && $_GET['log'] == 'errorUser'){     ?>
      <div class="form-group" style="width:50%;">
      <input type="text" class="form-control is-invalid"  name="user" value="<?php echo $user; ?>"  required placeholder="Nombre de usuario" >
      <div class="invalid-feedback" style="width:100%; font-size: 16px;">
          *Ingresa otro nombre de usuario.
      </div>
    </div>
    <?php }else{  ?>

      <div class="form-group" style="width:50%;">
        <input type="text" class="form-control"  name="user" value="<?php echo $user; ?>"  required placeholder="Nombre de usuario" >
      </div>
    <?php } ?>


  <?php if (isset($_GET['log']) && $_GET['log'] == 'errorPass'){     ?>
    <div class="form-group" style="width:50%;">
      <input type="password" class="form-control is-invalid"  name="pass" required placeholder="Contraseña" >
    </div>
    <div class="form-group" style="width:50%;">
      <input type="password" class="form-control is-invalid"  name="passConfirm" required placeholder="Confirmar contraseña" >
      <div class="invalid-feedback" style="width:100%; position: absolute; font-size: 16px;">
          *Contraseñas no coinciden. Porfavor ingresar la misma contraseña.
      </div><br>
    </div><br><hr>
    <?php }else{  ?>
      <div class="form-group" style="width:50%;">
      <input type="password" class="form-control"  name="pass" required placeholder="Contraseña" >
    </div>
    <div class="form-group" style="width:50%;">
      <input type="password" class="form-control"  name="passConfirm" required placeholder="Confirmar contraseña" >
    </div><br><hr>
    <?php } ?>
    
    <div style="margin: 0px auto; width:100%; height: 100px">
    <table style="margin:0px auto; height: 100%;">
        <tr>
          <td><button type="submit" class="btn btn-primary btn-sm">Agregar</button></td>
          <td><button type="button" class="btn btn-secondary btn-sm" onclick="cancelarPerfil()">Cancelar</button></td>
        </tr>
        </table>
  </div>
    </div>
    </form>
    </div>
  </div>



</body>
</html>