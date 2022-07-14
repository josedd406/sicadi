<?php

$dsn = 'mysql:dbname=sicadi;host=127.0.0.1';
$user = 'root';
$password = '';

try{

	$pdo = new PDO(	$dsn, $user, $password);
	echo "Conexión exitosa<br>";
}catch( PDOException $e ){
	echo 'Error en la conexión
	: ' . $e->getMessage();
}



