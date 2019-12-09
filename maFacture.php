<?php 
session_start();

$refCommande = $_GET['ref'];
$idUserCommander =  $_GET['id'];
$prixPanier = 0 ;
$prixPanierQuantité = 0;

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


	<!-- Commentaires des Client -->
	<div class="row">
		<div class="col-md-6  pt-md-0 mx-auto text-center">
			<div class="row">
				<div class="col">
					<h1>Votre Facture</h1>
				</div>			
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-10  pt-md-0 mx-auto text-center">			
			<hr>
		</div>		
	</div>



	<!-- Afficher les Params du Clients -->	

	<?php 
		//~-------------------------------------------------------------
		//~ Connexion à la DB
		//~-------------------------------------------------------------
	$hostname = 'localhost';
	$username = 'root';
	$passwordDB = 'root';
	$myDataBase = 'OnlineStoreProject';

	$connect=mysqli_connect($hostname,$username,$passwordDB,$myDataBase);

	if($connect){	

		//~-------------------------------------------------------------
		//~ Récup param user
		//~-------------------------------------------------------------
		$requetUser ="SELECT Nom,Prénom,Adresse_Mail, Téléphone, Adresse_Client, Code_Postal FROM User WHERE Id=$idUserCommander";
		
		$resultatUser = mysqli_prepare($connect,$requetUser);


		$var = mysqli_stmt_execute($resultatUser);
		if($var == false){
			echo"echec de l'exécution de la requête.<br/>";
		}else{				

						// Liaison des valeurs de la requete à des variables
			$var = mysqli_stmt_bind_result($resultatUser,$Nom, $Prénom, $MailUser, $telUser ,$AdresseUser, $PostalUser);

						//~-------------------------------------------------------------
						//~ Regarde si le mail saisi existe, si non on revoit une erreur
						//~-------------------------------------------------------------
			while(mysqli_stmt_fetch($resultatUser)){	

			}

			mysqli_stmt_close($resultatUser);
		}

		?>

		<div class="row">

			<div class="col-md-10 mx-auto">
				<div class="row">
					<div class="col-md-4 mr-auto">
						<address>
							<strong>Facturé a :</strong><br>
							<?php echo $Nom ;?> <br>
							<?php echo $Prénom; ?><br>
							<?php echo $MailUser ;?><br>
							<?php echo $telUser ;?>						
						</address>
					</div>

					<div class="col-md4 text-right">
						<address>
							<strong>Envoyé à :</strong><br>
							<?php echo $AdresseUser; ?><br>
							<?php echo $PostalUser; ?>

						</address>
					</div>
				</div>

			</div>

		</div>

		<div class="row">
			<div class="col-md-10  pt-md-0 mx-auto text-center">			
				<hr>
			</div>		
		</div>



		<div class="row">
			<div class="col-md-10 mx-auto">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><strong>Résume de votre Commande</strong></h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<td><strong>Produit</strong></td>
										<td class="text-center"><strong>Catégorie</strong></td>
										<td class="text-center"><strong>Marque</strong></td>
										<?php if (isset($_GET['quantite'])): ?>
											<td class="text-center"><strong>Quantité</strong></td>
										<?php endif ?>
										<td class="text-center"><strong>Prix</strong></td>
										<td class="text-right"><strong>TVA</strong></td>
									</tr>
								</thead>

								<?php 
									//~-------------------------------------------------------------
									//~ Récup param user
									//~-------------------------------------------------------------

								$nbrProduct = strlen($refCommande) / 3;
								$myVar = str_split($refCommande, 3); 

								for ($i=0; $i < $nbrProduct; $i++) { 

									$requetProduit ="SELECT Libellé,Catégorie,Marque, Prix, TVA FROM Recherche_Produit WHERE Référence=$myVar[$i]";

									$resultatProduit = mysqli_prepare($connect,$requetProduit);


									$varResultProd = mysqli_stmt_execute($resultatProduit);
									if($varResultProd == false){
										echo"echec de l'exécution de la requête.<br/>";
									}else{				

								// Liaison des valeurs de la requete à des variables
										$varResultProd = mysqli_stmt_bind_result($resultatProduit,$Libel, $Catégorie, $Marque, $Prix ,$TVA);


										?>
										<tbody>
											<!-- foreach ($order->lineItems as $line) or some such thing here -->

											<?php 

											while(mysqli_stmt_fetch($resultatProduit)){	
												$prixPanier = $prixPanier + $Prix + (($TVA/100) * $Prix);
												$prixPanierQuantité = ($Prix + (($TVA/100) * $Prix) )*$_GET['quantite']; 
												if (isset($_GET['quantite']) ) {
													# code...
												}


												?>
												<tr>

													<td><?php echo $Libel ;?></td>
													<td class="text-center"><?php echo $Catégorie ;?></td>
													<td class="text-center"><?php echo $Marque; ?></td>
													<?php if (isset($_GET['quantite'])): ?>
														<td class="text-center"><?php echo $_GET['quantite'] ;?></td>
													<?php endif ?>
													<td class="text-center"><?php echo $Prix , " €";?></td>
													<td class="text-right"><?php echo $TVA ," %";?></td>

												</tr>

											<?php }



											mysqli_stmt_close($resultatProduit);
										} 
									}
									?>

								</tbody>
							</table>



						</div>
						<div class="row mt-md-5">


							<?php 

							if (isset($_GET['quantite']) ) {
													# code...
								?>

								<div class="col text-right">
								<address>
									<h4><strong>Total à payer:</strong><br></h4>
									<h5><?php echo $prixPanierQuantité ," €"; ?><br></h5>
									

								</address>


							</div>
								<?php 

							}else{
						 ?>
							<div class="col text-right">
								<address>
									<h4><strong>Total à payer:</strong><br></h4>
									<h5><?php echo $prixPanier ," €"; ?><br></h5>
									

								</address>


							</div>
						 <?php 

							}
							?>
							
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col mt-lg-4 col-md-4 mx-auto">

				<a href="Client.php" class="btn btn-outline-dark btn-md btn-block">
					Retour à mes achats
				</a>


			</div>
		</div>



	</body>
	</html>


	<?php 

}else{
	echo "echec connexion";
} 
?>