<?php session_start();


//~-------------------------------------------------------------
//~ Variables de SESSION
//~-------------------------------------------------------------	
 $newComment = " ";


//~-------------------------------------------------------------
//~ Variables de connexion à la DB
//~-------------------------------------------------------------	
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$myDataBase = 'OnlineStoreProject';


if (isset($_POST['idRep'])) {
		# code...
	$idUserDelete = $_POST["idRep"];
	$_SESSION['IdUserResponse'] = $idUserDelete;
	
}



//~-------------------------------------------------------------
//~ Connexion à la DataBase
//~-------------------------------------------------------------		
$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

if($connect){

		$requeteDelComment="UPDATE User SET Commentaires_Produit = '$newComment' WHERE Id=$idUserDelete";

		$resultDelComment=mysqli_query($connect,$requeteDelComment);

		
		mysqli_stmt_close($resultDelComment);

		if($resultDelComment==false){
			echo"Echec de l'exécution de la requête";
		}else{
			header("location:nosClients.php?comSuppr=true");
		}	


	}else{
		echo "echec";
	} ?>

