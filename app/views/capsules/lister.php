<h1>Capsules</h1>

<?php if (Auth::check()) { ?>
  <a href="/capsules/ajouter/">Publier une Capsule</a>
<?php } ?>

  <div class="row liste-navigation">

    <div class="col-sm-4">

      <div class="dropdown">

        <button class="btn btn-primary dropdown-toggle" type="button" id="ddownCategorie" data-toggle="dropdown" aria-expanded="true">
            <?= !$catCourante ? "Tout les types" : $catCourante->etiquette ?>
            <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu" aria-labelledby="ddownCategorie">
          <li role="presentation" class="<?= !$catCourante ? "active" : "" ?>"><a role="menuitem" tabindex="-1" href="/capsules/">Toutes les catégories</a></li>
          <?php
          foreach($categories as $categorie)
          {
            $active = $categorie == $catCourante ? "active" : "";
            ?>
            <li role="presentation" class="<?= $active ?>"><a role="menuitem" tabindex="-1" href="/capsules/categories/<?= $categorie->etiquette ?>/"><?= $categorie->etiquette ?></a></li>
            <?php
          }
          ?>
        </ul>

      </div>

    </div>

    <div class="col-sm-8 text-right">
      <?= $capsules->links(); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-9 col-lg-9">
      <?php foreach ($capsules as $capsule) { ?>
      	<article class="panel panel-default">
          <div class="panel-heading">
      		  <h1 class="h2"><?=$capsule->titre ?></h1>
          </div>
          <div class="panel-body">
            <?= $capsule->contenu?>

            <h2 class="h3">Ressources suggérées</h2>
            <ul>
            <?php
            foreach($ressources[$capsule->categorie_id] as  $ressource)
            {
              ?><li><a href="<?=$ressource->url?>" target="BLANK"><?=$ressource->nom?></a></li><?php
            }
            ?>
            </ul>
          </div>
      		<?php if (Auth::check() && Auth::user()->niveau > 1) { ?>
          <div class="panel-footer">
            <div class="text-right">
        			<a class="btn btn-primary" href="/capsules/<?= $capsule->id?>/modifier/" type="button">
          	   <span class="glyphicon glyphicon-edit"></span>  Modifier
              </a>
              <a class="btn btn-danger" href="#" data-user-id="<?=$capsule->id?>" data-user-name="<?=$capsule->utilisateur()->nom?>" type="button" data-toggle="modal" data-target="#supprUserModal">
          	   <span class="glyphicon glyphicon-remove"></span>  Supprimer
              </a>
            </div>
          </div>
		    <?php } ?>
	     </article>
      <?php } ?>
    </div>
  <div class="col-md-3 col-lg-3">
    <div class="alert alert-info alert-batard" role="alert">
      <h4>Aide en Ligne</h4>
      <p>
         Nous avons la liste de toutes les capsules publiées sur le site. Chaque capsule possède un auteur, un titre et un contenu.
         Nous affichons l’auteur le titre, le contenu et les personnes ressources correspondantes au type de la capsule.
         Tout utilisateur connecté peut en ajouter.
      </p>
         
      <p>Si un administrateur ou un conseillé est connecté, en plus de voir toutes les capsules, il peut
       en modifier ou en supprimer.</p>
    </div>
  </div>
</div>

<div class="modal fade" id="supprUserModal" tabindex="-1" role="dialog" aria-labelledby="supprUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="supprUserModalLabel">Supprimer la capsule</h4>
      </div>
      <div class="modal-body">
        <div id="user-id"></div>
          <?= Form::open(array('action'=>'CapsulesController@suppPost','method' => 'post', 'id' => 'frmSupprUser')) ?>
            <input type="hidden" name="id" id="id" />
            <p>Voulez-vous vraiment supprimer cette capsule de "<span id="suppMsg"></span>"?</p>
            <div class="text-right">
                <button type="submit" class="btn btn-danger">Supprimer</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            </div>
        <?= Form::close() ?>
      </div>
    </div>
  </div>
</div>
