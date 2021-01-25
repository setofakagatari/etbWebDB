<?php
    require '../config.php';
    
    
	if(isset($_SESSION['usuario']))
        if($_SESSION['usuario']['rol'] !="2")
            header("location:../index.php")
        
    
    
		
?>
<?php

if(empty($_SESSION['username']))
    header("location:../index.php")
    
?>
<?php

//Get id
$id = $_GET['id'];
//selecionar linea
$sql="SELECT * FROM tickets WHERE id=:id";
$query = $connect->prepare($sql);
$query->execute(array(':id' =>$id));
while($row = $query->fetch(PDO::FETCH_ASSOC)){
    
  
    
        $username = $row['username'];
        $ticketName = $row['ticketName'];
		$empresa = $row['empresa'];
		$tecnologia = $row['tecnologia'];
		$affair = $row['affair'];
		$description = $row['description'];
		$state = $row['state'];
        $file = $row['file'];
        if($_SESSION['username']== $row['username']){
           
        }else{
			header("location:myTickets.php");
		}
       
           
		
}




?>
<html>
<head><title>Editar Ticket</title></head>
<link rel="stylesheet" href="../css/dashboard.css">
<script type="text/javascript" src="../css/javascript.js"></script>
<body >
<div class="contenedor">
<?php include "../Elements/headerCT.php" ; ?>
<div class="contenido">
			<h1>Ver ticket</h1>
			<form action=''>
			
			<h2>Empresa</h2>
            <input type="text" class="casillano2" readonly name="file2" value="<?php echo $empresa;?>">	
					
			<h2>Tecnologia</h2>
            <input type="text" class="casillano2" readonly name="file2" value="<?php echo $tecnologia;?>">
			
					
			<h2>Asunto</h2>
			<textarea class="asunto"  readonly name="affair" value="<?php echo $affair; ?>" rows="2"><?php echo $affair; ?></textarea><br><br>

			<h2>Descripcion</h2>
			<textarea class="descripcion"name="description" readonly value="<?php echo $description; ?>" rows="15"><?php echo $description; ?></textarea><br><br>
			
			<h2>Nombre de archivo Adjunto</h2>
            <input type="text" class="casillano2" readonly name="file2" value="<?php echo $file;?>">
			
			
			
		</form>
		
</div>
<?php include "../Elements/sidebar.php"; ?>
<?php include "../Elements/rol.php"; ?>
</div>
	
		
</body>
</html>