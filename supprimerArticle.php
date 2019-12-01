<?php 
session_start(); 


	//récup variables de session pour la ref produit
	$ref = $_SESSION['ref'];

		//connect to DB
	$hostname = 'localhost';
	$username = 'root';
	$password = 'root';
	$myDataBase = 'OnlineStoreProject';

	$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

	if($connect){
		echo "sucess";
		$requeteDelete ="DELETE FROM Recherche_Produit WHERE Référence= ? ";
		$res=mysqli_prepare($connect,$requeteDelete);

		$var=mysqli_stmt_bind_param($res,'i',$ref);

		$var=mysqli_stmt_execute($res);

		if($var==false){
			echo"echec de l'exécution de la requête.<br/>";
		}else{
			echo"Article est supprimée<br/>";

			mysqli_stmt_close($res);
		}


		header("location:manager.php");
	}else{


	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>
		TEST SUPPR
	</title>
</head>
<body>

</body>
</html>