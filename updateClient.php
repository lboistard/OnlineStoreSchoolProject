<?php 
session_start();

	//~------------------------------------------------------------
	//~ Déclaration des variables de Session / et autres variables
	//~------------------------------------------------------------
	$refProduitDeSession = $_SESSION['ref'];
	$prénomClientToUpdate = $_SESSION["prenomClientSession"];
	$nomClientToUpdate = $_SESSION["nomClientSession"];
	$mailDeSession = $_SESSION['emailClientSession'];
	$authToUpdate = "false";

	//~-------------------------------------------------------------
	//~ Variables de connexion à la DB
	//~-------------------------------------------------------------	
	$hostname = 'localhost';
	$username = 'root';
	$password = 'root';
	$myDataBase = 'OnlineStoreProject';


	//~-------------------------------------------------------------
	//~ Si les champs ont été remplis, on les met dans des variables
	//~-------------------------------------------------------------
	if (isset($_POST['Form-nouveauEmail']) && isset($_POST['Form-oldPass']) && isset($_POST['Form-newPass']) && isset($_POST['Form-nouveauTel']) && isset($_POST['Form-newAdresse']) && isset($_POST['Form-newPostal'])) {

		$nouveauEmail = $_POST['Form-nouveauEmail'];
		$oldPass = $_POST['Form-oldPass'];
		$newPass = $_POST['Form-newPass'];
		$nouveauTel = $_POST['Form-nouveauTel'];
		$newAdress = $_POST['Form-newAdresse'];
		$newPostal = $_POST['Form-newPostal'];



		//cryptage du nouveau et de l'ancien mdp
		$oldPass = md5($oldPass);
		$newPass = md5($newPass);

		echo "<br>everything is set <br>";

	}

	//~-------------------------------------------------------------
	//~ Connexion à la DataBase
	//~-------------------------------------------------------------		
	$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

	if($connect){

		echo "connect ok<br>";

		$requeteRecupMdPActuel = "SELECT Password  FROM User WHERE Adresse_Mail='$mailDeSession' ";		
		$resultatRequeteRecup = mysqli_prepare($connect,$requeteRecupMdPActuel);//liaison des paramètres
		$varRequeteRecup = mysqli_stmt_execute($resultatRequeteRecup);

		if($varRequeteRecup == false){
			echo "erreur requete";
		}else{

			$varRequeteRecup = mysqli_stmt_bind_result($resultatRequeteRecup,$passwordInDB);
			while(mysqli_stmt_fetch($resultatRequeteRecup)){	
				if ($passwordInDB == $newPass) {				
					header("location:espaceClient.php?sameAsBefore=false");
				}
			}
		}

		mysqli_stmt_close($resultatRequeteRecup);
		
		//~-------------------------------------------------------------
		//~ Exécution de la requête d'update
		//~-------------------------------------------------------------

		$requeteUpdateParamClient="UPDATE User SET Adresse_Mail = '$nouveauEmail', Password = '$newPass' , Téléphone = $nouveauTel ,Code_Postal = $newPostal , Adresse_Client='$newAdress'  WHERE Adresse_Mail='$mailDeSession' ";

		$resultatUpdate=mysqli_query($connect,$requeteUpdateParamClient);

		
		mysqli_stmt_close($resultatUpdate);

		if($resultatUpdate==false){
			echo"Echec de l'exécution de la requête  <br><br><br>";
		}else{
			$_SESSION['emailClientSession'] = $nouveauEmail;
				
				//revenir page précédente en ajoutant un message qui précise qu'on à tout mis à jour
				//peut etre redéf le mail à afficher etc
			header("location:espaceClient.php?upToDate=true");

		}	

		echo $CommentaireAUpdate;	





		
	}else{
		echo"echec de connexion  ".mysqli_connect_error()."<br/>";
	}
	?>