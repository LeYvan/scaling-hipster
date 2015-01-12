<div id="page" class="container">

    <h1>Utilisateurs</h1>


          <div>
            <?= $utilisateurs->links(); ?>
          </div>
            <?php foreach($utilisateurs as $utilisateur) { ?>
          	<article>

            <ul>
            	<li>Nom complet: <?= $utilisateur->nom; ?></li>
            	<li>Nom d'utilisateur: <?= $utilisateur->nomUtilisateur; ?></li>
            	<li>Adresse courriel: <?= $utilisateur->email; ?></li>
            	<?php
            		$niveau;
            		switch ($utilisateur->niveau) {
            			case '1':
            				$niveau = "Utilisateur";
            				break;
            			case '2':
            				$niveau = "Conseiller";
            				break;
            			case '99':
            				$niveau = "Administrateur";
            				break;
            		}
            		echo "<li>Niveau : " . $niveau . " </li>";	
            	?>
            </ul>

            <a href="/utilisateurs/<?= $utilisateur->id?>" type="button">
            	<span class="glyphicon glyphicon-edit"></span>  Modifier
            </a>
            </article>

            <?php } ?>
          <div>
            <?= $utilisateurs->links(); ?>
          </div>
</div>