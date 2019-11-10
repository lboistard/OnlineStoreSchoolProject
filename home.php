<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="home.css">

	<!--  <meta http-equiv=”refresh” content="5" /> -->

</head>
<body>
	
	<div id="container">

		<!-- cote gauche de l'ecran d'accueil -->
		<div id="content">

			<!--
				Ajout de la description de l'entreprise dans la balise <p>
			-->
			<div class="presentation">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>

			<!--
				Button de log vers les autres pages
			-->
			<div class="login">
				

				<div id="createAccount">
					<a href="createAccount.php">
						<button class="button createAccountButton">Create Account</button>
					</a>
					
				</div>
				

				<div id="login">
					<a href="login.php">
						<button class="button loginButton">Log In</button>
					</a>
				</div>
				
			</div>
		</div>
		
		<!-- cote droit de l'ecran d'accueil -->
		<div id="right">
			<img id="imageBackground" src="Images/Home Background Image.png">
		</div>
		
		
	</div>

</body>
</html>