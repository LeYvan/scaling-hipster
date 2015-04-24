<h1>Nouvelles</h1>

<?php if (Auth::check()) { ?>
  <a href="/nouvelles/ajouter/">Publier une nouvelle</a>
<?php } ?>
<div class="row">
  <div class="col-md-9">
<?php foreach ($nouvelles as $nouvelle) { ?>
  <article class="panel">
    <h1 class="h3"><?=$nouvelle->titre ?></h1>
    <p>par : <strong><?= $nouvelle->utilisateur()->nom ?></strong></p>
    <?=$nouvelle->contenu?>

    <?php if (Auth::check() && (Auth::user()->niveau == 1 || Auth::user()->niveau == 99)) { ?>
    <footer>
      <div class="text-right">
        <a class="btn btn-primary" href="/nouvelles/<?= $nouvelle->id?>/modifier/" type="button">
         <span class="glyphicon glyphicon-edit"></span>  Modifier
        </a>
        <a class="btn btn-danger" href="#" data-user-id="<?=$nouvelle->id?>" data-user-name="<?=$nouvelle->utilisateur()->nom?>" type="button" data-toggle="modal" data-target="#supprUserModal">
         <span class="glyphicon glyphicon-remove"></span>  Supprimer
        </a>
      </div>
    </footer>
    <?php } ?>
  </article>
<?php } ?>
  </div>
  <div class="col-md-3">
    <div class="alert alert-info alert-batard" role="alert">
      <h4>Aide en Ligne</h4>
      <p>Nous avons la liste de toutes les nouvelles publiées sur le site. Chaque nouvelle possède un auteur, un titre et un contenu. Nous affichons l’auteur et le contenu. Tout utilisateur connecté peut en ajouter.</p>
      <p>Si un administrateur ou un conseillé est connecté, en plus de voir toutes les nouvelles, il peut en modifier ou en supprimer.</p>
    </div>
  </div>
</div>
<div class="modal fade" id="supprUserModal" tabindex="-1" role="dialog" aria-labelledby="supprUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="supprUserModalLabel">Supprimer la nouvelle</h4>
      </div>
      <div class="modal-body">
        <div id="user-id"></div>
          <?= Form::open(array('action'=>'NouvellesController@suppPost','method' => 'post', 'id' => 'frmSupprUser')) ?>
            <input type="hidden" name="id" id="id" />
            <p>Voulez-vous vraiment supprimer cette nouvelle de "<span id="suppMsg"></span>"?</p>
            <div class="text-right">
                <button type="submit" class="btn btn-danger">Supprimer</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            </div>
        <?= Form::close() ?>
      </div>
    </div>
  </div>
</div>
