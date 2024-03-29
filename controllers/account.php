<?php


// Démarrage de la session
session_start();

// Inclusion de init
require_once '../app/init.php';



// Redirige vers la page d'accueil si la session n'est pas active
if (!isset($_SESSION['user_id'])) {
    header('Location: Accueil');
    exit;
}

$email = isset($_SESSION['user_id']) ? $user->getUserEmail($_SESSION['user_id']) : null;
$nom = isset($_SESSION['user_id']) ? $user->getUserName($_SESSION['user_id']) : null;
$prenom = isset($_SESSION['user_id']) ? $user->getUserFirstname($_SESSION['user_id']) : null;
$age = isset($_SESSION['user_id']) ? $user->getUserAge($_SESSION['user_id']) : null;


if (isset($_POST['delete_account']) && $_POST['delete_account'] == 1) {
    // Supprimer le compte de l'utilisateur et tous les rendez-vous liés
    deleteUserAndAppointments($pdo, $_SESSION['user_id']);
    // Supprime les informations de session et redirige vers la page de connexion
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Enregistrer les variables de session de l'utilisateur dans un tableau temporaire
    $userSession = array();
    foreach ($_SESSION as $key => $value) {
        if (strpos($key, 'user_') === 0) {
            $userSession[$key] = $value;
        }
    }

    // Supprimer toutes les variables de session
    $_SESSION = array();

    // Réinitialiser la session avec les variables qui n'ont pas été supprimées
    foreach ($userSession as $key => $value) {
        $_SESSION[$key] = $value;
    }

    // Détruit la session
    session_destroy();

    // Rediriger l'utilisateur vers la page de connexion
    header('Location: Connexion');
    exit();
}


// Définition de la variable $template
$template = '../templates/account';

// Inclusion du fichier base.phtml
include '../templates/base.phtml';
