(function( faireface, $, undefined ) {
    // ========================================================================
    // Private
    // ========================================================================
    var imgPos = document.createElement('span');
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
        navigator.geolocation.getCurrentPosition(faireface.genererImgCarte);
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

      var img = document.getElementById('imgGeoPos');
      img.setAttribute('src',url);
      faireface.imgPosActuelle = img;

      var geoxField = document.getElementById('geo-x');
      var geoyField = document.getElementById('geo-y');
      geoxField.setAttribute('value',latitude);
      geoyField.setAttribute('value',longitude);
    };

    // ========================================================================
    faireface.genererImgNoPos = function () {
      alert('faireface.genererImgNoPos');
      var img = document.getElementById('imgGeoPos');
      img.setAttribute('src','http://adasdasd.com/introuvable.jpg');
      faireface.imgPosActuelle = img;
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
