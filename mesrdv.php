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





// Affichage : inclusion du template
$template = 'mesrdv';
include 'templates/base.phtml';