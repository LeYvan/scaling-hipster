<div>
  <h1>Ressources</h1>
</div>

<?php
	if (isset($ressource->id) && $ressource->id != null)
	{
		echo Form::model($ressource, array('url' => array('/ressources',$ressource->id,'modifier'), 'class'=>'form-horizontal', "id"=>"frmRessource"));
    $mode = "edition";
		echo "<legend>Modifier</legend>";
	}
	else
	{
    $mode = "nouveau";
		echo Form::model(new Ressource, array('url' => '/ressources/ajouter/', 'class'=>'form-horizontal', "id"=>"frmRessource"));
		echo "<legend>Ajouter</legend>";
	}
?>

<div class="form-group">
  <label class="col-md-4 control-label" for="ddownCategorie">Catégorie</label>
  <div class="col-md-4">
    <div id="categorieSel" class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" id="ddownCategorie" data-toggle="dropdown" aria-expanded="true">
          Choisir
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="ddownCategorie">
      <?php
        foreach($categories as $categorie)
        {

          ?>
          <li role="presentation" class=""><a role="menuitem" tabindex="-1" data-id="<?= $categorie->id ?>"><?= $categorie->etiquette ?></a></li>
          <?php
        }
      ?>
      </ul>
      <span class="help-block">Catégorie d'expertise de la ressource d'urgence.</span>
    </div>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nom">Nom</label>
  <div class="col-md-4">
  <!--<input id="nom" name="nom" type="text" placeholder="Nom complet" class="form-control input-md">-->
  <?= Form::text('nom',Input::old('nom'),array('class'=>'form-control input-md','required'=>'required')) ?>
  <span class="help-block">Nom complet de la personne ressource.</span>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="telephone">Téléphone:</label>
  <div class="col-md-4">
  <!--<input id="telephone" name="telephone" type="text" placeholder="418-123-1234" class="form-control input-md">-->
  <?= Form::text('telephone',Input::old('telephone'),array('class'=>'form-control input-md telephone','required'=>'required')) ?>
  <span class="help-block">Adresse fournie aux citoyens.</span>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>
  <div class="col-md-4">
  <!--<input id="email" name="email" type="courriel" placeholder="courriel@service.com" class="form-control input-md">-->
  <?= Form::email('email',Input::old('email'),array('class'=>'form-control input-md','required'=>'required')) ?>
  <span class="help-block">Courriel fournie aux citoyens.</span>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="url">Url</label>
  <div class="col-md-4">
  <!--<input id="url" name="url" type="text" placeholder="http://centredexperts.com" class="form-control input-md">-->
  <?= Form::text('url',Input::old('url'),array('class'=>'form-control input-md','required'=>'required')) ?>
  <span class="help-block">Page ou site web destiné aux citoyens.</span>
  </div>
</div>

<?= Form::hidden('categorie_id',Input::old('categorie_id'), array('id'=>'categorie_id')) ?>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="contenu">Description</label>
  <div class="col-md-6">
    <!--<textarea class="form-control" id="description" name="description">Ce que la ressource offre comme support aux citoyens et dans quelles circonstances.</textarea>-->
    <?= Form::text('description',Input::old('description'),array('class'=>'form-control input-md','required'=>'required')) ?>
  </div>
</div>

    <div class="form-group">
      <label class="col-md-4 control-label sr-only" for="cmdAdresse">Action</label>
      <div class="col-md-4 controls">
        <button id="cmdReset" name="cmdReset" type="reset" class="btn btn-danger">Réinitialiser</button>
        <button id="cmdEnvoyer" name="cmdEnvoyer" class="btn btn-primary">Enregistrer</button>
      </div>
    </div>


<?= Form::close();?>

<div class="row">
    <div class="alert alert-info" role="alert">
      <h4>Aide en Ligne</h4>
      <p>
       Ajout :
        Pour ajouter une personne ressource, il faut informer tous les champs.
        Donner une catégorie, un nom, un téléphone, un email, un url et une brève description. Ensuite on peut cliquer
        sur Enregistrer pour terminer la création ou sur Réinitialiser pour recommencer.
      </p>
    </div>
</div>
