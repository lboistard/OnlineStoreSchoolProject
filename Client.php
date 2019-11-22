<?php 
session_start();

		//utiliser session pour récuperer les var de session (genre nom client ici)
		$nomClientSession = $_SESSION['emailClientSession'];	

		/*
			CETTE PAGE EST POUR LES CLIENTS
		*/
			$hostname = 'localhost';
			$username = 'root';
			$password = 'root';
			$myDataBase = 'OnlineStoreProject';

		/*
			Récupération des varaiables des formalaires
		*/			
			$accountGet = $_GET['createAccount'];			
			$cookies = 'empty';
			$Type = 'Client';
			$mailExist ='false';
			$passwordExist = 'false';


		/* 
			Connection to DATABASE
		*/	
			$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

			if($connect){
				$requete = "SELECT Référence, Catégorie,Marque,Prix,Description FROM Recherche_Produit";
			$resultat = mysqli_prepare($connect,$requete);//liaison des paramètres

			$var = mysqli_stmt_execute($resultat);
			if($var == false){

			}else{
				//lecture des valeurs
				$var = mysqli_stmt_bind_result($resultat,$Référence, $Catégorie,$Marque,$Prix,$Description);
				?>

				<!DOCTYPE html>
				<html>
				<head>
					<title>SPI - Nos Produits </title>

					<!-- Scripts  -->
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
				</head>
				<body>
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
							
							<a class="nav-link" href="index.php">Home</a>
							
							<div class="collapse navbar-collapse" id="navbarNav">
								<ul class="nav navbar-nav ml-auto">
									<li class="nav-item">
										<a class="nav-link" href="#">Mon Panier</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#">Mon Compte</a>
									</li>
								</ul>
							</div>
						</nav>



					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">


							<div class="row">
								<div class="col">
									<h1>Liste des produits</h1>
								</div>
								<div class="col">
									<form class="form-inline my-2 flex-row-reverse ">

										<button class="btn btn-outline-success my-2" type="submit">Rechercher</button>
										<input class="form-control mr-sm-4" type="search" placeholder="Rechercher un produit" aria-label="Search">
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<hr>
					</div>
					<div class="row">
						<div class="col-md-6 text-center ml-auto mr-auto">

							<?php 
			/*
				Error message quand le user n'est pas dans la database
			*/
				if(isset($_GET['productFail'])) {
					if ($_GET['productFail'] == 'faux') {
						echo "<!-- Warning Alert -->
						<div class=\"alert alert-danger alert-dismissible fade show\">
						Veuillez ne pas mettre de la  <strong>merde</strong> dans l'url svp
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\"></button>
						</div>";
					}
				}
				?>
			</div>
		</div>
		<div class="row mt-lg-2">
			<div class="col-lg-10 mb-lg-4 ml-auto mr-auto mt-n0">
				<table class="table table-hover">
					<thead>
						<tr>	
							<th style="width: 10%" scope="col">Image</th>
							<th style="width: 10%" scope="col">Catégorie</th>
							<th style="width: 10%" scope="col">Marque</th>
							<th style="width: 15%" scope="col">Prix unitaire</th>
							<th style="width: 40%" scope="col">Description</th>
							<th style="width: 15%" scope="col">Ajouter au Panier</th>
						</tr>
					</thead>
					<tbody>
						<?php 

										/*
											remplissage du <table> avec les éléments de la BDD
										*/

											while(mysqli_stmt_fetch($resultat)){
												?>
												<tr>

													<td >
														
														<a href="monProduit.php?ref=<?php echo $Référence?>">

															<img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/mbp13touch-space-select-201807?wid=892&hei=820&&qlt=80&.v=1529520060550" width="100" height="100">
														</a>
														
														
													</td>
													<td style="width=10%"><?php echo $Catégorie; ?></td>
													<td ><?php echo $Marque; ?></td>
													<td ><?php echo $Prix ," €"; ?></td>
													<td ><?php 

													$rest = substr($Description, 0, 155);

													echo $rest ,"...";
													?>

												</td>
												<td><a  class="text-center" href="#">Ajouter à mon panier</a></td>

											</tr>


											<?php 
										}

										mysqli_stmt_close($resultat);
									}
								}else{
									echo"echec de connexion  ".mysqli_connect_error()."<br/>";
								}
								?>


							</tbody>
						</table>
					</div>




				</div>
				<footer id="sticky-footer" class="py-4 bg-dark text-white-50">
					<div class="container text-center">
						<small>Venez nous suivre sur nos réseaux !</small>
					</div>
				</footer>
			</div>
		</footer>
	</body>
	</html>
