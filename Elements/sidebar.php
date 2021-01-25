<html>
    <head></head>
    <body>
    <div class="sidebar">
	<img class="logogris" src="../images/etbLogoGris.png">
		<?php
		if(isset($errMsg)){
			echo "<h1>".$errMsg."</h1><br>";
				
		}else{
			echo "<h1>bienvenido/a <br>".$_SESSION['username']."</h1>";
		}
        ?>
</div>
    </body>
</html>