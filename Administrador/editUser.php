<?php
    require '../config.php';


	if(isset($_SESSION['usuario']))
        if($_SESSION['usuario']['rol'] !="1")
           header("location:../index.php")
		
?>
<?php

	if(empty($_SESSION['username']))
    header("location:../index.php")
    
?>
<?php


if(isset($_POST['update'])){
	$id = $_POST['id'];
	$username = $_POST['username'];
	$wholeName = $_POST['wholeName'];
	if(isset($_POST['etb'])){
		$etb =$_POST['etb'];
	}else{
		$etb =NULL;
	}
	if(isset($_POST['furel'])){
		$furel =$_POST['furel'];
	}else{
		$furel =NULL;
	}
	
	if(isset($_POST['bftel'])){
		$bftel =$_POST['bftel'];
	}else{
		$bftel =NULL;
	}
	if(isset($_POST['intercob'])){
		$intercob =$_POST['intercob'];
	}else{
		$intercob =NULL;
	}
	if(isset($_POST['silec'])){
		$silec =$_POST['silec'];
	}else{
		$silec =NULL;
	}
	$rol = $_POST['rol'];
	$password = $_POST['password'];
	
	//verificar variables
	$empresas= $silec.$intercob.$etb.$furel.$bftel;
	if(empty($username) || empty($wholeName) || empty($empresas) || empty($rol) || empty($password)){
		if(empty($username)) {
			$errMsg = "<h1> El nombre de usuario esta vacio</h1><br>";
		}
		if(empty($wholeName)){
			$errMsg = "<h1> EL nombre completo esta vacio</h1><br>";
		}
		if(empty($empresas)){
			$errMsg = "<h1>Seleccione una empresa como minimo</h1><br>";
		}
		if(empty($rol)){
			$errMsg = "<h1> rol esta vacio</h1><br>";
		}
		if(empty($password)){
			$errMsg = "<h1>password esta vacio</h1><br>";
		}
		
	} else {
		//insertar nuevos datos
		$sql = "UPDATE users SET username=:username, wholeName=:wholeName, etb=:etb, furel=:furel, bftel=:bftel, intercob=:intercob,
			 silec=:silec, rol=:rol, password=:password WHERE id=:id";
			$query = $connect->prepare($sql);
			$query->bindparam(':id',$id);
			$query->bindparam(':username',$username);
			$query->bindparam(':wholeName',$wholeName);
			$query->bindparam(':etb',$etb);
			$query->bindparam(':furel',$furel);
			$query->bindparam(':bftel',$bftel);
			$query->bindparam(':intercob',$intercob);
			$query->bindparam(':silec', $silec);
			$query->bindparam(':rol', $rol);
			$query->bindparam(':password', $password);
			
			$query->execute();
		header ("Location: editUser.php?id=$id&action=edited");
		}
}

?>
<?php

//Get id
$id = $_GET['id'];
//selecionar linea
$sql="SELECT * FROM users WHERE id=:id";
$query = $connect->prepare($sql);
$query->execute(array(':id' =>$id));
while($row = $query->fetch(PDO::FETCH_ASSOC)){
    
  
    
		$username = $row['username'];
		$wholeName = $row['wholeName'];
		$etb = $row['etb'];
		$bftel = $row['bftel'];
		$furel = $row['furel'];
		$intercob = $row['intercob'];
		$silec = $row['silec'];
		$rol = $row['rol'];
        $password = $row['password'];

        
		
}
if(isset($_GET['action'])&& $_GET['action'] == 'edited'){
	
	if(isset($errMsg)){
		
			
	}else{
		$errMsg = "El usuario ".$username. " ha sido editado correctamente";
	}
	
	

	

}


	


?>
<html>
<head><title>Editar Usuario</title><link rel="stylesheet" type="text/css" href="">
<link rel="stylesheet" href="../css/dashboard.css">
<script type="text/javascript" src="../css/javascript.js"></script>
</head>
<body >
	<div class="contenedor">

	<?php include "../Elements/headerA.php" ; ?>


<div class="contenido">
	<h1><?php if($_SESSION['id'] == $_GET['id']){ echo "Mi perfil"; }else { echo "Editar Usuario"; } ?></h1></b>
	<form action='' method="post">
  
	<div class="empresas">
   			<ul class="nav nav3">
				<li><a><h2>seleccione sus empresas</h2></a>
				<ul>
					<li><a ><p>etb<input <?php if($etb != "etb") {echo "" ;}else{echo "checked";} ?> name="etb"type="checkbox" value="etb"></p></a><ul>
					<li><a >cobre</a></li></ul>

					<li><a><p>furel<input <?php if($furel != "furel") {echo "" ;}else{echo "checked";} ?> name="furel" type="checkbox" value="furel"></p></a><ul>
					<li><a >cobre <br>fttc</a></li></ul>

					<li><a ><p>bftel<input <?php if($bftel != "bftel") {echo "" ;}else{echo "checked";} ?> type="checkbox"name="bftel" value="bftel"></p></a><ul>
					<li><a>cobre<br>fttc <br> ftth</a></li></ul>

					<li><a><p>intercob<input <?php if($intercob != "intercob") {echo "" ;}else{echo "checked";} ?> type="checkbox"name="intercob" value="intercob"></p></a><ul>
					<li><a>cobre<br>fttc</a></li></ul>
					
					<li><a><p>silec<input <?php if($silec != "silec") {echo "" ;}else{echo "checked";} ?> type="checkbox"name="silec" value="silec"></p></a><ul>
					<li><a>cobre<br>fttc<br>ftth</a></li></ul>

					</li>

					</ul>

					</ul>
			</div>
		<h2>Nombre</h2>
        	<input class="casillano2" type="text" autocomplete="off"  name="wholeName" value="<?php echo $wholeName; ?>" />
			<br><br>
		<h2>Nombre de usuario</h2>
            <input class="casillano2" type="text"autocomplete="off"  name="username" value="<?php echo $username; ?>" />
			<br><br>
                
        <h2>Tipo de perfil</h2>
			<select name="rol" >
                <?php
                    if($rol == "1"){
                        echo '<option value="1" selected>Administrador</option>';
                    }else{
                        echo '';
                    }
                    if($rol == "2"){
                        echo '<option value="2" selected>Creador de tickets</option>';
                    }else{
                        echo '<option value="2">Creador de tickets</option>';
                    }
                ?>
			</select><br>
					
        <h2>Contraseña</h2>
			<input type="text" class="casillano2" autocomplete="off" name="password" value="<?php echo $password; ?>" /><br><br>
			<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
            <input type="submit" class="accion"name="update" value="actualizar"/><br>
			</form>
            
			</div>
			<?php include "../Elements/sidebar.php"; ?>
<?php include "../Elements/rol.php"; ?>
</div>
	
</body>
</html>