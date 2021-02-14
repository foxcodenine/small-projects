
function initMap() {
    // The location of Uluru
    let uluru = {lat: 35.899, lng: 14.485};
    // The map, centered at Uluru
    let map = new google.maps.Map(
        document.getElementById('map'), {zoom: 15, center: uluru});
    // The marker, positioned at Uluru
    let marker = new google.maps.Marker({position: uluru, map: map});
  }