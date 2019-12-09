<?php 
session_start();

//~--------------------------------------------------------------------
//~ Variables de Session / POST /GET
//~--------------------------------------------------------------------
$nomClientSession = $_SESSION['emailClientSession'];

//~--------------------------------------------------------------------
//~ Connexion to DataBase
//~--------------------------------------------------------------------
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$myDataBase = 'OnlineStoreProject';


$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

//~--------------------------------------------------------------------
//~ Regarde les var saisis dans Client.php
//~--------------------------------------------------------------------
if (isset($_POST['marqueProduit']) || isset($_POST['Form-TypeProduit']))  {
	
	$catégorieProduit = $_POST['Form-TypeProduit'];
	$marqueProduit = $_POST['marqueProduit'];
}


if($connect){

	//~--------------------------------------------------------------------
	//~ On regarde si un produit existe avec ces caractéristiques 
	//~--------------------------------------------------------------------
	$requeteProduitExiste = "SELECT  Référence, Catégorie,Marque,Prix,Description,Image FROM Recherche_Produit WHERE Marque='$marqueProduit'  AND Catégorie='$catégorieProduit' ";
	$resultatRequeteRecup = mysqli_prepare($connect,$requeteProduitExiste);//liaison des paramètres
		$varRequeteRecup = mysqli_stmt_execute($resultatRequeteRecup);

		if($varRequeteRecup == false){
			echo "erreur requete";
		}else{

			$varRequeteRecup = mysqli_stmt_bind_result($resultatRequeteRecup,$Référence,$Catégorie,$Marque,$Prix,$Description, $Image);

				



	
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>SPI - Nos Produits </title>

		<!-- Scripts  Boostrap-->
		<!-- Scripts  -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

		<link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

	</head>

	<body>

		<style type="text/css">
			
			footer {
				bottom: 0;
				
				position: absolute;
				right: 0;
				
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

		<!-- Retour au produit -->

		<div class="row">
			<div class="col ml-sm-4 ">
				<div class="returnToPage mb-md-5 ">

					<a style="color:#707070;margin-left:50" href="manager.php">
						<i class="fas fa-arrow-left"></i>
						<span> Retour aux produits</span>

					</a>

				</div>
			</div>
		</div>

		<!-- Résultat de votre recherche -->
		<div class="row">
			<div class="col-md-8 ml-auto mr-auto">
				<div class="row">
					<div class="col">
						<h2>Résultat de votre de recherche </h2>
						
					</div>

				</div>

			</div>
		</div>


		
		<div class="row mt-lg-2">
			<div class="col-lg-10 mb-lg-4 ml-auto mr-auto mt-n0">
				<table class="table table-hover" >
					<thead>
						<tr>	
							<th style="width: 10%" scope="col">Image</th>
							<th style="width: 10%" scope="col">Catégorie</th>
							<th style="width: 10%" scope="col">Marque</th>
							<th style="width: 15%" scope="col">Prix unitaire</th>
							<th style="width: 60%" scope="col">Description</th>
							
						</tr>
					</thead>
					
					<tbody>
						<?php 
			while(mysqli_stmt_fetch($resultatRequeteRecup)){
			
			 ?>
						<tr>


							<td ><img src="<?php echo $Image; ?>" width="100" height="100"></td>
							<td style="width=10%">lorem</td>
							<td ><?php echo $Catégorie; ?></td>
							<td ><?php echo $Prix , " €"; ?></td>
							<td ><?php echo substr($Description, 0, 150); ?></td>
							
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Footer  -->
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


	<?php 
		

			mysqli_stmt_close($resultatRequeteRecup);

			if (empty($Description)) {
				# code...
				header('location:manager.php?noProduct=true');
			}
		
			
		}
}else{
	echo"echec de connexion  ".mysqli_connect_error()."<br/>";
}
?>
