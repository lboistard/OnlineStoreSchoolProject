<?php 
session_start();	

	//~-------------------------------------------------------------
	//~ Déclaration des variables
	//~-------------------------------------------------------------	
	$idUserDelete = $_SESSION['IdUserResponse'];
	$messageManager = " Réponse du manager : ";


	if (isset($_POST['textComment']) && $_POST['idComment']) {
		$commentFromManager = $_POST['textComment']; 
		
		$idComment =  $_POST['idComment'];
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

		$requeteAjoutRep ="UPDATE Commentaires_Produit SET RéponseManager = '$commentFromManager' WHERE Id=$idComment";
		
		$resultatAjoutReponse=mysqli_query($connect,$requeteAjoutRep);

		
		mysqli_stmt_close($resultatAjoutReponse);

		if($resultatAjoutReponse==false){
			echo"Echec de l'exécution de la requête";
		}else{
			
		header("location:nosClients.php?repMana=true");
		}	




			
	}else{
		echo "echec";
	} 


?>
