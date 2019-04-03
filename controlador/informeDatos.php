<?php
session_start();

// Connection info. file
require_once('../controlador/conexion.php');




    $result = mysqli_query($conn, "CALL traerInformeCompleto()"); 

    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    
    //var_dump($rows);

    echo json_encode($rows);
    


    

