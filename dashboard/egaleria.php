<?php
  require '../iniciosesion/user/database.php';

  $sql_ga = "DELETE FROM galerias WHERE id = ".$_GET['id'];
  $records = $conn->prepare($sql_ga);
  $records->execute();
  $result_eliminar = $records->fetchAll();

   if (count($result_eliminar) < 0) {
?>
<script type="text/Javascript">
  var msj = 'Error al eliminar el diseño, verifique citas activas';
  alert(msj);
  window.location.href='egaleria.php';
</script>
<?php
  }else{
?>
<script type="text/Javascript">
  var msj = 'Diseño eliminado con éxito';
  alert(msj);
  window.location.href='pgaleria.php';
</script>
<?php
  }
?>
