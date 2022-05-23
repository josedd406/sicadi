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
}

$sql = "SELECT CI.id as id_cita, GA.id as id_galeria, U.nombre, CA.categoria, GA.galeria, CI.colonia, CI.calle, CI.numero, CI.referencia, CI.detalle_pedido, CI.descripcion, CI.fecha, CI.hora, SC.status_cita, SC.id as id_status_cita FROM categorias as CA, galerias as GA, users U, citas_presupuestos as CI, status_citas as SC WHERE CA.id=GA.id_categoria AND GA.id=CI.id_galeria AND U.id=CI.id_user AND SC.id=CI.id_status_cita";
$records = $conn->prepare($sql);
$records->execute();
$result_cita = $records->fetchAll();

$sql2 = "SELECT id, status_cita, descripcion FROM status_citas";
$records = $conn->prepare($sql2);
$records->execute();
$result_stcitas = $records->fetchAll();

if (!empty($_POST['detalle_pedido'])) {
{
$sql3 = "INSERT INTO citas_presupuestos (detalle_pedido) VALUES (:detalle_pedido)";
$stmt = $conn->prepare($sql3);
$stmt->bindParam(':detalle_pedido',$_POST['detalle_pedido']);

if ($stmt->execute()){
  $message = 'Se ha guardado el detalle del pedido';
} else {
  $message = 'Lo sentimos ha ocurrido un error al guardar el detalle del pedido';
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
	<script type="text/Javascript">
	  function getURL(var1){
		var dir = "mcita.php?id_cita="+var1+"&id_status_cita=";
		dir += document.getElementById('status').value;
		window.location.href=dir;
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
			<h2>CITAS REGISTRADAS</h2>
			<table width="100%" style="text-align:center;">
			  <thead>
				<tr>
				<th style="width:50px">Imagen</th>
				<th style="width:120px">Cliente</th>
				<th style="width:100px">Dirección</th>
        <th style="width:100px">Detalle Pedido</th>
				<th style="width:160px">Fecha y Hora de cita</th>
				<th style="width:150px">Estatus de cita</th>
				</tr>
			  </thead>
			  <tbody>
			    <?php
				  foreach($result_cita as $rc){
				?>
				<tr>
				  <td><img id="img" src="../images/<?php echo $rc['categoria']; ?>/<?php echo $rc['galeria']; ?>" width=45" height="60" alt="<?php echo $rc['galeria']; ?>" name="<?php echo $rc['galeria']; ?>"" /></td>
				  <td><?php echo $rc['nombre']; ?></td>
				  <td>CALLE <?php echo $rc['calle']; ?>, NUMERO <?php echo $rc['numero']; ?>, COLONIA <?php echo $rc['colonia']; ?> </td>
          <td>
          <form action="../dashboard/pcitas.php" method="post">
          <input type="text" id="detalle_pedido" name="detalle_pedido" placeholder="Detalle del pedido">
          <input type="submit" id="submit" value="Enviar">
          </form>
          </td>
				  <td><?php echo $rc['fecha']; ?> <?php echo $rc['hora']; ?></td>
				  <td>

				  <select id="status" name="status">
					<?php
					  foreach($result_stcitas as $rstc){
					?>
					<option value="<?php echo $rstc['id']; ?>" <?php if($rstc['id'] == $rc['id_status_cita']){ echo 'selected';} ?> ><?php echo $rstc['status_cita'] ?></option>
					<?php
					  }
					?>
				  </select>
				  <br>
				  <a href="javascript:getURL(<?php echo $rc['id_cita']; ?>)"><input id="submit" type="button" value="Actualizar" /></a>
				  <br>
				  <a href="ppresupuestos.php?id_cita=<?php echo $rc['id_cita']; ?>"><input id="submit" type="button" value="Generar presupuesto" /></a>
				  </td>

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
