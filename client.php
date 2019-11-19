<?php

session_start();

		/*
			Variables de connection à la BDD
		*/
			$hostname = 'localhost';
			$username = 'root';
			$password = 'root';


		/*
			Déclaration des varaiables
		*/
			$accountGet = $_GET['createAccount'];
			$cookies = 'empty';
			$Type = 'Client';




		/* 
			Connection to DATABASE
		*/	

		try {
			$bdd = new PDO("mysql:host=$hostname;dbname=OnlineStoreProject", $username, $password);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}



		/*

			Query la table User si le parametres create account = '0'
		
		*/
		if (isset($accountGet)) {

			/*
				Check si le mail et le pswd existe pour le login
			*/
				if(isset($_POST['emailClient']) && isset($_POST['passwordClient'])){

					$Adresse_Mail_Client = $_POST['emailClient'];
					$Password_Client = md5($_POST['passwordClient']);

				}


				/*
					Lecture de la BDD
				*/
				if ($accountGet == '0') {

					//entité de Query
					$Query = $bdd->prepare('SELECT * FROM User');
					$Query->execute(array($Adresse_Mail_Client, $Password_Client));

					
				

				
					$QueryData = $Query->fetch();

					while ($QueryData = $Query->fetch())
					{
						$mailDB = $QueryData['Adresse_Mail'];
						$passwordDB = $QueryData['Password'];

						echo $mailDB ,'<br>';

						if ($Adresse_Mail_Client  == $mailDB  && $Password_Client == $passwordDB){
							echo 'user : ', $Adresse_Mail_Client, ' with password : ', $Password_Client , ' is an existing user';
						}
						else{

							header("location:login.php?errorMessage=faux");
						}
						
					} 

					
			/*
				Update la table si create account ='1'
			*/
			}elseif ($accountGet == '1') {
				
				/*
					Check si tous les champs ont bien été saisis
				*/

					if(isset( $_POST['nomClient']) && isset($_POST['prenomClient']) && isset($_POST['emailClient']) && isset($_POST['passwordClient']) && isset($_POST['telephoneClient']) && isset($_POST['adresseClient']) && isset($_POST['codePostalClient'])){

						$Nom_Client = $_POST['nomClient'];
						$Prenom_Client = $_POST['prenomClient'];
						$Adresse_Mail_Client_Create = $_POST['emailClient'];
						$Password_Client_Create = md5($_POST['passwordClient']);
						$Telephone_Client = $_POST['telephoneClient'];
						$Adresse_Client = $_POST['adresseClient'];
						$CodePostal_Client = $_POST['codePostalClient'];

						echo "<br>USER parametres ; <br> ".
						$Nom_Client
						. " :<br> " . $Prenom_Client
						. " :<br> " . $Adresse_Mail_Client_Create
						. " :<br> " . $Password_Client_Create
						. " :<br> " . $Telephone_Client
						. " :<br> " . $Adresse_Client
						. " :<br> " . $CodePostal_Client;

					}

					/*
						Commande d'update de DB
					*/
						$bdd->exec("INSERT INTO User(Nom, Prénom, Adresse_Mail, Téléphone, Adresse_Client, Code_Postal, Password, Cookies, Type) 
							VALUES('$Nom_Client','$Prenom_Client', '$Adresse_Mail_Client_Create', '$Telephone_Client', '$Adresse_Client', '$CodePostal_Client' ,'$Password_Client_Create', '$Cookies', '$Type')");

						$add_To_DB->execute();
					}
				}else{
					echo "can't reach the request";
				}



				$reponse->closeCursor(); 

				?>

