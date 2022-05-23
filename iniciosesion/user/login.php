<?php

session_start();

require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

    if($_POST['password'] == $results['password']) {
      $_SESSION['user_id'] = $results['id'];
      header('Location: /SICADI');
    } else {
      $message = 'Usuario o contraseña incorrectos o inexistentes';
    }


}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Iniciar Sesion</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body>
      <?php require '../partials/header.php' ?>
    <h1>Iniciar Sesion</h1>
      <span>o <a href="../user/registro.php">Registrarse</a></span>

      <?php if (!empty($message)) : ?>
        <p><?= $message ?></p>
      <?php endif; ?>

      <form action="../user/login.php" method="post">
        <input type="text" name="email" placeholder="Indroduzca su email">
        <input type="password" name="password" placeholder="Introduzca su contraseña">
        <input type="submit" value="Enviar">
      </form>
  </body>
</html>
