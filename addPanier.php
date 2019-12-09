<?php 
	session_start();

	//~--------------------------------------------------------------------
	//~	Déclaration des Variables 
	//~--------------------------------------------------------------------
	$ref = $_GET['ref'];
	$Id = $_SESSION['idClientSession'];

	

	//~--------------------------------------------------------------------
	//~ Connexion to DataBase
	//~--------------------------------------------------------------------
	$hostname = 'localhost';
	$username = 'root';
	$password = 'root';
	$myDataBase = 'OnlineStoreProject';


	$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

	if($connect){	
		
		//~--------------------------------------------------------------------
		//~ Récup des élements de Panier dans la table User
		//~--------------------------------------------------------------------
		$requeteRecupPanier = "SELECT Panier From User WHERE Id = $Id";
		$resultatRecupPanier = mysqli_prepare($connect,$requeteRecupPanier);//liaison des paramètres

		$var = mysqli_stmt_execute($resultatRecupPanier);
		if($var == false){
			echo "echec en requete";
		}else{				
			$var = mysqli_stmt_bind_result($resultatRecupPanier, $Panier);					
			while(mysqli_stmt_fetch($resultatRecupPanier)){			
				$panAvantAjout =  $Panier;						
			}
			
			mysqli_stmt_close($resultatRecupPanier);
		}	


		//~--------------------------------------------------------------------
		//~ Récup des élements de Panier dans la table User
		//~--------------------------------------------------------------------
		if ($panAvantAjout == "empty") {
			$requeteUpdateParamClient="UPDATE User SET Panier = '$ref' WHERE Id='$Id' ";
			$resultatUpdate=mysqli_query($connect,$requeteUpdateParamClient);

		
			mysqli_stmt_close($resultatUpdate);
		}else{
			//concat avant apres
			$panierFinal = $panAvantAjout.$ref;
			$requeteUpdateParamClient="UPDATE User SET Panier = '$panierFinal' WHERE Id='$Id' ";
			$resultatUpdate=mysqli_query($connect,$requeteUpdateParamClient);

		
			mysqli_stmt_close($resultatUpdate);
		}

		header("location:Client.php");
		

	}else{
		echo "echec";
	}
 ?>								