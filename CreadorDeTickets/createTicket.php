<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
    require '../config.php';
		
	if(isset($_SESSION['usuario']))
        if($_SESSION['usuario']['rol'] !="2")
           header("location:../index.php")
        		
?>
<?php

	if(empty($_SESSION['username']))
	header("location:../index.php");
	

	
    
?>
<?php
	
	if(isset($_POST['register'])){

		

		



		$errMsg ='';
		$currentDate= date("d")."/".date("m")."/".date("Y");
		
		if(isset($_POST['tecnologia'])){
			$tecnologia =$_POST['tecnologia'];
		}else{
			$tecnologia =NULL;
		
			$inicialesTec = NUll;
		}
		if(isset($_POST['empresa'])){
			$empresa =$_POST['empresa'];
		}else{
			$empresa =NULL;
			$inicialesEm = NULL;
	
		}
		$description =$_POST['description'];
		$affair =$_POST['affair'];
		$username = $_SESSION['username'];
		$state = "ingresado";

		$id="1001";
		$stmt = $connect->query("SELECT * FROM tickets ORDER BY id DESC LIMIT 0,1");
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			
			if($id>="1001"){
				$id = "1001" + $row['id'];
			}
		
		}
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

		$ticketName= $inicialesEm.$inicialesTec.$id;
		
		$fileName=$_FILES['archivo']['name'];
		
		$fileSaved=$_FILES['archivo']['tmp_name'];
			
		$file=$fileName;

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
		
		
        

		if($tecnologia == '')
			$errMsg = '<div class="errMsg">seleccione una tecnologia</div>';
		if($empresa == '')
			$errMsg = '<div class="errMsg">seleccione una empresa</div>';
		if($affair == '')
			$errMsg ='Agregue un asunto';
		if($description =='')
			$errMsg = 'Agregue una descripcion';


		
		
	
		
		if($errMsg ==''){
			try {
				$stmt = $connect->prepare('INSERT INTO tickets(currentDate, empresa, ticketName, tecnologia, username, affair, description, state, file) VALUE (:currentDate, :empresa,:ticketName, :tecnologia,  :username, :affair, :description, :state, :file)');
				$stmt->execute (array(
					':currentDate' =>$currentDate,
					':empresa' =>$empresa,
					':tecnologia' =>$tecnologia,
					':ticketName' =>$ticketName,
					':affair' =>$affair,
					':description' =>$description,
					':state' => $state,
					':username' => $username,
					':file' => $file
			  
					
					
                ));
				header ('Location: createTicket.php?action=joined');
				exit;
			}
			catch(PDOExcept $e) {
				echo $e->getMessage();
			}
		}
	}
	if(isset($_GET['action'])&& $_GET['action'] == 'joined'){
		$stmt = $connect->query("SELECT * FROM tickets ORDER BY id DESC LIMIT 0,1");
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$ticketName = $row['ticketName'];
			$file = $row['file'];
			if(isset($errMsg)){
				
					
			}else{
				
				if($file == ""){
					$errMsg2 = "sin ningun archivo adjunto";
				}else{
					$errMsg2 = "con el archivo adjunto: ".$file;
				}
				$errMsg = "El ticket ".$ticketName. " ha sido enviado correctamente ".$errMsg2;
			}

			
			
		
		}
		
		}



?>
<html>
<head><title>Crear Ticket</title></head>
<link rel="stylesheet" href="../css/dashboard.css">
<script type="text/javascript" src="../css/javascript.js"></script>
<body >
<div class="contenedor">
<?php include "../Elements/headerCT.php" ; ?>
<div class="contenido">
			<h1>Crea tu ticket</h1>
			<form action='' method="post" enctype="multipart/form-data">
			
				<div class="empresas">
					<ul class="nav">
						<li><a><h2>seleccione sus empresas</h2></a>
							<ul>
						<?php if($_SESSION['etb'] == '') {
							echo '';
						}else {
							echo '  
						<li><a><p>etb<input type="radio" name="empresa" value="etb"></p></a><ul>
						<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
						}
						?>

						<?php if($_SESSION['furel'] == '') {
							echo '';
						}else {
							echo '  
						<li><a><p>furel<input type="radio" name="empresa" value="furel"></p></a><ul>
						<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
						}
						?>

						<?php if($_SESSION['bftel'] == '') {
							echo '';
						}else {
							echo '  
						<li><a ><p>bftel<input type="radio" name="empresa" value="bftel"></p></a><ul>
						<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
						}
						?>
						

						<?php if($_SESSION['intercob'] == '') {
							echo '';
						}else {
							echo '  
						<li><a><p>intercob<input type="radio" name="empresa" value="intercob"></p></a><ul>
						<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
						}
						?>
						
						<?php if($_SESSION['silec'] == '') {
							echo '';
						}else {
							echo '  
						<li><a ><p>silec<input type="radio" name="empresa" value="silec"></p></a><ul>
						<li><a><p>cobre<input type="radio" name="tecnologia" value="cobre"></p><p>fttc<input type="radio" name="tecnologia" value="fttc"></p><p>ftth<input type="radio" name="tecnologia" value="ftth"></p></a></li></ul>';
						}
						?>

						</li>

						</ul>

						</ul>
					</div>
			
			
					
			<h2>Asunto</h2>
			<textarea class="asunto" name="affair" rows="2"></textarea><br><br>

			<h2>Descripcion</h2>
			<textarea class="descripcion"name="description" rows="15"></textarea><br><br>
			
			<h2>Subir archivo</h2>
			<label class="custom-file-upload">
				<input type="file" name="archivo"/>
				<p>seleccionar archivo</p>
    			
			</label>
			
			
			<br><br>

			<input type="submit" class="accion"name="register" value="Enviar"/><br>	
		</form>
		
</div>
<?php include "../Elements/sidebar.php"; ?>
<?php include "../Elements/rol.php"; ?>
</div>
		
		
</body>
</html>