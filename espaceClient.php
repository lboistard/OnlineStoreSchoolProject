<?php 
session_start();

	
	//~-------------------------------------------------------------
	//~ Variables de SESSION
	//~-------------------------------------------------------------	
	$refProduitDeSession = $_SESSION['ref'];
	$mailDeSession = $_SESSION['emailClientSession'];
	

	//~-------------------------------------------------------------
	//~ Variables de connexion à la DB
	//~-------------------------------------------------------------	
	$hostname = 'localhost';
	$username = 'root';
	$password = 'root';
	$myDataBase = 'OnlineStoreProject';


	//~-------------------------------------------------------------
	//~ Connexion à la DataBase
	//~-------------------------------------------------------------		
	$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

	if($connect){

		$requetePrenomClient = "SELECT Prénom,Nom,Adresse_Mail,Téléphone, Adresse_Client, Code_Postal  FROM User WHERE Adresse_Mail='$mailDeSession' ";		

		$resultatRequeteRecup = mysqli_prepare($connect,$requetePrenomClient);//liaison des paramètres
		$varRequeteRecup = mysqli_stmt_execute($resultatRequeteRecup);

		if($varRequeteRecup == false){
			echo "erreur requete";
		}else{

			$varRequeteRecup = mysqli_stmt_bind_result($resultatRequeteRecup,$PrenomClient, $Nom,$Adresse_Mail,$Téléphone, $Adresse_Client, $Code_Postal);

			while(mysqli_stmt_fetch($resultatRequeteRecup)){
			
				$prenomClientEspace = $PrenomClient;
				$NomClientEspace = $Nom;


				$Adresse_MailClientEspace = $Adresse_Mail;
				$TéléphoneClientEspace = $Téléphone;
				$Adresse_ClientClientEspace = $Adresse_Client;
				$Code_PostalClientEspace = $Code_Postal;


				
			}

					mysqli_stmt_close($resultatRequeteRecup);
		
			
		}

	}else{
		echo"echec de connexion  ".mysqli_connect_error()."<br/>";

	}
?>
	
	

	<!DOCTYPE html>
	<html>
	<head>
		<title>Mon Espace Client</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

		<link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">



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


		<div class="row">
			<div class="col ml-sm-4 ">
				<div class="returnToPage mb-md-5 ">

					<a style="color:#707070;margin-left:50" href="monProduit.php">
						<i class="fas fa-arrow-left"></i>
						<span> Retour au produit</span>
					</a>
				</div>
			</div>
		</div>


		<div class="row">

			<div class="col-md-6 ml-auto mr-auto text-center">
				<h1>Bienvenue dans <strong>votre espace </strong> <?php echo $prenomClientEspace; ?> !</h1>
			</div>



			<div class="col-md-8 ml-auto mr-auto text-center">	
				<h6>Voici vos informations : </h6>
			</div>

			

		</div>


			<div class="row">
				<?php 
				if (isset($_GET['upToDate'])) {											
					if ($_GET['upToDate'] == "true") {
						echo "<div class=\"alert alert-success alert-dismissible fade show mt-md-2 ml-auto mr-auto text-center\">
								Vos <strong>informations</strong> ont été mis à jour !
							</div>";
					}
				}
			 ?>

			</div>

		<div class="row">
			<div class="col col-md-6  ml-auto mr-auto">
				<table  style="border-top: none;" class="table table-no-border">
					<tbody>
						<tr>
							<th scope="row">Prénom</th>
							<td><?php echo $prenomClientEspace; ?></td>	
						</tr>
						<tr>
							<th scope="row">Nom</th>
							<td><?php echo $NomClientEspace; ?></td>	
						</tr>
						<tr>
							<th scope="row">Adresse Mail </th>
							<td><?php echo $Adresse_MailClientEspace ?></td>	
						</tr>
						<tr>
							<th scope="row">Téléphone </th>
							<td><?php echo $TéléphoneClientEspace ?></td>	
						</tr>
						<tr>
							<th scope="row">Adresse Client</th>
							<td><?php echo $Adresse_ClientClientEspace; ?></td>	
						</tr>
						<tr>
							<th scope="row">Code Postal</th>
							<td><?php echo $Code_PostalClientEspace; ?></td>	
						</tr>
					</tbody>
				</table>

			</div>
		</div>	

		<div class="row">
			<div class="col-md-6 mr-auto ml-auto comment">								
				<div class="d-flex flex-row-reverse">
					<a href="" data-toggle="modal" data-target="#elegantModalForm" class="ml-auto" style="color:#707070" >
						<span> Modifier mes informations</span>
					</a>
					<br><br>
				</div>
			</div>
		</div>

		<!-- MODAL -->

		<div class="modal fade" id="elegantModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content form-elegant">
					<?php 
					
					 ?>
					
					<!--Texte En haut du form-->
					<div class="modal-header text-center">
						<h5 class="modal-title w-100 dark-grey-text my-3" id="myModalLabel">Vos nouvelles informations</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true"></span>
						</button>
					</div>

					<?php 
					
						if (isset($_GET['sameAsBefore'])) {											
							if ($_GET['sameAsBefore'] == "false") {
								 echo "<div class=\"alert alert-warning alert-dismissible fade show mx-md-4 ml-auto mr-auto text-center\">
								           	Il semble que votre <strong>ancien</strong> et votre <strong>nouveau</strong> soit identique
								           </div>";
							}
						}

					 ?>
					
					<!--Body-->
					<form class="form" action="updateClient.php" role="form" method="POST">
						<div class="modal-body mx-5">				
							<div class="md-form pb-3">
								<label for="Form-nouveauEmail">Adresse Mail :</label>
								<input type="email" id="Form-nouveauEmail" name="Form-nouveauEmail" class="form-control validate" placeholder=<?php echo "$Adresse_MailClientEspace"; ?>>

							</div>

							<div class="md-form pb-3">
								<label for="Form-oldPass">Votre <strong>Ancien</strong> Mot de Passe : </label>
								<input type="password" 	name="Form-oldPass" id="Form-oldPass" class="form-control validate" >				          				          
							</div>

							<div class="md-form pb-3">
								<label for="Form-newPass">Votre <strong>Nouveau</strong> Mot de Passe : </label>
								<input type="password" name="Form-newPass" id="Form-newPass" class="form-control validate">				          				          
							</div>

							<div class="md-form pb-3">
								<label for="Form-nouveauTel">Téléphone : </label>
								<input type="tel" 	name="Form-nouveauTel" id="Form-nouveauTel" class="form-control validate"  placeholder=<?php echo "$TéléphoneClientEspace"; ?>>				          				          
							</div>

							<div class="md-form pb-3">
								<label for="Form-newAdresse">Votre Adresse : </label>
								<input  type="text" name="Form-newAdresse" id="Form-newAdresse" class="form-control validate"  placeholder="<?php echo $Adresse_ClientClientEspace ; ?>">				          				          
							</div>
							<div class="md-form pb-5">
								<label for="Form-newAdresse">Votre Code Postal : </label>
								<input  type="text" name="Form-newPostal" id="Form-newPostal" class="form-control validate"  placeholder="<?php echo $Code_PostalClientEspace ; ?>">				          				          
							</div>

							<div class="text-center mb-3">
								<button type="submit" class="btn btn-outline-dark">Confirmez vos informations</button>
							</div>
						</div>
					</form>					

				</div>				
			</div>
		</div>

	</body>



</body>
</html>