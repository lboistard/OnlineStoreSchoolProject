<?php 
	
	session_start();
	//~-------------------------------------------------------------
	//~ Déclaration des variables
	//~-------------------------------------------------------------
	$userExist ='false';
	$typeIsManager = 'false';

	//~-------------------------------------------------------------
	//~ Variables de connexion à la DB
	//~-------------------------------------------------------------
	$hostname = 'localhost';
	$username = 'root';
	$passwordDB = 'root';
	$myDataBase = 'OnlineStoreProject';


	//~-------------------------------------------------------------
	//~ Check si les champs ont bien été saisis
	//~-------------------------------------------------------------
	if(isset($_POST['mailManager']) && isset($_POST['passwordManager'])){

		$Adresse_Mail_Manager = $_POST['mailManager'];
		$uncryptedPass = $_POST['passwordManager'];
		$Password_Manager = md5($_POST['passwordManager']);

		$_SESSION['emailManagerSession'] = $_POST['mailManager'];

	}else{
		echo "remplir les champs";
	}

	//~-------------------------------------------------------------
	//~ Connexion à la DB
	//~-------------------------------------------------------------
	$connect=mysqli_connect($hostname,$username,$passwordDB,$myDataBase);

	if($connect){	
		
		//~-------------------------------------------------------------
		//~ Regarde si le mail saisi existe, si non on revoit une erreur
		//~-------------------------------------------------------------
		$requeteUserExist = "SELECT Adresse_Mail, Password from User";
		$resultat = mysqli_prepare($connect,$requeteUserExist);//liaison des paramètres

		$var = mysqli_stmt_execute($resultat);
		if($var == false){
			echo"echec de l'exécution de la requête.<br/>";
		}else{
			$var = mysqli_stmt_bind_result($resultat,$Adresse_Mail, $Password);//lecture des valeurs							
			while(mysqli_stmt_fetch($resultat)){							
				if ($Adresse_Mail == $Adresse_Mail_Manager && $Password == $Password_Manager) {
					$userExist = "true";
					$_SESSION['mailManager'] = $Adresse_Mail ;
				}
			}
		}
		mysqli_stmt_close($resultat);

		$requeteTypeIsOK = "SELECT Type FROM User WHERE Adresse_Mail='$Adresse_Mail_Manager'";
		$resultatTypeIsOK = mysqli_prepare($connect,$requeteTypeIsOK);//liaison des paramètres
		$varTypeIsOK = mysqli_stmt_execute($resultatTypeIsOK);
		
		if($varTypeIsOK == false){
			echo"echec de l'exécution de la requête.<br/>";
		}else{
			$varTypeIsOK = mysqli_stmt_bind_result($resultatTypeIsOK,$Type);//lecture des valeurs							
			while(mysqli_stmt_fetch($resultatTypeIsOK)){							
				
				if ( $Type == 'Manager') {
					echo "OK";
					$typeIsManager = 'true';
					setcookie("mailManager",$Adresse_Mail_Manager,time()+3600*24*7);
					setcookie("passwordManager",$uncryptedPass,time()+3600*24*7);

				}else{
					echo "not manager";
				}

			}

		}

		mysqli_stmt_close($resultatTypeIsOK);

		if ($userExist == 'true' && $typeIsManager == 'true') {

			

			header("location:manager.php");

		}elseif ($userExist == 'true' && $typeIsManager == 'false') {			
			//message d'erreur : vous n'etes pas manager
			header("location:login.php?typeManager=faux");

			
		}
		elseif ($userExist == 'false') {
			//message d'erreur : vous n'etes pas user
			header("location:login.php?errorMessage=faux");
			
		}

		//si user existe et type manager == page maanger

		//si user existe mais pas manager == message pas manager

		// si user existe pas == message erreur dans login.php

	}else{
		echo"echec de connexion  ".mysqli_connect_error()."<br/>";
	}

?>