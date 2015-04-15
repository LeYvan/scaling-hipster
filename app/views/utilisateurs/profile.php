<h1>Profile</h1>
<?= Form::model($utilisateur, array('url' => array('/profile',$utilisateur->id), 'class'=>'form-horizontal', "id"=>"frmProfile")) ?>
<fieldset>

<!-- Form Name -->
<legend>Modification</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Nom">Votre nom complet :</label>
  <div class="col-md-5">
  <!-- <input id="Nom" name="Nom" type="text" placeholder="Votre nom complet" class="form-control input-md" required=""> -->
    <?= Form::text('nom',Input::old('nom'),array('class'=>'form-control input-md',"required"=>"required")) ?>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Email">Votre adresse courriel :</label>
  <div class="col-md-5">
  <?= Form::email('email',Input::old('email'),array('class'=>'form-control input-md',"required"=>"required")) ?>

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Email">Téléphone (pour alertes SMS) :</label>
  <div class="col-md-5">
    <div class="row">
      <div class="col-md-6">
        <?= Form::text('sms',Input::old('sms'),array('class'=>'form-control input-md')) ?>
        <p class="help-block">Dix chiffres, sans espaces, sans symboles. Uniquement des chiffres (10). </p>
      </div>
      <div class="col-md-6">
        <?php
        if ($utilisateur->sms != "") {
          ?>
          <button id="cmdUnsub" class="btn btn-primary">Se désabonner</button>
          <?php
        }
        else
        {
          ?>
          &nbsp;
          <?php
        }
        ?>
      </div>
    </div>

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


<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="alert alert-info" role="alert">
      <h4>Aide en Ligne</h4>
      <p>
        Nous avons un formulaire pour modifier son nom, son email et le numéro de téléphone pour s’abonner aux alertes.
        Si on est déjà inscrit, on a un bouton pour se désabonner des alertes.
      </p>
    </div>
  </div>
</div>
