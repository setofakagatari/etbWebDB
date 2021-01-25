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
<html>
<head><title>Editar Ticket</title></head>
<link rel="stylesheet" href="../css/dashboard.css">
<script type="text/javascript" src="../css/javascript.js"></script>
<body >
<div class="contenedor">
<?php include "../Elements/headerCT.php"; ?>
<div class="contenido">
			<h1>Mi perfil</h1>
			<form action=''>
			
			<div class="empresas2">
   			<ul class="nav nav3">
				<li><a><h2>seleccione sus empresas</h2></a>
				<ul>
					<li><a ><p>etb<input readonly <?php if($_SESSION['etb'] != "etb") {echo "" ;}else{echo "checked";} ?> name="etb"type="checkbox" value="etb" onclick="javascript: return false;"></p></a><ul>
					<li><a >cobre</a></li></ul>

					<li><a><p>furel<input readonly <?php if($_SESSION['furel'] != "furel") {echo "" ;}else{echo "checked";} ?> name="furel" type="checkbox" value="furel" onclick="javascript: return false;"></p></a><ul>
					<li><a >cobre <br>fttc</a></li></ul>

					<li><a ><p>bftel<input readonly <?php if($_SESSION['bftel'] != "bftel") {echo "" ;}else{echo "checked";} ?> type="checkbox"name="bftel" value="bftel" onclick="javascript: return false;"></p></a><ul>
					<li><a>cobre<br>fttc <br> ftth</a></li></ul>

					<li><a><p>intercob<input readonly <?php if($_SESSION['intercob'] != "intercob") {echo "" ;}else{echo "checked";} ?> type="checkbox"name="intercob" value="intercob"  onclick="javascript: return false;"></p></a><ul>
					<li><a>cobre<br>fttc</a></li></ul>
					
					<li><a><p>silec<input readonly <?php if($_SESSION['silec'] != "silec") {echo "" ;}else{echo "checked";} ?> type="checkbox"name="silec" value="silec"  onclick="javascript: return false;"></p></a><ul>
					<li><a>cobre<br>fttc<br>ftth</a></li></ul>

					</li>

					</ul>

					</ul>
			</div>
		<h2>Nombre</h2>
        	<input class="casillano2" readonly type="text" autocomplete="off"  name="wholeName" value="<?php echo $_SESSION['wholeName']; ?>" />
			<br><br>
		<h2>Nombre de usuario</h2>
            <input class="casillano2" readonly type="text"autocomplete="off"  name="username" value="<?php echo $_SESSION['username']; ?>" />
			<br><br>
                
        <h2>Tipo de perfil</h2>
            <input class="casillano2" readonly type="text"autocomplete="off"  value="<?php if($_SESSION['rol'] = "2"){echo "Creador de Tickets";} ?>" />
            <br><br>
					
        <h2>Contraseña</h2>
			<input type="text" readonly class="casillano2" autocomplete="off" name="password" value="<?php echo $_SESSION['password']; ?>" /><br>
			
			
			
		</form>
		
</div>
<?php include "../Elements/sidebar.php"; ?>
<?php include "../Elements/rol.php"; ?>
</div>
		
		
</body>
</html>