function addMarker(lat, long){
    var marker = L.marker([lat, long],).addTo(map);
    return marker;
}

function addCircle(lat,long,radius,fillColor,strokeColor){
    var circle = L.circle([lat, long], {
        color: strokeColor,
        fillColor: fillColor,
        fillOpacity: 0.5,
        radius: radius
    }).addTo(map);
    return circle;
}

function popMarker(lat,lang,title){
    marker = L.marker([lat,lang]).addTo(markerLayer)
    marker.bindPopup(title).openPopup();
}

function clearMarker(){
    markerLayer.clearLayers();
    map.closePopup();
}



var map = L.map('map').setView([-5.4088848, 105.2579765], 12);
// ACCESS_TOKEN = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
ACCESS_TOKEN = 'pk.eyJ1IjoibWFya3VzLXRvZ2kiLCJhIjoiY2xobDNtNXczMHh0cDNlbzNwOHdicHdkZyJ9.w2nTfe54hWBDARFlAFNE-g';

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 19,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken:ACCESS_TOKEN
}).addTo(map);

var markerLayer = L.layerGroup().addTo(map);
var permLayer   = L.layerGroup().addTo(map);
var routeLayer  = L.layerGroup().addTo(map);

// marNew = L.marker([-5.361098,105.291406]).addTo(permLayer);
marNew = L.marker([-5.417931,105.223731]).addTo(permLayer);

// var circle = L.circle([-5.361098,105.291406], {
var circle = L.circle([-5.417931,105.223731], {
    color: '#6BAF85',
    fillColor: '#71E99F',
    fillOpacity: 0.5,
    radius: 5000
}).addTo(permLayer);

// let myLocation = L.latLng(-5.361098,105.291406);
let myLocation = L.latLng(-5.417931,105.223731);
let wp1 = new L.Routing.Waypoint(myLocation);
