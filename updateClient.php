<?php 
session_start();


	//~------------------------------------------------------------
	//~ Déclaration des variables de Session / et autres variables
	//~------------------------------------------------------------
	$refProduitDeSession = $_SESSION['ref'];
	$prénomClientToUpdate = $_SESSION["prenomClientSession"];
	$nomClientToUpdate = $_SESSION["nomClientSession"];

	echo "<h1>", $prénomClientToUpdate,  "  " , $nomClientToUpdate, "</h1>";

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
	if (isset($_POST['Form-nouveauEmail']) && isset($_POST['Form-oldPass']) && isset($_POST['Form-newPass']) && isset($_POST['Form-nouveauTel']) && isset($_POST['Form-newAdresse'])) {

		$nouveauEmail = $_POST['Form-nouveauEmail'];
		$oldPass = $_POST['Form-oldPass'];
		$newPass = $_POST['Form-newPass'];
		$nouveauTel = $_POST['Form-nouveauTel'];
		$newAdress = $_POST['Form-newAdress'];



		//cryptage du nouveau et de l'ancien mdp
		$oldPass = md5($oldPass);
		$newPass = md5($newPass);

		echo "<br>everything is set <br>";
	}




	/*
			AVANT D'UPDATE Vérifier l'ancien mdp
	*/

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
				if ($passwordInDB == $oldPass) {
					$authToUpdate  ="true";
				}
				else{
					//print un message d'erreur dans la page d'avant
				}

			}
		}

		//~-----------------------------------------
		//~ Update de la DB avec les nouvelles infos
		//~-----------------------------------------	
		if ($authToUpdate == "true") {

			$requeteUpdateParamUser = "UPDATE User SET  = '$CommentaireAUpdate',  WHERE Adresse_Mail="$mailDeSession"";		

			$resultatRequeteUpdate = mysqli_prepare($connect,$requeteUpdateParamUser);//liaison des paramètres
			$varRequeteUpdateUser = mysqli_stmt_execute($resultatRequeteUpdate);

			if($varRequeteUpdateUser == false){
				echo "erreur requete";
			}else{



				$varRequeteUpdateUser = mysqli_stmt_bind_result($resultatRequeteRecup,$passwordInDB);
				while(mysqli_stmt_fetch($resultatRequeteRecup)){	
					if ($passwordInDB == $oldPass) {
						$authToUpdate  ="true";
					}
					else{
						//print un message d'erreur dans la page d'avant
					}

				}
			}

			

		}



	}else{
		echo"echec de connexion  ".mysqli_connect_error()."<br/>";
	}
	



	?>