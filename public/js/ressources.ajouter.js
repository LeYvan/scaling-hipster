(function( ff_ressources, $, undefined ) {

  if(window.location.href.indexOf("/ressources") === -1) {
     return;
  }

  $(document).ready(function(){

      $("#categorieSel .dropdown-menu li a").click(function(){

        $("#categorieSel .btn:first-child").text($(this).text());
        $("#categorieSel .btn:first-child").val($(this).text());

        $('#categorie_id').val($(this).data('id'));
     });

     var categorie_id = $('#categorie_id').val();
     if (categorie_id != undefined){
       var text = $("#categorieSel ul li [data-id='"+categorie_id+"']").text();

       $("#categorieSel .btn:first-child").text(text);
       $("#categorieSel .btn:first-child").val(categorie_id);
     }

  });

}( window.ff_ressources = window.ff_ressources || {}, jQuery ));
