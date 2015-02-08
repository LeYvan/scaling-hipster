      <div id="title-sinistres" class="">
        <!-- <h4 class="pull-right"><a href="/sinistres/ajouter/" class="label label-faireface"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Publier un nouveau rapport</a></h4> -->
        <h1>Alertes</h1>
      </div>

      <div class="row">

      </div>

<?= Form::model(new Sinistre, array('url' => '/alertes/publier/','files' => true,'class'=>"form-horizontal")) ?>
<input type="hidden" id="categorie_id" name="categorie_id" />
<fieldset>
<legend>Publier</legend>
<!-- Catégorie -->
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
      //print_r($categorie);
        foreach($categories as $categorie)
        {

          ?>
          <li role="presentation" class=""><a role="menuitem" tabindex="-1" data-id="<?= $categorie->id ?>"><?= $categorie->etiquette ?></a></li>
          <?php
        }
      ?>
      </ul>
    </div>
  </div>
  </div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="contenu">Contenu</label>
  <div class="col-md-6">                     
    <textarea class="form-control" id="contenu" name="contenu">Contenu de l'alerte.</textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="lat">Latitude</label>  
  <div class="col-md-4">
  <input id="lat" name="lat" type="text" placeholder="40.0" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="long">Longitude</label>  
  <div class="col-md-4">
  <input id="long" name="long" type="text" placeholder="50.0" class="form-control input-md">
    
  </div>
</div>


 <div class="form-group">

    <label class="col-md-4 control-label" for="cmdAdresse">Trouver par</label>

  <div class="  col-md-4">
    <button id="cmdAdresse" name="cmdAdresse" class="btn btn-info" href="#" type="button" >Adresse</button>
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="rayon">Rayon (Km)</label>  
  <div class="col-md-4">
  <input id="rayon" name="rayon" type="text" placeholder="5.0" class="form-control input-md">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  
  <div class="col-md-4">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="cmdAdresse">Action</label>
  <div class="col-md-4 controls">
    <button id="cmdReset" name="cmdReset" type="reset" class="btn btn-danger">Réinitialiser</button>
    <button id="cmdEnvoyer" name="cmdEnvoyer" class="btn btn-primary">Envoyer</button>
  </div>
</div>

</fieldset>
<?= Form::close();?>

          <!-- Fenêtre modal de confirmation de suppressin de sinistre -->
          <div class="modal fade" id="trouverAdresseModel" tabindex="-1" role="dialog" aria-labelledby="lblTrouverAdresseModel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="lblTrouverAdresseModel">Déduire position géographique par adresse</h4>
                </div>

                <div class="modal-body">

                    <?= Form::open(array('action'=>'SinistresController@supprimer','method' => 'post', 'id' => 'frmSupprSinistre','class'=>'form-horizontal')) ?>

                    <!-- Adresse -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="adresse">Adresse</label>  
                      <div class="col-md-8">
                        <input id="_adresse" name="_adresse" type="text" placeholder="5.0" class="form-control input-md">
                      </div>
                    </div>

                    <!-- Preview -->
                    <div id="adressePreview" class="form-group">
                      <label class="col-md-4 control-label" for="adresse">Carte</label>  
                      <div class="col-md-8">
                        <img id="imgPreview" src="/images/chargement.gif">
                      </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                      <div class="col-md-4">
                      </div>
                      <div class="col-md-8 controls">
                        <button id="cmdCancelAdresse" name="cmdReset" class="btn btn-danger" data-dismiss="trouverAdresseModel">Annuler</button>
                        <button id="cmdSelAdresse" name="cmdEnvoyer" class="btn btn-primary">Sélectionner</button>
                      </div>
                    </div>
                  <?= Form::close() ?>



                </div>

              </div>
            </div>
          </div>
          <!-- Fin fenêtre modal de confirmation de suppressin de sinistre -->