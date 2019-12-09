<?php 
session_start();

	//~--------------------------------------------------------------------
	//~ Variables de Session / POST /GET
	//~--------------------------------------------------------------------
$nomClientSession = $_SESSION['emailClientSession'];
$accountGet = $_GET['createAccount'];			
$cookies = 'empty';
$Type = 'Client';
$mailExist ='false';
$passwordExist = 'false';

$allProduct ="true";

	//~--------------------------------------------------------------------
	//~ Connexion to DataBase
	//~--------------------------------------------------------------------
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$myDataBase = 'OnlineStoreProject';


$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

if($connect){
	
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

		<script type="text/javascript">
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
		<style type="text/css">
			#myDIV {
				display: none;
			}


			footer {

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
					<li class="nav-item">
						<a class="nav-link" href="monPanier.php">Mon Panier </a>
					</li>
					<li class=" nav-item">
						<a class="nav-link" href="espaceClient.php">Mon Compte</a>
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

						<div class="row">
							<div class="col ml-auto">
								<form class="form-inline my-2 flex-row-reverse ">
									<a onclick="myFunction()" class="ml-auto btn btn-outline-success my-2"  href="#myDIV"><span> Rechercher un Produit</span></a>
								</form>
							</div>
							<div class="col">
								<form action="commentaireUser.php" class="form-inline my-2 flex-row-reverse ">
									<button class="ml-auto btn btn-outline-success my-2"  ><span> Ajouter un commentaire</span></button>
								</form>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-10 mr-auto ml-auto comment">

				<!-- Div pour afficher commenter  -->
				<div class="row ml-auto mr-auto">
					<div class="col-md-12 ml-auto mr-auto">
						<div id="myDIV">
							<hr>

							<form method="post" action="customProduct.php">
								<div class="row"  class="mr-auto ml-auto text-center">


									<div class="form-group md-form dropdown col-md-6">		
										<div class="row">
											<div class="col-md-2 mt-md-2">
												<label for="Form-TypeProduit">Catégorie</label>
											
											</div>
											<div class="col-md-6">
												<select class="form-control" name="Form-TypeProduit" id="Form-TypeProduit">
											<option type="text" value="Pc">Pc</option>
											<option type="text" value="Scanners" >Scanners</option>
											<option type="text" value="Imprimantes" >Imprimantes</option>
										</select>
											</div>

										</div>				
													          				          
									</div>

									<div class="form-group md-form col-md-6 flex-right">	
										<div class="row">
											<div class="col-md-4 mt-md-2 pl-md-4">
												<label for="Form-TypeProduit">Marques en Stock : </label>									
											</div>
											<div class="col-md-6 pl-md-0">
												<input type="mail" name="marqueProduit" id="marqueProduit" class="form-control" placeholder="Recherche Marque">
											</div>										
										</div>							
									</div>								
								</div>
								<div class="row">
									<div class="col-md-2 mr-auto ml-auto">

										<input  type="submit" class=" btn btn-outline-dark form-control" value="Rechercher">
									</div>
								</div>
							</form>
							<hr>
						</div>
					</div>		
				</div>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 text-center ml-auto mr-auto">

				<?php 
					//~--------------------------------------------------------------------
					//~ Message d'erreur si le produit n'existe pas
					//~--------------------------------------------------------------------	
				if(isset($_GET['productFail'])) {
					if ($_GET['productFail'] == 'faux') {
						echo "<!-- Warning Alert -->
						<div class=\"alert alert-danger alert-dismissible fade show\">
						Veuillez ne pas <strong>changer les informations</strong> dans l'url svp
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\"></button>
						</div>";
					}
				}

					//~--------------------------------------------------------------------
					//~ Message d'erreur si le panier est vide
					//~--------------------------------------------------------------------
				if(isset($_GET['emptyBucket'])) {
					if ($_GET['emptyBucket'] == 'true') {
						echo "<!-- Warning Alert -->
						<div class=\"alert alert-info alert-dismissible fade show\">
						Votre <strong>Panier</strong> est vide !
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\"></button>
						</div>";
					}
				}

				//~--------------------------------------------------------------------
				//~ Message d'erreur si aucun produit ne correspond à la recherche
				//~--------------------------------------------------------------------
				if(isset($_GET['noProduct'])) {
					if ($_GET['noProduct'] == 'true') {
						echo "<!-- Warning Alert -->
						<div class=\"alert alert-warning alert-dismissible fade show\">
						Votre recherche ne correspond à aucun résultat !
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\"></button>
						</div>";
					}
				}
				?>
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
							<th style="width: 40%" scope="col">Description</th>
							<th style="width: 15%" scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
								//~--------------------------------------------------------------------
								//~ affichage des élements de la table produit
								//~--------------------------------------------------------------------
						if ($allProduct == "true") {
							$requete = "SELECT Référence, Catégorie,Marque,Prix,Description,Image FROM Recherche_Produit";
									$resultat = mysqli_prepare($connect,$requete);//liaison des paramètres

									$var = mysqli_stmt_execute($resultat);
								}
								if($var == false){

								}else{
									//lecture des valeurs
									$var = mysqli_stmt_bind_result($resultat,$Référence, $Catégorie,$Marque,$Prix,$Description, $Image);	
									while(mysqli_stmt_fetch($resultat)){
										?>
										<tr>
											<td >							
												<a href="monProduit.php?ref=<?php echo $Référence?>">
													<img src="<?php echo $Image; ?>" width="100" height="100">
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
										<td>
											<form>
												<a class="btn btn-link" href="addPanier.php?ref=<?php echo $Référence?>">
													Ajouter au panier
												</a>												

											</form>
										</td>

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
