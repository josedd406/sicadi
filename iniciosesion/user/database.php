<?php
  $server = 'localhost:85';
  $username = 'root';
  $password = '8988';
  $database = 'sicadi';

  try {
    $conn = new PDO("mysql:host=$server;dbname=$database;",$username, $password);
  } catch (PDOException $e) {
    die('Connected failed: '.$e->getMessage());
  }

 ?>
