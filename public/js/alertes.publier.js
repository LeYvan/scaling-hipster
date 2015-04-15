(function( ff_pub_alerte, $, undefined ) {


  if(window.location.href.indexOf("/alertes") === -1) {
     return;
  }

  if(window.location.href.indexOf("/alertes/publier") > -1) {
    var imgPreview = document.getElementById('imgPreview');
    var divPreview = imgPreview.parentNode;
    var lat = document.getElementById('lat');
    var long = document.getElementById('long');

    $('#cmdSelAdresse').hide();

    var autocomplete = new google.maps.places.Autocomplete(
      (document.getElementById('_adresse')),
      { types: ['geocode'] }
    );

    // Autcomplete stuff
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      ff_pub_alerte.fillInAddress();
    });
  }

  // Autocomplete select
  ff_pub_alerte.fillInAddress = function () {
    var place = autocomplete.getPlace();

    ff_pub_alerte.coords = {
      coords: {
        latitude: place.geometry.location.lat(),
        longitude: place.geometry.location.lng()
      }
    };

    var imgNewPos = ff_pub_alerte.genererImgCarte(ff_pub_alerte.coords);
    imgNewPos.id = 'imgPreview';

    imgPreview = document.getElementById('imgPreview');
    divPreview.removeChild(imgPreview);
    divPreview.appendChild(imgNewPos);

    $('#cmdSelAdresse').show();

    lat.setAttribute('value',ff_pub_alerte.coords.latitude);
    long.setAttribute('value',ff_pub_alerte.coords.longitude);
  }

    ff_pub_alerte.genererImgCarte = function (position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;

      var base ='https://maps.googleapis.com/maps/api/staticmap?';
      var coords = '' + latitude + ',' + longitude;
      var center = 'center=' + coords;
      var zoom = 'zoom=15';
      var size = 'size=400x400';
      var maptype = 'maptype=roadmap';

      var url = base + center + '&'
                + zoom + '&'
                + size + '&'
                + maptype + '&'
                + 'markers=color:red%7Clabel:C%7C' + coords + '&key=AIzaSyAWDDvWulCh3nBVbzPuGjy_yZ26PePG23k';

      var img = document.createElement('img');
      img.setAttribute('src',url);
      return img;
    };

    ff_pub_alerte.selectCategorie = function(categorie) {
      ff_pub_alerte.categorie_id = categorie;
      alert(categorie);
    };



  function createCookie(name, value, days) {
      var expires;

      if (days) {
          var date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          expires = "; expires=" + date.toGMTString();
      } else {
          expires = "";
      }
      document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
  }

  function readCookie(name) {
      var nameEQ = encodeURIComponent(name) + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) === ' ') c = c.substring(1, c.length);
          if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
      }
      return null;
  }

  // var afficherInfoSms = readCookie("divInfoSms");

  // if (afficherInfoSms == null) {
  //   afficherInfoSms=true;
  // }

  // if (afficherInfoSms == "false") {
  //   $('#divInfoSms').hide();
  // } else {
  //   $('#divInfoSms').click(function(){
  //     createCookie("divInfoSms","false",360);
  //   });
  // }


  $( "#trouverAdresseModel" ).on('shown.bs.modal', function(){
      $('#_adresse').focus();
  });

  $('#cmdAdresse').click(function() {
    event.preventDefault();
    $('#trouverAdresseModel').modal('show');
  });


  $('#cmdCancelAdresse').click(function() {
    event.preventDefault();
    $('#trouverAdresseModel').modal('hide');
  });

  $('#cmdSelAdresse').click(function() {
    event.preventDefault();

    $('#lat').val(ff_pub_alerte.coords.coords.latitude);
    $('#long').val(ff_pub_alerte.coords.coords.longitude);

    $('#trouverAdresseModel').modal('hide');
  });

  $(function(){

      $("#categorieSel .dropdown-menu li a").click(function(){

        $("#categorieSel .btn:first-child").text($(this).text());
        $("#categorieSel .btn:first-child").val($(this).text());

        $('#categorie_id').val($(this).data('id'));
     });


       $('#frmPublier').validate();

       // Ce click simulé sélectionne la première catégorie d'alertes.
       $('#categorieSel a[data-id]:first').click();


  });

  $('#cmdEnvoyer').click(function() {

    if(true) {
      // rien
    }
    else {
        // on envoie rien
        event.preventDefault();
    }

  });


}( window.ff_pub_alerte = window.ff_pub_alerte || {}, jQuery ));
