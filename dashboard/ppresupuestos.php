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

//Obtiene el id de la cita para mostrar los datos del cliente en el presupuesto
$sql_user = "SELECT U.nombre, U.telefono, U.email, CI.detalle_pedido, CI.id as id_cita FROM users as U, citas_presupuestos as CI WHERE U.id=CI.id_user AND CI.id=".$_GET['id_cita'];
$records = $conn->prepare($sql_user);
$records->execute();
$result_user = $records->fetchAll();

foreach($result_user as $ru){
}

$mtabla = 0;
$cantidad = "";
$descripcion = "";
$fecha ="";
$subtotal = "";
$iva = "";
$total = "";

if( $_POST ){
  $id_cita = $ru['id_cita'];
  $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad']: '';
  $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion']: '';
  $fecha = date("Y-m-d");
  $subtotal = isset($_POST['precio']) ? $_POST['precio']: '';
  $iva = $subtotal * 0.16;
  $total = $subtotal + $iva;
  $sql_inpre = "INSERT INTO presupuestos (id_cita_presupuesto, cantidad, descripcion, fecha, subtotal, iva, total) VALUES (".$id_cita.", ".$cantidad.", '".$descripcion."', '".$fecha."', ".$subtotal.", ".$iva.", ".$total.")";
  $statement_insert = $conn->prepare($sql_inpre);
  $statement_insert->execute();

  $mtabla = 1;
}

$sql

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
              </ul>
			</li>
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
			<h2>GENERAR PRESUPUESTO</h2>
			<table width="100%">
			  <tr>
				<th width="50%"><h4><strong>DATOS DEL CLIENTE</strong></h4></th>
        <th width="30%"><h4><strong>DETALLE PEDIDO</strong></h4></th>
				<th width="20%"><h4><strong>PRESUPUESTO</strong></h4></th>
			  </tr>
			  <tr>
				<td><strong>NOMBRE:</strong> <?php echo $ru['nombre']; ?></br>
					<strong>TELEFONO:</strong> <?php echo $ru['telefono']; ?></br>
					<strong>E-MAIL:</strong> <?php echo $ru['email']; ?>
				</td>
        <td><?php echo $ru['detalle_pedido'] ?></td>
				<td><strong>FECHA: </strong><?php echo date("Y-m-d"); ?></td>
			  </tr>
			</table>
			<h3>Agregar conceptos</h3>
			<form method="post">
			<label>Cantidad</label>
			<input type="text" name="cantidad" requiered />
			<label>Descripción del concepto</label>
			<input type="text" name="descripcion" requiered />
			<label>Precio</label>
			<input type="text" name="precio" requiered />
			<br>
			<input type="submit" id="submit" value="Agregar" />
			</form>

			<?php
			if ( $mtabla == 1 ){
			?>
			<h3>Detalle del presupuesto</h3>
			<table width="100%">
			  <tr>
				<th width="15%"><h4><strong>CANTIDAD</strong></h4></th>
				<th width="70%"><h4><strong>DESCRIPCIÓN</strong></h4></th>
				<th width="15%"><h4><strong>PRECIO</strong></h4></th>
			  </tr>
			  <tr>
				<td><strong><?php echo $cantidad; ?></strong></td>
				<td><strong><?php echo $descripcion; ?></strong></td>
				<td><strong>$ <?php echo $subtotal; ?></strong></td>
			  </tr>
			</table>
			<table width="100%">
			  <tr>
				<td width="70%" rowspan="3"></td>
				<td width="15%"><h4><strong>SUBTOTAL</strong></h4></td>
				<td width="15%"><STRONG>$ <?php echo $subtotal; ?></STRONG></td>
			  </tr>
			  <tr>
				<td width="15%"><h4><strong>IVA (16%)</strong></h4></td>
				<td width="15%"><STRONG>$ <?php echo $iva; ?></STRONG></td>
			  </tr>
			  <tr>
				<td width="15%"><h4><strong>TOTAL</strong></h4></td>
				<td width="15%"><STRONG>$ <?php echo $total; ?></STRONG></td>
			  </tr>
			</table>
			<?php
			  }
			?>
			<br>
			*NOTA: Este presupuesto está sujeto a variación de cambio de precio en el material de las ferreteras y se requiere un 50% de anticipo del presupuesto total, el resto se liquidará a la entrega del trabajo.
		  </div>
		</div>
	  </div>
    </div>
  </body>
</html>
