<div id="page" class="container">
<h1>Modifier un sinistre</h1>
<?php
  if ($mode == 'ajout') {
    echo Form::model(new Sinistre, array('url' => array('/sinistres/modifier', $sinistre->id), 'class'=>'form-horizontal'));
  } else {
    echo Form::model($sinistre, array('url' => array('/sinistres/modifier', $sinistre->id), 'class'=>'form-horizontal'));
  }
?>
<fieldset>
<!-- Form Name -->
<legend>Publier un rapport de sinistre</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="titre">Tirte du rapport</label>  
  <div class="col-md-6">
  <input value="<?= $sinistre->titre ?>" id="titre" name="titre" type="text" placeholder="Sinistre au coin de Rue A et Rue B." class="form-control input-md" required=""/>
  <span class="help-block">Un titre concis contenant le type et le lieu du sinistre.</span>  
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-2 control-label" for="categorie_id">Catégorie</label>
  <div class="col-md-6">
    <?=Form::select('categorie_id', $categories, $sinistre->categorie_id, array('id' => 'cmbCategorie', 'class' => 'form-control'))?>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-2 control-label" for="rapport">Le contenu du rapport.</label>
  <div class="col-md-6">                     
    <textarea class="form-control" id="rapport" name="rapport" rows="10"><?= $sinistre->rapport ?></textarea>
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
</div>