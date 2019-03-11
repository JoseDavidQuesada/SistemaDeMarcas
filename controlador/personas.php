<?php
session_start();

// Connection info. file
include '../config.php';	

// Connection variables
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if(isset($_POST['cedula'])){
    $cedula = $_POST['cedula']; 
}
if(isset($_POST['nombre'])){
    $nombre = $_POST['nombre']; 
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
if(isset($_POST['img'])){
    $imagen = $_POST['img']; 
}
if(isset($_POST['idUsuario'])){
    $usuario = $_POST['idUsuario']; 
}
if(isset($_POST['idPersona'])){
    $idPersona = $_POST['idPersona']; 
}
;

if(isset($_POST['operacion'])){
    $Op = $_POST['operacion']; 
}

if ($Op == "Insertar") {
	
	$codigoPersona =  mysqli_query($conn, "select max(id) from persona");
	$fechaCreacion = date();
	mysqli_query($conn, "insert into persona(id, cedula, nombre, ape01, ape02,fechaNacimiento, img, creacionFecha, idCreador )
                                          VALUES('".$codigoPersona."','".$cedula."','".$nombre."','".$apellido1."','".$apellido2."',
										  '".$fechaNac."','".$imagen."','".$fechaCreacion."','".$usuario."',null,null)");   

	if (mysqli_errno($conn)) {

				echo "Error de conexión " .mysqli_connect_error();
    }else{
	      echo "Registro insertado";
    }

	mysqli_close($conn); 

		    
}elseif ($Op == "Modificar")
{
	$fechaModificacion = date();
	mysqli_query($conn, "update into persona(cedula, nombre, ape01, ape02,fechaNacimiento, img, ultimoUpdateFecha, idModificador )
                                          VALUES('".$codigoPersona."','".$cedula."','".$nombre."','".$apellido1."','".$apellido2."',
										  '".$fechaNac."','".$imagen."','".$fechaModificacion."','".$usuario."') 
										  WHERE id = '".$idPersona."'");  

	if (mysqli_errno($conn)) {

				echo "Error de conexión " .mysqli_connect_error();
    }else{
	      echo "Registro modificado";
    }

	mysqli_close($conn); 

}elseif ($Op == "Eliminar")
{
	mysqli_query($conn, "delete from persona WHERE id = '".$idPersona."'");  

	if (mysqli_errno($conn)) {

				echo "Error de conexión " .mysqli_connect_error();
    }else{
	      echo "Registro eliminado";
    }

	mysqli_close($conn); 

}elseif ($Op == "Consultar")
{
	
	mysqli_query($conn, "select id, cedula, nombre, ape01, ape02,fechaNacimiento, img from persona WHERE id = '".$idPersona."'");  

	if (mysqli_errno($conn)) {

				echo "Error de conexión " .mysqli_connect_error();
    }else{
	      echo "Registro eliminado";
    }

	mysqli_close($conn); 

}


