<?php 

session_start();

	//~--------------------------------------------------------------------
	//~ Variables de Session / POST /GET
	//~--------------------------------------------------------------------
$Nom = $_SESSION['nomClientSession'];
$Prénom = $_SESSION['prenomClientSession'];
$Id = $_SESSION['idClientSession'];
$userExist = "false";
$RéponseManager = "";

if (isset($_POST['prénomClient']) && isset($_POST['nomClient']) && isset($_POST['textComment'])) {

	$prénomClient = $_POST['prénomClient'];
	$nomClient = $_POST['nomClient'];
	$commentaireUser = $_POST['textComment'];
}

	//si rien n'est saisis dans l'espace commentaire
if (empty($commentaireUser)) {
	header("location:commentaireUser.php?noComment=true");
}

	//~--------------------------------------------------------------------
	//~ Variables connexion à la BDD
	//~--------------------------------------------------------------------
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$myDataBase = 'OnlineStoreProject';


$connect=mysqli_connect($hostname,$username,$password,$myDataBase);

if($connect){

		//~--------------------------------------------------------------------
		//~ Variables connexion à la BDD
		//~--------------------------------------------------------------------
	$requeteCompareToUser ="SELECT Nom,Prénom FROM User WHERE Id=$Id";

	$resultatCompareToUser = mysqli_prepare($connect,$requeteCompareToUser);


	$varCompareToUser = mysqli_stmt_execute($resultatCompareToUser);
	
	if($varCompareToUser == false){
		echo"echec de l'exécution de la requête.<br/>";
	}else{							
		$varCompareToUser = mysqli_stmt_bind_result($resultatCompareToUser,$Prénom, $Nom);			
		while(mysqli_stmt_fetch($resultatCompareToUser)){							
			
			//si les datas sont ok, on peut passer au post du commentaires
			if ($Prénom == $prénomClient && $Nom == $nomClient) {
				$userExist = "true";
			}
		}

		mysqli_stmt_close($resultatCompareToUser);

		if ($userExist == 'true') {

			

			$requeteAjoutCommentaire="INSERT INTO Commentaires_Produit (Commentaires,IdUser,NomUser,PrenomUser, RéponseManager) 
			VALUES(?,?,?,?,?)";

			$resultAjoutComm=mysqli_prepare($connect,$requeteAjoutCommentaire);					

								//bind des résultat de la requete
			$var=mysqli_stmt_bind_param($resultAjoutComm,'sisss',$commentaireUser,$Id,$prénomClient, $nomClient , $RéponseManager);

			$varAjoutComm=mysqli_stmt_execute($resultAjoutComm);


			if($varAjoutComm==false){
				echo"echec de l'exécution de la requête.<br/>";
			}else{
				
				header("location:commentaireUser.php?commentAdded=true");
			}

			mysqli_stmt_close($resultAjoutComm);


		
		}
		elseif($userExist == 'false'){

			header("location:commentaireUser.php?fauxUser=true");
		}
	}


}else{
	echo 'echec';
}





?>