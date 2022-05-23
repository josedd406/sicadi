<?php
require 'iniciosesion/user/database.php';
session_start();



if (isset($_SESSION['user_id'])) {
  $records = $conn->prepare('SELECT id, email, password, privilegios FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }
  //var_dump($results);
}


 ?>


<!DOCTYPE HTML>
<html>
<head>
  <title>Bienvenido a SICADI</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" media="only screen and (max-width: 768px)" href="estilos.css">
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
  <meta name="viewport" content="width=device-width, user-sacalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale-1.0">
</head>
<body>

  <div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">SICADI<span class="logo_colour"> Transformetal y Reparaciones </span></a></h1>
          <h2>Bienvenido a SICADI.</h2>
        </div>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li class="selected"><a href="index.php">Inicio</a></li>
          <li><a href="informacion/informacion.php">Quienes somos</a></li>
          <li><a href="galeria/galeria.php ">Galeria</a></li>
          <?php if(!empty($user)): ?>
          <li><a href="citas/citas.php">Citas</a></li>
          <?php endif; ?>
          <?php  if(!empty($user)): ?>
          <li><a href="contacto/contacto.php">Contacto</a></li>
          <?php endif; ?>
          <?php if(!empty($user)): ?>
          <li><a><?= $user['email'] ?></a>
            <ul>
              <li><a href="#">Mis pedidos</a></li>
              <li><a href="#">Mis presupestos</a></li>
              <?php
              if($user['privilegios'] == "admin"){
              ?>
              <li><a href="dashboard/admin.php">Administrar</a></li>
              <?php
            }
               ?>
              <li><a href="iniciosesion/user/logout.php">Cerrar Sesion</a></li>
            </li>
          </ul>
          <?php else: ?>
          <li><a href="iniciosesion/user/login.php">Iniciar sesión</a></li>
        <?php endif; ?>
        </ul>
      </nav>
    </header>
    <div id="site_content">
      <ul id="images">
        <li><img src="images/1.jpg" width="600" height="300" alt="seascape_one" /></li>
        <li><img src="images/2.jpg" width="600" height="300" alt="seascape_two" /></li>
        <li><img src="images/3.jpg" width="600" height="300" alt="seascape_three" /></li>
        <li><img src="images/4.jpg" width="600" height="300" alt="seascape_four" /></li>
        <li><img src="images/5.jpg" width="600" height="300" alt="seascape_five" /></li>
        <li><img src="images/6.jpg" width="600" height="300" alt="seascape_seascape" /></li>
      </ul>
      <div class="content">
        <h1>¿Que es SICADI?</h1>
        <p>Es un sistema de catalogo de diseños de herrerias diseñado para apoyar a los clientes que deseen un diseño en especifico de nuestra galeria de imagenes. Fue construido utilizando las siguientes herramientas <strong>Atom y XAMPP</strong>.</p>
        <p>Los lenguajes de programación utilizados para la realización de este sitio son <strong>JavaScript</strong> y <strong>PHP</strong>. Para crear la estructura se utilizo el leguaje de hiper texto <strong>HTML</strong>.</p>
        <p>En el boton información podra encontrar todo lo referente al sistema <a href="informacion.php">Información</a> En ese apartado podra encontrar informacion referente a la empresa Transformetal y Reparaciones pues es la empresa para la que fue diseñado este sistema.</p>
      </div>
    </div>
    <footer>
      <p>Copyright &copy; SICADI <a href="informacion/informacion.php">Transformetal y Reparaciones</a></p>
    </footer>
  </div>
  <p>&nbsp;</p>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript" src="js/jquery.kwicks-1.5.1.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#images').kwicks({
        max : 600,
        spacing : 2
      });
      $('ul.sf-menu').sooperfish();
    });
  </script>
</body>
</div>
</html>
