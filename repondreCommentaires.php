<?php session_start();


//~-------------------------------------------------------------
//~ Variables de SESSION
//~-------------------------------------------------------------	


//~-------------------------------------------------------------
//~ Variables de connexion à la DB
//~-------------------------------------------------------------	
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$myDataBase = 'OnlineStoreProject';



if (isset($_POST['idDelete'])) {
		# code...
	$idUserDelete = $_POST["idDelete"];
	$_SESSION['IdUserResponse'] = $idUserDelete;
}


//~-------------------------------------------------------------
//~ Connexion à la DataBase
//~-------------------------------------------------------------		
$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

if($connect){

	//~-------------------------------------------------------------
	//~ Récup prénom de la personne en question
	//~-------------------------------------------------------------
	$requetePrenomClient = "SELECT Prénom,Nom FROM User WHERE Id=$idUserDelete ";		

		$resultatRequeteRecup = mysqli_prepare($connect,$requetePrenomClient);//liaison des paramètres
		$varRequeteRecup = mysqli_stmt_execute($resultatRequeteRecup);

		if($varRequeteRecup == false){
			echo "erreur requete";
		}else{

			$varRequeteRecup = mysqli_stmt_bind_result($resultatRequeteRecup,$PrenomClient, $Nom);

			while(mysqli_stmt_fetch($resultatRequeteRecup)){
				$te =$PrenomClient;
			}
			mysqli_stmt_close($resultatRequeteRecup);

			
		}





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

						<a style="color:#707070;margin-left:50" href="nosClients.php">
							<i class="fas fa-arrow-left"></i>
							<span> Retour aux clients</span>
						</a>
					</div>
				</div>
			</div>

			<!-- Réponse au client -->
			<div class="row">
				<div class="col-md-10 ml-auto  mb-md-4 mr-auto text-center">
					<h3>Votre réponse au Client : <?php echo $te; ?></h3>
				</div>
			</div>

			<form method="post" action="reponseRequest.php" id="confirmationForm">
				<div class="row">
					<div class="col-md-10 ml-auto mr-auto text-center">
						<textarea  form="confirmationForm" id="textComment" name="textComment" style="border-radius:4px; width:75%; height: 274px;" placeholder="Votre commentaire"></textarea>
					
						<input class="btn btn-outline-dark w-50 mb-3" name="subComment" type="submit" value="Send">
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


		<?php 


	}else{
		echo "echec";
	} ?>



