<?php
session_start();
?>

<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <link rel="stylesheet" type="text/css" href="css/style.css"/>
 <link rel="stylesheet" type="text/css" href="css/custom.css"/>
  <link rel="stylesheet" type="text/css" href="css/reloj.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="js/moment.js" ></script>

  <script src="js/informe.js"></script>

</head>
<body>

<?php 
     require_once('controlador/seguridad.php');
     require_once('controlador/header.php');

?>


<div class="container">
<div class="cardInformeBuscador">
<div class="container">
  <div class="card-body">
      <form>
      <div class="row">


            <div class="input-group input-daterange" style="width: 600px;">
                <div class="col" style="max-width: 60px; margin-top: 9px;">
                    <label for="exampleFormControlInput1">Desde:</label>  
                </div>
                <div class="col" style="max-width:210px;">
                    <input type="date" id="min-date" class="form-control date-range-filter"  placeholder="From:">
                </div>
                <div class="col" style="max-width: 60px; margin-top: 9px;">
                    <label for="exampleFormControlInput1">Hasta:</label>  
                </div>
                <div class="col" style="max-width:210px;">
                    <input type="date" id="max-date" class="form-control date-range-filter" placeholder="To:">
                </div>
            </div>
            
            <div class="contendorButtons">
            <div class="buttonInformes col">
             <button type="button" class="btn btn-secondary btn-sm" onclick="salirInforme()">Volver</button>  
            </div>
            <div class="buttonInformes col">
            <button type="submit" class="btn btn-secondary btn-sm">Limpiar</button>  
            </div>
			<!--
		      	<div class="buttonInformes col" >
            <button type="submit" class="btn btn-primary btn-sm">Este mes</button>  
            </div>
            
            <div class="buttonInformes col" >
              <button type="button" class="btn btn-primary btn-sm" id="filtroHoy">Dia de hoy</button>  
            </div> -->
            </div>
            
        </div>
    </div>

     </form> 
    
      
  </div>
  
  </div>
</div>

<div class="cardInforme" style="margin-top:30px;">

  <div class="card-body">
  
  <!--

    <tr class = "informeCompleto alert alert-danger" role='alert'>
  
    <td>117630788</td>
    <td>Jose David Quesada Arce</td> 
	 <td>02/04/2019</td> 
    <td>03:00 PM</td>
	<td>03:00 PM</td>
	<td>03:00 PM</td>
	<td>03:00 PM</td>
	<td>Temprana</td>
	<td>8</td>
	<td>0</td>
	<td><a href="#">ver</a></td>
  
  </tr>
  -->

<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
				<th>Cedula</th>
				<th>Nombre Completo</th> 
				<th>Fecha</th>
				<th>Entrada Laboral</th>
				<th>Salida Almuerzo</th> 
				<th>Entrada Almuerzo</th>
				<th>Salida Laboral</th>
				<th>Estado Salida</th>
				<th>Horas trabajadas</th>
				<th>Horas extras</th>
            </tr>
        </thead>
        <tbody>
		  <tr>
  
			<td>117630788</td>
			<td>Jose David Quesada Arce</td>
			<td>02/04/2019</td> 	
			<td>03:00 PM</td>
			<td>03:00 PM</td>
			<td>03:00 PM</td>
			<td>03:00 PM</td>
			<td>Temprana</td>
			<td>8</td>
			<td>0</td>
		  
		  </tr>

        </tbody>
        <tfoot>

        </tfoot>
    </table>
      
  </div>
  
</div>
</div>
</div>



</body>
</html>