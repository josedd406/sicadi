<?php
require 'database.php';

$message = '';

if (!empty($_POST['nombre']) && !empty($_POST['telefono']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'] && !empty($_POST['c_password']))) {
	$pw1 = $_POST['password'];
	$pw2 = $_POST['c_password'];
  $email = $_POST['email'];

  $correo_duplicado = "";
  $verificar_correo = "SELECT * FROM users WHERE email='$email'";
    foreach ($conn->query($verificar_correo) as $row) {
        //print $row['email'] . "\t";
        $correo_duplicado = $row['email'];

    }
    if ($correo_duplicado!=""){
      echo "Este correo ya esta registrado";
    } else {
      

  if($pw1 == $pw2){
	$sql = "INSERT INTO users (nombre, telefono, username, email, password, privilegios) VALUES (:nombre, :telefono, :username, :email, :password, :privilegios)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':nombre',$_POST['nombre']);
	$stmt->bindParam(':telefono',$_POST['telefono']);
	$stmt->bindParam(':username',$_POST['username']);
	$stmt->bindParam(':email',$_POST['email']);
	$stmt->bindParam(':password', $_POST['password']);
	$stmt->bindParam(':privilegios',$_POST['privilegios']);

	if ($stmt->execute()){
	  $message = 'Ha sido creado el usuario satisfactoriamente';
	} else {
      $message = 'Lo sentimos ha habido un error al crear su cuenta';
	}
  }else{
	  $message = 'Las contraseñas no coinciden';
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registrarse</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body>
  <?php require '../partials/header.php' ?>

<?php if(!empty($message)): ?>
  <p><?= $message ?></p>
<?php endif; ?>

  <h1>Registrate</h1>
  <span>o <a href="../user/login.php">Ingresa</a></span>

    <form action="../user/registro.php" method="post">
      <input type="text" name="nombre" placeholder="Introduzca su nombre">
      <input type="text" name="telefono" placeholder="Introduzca su numero de telefono">
      <input type="text" name="username" placeholder="Introduzca un nombre de usuario">
      <input type="text" name="email" placeholder="Introduzca su email">
      <input type="password" name="password" placeholder="Introduzca su contraseña">
      <input type="password" name="c_password" placeholder="Confirme su cotraseña">
      <input type="hidden" name="privilegios" value="cliente">
      <input type="submit" value="Enviar">
    </form>
  </form>
  </body>
</html>
