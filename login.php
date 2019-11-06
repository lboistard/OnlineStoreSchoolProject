<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- Supprimer le <meta> ci dessous pour enelver l'auto refresh de la page -->
	<meta http-equiv="refresh" content="1"/>
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta charset="utf-8">
</head>
<body>
	
	<!--section de choix Client ou Manager>-->
	<section id="choose">
		<div >
			<input type="radio" id="clientButton" name="select" value="1" checked>
			<label for="clientButton">
	    		<h2>Client</h2>
	  		</label>
		</div>

		<div>
			<input type="radio" id="managerButton" name="select" value="2">
			<label for="managerButton">
	    		<h2>Manager</h2>
	  		</label>
		</div>
	</section>
	
<section id="rest">

	<!--Formulaire qui permet de se connecter-->
	<div id="formulaire">
		<form action="" method="get" class="form-example">
			
			<div class="form-example">
				<input type="email" name="email" id="email" required placeholder="email">
			</div>
			
			<div class="form-example">	
				<input type="password" name="password" id="password" required placeholder="password">
			</div>
		
			
			<button>Log In</button>
	
		</form>


	</div>
</section>
	<!--Lien vers la page Create Account-->
	<a href="">déjà inscrit ? :: transferer dans la page create account</a>
	
</body>
</html>