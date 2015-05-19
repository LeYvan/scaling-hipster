<h1>Ressources</h1>
<!-- <div data-spy="scroll" data-target="#menu-cote-ressources"> -->
<?php
  if (Auth::check() && Auth::User()->niveau > 1)
  {
  ?>
  <div class="row">
    <div class="col-md-3">
      <a class="btn btn-success" href="/ressources/ajouter/" role="button">Ajouter une ressource d'urgence</a>
    </div>
  </div>
  <?php
  }
?>
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
<div class="panel panel-primary">
  <div id="ressource<?php echo $ressource->id;?>" class="panel-heading">
    <?php
      if (Auth::check() && Auth::User()->niveau > 1)
      { ?>

      <div class="pull-right">
        <a class="supprimer-primary" href="#" data-nom="<?=$ressource->nom?>" data-ressource-id="<?= $ressource->id?>" type="button" data-toggle="modal" data-target="#supprRessourceModal">
          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Supprimer
        </a>
      </div>
      <div class="pull-right clearfix">
        &nbsp;
      </div>
      <div class="pull-right">
        <a class="supprimer-primary" href="/ressources/<?= $ressource->id?>/modifier/">
          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modifier
        </a>
      </div>
    <?php }?>
    <h3 class="panel-title"><?php echo $ressource->nom;?></h3>
  </div>
  <div class="panel-body">
    <div class="form-horizontal">

      <div class="form-group">
        <label class="col-sm-2 col-md-3 col-lg-2 control-label">Courriel :</label>
        <div class="col-sm-10 col-md-9 col-lg-10">
          <p class="form-control-static"><?php echo $ressource->email;?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 col-md-3 col-lg-2 control-label">Site internet :</label>
        <div class="col-sm-10 col-md-9 col-lg-10">
          <p class="form-control-static"><a target="BLANK" href="<?php echo $ressource->url;?>"><?php echo $ressource->url;?></a></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 col-md-3 col-lg-2 control-label">Téléphone :</label>
        <div class="col-sm-10 col-md-9 col-lg-10">
          <p class="form-control-static"><?php echo $ressource->telephone;?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 col-md-3 col-lg-2 control-label">Description :</label>
        <div class="col-sm-10 col-md-9 col-lg-10">
          <p class="form-control-static"><?php echo $ressource->description;?></p>
        </div>
      </div>

    </div>
  </div>

  <div class="panel-footer">
    <a href="#page">Retour vers haut</a>
  </div>
</div>

<?php endforeach; ?>
  </div>
  <div class="col-md-3">
    <nav id="menu-cote-ressources" data-offset-top="190" data-spy="affix">
      <ul class="nav nav-pills nav-stacked">
        <?php foreach ($ressources as $ressource): ?>
          <li><a href="#ressource<?php echo $ressource->id;?>"><?php echo $ressource->nom;?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
  </div>
</div>

<div class="row">
  <div class="col-md-9">
    <div class="alert alert-info" role="alert">
      <h4>Aide en Ligne</h4>
      <p>
       Nous avons la liste de toutes les personnes ressources avec leur courriel,
       site internet, téléphone et une brève description. Nous pouvons également afficher
       la liste en fonction des types de sinistre. Sur chaque sinistre nous avons un lien pour
       retourner en haut de la page. La liste est également présente à droite de la page et
       on peut cliquer sur une ressource et se retrouver à ses informations.</p>

      <p>Si un administrateur ou un conseillé est connecté, en plus de voir toutes les ressources, il peut en ajouter, en modifier ou en supprimer.

      </p>
    </div>
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
