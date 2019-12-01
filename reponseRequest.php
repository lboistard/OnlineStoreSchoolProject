<?php 
session_start();	

	//~-------------------------------------------------------------
	//~ Déclaration des variables
	//~-------------------------------------------------------------	
	$idUserDelete = $_SESSION['IdUserResponse'];
	$messageManager = " Réponse du manger : ";


	if (isset($_POST['textComment'])) {
		$commentFromManager = $_POST['textComment']; 
	}

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

		//~-------------------------------------------------------------
		//~ On récup le commentaiers du client
		//~-------------------------------------------------------------	
		$requetePrenomClient = "SELECT Commentaires_Produit FROM User WHERE Id=$idUserDelete ";		

			$resultatRequeteRecup = mysqli_prepare($connect,$requetePrenomClient);//liaison des paramètres
			$varRequeteRecup = mysqli_stmt_execute($resultatRequeteRecup);

			if($varRequeteRecup == false){
				echo "erreur requete";
			}else{

				$varRequeteRecup = mysqli_stmt_bind_result($resultatRequeteRecup,$Com);

				while(mysqli_stmt_fetch($resultatRequeteRecup)){
					$OldComment =$Com;
				}
				mysqli_stmt_close($resultatRequeteRecup);

				
			}

		//~-------------------------------------------------------------
		//~ On update le commentaires et ajoutant la réponse du manager
		//~-------------------------------------------------------------
			if ($OldComment == " ") {
				$commentATransmettre = $messageManager . $commentFromManager;
			}else{
				$commentATransmettre = $OldComment . $messageManager . $commentFromManager;

			}
			echo $oldComment,  "<br>";
			echo $commentATransmettre ," <br>";
			echo $commentFromManager;

		$requeteUpdateCom = "UPDATE User SET Commentaires_Produit = '$commentATransmettre' WHERE Id=$idUserDelete";
		$resultReponManager=mysqli_query($connect,$requeteUpdateCom);

		
		mysqli_stmt_close($resultReponManager);

		if($resultReponManager==false){
			echo"Echec de l'exécution de la requête";
		}else{
			header("location:nosClients.php?repMana=true");
		}





			
	}else{
		echo "echec";
	} 


?>
