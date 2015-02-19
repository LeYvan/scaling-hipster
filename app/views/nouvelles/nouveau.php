<h1>Nouvelle</h1>


<?php
	if (isset($nouvelle->id) && $nouvelle->id != null)
	{
		echo Form::model($nouvelle, array('url' => array('/nouvelles',$nouvelle->id,'modifier'), 'class'=>'form-horizontal'));
		echo "<legend>Modifier la nouvelle</legend>";
	}
	else
	{
		echo Form::model(new Nouvelle, array('url' => '/nouvelles/ajouter/'));
		echo "<legend>Ajouter la nouvelle</legend>";
	}
?>

<fieldset>
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
    <?php
	  	if (isset($nouvelle->id) && $nouvelle->id != null)
		{
			echo "<button id=\"update\" name=\"save\" class=\"btn btn-primary\">Modifier</button>";
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