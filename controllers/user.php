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

// Récupération de tous les utilisateurs
$query = "SELECT * FROM utilisateur";
$statement = $pdo->query($query);
$users = $statement->fetchAll();

// Si un utilisateur a été supprimé, on affiche un message de confirmation
if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
    echo '<p style="color: green;">L\'utilisateur a été supprimé avec succès.</p>';
}


// Définition de la variable $template
$template = '../templates/user';

// Inclusion du fichier base.phtml
include '../templates/base.phtml';
