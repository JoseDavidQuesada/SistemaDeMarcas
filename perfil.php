<?php
session_start();
require_once('controlador/conexion2.php');

?>

<html>
<head>

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <link rel="stylesheet" type="text/css" href="css/style.css"/>
 <link rel="stylesheet" type="text/css" href="css/custom.css"/>
  <link rel="stylesheet" type="text/css" href="css/reloj.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

  <script src="js/buscador.js"></script>
 
</head>


 <?php    if(isset($_GET['id']) and $_GET['id'] == 2){?>
       <?php
     require_once('controlador/seguridad.php');
     require_once('controlador/header.php');
      ?>
    <div class="container">
        <div class="btnVolver">
        <button type="submit" class="btn btn-secondary btn-lg" onclick="location.href='home.php'">Volver</button>
        </div>
       <div class="cardSeleccionPerfil">
          <div class="botonesMenuAdmin">
            <button type="submit" class="btn btn-primary btn-sm" onclick="location.href='perfil.php?id=1'" style="width: 300px; height: 50;border-radius: 20px;font-size: 20px;">Ver mi informacion</button>
          </div>
           <div class="botonesMenuAdmin">
            <button type="submit" class="btn btn-primary btn-sm" onclick="location.href='perfil.php?id=3'" style="width: 300px; height: 50;border-radius: 20px;font-size: 20px;">Buscar personas</button>
          </div>

       </div>

       </div>




<?php
     }else if(isset($_GET['id']) and $_GET['id'] == 1){

      require_once('controlador/perfilNormal.php');

     }else if(isset($_GET['id']) and $_GET['id'] == 3){

  


     require_once('controlador/seguridad.php');
     require_once('controlador/header.php');

?>


<div class="container">
<div class="cardInformeBuscador">
<div class="container">
  <div class="card-body">
      <form>
      <div class="row">

 <form id="formBuscador" role="form">
            <div class="input-group input-daterange" style="width: 69%;">
                <div class="col">
                    <input type="text" name="cedula" id="cedula" class="form-control"  placeholder="Cedula">
                </div>
                <div class="col" >
                    <input type="text" name="name" id="name" class="form-control"  placeholder="Nombre">
                </div>
                <div class="col" style=>
                    <input type="text" name="ape01" id="ape01" class="form-control"  placeholder="Primer apellido">
                </div>
                <div class="col">
                    <input type="text" name="ape02" id="ape02" class="form-control"  placeholder="Segundo apellido">
                </div>
         </div>
          <div class="buttons" style="width:31%">
                <div class="col" style="float: left;width: 90px;">
                   <button type="button" id="send" class="btn btn-secondary btn-sm">Buscar</button>  
                </div>
                 <div class="col" style="float: left;width: 90px;">
                   <button type="button" onclick="location.href='perfil.php?id=3'" class="btn btn-secondary btn-sm">Limpiar</button>  
                </div>
                 <div class="col" style="float: left;width: 90px;">
                   <button type="button" onclick="location.href='perfil.php?id=2'" class="btn btn-secondary btn-sm">Volver</button>  
                </div>
            </div>
</form>
            
        </div>
    </div>

     </form> 
    
      
  </div>
  
  </div>
</div>

<div class="cardInforme" style="margin-top:30px;">

  <div class="card-body">


<table id="example" class="display" style="width:100%">
        <thead>
        <tr>
        <th>Cedula</th>
        <th>Nombre Completo</th> 
        <th>Fecha Nacimiento</th>
        <th>Usuario</th>
        <th>Correo</th> 
        <th>Telefono</th>
        <th>Tipo</th>

       </tr>
        </thead>
        <tbody id="tablaContenido">
<?php
    $result = mysqli_query($conn, "CALL buscadorEmpleados('','','','')"); 

    while($row = mysqli_fetch_assoc($result)) {


       $href = "location.href='perfil.php?id=1&ced=".$row['cedula']."'";
?>
      <tr  style='cursor:pointer' onclick=<?php echo  $href ?>>
      <td><?php echo $row['cedula']?></td>
      <td><?php echo $row['nombre']?></td>
      <td><?php echo $row['fechaNacimiento']?></td>
      <td><?php echo $row['user']?></td>
      <td><?php echo $row['correo']?></td>
      <td><?php echo $row['telefono']?></td>
      <td><?php echo $row['tipo']?></td>    
      </tr>
 <?php     }  ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
      
  </div>
  
</div>
</div>
</div>
 <?php } ?>
        



</body>
</html>