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
				
				$requeteProduit = "SELECT Catégorie,Marque,Prix,Description,Quantité,Image,Commentaires_Client FROM Recherche_Produit WHERE Référence=$ref";
				

				$resultat = mysqli_prepare($connect,$requeteProduit);//liaison des paramètres

				$var = mysqli_stmt_execute($resultat);
				if($var == false){

				}else{
				//lecture des valeurs
					$var = mysqli_stmt_bind_result($resultat, $Catégorie,$Marque,$Prix,$Description, $Quantité ,$Image ,$Commentaires_Client);

					while(mysqli_stmt_fetch($resultat)){
						
						//Si ref est bonne, je récup toutes les infos sur mon produit


							//passe à true pour rester dans la page
						$idProduct = "true";


						$catégorieProduit = $Catégorie;
						$marqueProduit = $Marque;
						$prixProduit = $Prix;
						$descriptionProduit = $Description;
						$quantitéProduit = $Quantité;
						$commentaires_ClientProduit = $Commentaires_Client;

						
					}

					mysqli_stmt_close($resultat);



					/*
						requete pour modifier produit
					*/	
					$requeteModifProduit = "SELECT Prix, TVA , Quantité, Description  FROM Recherche_Produit WHERE Référence=$ref";		

					$resultatRequeteModifProduit = mysqli_prepare($connect,$requeteModifProduit);//liaison des paramètres
					$varRequeteModifProduit = mysqli_stmt_execute($resultatRequeteModifProduit);

					if($varRequeteModifProduit == false){
						echo "erreur requete";
					}else{

						$varRequeteModifProduit = mysqli_stmt_bind_result($resultatRequeteRecup, $Prix, $tva, $Quantité,$Description);

						

						mysqli_stmt_close($resultatRequeteRecup);
					
						
					}

					//permet de retourner à la page d'avant avec un message d'erreur
					if($idProduct == 'false'){
						header("location:Client.php?productFail=faux");
					}
				}
			}
			?>


					<!-- Style du bloc commentaire hide puis afficher -->
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

			<!-- Retour au produit -->
			<div class="row">
				<div class="col ml-sm-4 ">
					<div class="returnToPage mb-md-5 ">

						<a style="color:#707070;margin-left:50" href="manager.php">
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
											<img class="ml-auto mr-auto" src="<?php echo $Image; ?>" width="500" height="500">
										</div>	

										

									</div>

									<div class="col">

										<div class="row">
											<h2 class="col-md-6 display-4">Description</h2>
											<hr>
											<p style="word-spacing: 5px;" class="col-md-12 mb-lg-5">
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

										</div>
										<!-- Commander POP UP -->
											<div class="row">
												<div class="col-md-8 mr-auto mb-2 d-flex ml-auto flex-row-reverse">
												<button  class="btn btn-outline-dark" href="#" class="active" id="client-link" data-toggle="modal" data-target="#exampleModalModif">Modifier cet article</button>
											</div>
											<div class="col mr-auto mb-2 d-flex flex-row-reverse">
												<button  class="btn btn-outline-dark" href="#" class="active" id="client-link" data-toggle="modal" data-target="#exampleModalLong">Supprimer article</button>
											</div>
											</div>

											<!-- POP UP appear -->
											<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
												<div class="modal-dialog mx-auto" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLongTitle">Êtes-vous sûre <strong>supprimer</strong> cet article</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>											      

														<div class="modal-footer ">

															<a href="supprimerArticle.php" class="btn btn-light">Oui</a>
															<button href=""  class="btn btn-dark">Non</button>

														</div>
													</div>
												</div>
											</div>

											<!-- POP UP Modif -->
											<div class="modal fade" id="exampleModalModif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
												<div class="modal-dialog mx-auto" role="document">
													<div class="modal-content">
														<!--Body-->
														<form class="form" action="modifArticle.php" role="form" method="POST">
															<div class="modal-body mx-5">				
																<div class="md-form pb-3">
																	<label for="Form-nouveauPrix">Prix :</label>
																	<input type="number" id="Form-nouveauPrix" name="Form-nouveauPrix" class="form-control validate" placeholder="<?php echo "$Prix" , " €"; ?>" required>

																</div>

																<div class="md-form pb-3">
																	<label for="Form-nouveauTVA">TVA : </label>
																	<input type="number" name="Form-nouveauTVA" id="Form-nouveauTVA" class="form-control validate"  placeholder="20 %" required >				          				          
																</div>

																<div class="md-form pb-3">
																	<label for="Form-nexQuantité">Stock: </label>
																	<input  type="number" name="Form-nexQuantité" id="Form-nexQuantité" class="form-control validate"  placeholder="<?php echo $Quantité ; ?>" required>				          				          
																</div>
																<div class="md-form pb-5">
																	<label for="Form-newDescription">Description : </label>
																	<textarea type="text" name="Form-newDescription" id="Form-newDescription" class="form-control validate"  placeholder="<?php echo substr($Description, 0,25) , "..."; ?>" required></textarea>			          				          
																</div>

																<div class="text-center mb-3">
																	<button type="submit" class="btn btn-outline-dark">Modifiez les informations</button>
																</div>
															</div>
														</form>					

													</div>
												</div>
											</div>

									</div>
								</div>

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