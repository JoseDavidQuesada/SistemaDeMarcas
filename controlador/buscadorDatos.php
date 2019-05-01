<?php
session_start();

// Connection info. file
require_once('../controlador/conexion.php');


if(isset($_POST['cedula'])){
    $cedula = $_POST['cedula']; 
}else{
	$cedula = null;
}
if(isset($_POST['name'])){
    $nombre = $_POST['name']; 
}else{
	$nombre = null;
}
if(isset($_POST['ape01'])){
    $apellido1 = $_POST['ape01']; 
}else{
	$apellido1 = null;
}
if(isset($_POST['ape02'])){
    $apellido2 = $_POST['ape02']; 
}else{
	$apellido2 = null;
}

  if(isset($_GET['id']) && $_GET['id'] == 1){

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
 <?php     } 


  }else if($_GET['id'] == 2){


    $result = mysqli_query($conn, "CALL buscadorEmpleados('$cedula','$nombre','$apellido1','$apellido2')");  

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

 <?php    }  }

	
   	//var_dump($rows);

  