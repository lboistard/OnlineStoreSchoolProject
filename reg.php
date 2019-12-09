<?php 

session_start();

	//~------------------------------------------------------------
	//~ Variables et Variables de  Session
	//~------------------------------------------------------------
$mailDeSession = $_SESSION['emailClientSession'];
$refProduitDeSession = $_SESSION['ref'];
$Id = $_SESSION['idClientSession'];

	/*
		Connexion à la BDD
	*/
		$hostname = 'localhost';
		$username = 'root';
		$password = 'root';
		$myDataBase = 'OnlineStoreProject';


		$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

		if($connect){

			$requeteRecupCommentaires = "SELECT Commentaires_Client FROM Recherche_Produit WHERE Référence=$refProduitDeSession ";		
		$resultatRequeteRecup = mysqli_prepare($connect,$requeteRecupCommentaires);//liaison des paramètres
		$varRequeteRecup = mysqli_stmt_execute($resultatRequeteRecup);

		if($varRequeteRecup == false){
			echo "erreur requete";
		}else{
				//lecture des valeurs
			$varRequeteRecup = mysqli_stmt_bind_result($resultatRequeteRecup,$Commentaires_Client);
			
			while(mysqli_stmt_fetch($resultatRequeteRecup)){
				$commentaires_ClientProduit = $Commentaires_Client;
			}

			//Fermeture de la requete
			mysqli_stmt_close($resultatRequeteRecup);

		}
		
		
		if (isset($_POST['commentArea'])) {
			$commentaireUser = $_POST['commentArea'];
		}

		
		//~------------------------------------------------------------
		//~ Traitement du commentaire à partir des précédents
		//~------------------------------------------------------------
		$commentaireUserAvecMail = $mailDeSession .' '. $commentaireUser;
		$CommentaireAUpdate = $commentaires_ClientProduit . " ". $commentaireUserAvecMail;


		

		$requeteUpdateCommentairesClients="UPDATE Recherche_Produit SET Commentaires_Client = '$CommentaireAUpdate' WHERE Référence=$refProduitDeSession";

		$resultatUpdate=mysqli_query($connect,$requeteUpdateCommentairesClients);
		
		if($resultatUpdate==false){
			echo"Echec de l'exécution de la requête  <br><br><br>";
		}

		else{
			echo"Commentaire enregistré. <br><br><br>";
			mysqli_stmt_close($resultatUpdate);
			
		}	
		
		
		



		$requeteRecupCommentaireProduit = "SELECT Commentaires_Produit FROM User WHERE Id=$Id ";		
		$resultatRequeteRecupProduit = mysqli_prepare($connect,$requeteRecupCommentaireProduit);//liaison des paramètres
		$varRequeteRecup = mysqli_stmt_execute($resultatRequeteRecupProduit);

		if($varRequeteRecup == false){
			echo "erreur requete";
		}else{
				//lecture des valeurs
			$varRequeteRecup = mysqli_stmt_bind_result($resultatRequeteRecupProduit,$Commentaires_Produit);
			
			while(mysqli_stmt_fetch($resultatRequeteRecupProduit)){
				$commentaires_Produit = $Commentaires_Produit;
			}

			//Fermeture de la requete
			mysqli_stmt_close($resultatRequeteRecupProduit);

		}
		
	



		$nouveauCom = $commentaires_Produit . ". Réponse du user - " . $commentaireUser;
		//ajout du commentaire dans la table clie-nt

		$requeteUpdateComProduit = "UPDATE User SET Commentaires_Produit = '$nouveauCom' WHERE Id=$Id";
		$resultatUpdateComProduit=mysqli_query($connect,$requeteUpdateComProduit);
		
		if($resultatUpdateComProduit==false){
			echo"Echec de l'exécution de la requête  <br><br><br>";
		}

		else{
			echo"Commentaire enregistré. <br><br><br>";

			mysqli_stmt_close($resultatUpdateComProduit);
			
		}	
			echo "<h1>" , $nouveauCom ,"</h1>";

		
		header('location:monProduit.php?ref='.$refProduitDeSession.'&commentAdded=added');

		

	}else{
		echo"echec de connexion  ".mysqli_connect_error()."<br/>";
	}

	?>

