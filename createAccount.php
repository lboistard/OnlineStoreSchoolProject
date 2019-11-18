<?php 
	session_start();



 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Create Account</title>
	<!-- Supprimer le <meta> ci dessous pour enelver l'auto refresh de la page -->
	
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta charset="utf-8">
</head>
<body>
	

	<!-- Choix manager ou Client-->
		<input type="radio" name="toggle" id="signup" checked><input type="radio" name="toggle" id="login">
		<label for="signup">Client</label>
		<label for="login">Manager</label>



		<!-- Client Part --> 

		<div id="clientFields">	
			
			<form method="POST" action="client.php?createAccount=1" name="formulaireClient">
				<label for="nom">Nom</label>
				<input type="text" id="nomClient" name="nomClient" required>
				<label for="prenom">Prénom</label>
				<input type="text" id="prenomClient" name="prenomClient" required>
				<label for="email">Email</label>
				<input type="email" id="emailClient" maxlength="50" name="emailClient"  required />
				<label for="password">
					Password <span id="passNote">(8 characters)</span>
				</label>
				<input type="password" id="password"  name="passwordClient" maxlength="26" required />	

				<label for="telephoneClient">Téléphone</label>
				<input type="tel" name="telephoneClient"  pattern="0[1-0].[0-9]{3}.[0-9]{2}.[0-9]{2}.[0-9]{2}">
				<label for="adresseClient">Adresse</label>
				<input type="text" name="adresseClient" maxlength="255" required>
				<label for="codePostalClient">Code Postal</label>
				<input type="number" maxlength="5" name="codePostalClient">

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
				<input type="submit" value="Log in"/>

			</form>
			
		</div>	
		<a href="createAccount.php">déjà inscrit ?</a>
	
</body>
</html>