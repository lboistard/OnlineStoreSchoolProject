<?php
session_start();

		//~-------------------------------------------------------------
		//~ Variables de SESSION 
		//~-------------------------------------------------------------
		$accountGet = $_GET['createAccount'];
		$cookies = 'empty';
		$Type = 'Client';
		$mailExist ='false';
		$passwordExist = 'false';
		$Commentaires_Produit = " ";
		$mailIsAllreadyUsed ="" ;
		$createAccountOK ="";
	
		//~-------------------------------------------------------------
		//~ Connexion à la DB
		//~-------------------------------------------------------------
		$hostname = 'localhost';
		$username = 'root';
		$passwordDB = 'root';
		$myDataBase = 'OnlineStoreProject';

		$connect=mysqli_connect($hostname,$username,$passwordDB,$myDataBase);
		
		if($connect){	
			if (isset($accountGet)) {

				//~-------------------------------------------------------------
				//~ Login
				//~-------------------------------------------------------------
				if ($accountGet == '0'){	

					//~----------------------------------
					//~ Set les variables saisis via POST
					//~----------------------------------
					if(isset($_POST['mailClient']) && isset($_POST['passwordClient'])){

						$Adresse_Mail_Client = $_POST['mailClient'];
						$Password_Client = md5($_POST['passwordClient']);		
					}

					//Requete qui récupère certains params de la table User
					$requete = "SELECT Adresse_Mail, Password, Prénom, Nom from User";
					$resultat = mysqli_prepare($connect,$requete);


					$var = mysqli_stmt_execute($resultat);
					if($var == false){
						echo"echec de l'exécution de la requête.<br/>";
					}else{				
						
						// Liaison des valeurs de la requete à des variables
						$var = mysqli_stmt_bind_result($resultat,$Adresse_Mail, $Password, $Prénom, $Nom);
					
						//~-------------------------------------------------------------
						//~ Regarde si le mail saisi existe, si non on revoit une erreur
						//~-------------------------------------------------------------
						while(mysqli_stmt_fetch($resultat)){							
							if ($Adresse_Mail == $Adresse_Mail_Client && $Password == $Password_Client) {
								$mailExist = "true";
								
								//Set des variables de session
								$_SESSION['emailClientSession'] = $_POST['mailClient'];
								$_SESSION['nomClientSession'] = $Nom ;
								$_SESSION['prenomClientSession']= $Prénom;
							}
						}

						mysqli_stmt_close($resultat);

						if ($mailExist == 'true') {
							header("location:Client.php");
						}
						elseif($mailExist == 'false'){
							header("location:login.php?errorMessage=faux");
						}
					}			
				}

				//~-------------------------------------------------------------
				//~ Création d'un compte
				//~-------------------------------------------------------------
				elseif ($accountGet == '1') {

						if(isset( $_POST['nomClient']) && isset($_POST['prenomClient']) && isset($_POST['mailClient']) && isset($_POST['passwordClient']) && isset($_POST['telephoneClient']) && isset($_POST['adresseClient']) && isset($_POST['codePostalClient']) && isset($_POST['passwordAgainClient'])){

							$Nom_Client = $_POST['nomClient'];
							$Prenom_Client = $_POST['prenomClient'];
							$Adresse_Mail_Client_Create = $_POST['mailClient'];
							$Password_Client_Create = md5($_POST['passwordClient']);
							$Password_Again_Client_Create = md5($_POST['passwordAgainClient']);
							$Telephone_Client = $_POST['telephoneClient'];
							$Adresse_Client = $_POST['adresseClient'];
							$CodePostal_Client = $_POST['codePostalClient'];

							if ($Password_Client_Create == $Password_Again_Client_Create) {
								
							}else{
								header('location:createAccount.php?wrongPassword=faux');
							}
						}

						//~-------------------------------------------------------------
						//~ Vérification qu'aucun compte similaire n'existe pas
						//~-------------------------------------------------------------
						$requete_UserAllreadyExist = "SELECT Adresse_Mail from User";
						$resultat_UserAllreadyExist = mysqli_prepare($connect,$requete_UserAllreadyExist);//liaison des paramètres
						$var_UserAllreadyExist = mysqli_stmt_execute($resultat_UserAllreadyExist);

						if($var_UserAllreadyExist == false){
							echo"echec de l'exécution de la requête.<br/>";
						}
						else{

							$var = mysqli_stmt_bind_result($resultat_UserAllreadyExist,$Adresse_Mail);//lecture des valeurs
					
							//~-------------------------------------------------------------
							//~ Regarde si le mail saisi existe, si OUI on revoit une erreur
							//~-------------------------------------------------------------
							while(mysqli_stmt_fetch($resultat_UserAllreadyExist)){							
								if ($Adresse_Mail == $Adresse_Mail_Client_Create) {
									$mailIsAllreadyUsed = "true";
								}
							}

							mysqli_stmt_close($resultat_UserAllreadyExist);



							//~--------------------------------------------------------------------
							//~ Si user n'existe pas on lui créer un compte via une requete préparé
							//~--------------------------------------------------------------------
							if ($mailIsAllreadyUsed == "true") {
								header('location:createAccount.php?allreadyUsed=true');
							}else{	
								
								//requete préparé
								$requestCreateAccount="INSERT INTO User (Nom,Prénom,Adresse_Mail,Password, Téléphone,Adresse_Client,Code_Postal,Commentaires_Produit, Cookies, Type ) 
								VALUES(?,?,?,?,?,?,?,?,?,?)";

								$resultCreateAccount=mysqli_prepare($connect,$requestCreateAccount);					
								
								//bind des résultat de la requete
								$var=mysqli_stmt_bind_param($resultCreateAccount,'ssssisisss',$Nom_Client,$Prenom_Client,$Adresse_Mail_Client_Create, $Password_Client_Create , $Telephone_Client, $Adresse_Client,$CodePostal_Client,$Commentaires_Produit, $cookies ,$Type );

								$var=mysqli_stmt_execute($resultCreateAccount);
					
					
								if($var==false){
									echo"echec de l'exécution de la requête.<br/>";
								}else{
									$createAccountOK ='true';
								}
								
								mysqli_stmt_close($resultCreateAccount);

								//~--------------------------------------------------------------------
								//~ Si user créer on définit des variables de Session = redirect
								//~--------------------------------------------------------------------
								if ($createAccountOK == 'true') {
									//Set des variables de session
									$_SESSION['emailClientSession'] = $Adresse_Mail_Client_Create;
									$_SESSION['nomClientSession'] = $Nom_Client ;
									$_SESSION['prenomClientSession']= $Prenom_Client;

									//redirect vers page client
									header("location:Client.php");
								}
							}
						}
				}
			}else{
				echo"echec de connexion  ".mysqli_connect_error()."<br/>";
			}
		}
		if(mysqli_close($connect)){
			
		}

		else{
			echo"echec de deconnexion"."<br/>";
		}

?>
