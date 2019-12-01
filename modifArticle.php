<?php 
	session_start();

	//~-------------------------------------------------------------
	//~ Variables de connexion à la DB
	//~-------------------------------------------------------------	
	$hostname = 'localhost';
	$username = 'root';
	$password = 'root';
	$myDataBase = 'OnlineStoreProject';


	//~-------------------------------------------------------------
	//~ Déclaration des variables
	//~-------------------------------------------------------------
	$ref= $_SESSION['ref'];


	//~-------------------------------------------------------------
	//~ Connexion à la DataBase
	//~-------------------------------------------------------------		
	$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

	if($connect){

		//~-------------------------------------------------------------
		//~ On regarde si on à remplit les champs
		//~-------------------------------------------------------------		
		if (isset($_POST['Form-nouveauPrix']) && isset($_POST['Form-nouveauTVA']) && isset($_POST['Form-nexQuantité']) && isset($_POST['Form-newDescription'])) {
			
			$nouveauPrix = $_POST['Form-nouveauPrix'];
			$nouveauTVA = $_POST['Form-nouveauTVA'];
			$nouveauQuantité = $_POST['Form-nexQuantité'];
			$nouveauDescription = $_POST['Form-newDescription'];
		}



		$requeteModifProduit="UPDATE Recherche_Produit SET Prix =$nouveauPrix, TVA = $nouveauTVA , Quantité = $nouveauQuantité ,Description = '$nouveauDescription'  WHERE Référence=$ref";

		$resultatModifProduit=mysqli_query($connect,$requeteModifProduit);

		
		mysqli_stmt_close($resultatModifProduit);

		if($resultatModifProduit==false){
			echo"Echec de l'exécution de la requête";
		}else{
			header("location:produitManager.php?ref=$ref");
		}	

		echo $CommentaireAUpdate;	




	}else{
		echo"echec de connexion  ".mysqli_connect_error()."<br/>";

	}

 ?>





