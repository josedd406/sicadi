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

//Manda a llamar la imagen seleccionada en la galeria por el id pasado por la url
$sql = "SELECT c.id as id_categoria, c.categoria, g.id as id_galeria, g.galeria FROM categorias c, galerias g WHERE c.id=g.id_categoria AND g.id=".$_GET['galeria'];
$records = $conn->prepare($sql);
$records->execute();
$results_gal = $records->fetchAll();

if (count($results_gal) > 0) {
    $result_gal = $results_gal;
	foreach($result_gal as $rg){
	}
  }else{
	echo '<script type="text/Javascript">alert("Favor de seleccionar una imagen de la galería"); location.href ="../galeria/galeria.php"; </script>';
}

if( $_POST ){
  $id_user = $user['id'];
  $id_galeria = isset($_GET['galeria']) ? $_GET['galeria']: '';
  $colonia = isset($_POST['colonia']) ? $_POST['colonia']: '';
  $calle = isset($_POST['calle']) ? $_POST['calle']: '';
  $numero = isset($_POST['numero']) ? $_POST['numero']: '';
  $referencia = isset($_POST['referencia']) ? $_POST['referencia']: '';
  $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion']: '';
  $fecha = isset($_POST['fecha']) ? $_POST['fecha']: '';
  $hora = isset($_POST['hora']) ? $_POST['hora']: '';
  $status = isset($_POST['status']) ? $_POST['status']: '';

  //Consulta disponibilidad de fecha y hora
  $sql_cdc = "SELECT fecha, hora FROM citas_presupuestos WHERE fecha='".$fecha."' AND hora='".$hora."'";
  $records = $conn->prepare($sql_cdc);
  $records->execute();
  $result_cdc = $records->fetchAll();

  if (count($result_cdc) > 0) {
	echo '<script type="text/JavaScript">alert("Hora no disponible, favor de elegir otra");</script> ';
  }else{

  //Registra la cita en la base de datos
  $sql_insert = "INSERT INTO citas_presupuestos ( id_user, id_galeria, id_status_cita, colonia, calle, numero, referencia, descripcion, fecha, hora) VALUES (".$id_user.", ".$id_galeria.", ".$status.", '".$colonia."', '".$calle."', '".$numero."', '".$referencia."', '".$descripcion."', '".$fecha."', '".$hora."')";
  $statement_insert = $conn->prepare($sql_insert);
  $statement_insert->execute();

  echo '<script language="JavaScript">alert("Cita agendada con éxito");</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Citas</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
  </head>
  <body>
    <div id="main">
      <header>
        <div id="logo">
          <div id="logo_text">
            <h1><a href="../index.php">SICADI<span class="logo_colour"> Transformetal y Reparaciones </span></a></h1>
            <h2>Solicitar Presupuesto</h2>
        </div>
        </div>
      </header>
			<nav>
        <ul class="sf-menu" id="nav">
          <li><a href="../index.php">Inicio</a></li>
          <li><a href="../informacion/informacion.php">Quienes somos</a></li>
          <li><a href="../galeria/galeria.php">Galeria</a></li>
					<?php if(!empty($user)): ?>
          <li class="selected"><a href="../citas/citas.php">Citas</a></li>
					<?php endif; ?>
					<?php if(!empty($user)): ?>
          <li><a href="../contacto/contacto.php">Contacto</a></li>
					<?php endif; ?>
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
	  <div id="site_content">
	  <div class="content">
		<h1>Genere su cita para un presupuesto</h1>
		<section class="principal">
		  <form method="post">
			<img id="img" src="../images/<?php echo $rg['categoria']; ?>/<?php echo $rg['galeria']; ?>" width="90" height="120" alt="<?php echo $rg['galeria']; ?>" name="<?php echo $rg['galeria']; ?>" />
			<label>Fecha de la cita:</label>
			<input type="date" id="fecha" name="fecha" min="<?php echo date("Y-m-d"); ?>" required />
			<label>Horas disponibles:</label>
			<input type="time" id="hora" name="hora" list="listahoras" step="0.001" required />
			<br>
			<h3>Dirección</h3>
			<label>Colonia:</label>
			<input type="text" name="colonia" required />
			<label>Calle:</label>
			<input type="text" name="calle" required />
			<label>Número:</label>
			<input type="text" name="numero" required />
			<label>Referencias del domicilio:</label>
			<input type="text" name="referencia" required />
			<label >Descripción del presupuesto:</label>
			<textarea  name="descripcion"></textarea>
			<input type="hidden" name="status" value="1" />
			<br>
			<input id="submit" name="submit" type="submit" value="Enviar" />
		  </form>
		  <datalist id="listahoras">
			<option value="10:00:00">
			<option value="12:00:00">
			<option value="14:00:00">
		  </datalist>
		</section>
	  </div>
	  </div>
	  <footer>
      <p>Copyright &copy; SICADI <a href="../informacion/informacion.php">Transformetal y Reparaciones</a></p>
    </footer>
    </div>
  </body>
</html>
