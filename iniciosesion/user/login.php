<?php

session_start();

require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);
  $captcha = $_POST['g-recaptcha-response'];

  $secret = '6LfGkmIgAAAAAEm6GfJLEmlhBZGvXzHc3H5t7hXz';

  $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

  $arr = json_decode($response, TRUE);

    if($arr['success']){

      $message = '';
      $alert = '';

      if($_POST['password'] == $results['password']) {
        $_SESSION['user_id'] = $results['id'];
        header('Location: /SICADI');
      } else {
          $message = 'Usuario o contraseña incorrectos';
      }
    }else {
      $alert = '<h3>Verificar el captcha</h3>';
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
        <center>
        <input type="text" name="email" placeholder="Indroduzca su email">
        <input type="password" name="password" placeholder="Introduzca su contraseña">
        <div class="g-recaptcha" data-sitekey="6LfGkmIgAAAAABt-NxD78L7nT1b22wAzOSrnoL0J"></div><br>
        <?php if (!empty($alert)) : ?>
          <p><?= $alert ?></p>
          <?php endif; ?>
          <br>
        <input type="submit" value="Enviar">
        </center>
      </form>
      
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  </body>
</html>
