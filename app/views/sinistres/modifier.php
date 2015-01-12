<h1>Sinistres</h1>
<?php
  echo Form::model($sinistre, array('url' => array('/sinistres/modifier', $sinistre->id), 'class'=>'form-horizontal'));
?>
<fieldset>
<!-- Form Name -->
<legend>Modifier un rapport de sinistre</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="titre">Tirte du rapport</label>  
  <div class="col-md-6">
  <!-- <input value="<?= $sinistre->titre ?>" id="titre" name="titre" type="text" placeholder="Sinistre au coin de Rue A et Rue B." class="form-control input-md" required=""/> -->
  <?= Form::text('titre',Input::old('titre'),array('class'=>'form-control input-md')) ?>
  <span class="help-block">Un titre concis contenant le type et le lieu du sinistre.</span>  
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-2 control-label" for="categorie_id">Catégorie</label>
  <div class="col-md-6">
    <?=Form::select('categorie_id', $categories, Input::old('categorie_id'), array('id' => 'cmbCategorie', 'class' => 'form-control'))?>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-2 control-label" for="rapport">Le contenu du rapport.</label>
  <div class="col-md-6">                     
    <!-- <textarea class="form-control" id="rapport" name="rapport" rows="10"><?= $sinistre->rapport ?></textarea> -->
    <?= Form::textarea('rapport',Input::old('rapport'),array('class'=>'form-control input-md')) ?>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-2 control-label" for="cmdGetGeoPos">Localisation</label>
  <div class="col-md-6">
    <button id="cmdGetGeoPos" name="cmdGetGeoPos" class="btn btn-primary">Position actuelle</button>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-2 control-label" for="cmdChoisirGeoPos"></label>
  <div class="col-md-6">
    <button id="cmdChoisirGeoPos" name="cmdChoisirGeoPos" class="btn btn-primary">Choisir sur une carte</button>
  </div>
</div>

<?php
  foreach($sinistre->elements() as $element)
  {
      if ($element->type == 'image')
      { ?>
      <!-- File Button -->
      <div class="form-group">
        <div class="col-md-2 control-label">
          <strong>Fichier</strong>
        </div>
        <div class="col-md-6 well well-sm">
          <p class="col-md-2"><?= $element->fichier ?> <a  href="/elements-sinistres/supp/<?= $element->id ?>" type="button col-md-2" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Supprimer</a></p>
        </div>
      </div>
      <?php
      } 
      else 
      {
        ?>
        <video width="100%" controls>
          <source src="<?= $element->fichier ?>" type="video/mp4">
        </video>
        <?php
      }
  }
?>

<!-- Button -->
<div class="form-group">
  <label class="col-md-2 control-label" for="cmdEnvoyer">Publication</label>
  <div class="col-md-6">
    <button id="cmdEnvoyer" name="cmdEnvoyer" class="btn btn-success">Envoyer</button>
  </div>
</div>

</fieldset>
<?php
  echo Form::close();
?>
