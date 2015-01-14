 <?= Form::model($utilisateur, array('url' => array('/utilisateurs',$utilisateur->id), 'class'=>'form-horizontal')) ?>
<fieldset>

<!-- Form Name -->
<legend>Modifier l'utilisateur</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Nom">Votre nom complet :</label>  
  <div class="col-md-5">
  <!-- <input id="Nom" name="Nom" type="text" placeholder="Votre nom complet" class="form-control input-md" required=""> -->
    <?= Form::text('nom',Input::old('nom'),array('class'=>'form-control input-md')) ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Email">Votre adresse courriel :</label>  
  <div class="col-md-5">
  <?= Form::text('email',Input::old('email'),array('class'=>'form-control input-md')) ?>
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="niveau">Niveau</label>
  <div class="col-md-5">
  <?=Form::select('niveau', array('1' => 'Utilisateur', '2' => 'Conseiller', '99' => 'Administrateur'), Input::old('niveau'),array('class'=>'form-control input-md')); ?>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <button id="save" name="save" class="btn btn-primary">Enregistrer</button>
  </div>
</div>

</fieldset>
<?= Form::close() ?>
