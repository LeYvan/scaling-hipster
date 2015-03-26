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
        $("[name='"+e.name+"'").val(e.value);
      }
    });

    ff.fillResume();
  };

  ///
  /// Ajax avec les données du formulaire sur le serveur
  ///
  planFamilial.onSauvegarderClick = function(e){
    event.preventDefault();

    var url = $('#frmPlanFamillial').attr('action');


    var wholeData = $('#frmPlanFamillial').serializeArray();

    var strData = 'json=' + JSON.stringify(wholeData);

    $.post(url,strData)
      .done(function(data){
        if (data.success === true) {
          alert(data.message);
        } else {
          alert('Impossible de sauvegarder: ' + data.message + '.');
        }
      })
      .fail(function(){
        alert('erreur');
      });
  };

  $(document).ready(planFamilial.init);

}(window.planFamilial = window.planFamilial || {},jQuery))
