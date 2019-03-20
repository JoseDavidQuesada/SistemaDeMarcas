<!DOCTYPE html>
<html>

<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="css/custom.css"/>
</head>

<body>
	
		<div class="container-fluid" style="margin-top: 100px;">
		<div class="row">
			<div class="col-lg-12">		
				<div class="card">
					<div class="loginBox">
						<img src="img/kbDegradado.png" class="img-responsive" style="width: 200px; height: 200px; margin-bottom: 30px; margin-top: 10px;" alt="PHP MySQL logos">
						<h2>Incio de sesion</h2>

						<?php if(isset($_GET['log']) == "error"){ ?>	

						<div class="alert alert-danger" role="alert"> 
                Tu usuario y contraseña no coinciden! 
								<br> Por favor ingrese un usuario y contraseña valida.
							
            </div>

						<?php } ?>	

						<form action="controlador/validacion.php" method="post">                           	
							<div class="form-group">									
							<input type="user" class="form-control input-lg" name="user" placeholder="Usuario" required>        
							</div>	


							<div class="form-group">        
							<input type="password" class="form-control input-lg" name="password" placeholder="Contraseña" required>       
							</div>

							<button type="submit" class="btn btn-success btn-block">Entrar</button>        
							<br>
						</form>						
						<hr><p>@JoseDavidQuesada</p>								
					</div><!-- /.loginBox -->	
				</div><!-- /.card -->
			</div><!-- /.col -->
		</div><!--/.row-->
	</div><!-- /.container -->

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>