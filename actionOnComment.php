<?php 

session_start();

$idClient = $_POST['idClient']; 



$hostname = 'localhost';
$username = 'root';
$password = 'root';
$myDataBase = 'OnlineStoreProject';

$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

if($connect){


	$requeteRecupParamUser ="SELECT Nom,Prénom FROM User WHERE Id = $idClient";
		$resultatRecupParamUser = mysqli_prepare($connect,$requeteRecupParamUser);//liaison des paramètres
		$var = mysqli_stmt_execute($resultatRecupParamUser);				
		if($var == false){
			echo "echec requete";
		}else{
			$var = mysqli_stmt_bind_result($resultatRecupParamUser,$Nom,$Prénom);	
			while(mysqli_stmt_fetch($resultatRecupParamUser)){

			}
		}

		mysqli_stmt_close($resultat);



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
					<div class="returnToPage mb-md-2 ">
						<a style="color:#707070;margin-left:50" href="nosClients.php">
							<i class="fas fa-arrow-left"></i>
							<span> Retour aux Clients</span>
						</a>
					</div>
				</div>
			</div>

			<!-- Commentaires des Client -->
			<div class="row">
				<div class="col-md-6  pt-md-0 mx-auto text-center">
					<div class="row">
						<div class="col">
							<h1>Commentaires du client : <?php echo $Nom , " " , $Prénom; ?></h1>
						</div>			
					</div>
				</div>
			</div>


			<!-- HR -->
			<div class="row">
				<div class="col-md-6 mx-auto">
					<hr>				
				</div>
			</div>


			<!-- Liste des Commentaires en fonction du client -->
			<div class="row mt-lg-2">
				<div class="col-lg-10 mb-lg-4 ml-auto mr-auto">
					<table class="table table-hover">
						<thead>
							<tr>	
								<th style="width: 40%" scope="col">Commentaires du Client</th>
								<th style="width: 40%" scope="col">Réponse du manager</th>
								<th style="width: 20%" scope="col">Action</th>

							</tr>
						</thead>
						<tbody>



							<!-- Liste des commentaires -->
							<?php 


							$requeteRecupComment ="SELECT Commentaires,Id,RéponseManager FROM Commentaires_Produit WHERE IdUser = $idClient";
						$resultatRecupComment = mysqli_prepare($connect,$requeteRecupComment);//liaison des paramètres

						$var = mysqli_stmt_execute($resultatRecupComment);

						if($var == false){
							echo "echec requete";
							echo $_POST['idClient'];
						}else{

							$var = mysqli_stmt_bind_result($resultatRecupComment,$Commentaires , $IdCommentaires, $RéponseManager);	
							
							while(mysqli_stmt_fetch($resultatRecupComment)){

								?>
								<tr>

									<td ><?php echo $Commentaires?></td>
									<td ><?php echo $RéponseManager?></td>
									<td>
										<form method="post" action="delCommentaires.php">
											<button type="submit" name="idCommentaires" value="<?php echo $IdCommentaires; ?>" class="btn btn-link mx-0 px-0">Supprimer le commentaires</button >
										</form>

										<form method="post" action="repondreCommentaires.php">
											<button type="submit" name="idResponse" value="<?php echo $IdCommentaires; ?>" class="btn btn-link mx-0 px-0">Répondre commentaires</button >
										</form>

										
									</td>

								</tr>
								

								<?php
							}
						}

						mysqli_stmt_close($resultat);


						?>

					</tbody>
				</table>
			</div>
		</div>





	</body>
	</html>

<?php }else{
	echo "error";
} ?>