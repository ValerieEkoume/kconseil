/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './scss/app.scss';
import './map';
// start the Stimulus application
import 'jquery';
import 'bootstrap'
import './bootstrap';
import 'leaflet';

const storageType = localStorage;
const consentPropertyName = 'katcons_consent'

const shouldShowPopup = () => storageType.getItem(consentPropertyName);
const saveToStorage = () => storageType.getItem(consentPropertyName, true);

window.onload = () => {
    if (shouldShowPopup()) {
        const consent = confirm('Ce site web utilise des cookies');
            if (consent) {
                saveToStorage();
            }
    }
};





// Création du Marqueur

//var circle = L.circle([47.651014, 6.131399], {
   // color: 'red',
    //fillColor: '#f03',
    //fillOpacity: 0.5,
    //radius: 500
//}).addTo(mymap);

// Mise en place de la popup sur le marqueur
//circle.bindPopup("<p>Sekom Digital <br> 26 rue Gustave Courtois <br>70000 PUSEY</p>");