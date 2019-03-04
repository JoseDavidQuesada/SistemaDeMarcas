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
if(isset($_POST['identificador'])){
    $identificador = $_POST['identificador']; 
}
if(isset($_POST['marca'])){
    $marca = $_POST['marca']; 
}
;

    if($identificador == 1){
           mysqli_query($conn, "insert into marca(id, idPersona, mEntradaLaboral, mSAlidaAlmuerzo, mEntradaAlmuerzo, mSalidaLaboral)
                                          VALUES(0,".$idPersona.",'".$marca."',null,null,null)");                           
             
            $result = mysqli_query($conn, "select max(id),mEntradaLaboral from marca where idPersona = ".$idPersona."");    

            mysqli_close($conn);                              
            

           $row = mysqli_fetch_assoc($result);

          
          $id = $row['max(id)'];
          $_SESSION['idMarca'] = $row['max(id)'];
          $entrada = $row['mEntradaLaboral'];
          $_SESSION['mEntradaLaboral'] =  $row['mEntradaLaboral'];


            echo "Registro con exito";
            echo " Hola ";
            echo $id ;
            echo "  ";
            echo $entrada; 
            

    }else if($identificador == 2){
        
        
        
        
    }else if($identificador == 3){
        
        
        
        
    }else if($identificador == 4){

            if(isset( $_SESSION['idMarca']) and isset($_SESSION['mEntradaLaboral'])){
                $marcaDiaria = $_SESSION['idMarca'];
                

                mysqli_query($conn, "update marca set mSalidaLaboral = '".$marca."' where id =".$marcaDiaria."");                           

                $result = mysqli_query($conn, "select id,mSalidaLaboral from marca where idPersona =".$idPersona." and id = ".$marcaDiaria."");    

                mysqli_close($conn); 

                $row = mysqli_fetch_assoc($result);

                $id = $row['id'];
                $salida = $row['mSalidaLaboral'];
               
      
                  echo "Registro con exito";
                  echo "  ";
                  echo $id ;
                  echo "  ";
                  echo $salida;
            }else{

                echo "No entro en el if";
            }

    }else if($identificador == 5){
        $idPersona = $_SESSION['id'];

        $result2 = mysqli_query($conn, "select max(id), mEntradaLaboral from marca 
                                where idPersona =".$idPersona."");    

        $row2 = mysqli_fetch_assoc($result2);


        $marcaDiaria = $row2['max(id)'];

        $_SESSION['mEntradaLaboral'] = $row2['mEntradaLaboral'];
        $_SESSION['idMarca'] = $marcaDiaria;

        if(!$marcaDiaria == null){

                $result = mysqli_query($conn, "CALL traerHoraMarcas(".$idPersona.",".$marcaDiaria.")"); 
                
                $row = mysqli_fetch_assoc($result);

                

                if(!$row['mEntradaLaboral'] == null){
                $marcaEntradaLaboral = "<button type='button' class='btn btn-primary' disabled>".$row['mEntradaLaboral']."</button>";
                }else{
                $marcaEntradaLaboral = "<button type='button' class='btn btn-primary'>Entrada laboral</button>";
                }

                if(!$row['mSalidaLaboral'] == null){
                    $marcaSalidaLaboral = "<button type='button' class='btn btn-primary' disabled>".$row['mSalidaLaboral']."</button>";
                }else{
                    $marcaSalidaLaboral = "<button type='button' class='btn btn-primary'>Salida laboral</button>";
                }

                if(!$row['mSalidaAlmuerzo'] == null){
                    $marcaSalidaAlmuerzo = "<button type='button' class='btn btn-primary' disabled>".$row['mSalidaAlmuerzo']."</button>";
                }else{
                    $marcaSalidaAlmuerzo = "<button type='button' class='btn btn-primary'>Salida al Almuerzo</button>";
                }
                
                if(!$row['mEntradaAlmuerzo'] == null){
                    $marcaEntradaAlmuerzo= "<button type='button' class='btn btn-primary' disabled>".$row['mEntradaAlmuerzo']."</button>";
                }else{
                    $marcaEntradaAlmuerzo = "<button type='button' class='btn btn-primary'>Entrada del Almuerzo</button>";
                }
            
        }else{
            $marcaEntradaLaboral = "<button type='button' class='btn btn-primary'>Entrada laboral</button>";
            $marcaSalidaLaboral = "<button type='button' class='btn btn-primary'>Salida laboral</button>";
            $marcaSalidaAlmuerzo = "<button type='button' class='btn btn-primary'>Salida al Almuerzo</button>";
            $marcaEntradaAlmuerzo = "<button type='button' class='btn btn-primary'>Entrada del Almuerzo</button>";

        }
    

        
       

        $salida = array("EntradaLaboral" => $marcaEntradaLaboral,"SalidaLaboral" => $marcaSalidaLaboral,
                        "SalidaAlmuerzo" => $marcaSalidaAlmuerzo,"EntradaAlmuerzo" =>$marcaEntradaAlmuerzo);

        echo json_encode($salida);
    }




?>