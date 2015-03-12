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
          <h1><?php echo $ressource->nom;?></h1>
          <pre><?php
              echo print_r($ressource,true)
            ?></pre>
        </div>
      </div>
    </div>
<?php endforeach; ?>
  </div>
  <div class="col-md-3">
    <nav id="menu-cote-ressources">
      <ul class="nav nav-pills nav-stacked" data-offset-top="170" data-spy="affix">
        <?php foreach ($ressources as $ressource): ?>
          <li><a href="#ressource<?php echo $ressource->id;?>"><?php echo $ressource->nom;?></a></li>
        <?php endforeach; ?>
    </ul>
    </nav>
  </div>
</div>
<div class="modal fade" id="supprUserModal" tabindex="-1" role="dialog" aria-labelledby="supprUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="supprUserModalLabel">Supprimer l'utilisateur</h4>
      </div>
      <div class="modal-body">
        <div id="user-id"></div>

      </div>
    </div>
  </div>
</div>
