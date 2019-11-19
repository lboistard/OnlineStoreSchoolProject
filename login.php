<?php 
session_start(); 
	//Variables
$ClientMail = $_POST['emailClient'];
$ClientPassword = $_POST['passwordClient'];
$ManagerMail = $_POST['emailManager'];
$ManagerPassword = $_POST['passwordManager'];
$category = "";
?>




<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">



	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

	<title>Connexion à votre Esapce</title>
</head>

<script>
	$(function() {
    //Formulaire client 
    $('#client-link').click(function(e) {
    	$("#client-form").delay(100).fadeIn(100);
    	$("#manager-form").fadeOut(100);
    	$('#manager-link').removeClass('active');
    	$(this).addClass('active');
    	e.preventDefault();
    });
    //formulaire manager
    $('#manager-link').click(function(e) {
    	$("#manager-form").delay(100).fadeIn(100);
    	$("#client-form").fadeOut(100);
    	$('#client-link').removeClass('active');
    	$(this).addClass('active');
    	e.preventDefault();
    });
});
</script>



<div class="container">

	

	<div class="py-3 text-center">
		<a href="index.php"> <img class="d-block mx-auto mb-2" src="Images/SPI.png" alt="" width="170" height="170"></a>

		<h2><strong>Connectez-vous </strong> à votre Espace !</h2>
		<p class="lead">Veuillez renseignez tous les champs ci-dessous en respectant bien les consignes</p>
	</div>

	<div class="row">
		<div class="cold-md-8 ml-auto mr-auto">
			<?php 
		/*
			Error message quand le user n'est pas dans la database
		*/
			if(isset($_GET['errorMessage'])) {
				if ($_GET['errorMessage'] == 'faux') {
					echo "<!-- Warning Alert -->
					<div class=\"alert alert-danger alert-dismissible fade show\">
					Mauvaise <strong>Adresse mail</strong> et/ou <strong>mot de passe !</strong>
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\"></button>
					</div>";
				}
			}
			?>
		</div>



	</div>


	<div class="row">
		<div class="col-md-7 ml-auto mr-auto">
			<div class="panel panel-login">
				<div class="panel-heading">

					<div class="row">
						<div class="col-md-6   btn-group btn-group-toggle mx-auto mb-2">
							<a  class="btn btn-outline-dark" href="#" class=" active" id="client-link" >Client</a>
						</div>

						<div class="col-md-6   btn-group btn-group-toggle mx-auto mb-2">
							<a  class="btn  btn-outline-dark" href="#" id="manager-link">Manager</a>
						</div>
					</div>
					<hr>




				</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">

							<form id="client-form" method="POST" action="clientRequest.php?createAccount=0" role="form" style="display: block;">



								<!-- Adresse mail du client -->
								<div class="form-group">

									<input type="mail" name="mailClient" id="mailClient" class="form-control" placeholder="Adresse Mail">
								</div>

								<!-- Password du client -->
								<div class="form-group">
									<input type="password" name="passwordClient" id="passwordClient" class="form-control" placeholder="Mot de Passe">
								</div>




								<hr>

								<!-- Confirmation -->
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 ml-auto mr-auto">
											<button class="btn btn-outline-dark btn-lg btn-block" type="submit">
												Se connecter
											</button>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-md-6 ml-auto mr-auto text-center">
											<a href="createAccount.php">Vous n'avez pas de compte ?</a>
										</div>
									</div>
								</div>

							</form>






							<form id="manager-form" action="http://phpoll.com/register/process" method="post" role="form" style="display: none;">




								<!-- Adresse mail du client -->
								<div class="form-group">
									<input type="mail" name="mailClient" id="mailClient" tabindex="2" class="form-control" placeholder="Adresse Mail">
								</div>

								<!-- Password du client -->
								<div class="form-group">
									<input type="password" name="passwordClient" id="passwordClient" tabindex="2" class="form-control" placeholder="Mot de Passe">
								</div>

								<hr>

								<div class="form-group">
									<div class="row">									
										<div class="col-md-6 ml-auto mr-auto">
											<button class="btn btn-outline-dark btn-lg btn-block" type="submit">
												Se connecter 
											</button>
										</div>											
									</div>
								</div>


								<div class="form-group">
									<div class="row">
										<div class="col-md-6 ml-auto mr-auto text-center">
											<a href="createAccount.php">Vous n'avez pas de compte ?</a>
										</div>
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


</body>
</html>