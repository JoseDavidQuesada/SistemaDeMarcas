<?php
session_start();

// Connection info. file
require_once('../controlador/conexion.php');


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

        IF(!isset($_SESSION['idMarca'])){
           mysqli_query($conn, "insert into marca(id, idPersona, mEntradaLaboral, mSAlidaAlmuerzo, mEntradaAlmuerzo, mSalidaLaboral,estado)
                                          VALUES(0,".$idPersona.",'".$marca."',null,null,null,'A')");                           
             
            $result = mysqli_query($conn, "select id,mEntradaLaboral from marca where idPersona = ".$idPersona." and estado = 'A'");    

            mysqli_close($conn);                              
            

           $row = mysqli_fetch_assoc($result);

          
          $id = $row['id'];
          $_SESSION['idMarca'] = $row['id'];
          $entrada = $row['mEntradaLaboral'];
          $_SESSION['mEntradaLaboral'] =  $row['mEntradaLaboral'];


            echo "Registro con exito";
            echo $id ;
            echo "  ";
            echo $entrada; 
    }else{
        echo "Marca repetida";
    }
            

    }else if($identificador == 2){

        if(isset( $_SESSION['idMarca']) and isset($_SESSION['mEntradaLaboral'])){
            $marcaDiaria = $_SESSION['idMarca'];
            
            mysqli_query($conn, "update marca set mSalidaAlmuerzo = '".$marca."' where id =".$marcaDiaria."");                           

            mysqli_close($conn); 
            
            echo "Registro con exito salida Almuerzo";
           
        }else{

            echo "No entro en el if";
        }
        
     
        
    }else if($identificador == 3){
        
        if(isset( $_SESSION['idMarca']) and isset($_SESSION['mEntradaLaboral'])){
            $marcaDiaria = $_SESSION['idMarca'];
            
            mysqli_query($conn, "update marca set mEntradaAlmuerzo = '".$marca."' where id =".$marcaDiaria."");                           

            mysqli_close($conn); 

            echo "Registro con exito entrada almuerzo";
            
        }else{

            echo "No entro en el if";
        }
        
        
        
    }else if($identificador == 4){

            if(isset( $_SESSION['idMarca']) and isset($_SESSION['mEntradaLaboral'])){
                $marcaDiaria = $_SESSION['idMarca'];
                
                mysqli_query($conn, "update marca set mSalidaLaboral = '".$marca."' where id =".$marcaDiaria."");                           

                mysqli_close($conn); 

                echo "Registro con exito";

            }else{

                echo "No entro en el if";
            }

    }else if($identificador == 5){
        $idPersona = $_SESSION['id'];

        $result2 = mysqli_query($conn, 'select id, mEntradaLaboral from marca 
                                where idPersona ='.$idPersona.' and estado = "A"');    

        $row2 = mysqli_fetch_assoc($result2);


        $marcaDiaria = $row2['id'];
    

        $_SESSION['mEntradaLaboral'] = $row2['mEntradaLaboral'];
        $_SESSION['idMarca'] = $marcaDiaria;

        if(!$marcaDiaria == null ){

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