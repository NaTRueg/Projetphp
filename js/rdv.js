function supprimerRdv(button) {
    var rdv_id = button.getAttribute('data-rdv-id');
    if (confirm("Êtes-vous sûr de vouloir supprimer ce rendez-vous?")) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    var rdv = document.getElementById('rdv-' + rdv_id);
                    rdv.parentNode.removeChild(rdv);
                } else {
                    alert('Une erreur s\'est produite. Veuillez réessayer plus tard.');
                }
            }
        };
        xhr.open('POST', 'rdvsupp', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('rdv_id=' + rdv_id);
    }
}