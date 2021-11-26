/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './scss/app.scss';

// start the Stimulus application
import 'jquery';
import 'bootstrap'
import './bootstrap';
import 'leaflet';


var mymap = L.map('map').setView([51.505, -0.09], 13);

L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    // Il est toujours bien de laisser le lien vers la source des données
    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
    minZoom: 1,
    maxZoom: 20
}).addTo(mymap);

// Création du Marqueur

//var circle = L.circle([47.651014, 6.131399], {
   // color: 'red',
    //fillColor: '#f03',
    //fillOpacity: 0.5,
    //radius: 500
//}).addTo(mymap);

// Mise en place de la popup sur le marqueur
//circle.bindPopup("<p>Sekom Digital <br> 26 rue Gustave Courtois <br>70000 PUSEY</p>");