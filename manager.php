<?php 
session_start();

$hostname = 'localhost';
$username = 'root';
$password = 'root';
$myDataBase = 'OnlineStoreProject';

$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

if($connect){
	$requete = "SELECT Référence, Catégorie,Marque,Prix,Description, Image FROM Recherche_Produit";
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
					<meta charset="utf-8">

					<!-- Srcript pour Boostrap 4 -->
					<!-- Scripts  -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

			<link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">


					<title>Manager</title>
				</head>
				<body>

					<style>
						.form-elegant .font-small {
							font-size: 0.8rem; 
						}

						.form-elegant .z-depth-1a {
							-webkit-box-shadow: 0 2px 5px 0 rgba(55, 161, 255, 0.26), 0 4px 12px 0 rgba(121, 155, 254, 0.25);
							box-shadow: 0 2px 5px 0 rgba(55, 161, 255, 0.26), 0 4px 12px 0 rgba(121, 155, 254, 0.25);
						}

						.form-elegant .z-depth-1-half,
						.form-elegant .btn:hover {
							-webkit-box-shadow: 0 5px 11px 0 rgba(85, 182, 255, 0.28), 0 4px 15px 0 rgba(36, 133, 255, 0.15);
							box-shadow: 0 5px 11px 0 rgba(85, 182, 255, 0.28), 0 4px 15px 0 rgba(36, 133, 255, 0.15); 
						}

						.form-elegant .modal-header {
							border-bottom: none; 
						}

						.modal-dialog .form-elegant .btn .fab {
							color: #2196f3!important; 
						}

						.form-elegant .modal-body, .form-elegant .modal-footer {
							font-weight: 400; 
						}
					</style>


					<!-- Header -->
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Accueil </a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNav">

							<ul class="nav navbar-nav ml-auto">
								<li class=" nav-item">
									<a class="nav-link" href="nosClients.php">Nos Clients</a>															
								</li>
								<li class=" nav-item">
									<a class="nav-link" href="deconnect.php">Se Déconnecter</a>															
								</li>
							</ul>
						</div>
					</nav>


					

				</div>
				<!-- Liste des produits -->
				<div class="row">
					<div class="col-md-8 ml-auto mr-auto">
						<div class="row">
							<div class="col">
								<h1>Liste des produits</h1>
							</div>
							<div class="col">
								
								<form class="form-inline my-2 flex-row-reverse ">
									<a href="#" class="btn btn btn-outline-dark" data-toggle="modal" data-target="#elegantModalForm">Ajouter un produit</a>

								</form>
							</div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-4 mx-auto text-center">
						<?php 
				//si le produit à été ajouté avec success
						if (isset($_GET['productAdded'])) {
							if ($_GET['productAdded'] == 'true') {
								echo "<!-- Warning Alert -->
								<div class=\"alert alert-success alert-dismissible fade show\">
								Le <strong>produit</strong> à bien été ajouté<button type=\"button\" class=\"close\" data-dismiss=\"alert\"></button>
						</div>";			#
					}					
				}

				?>
			</div>
		</div>

		<!-- Liste des Produits -->
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
										<a href="produitManager.php?ref=<?php echo $Référence?>">
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

	<div class="modal fade" id="elegantModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content form-elegant">
				<div class="modal-header text-center">
					<h5 class="modal-title w-100 dark-grey-text my-3" id="myModalLabel">Remplir les champs pour ajouter un Produit</h5>
				</div>


				<form class="form" action="addProduct.php" role="form" method="POST">
					<div class="modal-body mx-5">				
						

						<div class="md-form pb-3">
							<label for="Form-libelProduit">Libellé</label>
							<input type="text" 	name="Form-libelProduit" id="Form-libelProduit" class="form-control validate" >				        	          
						</div>

						<div class="form-group md-form pb-3 pt-3 dropdown">						
							<label for="Form-TypeProduit">Catégorie</label>
							<select class="form-control" name="Form-TypeProduit" id="Form-TypeProduit">
								<option type="text" value="Pc">Pc</option>
								<option type="text" value="Scanner" >Scanner</option>
								<option type="text" value="Imprimantes" >Imprimantes</option>
							</select>				          				          
						</div>

						<div class=" form-group md-form pb-3 pt-3 dropdown">
							<label for="Form-Marque">Marque</label>
							<select class="form-control" name="Form-Marque" id="Form-Marque" >
								<option type="text" value="Apple">Apple</option>
								<option type="text" value="Samsung">Samsung</option>
								<option type="text" value="Dell">Dell</option>
								<option type="text" value="Brother">Brother</option>
							</select>				          				          
						</div>


						<div class="md-form pb-3">
							<label for="Form-Quantité">Quantité en Stock : </label>
							<input  type="number" name="Form-Quantité" id="Form-Quantité" class="form-control validate"  placeholder="">				          				          
						</div>
						<div class="md-form pb-3">
							<label for="Form-PrixProduit">Prix : </label>
							<input  type="number" name="Form-PrixProduit" id="Form-PrixProduit" class="form-control validate"  placeholder="€">				          				          
						</div>

						<div class="md-form pb-3">
							<label for="Form-TVA">TVA : </label>
							<input  type="number" name="Form-TVA" id="Form-TVA" class="form-control validate"  placeholder="20%">				          				          
						</div>

						<div class="md-form pb-5">
							<label for="Form-descriptionProduit">Description : </label>
							<textarea  type="textarea" name="Form-descriptionProduit" id="Form-descriptionProduit" class="form-control validate"  placeholder=""></textarea>			          				          
						</div>

						<div class="md-form pb-3">
							<label for="Form-LienImage">Lien image du produit</label>
							<input type="text" id="Form-LienImage" name="Form-LienImage" class="form-control validate" placeholder="utiliser mysqlid">

						</div>


						<div class="text-center mb-3">
							<button type="submit" class="btn btn-outline-dark">Add product</button>
						</div>
					</div>
				</form>		
			</div>
		</div>
	</div>



</div>

</div>

</body>
</html>


