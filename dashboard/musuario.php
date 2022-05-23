<?php
session_start();

require '../iniciosesion/user/database.php';

if (isset($_SESSION['user_id'])) {
  $records = $conn->prepare('SELECT id, email, password, username, privilegios FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = null;

  if (count($results) > 0) {
    $user = $results;
  }
  //var_dump($results);
}

$sql_user = "SELECT * FROM users WHERE id=".$_GET['id'];
$records = $conn->prepare($sql_user);
$records->execute();
$result = $records->fetchAll();

$muser = null;

foreach( $result as $muser ){
}

if( $_POST ){
  if( $_POST['password'] == $_POST['c_password'] ){
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$telefono = $_POST['telefono'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$privilegios = $_POST['privilegios'];
	$sql_update = "UPDATE users SET nombre = '".$nombre."', telefono = '".$telefono."', username = '".$username."', email = '".$email."', password = '".$password."', privilegios = '".$privilegios."' WHERE users.id =".$id;
	$statement_insert = $conn->prepare($sql_update);
	$statement_insert->execute();
?>
<script type="text/JavaScript">
  var msj = 'Datos actualizados con éxito';
  alert(msj);
  window.location="pusuarios.php";
</script>
<?php
  }else{
?>
<script type="text/JavaScript">
  var msj = '¡Error! Las contraseñas no coinciden';
  alert(msj);
</script>
<?php
  }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Administrador</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
  </head>
  <body>
    <div id="main">
      <header>
        <div id="logo">
          <div id="logo_text">
            <h1><a href="../index.php">SICADI<span class="logo_colour"> Transformetal y Reparaciones </span></a></h1>
            <h2>Administrador</h2>
        </div>
        </div>
        <nav>
          <ul class="sf-menu" id="nav">
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="../informacion/informacion.php">Quienes somos</a></li>
            <li><a href="../galeria/galeria.php">Galeria</a></li>
            <li><a href="../citas/citas.php">Citas</a></li>
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
      <div id="menu_admin">
			<div id="logo_admin">
			  <p class="texto"><a href="admin.php"><?= $user['username'] ?></a></p>
			</div>
			<div id="contenedor_primero" class="contenedor">
			  <div id="logo_interno">

			  </div>
			  <p class="texto"><a href="pusuarios.php">Usuarios</a></p>
			</div>
			<div class="contenedor">
			  <div id="logo_interno">

			  </div>
			  <p class="texto"><a href="pcitas.php">Citas</a></p>
			</div>
			<div class="contenedor">
			  <div id="logo_interno">

			  </div>
			  <p class="texto"><a href="../dashboard/pgaleria.php">Galeria</a></p>
			</div>
			  </div>
		  <div id="contenido">
			<h2>MODIFICAR USUARIO</h2>
			<form method="post">
			  <label>Nombre: </label>
			  <input type="hidden" name="id" value="<?php echo $muser['id']; ?>" />
			  <input type="text" name="nombre" value="<?php echo $muser['nombre']; ?>" />
			  <label>Teléfono: </label>
			  <input type="text" name="telefono" value="<?php echo $muser['telefono']; ?>" />
			  <label>Nombre de usuario: </label>
			  <input type="text" name="username" value="<?php echo $muser['username']; ?>" />
			  <label>E-mail: </label>
			  <input type="text" name="email" value="<?php echo $muser['email']; ?>" />
			  <label>Contraseña: </label>
			  <input type="password" name="password" value="<?php echo $muser['password']; ?>" />
			  <label>Confirmar contraseña: </label>
			  <input type="password" name="c_password" value="<?php echo $muser['password']; ?>" />
			  <label>Privilegios: </label>
			  <select name="privilegios" >
				<option name="admin">admin</option>
				<option name="empleado">empleado</option>
				<option name="cliente" selected>cliente</option>
			  </select>
			  <input id="submit" name="submit" type="submit" value="Actualizar datos">
			</form>
		  </div>
		</div>
	  </div>
    </div>
  </body>
</html>
