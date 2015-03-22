var ff = {};
ff.fillResume = function (e) {
  $('#resume-contenu').empty().append($('.tab-pane:not(#resume)>*').clone());
  $('#resume-contenu :input').replaceWith(function (){
    var id = $(this).attr('id');
    $(this).removeAttr('id');
    return '<p class="form-control-static">'+$('#'+id).val()+'</p>'
  });
  // $('#resume-contenu h2').replaceWith(function(){
  //   return '<h3>'+$(this).text()+'</h3>';
  // });

  // e.target; // newly activated tab
  // e.relatedTarget; // previous active tab
}

$(document).ready(function(){
  ff.fillResume();
});

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


$('#cmdUnsub').click(function () {
  event.preventDefault();
  window.location = '/profile/unsub/';
});

$('#btnImprimer').click(function () {
  window.print();
})

$('a[data-toggle="tab"][href="#resume"]').on('show.bs.tab', function (e){ff.fillResume(e)});

$('#frmPlanFamillial').on( "submit", function(event){
  var chaineSerialisee = $( this ).serialize(); // Défini une variable qui contient la sérialisation
  event.preventDefault(); // Empêche le formulaire de s'envoyer par lui-même

/***************************************\
|**             À FAIRE :             **|
|** Envoyer la chaîne sérialisée vers **|
|**           l'application           **|
|**                                   **|
|**   Aller voir ce qu'il y a faire   **|
|**                                   **|
|**              Merci :)             **|
\***************************************/

});