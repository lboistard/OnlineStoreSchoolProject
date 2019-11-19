<?php

/*

CETTE PAGE EST POUR LES CLIENTS

*/


$hostname = 'localhost';
$username = 'root';
$password = 'root';
$myDataBase = 'OnlineStoreProject';

	/*
		Récupération des varaiables des formalaires
	*/
		$accountGet = $_GET['createAccount'];
	
		$cookies = 'empty';
		$Type = 'Client';
		$mailExist ='false';
		$passwordExist = 'false';


	/* 
		Connection to DATABASE
	*/	
		$connect=mysqli_connect($hostname,$username,$password,$myDataBase);
		if($connect){
			echo"connexion réussite <br/>";


	/*
		Préparation de la requete de confirmation d'email
	*/

		if (isset($accountGet)) {

		
		
			if ($accountGet == '0'){
				if(isset($_POST['mailClient']) && isset($_POST['passwordClient'])){
					$Adresse_Mail_Client = $_POST['mailClient'];
					$Password_Client = md5($_POST['passwordClient']);
				}

				$requete = "SELECT Adresse_Mail, Password, Prénom, Nom from User";
				$resultat = mysqli_prepare($connect,$requete);//liaison des paramètres


				$var = mysqli_stmt_execute($resultat);
				if($var == false){
					echo"echec de l'exécution de la requête.<br/>";
				}else{

					//Association des variables de résultats
					$var = mysqli_stmt_bind_result($resultat,$Adresse_Mail, $Password, $Prénom, $Nom);//lecture des valeurs
					echo "Mail et password des personnes <br/>";

					/*
						Check si l'adresse mail existe bien à un moment où non
					*/
					while(mysqli_stmt_fetch($resultat)){
						if ($Adresse_Mail == $Adresse_Mail_Client && md5($Password) == $Password_Client) {
							$mailExist = "true";
						}
					}
					
					mysqli_stmt_close($resultat);

					if ($mailExist == 'true') {
						header("location:temp.php");
					}
					elseif($mailExist == 'false'){
						header("location:login.php?errorMessage=faux");
					}
				}			
		}


			elseif ($accountGet == '1') {

				echo "<br><br>EN 1<br>";
				/*
					On vérifie que tous est bien passé en post
				*/
				if(isset( $_POST['nomClient']) && isset($_POST['prenomClient']) && isset($_POST['mailClient']) && isset($_POST['passwordClient']) && isset($_POST['telephoneClient']) && isset($_POST['adresseClient']) && isset($_POST['codePostalClient'])){

						$Nom_Client = $_POST['nomClient'];
						$Prenom_Client = $_POST['prenomClient'];
						$Adresse_Mail_Client_Create = $_POST['mailClient'];
						$Password_Client_Create = md5($_POST['passwordClient']);
						$Telephone_Client = $_POST['telephoneClient'];
						$Adresse_Client = $_POST['adresseClient'];
						$CodePostal_Client = $_POST['codePostalClient'];
					}
			
					echo "Nom client is : " , $Adresse_Client  ," ","<br><br>";


					$req="INSERT INTO User (Nom,Prénom,Adresse_Mail,Password, Téléphone,Adresse_Client,Code_Postal,Cookies, Type ) 
					VALUES(?,?,?,?,?,?,?,?,?)";

					//Préparationdelarequête					
					$res=mysqli_prepare($connect,$req);
					
					//liaisondesparamètres
					$var=mysqli_stmt_bind_param($res,'ssssisiss',$Nom_Client,$Prenom_Client,$Adresse_Mail_Client_Create, $Password_Client_Create , $Telephone_Client, $Adresse_Client,$CodePostal_Client, $cookies ,$Type );



					$var=mysqli_stmt_execute($res);//exécutiondelarequête
					
					
					if($var==false){
						echo"echec de l'exécution de la requête.<br/>";
					}
					else{
						echo"Personne est enregistrée<br/>";
					}
					mysqli_stmt_close($res);
				

			}

		}else{
			echo"echec de connexion  ".mysqli_connect_error()."<br/>";
		}

	}
	
	if(mysqli_close($connect))
		echo"deconnexion réussite<br/>";
	
	else
		echo"echec de deconnexion"."<br/>";



	
	

	?>
