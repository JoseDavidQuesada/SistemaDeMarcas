<?php
session_start();
?>

<html>
<head>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <link rel="stylesheet" type="text/css" href="css/style.css"/>
 <link rel="stylesheet" type="text/css" href="css/custom.css"/>
  <link rel="stylesheet" type="text/css" href="css/reloj.css"/>

</head>
<body>

<?php 
     require_once('controlador/seguridad.php');
     require_once('controlador/header.php');
?>

<div class="cardAdmin">
  <div class="card-body">
    <form>
        <h1 style="text-align: center; padding-bottom: 35px;"> Creando perfil </h1>
    <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder=Nombre">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Primer apellido">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Segundo apellido">
    </div>
  </div>


  <div class="form-group">
    <label for="exampleFormControlInput1">Fecha de nacimiento</label>
    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>

  
  <div class="form-group">
    <label for="exampleFormControlFile1">Foto de perfil</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
  <br><hr>

  <h1 style="text-align: center; padding-bottom: 35px;"> Creando Usuario </h1>

  <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Tipo de usuario</label>
  <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="width:50%;">
    <option selected>Normal</option>
    <option value="1">Jefe</option>
    <option value="2">Administrador</option>
  </select><br><br>

  <div class="form-group">
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Usuario">
  </div>
  <div class="form-group">
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Contraseña">
  </div>
  <div class="form-group">
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Confirmar contraseña">
  </div><br><hr>
  
  <div style="margin: 0px auto; width:100%; height: 100px">
   <table style="margin:0px auto; height: 100%;">
      <tr>
        <td><button type="button" class="btn btn-primary btn-sm">Agregar</button></td>
        <td><button type="button" class="btn btn-secondary btn-sm" onclick="location.href='home.php'">Cancelar</button></td>
      </tr>
 </div>

</form>
  </div>
</div>
</body>
</html>