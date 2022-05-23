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
  //var_dump($results);
}


 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Contacto</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
  </head>
  <body>
    <div id="main">
      <header>
        <div id="logo">
          <div id="logo_text">
            <h1><a href="../index.php">SICADI<span class="logo_colour"> Transformetal y Reparaciones </span></a></h1>
            <h2>Datos de la Empresa</h2>
        </div>
        </div>
        <nav>
          <ul class="sf-menu" id="nav">
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="../informacion/informacion.php">Quienes somos</a></li>
            <li><a href="../galeria/galeria.php">Galeria</a></li>
            <?php if(!empty($user)): ?>
            <li><a href="../citas/citas.php">Citas</a></li>
            <?php endif; ?>
            <li class="selected"><a href="../contacto/contacto.php">Contacto</a></li>
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
		<h1>Contacto</h1>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4384.350184053097!2d-92.95834885920864!3d17.987321942767366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85edd7bcd98e50df%3A0x785b55bf939c8dea!2sCalle+Felipe+Carrillo+Puerto+282%2C+Carrizal%2C+86108+Carrizal%2C+Tab.!5e0!3m2!1ses-419!2smx!4v1564543242310!5m2!1ses-419!2smx" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
		  <section class="principal">
		  <form>
			<label for="nombre">Nombre:</label>
			<input id="nombre" name="nombre" placeholder="Nombre completo">
			<label for="email">Email:</label>
			<input id="email" name="email" type="email" placeholder="ejemplo@email.com">
			<label for="mensaje">Mensaje:</label>
			<textarea id="mensaje" name="mensaje" placeholder="Danos tu mensaje"></textarea>
			<br>
			<input id="submit" name="submit" type="submit" value="Enviar">
		  </form>
		</section>
	  </div>
	  </div>
	  <footer>
      <p>Copyright &copy; SICADI <a href="../informacion/informacion.php">Transformetal y Reparaciones</a></p>
    </footer>
    </div>
  </body>
</html>
