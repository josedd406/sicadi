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

if (!empty($_POST['galeria']) && !empty($_POST['id_categoria']) && !empty($_POST['costo_aprox'])) {
{

$sql = "INSERT INTO galerias (galeria, id_categoria, costo_aprox) VALUES (:galeria, :id_categoria, :costo_aprox)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':galeria',$_POST['galeria']);
$stmt->bindParam(':id_categoria',$_POST['id_categoria']);
$stmt->bindParam(':costo_aprox',$_POST['costo_aprox']);

if ($stmt->execute()){
  $message = 'Ha sido agregado un diseño exitosamente';
} else {
    $message = 'Lo sentimos ha habido un error al agregar el diseño';
}

$categoria = $_POST['id_categoria'];

switch ($categoria){
  case 1:
  $target_path = '../images/portones/';
  break;
  case 2:
  $target_path = '../images/protecciones/';
  break;
  case 3:
  $target_path = '../images/puertas/';
  break;
  case 4:
  $target_path = '../images/ventanas/';
  break;
}

$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {

} else{
    
}


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
        <?php if(!empty($message)): ?>
          <p><?= $message ?></p>
        <?php endif; ?>
			<h2>AGREGAR IMAGEN</h2>
			<form action="../dashboard/mgaleria.php" method="post" enctype="multipart/form-data" action="uploader.php">
          <label>Nombre de la Imagen: </label>
          <input type="text" name="galeria" placeholder="Introduzca el nombre de la imagen">
          <label>Categoria: </label>
          <select name="id_categoria">
          <option name="1">1<label>. Portones</label></option>
          <option name="2">2<label>. Protecciones</label></option>
          <option name="3">3<label>. Puertas</label></option>
          <option name="4">4<label>. Ventanas</label></option>
          </select>
          <label>Costo Aproximado: </label>
          <input type="text" name="costo_aprox" placeholder="Introduzca el costro aproximado">
          <label for="archivo">Imagen</label>
          <input name="uploadedfile" type="file" />
          <br>
          <input type="submit" id="submit" value="Enviar">
			</form>
		  </div>
		</div>
	  </div>
    </div>
  </body>
</html>
