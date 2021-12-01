// any CSS you import will output into a single css file (app.scss in this case)
import './scss/app.scss';

// start the Stimulus application
import 'jquery';
import 'bootstrap'
import './bootstrap';
import 'leaflet';

//var mymap = L.map('map').setView([47.5806, 6.1043], 13);

//L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    // Il est toujours bien de laisser le lien vers la source des données
   // attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
    //minZoom: 1,
    //maxZoom: 20
//}).addTo(mymap);

// Création du Marqueur

//var circle = L.circle([47.5806, 6.1043], {
    //color: 'red',
    //fillColor: '#ff0033',
    //fillOpacity: 0.5,
    //radius: 500
//}).addTo(mymap);

// Mise en place de la popup sur le marqueur
circle.bindPopup("<p>KAT Conseil <br> 2 rue André Maginet <br>70000 VESOUL</p>");