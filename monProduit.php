<?php 	
session_start();

	/*
		CETTE PAGE EST POUR LES CLIENTS
	*/
		$mailDeSession = $_SESSION['emailClientSession'];

		?>


		<!DOCTYPE html>
		<html>
		<head>
			<title>Mon Produit</title>


			<!-- Scripts  -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

			<link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">


		</head>
		<body>

			<!-- Script affichage bloc commentaire -->
			<script>
				function myFunction() {

					var x = document.getElementById("myDIV");

					if (x.style.display === "block") {
						x.style.display = "none";
					} else {
						x.style.display = "block";
					}
				}
			</script>

			<!-- Style du bloc commentaire hide puis afficher -->
			<style>
				#myDIV {
					display: none;
				}
			</style>





			<?php  
			$hostname = 'localhost';
			$username = 'root';
			$password = 'root';
			$myDataBase = 'OnlineStoreProject';


			$ref = $_GET['ref'];
			$_SESSION['ref'] = $ref;




		/*
			Récupération des varaiables des formalaires
		*/			

			$idProduct = 'false';

		/* 
			Connection to DATABASE
		*/	
			$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

			if($connect){
				
				$requeteProduit = "SELECT Référence, Catégorie,Marque,Prix,Description,Quantité,Commentaires_Client FROM Recherche_Produit";
				

				$resultat = mysqli_prepare($connect,$requeteProduit);//liaison des paramètres

				$var = mysqli_stmt_execute($resultat);
				if($var == false){

				}else{
				//lecture des valeurs
					$var = mysqli_stmt_bind_result($resultat,$Référence, $Catégorie,$Marque,$Prix,$Description, $Quantité , $Commentaires_Client);

					while(mysqli_stmt_fetch($resultat)){
						
						//Si ref est bonne, je récup toutes les infos sur mon produit
						if ($ref == $Référence) {
							
							//passe à true pour rester dans la page
							$idProduct = "true";


							$catégorieProduit = $Catégorie;
							$marqueProduit = $Marque;
							$prixProduit = $Prix;
							$descriptionProduit = $Description;
							$quantitéProduit = $Quantité;
							$commentaires_ClientProduit = $Commentaires_Client;

						}
					}

					mysqli_stmt_close($resultat);

					//permet de retourner à la page d'avant avec un message d'erreur
					if($idProduct == 'false'){
						header("location:Client.php?productFail=faux");
					}
				}
			}
			?>


			<!-- Header -->
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Accueil </a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="nav navbar-nav ml-auto">
						<li class=" nav-item">
							<a class="nav-link" href="#">Se Déconnecter</a>															
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Mon Panier </a>
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
					<div class="returnToPage mb-md-5 ">

						<a style="color:#707070;margin-left:50" href="Client.php">
							<i class="fas fa-arrow-left"></i>
							<span> Retour aux produits</span></a>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 ml-auto mr-auto">
						<?php 

						if(isset($_GET['commentAdded'])) {
							if ($_GET['commentAdded'] == 'added') {

								echo "<div class=\"alert alert-success text-center\" role=\"alert\">
								Votre <strong>Commentaire</strong> à bien été transmis</div>";
							}
						}
						?>
					</div>
					
				</div>



<!--
							Bloc image et description/caractéristiques du produit

						-->
						<div class="row">
							<div class="col-md-10 ml-auto mr-auto">
								
								<div class="row">
									<div class="col-md-6">
										<div class="row ">
											<img class="ml-auto mr-auto" src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/mbp13touch-space-select-201807?wid=892&hei=820&&qlt=80&.v=1529520060550" width="500" height="500">
										</div>	

										

									</div>

									<div class="col">

										<div class="row">
											<h2 class="display-4">Description</h2>
											<hr>
											<p style="word-spacing: 5px;" class="mb-lg-5">
												<?php echo $descriptionProduit; ?>
											</p>
										</div>

										
										<!-- Table de caractéristiques produit -->
										<div class="row">
											<table  style="border-top: none;" class="table table-no-border">
												<tbody>
													<tr>
														<th scope="row">Catégorie</th>
														<td><?php echo $catégorieProduit; ?></td>	
													</tr>
													<tr>
														<th scope="row">Marque</th>
														<td><?php echo $marqueProduit; ?></td>	
													</tr>
													<tr>
														<th scope="row">Prix</th>
														<td><?php echo $prixProduit ," €"; ?></td>	
													</tr>
													<tr>
														<th scope="row">Stock</th>
														<td><?php echo $quantitéProduit; ?></td>	
													</tr>
												</tbody>
											</table>

											<div class="col mr-auto mb-2 d-flex flex-row-reverse">
												<a  class="btn btn-outline-dark" href="#" class=" active" id="client-link" >Ajouter au panier</a>
											</div>
										</div>

									</div>
								</div>

							</div>
						</div>



						<!-- AJOUTER UN COMMENTAIRE -->
						<div class="row">
							<div class="col-md-10 mr-auto ml-auto comment">
								<hr>
								<div class="d-flex flex-row-reverse">
									<a onclick="myFunction()" class="ml-auto" style="color:#707070" href="#myDIV"><span> Ajouter un commentaire</span></a>
									<br><br>
								</div>
								<!-- Div pour afficher commenter  -->
								<div class="row">
									<div class="col-md-10 ml-auto mr-auto">
										<div id="myDIV">
											<div class="form-group">
												<form action="reg.php" method="post">
													<label for="exampleTextarea">Votre Commentaire :</label>
													<textarea class="form-control" name="commentArea" id="exampleTextarea" placeholder="maximum de 1000 caractères"></textarea>


													<!-- Submit le commentaire -->

													<div class="row">
														<div class="col-md-2 mt-lg-3 ml-auto mr-auto">

															<button class="btn btn-outline-dark btn-lg btn-block btn-sm" type="submit">
																Submit
															</button>

														</div>
													</div>	
												</form>		
											</div>								
										</div>
									</div>		
								</div>	
							</div>
						</div>


						
		</body>
		</html>