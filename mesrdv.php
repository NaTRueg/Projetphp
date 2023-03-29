<?php
// Démarrage de la session
session_start();


$utilisateur_id = $_SESSION['user_id'];


// Redirection vers la page d'accueil si la session n'est pas active
if (!isset($_SESSION['user_id'])) {
    header('Location: Accueil');
    exit;
}

// Inclusion de la configuration et des fonctions
require_once 'config.php';
require 'fonction.php';

// Connexion à la base de données
$pdo = getPdoConnection();

$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

// Récupération des rendez-vous de l'utilisateur
$rdvs = getRendezVousUtilisateur($pdo, $utilisateur_id);

// Tri des rendez-vous par date
function compareDates($a, $b)
{
    $dateA = strtotime($a['date'] . ' ' . $a['heure']);
    $dateB = strtotime($b['date'] . ' ' . $b['heure']);
    if ($dateA == $dateB) {
        return 0;
    }
    return ($dateA < $dateB) ? -1 : 1;
}
usort($rdvs, 'compareDates');




// Affichage : inclusion du template
$template = 'mesrdv';
include 'templates/base.phtml';
