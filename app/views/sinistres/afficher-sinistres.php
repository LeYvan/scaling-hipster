<div id="page" class="container">

    <h1>Sinistres</h1>

      <div class="panel">
        <a href="/sinistres/ajouter.php"><h4><span class="label label-warning"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>Publier un noueau rapport</span></h4></a>
      </div>

      <div class="row">

        <!-- Liste des catégories de sinistres -->
        <div class="col-md-3 col-md-push-9">
          <div class="list-group">
            <a href="/" class="list-group-item active">
              Toutes les catégories
            </a>
            <?php

              foreach($categories as $categorie)
              {
                print("<a href=\"/sinistres/\" class=\"list-group-item\">" . $categorie->etiquette . "</a>");
              }

            ?>
          </div>
        </div>
        <!-- Fin liste des catégories de sinistres -->

        <div class="col-md-9 col-md-pull-3">

            <!-- Début d'un sinistre -->
            <?php foreach($sinistres as $sinistre) { ?>

            <div class="media">

              <div class="media-body">
                <h2 class="media-heading"><?= $sinistre->titre ?></h2>
                <h4>
                  <span class="label label-default"><?= $sinistre->categorie()->etiquette ?></span>
                </h4>
                <h4>
                  <div><span class="label label-primary">Créateur:</span>  <?= $sinistre->utilisateur()->nom ?></div>
                </h4>
                <div class="well"><?= $sinistre->rapport ?></div>
              </div>

              <a class="media-right" href="javascript:alert('Carte')">
                <canvas height="100%" width="100%" style="background-color:#F47B2D;"></canvas>
              </a>

              <div class="row">

                <div class="col-xs-6 col-sm-4 col-lg-3">
                  <a href="#" class="thumbnail" data-toggle="modal" data-target="#mediaModal">
                    <!-- <img alt="Image envoyée par un utilisateur" src="http://validator.w3.org/images/w3c.png"> -->
                    <pre>Ici les médias.</pre>
                  </a>

                </div>
                <div class="col-xs-6 col-sm-4 col-lg-3">
                  <a href="#" class="thumbnail" data-toggle="modal" data-target="#mediaModal">
                    <!--
                    <video width="100%" controls>
                      <source src="images/videoplayback.mp4" type="video/mp4">
                    </video>
                    -->
                    <pre>Ici les médias.</pre>
                  </a>
                </div>

              </div>

            </div>
            <?php } ?>
            <!-- Fin d'un sinistre -->

          <!-- Fenêtre modal de visionnement d'images -->
          <div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="mediaModalLabel">Titre</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Fin Fenêtre modal de visionnement d'images -->

        </div>

      </div>
</div>

<script>
$('#mediaModal').on('show.bs.modal', function (event) {
  var lien = $(event.relatedTarget) // Button that triggered the modal
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text(lien.parents(".media").find('.media-heading').text())
  modal.find('.modal-body').html(lien.html())
})

var canvas = document.getElementsByTagName("canvas");
for (var i = 0; i < canvas.length; i++) {
  var c = canvas[i];
  var size = c.height;
    var ctx = c.getContext("2d");

    var x = Math.random()*size;
    var y = Math.random()*size;
    // ctx.moveTo(x,0);
    // ctx.lineTo(x,size);
    // ctx.stroke();

    // ctx.moveTo(0,y);
    // ctx.lineTo(size,y);
    // ctx.stroke();

    ctx.font="30px Arial";
    // ctx.arc(x,y,size/50,0,2*Math.PI);
    ctx.fillText("📍",x, y);
    // ctx.fill();
}
</script>