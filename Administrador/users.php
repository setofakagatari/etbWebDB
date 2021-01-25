<?php

    require ("../config.php");
    if(isset($_SESSION['usuario']))
            if($_SESSION['usuario']['rol'] !="1")
                header("location:../index.php")


?>
<?php

    if(empty($_SESSION['username']))
    header("location:../index.php")

?>
<html>
<head>	
    <title>Lista de Usuarios</title>
	<link rel="stylesheet" href="../css/table.css">
	<script type="text/javascript" src="../css/javascript.js"></script>
</head>

<body>
<div class="contenedor">

<?php include "../Elements/headerA.php" ; ?>	
<div class="tablaTickets">
    
    <table align="center"cellspacing="0">
				
		<tr class="tr">
			<td class="left"></td>
			<td class="Titulo" colspan="5">Usuarios</td>
			<td class="right"></td>	
		</tr>		
        <tr  class="tr">
				
            <td class="left">id</td>
            
            <td >Nombre de Usuario</td>
            <td >Nombre Completo</td>
            <td>Empresas</td>
            <td >Rol</td>
            <td >Contraseña</td>
            
        <td class="right">Opciones</td>
					 
        </tr>
	
    <?php 	
    $stmt = $connect->query("SELECT * FROM users ORDER BY id DESC");
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 		
        echo "  <tr class='body'>";
        echo "      <td>".$row['id']."</td>";
        echo "      <td>".$row['username']."</td>";
        echo "      <td>".$row['wholeName']."</td>";
        echo "      <td>".$row['etb']." ".$row['furel']." ".$row['bftel']." ".$row['intercob']." ".$row['silec']."</td>";
        if ($row['rol']=="1"){
        echo "      <td>Administrador</td>";
        }elseif($row['rol']=="2"){
        echo "      <td>Creador de Tickets</td>";
        }
        echo "      <td>".$row['password']."</td>";
        echo "      <td><a class='options' href=\"editUser.php?id=$row[id]\">Editar</a>
                    <a class='options' href=\"deleteUser.php?id=$row[id]\" onClick=\"return confirm('Esta seguro que quiere borrar el usuario $row[username]')\">Borrar</a></td>";
        echo "  </tr>";
        

	}
	?>
    </table>
</div>
<?php include "../Elements/rol.php"; ?>
</div> 

</body>
</html>

