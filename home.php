<?php
session_start();
?>

<html>
<head>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <link rel="stylesheet" type="text/css" href="css/style.css"/>
 <link rel="stylesheet" type="text/css" href="css/custom.css"/>
  <link rel="stylesheet" type="text/css" href="css/reloj.css"/>

</head>
<body>

<!--<div style="text-align:center;padding:1em 0;">
	<iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=large&timezone=America%2FCosta_Rica" width="100%" height="140" frameborder="0" seamless>
	</iframe> 
</div> -->

<?php 
     require_once('controlador/seguridad.php');
     require_once('controlador/header.php');
  ?>

  <div class="contenedorReloj">
    <div class="widget">
      <div class="reloj">
        <p id="horas" class="horas"></p>
        <p>:</p>
        <p id="minutos" class="minutos"></p>
        <p>:</p>
        <div class="cajaSegundos">
          <p id="ampm" class="ampm"></p>
          <p id="segundos" class="segundos"></p>
        </div>
      </div>
    </div>
  </div>


  <div class="perfilInicio">

     <div style="position: relative;">
       <h1><p> <?php echo $_SESSION['cedula']?> </p></h1>
     </div>

  </div>

<div class="contenedorMarca">

  <div class="marca">
  <form action="">
    <table style="margin:0px auto; height: 100%; width: 100%;">
      <tr>
        <td id="mEntradaLaboral" ></td>

        <td id="mSalidaAlmuerzo"></td>

        <td id="mEntradaAlmuerzo"></td>

        <td id="mSalidaLaboral"></td>

      </tr>
    </table>
   </form>
  </div>
</div>


	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	 <script type="text/javascript" src="js/reloj.js"></script>
	 <script type="text/javascript" src="js/marcas.js"></script>
	 <script>
        marcasClick(<?php echo $_SESSION['id'] ?>); 
        marcasValidacion();
      </script>


</body>
</html>

