<h1>Publier un rapport de sinistre</h1>
<?php
    echo Form::open(array('url' => '/sinistres/ajouter/', 'class'=>'form-horizontal'));
?>
<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="titre">Tirte du rapport</label>  
  <div class="col-md-6">
  <input id="titre" name="titre" type="text" placeholder="Sinistre au coin de Rue A et Rue B." class="form-control input-md" required=""/>
  <span class="help-block">Un titre concis contenant le type et le lieu du sinistre.</span>  
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-2 control-label" for="categorie_id">Catégorie</label>
  <div class="col-md-6">
    <?=Form::select('categorie_id', $categories, null, array('id' => 'cmbCategorie', 'class' => 'form-control'))?>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-2 control-label" for="rapport">Le contenu du rapport.</label>
  <div class="col-md-6">                     
    <textarea class="form-control" id="rapport" name="rapport" rows="10"></textarea>
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

<div class="form-group">
  <div>
    <?php
      $infoGeo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=206.167.109.51'));//.$_SERVER['REMOTE_ADDR']));
      $long = $infoGeo['geoplugin_longitude'];
      $lat = $infoGeo['geoplugin_latitude'];
    ?>
    <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$lat.",".$long?>&zoom=14&size=250x250">
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