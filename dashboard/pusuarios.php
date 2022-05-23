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

$sql = "SELECT * FROM users WHERE id != ".$user['id'];;
$records = $conn->prepare($sql);
$records->execute();
$result_users = $records->fetchAll();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Usuarios</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
	<script type="text/Javascript">
	  function confirmDelete(){
		  var resp = confirm("¿Está seguro de eliminar el registro?");
		  if ( resp == true ){
			return true;
		  }else{
			return false;
		  }
	  }
	</script>
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
			  <p class="texto"><a href="usuarios.php">Usuarios</a></p>
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
			<h2>TABLA DE USUARIOS</h2>
			<br>
			<br>
			<table width="100%" style="text-align:center;">
			  <thead>
				<tr>
				<th>Username</th>
				<th>Teléfono</th>
				<th>E-mail</th>
				<th>Privilegios</th>
				<th>Editar</th>
				<th>Eliminar</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				  foreach($result_users as $ru){
				?>
				<tr>
				  <td><?php echo $ru['username']; ?> <input type="hidden" name="<?php echo $ru['id']; ?>" /></td>
				  <td><?php echo $ru['telefono']; ?></td>
				  <td><?php echo $ru['email']; ?></td>
				  <td><?php echo $ru['privilegios']; ?></td>
				  <td><a href="musuario.php?id=<?php echo $ru['id'] ?>"><input id="submit" type="button" value="Actualizar" /></a></td>
				  <td><a href="eusuario.php?id=<?php echo $ru['id'] ?>"><input id="submit" type="button" value="Eliminar" onclick="return confirmDelete()" /></a></td>
				</tr>
				<?php
				  }
				?>
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>
    </div>
  </body>
</html>
