      <div id="title-sinistres" class="">
        <h1>Alertes - Détails</h1>
      </div>

          <div class="row">

            <div class="col-md-3 col-md-push-9">

            </div>

            <div class="col-md-9 col-md-pull-3">
              <!-- Début d'un sinistre -->
              <div class="well">
                <p ><strong>@</strong><em><?=$alerte->utilisateur()->nom?>: </em><?=$alerte->contenu?></p>
                <?php
                    $base ='https://maps.googleapis.com/maps/api/staticmap?';
                    $coords = $alerte['lat'] . ',' . $alerte['long'];
                    $center = 'center=' . $coords;
                    $zoom = 'zoom=15';
                    $size = 'size=150x150';
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
                      <div class="alert alert-warning ">Aucune données de localisation fournies.</div>
                    <?php
                    } else {
                    ?>
                    <div class="container row">
                      <div class="col-md-4  ">
                        <div class="panel panel-info">
                          <div class="panel-heading">Localisation</div>
                            <div class="panel-body  text-center	">
                              <a href="<?=$href?>" target="_BLANK"><img alt="Voir dans google maps." src="<?=$url?>"></a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
              </div>
            </div>
            <!-- Fin d'un sinistre -->
