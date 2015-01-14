<div id="page" class="container">

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
                            <a class="btn btn-danger" href="/utilisateurs/supprimer/<?= $utilisateur->id?>" type="button">
                        	   <span class="glyphicon glyphicon-remove"></span>  Supprimer
                            </a>
                        <!-- </div> -->
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <!-- </div> -->
  <div>
    <?= $utilisateurs->links(); ?>
  </div>
</div>
