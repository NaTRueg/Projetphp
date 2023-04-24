
window.addEventListener("beforeunload", function() {
    document.body.style.opacity = "0";
    setTimeout(function() {
      document.body.style.opacity = "1";
    }, 1000); // ajustez la durée de fondu selon vos besoins
  });
  

window.onload = function() {
    document.body.style.opacity = "1";
  }




const menuHamburger = document.querySelector(".burger")
const navLinks = document.querySelector(".navbar-right ul")


menuHamburger.addEventListener('click', () => {
    navLinks.classList.toggle('mobile-menu')
})


let api = config.myKey;


function geoFindMe() {

    const status = document.querySelector('#status');

    function success(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        // Récupérer l'élément iframe par son identifiant
        const mapIframe = document.getElementById("map-iframe");

        // Construire la nouvelle URL de la carte Google Maps avec les coordonnées géographiques récupérées
        const mapUrl = `https://www.google.com/maps/embed/v1/search?q=doctor%20near%20me&center=${latitude},${longitude}&zoom=14&key=${api}`;
        // const mapUrl = `https://www.google.com/maps/embed/v1/search?q=doctor&center=${latitude},${longitude}&zoom=14&key=${api}`;
        // Mettre à jour la source de l'iframe avec la nouvelle URL de la carte Google Maps
        mapIframe.src = mapUrl;

        // Afficher les coordonnées géographiques récupérées
        status.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
    }

    function error() {
        status.textContent = "Unable to retrieve your location";
    }

    if (!navigator.geolocation) {
        status.textContent = "Geolocation is not supported by your browser";
    } else {
        status.textContent = "Locating…";
        navigator.geolocation.getCurrentPosition(success, error);
    }
}

document.querySelector('#find-me').addEventListener('click', geoFindMe);




