<?php
session_start();

require '../iniciosesion/user/database.php';

if (isset($_SESSION['user_id'])) {
  $records = $conn->prepare('SELECT id, email, password, privilegios FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }
}
 ?>


<!DOCTYPE HTML>
<html>

<head>
  <title>Informacion</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="../index.html">SICADI <span class="logo_colour">Transformetal y Reparaciones</span></a></h1>
          <h2>Todo Sobre nosotros.</h2>
        </div>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li><a href="../index.php">Inicio</a></li>
          <li class="selected"><a href="../informacion/informacion.php">Quienes somos</a></li>
          <li><a href="../galeria/galeria.php">Galeria</a></li>
          <?php if(!empty($user)): ?>
          <li><a href="../citas/citas.php">Citas</a></li>
          <?php endif; ?>
          <li><a href="../contacto/contacto.php">Contacto</a></li>
          <?php if(!empty($user)): ?>
          <li><a><?= $user['email'] ?></a>
            <ul>
              <li><a href="#">Mis pedidos</a></li>
              <li><a href="#">Mis presupestos</a></li>
              <?php
              if($user['privilegios'] == "admin"){
              ?>
              <li><a href="../dashboard/admin.php">Administrar</a></li>
              <?php
            }
               ?>
              <li><a href="../iniciosesion/user/logout.php">Cerrar Sesion</a></li>
            </li>
          </ul>
          <?php else: ?>
          <li><a href="../iniciosesion/user/login.php">Iniciar sesión</a></li>
        <?php endif; ?>
        </ul>
      </nav>
    </header>
    <div id="site_content">
        <div class="content">
        <h1>¿Que es SICADI?</h1>
        <p>Es un sistema de catalogo de diseños de herrerias diseñado para apoyar a los clientes que deseen un
          diseño en especifico de nuestra galeria de imagenes. Fue construido utilizando las siguientes
          herramientas <strong>Atom y XAMPP</strong>.</p>
        <p>Los lenguajes de programación utilizados para la realización de este sitio son <strong>JavaScript
        </strong> y <strong>PHP</strong>. Para crear la estructura se utilizo el leguaje de hiper texto
        <strong>HTML</strong>.</p>
        <p>En el boton <a href="../informacion/informacion.php">Información</a> podra encontrar todo
          lo referente al sistema. En ese apartado podra encontrar informacion referente a la empresa
          Transformetal y Reparaciones pues es la empresa para la que fue diseñado este sistema.</p>
        <br>
        <h1>¿Como surgio la idea?</h1>
        <p>La idea de crear un catalogo electrónico surge de la necesidad de la empresa "Transformetal y
          Reparaciones" de un catalogo fisico, para asi presentarlo con sus clientes y de esta manera ellos
          pudieran elegir de una manera mas eficiente el diseño que mas fuera de su agrado.</p>
        <p>Pero claro, al hacer esto, no todos los clientes o las personas que deseen una herreria podrian ver
          los diseños, asi que surge la idea de crear SICADI (Sistema de Catalogo de Diseños) un catalogo
          electronico que podria ser visualizado desde una aplicacion web, en el cual los clientes podrian
          elegir el diseño que mas es de su agrado, para solicitar un presupuesto del diseño de acuerdo a las
          medidas de su hogar y realizar un pedido.</p>
          <h1>¿Como nacio la empresa "Transformetal y Reparaciones?</h1>
        <p>La empresa es propiedad de una sola persona, el señor Carlos de Dios Perez, esta persona comenzó en la
          herreria como ayudante de maestros de herreria hace aproximadamente 30 años, el trabajó en diversas herrerias
          de todo Tabasco, en cada uno de sus trabajos fue adquiriendo conocimientos, desde las cosas mas basicas, hasta
          hacer puertas, ventanas y protecciones. Esta persona abrió su taller a la edad aproximada de 23 años. Su taller
          fue creciendo de tal manera que en la actualidad es buscado para realizar trabajos de tipo industrial.</p>
      </div>
    </div>
    <footer>
      <p>Copyright &copy; SICADI <a href="../informacion/informacion.php">Transformetal y Reparaciones</a></p>
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
</html>
