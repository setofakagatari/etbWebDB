<html>
    <head></head>
    <body>

    <div class="rol">
	<?php
		if($_SESSION['rol']=="1"){
			echo "<h3>ADMINISTRADOR</h3>";
		}elseif ($_SESSION['rol']=="2") {
			echo "<h3>CREADOR   DE  TICKETS</h3>";
		}
	?>
</div>
    </body>
</html>