<?php
// Démarrage de la session
session_start();

setlocale(LC_TIME, 'fr_FR.UTF-8');

$utilisateur_id = $_SESSION['user_id'];


// Redirection vers la page d'accueil si la session n'est pas active
if (!isset($_SESSION['user_id'])) {
    header('Location: Accueil');
    exit;
}

// Inclusion de init
require_once '../app/init.php';



// Récupération des rendez-vous de l'utilisateur
$rdvs = getRendezVousUtilisateur($pdo, $utilisateur_id);


usort($rdvs, 'compareDates');


// foreach ($rdvs as $rdv) {
//     $date = new DateTime($rdv['date']); // créer un objet DateTime à partir de la date du rendez-vous
// }


// Définition de la variable $template
$template = '../templates/mesrdv';

// Inclusion du fichier base.phtml
include '../templates/base.phtml';
