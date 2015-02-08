      <div id="title-sinistres" class="">
        <h1>Alertes</h1>
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
          <div class="row">

            <div class="col-md-3 col-md-push-9">

            </div>
            
            <div class="col-md-9 col-md-pull-3">
            <!-- Début d'un sinistre -->
            <?php foreach($alertes as $alerte) { ?>

            <p class="well"><strong>@</strong><em><?=$alerte->utilisateur()->nom?>: </em><?=$alerte->contenu?>
            <?php 
                $base ='https://maps.googleapis.com/maps/api/staticmap?';
                $coords = $alerte['lat'] . ',' . $alerte['long'];
                $center = 'center=' . $coords;
                $zoom = 'zoom=15';
                $size = 'size=350x150';
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
                  <div class="panel panel-info">
                    <a href="<?=$href?>"><img alt="Voir dans google maps." src="<?=$url?>"></a>
                  </div>
                <?php
                }
            ?>
            </p>

            <?php } ?>
            </div>
            <!-- Fin d'un sinistre -->

          <div class="text-center">
            <?= $alertes->links(); ?>
          </div>

        </div>
      </div>
