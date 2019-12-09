<?php 
session_start();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8">
  
  <link rel="stylesheet" type="text/css" href="log.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

  <title>Création de Votre Espace Utilisateur</title>
</head>

<div class="container">
  <div class="py-3 text-center">
    <a href="index.php"> <img class="d-block mx-auto mb-2" src="Images/SPI.png" alt="" width="170" height="170"></a>
    <h2><strong>Créer</strong> votre compte <strong>Client</strong> !</h2>
    <p class="lead mb-0">Veuillez renseignez tous les champs ci-dessous en respectant bien les consignes</p>
  </div>

  <?php 
      //~-----------------------------------------------------------------
      //~ Message d'erreur quand les deux passwords saisis sont différents
      //~-----------------------------------------------------------------
      if (isset($_GET['wrongPassword'])) {
        if ($_GET['wrongPassword'] == "faux") {
          echo "<div class=\"alert alert-warning alert-dismissible fade show col-md-6 ml-auto mr-auto text-center\">
          Les deux <strong>Mot de Passe</strong> saisis sont diffénts
          </div>";
        }
      }

      if (isset($_GET['allreadyUsed'])) {
        if ($_GET['allreadyUsed'] == "true") {
          echo "<div class=\"alert alert-warning alert-dismissible fade show col-md-6 ml-auto mr-auto text-center\">
          Votre <strong>Mail</strong> est déjà affilié à un compte !
          </div>";
        }
      }

  ?>
  <div class="row">
    <div class="col-md-7 ml-auto mr-auto">
      <div class="panel panel-login">        
        <div class="panel-heading">      
          <hr>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form id="client-form" action="clientRequest.php?createAccount=1" method="POST" role="form" style="display: block;">
                <!-- Nom et Prénom du client -->
                <div class="row">
                  <div class="form-group col-md-6">
                    <input type="text" minlength="2" name="nomClient" id="nomClient" class="form-control" placeholder="Nom" required>
                  </div>
                  <div class="form-group col-md-6 text-center">
                    <input type="text" minlength="2" name="prenomClient" id="prenomClient"  class="form-control" placeholder="Prénom" required>
                  </div>
                </div>
                <!-- Adresse mail du client -->
                <div class="form-group">
                  <input type="mail" name="mailClient" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" id="mailClient" class="form-control" placeholder="Adresse Mail" required>
                </div>
                <!-- Password du client -->
                <div class="form-group">
                  <input type="password" name="passwordClient" minlength="8" id="passwordClient" class="form-control" placeholder="Mot de Passe" required>
                </div>
                <!-- On Redemande le password du client -->
                <div class="form-group">
                  <input type="password" name="passwordAgainClient" minlength="8" id="passwordAgainClient" class="form-control" placeholder="Saisissez à nouveau votre Mot de Passe" required>
                </div>
                <!-- Téléphone du Client -->
                <div class="form-group">
                  <input type="tel" name="telephoneClient" id="telephoneClient" pattern="0[0-9]{1}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" class="form-control" placeholder="Téléphone" required>
                </div>
                <!-- Adresse_Client et Code Postal Client-->
                <div class="row">
                  <div class="form-group col-md-8">
                    <input type="text" name="adresseClient" id="adresseClient"  class="form-control" placeholder="Adresse Postal" required>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="number" name="codePostalClient" min="4" max="5" pattern="[0-9]{5}" id="codePostalClient"  class="form-control" placeholder="Code Postal" required>
                  </div>
                </div>
                <hr>
                <!-- Confirmation -->
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                     <button class="btn btn-outline-dark btn-lg btn-block" type="submit">
                      Créer mon compte
                    </button>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6 ml-auto mr-auto text-center">
                    <a href="login.php">Déjà inscrit ?</a>
                  </div>
                </div>
              </div>
            </form>            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>