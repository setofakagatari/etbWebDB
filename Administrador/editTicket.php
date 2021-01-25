<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
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
		$currentDate= date("d")."/".date("m")."/".date("Y");
		$empresa = $_POST['empresa'];
		$tecnologia = $_POST['tecnologia'];
		$affair = $_POST['affair'];
		$description = $_POST['description'];
		$state = $_POST['state'];
		if($empresa=="etb")
				$inicialesEm = "et";
			if($empresa=="furel")
				$inicialesEm = "fu";
			if($empresa=="bftel")
				$inicialesEm = "bf";
			if($empresa=="intercob")
				$inicialesEm = "in";
			if($empresa=="silec")
				$inicialesEm = "si";

			if($tecnologia=="cobre")
				$inicialesTec = "co";
			if($tecnologia=="fttc")
				$inicialesTec = "fc";
			if($tecnologia=="ftth")
				$inicialesTec = "fh";

		$ticketName= $_POST['ticketName'];
		
		
					$fileName=$_FILES['archivo']['name'];
					
					$fileSaved=$_FILES['archivo']['tmp_name'];
						
					if($fileName == ""){
						$file = $_POST['file2'];
					}else{
						$file= $fileName;
					}

			$mail = new PHPMailer(true);

			try {
				//Server settings
				$mail->SMTPDebug = 0;                      // Enable verbose debug output
				$mail->isSMTP();                                            // Send using SMTP
				$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
				$mail->Username   = 'ticketsetb@gmail.com';                     // SMTP username
				$mail->Password   = 'Bogota2020';                               // SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
				$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

				//Recipients
				$mail->setFrom('ticketsetb@gmail.com', $ticketName);
				$mail->addAddress('ticketsetb@gmail.com');     // Add a recipient
				

				// Attachments
				
				$mail->addAttachment($fileSaved, $fileName);    //Optional name

				// Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = $ticketName.' '.$affair;
				$mail->Body    = $description. '<br>' .$username. '<br>' .$empresa. '<br>' .$tecnologia;
				$mail->Charset = 'UFT-8';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				$mail->send();
				
			} catch (Exception $e) {
				$errMsg = "";
			}
		
		
		
		//verificar variables
		
		if(empty($username) || empty($empresa) || empty($tecnologia) || empty($affair) || empty($description)){
			
			if(empty($username)) {
				$errMsg = "<h1> El nombre de usuario esta vacio</h1><br>";
			}
			if(empty($empresa)){
				$errMsg = "<h1>Seleccione una empresa</h1><br>";
			}
			if(empty($tecnologia)){
				$errMsg = "<h1>Seleccione una tecnologia</h1><br>";
			}
			if(empty($affair)){
				$errMsg = "<h1>Agregue un asunto</h1><br>";
			}
			if(empty($description)){
				$errMsg = "<h1>Agregue una descripcion</h1><br>";
			}
			
		} else {
			//insertar nuevos datos
			$sql = "UPDATE tickets SET ticketName=:ticketName, username=:username, currentDate=:currentDate, empresa=:empresa, tecnologia=:tecnologia, affair=:affair, description=:description,
				state=:state, file=:file WHERE id=:id";
				$query = $connect->prepare($sql);
				$query->bindparam(':id',$id);
				$query->bindparam(':ticketName',$ticketName);
				$query->bindparam(':username',$username);
				$query->bindparam(':currentDate',$currentDate);
				$query->bindparam(':empresa',$empresa);
				$query->bindparam(':tecnologia',$tecnologia);
				$query->bindparam(':affair',$affair);
				$query->bindparam(':description',$description);
				$query->bindparam(':state',$state);
				$query->bindparam(':file', $file);
				
				
				$query->execute();
			header ("Location: editTicket.php?id=$id&action=edited");
			}
	}

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
       
           
		
}

$stmt = $connect->query("SELECT * FROM users ");
		while($row2 = $stmt->fetch(PDO::FETCH_ASSOC)){
			if ($username == $row2['username']){
				
				$etb = $row2['etb'];
				$furel = $row2['furel'];
				$bftel = $row2['bftel'];
				$intercob = $row2['intercob'];
				$silec = $row2['silec'];
			}
		
		}  


if(isset($_GET['action'])&& $_GET['action'] == 'edited'){
	
	if(isset($errMsg)){
		
			
	}else{
		$errMsg = "El ticket ".$ticketName. " ha sido editado correctamente";
	}
	
	



}


?>
<html>
<head><title>Editar Ticket</title></head>
<link rel="stylesheet" href="../css/dashboard.css">
<script type="text/javascript" src="../css/javascript.js"></script>
<body >
<div class="contenedor">
<?php include "../Elements/headerA.php" ; ?>
<div class="contenido">
			<h1>Crea tu ticket</h1>
			<form action='' method="post" enctype="multipart/form-data">
			
				<div class="empresas">
					<ul class="nav">
						<li><a><h2>seleccione sus empresas</h2></a>
							<ul>
					<?php 
							if ($etb != ""){
								if($empresa != "etb"){
									echo '<li><a><p>etb<input type="radio" name="empresa" value="etb"></p></a><ul>
									<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
								}else{
									echo '<li><a><p>etb<input checked type="radio" name="empresa" value="etb"></p></a><ul>';
									if($tecnologia != "cobre"){
										echo '';
									}else{
										echo '<li><a><p>cobre<input checked type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
									}
									if($tecnologia != "fttc"){
										echo '';
									}else{
										echo '<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input checked type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
									}
									if($tecnologia != "ftth"){
										echo '';
									}else{
										echo '<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input checked type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
									}
												
								}
							}else{
								echo "";
							}
						
							if ($furel != ""){
								if($empresa != "furel"){
									echo '<li><a><p>furel<input type="radio" name="empresa" value="furel"></p></a><ul>
									<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
								}else{
									echo '<li><a><p>furel<input checked type="radio" name="empresa" value="furel"></p></a><ul>';
									if($tecnologia != "cobre"){
										echo '';
									}else{
										echo '<li><a><p>cobre<input checked type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
									}
									if($tecnologia != "fttc"){
										echo '';
									}else{
										echo '<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input checked type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
									}
									if($tecnologia != "ftth"){
										echo '';
									}else{
										echo '<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input checked type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
									}
												
								}
							}else{
								echo "";
							}

						
						if ($bftel != ""){
							if($empresa != "bftel"){
								echo '<li><a><p>bftel<input type="radio" name="empresa" value="bftel"></p></a><ul>
								<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
							}else{
								echo '<li><a><p>bftel<input checked type="radio" name="empresa" value="bftel"></p></a><ul>';
								if($tecnologia != "cobre"){
									echo '';
								}else{
									echo '<li><a><p>cobre<input checked type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
								}
								if($tecnologia != "fttc"){
									echo '';
								}else{
									echo '<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input checked type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
								}
								if($tecnologia != "ftth"){
									echo '';
								}else{
									echo '<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input checked type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
								}
											
							}
						}else{
							echo "";
						}
						
							if ($intercob != ""){
								if($empresa != "intercob"){
									echo '<li><a><p>intercob<input type="radio" name="empresa" value="intercob"></p></a><ul>
									<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
								}else{
									echo '<li><a><p>intercob<input checked type="radio" name="empresa" value="intercob"></p></a><ul>';
									if($tecnologia != "cobre"){
										echo '';
									}else{
										echo '<li><a><p>cobre<input checked type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
									}
									if($tecnologia != "fttc"){
										echo '';
									}else{
										echo '<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input checked type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
									}
									if($tecnologia != "ftth"){
										echo '';
									}else{
										echo '<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input checked type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
									}
												
								}
							}else{
								echo "";
							}
						
							if ($silec != ""){
								if($empresa != "silec"){
									echo '<li><a><p>silec<input type="radio" name="empresa" value="silec"></p></a><ul>
									<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
								}else{
									echo '<li><a><p>silec<input checked type="radio" name="empresa" value="silec"></p></a><ul>';
									if($tecnologia != "cobre"){
										echo '';
									}else{
										echo '<li><a><p>cobre<input checked type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
									}
									if($tecnologia != "fttc"){
										echo '';
									}else{
										echo '<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input checked type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
									}
									if($tecnologia != "ftth"){
										echo '';
									}else{
										echo '<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input checked type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
									}
												
								}
							}else{
								echo "";
							}
					?>

						</li>

						</ul>

						</ul>
					</div>
			
			
					
			<h2>Asunto</h2>
			<textarea class="asunto" name="affair" value="<?php echo $affair; ?>" rows="2"><?php echo $affair; ?></textarea><br><br>

			<h2>Descripcion</h2>
			<textarea class="descripcion"name="description" value="<?php echo $description; ?>" rows="15"><?php echo $description; ?></textarea><br><br>
			
			<h2>Subir archivo</h2>
			<label class="custom-file-upload">
				<input type="file"  name="archivo"/>
				
				<?php
					if($file != ""){
						echo "<p>Seleccionar archivo diferente a '".$file."'</p>";
					}else{
						echo "<p>Seleccionar archivo</p>";
					}
				?>
    			
			</label>
			
			
			<br><br>
			<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
			<input type="hidden" name="ticketName" value="<?php echo $ticketName;?>">
			
			<input type="hidden" name="username" value="<?php echo $username;?>">
			<input type="hidden" name="state" value="<?php echo $state;?>">
			<input type="hidden" name="file2" value="<?php echo $file;?>">
			<input type="submit" class="accion"name="update" value="Enviar"/><br>	
		</form>
		
</div>
<?php include "../Elements/sidebar.php"; ?>

<?php include "../Elements/rol.php"; ?>
</div>
	
		
</body>
</html>