<div id="page" class="container">

    <h1>Sinistres</h1>

      <div>
        <h4><a href="/sinistres/ajouter/" class="label label-faireface"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Publier un noueau rapport</a></h4>
      </div>

      <div class="row">

        <!-- Liste des catégories de sinistres -->
        <div class="col-md-3 col-md-push-9">
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
        </div>
        <!-- Fin liste des catégories de sinistres -->

        <div class="col-md-9 col-md-pull-3">

            <!-- Début d'un sinistre -->
            <?php foreach($sinistres as $sinistre) { ?>

            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><?= $sinistre->titre ?></h2>
                <h4>
                  <span class="label label-default"><?= $sinistre->categorie()->etiquette ?></span> <?= $sinistre->utilisateur()->nom ?>
                <small><?= date('d/m/Y à g:ia', strtotime($sinistre->updated_at)) ?></small></h4>
              </div>
              <div class="panel-body">
                <p><?= $sinistre->rapport ?></p>
                <div class="row">
                <?php  
                  foreach($sinistre->elements() as $element)
                  {
                  ?>
                  <div class="col-xs-6 col-sm-4 col-lg-3">
                    <a href="#" class="thumbnail" data-toggle="modal" data-target="#mediaModal">
                    <?php
                      if ($element->type == 'image')
                      {
                        $rand1 = rand(200,800);
                        $rand2 = rand($rand1*1334/750,$rand1*750/1334);
                        print("<img alt=\"Image envoyée par un utilisateur\" src=\"http://www.placecage.com/".$rand1."/".$rand2."\">");
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
                      <?php
                        if (Auth::check() && Auth::User()->niveau > 2)
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
            <!-- Fin d'un sinistre -->

          <div>
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
</div>