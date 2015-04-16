<?= Form::model(new Sinistre, array('url' => '/sinistres/ajouter/','files' => true, "id"=>"frmSinistreAjouter")) ?>
<script type="text/javascript">
</script>
<fieldset>
<!-- Text input-->
<div class="form-group">
  <label class="control-label" for="titre">Titre du rapport</label>
  <div class="controls">
  <input value="<?=Input::old('titre')?>" id="titre" name="titre" type="text" placeholder="Titre du sinistre" class="form-control" required="required"/>
  <!-- <span class="help-block">Un titre concis contenant le type et le lieu du sinistre.</span>   -->
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="control-label" for="categorie_id">Catégorie</label>
  <div class="controls">
    <?=Form::select('categorie_id', $lstCategories, Input::old('categorie_id'), array('id' => 'cmbCategorie', 'class' => 'form-control'))?>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="control-label" for="rapport">Le contenu du rapport.</label>
  <div class="controls">
    <textarea class="form-control" id="rapport" name="rapport" rows="10" required="required"><?=Input::old('rapport')?></textarea>
  </div>
</div>

<!-- Photos -->
<div class="form-group">
  <label class="control-label" for="filebutton">Ajouter des fichiers</label>
  <div class="controls">
    <?= Form::file('files[]', array('id' => 'filebutton', 'multiple'=>true)) ?>
    <!-- <input id="filebutton" name="filebutton" class="input-file" type="file"> -->
    <span id="lblNbFichiers" class="label label-info">0 Fichiers</span>
  </div>
</div>

<!-- Img -->
<div class="form-group">
  <label id="lblPosition" class="control-label" for="geo-x">Position</label>
  <input type="hidden" id="geo-x" name="geo-x"/>
  <input type="hidden" id="geo-y" name="geo-y"/>
  <div id="divAdresse" name="divAdresse" class="controls">
    <div>
      <input id="adresse" name="adresse" type="text" placeholder="2020 Rue Nexiste-Pas" class="form-control" required="" value="<?=Input::old('adresse')?>"/>
       <p class="help-block">Entrer une adresse et choisir un élément proposé.</p>
    </div>
  </div>
  <div>
    </br>
    <div id="divGeoPos" class="geoPosImageScroll">
      <img id="imgGeoPos" src="/images/chargement.gif" alt="Chargement de la position en cours..."/>
    </div>
  </div>
</div>

<!-- Button -->
<div class="form-group text-right">
  <div class="controls">
    <button id="cmdReset" name="cmdReset" type="reset" class="btn btn-danger">Réinitialiser</button>
    <button id="cmdEnvoyer" name="cmdEnvoyer" class="btn btn-primary">Envoyer</button>
  </div>
</div>

</fieldset>
<?= Form::close();?>
