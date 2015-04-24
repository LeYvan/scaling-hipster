<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <title>FaireFace - <?php echo $titre ?></title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/bootstrap-theme.css" rel="stylesheet">
    <link href="/css/faireface.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body data-spy="scroll" data-target="#menu-cote-ressources">
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
          <img class="hidden-sm" alt="FaireFace" src="/images/faireface.png" height="20" />
          <img class="visible-sm-block" alt="FaireFace" src="/images/faireface-sm.png" height="20" />
        </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-faireface-navbar-collapse-1">
        <ul class="nav navbar-nav">
        <?php
        $menu = array(
            array('titre'=>'Alertes', 'href'=>'/alertes/'),
            array('titre'=>'Nouvelles', 'href'=>'/nouvelles/'),
            array('titre'=>'Capsules', 'href'=>'/capsules/'),
            array('titre'=>'Plan Familial', 'href'=>'/plan/'),
            array('titre'=>'Sinistres', 'href'=>'/sinistres/'),
            array('titre'=>'Ressources', 'href'=>'/ressources/')
          );
            if (Auth::check() && Auth::User()->niveau == 99)
            {
              unset($menu[3]);
              array_push($menu, array('titre'=>'Utilisateurs', 'href'=>'/utilisateurs/'));
            }
          foreach ($menu as $element) {?>
            <li <?= $titre == $element['titre']?'class="active"':''?>><a href="<?= $element['href'] ?>"><?= $element['titre'] ?></a></li>
          <?php }
?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php if(Auth::check()){?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= Auth::user()->nom ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="/profile/">Mon compte</a></li>
              <li><a href="/deconnexion/">Déconnexion</a></li>
            </ul>
          </li>
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
  }
  ?>
  <?php
// Avoir une variable nommée "jumbo" ayant une valeur true pour afficher le jumbo
  if(!empty($jumbo)){?>
<div class="jumbotron jumbo">
  <div class="container">
    <?php if(!empty($erreur)){
      ?>
      <!-- Affichage des erreurs HTTP -->
        <!-- Avoir dans les paramètres le numéro de l'erreur avec un message associé -->
        <h1 class="nom-faireface">Erreur<span class="face"><?= $errNo ?></span></h1>
        <p><?= $message ?></p>
      <?php
      }else{ ?>
      <h1 class="nom-faireface">FAIRE<span class="face">FACE</span></h1>
      <p>Aux dangers. Aux problèmes. À la situation.</p>
      <!-- <p>Planifier. Informer. Alerter.</p> -->
      <?php }?>
    </div>
</div>
<?php }
  ?>
  <div class="container <?php if (isset($classe)) echo $classe;?>" id="page">
    <div><div>
    <?php echo $contenu ?>
    <footer class="text-center">
      <div>Faire<i>Face</i>, une application formidable.</div>
      <div>©&#8239;Équipe Tamia, 2015</div>
      <p>
        <a href="/Aide_en_ligne.pdf" target="aide-en-ligne-pdg">Télécharger le document PDF d'aide en ligne.</a>
      </p>
    </footer>
  </div>
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
                        <input id="nomUtilisateur" name="nomUtilisateur" type="text" autofocus="autofocus" placeholder="Nom d'utilisateur" class="form-control" required="required">

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
    <script src="/js/jquery.validate.min.js"></script>
    <script src="/js/additional-methods.min.js"></script>
    <script src="/js/localization/messages_fr.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAWDDvWulCh3nBVbzPuGjy_yZ26PePG23k"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.scrollTo.min.js"></script>
    <script src="/js/faireface.js"></script>
    <!--<script src="/js/holder.js"></script>-->
    <script src="/js/modernizr.js"></script>
    <script src="/js/geo.js"></script>
    <script src="/js/alertes.publier.js"></script>
    <script src="/js/ressources.ajouter.js"></script>
    <script src="/js/plan-familial.js"></script>
  </body>
</html>
