      <div id="title-sinistres" class="">
        <h1>Alertes - Historique</h1>
      </div>

          <div class="row liste-navigation">

            <div class="col-sm-4">

              <div class="dropdown">

                <button class="btn btn-primary dropdown-toggle" type="button" id="ddownCategorie" data-toggle="dropdown" aria-expanded="true">
                    <?= !$catCourante ? "Tout les types" : $catCourante->etiquette ?>
                    <span class="caret"></span>
                </button>

                <ul class="dropdown-menu" role="menu" aria-labelledby="ddownCategorie">
                  <li role="presentation" class="<?= !$catCourante ? "active" : "" ?>"><a role="menuitem" tabindex="-1" href="/alertes/">Toutes les catégories</a></li>
                  <?php
                  foreach($categories as $categorie)
                  {
                    $active = $categorie == $catCourante ? "active" : "";
                    ?>
                    <li role="presentation" class="<?= $active ?>"><a role="menuitem" tabindex="-1" href="/alertes/categories/<?= $categorie->etiquette ?>/"><?= $categorie->etiquette ?></a></li>
                    <?php
                  }
                  ?>
                </ul>

              </div>

            </div>

            <div class="col-sm-8 text-right">
              <?= $alertes->links(); ?>
            </div>

          </div>

          <?php
            if (Auth::check() && Auth::User()->niveau > 1)
            {
            ?>
            <div class="row">
              <div class="col-md-3">
                <a class="btn btn-success" href="/alertes/publier/" role="button">Publier une nouvelle alerte</a>
              </div>
            </div>
            <br/>
            <?php
            }
          ?>

          <div class="row">
            <div class="col-md-3 col-md-push-9">
              <div class="alert alert-info" role="alert">
                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button> -->
                <h4>Le saviez-vous?</h4>
                <p>Vous pouvez inscrire votre numéro de téléphone cellulaire pour recevoir les alertes de faireface.ca par SMS.</p>
                <p>Vous n'avez qu'à ajouter l'information dans votre profile, atteignable en cliquant sur votre nom en haut à droite de la page.</p>
              </div>
            </div>

            <div class="col-md-9 col-md-pull-3">
            <!-- Début d'un sinistre -->
            <?php
              $lastAlerteDate = null;

              foreach($alertes as $alerte) { ?>

                <?php
                $currDate = substr($alerte->created_at,0,10);
                ?>

            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                    <?php
                        $base ='https://maps.googleapis.com/maps/api/staticmap?';
                        $coords = $alerte['lat'] . ',' . $alerte['long'];
                        $center = 'center=' . $coords;
                        $zoom = 'zoom=15';
                        $size = 'size=200x150';
                        $maptype = 'maptype=roadmap';

                        $url = $base . $center . '&'
                        . $zoom . '&'
                        . $size . '&'
                        . $maptype . '&'
                        . 'markers=color:red%7Clabel:C%7C' . $coords . "&key=AIzaSyAWDDvWulCh3nBVbzPuGjy_yZ26PePG23k";

                        //http://maps.google.com/maps?q=35.128061,-106.535561&ll=35.126517,-106.535131&z=17
                        $href = "http://maps.google.com/maps?q=$coords&ll=$coords&z=17";

                        if ($alerte['lat'] == 0 && $alerte['long'] == 0) {
                        ?>
                          <div class="alert alert-warning">Aucune données de localisation fournies.</div>
                        <?php
                        } else {
                        ?>

                          <div class="col-sm-4">
                            <a class="map-alerte" href="<?=$href?>"><img alt="Voir dans google maps." src="<?=$url?>"></a>
                          </div>
                          <div class="col-sm-8 alerte-panel">
                            <h2><?=strftime("%e %B %Y", strtotime($currDate))?></h2>
                            <p class="auteur">Par <?=$alerte->utilisateur()->nom?></p>
                            <p><?=$alerte->contenu?></p>

                            <div class="personnes-ressources">
                              <h5>Personnes ressources:</h5>
                              <ul class="list-inline">
                                <li><a href="#">Ressource #1</a></li>
                                <li><a href="#">Ressource #2</a></li>
                                <li><a href="#">Ressource #3</a></li>
                              </ul>
                            </div>
                          </div>
                        <?php
                        }

                    ?>
                  </div>
              </div>
              <div class="panel-footer panel-footer-divise">
                <div class="row">
                  <div class="col-sm-4 division">
                    <span class="label label-info"><?= $alerte->categorie()->etiquette ?></span>
                  </div>
                  <div class="col-sm-4 division">
                    <a href="#"><span class="glyphicon glyphicon-list-alt"></span> Capsules d'informations</a>
                  </div>
                  <div class="col-sm-4 division">
                    <a href="/a/<?=$alerte->id?>"><span class="glyphicon glyphicon-eye-open"> </span> Voir les détails</a>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
            </div>

            <!-- Fin d'un sinistre -->

          <div class="text-center">
            <?= $alertes->links(); ?>
          </div>

        </div>
      </div>
