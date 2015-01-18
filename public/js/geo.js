(function( faireface, $, undefined ) {
  var cmdFichiers = document.getElementById('filebutton');
  var lblNbFichiers = document.getElementById('lblNbFichiers');
  var shadowCmdFichier;

    // Pour afficher un beau bouton de sélection de fichier
    var styliserBoutonFichier = function() {
      var shadow = cmdFichiers.createShadowRoot();
      shadow.innerHTML = '<style> @import "/css/bootstrap.min.css"; </style><button type="button" class="btn btn-info">Photos & Vidéos</button>';
      cmdFichiers.addEventListener( "keydown", function( event ) {
          if ( event.keyCode === 13 || event.keyCode === 32 ) {
              cmdFichiers.click();
          }
      });
    };

  cmdFichiers.onchange = function( event ) {
    lblNbFichiers.innerHTML = this.files.length + ' fichiers' ;
  };

    styliserBoutonFichier();

    var autocomplete = new google.maps.places.Autocomplete(
      (document.getElementById('adresse')),
      { types: ['geocode'] }
    );

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      faireface.fillInAddress();
    });

    faireface.fillInAddress = function () {

      var place = autocomplete.getPlace();

      faireface.genererImgCarte({
        coords: {
          latitude: place.geometry.location.lat(),
          longitude: place.geometry.location.lng()
        }
      });
    }

    // ========================================================================
    // Private
    // ========================================================================
    var imgPos = document.getElementById('imgGeoPos');
    var txtAdresse = document.getElementById('adresse');
    var lblPosition = document.getElementById('lblPosition');
    var geoxField = document.getElementById('geo-x');
    var geoyField = document.getElementById('geo-y');
    var divGeoPos = document.getElementById('divGeoPos');
    var divAdresse = document.getElementById('divAdresse');
    // ========================================================================
    faireface.getImgPos = function() {
      return imgPos;
    };
    // ========================================================================
    faireface.setImgPos = function(img) {
      imgPos = img;
    };
    // ========================================================================

    // ========================================================================
    // Public
    // ========================================================================
    faireface.test = function() {
      alert('faireface.test');
    };

    // ========================================================================
    faireface.trouverGeoPos = function () {
      if (Modernizr.geolocation) {
        $('#divAdresse').hide();
        navigator.geolocation.getCurrentPosition(faireface.genererImgCarte,faireface.genererImgNoPos);
      } else {
        genererImgNoPos();
      }
    };

    // ========================================================================
    faireface.genererImgCarte = function (position) {
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

      divGeoPos.style.display = 'inline-block';
      txtAdresse.value = '_';

      imgPos.onload = function() { $('#divGeoPos').scrollTo('50%', 100); };

      imgPos.setAttribute('src',url);
      geoxField.setAttribute('value',latitude);
      geoyField.setAttribute('value',longitude);
    };

    // ========================================================================
    faireface.genererImgNoPos = function (error) {
      $('#divAdresse').show();
      divGeoPos.style.display = 'none';
      lblPosition.innerHTML  = 'Adresse';
      txtAdresse.style.display = 'inline';
    };

}( window.faireface = window.faireface || {}, jQuery ));

faireface.trouverGeoPos();
