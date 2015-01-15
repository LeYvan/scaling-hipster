      <div id="title-sinistres" class="">
        <h4 class="pull-right"><a href="/sinistres/ajouter/" class="label label-faireface"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Publier un nouveau rapport</a></h4>
        <h1>Sinistres</h1>
      </div>
      <div class="row">
        <!-- Liste des catégories de sinistres -->
 <!--       <div class="col-md-3 col-md-push-9">
          <div class="list-group">
            <a href="/sinistres/" class="list-group-item <?= $categorie_id == 0 ? "active" : ""; ?>">Toutes les catégories</a>
            <?php
              foreach($categories as $categorie)
              {
                $active = $categorie->id == $categorie_id ? "active" : "";
                print("<a href=\"/sinistres/categorie/" . $categorie->id . "\" class=\"list-group-item ". $active ." \">" . $categorie->etiquette . "</a>");
              }
            ?>
          </div>
        </div>-->
        <!-- Fin liste des catégories de sinistres -->

        <div class="col-md-12">
          <div class="row liste-navigation">
            <div class="col-sm-4">
              <div>Catégorie:</div>
              <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    <?= $categorie_id == 0 ? "Toutes" : $categorie->etiquette ?>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation" class="<?= $categorie_id == 0 ? "active" : "" ?>"><a role="menuitem" tabindex="-1" href="/sinistres/">Toutes les catégories</a></li>
                  <?php
                    foreach($categories as $categorie)
                    {
                      $active = $categorie->id == $categorie_id ? "active" : "";
                      ?>
                      <li role="presentation" class="<?= $active ?>"><a role="menuitem" tabindex="-1" href="/sinistres/<?= $categorie->id ?>"><?= $categorie->etiquette ?></a></li>
                      <?php
                      // print("<a href=\"/sinistres/" . $categorie->id . "\" class=\"list-group-item ". $active ." \">" . $categorie->etiquette . "</a>");
                    }
                  ?>
  <!--                   <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li> -->
                  </ul>
                </div>
              </div>
            <div class="col-sm-8 text-right"><?= $sinistres->links(); ?></div>
          </div>

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
                  <div class="col-md-8 col-lg-9">
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
                          // print("$element->fichier");
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

                  <div class="col-xs-12 col-md-4 col-lg-3">
                    <div class="thumbnail">
                    <div class="row">
                      <div class="col-sm-6 col-md-12">
                        <img data-src="holder.js/100%x250/text:Cliquez pour afficher la carte" alt="...">
                      </div>
                      <div class="col-sm-6 col-md-12">
                        <div class="caption">
                          <h3>Thumbnail label</h3>
                          <p>Wow, c'est fou que ce se soit passé là-bas. T'imagines? Ça aurait pû être nous.</p>
                          <?php
                            if (Auth::check() && Auth::User()->niveau > 2)
                            { 
                            ?>
                            <div class="text-right">
                                <a href="/sinistres/modifier/<?= $sinistre->id ?>" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"> </span>Modifier</a>
                                <a href="/sinistres/<?= $sinistre->id ?>/supp/" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"> </span>Supprimer</a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                      </div>
                      </div>
                    </div>
                 </div>
                </div>
              </div>

            </div>
            <?php } ?>
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
      </div>