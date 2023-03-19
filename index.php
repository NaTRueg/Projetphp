<?php 


// Démarrage de la session
session_start();

// Inclusion de la config
require_once 'config.php';

// Inclusion des dépendances
require 'fonction.php';



// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    // Utilisateur connecté - Afficher ou masquer des éléments de votre site
    echo "Bonjour ! Vous êtes connecté.";

    // Afficher un bouton de déconnexion
    echo "<a href='connexion.php'>Déconnexion</a>";
}




// Affichage : inclusion du template
$template = 'index';
include 'templates/base.phtml';


