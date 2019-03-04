<!DOCTYPE html>
<html>

<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="css/custom.css"/>
</head>

<body>
	
 <!--	<div class="logo">
 		<div class="imagen">
 		    <img src="img/umcaOscuro.png" style="width: 100%;">
		</div>
	</div>
	<div class="inner">


	<form method="POST" action="validacion.php">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Usuario</label>
		    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese su usuario" name="user">
		   <small id="emailHelp" class="form-text text-muted">We'll never share your user with anyone else.</small> -->
		<!--  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Contraseña</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese la contraseña" name="password">
		  </div>
		 <div class="form-check">
		    <input type="checkbox" class="form-check-input" id="exampleCheck1">
		    <label class="form-check-label" for="exampleCheck1">Check me out</label>
		  </div> -->
		<!--  <button type="submit" class="btn btn-primary" style="margin-top: 50px;width: 100px;margin-left: 130px; background-color: #15424E; border: 1px solid #15424E">Entrar</button>
	</form>
	</div> -->
		<div class="container-fluid" style="margin-top: 100px;">
		<div class="row">
			<div class="col-lg-12">		
				<div class="card">
					<div class="loginBox">
						<img src="img/KESBOA.png" class="img-responsive" style="width: 100%; margin-bottom: 30px; margin-top: 10px;" alt="PHP MySQL logos">
						<h2>Incio de sesion</h2>

						<?php if(isset($_GET['log']) == "error"){ ?>	

						<div class="alert alert-danger" role="alert"> 
                Tu usuario y contraseña no coinciden! 
								<br> Por favor ingrese un usuario y contraseña valida.
							
            </div>

						<?php } ?>	

						<form action="validacion.php" method="post">                           	
							<div class="form-group">									
							<input type="user" class="form-control input-lg" name="user" placeholder="Usuario" required>        
							</div>	
							<?php 
							
						//	if(isset($_GET['log']) == "error"){ ?>	

						<!--	<div class="form-group">        
							<input type="password" class="form-control input-lg" name="password" placeholder="Contraseña" required style="border: 1px solid red;">       
							</div>	-->
							<?php// }else{ ?>	

							<div class="form-group">        
							<input type="password" class="form-control input-lg" name="password" placeholder="Contraseña" required>       
							</div>

							<?php //} ?>	

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