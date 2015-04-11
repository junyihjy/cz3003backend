// This example displays a marker at the center of Singapore.
// When the user clicks the marker, an info window opens.

var incidentMarkers = [];
var dengueMarkers = [];
var infoWindow;
var map;
var weatherLayer;
var ctaLayer;

function addIncidentMarker(location, title, catID) {
    
    var icon;
    
    switch(catID) {
        case 1: icon = 'http://labs.google.com/ridefinder/images/mm_20_blue.png';
            break;
        case 2: icon = 'http://labs.google.com/ridefinder/images/mm_20_red.png';
            break;
        case 3: icon = 'http://labs.google.com/ridefinder/images/mm_20_yellow.png';
            break;
        case 4: icon = 'http://labs.google.com/ridefinder/images/mm_20_green.png';
            break;
        default: icon = '';
    }
    
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
        title: title
    });
    incidentMarkers.push(marker);
}


function addDengueMarker(polygon, severity) {
    var stroke;
    var fill;
    
    if (severity == 'Alert') {
        //red
        fill = "red";
    } else {
        //yellow
        fill = "yellow";
    }

    var gpolygon = new google.maps.Polygon({
      paths: polygon,
      strokeOpacity:  0.8,
      strokeWeight:   2,
      fillColor:  fill,
      fillOpacity:    0.4,
    });

    gpolygon.setMap(map);
    dengueMarkers.push(gpolygon);
}

function addRoadMarkerListener(i, title, content) {
    google.maps.event.addListener(roadMarkers[i], 'click', function() { 
        if (infoWindow) {
            infoWindow.close();
        }
        
        infoWindow = new google.maps.InfoWindow({
            content: '<div id="content"><h5 id="firstHeading" class="firstHeading">' + title + '</h5><div id="bodyContent"><p>' + content + '</p></div></div>'
        });
        
        infoWindow.open(map, roadMarkers[i]);
    });
}

function initializeWeatherLayer(map) {
    weatherLayer = new google.maps.weather.WeatherLayer({
        temperatureUnits: google.maps.weather.TemperatureUnit.FAHRENHEIT
    });
}

function showWeather() {
    weatherLayer.setMap(map);
}

function clearWeather() {
    weatherLayer.setMap(null);
}

function toggleWeather(btn) {
    if(btn.checked == true) {
        showWeather();
    } else {
        clearWeather();
    }
}

function showRegionOverlays() {
    ctaLayer.setMap(map);
}

function hideRegionOverlays() {
    ctaLayer.setMap(null);
}

function toggleRegionOverlays(btn) {
    if (btn.checked == true) {
        showRegionOverlays();
    } else {
        hideRegionOverlays();
    }
}

function initialize() {
    //initialize map
    var mapCenterLatLng = new google.maps.LatLng(1.337831, 103.832363);
    var mapOptions = {
      zoom: 11,
      center: mapCenterLatLng
    };

    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    infoWindow = null;
    
    //initialize weather layer
    initializeWeatherLayer(map);
    
    ctaLayer = new google.maps.KmlLayer({
      url: 'https://dl.dropboxusercontent.com/u/18619627/timecrisis/map.kmz',
    });

    var polygons = [];
    
    $.getJSON("/dengue.json", function( data ) {
      for(i = 0; i < data.length; i++){
        var points = data[i].polygon.split("|");
        var polygon = [];
        var bounds = new google.maps.LatLngBounds();

        for (var j = 0; j < points.length; j++) {
          points[j] = points[j].split(",");
          polygon.push(new google.maps.LatLng(parseFloat(points[j][0]), parseFloat(points[j][1])));
        };

        for (var j = 0; j < points.length; j++) {
            bounds.extend(polygon[j]);
        }

        addDengueMarker(polygon, data[i].severity);
        addDengueMarkerListener(i, data[i].region, data[i].severity, data[i].noOfPeopleInfected, bounds.getCenter());
      }

    });

    $.getJSON("/incident.json", function( data ) {
      for(i = 0; i < data.length; i++){
        marker = [new google.maps.LatLng(data[i].latitude, data[i].longitude), data[i].incidentTitle, data[i].incidentDetails, data[i].incidentCategoryID];

        addIncidentMarker(marker[0], marker[1], marker[3]);
        //addIncidentMarkerListener(i, marker[1], marker[2]);
      }
    });

}

google.maps.event.addDomListener(window, 'load', initialize);