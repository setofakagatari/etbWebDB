<?php
//incluir de config
require ("../config.php");
if(isset($_SESSION['usuario']))
            if($_SESSION['usuario']['rol'] !="1")
                header("location:../index.php");

//obtener id
$id = $_GET['id'];

//eliminar la tabla
$sql = "DELETE FROM tickets WHERE id=:id";
$query = $connect->prepare($sql);
$query->execute(array(':id' => $id));
//redirigir a index.php
header("Location:tickets.php");

?>