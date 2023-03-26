<?php


// Démarrage de la session
session_start();

// Détruit toutes les variables de session
$_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Détruit la session
session_destroy();

// Message flash de succès
$_SESSION['flash'] = 'Vous êtes maintenant déconnecté. À bientôt !';

// Redirection vers la page de connexion
header('Location: Accueil');
exit;

// Affichage : inclusion du template
$template = 'logout';
include 'templates/base.phtml';