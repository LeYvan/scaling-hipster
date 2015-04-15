<h1>Capsule</h1>


<?php
	if (isset($capsule->id) && $capsule->id != null)
	{
		echo Form::model($capsule, array('url' => array('/capsules',$capsule->id,'modifier'), 'class'=>'form-horizontal'));
		echo "<legend>Modifier la capsule</legend>";
	}
	else
	{
		echo Form::model(new Capsule, array('url' => '/capsules/ajouter/'));
		echo "<legend>Ajouter la capsule</legend>";
	}
?>

<fieldset>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="titre">Titre de la capsule :</label>  
  <div class="col-md-5">
      <?= Form::text('titre',Input::old('titre'),array('class'=>'form-control input-md')) ?>
  </div>
</div>
</br>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-2 control-label" for="categorie_id">Catégorie</label>
  <div class="col-md-6">
    <?=Form::select('categorie_id', $categories, Input::old('categorie_id'), array('id' => 'cmbCategorie', 'class' => 'form-control'))?>
  </div>
</div>
</br>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="contenu">Contenu :</label>  
  <div class="col-md-5">
    <?= Form::text('contenu',Input::old('contenu'),array('class'=>'form-control input-md')) ?>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <?php
	  	if (isset($capsule->id) && $capsule->id != null)
		{
			echo "<button id=\"update\" name=\"save\" class=\"btn btn-primary\" type=\"submit\" >Modifier</button>";
		}
		else
		{
			echo "<br/><button id=\"save\" name=\"save\" class=\"btn btn-primary\">Enregistrer</button>";
		}
	?>
  </div>
</div>

</fieldset>
<?= Form::close() ?>

<div class="row">
    <div class="alert alert-info" role="alert">
      <h4>Aide en Ligne</h4>
      <p>
      	Ajout : Pour l’ajout d’une capsule, il faut donner les informations concernant la capsule. Il faut choisir une catégorie, un titre et le contenu. L’utilisateur connecté est directement considéré comme l’auteur. On clique sur Enregistrer pour terminer l’ajout.
      </p>
      <p>
		Modification : Pour la modification; à partir de la liste des capsules, on clique sur le bouton modifier qui nous envoie vers un formulaire avec les champs pré remplis par la capsule qu’on veut modifier. On modifie les champs voulus et on enregistre en cliquant sur Modifier.

      </p>
    </div>
</div>