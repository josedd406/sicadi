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

$sqlgal = "SELECT c.id as 'id_categoria', c.categoria, g.id as 'id_galeria', g.galeria, g.costo_aprox FROM categorias as c, galerias as g WHERE c.id=g.id_categoria AND c.id=1";
$records = $conn->prepare($sqlgal);
$records->execute();
$results_gal1 = $records->fetchAll();

$sqlgal = "SELECT c.id as 'id_categoria', c.categoria, g.id as 'id_galeria', g.galeria, g.costo_aprox FROM categorias as c, galerias as g WHERE c.id=g.id_categoria AND c.id=2";
$records = $conn->prepare($sqlgal);
$records->execute();
$results_gal2 = $records->fetchAll();

$sqlgal = "SELECT c.id as 'id_categoria', c.categoria, g.id as 'id_galeria', g.galeria, g.costo_aprox FROM categorias as c, galerias as g WHERE c.id=g.id_categoria AND c.id=3";
$records = $conn->prepare($sqlgal);
$records->execute();
$results_gal3 = $records->fetchAll();

$sqlgal = "SELECT c.id as 'id_categoria', c.categoria, g.id as 'id_galeria', g.galeria, g.costo_aprox FROM categorias as c, galerias as g WHERE c.id=g.id_categoria AND c.id=4";
$records = $conn->prepare($sqlgal);
$records->execute();
$results_gal4 = $records->fetchAll();

/**
echo "<pre>";
var_dump($results_gal2);
echo "</pre>";
**/
 ?>


<!DOCTYPE HTML>
<html>

<head>
  <title>Categorias</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
  <script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
  <div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">SICADI<span class="logo_colour"> Transformetal y Reparaciones </span></a></h1>
          <h2>Encuentra tu diseño.</h2>
        </div>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li><a href="../index.php">Inicio</a></li>
          <li><a href="../informacion/informacion.php">Quienes somos</a></li>
          <li class="selected"><a href="../galeria/galeria.php">Galeria</a></li>
          <?php if(!empty($user)): ?>
          <li><a href="../citas/citas.php">Citas</a></li>
          <?php endif; ?>
          <?php if(!empty($user)): ?>
          <li><a href="../contacto/contacto.php">Contacto</a></li>
          <?php endif ?>
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
	<!--Aquí va la galería -->
	<div id="site_content">
	  <div class="content">
		<h1>Galería de imagánes</h1>
		<form action="../citas/citas.php" method="get">
		  <?php
			if(isset($_SESSION['user_id'])){
		  ?>
		  <h4>Solicita tu cita para cotizar un presupuesto</h4>
		  <input id="submit" name="submit" type="submit" value="Aquí">
		  <?php
			}else{
		  ?>
			<h4>Registrese en la página para solicitar su presupuesto</h4>
		  <?php
			}
		  ?>
      <br>
		<h2>Portones</h2>
		  <ul>
			<?php
			  foreach($results_gal1 as $rsg){
			?>
			<li>
			  <div class="cg">
				<img id="img" src="../images/<?php echo $rsg['categoria']; ?>/<?php echo $rsg['galeria']; ?>" width="270" height="360" alt="<?php echo $rsg['galeria']; ?>" name="<?php echo $rsg['galeria']; ?>" onclick='alert("Costo aproximado:\n<?php echo $rsg['costo_aprox']; ?>")' />
				<?php
				  if(isset($_SESSION['user_id'])){
				?>
				<input id="rb" type="radio" name="galeria" value="<?php echo $rsg['id_galeria']; ?> " required />
				<?php
				  }
				?>
			  </div>
			</li>
			<?php
			  }
			?>
		  </ul>
      <br>
		<h2>Protecciones</h2>
		  <ul>
			<?php
			  foreach($results_gal2 as $rsg){
			?>
			<li>
			  <div class="cg">
				<img id="img" src="../images/<?php echo $rsg['categoria']; ?>/<?php echo $rsg['galeria']; ?>" width="270" height="360" alt="<?php echo $rsg['galeria']; ?>" name="<?php echo $rsg['galeria']; ?>" onclick='alert("Costo aproximado:\n<?php echo $rsg['costo_aprox']; ?>")' />
				<?php
				  if(isset($_SESSION['user_id'])){
				?>
				<input id="rb" type="radio" name="galeria" value="<?php echo $rsg['id_galeria']; ?>" required />
				<?php
				  }
				?>
			  </div>
			</li>
			<?php
			  }
			?>
		  </ul>
      <br>
		<h2>Puertas</h2>
		  <ul>
			<?php
			  foreach($results_gal3 as $rsg){
			?>
			<li>
			  <div class="cg">
				<img id="img" src="../images/<?php echo $rsg['categoria']; ?>/<?php echo $rsg['galeria']; ?>" width="270" height="360" alt="<?php echo $rsg['galeria']; ?>" name="<?php echo $rsg['galeria']; ?>" onclick='alert("Costo aproximado:\n<?php echo $rsg['costo_aprox']; ?>")' />
				<?php
				  if(isset($_SESSION['user_id'])){
				?>
				<input id="rb" type="radio" name="galeria" value="<?php echo $rsg['id_galeria']; ?>" required />
				<?php
				  }
				?>
			  </div>
			</li>
			<?php
			  }
			?>
		  </ul>
      <br>
		<h2>Ventanas</h2>
		  <ul>
			<?php
			  foreach($results_gal4 as $rsg){
			?>
			<li>
			  <div class="cg">
				<img id="img" src="../images/<?php echo $rsg['categoria']; ?>/<?php echo $rsg['galeria']; ?>" width="270" height="360" alt="<?php echo $rsg['galeria']; ?>" name="<?php echo $rsg['galeria']; ?>" onclick='alert("Costo aproximado:\n<?php echo $rsg['costo_aprox']; ?>")' />
				<?php
				  if(isset($_SESSION['user_id'])){
				?>
				<input id="rb" type="radio" name="galeria" value="<?php echo $rsg['id_galeria']; ?>" required />
				<?php
				  }
				?>
			  </div>
			</li>
			<?php
			  }
			?>
		  </ul>
		</form>
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
