$('#mediaModal').on('show.bs.modal', function (event) {
  var lien = $(event.relatedTarget) // Button that triggered the modal
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text(lien.parents(".panel").find('h2').text())
  modal.find('.modal-body').html(lien.html())
})

function trouverGeoPos() {
  if (Modernizr.geolocation) {
    navigator.geolocation.getCurrentPosition(show_map);
  } else {
    // no native support; maybe try a fallback?
  }
}

function genererImgCarte(position) {
  var latitude = position.coords.latitude;
  var longitude = position.coords.longitude;

  var zoom = '17';
  var base ='https://maps.googleapis.com/maps/api/staticmap?';
  var coords = '' + latitude + ',' + longitude;
  var center = 'center=' + coords;
  var zoom = 'zoom=13';
  var size = 'size=250x250';
  var maptype = 'maptype=roadmap';

  var url = base + center + '&' 
            + zoom + '&' 
            + size + '&' 
            + maptype + '&' 
            + 'markers=color:red%7Clabel:C%7C' + coords;

  var img = document.createElement('img');
}