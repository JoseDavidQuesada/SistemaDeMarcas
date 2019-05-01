<?php
session_start();

// Connection info. file
require_once('../controlador/conexion.php');


if(isset($_POST['cedula'])){
    $cedula = $_POST['cedula']; 
}
if(isset($_POST['name'])){
    $nombre = $_POST['name']; 
}
if(isset($_POST['ape01'])){
    $apellido1 = $_POST['ape01']; 
}
if(isset($_POST['ape02'])){
    $apellido2 = $_POST['ape02']; 
}
if(isset($_POST['fechaNacimiento'])){
    $fechaNac = $_POST['fechaNacimiento']; 
}

if(isset($_POST['telefono'])){
    $telefono = $_POST['telefono']; 
}

if(isset($_POST['correo'])){
    $correo = $_POST['correo']; 
}

if(isset($_POST['pass']) && isset($_POST['passConfirm'])){
    $pass = $_POST['pass'];
    $passConfirm = $_POST['passConfirm'];
}


if(isset($_SESSION['idPersona']) && !$_SESSION['idPersona'] == ""){
    $idPersona = $_SESSION['idPersona'];

if(isset($_GET['action']) && $_GET['action'] == 1){

$result = mysqli_query($conn, "select id,cedula from persona where cedula = ".$cedula."");    

$row = mysqli_fetch_assoc($result);

if(isset($row['cedula'])){

      if($row['cedula'] == $_SESSION['cedulaPersona']){

           mysqli_query($conn, "CALL updatePerfil($idPersona,'$cedula','$nombre', '$apellido1', '$apellido2','$fechaNac','$telefono','$correo')");
           mysqli_close($conn); 

            $_SESSION['idPersona'] = null;
            $_SESSION['cedulaPersona'] = null;
          header('Location:/Marcas/perfil.php?id=1&ced='.$cedula.'&log=exito'); 

      }else{
         $_SESSION['idPersona'] = null;
         //$_SESSION['cedulaPersona'] = null;
         header('Location:/Marcas/perfil.php?id=1&ced='.$_SESSION['cedulaPersona'].'&log=error'); 
      }

    }else{

           mysqli_query($conn, "CALL updatePerfil($idPersona,'$cedula','$nombre', '$apellido1', '$apellido2','$fechaNac','$telefono','$correo')");
           mysqli_close($conn); 

           $_SESSION['idPersona'] = null;
           $_SESSION['cedulaPersona'] = null;
           header('Location:/Marcas/perfil.php?id=1&ced='.$cedula.'&log=exito'); 

  }

}else if( $_GET['action'] == 2){

    if($pass <> $passConfirm){
        header('Location:/Marcas/perfil.php?id=1&ced='.$_SESSION['cedulaPersona'].'&log=errorpass'); 

    }else{
        mysqli_query($conn, "CALL updatePassword($idPersona,'$pass')");
        mysqli_close($conn); 
        header('Location:/Marcas/perfil.php?id=1&ced='.$_SESSION['cedulaPersona'].'&log=exitopass'); 
    }
}else if( $_GET['action'] == 3){

    if(isset($_FILES['imgPerfil'])){

        $imagen = $_FILES['imgPerfil'];
        $nameImg = $imagen['name'];
        $typeImg = $imagen['type'];

        move_uploaded_file($imagen['tmp_name'],'../img/users/'.$nameImg);

        mysqli_query($conn, "CALL updateImg($idPersona,'img/users/$nameImg')");

        $result = mysqli_query($conn, "select img from persona where id = $idPersona");    
        $row = mysqli_fetch_assoc($result);

        mysqli_close($conn); 
        header('Location:/Marcas/perfil.php?id=1&ced='.$_SESSION['cedulaPersona'].'&log=exitoimg'); 
    }else{
        echo 'error con la imagen';
    
    }

}

}else{


    $idPersona = $_SESSION['id'];

    if(isset($_GET['action']) && $_GET['action'] == 1){

$result = mysqli_query($conn, "select id,cedula from persona where cedula = ".$cedula."");    

$row = mysqli_fetch_assoc($result);

if(isset($row['cedula'])){

      if($row['cedula'] == $_SESSION['cedula']){

           mysqli_query($conn, "CALL updatePerfil($idPersona,'$cedula','$nombre', '$apellido1', '$apellido2','$fechaNac','$telefono','$correo')");
           mysqli_close($conn); 

            $_SESSION['nombre'] = $nombre;
            $_SESSION['ape01'] = $apellido1;
            $_SESSION['ape02'] = $apellido2;
            $_SESSION['fechaNacimiento'] = $fechaNac;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['correo'] = $correo;
            $_SESSION['idPersona'] = null;
            $_SESSION['cedulaPersona'] = null;
          header('Location:/Marcas/perfil.php?id=1&log=exito'); 

      }else{

         header('Location:/Marcas/perfil.php?id=1&log=error'); 
      }

    }else{

           mysqli_query($conn, "CALL updatePerfil($idPersona,'$cedula','$nombre', '$apellido1', '$apellido2','$fechaNac','$telefono','$correo')");
           mysqli_close($conn); 

            $_SESSION['nombre'] = $nombre;
            $_SESSION['ape01'] = $apellido1;
            $_SESSION['ape02'] = $apellido2;
            $_SESSION['fechaNacimiento'] = $fechaNac;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['correo'] = $correo;
            $_SESSION['cedula'] = $cedula;
            $_SESSION['idPersona'] = null;
            $_SESSION['cedulaPersona'] = null;
           header('Location:/Marcas/perfil.php?id=1&log=exito'); 

  }

}else if( $_GET['action'] == 2){

    if($pass <> $passConfirm){
        header('Location:/Marcas/perfil.php?id=1&log=errorpass'); 

    }else{
        mysqli_query($conn, "CALL updatePassword($idPersona,'$pass')");
        mysqli_close($conn); 
        header('Location:/Marcas/perfil.php?id=1&log=exitopass'); 
    }
}else if( $_GET['action'] == 3){

    if(isset($_FILES['imgPerfil'])){

        $imagen = $_FILES['imgPerfil'];
        $nameImg = $imagen['name'];
        $typeImg = $imagen['type'];

        move_uploaded_file($imagen['tmp_name'],'../img/users/'.$nameImg);

        mysqli_query($conn, "CALL updateImg($idPersona,'img/users/$nameImg')");

        $result = mysqli_query($conn, "select img from persona where id = $idPersona");    
        $row = mysqli_fetch_assoc($result);

        mysqli_close($conn); 
        $_SESSION['img'] = $row['img'];
        header('Location:/Marcas/perfil.php?id=1&log=exitoimg'); 
    }else{
        echo 'error con la imagen';
    
    }

}

}



