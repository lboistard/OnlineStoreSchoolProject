<?php 
session_start();

$hostname = 'localhost';
$username = 'root';
$password = 'root';
$myDataBase = 'OnlineStoreProject';

$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

if($connect){


	
	$requete = "SELECT Id, Nom,Prénom, Adresse_Mail ,Adresse_Client, Code_Postal,Type, Commentaires_Produit FROM User";
			$resultat = mysqli_prepare($connect,$requete);//liaison des paramètres

			$var = mysqli_stmt_execute($resultat);
			if($var == false){

			}else{
				//lecture des valeurs
				$var = mysqli_stmt_bind_result($resultat, $Id ,$Nom,$Prénom,$Adresse_Mail,$Adresse_Client, $Code_Postal , $Type, $Commentaires_Produit);

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
								<a style="color:#707070;margin-left:50" href="manager.php">
									<i class="fas fa-arrow-left"></i>
									<span> Retour aux produits</span></a>
								</div>
							</div>
						</div>

						<!-- Liste des Client -->
						<div class="row">
							<div class="col-md-8 ml-auto mr-auto">
								<div class="row">
									<div class="col">
										<h1>Liste des Clients</h1>
									</div>			
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4 mr-auto ml-auto">
								<?php
									if (isset($_GET['comSuppr'])){
										if ($_GET['comSuppr'] =='true') {
											echo "<div class=\"alert alert-success text-center\" role=\"alert\">
											<strong>Commentaire</strong> supprimer</div>"; 
										}
									}

									if (isset($_GET['repMana'])){
										if ($_GET['repMana'] =='true') {
											echo "<div class=\"alert alert-success text-center\" role=\"alert\">
											Votre <strong>réponse</strong> a été transmise</div>"; 
										}
									}

						 ?>
							</div>
						</div>
						

						<!-- Liste des Client -->
						<div class="row mt-lg-2">
							<div class="col-lg-10 mb-lg-4 ml-auto mr-auto">
								<table class="table table-hover">
									<thead>
										<tr>	
											<th style="width: 10%" scope="col">Nom</th>
											<th style="width: 10%" scope="col">Prénom</th>
											<th style="width: 10%" scope="col">Adresse Mail</th>
											<th style="width: 15%" scope="col">Adresse</th>
											<th style="width: 7%" scope="col">Code Postal</th>
											<th style="width: 45%" scope="col">Commentaires Client</th>
											<th style="width: 22%" scope="col">Action</th>
											
										</tr>
									</thead>
									<tbody>

										<?php 
										while(mysqli_stmt_fetch($resultat)){
											if ($Type == 'Client') {
							# code...
												
												?>
												<tr>									
													<td><?php echo $Nom; ?></td>
													<td ><?php echo $Prénom; ?></td>
													<td ><?php echo $Adresse_Mail?></td>
													<td ><?php echo $Adresse_Client; ?></td>
													<td ><?php echo $Code_Postal;?></td>
													<td ><?php 

													$rest = substr($Commentaires_Produit, 0, 150);
													echo $rest ,"...";
													;?></td>
													<td class="mx-0">
														<form id="delCom" action="repondreCommentaires.php" method="post">
															<input type="hidden" name="idDelete" value="<?php echo $Id; ?>"/>
															<button class="btn btn-link" type="submit">Répondre</button>												
														</form>
														
														<br>
														<form id="repCom" action="delCommentaires.php" method="post">
															<input type="hidden" name="idRep" value="<?php echo $Id; ?>"/>
															<button class="btn btn-link" type="submit">Supprimer</button>												
														</form>
													</td>					

													<?php
												}
											}

											mysqli_stmt_close($resultat);
										}
									}else{
										echo"echec de connexion  ".mysqli_connect_error()."<br/>";
									}
									?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>



				


				<!-- Footer / lien vers réseaux sociaux -->
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