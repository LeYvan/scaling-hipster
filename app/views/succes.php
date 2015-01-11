    <div class="jumbotron">
      <div class="container">
      <h1>FaireFace</h1>
      <p class="alert alert-success" role="alert">Succès!</p>
      <?php if (isset($message)) { ?>
      <div class="well">
        <?= $message ?>
      </div>
      <?php } ?>
      </div>
  </div>