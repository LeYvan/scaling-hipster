  <div class="jumbotron">
      <div class="container">
        <h1>FaireFace</h1>
        <div class="alert alert-warning" role="alert">
          <p>Voulez-vous vraiment supprimer le sinistre "<?= $sinistre->titre ?>"?</p>

          <?php 
            echo Form::open(array('url'=>'/sinistres/' . $sinistre->id . '/supp/'));
            echo Form::submit('Oui');
            echo Form::button('Non');
            echo Form::hidden('id',$element->id);
            echo Form::close();
          ?>

          <a href="<?=$id?>" type="button" class="btn btn-default">Oui</a>
          <a href="javascript:history.back();" type="button" class="btn btn-default">Non</a>
        </div>
      </div>
  </div>