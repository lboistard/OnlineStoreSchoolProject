<?php 
session_start();

	//~--------------------------------------------------------------------
	//~ Variables de Session / POST /GET
	//~--------------------------------------------------------------------
$Nom = $_SESSION['nomClientSession'];
$Prénom = $_SESSION['prenomClientSession'];
$Id = $_SESSION['idClientSession'];
?>

<!DOCTYPE html>
<html>
<head>	
	<meta charset="utf-8">


	<!-- Scripts  Boostrap-->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">



	<title>Manager</title>
</head>
<body>


	<!-- Style -->
	<style type="text/css">
		footer {
			margin-top: 100px;
			position: relative;
			right: 0;
			bottom: 0;
			left: 0;
			padding: 1rem;
			color: white;
			background-color: #606060;
			text-align: center;
		}
	</style>

	<!-- Header -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Accueil </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="nav navbar-nav ml-auto">
				<li class=" nav-item">
					<a class="nav-link" href="deconnect.php">Se Déconnecter</a>															
				</li>

			</ul>
		</div>
	</nav>

	<div class="row">
		<div class="col ml-sm-4 ">
			<div class="returnToPage mb-md-5 ">

				<a style="color:#707070;margin-left:50" href="Client.php">
					<i class="fas fa-arrow-left"></i>
					<span> Retour aux produits</span></a>
				</div>
			</div>
		</div>

		<!-- Réponse au client -->
		<div class="row">
			<div class="col-md-10 ml-auto  mb-md-2 mr-auto text-center">
				<h3>Veuillez saisir votre commentaire </h3>

			</div>
		</div>

		<div class="row">
			<div class="col-md-5 ml-auto  mb-md-2 mr-auto text-center">
				<?php 
				//~--------------------------------------------------------------------
				//~ Message d'erreur si aucun commentaire n'est saisis
				//~--------------------------------------------------------------------
				if(isset($_GET['noComment'])) {
					if ($_GET['noComment'] == 'true') {
						echo "<!-- Warning Alert -->
						<div class=\"alert alert-warning alert-dismissible fade show\">
						Veuillez <strong>saisir</strong> un commentaire !<button  type=\"button\" class=\"close \" aria-label=\"Close\" data-dismiss=\"alert\"></button>
						</div>";
					}
				}

				//~--------------------------------------------------------------------
				//~ Message d'erreur si le nom/prénom n'est pas ok avec IDSESSION
				//~--------------------------------------------------------------------
				if(isset($_GET['fauxUser'])) {
					if ($_GET['fauxUser'] == 'true') {
						echo "<!-- Warning Alert -->
						<div class=\"alert alert-danger alert-dismissible fade show\">
						Vos <strong>coordonnées </strong>sembles fausses <button  type=\"button\" class=\"close \" aria-label=\"Close\" data-dismiss=\"alert\"></button>
						</div>";
					}
				}


				//~--------------------------------------------------------------------
				//~ Message d'erreur si le nom/prénom n'est pas ok avec IDSESSION
				//~--------------------------------------------------------------------
				if(isset($_GET['commentAdded'])) {
					if ($_GET['commentAdded'] == 'true') {
						echo "<!-- Warning Alert -->
						<div class=\"alert alert-success alert-dismissible fade show\">
						Votre <strong>Commentaires </strong>à été transmis<button  type=\"button\" class=\"close \" aria-label=\"Close\" data-dismiss=\"alert\"></button>
						</div>";
					}
				}
				?>

				
			</div>
		</div>

		<div class="row">
			<div class="col col-md-5 mx-auto" >
				<hr>
			</div>
		</div>


		<form method="post" role="from" action="traitementCommentairesUser.php" id="confirmationForm">
			<div class="row">
				<div class="col-md-4 ml-auto mr-auto mt-md-4 mb-md-3">

					<input type="text" name="prénomClient" class="form-control" placeholder="Prénom">
				</div>

			</div>
			<div class="row">
				<div class="col-md-4 ml-auto mr-auto mb-md-3" >

					<input type="text" name="nomClient" class="form-control" placeholder="Nom">
				</div>

			</div>
			<div class="row mt-md-3">
				<div class="col-md-8 ml-auto mr-auto text-center">


					<textarea  form="confirmationForm" id="textComment" name="textComment" style="border-radius:4px; width:75%; height: 274px;" placeholder="Votre commentaire"></textarea>

					<input class="btn btn-outline-dark w-50 mt-md-4" name="subComment" type="submit" value="Send">
				</div>
			</div>

		</form>



		<!-- Footer / lien vers réseaux sociaux -->
		<footer>
			N'hésitez pas à rejoindre nos réseaux sociaux !
			<div class="row footer">
				<div class="col-md-3 mt-auto ml-auto mr-auto">
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

