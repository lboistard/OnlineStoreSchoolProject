<?php 
	
	session_start();

	//~------------------------------------------------------------
	//~ Variables et Variables de  Session
	//~------------------------------------------------------------
	$mailDeSession = $_SESSION['emailClientSession'];
	$refProduitDeSession = $_SESSION['ref'];
	
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
		$CommentaireAUpdate = $commentaires_ClientProduit . "". $commentaireUserAvecMail;


		

		$requeteUpdateCommentairesClients="UPDATE Recherche_Produit SET Commentaires_Client = '$CommentaireAUpdate' WHERE Référence=$refProduitDeSession";

		$resultatUpdate=mysqli_query($connect,$requeteUpdateCommentairesClients);
		
		if($resultatUpdate==false){
			echo"Echec de l'exécution de la requête  <br><br><br>";
		}

		else{
			echo"Commentaire enregistré. <br><br><br>";
			header('location:monProduit.php?ref='.$refProduitDeSession.'&commentAdded=added');
		}	
		
		echo $CommentaireAUpdate;

		
	
	}else{
		echo"echec de connexion  ".mysqli_connect_error()."<br/>";
	}

 ?>

