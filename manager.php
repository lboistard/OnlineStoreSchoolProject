
						<!-- Espace Affichage commentaires -->
						<div class="row">
							<div class="col-md-10 ml-auto mr-auto">

								
								<h3 class="mb-2">Vos Commentaires</h3>

								
								<hr>

								
								<?php 

										//~------------------------------------------------------------
										//~ Traitement des commentaires
										//~------------------------------------------------------------
										$requeteRecupCommentaires = "SELECT Commentaires_Client FROM Recherche_Produit WHERE Référence=$ref ";		
										$resultatRequeteRecup = mysqli_prepare($connect,$requeteRecupCommentaires);//liaison des paramètres
										$varRequeteRecup = mysqli_stmt_execute($resultatRequeteRecup);

										if($varRequeteRecup == false){
											echo "erreur requete";
										}else{
												//lecture des valeurs
											$varRequeteRecup = mysqli_stmt_bind_result($resultatRequeteRecup,$Commentaires_Client);
											
											while(mysqli_stmt_fetch($resultatRequeteRecup)){
												$commentaires_ClientProduit = $Commentaires_Client;
											}

											//Fermeture de la requete
											mysqli_stmt_close($resultatRequeteRecup);

										}


										//~------------------------------------------------------------
										//~ Récup les commentaires sans les mails
										//~------------------------------------------------------------
										function get_string_between($string, $start, $end){
										    $string = ' ' . $string;
										    $ini = strpos($string, $start);
										    if ($ini == 0) {
										    	return '';
										    }
										    $ini += strlen($start);
										    $len = strpos($string, $end, $ini) - $ini;
										    return substr($string, $ini, $len);
										}

										//~------------------------------------------------------------
										//~ Récup le dernier mot du dernier commentaire
										//~------------------------------------------------------------
										$str = "fetch the last word from me";
										$last_word_start = strrpos ( $Commentaires_Client , " ") + 1;
										$last_word_end = strlen($Commentaires_Client) - 1;
										$last_word = substr($Commentaires_Client, $last_word_start, $last_word_end);
										


										$regexMailSurComment = preg_match_all('`\w([-_.]?\w)*@\w([-_.]?\w)*\.([a-z]{2,4})`',$Commentaires_Client,$matches);									
										for ($i=0; $i <( count($matches) - 1); $i++) { 

										echo  "<strong>", $matches[0][$i] , "</strong> à commenter :  <br><br>" ;
									

										$parsed = get_string_between($Commentaires_Client, $matches[0][$i],  $matches[0][$i + 1]);


										echo $parsed; 

										if (empty($matches[0][$i + 1])) {
												$parsed = get_string_between($Commentaires_Client, $matches[0][$i], "\s*");
												echo $parsed  ; 

										}

										echo "<hr><br>";


										}

										

										$monMail = $matches[0][0];
										$monMail2 = $matches[0][1];


										$tailleMail = strlen($monMail);

										$commentaireAfficher = substr($commentaires_ClientProduit, $tailleMail + 1);






										?>
										<hr>
									</div>
								</div>