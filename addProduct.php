<?php 
session_start();
	

	//~-------------------------------------------------------------
	//~ Variables de connexion à la DB
	//~-------------------------------------------------------------
	$hostname = 'localhost';
	$username = 'root';
	$passwordDB = 'root';
	$myDataBase = 'OnlineStoreProject';

	$Commentaires_Client = "";


	//~-------------------------------------------------------------
	//~ Check si les champs ont bien été saisis
	//~-------------------------------------------------------------
	if (isset($_POST['Form-libelProduit']) && isset($_POST['Form-TypeProduit']) && isset($_POST['Form-Marque'])  && isset($_POST['Form-Quantité']) && isset($_POST['Form-PrixProduit']) && isset($_POST['Form-TVA']) && isset($_POST['Form-descriptionProduit']) && isset($_POST['Form-LienImage'])) {
			
			$libelProduit = $_POST['Form-libelProduit'];
			$TypeProduit = $_POST['Form-TypeProduit'];
			$Marque = $_POST['Form-Marque'];
			$Quantité = $_POST['Form-Quantité'];
			$PrixProduit = $_POST['Form-PrixProduit'];
			$TVA = $_POST['Form-TVA'];
			$descriptionProduit = $_POST['Form-descriptionProduit'];
			$LienImage = $_POST['Form-LienImage'];
	}

	//~-------------------------------------------------------------
	//~ Connexion à la DB
	//~-------------------------------------------------------------
	$connect=mysqli_connect($hostname,$username,$passwordDB,$myDataBase);

	if($connect){	
	
		$requeteAddProduit = "INSERT INTO Recherche_Produit (TVA,Libellé,Catégorie, Marque,Quantité,Prix,Description, Image, Commentaires_Client ) 
								VALUES(?,?,?,?,?,?,?,?,?)";

			$res=mysqli_prepare($connect,$requeteAddProduit);					
			$var=mysqli_stmt_bind_param($res,'isssidsss',$TVA, $libelProduit,$TypeProduit,$Marque, $Quantité , $PrixProduit, $descriptionProduit,$LienImage,$Commentaires_Client);

			$var=mysqli_stmt_execute($res);
					
					
			if($var==false){
				echo"echec de l'exécution de la requête.<br/>";
			}else{
				echo "string";
				header('location:manager.php?productAdded=true');
			}
								
			mysqli_stmt_close($res);

	}else{
		echo"echec de connexion  ".mysqli_connect_error()."<br/>";
	}
		



?>



