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

// Connexion à la base de données
$pdo = getPdoConnection();

// Récupération de tous les utilisateurs
$query = "SELECT * FROM utilisateur";
$statement = $pdo->query($query);
$users = $statement->fetchAll();

// Si un utilisateur a été supprimé, on affiche un message de confirmation
if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
    echo '<p style="color: green;">L\'utilisateur a été supprimé avec succès.</p>';
}


// Affichage : inclusion du template
$template = 'user';
include 'templates/base.phtml';