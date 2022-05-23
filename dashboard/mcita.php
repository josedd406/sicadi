<?php
  require '../iniciosesion/user/database.php';
  
  $sql_del = "UPDATE citas_presupuestos SET id_status_cita = ".$_GET['id_status_cita']." WHERE id = ".$_GET['id_cita'];
  $records = $conn->prepare($sql_del);
  $records->execute();
  $result = $records->fetchAll();
  
  if (count($result) > 0) {
?>
<script type="text/Javascript">
  var msj = 'Error al actualizar la cita';
  alert(msj);
  window.location.href='pcitas.php';
</script>
<?php 
  }else{
?>
<script type="text/Javascript">
  var msj = 'Cita actualizada';
  alert(msj);
  window.location.href='pcitas.php';
</script>
<?php  
  }
?>
