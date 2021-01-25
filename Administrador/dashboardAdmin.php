<?php
    require '../config.php';
    
    
	if(isset($_SESSION['usuario']))
        if($_SESSION['usuario']['rol'] !="1")
            header("location: ../index.php")
        
    
    
		
?>
<?php

if(empty($_SESSION['username']))
    header("location: ../index.php")
    
?>
<html>
	<head>
		<title>dashboard</title>
		<link rel="stylesheet" href="../css/dashboard.css">
		<script type="text/javascript" src="../css/javascript.js"></script>
	</head>
	<body>
		<div class="contenedor">
			<?php include "../Elements/headerA.php" ; ?>
			<div class="contenido">
				<p> asdahdgahs ads h asd ash das dsahdasdashdasdhasdgad has dhasdasdhas dasd
				as gasd ahsdhasdgashdgasgdashdhasd a as  asdasd asdasdahsd</p>
			</div>
			<?php include "../Elements/sidebar.php"; ?>
			<?php include "../Elements/rol.php"; ?>
		</div>
		   
	   
	</body>
</html>