<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>
<script type="text/javascript" src="js/perfil.js"></script>
<header id="main-header">
  <div class="logoIzquierda">
        <a><img src="img/KESBOA.png" class="img-responsive" style="height: 90%;"><a>
  </div>


<div>   
      <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 2 ){  ?>
        <a onclick="confirmacionLogout()"><img src="img/logout.svg" class="img-responsive" style=" height: 50%; margin-top: 20px; float: right; margin-right:18px; "><a>
        <a href="administracion.php"><img src="img/add.svg" class="img-responsive" style=" height: 50%; margin-top: 20px; float: right; margin-right:18px; "><a>
      <?php } else { ?>
        <a onclick="confirmacionLogout()"><img src="img/logout.svg" class="img-responsive" style=" height: 50%; margin-top: 20px; float: right; margin-right:18px; "><a>
      <?php } ?>
</div>

</header>

