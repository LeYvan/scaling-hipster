$('#connexionModal').on('shown.bs.modal', function (event) {
  $('#nomUtilisateur').focus();
});


$('#mediaModal').on('show.bs.modal', function (event) {
  var lien = $(event.relatedTarget) // Button that triggered the modal
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text(lien.parents(".panel").find('h2').text())
  modal.find('.modal-body').html(lien.html())
});

$('#supprUserModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var id = button.data('user-id');
  var nom = button.data('user-name');
  document.getElementById('id').value = id;
  document.getElementById('suppMsg').innerHTML = nom;
});

$('#supprSinistreModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var id = button.data('sinistre-id');
  var titre = button.data('titre');
  document.getElementById('id').value = id;
  document.getElementById('suppMsg').innerHTML = titre;

});

$('#supprElementModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var id = button.data('element-id');
  var fichier = button.data('fichier');
  document.getElementById('id').value = id;
  document.getElementById('suppMsg').innerHTML = fichier;

});