<h1>Nouvelle</h1>
<? echo Form::model($nouvelle, array('url' => array('/nouvelle', $nouvelle->id), 'class'=>'form-horizontal')); ?>
<fieldset>

<?=
	if (Input::old('titre') != null || Input::old('titre') != "")
	{
		echo "<legend>Modifier l'utilisateur</legend>";
	}
	else
	{
		echo "<legend>Ajouter l'utilisateur</legend>";
	}
?>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="titre">Titre de la nouvelle :</label>  
  <div class="col-md-5">
      <?= Form::text('titre',Input::old('titre'),array('class'=>'form-control input-md')) ?>
  </div>
</div>

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
    <?=
	  	if (Input::old('titre') != null || Input::old('titre') != "")
		{
			echo "<button id=\"update\" name=\"update\" class=\"btn btn-primary\">Modifier</button>";
		}
		else
		{
			echo "<button id=\"save\" name=\"save\" class=\"btn btn-primary\">Enregistrer</button>";
		}
	?>
  </div>
</div>

</fieldset>
<?= Form::close() ?>