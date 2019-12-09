<?php 
session_start();

	//~--------------------------------------------------------------------
	//~	Déclaration des Variables 
	//~--------------------------------------------------------------------
$ref = $_GET['ref'];
$Id = $_SESSION['idClientSession'];

	//~--------------------------------------------------------------------
	//~ Connexion to DataBase
	//~--------------------------------------------------------------------
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$myDataBase = 'OnlineStoreProject';


$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

if($connect){	

		//~--------------------------------------------------------------------
		//~ Récup des élements de Panier dans la table User
		//~--------------------------------------------------------------------
	$requeteRecupPanier = "SELECT Panier From User WHERE Id = $Id";
		$resultatRecupPanier = mysqli_prepare($connect,$requeteRecupPanier);//liaison des paramètres

		$var = mysqli_stmt_execute($resultatRecupPanier);
		if($var == false){
			echo "echec en requete";
		}else{				
			$var = mysqli_stmt_bind_result($resultatRecupPanier, $Panier);					
			while(mysqli_stmt_fetch($resultatRecupPanier)){			
				$panAvantAjout =  $Panier;						
			}
			
			mysqli_stmt_close($resultatRecupPanier);
		}	

		if ($panAvantAjout == "empty") {
			# code...
			header("location:Client.php?emptyBucket=true");
		}


		
		
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
						<li class="nav-item">
							<a class="nav-link" href="monPanier.php">Mon Panier </a>
						</li>
						<li class=" nav-item">
							<a class="nav-link" href="espaceClient.php">Mon Compte</a>
						</li>
					</ul>
				</div>
			</nav>
			<!-- Retour au produit -->

			<div class="row">
				<div class="col ml-sm-4 ">
					<div class="returnToPage mb-md-2 ">

						<a style="color:#707070;margin-left:50" href="Client.php">
							<i class="fas fa-arrow-left"></i>
							<span> Retour aux produits</span>

						</a>

					</div>
				</div>
			</div>

			<!-- Header -->
			<div class="row mt-sm-1">
				<div class="col-md-8 ml-auto mr-auto">
					<div class="row">
						<div class="col">
							<h1>Votre Panier</h1>
						</div>
					</div>
				</div>
			</div>


			<!-- Affichage des élements dans le panier -->

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

						<?php 
									//~--------------------------------------------------------------------
									//~ Affiche chaque élements en fonction du panier
									//~------------------------------------------------------------------

									//on substr le panier tous les 3 chiffres
						$nbrProduct = strlen($panAvantAjout) / 3;
						$myVar = str_split($panAvantAjout, 3); 

						for ($i=0; $i < $nbrProduct; $i++) { 


										//echo $myVar[$i]  ,'<br>';




							$requeteRecupPanier = "SELECT Image, Catégorie, Marque,Prix, Description From Recherche_Produit WHERE Référence = $myVar[$i]";
									$resultatRecupPanier = mysqli_prepare($connect,$requeteRecupPanier);//liaison des paramètres

									$var = mysqli_stmt_execute($resultatRecupPanier);
									if($var == false){
										echo "echec en requete";
									}else{				
										$var = mysqli_stmt_bind_result($resultatRecupPanier,$Image, $Catégorie, $Marque, $Prix, $Description);					
										while(mysqli_stmt_fetch($resultatRecupPanier)){			
											$panCatégorie =  $Catégorie;

										}
										
										mysqli_stmt_close($resultatRecupPanier);						
										
										?>

										<tbody>
											<tr>							
												<td style="width=10%"><img src="<?php echo $Image; ?>" width="100" height="100"></td>
												<td><?php echo $panCatégorie; ?></td>
												
												<td ><?php echo $Marque; ?></td>
												<td ><?php echo $Prix , " €"; ?></td>
												<td ><?php echo substr($Description, 0,220), "...";?></td>
												

											<?php 
											//fermeture des boucles while etc else
												}
											}	

											?>

										

									</tr>
								</tbody>
							</table>
						</div>
					</div>

					


					<!-- Commander POP UP -->
					<div class="col-md-2 mr-auto ml-auto">
						<button  class="btn btn-outline-dark" href="#" class="active" id="client-link" data-toggle="modal" data-target="#exampleModalLong">Acheter ces produits</button>
					</div>
					<!-- POP UP appear -->
					<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
						<div class="modal-dialog mx-auto" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Êtes-vous sûre d'acheter cet article</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>											      
								<div class="modal-footer ">
									
									<a href="commander.php?maCommande=<?php echo $panAvantAjout; ?>" class="btn btn-light">Oui</a>
									<button href=""  class="btn btn-dark">Non</button>
								</div>
							</div>
						</div>
					</div>


				</body>
				</html>


				<?php 	
			}else{

			}	

			?>