<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Form Name</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Nom">Votre nom complet :</label>  
  <div class="col-md-5">
  <input id="Nom" name="Nom" type="text" placeholder="Votre nom complet" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Email">Votre adresse courriel :</label>  
  <div class="col-md-5">
  <input id="Email" name="Email" type="text" placeholder="Votre adresse courriel" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="niveau">Niveau</label>
  <div class="col-md-5">
    <select id="niveau" name="niveau" class="form-control">
      <option value="Utilisateur">Utilisateur</option>
      <option value="Conseiller">Conseiller</option>
      <option value="Administrateur">Administrateur</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="NomUtilisateur">Nom Utilisateur :</label>  
  <div class="col-md-5">
  <input id="NomUtilisateur" name="NomUtilisateur" type="text" placeholder="Nom Utilisateur" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Password">Votre mot de passe :</label>
  <div class="col-md-5">
    <input id="Password" name="Password" type="password" placeholder="mot de passe" class="form-control input-md" required="">
    
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
</form>
