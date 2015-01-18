      <div id="title-sinistres" class="">
        <!-- <h4 class="pull-right"><a href="/sinistres/ajouter/" class="label label-faireface"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Publier un nouveau rapport</a></h4> -->
        <h1>Sinistres</h1>
      </div>
          <div class="row liste-navigation">
            <div class="col-sm-4">
              <!-- <div>Catégorie:</div> -->
              <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="ddownCategorie" data-toggle="dropdown" aria-expanded="true">
                    <?= !$catCourante ? "Tout les types" : $catCourante->etiquette ?>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="ddownCategorie">
                    <li role="presentation" class="<?= !$catCourante ? "active" : "" ?>"><a role="menuitem" tabindex="-1" href="/sinistres/">Toutes les catégories</a></li>
                <?php
                  foreach($categories as $categorie)
                  {
                    $active = $categorie == $catCourante ? "active" : "";
                    ?>
                    <li role="presentation" class="<?= $active ?>"><a role="menuitem" tabindex="-1" href="/sinistres/categorie/<?= $categorie->etiquette ?>/"><?= $categorie->etiquette ?></a></li>
                    <?php
                    // print("<a href=\"/sinistres/categorie/" . $categorie->id . "\" class=\"list-group-item ". $active ." \">" . $categorie->etiquette . "</a>");
                  }
                ?>
                </ul>
              </div>
            </div>
            <div class="col-sm-8 text-right">
              <?= $sinistres->links(); ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 col-md-push-9">
              <div class="panel panel-faireface">
                <div class="panel-heading">
                    <h1 class="panel-title">Reporter un sinistre</h1>
                </div>
                <div class="panel-body">
                  <?php include('ajouter.php') ?>
                </div>
              </div>
            </div>
        <div class="col-md-9 col-md-pull-3">
            <!-- Début d'un sinistre -->
            <?php foreach($sinistres as $sinistre) { ?>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="pull-right"><a href="#" title="Retour en haut">Retour en haut <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"> </span></a></div>
                  <h2><?= $sinistre->titre ?></h2>
                  <h4>
                    <span class="label label-default"><?= $sinistre->categorie()->etiquette ?></span> <?= $sinistre->utilisateur()->nom ?>
                  <small><?= date('d/m/Y à g:ia', strtotime($sinistre->updated_at)) ?></small></h4>

                </div>
                <div class="panel-body">
                  <div class="row">
                    <?php
                      $nbPhotos = 0;
                      $nbPhotos = count($sinistre->elements());
                    ?>
                    <div class="col-sm-8 col-md-8 col-lg-9">
                      <p><?= $sinistre->rapport ?></p>
                      <div class="row">
                    <?php
                      foreach($sinistre->elements() as $element)
                      {
                      ?>
                      <div class="col-xs-3 col-sm-2 col-md-2">
                        <a href="#" class="thumbnail" data-toggle="modal" data-target="#mediaModal">
                        <?php
     
                          if ($element->type == 'image')
                          {
                            $rand1 = rand(400,600);
                            $rand2 = array($rand1*1334/750, $rand1*750/1334,$rand1*16/9,$rand1*9/16,$rand1*4/3,$rand1*3/4);
                            print("<img alt=\"Image envoyée par un utilisateur\" src=\"http://www.placecage.com/".$rand1."/".$rand2[rand(0,5)]."\">");
                          } 
                          else 
                          {
                            ?>
                            <video width="100%" controls>
                              <source src="<?= $element->fichier ?>" type="video/mp4">
                            </video>
                            <?php
                          }

                          ?>
                        </a>
                      </div>

                      <?php
                    }
                    ?>
                      </div>
                     </div>
                        <div class="col-xs-4 col-md-4 col-lg-3 col-xs-offset-4 col-sm-offset-0">
                          
                    <?php 
                        $base ='https://maps.googleapis.com/maps/api/staticmap?';
                        $coords = $sinistre['geo-x'] . ',' . $sinistre['geo-y'];
                        $center = 'center=' . $coords;
                        $zoom = 'zoom=15';
                        $size = 'size=200x200';
                        $maptype = 'maptype=roadmap';

                        $url = $base . $center . '&'
                        . $zoom . '&'
                        . $size . '&'
                        . $maptype . '&'
                        . 'markers=color:red%7Clabel:C%7C' . $coords . "&key=AIzaSyAWDDvWulCh3nBVbzPuGjy_yZ26PePG23k";

                        //http://maps.google.com/maps?q=35.128061,-106.535561&ll=35.126517,-106.535131&z=17
                        $href = "http://maps.google.com/maps?q=$coords&ll=$coords&z=17";

                        print("");

                        if ($sinistre['geo-x'] == 0 && $sinistre['geo-y'] == 0) {
                        ?>
                          <div class="alert alert-warning">Aucune données de localisation fournies.</div>
                        <?php
                        } else {
                        ?>
                          <div class="thumbnail">
                            <a href="<?=$href?>"><img alt="Voir dans google maps." src="<?=$url?>"></a>
                          </div>
                        <?php
                        }
                    ?>
                                              
                        </div>
                </div>
                        <?php
                        if (Auth::check() && Auth::User()->niveau > 1)
                        { 
                        ?>
                        <div>
                          <div class="btn-group" role="group" aria-label="Administration">
                            <a href="/sinistres/modifier/<?= $sinistre->id ?>" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"> </span>Modifier</a>
                            <a href="/sinistres/<?= $sinistre->id ?>/supp/" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"> </span>Supprimer</a>
                          </div>
                        </div>
                        <?php
                        }
                      ?>
              </div>
            </div>
            <?php } ?>
            </div>
            <!-- Fin d'un sinistre -->
          <div class="text-center">
            <?= $sinistres->links(); ?>
          </div>
          <!-- Fenêtre modal de visionnement d'images -->
          <div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="mediaModalLabel">Titre</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Fin Fenêtre modal de visionnement d'images -->

        </div>