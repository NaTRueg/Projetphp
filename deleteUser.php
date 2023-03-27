<?php
// Démarrage de la session
session_start();

// Inclusion de la config
require_once 'config.php';

// Inclusion des dépendances
require 'fonction.php';

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
