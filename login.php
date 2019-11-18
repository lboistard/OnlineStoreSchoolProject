<?php 
session_start(); 

	//Variables
$ClientMail = $_POST['emailClient'];
$ClientPassword = $_POST['passwordClient'];
$ManagerMail = $_POST['emailManager'];
$ManagerPassword = $_POST['passwordManager'];
$category = "";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
	<link rel="stylesheet" type="text/css" href="login.css">	
</head>
<body>





	<?php 
			/*
				Error message quand le user n'est pas dans la database
			*/
			if(isset($_GET['errorMessage'])) {
				if ($_GET['errorMessage'] == 'faux') {
					echo "<p style='color:red'>Adresse Mail ou Mot de Passe incorrect</p>", $compteur;
					
				}
			}

	?>
	<!-- 
			Bloc html pour le formulaire de login
	
	-->
	<div id="mainBlock">

		<!-- Choix manager ou Client-->
		<input type="radio" name="toggle" id="signup" checked><input type="radio" name="toggle" id="login">
		<label for="signup">Client</label>
		<label for="login">Manager</label>

		<!-- ADD this to input pattern="^([a-z0-9_\.-]{3,32})@([a-z0-9_\.-]{2, 12})\.([a-z\.]{2,6})$"-->
		
		
		
		<!-- Client Part --> 

		<div id="clientFields">	
			<form method="POST" action="client.php?createAccount=0" name="formulaireClient">
				<label for="email">Email</label>
				<input type="email" id="emailClient" maxlength="50" name="emailClient"  required />
				<label for="password">
					Password <span id="passNote">(8 characters)</span>
				</label>
				<input type="password" id="password"  name="passwordClient" maxlength="26" required />			
				<input type="submit" value="Log In"/>
			</form>		
			
		</div>
		


		<!-- Manager Part --> 
		<div id="managerFields">
			<form method="POST" action="manager.php" name="formulaireManager">
				<label for="loginperson">Email</label>
				<input type="email" id="emailManager" maxlength="50" />
				
				<label for="loginpassword">Password 
					<span id="passNote">(8 characters)</span>
				</label>
				
				<input type="password" id="loginpassword" maxlength="26" />
				<input type="submit" value="Log In"/>

			</form>
			
		</div>	<a href="createAccount.php">Create an account ?</a>
	</div>

</body>
</html>