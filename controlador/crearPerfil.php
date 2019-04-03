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

if(isset($_POST['tipo'])){
    $tipo = $_POST['tipo']; 
}


if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['passConfirm'])){
    $user = $_POST['user']; 
    $pass = $_POST['pass'];
    $passConfirm = $_POST['passConfirm'];

    $result = mysqli_query($conn, "Select user from user where user='$user'"); 
    $row = mysqli_fetch_assoc($result);
    $validacion = $row['user'];

    if($user == $validacion){
        $_SESSION['Fnombre'] = $nombre;
        $_SESSION['Fape01'] = $apellido1;
        $_SESSION['Fape02'] = $apellido2;
        $_SESSION['Fcedula'] = $cedula;
        $_SESSION['Fnacimiento'] = $fechaNac;
        $_SESSION['Ftipo'] = $tipo;
        //s$_SESSION['Fimg'] = $_FILES['imgPerfil'];
        $_SESSION['Fuser'] = "";
        header('Location:/Marcas/administracion.php?log=errorUser'); 

    }else if($pass <> $passConfirm){
        $_SESSION['Fnombre'] = $nombre;
        $_SESSION['Fape01'] = $apellido1;
        $_SESSION['Fape02'] = $apellido2;
        $_SESSION['Fcedula'] = $cedula;
        $_SESSION['Fnacimiento'] = $fechaNac;
        //$_SESSION['Fimg'] = $_FILES['imgPerfil'];
        $_SESSION['Ftipo'] = $tipo;
        $_SESSION['Fuser'] = $user;
        header('Location:/Marcas/administracion.php?log=errorPass'); 

    }else{
        $dCreador = $_SESSION["id"]; 

        $imagen = $_FILES['imgPerfil'];
        $nameImg = $imagen['name'];
        $typeImg = $imagen['type'];

        move_uploaded_file($imagen['tmp_name'],'../img/users/'.$nameImg);

        echo $nameImg;
        echo $typeImg;
        var_dump($imagen);

        mysqli_query($conn, "CALL crearPerfil('$cedula','$nombre', '$apellido1', '$apellido2','$fechaNac','img/users/$nameImg',$dCreador,'$user','$pass',$tipo)");                             
        mysqli_close($conn);  
        header('Location:/Marcas/administracion.php?log=exito'); 
    }

}

/*if(isset($_POST['pass']) && isset($_POST['passConfirm'])){
    $pass = $_POST['pass']; 
    $passConfirm = $_POST['passConfirm'];

    if(!$pass <> $passConfirm){
        header('Location:/marcas/administracion.php?log=errorPass'); 
    }else{
        echo "no hubo error";
    }

}


$dCreador = $_SESSION["id"]; 

$imagen = $_FILES['imgPerfil'];
$nameImg = $imagen['name'];
$typeImg = $imagen['type'];

move_uploaded_file($imagen['tmp_name'],'../img/users/'.$nameImg);

echo $nameImg;
echo $typeImg;
var_dump($imagen);


mysqli_query($conn, "CALL crearPerfil('$cedula','$nombre', '$apellido1', '$apellido2','$fechaNac','img/users/$nameImg',$dCreador,'$user','$pass',$tipo)");                             
mysqli_close($conn);  
header('Location:/marcas/administracion.php?log=exito');  

echo "Registro con exito"; */




