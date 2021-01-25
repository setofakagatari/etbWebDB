<?php  
if(isset($_SESSION['usuario']))
if($_SESSION['usuario']['rol'] !="1")
	header("location:../index.php");
?>
<html>
    <head></head>
    <body>
    <div class="header2" id="header2">
	<a href="javascript:abrir()"><img id="menucerraricon" class="menucerraricon casillano" src="../images/menuIcon.png"></a>
	<div class="precenter"></div>
	<h1><?php echo $_SESSION['username'];?> </h1>
	<div class="postcenter"></div>
	

	<span tooltip="Salir" flow="down"><a href="../logout.php"><img class="cerraricon casillano" src="../images/cerrarIcon.png"></a></span>

</div>
<div class="header" id="header">		
	<a href="javascript:cerrar()"><img id="menuicon"class="menuicon casillano" src="../images/menuIcon.png"></a><pre>     </pre>				
	<h1>aplicativo<br>web</h1><pre>     </pre>	
	<img class="logoBlanco" src="../images/etbLogoBlanco.png"><pre>     </pre>			
	<div class="right"></div>
		<h1><?php echo $_SESSION['username'];?> </h1><pre>     </pre>				
	<span tooltip="Salir" flow="down"><a href="../logout.php"><img class="cerraricon casillano" src="../images/cerrarIcon.png"></a></span>
			
	
</div>
			<div class="menu" id="menu">

					<a class="Amenu"href="../Administrador/dashboardAdmin.php"><p>Inicio</p></a><pre>     </pre>	
					<a class="Amenu" href="../Administrador/editUser.php?id=<?php echo $_SESSION['id']; ?>"><p>Mi perfil</p></a><pre>     </pre>	
					<a class="Amenu" href="../Administrador/createUser.php"><p>Crear usuario</p></a><pre>     </pre>	
					<a class="Amenu" href="../Administrador/users.php"><p>Lista de usuarios</p></a><pre>     </pre>	
					<a class="Amenu" href="../Administrador/tickets.php"><p>Lista de tickets</p></a><pre>     </pre>	

				</div>
    </body>
</html>