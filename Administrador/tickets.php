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
<?php
    $stmt = $connect->query("SELECT * FROM tickets ORDER BY id DESC");
?>
<html>
<head>	
    <title>Lista de Tickets</title>
    
	<link rel="stylesheet" href="../css/table.css">
	<script type="text/javascript" src="../css/javascript.js"></script>
</head>

<body>
<div class="contenedor">

<?php include "../Elements/headerA.php" ; ?>
<div class="tablaTickets">
    
    <table align="center" cellspacing="0">
				
		<tr class="tr">
			<td class="left"></td>
			<td class="Titulo" colspan="9">Tickets</td>
			<td class="right"></td>	
		</tr>		
        <tr  class="tr">
				
            <td class="left">id</td>
            <td >Fecha de ingreso</td>
            <td >Nombre de Usuario</td>
            <td >Nombre del ticket</td>
            <td >Empresa</td>
            <td >Tecnologia</td>
            <td >Asunto</td>
            <td >Descripcion</td>
            <td>Estado</td>

        <td>Archivo Adjunto <br>(Guardados en <br> ticketsetb@gmail.com)</td>
        <td class="right">Opciones</td>
					 
        </tr>
	
    <?php 	
    
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 		
      
        echo "  <tr class='body'>";
        echo "      <td>".$row['id']."</td>";
        echo "      <td>".$row['currentDate']."</td>";
        echo "      <td>".$row['username']."</td>";
        echo "      <td>".$row['ticketName']."</td>";
        echo "      <td>".$row['empresa']."</td>";
        echo "      <td>".$row['tecnologia']."</td>";
        echo "      <td><div class='asunto'>".$row['affair']."</div></td>";
        echo "      <td><div class='descripcion'>".$row['description']."</div></td>";
        echo "      <td>".$row['state']."</td>";
        echo "      <td>".$row['file']."</td>";
        echo "      <td><a class='options' href=\"editTicket.php?id=$row[id]\">Editar</a>
                    <a class='options' href=\"deleteTicket.php?id=$row[id]\" onClick=\"return confirm('Esta seguro que quiere borrar el ticket $row[ticketName]')\">Borrar</a></td>";
        echo "  </tr>";
        
        
        
        

        
	}
	?>
    </table>
    </div>
    <?php include "../Elements/rol.php"; ?>
</div> 

</body>
</html>

