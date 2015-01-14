<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FaireFace - <?php echo $titre ?></title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/faireface.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-faireface-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
          <img alt="Brand" src="/images/faireface.png" height="20" />
        </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-faireface-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="/alertes">Alertes<!--  <sup><span class="badge">420</span></sup> --></a></li>
          <li><a href="/nouvelles">Nouvelles<!--  <sup><span class="badge">42</span></sup> --></a></li>
          <li><a href="/capsules">Capsules<!--  <sup><span class="badge"></span></sup> --></a></li>
          <li><a href="/plan">Plan Familial</a></li>
          <li><a href="/sinistres">Sinistres<!--  <sup><span class="badge">4</span></sup> --></a></li>
          <?php
            if (Auth::check() && Auth::User()->niveau == 99)
            {
              print ("<li><a href=\"/utilisateurs/\">Utilisateurs</a></li>");
            }
          ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php if(Auth::check()){?>
          <p class="navbar-text"><?= Auth::user()->nom ?></p>
          <li><a href="/deconnexion/">Déconnexion</a></li>          
          <?php }else{?>
          <li><a href="#" data-toggle="modal" data-target="#connexionModal">Connexion</a></li>
          <?php }?>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <?php
  $event = Session::pull('evenement');
  if($event)
  {
    ?>
      <?php
      $al = array();
      if($event['reussi']) {
        $al['class'] = 'alert-success';
      } else {
        $al['class'] = 'alert-danger';
      }
        ?>
        <div class="container alert <?= $al['class'] ?> fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <?= $event['message'] ?>
        </div>
    <?php
  }?>
  <?php echo $contenu ?>
  <footer class="text-center">
    <div>Faire<i>Face</i>, une application formidable.</div>
    <div>®2015 Équipe tamia</div>
  </footer>
    <!-- Fenêtre modal de visionnement d'images -->
    <div class="modal fade" id="connexionModal" tabindex="-1" role="dialog" aria-labelledby="connexionModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="connexionModalLabel">Comptes</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <form class="form-horizontal" accept-charset="UTF-8" action="/connexion/" method="POST">
                  <fieldset>

                    <!-- Form Name -->
                    <legend>Connexion</legend>

                    <!-- Text input-->
                    <div class="control-group">
                      <label class="control-label" for="nomUtilisateur">Nom d'utilisateur</label>
                      <div class="controls">
                        <input id="nomUtilisateur" name="nomUtilisateur" type="text" placeholder="Nom d'utilisateur" class="form-control" required="required">
                        
                      </div>
                    </div>

                    <!-- Password input-->
                    <div class="control-group">
                      <label class="control-label" for="motPasse">Mot de passe</label>
                      <div class="controls">
                        <input id="motPasse" name="motPasse" type="password" placeholder="Mot de passe" class="form-control" required="required">
                        
                      </div>
                    </div>

                    <!-- Button -->
                    <div class="control-group">
                      <label class="control-label" for="btnSubmit"></label>
                      <div class="controls">
                        <button id="btnSubmit" name="btnSubmit" class="btn btn-primary">Connexion</button>
                      </div>
                    </div>

                  </fieldset>
                </form>
              </div>
              <!-- Inscription-->
              <div class="col-md-6">
                <form class="form-horizontal" accept-charset="UTF-8" action="/inscription/" method="POST">
                  <fieldset>

                    <!-- Form Name -->
                    <legend>Inscription</legend>

                    <!-- Text input-->
                    <div class="control-group">
                      <label class="control-label" for="txtNom">Nom complet</label>
                      <div class="controls">
                        <input id="txtNom" name="txtNom" type="text" placeholder="Nom complet" class="form-control" required="required">
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                      <label class="control-label" for="txtUtilisateur">Nom d'utilisateur</label>
                      <div class="controls">
                        <input id="txtUtilisateur" name="txtUtilisateur" type="text" placeholder="Nom d'utilisateur" class="form-control" required="required">
                      </div>
                    </div>

                    <!-- Password input-->
                    <div class="control-group">
                      <label class="control-label" for="txtMotPasse">Mot de passe</label>
                      <div class="controls">
                        <input id="txtMotPasse" name="txtMotPasse" type="password" placeholder="Mot de passe" class="form-control" required="required">
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                      <label class="control-label" for="txtEmail">Adresse courriel</label>
                      <div class="controls">
                        <input id="txtEmail" name="txtEmail" type="text" placeholder="Courriel" class="form-control" required="required">
                      </div>
                    </div>

                    <!-- Button -->
                    <div class="control-group">
                      <label class="control-label" for="btnInscription"></label>
                      <div class="controls">
                        <button id="btnInscription" name="btnInscription" class="btn btn-primary">Inscription!</button>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Fenêtre modal de visionnement d'images -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/faireface.js"></script>
  </body>
</html>