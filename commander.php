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
$iDUser = $_SESSION['idClientSession'];
$panierAfter ="empty";


	//~-------------------------------------------------------------
	//~ Connexion à la DataBase
	//~-------------------------------------------------------------		
$connect=mysqli_connect($hostname,$username,$password,$myDataBase);




if($connect){

	//~-------------------------------------------------------------
	//~ Si la commande comporte plusieurs produits
	//~-------------------------------------------------------------	
	if (isset($_GET['maCommande'])) {
		
		$refCommande = $_GET['maCommande'];
		echo $refCommande;

		//nombre produit dans le panier
		$nbrProduct = strlen($refCommande) / 3;

		//récup chaque groupe de 3 chiffres pour réf
		$myVar = str_split($refCommande, 3); 

		for ($i=0; $i < $nbrProduct; $i++) { 

			//récup quantité par produit
			$requeteRecupPanier = "SELECT Quantité From Recherche_Produit WHERE Référence = $myVar[$i]";
			$resultatRecupPanier = mysqli_prepare($connect,$requeteRecupPanier);//liaison des paramètres

			$var = mysqli_stmt_execute($resultatRecupPanier);
			if($var == false){
				echo "echec en requete";
			}else{				
				$var = mysqli_stmt_bind_result($resultatRecupPanier,$Quantité);					
				while(mysqli_stmt_fetch($resultatRecupPanier)){	

					$quant = $Quantité;		
					
				}

				mysqli_stmt_close($resultatRecupPanier);	

			}

			//retire la quantité pour chaque produit
			$requeteUpdate = "UPDATE Recherche_Produit
			SET Quantité = ($quant - 1)
			WHERE Référence= $myVar[$i]";

			
			$resultatUpdate=mysqli_query($connect,$requeteUpdate);
			
			mysqli_stmt_close($resultatUpdate);
			
		}

		//on reset le panier a "empty" pour le user
		$requeteUpdatePanier = "UPDATE User 
		SET Panier='$panierAfter'
		WHERE Id=$iDUser";
		$resultatUpdatePanier=mysqli_query($connect,$requeteUpdatePanier);

		mysqli_stmt_close($resultatUpdatePanier);
		//retourne a la page client 
		
		//header("location:Client.php");
		header("location:maFacture.php?ref=$refCommande&id=$iDUser");
	

	}elseif(isset($_GET['maCommandeUnique'])){
		
		$refProduit = $_GET['maCommandeUnique'];

		if (isset( $_POST['nombreProduit'])) {
			 $nbProduit = $_POST['nombreProduit'];
		}



		//récup quantité par produit
			$requeteRecupPanier = "SELECT Quantité From Recherche_Produit WHERE Référence = $refProduit";
			$resultatRecupPanier = mysqli_prepare($connect,$requeteRecupPanier);//liaison des paramètres

			$var = mysqli_stmt_execute($resultatRecupPanier);
			if($var == false){
				echo "echec en requete";
			}else{				
				$var = mysqli_stmt_bind_result($resultatRecupPanier,$Quantité);					
				while(mysqli_stmt_fetch($resultatRecupPanier)){	

					$quant = $Quantité;		
					
				}

				mysqli_stmt_close($resultatRecupPanier);	

			}

			//retire la quantité pour chaque produit
			$requeteUpdate = "UPDATE Recherche_Produit
			SET Quantité = ($quant - $nbProduit)
			WHERE Référence = $refProduit";

			
			$resultatUpdate=mysqli_query($connect,$requeteUpdate);
			
			mysqli_stmt_close($resultatUpdate);

			echo "<h1>Quantité : " , $nbProduit   , " <br></h1>";
			echo "<h1> Référence : " , $refProduit    , " <br></h1>";


		header("location:maFacture.php?ref=$refProduit&id=$iDUser&quantite=$nbProduit");



	}else{


		if (isset($_POST['nombreProduit'])) {
			
			$quantitéComm = $_POST['nombreProduit'];
			
		}
		//~-------------------------------------------------------------
		//~ Commande avec un produit
		//~-------------------------------------------------------------	
		$requete = "SELECT Quantité from Recherche_Produit WHERE Référence=$ref";
		$resultat = mysqli_prepare($connect,$requete);//liaison des paramètres

		$var = mysqli_stmt_execute($resultat);
		if($var == false){
			echo"echec de l'exécution de la requête.<br/>";
		}else{
			
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
		SET Quantité = ($Quantité - $quantitéComm)
		WHERE Référence=$ref";

		
		$resultatUpdate=mysqli_query($connect,$requeteUpdate);
		

		
		mysqli_stmt_close($resultatUpdate);

		if ($resultatUpdate) {
			header("location:maFacture.php?ref=$ref&id=$iDUser");
		}

	}





}else{
	echo "fail";
}
?>



