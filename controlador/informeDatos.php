<?php
session_start();

// Connection info. file
require_once('../controlador/conexion.php');



  if(isset($_GET['id']) && $_GET['id'] == 1){

	    $result = mysqli_query($conn, "CALL traerInformeCompleto()"); 

	    while($row = mysqli_fetch_assoc($result)) {
	        $rows[] = $row;
	    }

	    echo json_encode($rows);

   }else if ($_GET['id'] == 2){
	   	$result = mysqli_query($conn, "CALL traerInformeMes()"); 

	    while($row = mysqli_fetch_assoc($result)) {
	        $rows[] = $row;
	    }

	    echo json_encode($rows);
   }else if ($_GET['id'] == 3){

   		 $result = mysqli_query($conn, "CALL traerInformeDia()"); 

	    while($row = mysqli_fetch_assoc($result)) {
	        $rows[] = $row;
	    }

	    echo json_encode($rows);

   }
    
    //var_dump($rows);

    
    


    

