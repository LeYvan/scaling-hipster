<h1>Utilisateurs</h1>
<!-- <div class="table-responsive"> -->
    <table class="table table-striped table-hover table-middle">
        <thead>
            <tr>
                <!-- <th>Id</th> -->
                <th>Nom complet</th>
                <th>Nom d'utilisateur</th>
                <th>Adresse courriel</th>
                <th>Niveau</th>
                <th width="225px">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $niveau = array(1=>"Utilisateur", 2=>"Conseiller", 99=>"Administrateur");
            foreach($utilisateurs as $utilisateur) { ?>
            <tr>
                <!-- <td><?= $utilisateur->id ?></td> -->
                <td><?= $utilisateur->nom ?></td>
            	<td><?= $utilisateur->nomUtilisateur ?></td>
            	<td><?= $utilisateur->email ?></td>
            	<td><?= $niveau[$utilisateur->niveau] ?></td>
                <td>
                    <!-- <div class="btn-group" role="group" aria-label="..."> -->
                        <a class="btn btn-primary" href="/utilisateurs/<?= $utilisateur->id?>" type="button">
                    	   <span class="glyphicon glyphicon-edit"></span>  Modifier
                        </a>
                        <a class="btn btn-danger" href="#" data-user-id="<?= $utilisateur->id?>" type="button" data-toggle="modal" data-target="#supprUserModal">
                    	   <span class="glyphicon glyphicon-remove"></span>  Supprimer
                        </a>
                    <!-- </div> -->
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<!-- </div> -->
    <div class="modal fade" id="supprUserModal" tabindex="-1" role="dialog" aria-labelledby="supprUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="supprUserModalLabel">Supprimer l'utilisateur</h4>
          </div>
          <div class="modal-body">
            <div id="user-id"></div> 
              <?= Form::open(array('action'=>'UtilisateursController@supprimer','method' => 'post', 'id' => 'frmSupprUser')) ?>
                <input type="hidden" name="userId" id="userId" />
                <div class="text-right">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                </div>
            <?= Form::close() ?>
<!--                 echo Form::submit('Oui');
                echo Form::button('Non');
                echo Form::hidden('id','');
                echo Form::close(); -->
          </div>
        </div>
      </div>
    </div>
<div>
<?= $utilisateurs->links(); ?>
</div>
