<?php 

	//~-------------------------------------------------------------
	//~ Ceci est la page d'accueil
	//~-------------------------------------------------------------
	
	//on destroy la session potentiel
	session_destroy();

	//on restart la session
	session_start();

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>SPI - Scanner, Imprimantes & PC</title>
	<meta charset="utf-8">
	
	<!-- Script Bootstrap 4 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<!-- Lien font awesome-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>

	<!-- Style pour la page -->
	<style type="text/css">
		.container{
			margin-top: 5%;
		}

		#logo{

			width: 80%;
		}

		.btn-primary.outline:hover, .btn-primary.outline:focus, .btn-primary.outline:active, .btn-primary.outline.active, .open > .dropdown-toggle.btn-primary{
			color: #33a6cc;
			border-color: #33a6cc;
		}
		.btn-primary.outline:active, .btn-primary.outline.active {
			border-color: #007299;
			color: #007299;
			box-shadow: none;
		}


		footer {
			margin-top: 100px;
			position: absolute;
			right: 0;
			bottom: 0;
			left: 0;
			padding: 1rem;
			color: white;
			background-color: #606060;
			text-align: center;
		}
	</style>


	<main class="bd-masthead" id="content" role="main">
		<div class="container">
			<div class="row align-items-center">

				<!-- Image -->
				<div class="col-6 mx-auto col-md-6 order-md-2">
					<img id="logo" src="Images/SPI.png">
				</div>
				

				<!-- Description de l'entreprise -->
				<div class="col-md-6 order-md-1 text-center text-md-left pr-md-5">
					<h1 class="mb-3 bd-text-purple-bright">Scanner Pc Imprimantes</h1>
					<h5 class="mb-5">Besoin d’un ordinateur portable ? D’un scanner ? D’une imprimante ?</h5>
					<p class="lead mb-4">
						Nos équipes sont là pour vous conseiller et vous proposer les produits les plus adaptés à  vos  besoins.  Vous  trouverez  sur  ce  site  plus  de  300  produits  pour  satisfaire  vos envies. Cliquez, comparez et ajoutez vos produits préférés au panier ! On s’occupe de la livraison pour vous ! Si vous avez besoin d’aide, n’hésitez pas à nous contacter via le formulaire de contact.
					</p>

					<!-- Lien vers login et création de compte -->
					<div class="row mx-n2">
						<div class="col-md px-2">
							<a href="createAccount.php" class="btn btn btn-outline-dark w-100 mb-3">Créer un compte</a>
						</div>
						<div class="col-md px-2">
							<a href="login.php" class="btn btn btn-outline-dark w-100 mb-3">Se connecter</a>
						</div>						
					</div>

				</div>				
			</div>			
		</div>
	</main>


	<!-- Footer / lien vers réseaux sociaux fictif -->
	<footer>
		N'hésitez pas à rejoindre nos réseaux sociaux !
		<div class="row footer">
			<div class="col-md-3 ml-auto mr-auto">
				<div class="row">
							<a class="col-md mx-auto pt-md-2" href="" style="color: #CCC;"><i class="fab fa-facebook fa-2x"></i></a>
			<a class="col-md mx-auto pt-md-2" href="" style="color: #CCC;"><i class="fab fa-twitter fa-2x"></i></a>
			<a class="col-md mx-auto pt-md-2" href="" style="color: #CCC;"><i class="fab fa-linkedin fa-2x"></i></a>
			<a class="col-md mx-auto pt-md-2" href="" style="color: #CCC;"><i class="fab fa-instagram fa-2x"></i></a>
				</div>
			</div>
	
			
			
		</div>
	</footer>
</body>
</html>