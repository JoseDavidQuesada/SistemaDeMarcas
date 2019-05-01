<?php
// Connection info. file
require_once('../controlador/conexion.php');

    $result = mysqli_query($conn, "CALL buscadorEmpleados('','','','')"); 

?>


<div class="cardInforme" style="margin-top:30px;">

  <div class="card-body">


<table id="example" class="display" style="width:100%">
        <thead>
        <tr>
        <th>Cedula</th>
        <th>Nombre Completo</th> 
        <th>Fecha Nacimiento</th>
        <th>Usuario</th>
        <th>Correo</th> 
        <th>Telefono</th>
        <th>Tipo</th>

       </tr>
        </thead>
        <tbody>

  <tr id="seleccionPersona">
  
      <td id="cedulaPersona"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>      
      </tr>

        </tbody>
        <tfoot>

        </tfoot>
    </table>
      
  </div>
  
</div>
</div>
</div>