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

	//~--------------------------------------------------------------------
	//~ Connexion to DataBase
	//~--------------------------------------------------------------------
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$myDataBase = 'OnlineStoreProject';


$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

if($connect){
	$requete = "SELECT Référence, Catégorie,Marque,Prix,Description,Image FROM Recherche_Produit";
	$resultat = mysqli_prepare($connect,$requete);//liaison des paramètres

	$var = mysqli_stmt_execute($resultat);
	if($var == false){

	}else{
		//lecture des valeurs
		$var = mysqli_stmt_bind_result($resultat,$Référence, $Catégorie,$Marque,$Prix,$Description, $Image);
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
							<a class="nav-link" href="#">Mon Panier </a>
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
								<td><a  class="text-center" href="monProduit.php?ref=<?php echo $Référence?>">Acheter</a></td>

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
