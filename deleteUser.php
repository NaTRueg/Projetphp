<?php
// Démarrage de la session
session_start();

// Inclusion de la config
require_once 'config.php';

// Inclusion des dépendances
require 'fonction.php';

// Redirige vers la page d'accueil si l'utilisateur n'est pas admin
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
    header('Location: Error');
    exit();
}

// Vérification des paramètres
if (!isset($_GET['user_id'])) {
    header('Location: admin.php');
    exit();
}

// Connexion à la base de données
$pdo = getPdoConnection();

// Suppression de l'utilisateur et de ses rendez-vous
if (deleteUserAndAppointments($pdo, $_GET['user_id'])) {
    header('Location: Utilisateurs');
    exit();
} else {
    header('Location: Error');
    exit();
}
?>
