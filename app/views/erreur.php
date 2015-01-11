  <div class="jumbotron">
      <div class="container">
      <h1>FaireFace</h1>
      <p class="alert alert-danger" role="alert">Erreur!</p>
      <?php if (isset($message)) { ?>
      <div class="well">
        <p><?= $message ?></p>
      </div>
      <?php } ?>
      </div>
  </div>