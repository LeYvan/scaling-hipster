<h1>Aide</h1>

<h2>Questions fréquentes</h2>
<ul class="qa">
  <li>
    <p class="question">Question</p>
    <p class="reponse">Réponse</p>
  </li>
</ul>

<h2>Commentaires</h2>
<form method="post" action="/aide/message/">
  <div class="form-group">
    <label for="messageEmail" class="col-sm-2 control-label">Courriel</label>
    <div class="col-sm-10">
      <input type="email" name="courriel" class="form-control" id="messageEmail" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="messageMessage" class="col-sm-2 control-label">Message</label>
    <div class="col-sm-10">
      <textarea rows="6" class="form-control" name="messageMessage" id="messageMessage" placeholder="Votre message"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Envoyer</button>
    </div>
  </div>
</form>
