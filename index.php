<html>
<head><title>ingreso</title>


<style>
	body {
		background-image: url("images/loginBack2.jpg");
		background-size: cover;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
	}
	h1{
		font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
		color: white;
	}
	.contenedor{
		width: 100%;
		
		margin:auto;
		
		display: grid;
		grid-gap: 5px;
		grid-template-columns: repeat(3, 1fr);
		grid-template-rows: repeat(2, auto);
		grid-template-areas:
							"left left login"
							"left left errMsg"
							;
							
							
	}
	input.casillano2 {
		background-color: rgb(36, 36, 36);
		border-radius: 50px;
		border: 3px solid #000000;
	
		padding: 5px 5px 5px 5px;
		color: #ffffff;
		font-size: 20px;
		text-align:center;
    
	}
	input.casillano2:hover {
		animation: casillano2 1050ms infinite alternate;
		border: 3px solid #CFA8F5;
	}
	@keyframes casillano2 {
		0% {border-color: rgb(3, 12, 97);}
		100% {border-color: rgb(0, 110, 201);}
	}
	input.accion {
		background-color: black;
		border-radius: 50px;
		border: 3px solid #000000;
		color: white;
		padding-left: 2em;
		padding-right: 2em;
		padding-top: 1em;
		padding-bottom: 1em; 
		font-size:20px;   
	}
	input.accion:hover {
		animation: casillano2 1050ms infinite alternate;
		border: 3px solid #CFA8F5;
	}
	.contenedor .login{
		background-image:url("images/sidebarBack.png");
		background-size:cover;
		border: solid 2px black;
		grid-area:login;
		display:flex;
		justify-content:center;
		align-content:center;
		text-align:center;
		padding:2em;
		border-radius:10%;
		position:relative;
		top:20%;
		right:20%;
		
	}
	img.logoblanco{
		width: 200px;
		height:200px;
		padding-right:2em;
		padding-top:2em;
	}
	.contenedor .errMsg{
		grid-area:errMsg;
		text-align:center;
		position:relative;
		top:60%;
		right:10%;
	}
	.contenedor .left{
		grid-area:left;
	}
	
	
	
</style>
</head>
<body >
	<div class="contenedor">
<?php

	
	

	require 'config.php';
	if (isset($_POST['login'])) {
		$errMsg = '';
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if($username == '')
			$errMsg ='<div class="errMsg">ingrese su nombre de usuario</div>';
		if($password == '')
			$errMsg ='<div class="errMsg">ingrese su contraseña</div>';
		
		if ($errMsg == '') {
			try {
				$stmt = $connect -> prepare('SELECT id, etb, furel, bftel, intercob, silec, wholeName, username, password, rol FROM  users WHERE username = :username');
				$stmt ->execute(array(
					':username' =>$username));
				$data = $stmt ->fetch(PDO::FETCH_ASSOC);
				if ($data == false){
					$errMsg = '<div class="errMsg">El usuario '.$username.' no se ha encontrado</div>';
				}
				else{
					if ($password ==$data['password']){
						$_SESSION['id'] = $data['id'];
						$_SESSION['username'] = $data['username'];
						
						$_SESSION['password'] = $data['password'];
						$_SESSION['etb'] = $data['etb'];
						$_SESSION['furel'] = $data['furel'];
						$_SESSION['bftel'] = $data['bftel'];
						$_SESSION['intercob'] = $data['intercob'];
						$_SESSION['silec'] = $data['silec'];
						$_SESSION['wholeName'] = $data['wholeName'];
						$_SESSION['rol'] = $data['rol'];

						$_SESSION['usuario'] =$data;
						
						if(isset($_SESSION['usuario'])){
							if($_SESSION['usuario']['rol'] == "1"){
								header('location: Administrador/dashboardAdmin.php');
							}else if ($_SESSION['usuario']['rol'] == "2"){
								header('location: CreadorDeTickets/dashboard.php');
							}else{
								header ('location:index.php');
							}
						}
						exit;
					}
					else
						$errMsg = '<div class="errMsg">Contraseña incorrecta</div>';
				}
			}

			catch(PDOException $e){
				$errMsg = $e->getMessage();
			}
			
		}
	}
?>		
		<div class="left"></div>
		<div class="login">
			<img class="logoBlanco"src="images/etbLogoBlanco.png">
			<div class="form">
			<h1>Ingresar</h1>
			
			<form action="" method="post">
				
				<input type="text" class="casillano2" name="username" placeholder="Nombre de Usuario"   value="<?php if(isset($_POST['username'])) echo $_POST['username']?>"/><br><br>
				
				<input type="password" class="casillano2" name="password" placeholder="Contraseña" autocomplete="off" value="<?php if(isset($_POST['password'])) echo $_POST['password']?>"/><br><br>
				<input type="submit" class="accion" name="login" placeholder="Ingresar" class="submit"/><br>
			</form>
			</div>
		
						
		</div>
		
		<div class="errMsg">
		<?php
				if(isset($errMsg)){
					
					
					echo '<h1>'.$errMsg.'</h1>';
					
				}
			?>
		</div>
		
		
	</div>
</body>
</html>



