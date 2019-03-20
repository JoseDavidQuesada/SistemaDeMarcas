<?php
   session_start();

	// Connection info. file
	require_once('../controlador/conexion.php');
	
	// data sent from form login.html 
	$user = $_POST['user']; 
	$password = $_POST['password'];
	
	// Query sent to database
    $result = mysqli_query($conn, "select p.id,nombre,ape01,ape02,cedula,tipo, img, user, password from persona AS p
                                    inner join user as u
                                    on p.id = u.idPersona where user = '$user'");
	
								
	// Variable $row hold the result of the query
	$row = mysqli_fetch_assoc($result);
	
	// Variable $hash hold the password hash on database
	$hash = $row['password'];

	
	/* 
	password_Verify() function verify if the password entered by the user
	match the password hash on the database. If everything is ok the session
	is created for one minute. Change 1 on $_SESSION[start] to 5 for a 5 minutes session.
	*/
	if (md5($password) === $hash) {	
		
        $_SESSION['loggedin'] = true;
        
        $_SESSION['id'] = $row['id'];


        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['ape01'] = $row['ape01'];
        $_SESSION['ape02'] = $row['ape02'];
        $_SESSION['cedula'] = $row['cedula'];
		$_SESSION['img'] = $row['img'];
		$_SESSION['tipo'] = $row['tipo'];

		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ;						
		
		echo "<div class='alert alert-success' role='alert'><strong>Welcome!</strong> $row[Name]			
		<p><a href='edit-profile.php'>Edit Profile</a></p>	
        <p><a href='logout.php'>Logout</a></p></div>";

        header('Location:/marcas/home.php');
	
	} else {
        header('Location:/marcas/index.php?log=error');			
	}	
?>
