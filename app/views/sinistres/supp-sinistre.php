  <div class="jumbotron">
      <div class="container">
        <h1>FaireFace</h1>
        <div class="alert alert-warning" role="alert">
          <p>Voulez-vous vraiment supprimer le sinistre "<?= $sinistre->titre ?>"?</p>

          <?php 
            echo Form::open(array('url'=>'/sinistres/' . $sinistre->id . '/supp/', 'method' => 'post'));
            echo Form::submit('Oui');
            echo Form::button('Non');
            echo Form::hidden('id',$sinistre->id);
            echo Form::close();
          ?>
          
        </div>
      </div>
  </div>