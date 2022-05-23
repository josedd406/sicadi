<?php
  require '../iniciosesion/user/database.php';
  
  $sql_del = "DELETE FROM users WHERE id = ".$_GET['id'];
  $records = $conn->prepare($sql_del);
  $records->execute();
  $result = $records->fetchAll();
  
  if (count($result) > 0) {
?>
<script type="text/Javascript">
  var msj = 'Error al eliminar el usuario, verifique citas activas';
  alert(msj);
  window.location.href='usuarios.php';
</script>
<?php 
  }else{
?>
<script type="text/Javascript">
  var msj = 'Usuario eliminado con éxito';
  alert(msj);
  window.location.href='pusuarios.php';
</script>
<?php  
  }
?>
