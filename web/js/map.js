function initialize() {
    var myLatlng = new google.maps.LatLng(48.8840759, 2.3120439);
    var mapOptions = {
        zoom: 15,
        center: myLatlng
    };
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    var contentString = '<div>' +
      '<h1>Cabinet Ostéopathique Paris 17</h1>' +
      '44 rue de tocqueville, 75017 Paris<br/>' +
      '</div>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Uluru (Ayers Rock)'
    });
    infowindow.open(map, marker);
}

function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
        '&signed_in=true&callback=initialize';
    document.body.appendChild(script);
}


$(document).ready(function(){
  // ==== Load GoogleMap ====
  loadScript(); // + GOOGLEANALYTICS !!!!!!!!!!
});
