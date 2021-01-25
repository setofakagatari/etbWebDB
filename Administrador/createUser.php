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

	$apContent="abcdfghijklmnopqrstuvwxyzABECDEFGHIJKLMNOPQRSTUVWXYZ123456789";	
	$autoPassword ="";
	for ($ap=0;$ap<10;$ap++){
	$autoPassword .= substr($apContent, rand (0, 61),1);
	}
?>
<?php

	
	if(isset($_POST['register'])){

		$nombres=$_POST['nombres'];
		$apellidos=$_POST['apellidos'];
		$wholeName= $nombres." ".$apellidos;

		$usernamePN = substr($nombres, 0, 4);
		$usernamePA = substr($apellidos, 0, 3);
		$primerApellido= substr($apellidos, 0, strpos($apellidos, " "));
		$contadorPA =strlen($primerApellido);
		
		$contadorPAsuma1 = $contadorPA+"1";
		$usernameSA = substr($apellidos, $contadorPAsuma1, "1");



		$errMsg ='';
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
		

		$username2 = $usernamePN.$usernamePA.$usernameSA;
		$username = strtolower($username2);
		
        if(empty($_POST['password'])){
			
			$password=$autoPassword;
		}else{
			$password=$_POST['password'];
		}

		$rol = $_POST['rol'];
		$empresas= $silec.$intercob.$etb.$furel.$bftel;
		if($empresas =='')
			$errMsg = '<div class="errMsg">seleccione una empresa como minimo</div>';
		
			
		if($username == '')
			$errMsg = '<div class="errMsg">no username</div>';
		if($nombres == '')
			$errMsg = '<div class="errMsg">Ingrese los nombres del usuario</div>';
		if($apellidos == '')
			$errMsg = '<div class="errMsg">Ingrese los apellidos del usuario</div>';
		if($password == '')
			$errMsg = '<div class="errMsg">no contraseña</div>';
        
		if($rol == '')
            $errMsg = '<div class="errMsg">seleccione un tipo de perfil para el usuario</div>';
	
		
		if($errMsg ==''){
			try {
				$stmt = $connect->prepare('INSERT INTO users(etb, furel, bftel, intercob, silec, wholeName, username,password, rol) 
				VALUE (:etb, :furel, :bftel, :intercob, :silec, :wholeName, :username, :password, :rol)');
				$stmt->execute (array(
					':etb' =>$etb,
					':furel' =>$furel,
					':bftel' =>$bftel,
					':intercob' =>$intercob,
					':silec' =>$silec,
					':username' => $username,
					':wholeName' => $wholeName,
					':password' => $password,    
					
					':rol'=> $rol
                ));
				header ('Location: createUser.php?action=joined');
				exit;
			}
			catch(PDOExcept $e) {
				echo $e->getMessage();
			}
		}
	}
	if(isset($_GET['action'])&& $_GET['action'] == 'joined'){
		$stmt = $connect->query("SELECT * FROM users ORDER BY id DESC LIMIT 0,1");
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$username = $row['username'];
			if(isset($errMsg)){
				
					
			}else{
				$errMsg = "El usuario ".$username. " ha sido creado correctamente";
			}
			
			
		
		}
		
		}



?>
<html>
<head><title>Registro</title><link rel="stylesheet" type="text/css" href="">
<link rel="stylesheet" href="../css/dashboard.css">
<script type="text/javascript" src="../css/javascript.js"></script>
</head>
<body >
	<div class="contenedor">

	<?php include "../Elements/headerA.php" ; ?>


<div class="contenido">
	<h1>Crear Usuario</h1></b>
	<form action='' method="post">
	<div class="empresas">
   			<ul class="nav nav3">
				<li><a><h2>seleccione sus empresas</h2></a>
				<ul>
					<li><a ><p>etb<input name="etb"type="checkbox" value="etb"></p></a><ul>
					<li><a >cobre</a></li></ul>

					<li><a><p>furel<input name="furel" type="checkbox" value="furel"></p></a><ul>
					<li><a >cobre <br>fttc</a></li></ul>

					<li><a ><p>bftel<input type="checkbox"name="bftel" value="bftel"></p></a><ul>
					<li><a>cobre<br>fttc <br> ftth</a></li></ul>

					<li><a><p>intercob<input type="checkbox"name="intercob" value="intercob"></p></a><ul>
					<li><a>cobre<br>fttc</a></li></ul>
					
					<li><a><p>silec<input type="checkbox"name="silec" value="silec"></p></a><ul>
					<li><a>cobre<br>fttc<br>ftth</a></li></ul>

					</li>

					</ul>

					</ul>
			</div>
		<h2>Nombres</h2>
        	<input class="casillano2" type="text" autocomplete="off"  name="nombres" placeholder="Nombres del usuario"/>
			<br><br>
		<h2>Apellidos</h2>
            <input class="casillano2" type="text"autocomplete="off"  name="apellidos" placeholder="Apellidos del usuario"/>
			<br><br>
                
        <h2>Tipo de perfil</h2>
			<select name="rol" >
				<!--<option value="1">Administrador</option>-->
				<option value="2">Creador de tickets</option>
				</select><br>
					
        <h2>Contraseña</h2>
			<input type="text" class="casillano2" autocomplete="off" name="password" placeholder="contraseña" /><br><br>
					
				
				
				<input type="submit" class="accion"name="register" value="Crear"/><br>


				
			</form>
			</div>
<?php include "../Elements/sidebar.php"; ?>
<?php include "../Elements/rol.php"; ?>
</div>
		
</body>
</html>