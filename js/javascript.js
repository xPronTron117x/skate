var map;
// var marker;
var infowindow;
var messagewindow;
var allOfTheMarkers = [];
var userSelectedMarker = null;


function initMap(){
  var Purch = {lat: 41.0486305, lng: -73.701121 };
  map = new google.maps.Map(document.getElementById('map'), {
    center: Purch,
    zoom: 17,
    mapTypeId:'hybrid',
  });

  // var allOfTheLocations = locationsInfo;
  console.log(locationsInfo);
  // create markers for all of the locations..
  for(var index = 0; index < locationsInfo.length; index++)
  {
    var thisLat  = parseFloat(locationsInfo[index].lat);
    var thisLong = parseFloat(locationsInfo[index].lng);
    var latAndLong = {lat:thisLat,lng:thisLong};
    var config = {position:latAndLong};
    var thisMarker = new google.maps.Marker(config);
    // add click event listener for thisMarker
    addAClickListener(locationsInfo, index,thisMarker);


    thisMarker.setMap(map); // put this marker on the map..
  }

    // infowindow = new google.maps.InfoWindow({
    //     content: document.getElementById('form')
    // });

    // messagewindow = new google.maps.InfoWindow({
    //     content: document.getElementById('message')
    // });

    google.maps.event.addListener(map, 'click', function(event)
    {

        var marker = new google.maps.Marker({
            position: event.latLng,
            animation: google.maps.Animation.DROP,

          //  map: map
        });

        var infowindow = new google.maps.InfoWindow({
            content: document.getElementById('form')
        });

          // marker.setIcon('images/wheel.png')

        marker.addListener("click", function()
        {
          infowindow.open(map, marker);
          userSelectedMarker = marker;
        });
        allOfTheMarkers.push(marker);
        google.maps.event.addListener(marker, 'click', function()
        {
            infowindow.open(map, marker);
        });

        marker.setMap(map);

    });
}


function addAClickListener(locations, i, aMarker)
{
  aMarker.addListener("click", function()
  {
    document.getElementById("info-name").innerHTML = locations[i].name;
    document.getElementById("info-rating").innerHTML = locations[i].rating;
    document.getElementById("info-type").innerHTML = locations[i].type;
  });
}



  // for(var index = 0; index < locations.length; index++)
  // {
  //
  // }

// function saveData() {
//     var name = escape(document.getElementById('name').value);
//     var address = escape(document.getElementById('address').value);
//     var type = document.getElementById('type').value;
//     var latlng = marker.getPosition();
//     var url = 'phpsqlinfo_addrow.php?name=' + name + '&address=' + address +
//                   '&type=' + type + '&lat=' + latlng.lat() + '&lng=' + latlng.lng();
//
//     downloadUrl(url, function(data, responseCode) {
//
//         if (responseCode == 200 && data.length <= 1) {
//             infowindow.close();
//             messagewindow.open(map, marker);
//         }
//     });
// }

// function downloadUrl(url, callback) {
//     var request = window.ActiveXObject ?
//     new ActiveXObject('Microsoft.XMLHTTP') :
//     new XMLHttpRequest;
//
//     request.onreadystatechange = function() {
//         if (request.readyState == 4) {
//             request.onreadystatechange = doNothing;
//             callback(request.responseText, request.status);
//         }
//     };
//
//     request.open('GET', url, true);
//     request.send(null);
// }
//
// function doNothing () {
// }
