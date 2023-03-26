<?php


// Démarrage de la session
session_start();

// Inclusion de la config
require_once 'config.php';

// Inclusion des dépendances
require 'fonction.php';

// Redirige vers la page d'accueil si la session n'est pas active
if (!isset($_SESSION['user_id'])) {
    header('Location: Accueil');
    exit;
}

// Connexion à la base de données
$pdo = getPdoConnection();

if (isset($_POST['delete_account']) && $_POST['delete_account'] == 1) {
    // Supprimer le compte de l'utilisateur et tous les rendez-vous liés
    deleteUserAndAppointments($pdo, $_SESSION['user_id']);
    // Supprime les informations de session et redirige vers la page de connexion
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Détruit la session
    session_destroy();

    // Rediriger l'utilisateur vers la page de connexion
    header('Location: Connexion');
    exit();
}

// Affichage : inclusion du template
$template = 'account';
include 'templates/base.phtml';