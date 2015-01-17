(function( faireface, $, undefined ) {
    // ========================================================================
    // Private
    // ========================================================================
    var imgPos = document.getElementById('imgGeoPos');
    var txtAdresse = document.getElementById('adresse');
    var lblPosition = document.getElementById('lblPosition');
    var geoxField = document.getElementById('geo-x');
    var geoyField = document.getElementById('geo-y');
    var divGeoPos = document.getElementById('divGeoPos');
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
        txtAdresse.visibility = 'hidden';
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
                + 'markers=color:red%7Clabel:C%7C' + coords;

      imgPos.setAttribute('src',url);
      geoxField.setAttribute('value',latitude);
      geoyField.setAttribute('value',longitude);
    };

    // ========================================================================
    faireface.genererImgNoPos = function (error) {
      //alert(imgPos.visibility );
      //imgPos.style.visibility = 'collapse  ';
      divGeoPos.style.display = 'none';
      lblPosition.innerHTML  = 'Adresse';
      txtAdresse.style.display = 'inline';
      //img.setAttribute('src','http://adasdasd.com/introuvable.jpg');
    };

    //Private Method
    /*
    function addItem( item ) {
        if ( item !== undefined ) {
            console.log( "Adding " + $.trim(item) );
        }
    }
    */
}( window.faireface = window.faireface || {}, jQuery ));

faireface.trouverGeoPos();
