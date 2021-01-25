<?php

    require ("../config.php");
    if(isset($_SESSION['usuario']))
        if($_SESSION['usuario']['rol'] !="2")
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
<?php include "../Elements/headerCT.php" ; ?>
	<div class="tablaTickets">
        <table align="center"cellspacing="0">
				
					<tr class="tr">
						<td class="left"></td>
						<td class="Titulo" colspan="9">Mis Tickets</td>
						<td class="right"></td>
					
					</tr>
				
				
                    <tr  class="tr">
				
                        <td class="left">id</td>
                        <td class="center">Fecha de ingreso</td>
                        <td class="center">Nombre de Usuario</td>
                        <td class="center">Nombre del ticket</td>
                        <td class="center">Empresa</td>
                        <td class="center">Tecnologia</td>
                        <td class="center">Asunto</td>
                        <td class="center">Descripcion</td>
                        <td>Estado</td>

                        <td>Archivo Adjunto</td>
                        <td class="right">Opciones</td>
					 
                    </tr>
				
            <?php 	
            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 		
            
                if ($_SESSION['username']==$row['username'] ){

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
                echo "      <td><a href='viewTicket.php?id=$row[id]'>Ver Ticket</a></td>";
            
                echo "  </tr>";
                };
                
            }
            ?>
        </table>
    </div>
    <?php include "../Elements/rol.php"; ?>

	
</div> 
</body>
</html>

