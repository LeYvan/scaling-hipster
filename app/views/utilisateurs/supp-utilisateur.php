  <div class="jumbotron">
      <div class="container">
        <h1>FaireFace</h1>
        <div class="alert alert-warning" role="alert">
          <p>Voulez-vous vraiment supprimer l'utilisateur "<?= $utilisateur->nom ?>" ?</p>
        

          <?php 
            echo Form::open(array('url'=>'/utilisateurs/' . $utilisateur->id . '/supprimer'));
            echo Form::submit('Oui');
            echo Form::button('Non');
            echo Form::hidden('id',$utilisateur->id);
            echo Form::close();
          ?>
        </div>
      </div>
  </div>