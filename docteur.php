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

// Récupération des villes
$query = "SELECT * FROM villes";
$stmt = $pdo->prepare($query);
$stmt->execute();
$villes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération des spécialités
$query = "SELECT * FROM specialites";
$stmt = $pdo->prepare($query);
$stmt->execute();
$specialites = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Récupération de tous les médecins
$medecins = getMedecins($pdo);

// Affichage : inclusion du template
$template = 'docteur';
include 'templates/base.phtml';
