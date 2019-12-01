<?php 
	session_start();

	//~-------------------------------------------------------------
	//~ Variables de connexion à la DB
	//~-------------------------------------------------------------	
	$hostname = 'localhost';
	$username = 'root';
	$password = 'root';
	$myDataBase = 'OnlineStoreProject';

	$ref = $_SESSION['ref'];


	//~-------------------------------------------------------------
	//~ Connexion à la DataBase
	//~-------------------------------------------------------------		
	$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

	if($connect){
		echo "success ";

		$requete = "SELECT Quantité from Recherche_Produit WHERE Référence=$ref";
		$resultat = mysqli_prepare($connect,$requete);//liaison des paramètres

		$var = mysqli_stmt_execute($resultat);
		if($var == false){
			echo"echec de l'exécution de la requête.<br/>";
		}else{
			echo "récup quantité";
			$var = mysqli_stmt_bind_result($resultat,$Quantité);//lecture des valeurs
					
			
			while(mysqli_stmt_fetch($resultat)){	
				echo "$Quantité";
			}
			mysqli_stmt_close($resultat);

		}

		//~-------------------------------------------------------------
		//~ Update avec le nouveau stock
		//~-------------------------------------------------------------
		$requeteUpdate = "UPDATE Recherche_Produit
					SET Quantité = ($Quantité - 1)
					WHERE Référence=$ref";

		
		$resultatUpdate=mysqli_query($connect,$requeteUpdate);
		

		
		mysqli_stmt_close($resultatUpdate);

		if ($resultatUpdate) {
			header("location:monProduit.php?ref=$ref");
		}




	}else{
		echo "fail";
	}
?>

