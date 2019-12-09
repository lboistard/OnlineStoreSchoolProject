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


if (isset($_POST['idCommentaires'])) {
		# code...
	$idComment = $_POST["idCommentaires"];
	
	
}



//~-------------------------------------------------------------
//~ Connexion à la DataBase
//~-------------------------------------------------------------		
$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

if($connect){

		$requeteDelComment="DELETE FROM Commentaires_Produit WHERE `Id` =  $idComment";

		$resultDelComment=mysqli_query($connect,$requeteDelComment);

		
		mysqli_stmt_close($resultDelComment);

		if($resultDelComment==false){
			echo"Echec de l'exécution de la requête";
		}else{

			//header("location : actionOnComment.php");
			header("location:nosClients.php?comSuppr=true");
		}	


	}else{
		echo "echec";
	} ?>




