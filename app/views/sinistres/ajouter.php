<?= Form::open(array('url' => '/sinistres/ajouter/')) ?>
<fieldset>
<!-- Text input-->
<div class="form-group">
  <label class="control-label" for="titre">Titre du rapport</label>  
  <div class="controls">
  <input id="titre" name="titre" type="text" placeholder="Sinistre au coin de Rue A et Rue B." class="form-control" required=""/>
  <!-- <span class="help-block">Un titre concis contenant le type et le lieu du sinistre.</span>   -->
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="control-label" for="categorie_id">Catégorie</label>
  <div class="controls">
    <?=Form::select('categorie_id', $lstCategories, null, array('id' => 'cmbCategorie', 'class' => 'form-control'))?>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="control-label" for="rapport">Le contenu du rapport.</label>
  <div class="controls">                     
    <textarea class="form-control" id="rapport" name="rapport" rows="10"></textarea>
  </div>
</div>

<!-- Photos -->
<div class="form-group">
  <label class="control-label" for="filebutton">Ajouter des fichiers</label>
  <div class="controls">
    <?= Form::file('filebutton', array('id' => 'filebutton', 'multiple', 'multiple')) ?>
    <!-- <input id="filebutton" name="filebutton" class="input-file" type="file"> -->
  </div>
</div>

<!-- Checkbox -->
<div class="checkbox">
  <label>
    <input id="cmdGetGeoPos" name="cmdGetGeoPos" type="checkbox" value="" />
    Inclure ma position
  </label>
</div>

<!-- Button -->
<div class="form-group text-right">
  <div class="controls">
    <button id="cmdEnvoyer" name="cmdEnvoyer" class="btn btn-primary">Envoyer</button>
  </div>
</div>

</fieldset>
<?= Form::close();?>