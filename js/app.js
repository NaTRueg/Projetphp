const menuHamburger = document.querySelector(".burger")
const navLinks = document.querySelector(".navbar-right ul")


menuHamburger.addEventListener('click', () => {
  navLinks.classList.toggle('mobile-menu')
})


let api = config.myKey;


function geoFindMe() {

    const status = document.querySelector('#status');

    function success(position) {
        const latitude  = position.coords.latitude;
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


const medecinSelect = document.getElementById('medecin_id');
  const medecinUnavailable = document.getElementById('medecin-unavailable');
  const heureInput = document.getElementById('heure');

  medecinSelect.addEventListener('change', () => {
    const selectedMedecin = medecinSelect.value;
    const selectedHeure = heureInput.value;
    // Faire une requête AJAX pour vérifier si le médecin est disponible à cette heure-là
    // Si le médecin n'est pas disponible, afficher le message d'erreur et masquer l'option du médecin
    if (medecinNonDisponible) {
      medecinUnavailable.style.display = 'block';
      medecinSelect.querySelector(`[value="${selectedMedecin}"]`).style.display = 'none';
    } else {
      medecinUnavailable.style.display = 'none';
      medecinSelect.querySelector(`[value="${selectedMedecin}"]`).style.display = 'block';
    }
  });

  heureInput.addEventListener('change', () => {
    const selectedMedecin = medecinSelect.value;
    const selectedHeure = heureInput.value;
    // Envoi d'une requête AJAX avec des données JSON
$.ajax({
    type: "POST",
    url: "url_de_votre_script_php.php",
    data: JSON.stringify({medecin_id: selectedMedecin, heure: selectedHeure}),
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    success: function(response) {
      // Traitement de la réponse
    },
    error: function(xhr, status, error) {
      // Gestion des erreurs
    }
  });
    // Si le médecin n'est pas disponible, afficher le message d'erreur et masquer l'option du médecin
    if (medecinNonDisponible) {
      medecinUnavailable.style.display = 'block';
      medecinSelect.querySelector(`[value="${selectedMedecin}"]`).style.display = 'none';
    } else {
      medecinUnavailable.style.display = 'none';
      medecinSelect.querySelector(`[value="${selectedMedecin}"]`).style.display = 'block';
    }
  });