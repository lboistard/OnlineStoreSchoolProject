<!doctype html>
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

<script>
  $(function() {

    //Formulaire client 
    $('#client-link').click(function(e) {
      $("#client-form").delay(100).fadeIn(100);
      $("#manager-form").fadeOut(100);
      $('#manager-link').removeClass('active');
      $(this).addClass('active');
      e.preventDefault();
    });

    //formulaire manager
    $('#manager-link').click(function(e) {
      $("#manager-form").delay(100).fadeIn(100);
      $("#client-form").fadeOut(100);
      $('#client-link').removeClass('active');
      $(this).addClass('active');
      e.preventDefault();
    });
  });

</script>



<div class="container">

  <div class="py-3 text-center">
    <a href="index.php"> <img class="d-block mx-auto mb-2" src="Images/SPI.png" alt="" width="170" height="170"></a>

    <h2><strong>Créer</strong> votre compte !</h2>
    <p class="lead">Veuillez renseignez tous les champs ci-dessous en respectant bien les consignes</p>
  </div>

  <div class="row">
    <div class="col-md-7 ml-auto mr-auto">
      <div class="panel panel-login">
        <div class="panel-heading">

          <div class="row">
            <div class="col-md-6   btn-group btn-group-toggle mx-auto mb-2">
              <a  class="btn btn-outline-dark" href="#" class=" active" id="client-link" >Client</a>
            </div>

            <div class="col-md-6   btn-group btn-group-toggle mx-auto mb-2">
              <a  class="btn  btn-outline-dark" href="#" id="manager-link">Manager</a>
            </div>
          </div>
          <hr>




        </div>

        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">

              <form id="client-form" action="http://phpoll.com/login/process" method="post" role="form" style="display: block;">

                <!-- Nom et Prénom du client -->
                <div class="row">
                  <div class="form-group col-md-6">
                    <input type="text" name="nomClient" id="nomClient" class="form-control" placeholder="Nom">
                  </div>
                  <div class="form-group col-md-6 text-center">
                    <input type="text" name="prenomClient" id="prenomClient"  class="form-control" placeholder="Prénom">
                  </div>
                </div>


                <!-- Adresse mail du client -->
                <div class="form-group">

                  <input type="mail" name="mailClient" id="mailClient" class="form-control" placeholder="Adresse Mail">
                </div>

                <!-- Password du client -->
                <div class="form-group">
                  <input type="password" name="passwordClient" id="passwordClient" class="form-control" placeholder="Mot de Passe">
                </div>


                <!-- Téléphone du Client -->
                <div class="form-group">
                  <input type="tel" name="telephoneClient" id="telephoneClient"  class="form-control" placeholder="Téléphone">
                </div>

                <!-- Adresse_Client et Code Postal Client-->
                <div class="row">
                  <div class="form-group col-md-8">
                    <input type="text" name="adresseClient" id="adresseClient"  class="form-control" placeholder="Adresse Postal">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="number" name="codePostalClient" id="codePostalClient"  class="form-control" placeholder="Code Postal">
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






            <form id="manager-form" action="http://phpoll.com/register/process" method="post" role="form" style="display: none;">




              <!-- Nom et Prénom du Manager -->
              <div class="row">
                <div class="form-group col-md-6">
                  <input type="text" name="nomClient" id="nomClient" tabindex="1" class="form-control" placeholder="Nom" value="">
                </div>
                <div class="form-group col-md-6 text-center">
                  <input type="text" name="prenomClient" id="prenomClient" tabindex="2" class="form-control" placeholder="Prénom">
                </div>
              </div>
              

              <!-- Adresse mail du Manager -->
              <div class="form-group">

                <input type="mail" name="mailClient" id="mailClient" tabindex="2" class="form-control" placeholder="Adresse Mail">
              </div>

              <!-- Password du Manager -->
              <div class="form-group">
                <input type="password" name="passwordClient" id="passwordClient" tabindex="2" class="form-control" placeholder="Mot de Passe">
              </div>

              <hr>
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

