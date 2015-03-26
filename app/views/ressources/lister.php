<h1>Ressources</h1>
<!-- <div data-spy="scroll" data-target="#menu-cote-ressources"> -->
<?php if (Auth::check()) { ?>
  <a href="/ressources/ajouter/">Ajouter une ressource</a>
<?php } ?>

  <div class="row liste-navigation">

    <div class="col-sm-4">

      <div class="dropdown">

        <button class="btn btn-primary dropdown-toggle" type="button" id="ddownCategorie" data-toggle="dropdown" aria-expanded="true">
            <?= !$catCourante ? "Tout les types" : $catCourante->etiquette ?>
            <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu" aria-labelledby="ddownCategorie">
          <li role="presentation" class="<?= !$catCourante ? "active" : "" ?>"><a role="menuitem" tabindex="-1" href="/ressources/">Toutes les catégories</a></li>
          <?php
          foreach($categories as $categorie)
          {
            $active = $categorie == $catCourante ? "active" : "";
            ?>
            <li role="presentation" class="<?= $active ?>"><a role="menuitem" tabindex="-1" href="/ressources/categories/<?= $categorie->etiquette ?>/"><?= $categorie->etiquette ?></a></li>
            <?php
          }
          ?>
        </ul>

      </div>

    </div>

    <div class="col-sm-8 text-right">
      <?= $ressources->links(); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-9">
<?php foreach ($ressources as $ressource): ?>
    <div id="ressource<?php echo $ressource->id;?>">
      <div class="row">
        <div class="col-md-12">
          <div>
            <?php
            if (Auth::check() && Auth::User()->niveau > 1)
            { 
              ?>
            <span class="pull-right">
              <a class="btn btn-danger" href="#" data-nom="<?=$ressource->nom?>" data-ressource-id="<?= $ressource->id?>" type="button" data-toggle="modal" data-target="#supprRessourceModal">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Supprimer
              </a>
            </span>
            <?php }?>
            <h1><?php echo $ressource->nom;?></h1>
          </div>
          <p><?= $ressource->description;?></p>
          <address>
            <strong><?= $ressource->nom;?></strong><br />
            123, rue du fer<br />
            <abbr title="Téléphone">Tél.</abbr> : (418) 254-6011<br />
            St-Face, Québec<br />
            V4G 1N4
          </address>
        </div>
      </div>
    </div>
<?php endforeach; ?>
  </div>
  <div class="col-md-3">
    <nav id="menu-cote-ressources" data-offset-top="170" data-spy="affix">
      <ul class="nav nav-pills nav-stacked">
        <?php foreach ($ressources as $ressource): ?>
          <li><a href="#ressource<?php echo $ressource->id;?>"><?php echo $ressource->nom;?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
  </div>
</div>

<!-- Fenêtre modal de confirmation de suppressin de sinistre -->
<div class="modal fade" id="supprRessourceModal" tabindex="-1" role="dialog" aria-labelledby="supprRessourceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="supprRessourceModalLabel">Supprimer la ressource</h4>
      </div>
      <div class="modal-body">
          <?= Form::open(array('action'=>'RessourcesController@supprimer','method' => 'post', 'id' => 'frmSupprRessource')) ?>
            <input type="hidden" name="id" id="id" />
            <p>Voulez-vous vraiment supprimer "<span id="suppMsg"></span>"?</p>
            <div class="text-right">
                <button type="submit" class="btn btn-danger">Supprimer</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            </div>
        <?= Form::close() ?>
      </div>
    </div>
  </div>
</div>
<!-- Fin fenêtre modal de confirmation de suppressin de sinistre -->