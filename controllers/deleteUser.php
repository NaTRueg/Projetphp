<?php
// Démarrage de la session
session_start();

// Inclusion de init
require_once '../app/init.php';


// Vérifie si l'utilisateur est connecté en tant qu'administrateur ou super administrateur
if (isset($_SESSION['isAdmin']) && ($_SESSION['isAdmin'] == 1 || $_SESSION['isAdmin'] == 2)) {
    // Autoriser l'accès aux pages pour les administrateurs normaux et les super administrateurs
} else {
    // Rediriger l'utilisateur vers la page d'erreur
    header('Location: Error');
    exit();
}

// Vérification des paramètres
if (!isset($_GET['user_id'])) {
    header('Location: admin.php');
    exit();
}



// Suppression de l'utilisateur et de ses rendez-vous
if (deleteUserAndAppointments($pdo, $_GET['user_id'])) {
    header('Location: Utilisateurs');
    exit();
} else {
    header('Location: Error');
    exit();
}
