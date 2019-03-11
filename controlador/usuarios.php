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
if(isset($_POST['idPersona'])){
    $idPersona = $_POST['idPersona']; 
}
if(isset($_POST['user'])){
    $usuario = $_POST['user']; 
}
if(isset($_POST['password'])){
    $contrasena = $_POST['password']; 
}
if(isset($_POST['tipo'])){
    $tipo = $_POST['tipo']; 
}
if(isset($_POST['idUsuarioActual'])){
    $idUsuarioActual = $_POST['idUsuarioActual']; 
}
if(isset($_POST['idUsuarioConsulta'])){
    $idUsuarioConsulta = $_POST['idUsuarioConsulta']; 
}
;

if(isset($_POST['operacion'])){
    $Op = $_POST['operacion']; 
}

if ($Op == "Insertar") {
	
	$codigoUsuario =  mysqli_query($conn, "select max(id) from user");
	$fechaCreacion = date();
	mysqli_query($conn, "insert into user(id, idPersona, user, password, tipo, creacionFecha, idCreador )
                                          VALUES('".$codigoUsuario."','".$idPersona."','".$usuario."','".$contrasena."','".$tipo."',
										  '".$fechaCreacion."','".$idUsuarioActual."',null,null)");   

	if (mysqli_errno($conn)) {

				echo "Error de conexión " .mysqli_connect_error();
    }else{
	      echo "Registro insertado";
    }

	mysqli_close($conn); 

		    
}elseif ($Op == "Modificar")
{
	$fechaModificacion = date();
	mysqli_query($conn, "update into user(id, idPersona, user, password, tipo, ultimoUpdateFecha, idModificador )
                                          VALUES('".$codigoUsuario."','".$idPersona."','".$usuario."','".$contrasena."','".$tipo."',
										  '".$fechaCreacion."','".$idUsuarioActual."') WHERE id = '".$idUsuarioConsulta."'");  

	if (mysqli_errno($conn)) {

				echo "Error de conexión " .mysqli_connect_error();
    }else{
	      echo "Registro modificado";
    }

	mysqli_close($conn); 

}elseif ($Op == "Eliminar")
{
	mysqli_query($conn, "delete from user WHERE id = '".$idUsuarioConsulta."'");  

	if (mysqli_errno($conn)) {

				echo "Error de conexión " .mysqli_connect_error();
    }else{
	      echo "Registro eliminado";
    }

	mysqli_close($conn); 

}elseif ($Op == "Consultar")
{
	
	mysqli_query($conn, "select id, idPersona, user, password, tipo, creacionFecha, idCreador from user WHERE id = '".$idUsuarioConsulta."'");  

	if (mysqli_errno($conn)) {

				echo "Error de conexión " .mysqli_connect_error();
    }else{
	      echo "Registro eliminado";
    }

	mysqli_close($conn); 

}


