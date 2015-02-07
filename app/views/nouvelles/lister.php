<h1>Nouvelles</h1>
<?php foreach ($nouvelles as $nouvelle) { ?>
	</br>
	<div class="well">
		<b>@<i><?= $nouvelle->utilisateur()->nom ?></i></b>: <?=$nouvelle->titre ?>

		<?php if (Auth::check() && Auth::user()->niveau == 2) { ?>
			<a class="btn btn-primary" href="/nouvelles/<?= $nouvelle->id?>/modifier/" type="button">
        	   <span class="glyphicon glyphicon-edit"></span>  Modifier
            </a>
            <a class="btn btn-danger" href="#" data-user-id="<?=$nouvelle->id?>" data-user-name="<?=$nouvelle->utilisateur()->nom?>" type="button" data-toggle="modal" data-target="#supprUserModal">
        	   <span class="glyphicon glyphicon-remove"></span>  Supprimer
            </a>
		<?php } ?>
	</div>
<?php } ?>

<div class="modal fade" id="supprUserModal" tabindex="-1" role="dialog" aria-labelledby="supprUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="supprUserModalLabel">Supprimer l'utilisateur</h4>
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



