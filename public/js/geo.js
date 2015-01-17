(function( faireface, $, undefined ) {

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};
    // Create the autocomplete object, restricting the search
    // to geographical location types.
    autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */
      (document.getElementById('adresse')),
      { types: ['geocode'] });
      // When the user selects an address from the dropdown,
      // populate the address fields in the form.
      google.maps.event.addListener(autocomplete, 'place_changed', function() {
        faireface.fillInAddress();
      });

    faireface.fillInAddress = function () {
      // Get the place details from the autocomplete object.
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

      divGeoPos.style.display = 'inline-block';

      imgPos.onload = function() { $('#divGeoPos').scrollTo('50%', 100); };

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
