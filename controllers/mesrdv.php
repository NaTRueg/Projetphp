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

// Inclusion de la config
require_once '../app/config.php';

// // Inclusion des dépendances
// require '../lib/fonction.php';


// Récupération des rendez-vous de l'utilisateur
$rdvs = getRendezVousUtilisateur($pdo, $utilisateur_id);


usort($rdvs, 'compareDates');


foreach ($rdvs as $rdv) {
    $date = new DateTime($rdv['date']); // créer un objet DateTime à partir de la date du rendez-vous
}

$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
$formatter->setPattern('EEEE'); // définir le format pour afficher le jour de la semaine




// Définition de la variable $template
$template = '../templates/mesrdv';

// Inclusion du fichier base.phtml
include '../public/base.phtml';
