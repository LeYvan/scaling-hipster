(function(planFamilial, $, undefined){

  planFamilial.init = function(){
    $('#btnSauvegarder').click(planFamilial.onSauvegarderClick);
    planFamilial.recupererPlan();
  };


  ///
  /// Tente de récupérer les données de l'utilisateur.
  ///
  planFamilial.recupererPlan = function(){
    var url = '/plan/recuperer/';

    $.post(url)
      .done(function(data){
        if (data.success === true) {
          var formData = JSON.parse(data.json);
          planFamilial.fillForm(formData);
        }
      })
      .fail(function(){
        alert('erreur recupererPlan');
      });
  };

  ///
  /// Rempli le formulaire avec les données recues en ajax.
  ///
  planFamilial.fillForm = function(data) {

    $(data).each(function(i,e){
      if (e.value != undefined) {
        $("[name='"+e.name+"']").val(e.value);
      }
    });

    ff.fillResume();
  };

  ///
  /// Ajax avec les données du formulaire sur le serveur
  ///
  planFamilial.onSauvegarderClick = function(e){
    event.preventDefault();

    var validator = $('#frmPlanFamilial').validate({

    });

    $('input:visible, textarea:visible').each(function(i,e){
      e.focus();
      validator.element(e);
    });

    if (!validator.valid() || $('input:visible.error').length > 0) {
      return;
    }

    var url = $('#frmPlanFamilial').attr('action');


    var wholeData = $('#frmPlanFamilial').serializeArray();

    var strData = 'json=' + JSON.stringify(wholeData);

    $.post(url,strData)
      .done(function(data){
        if (data.success === true) {

          $('#alerts').empty();
          $('#alerts').append('<div class="alert alert-success alert-dismissible" role="alert">\r\n<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\r\n           <p>\r\n          		<strong>Succes! </strong> Les informations sont enregistrées.\r\n            </p>\r\n          </div>');

        } else {
          $('#alerts').empty();
          $('#alerts').append('<div class="alert alert-danger alert-dismissible" role="alert">\r\n<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\r\n           <p>\r\n          		<strong>Erreur! </strong> Les informations ne sont pas enregistrées.\r\n            </p>\r\n          </div>');
        }
      })
      .fail(function(){
        $('#alerts').empty();
        $('#alerts').append('<div class="alert alert-danger alert-dismissible" role="alert">\r\n<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\r\n           <p>\r\n          		<strong>Erreur! </strong> Impossible de contacté le serveur.\r\n            </p>\r\n          </div>');
      });
  };

  $(document).ready(planFamilial.init);

}(window.planFamilial = window.planFamilial || {},jQuery))
