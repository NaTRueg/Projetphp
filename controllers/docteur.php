<?php


// Démarrage de la session
session_start();

// Inclusion de la config
require_once '../app/config.php';

// // Inclusion des dépendances
// require '../lib/fonction.php';

// Redirige vers la page d'accueil si l'utilisateur n'est pas admin
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
    header('Location: Error');
    exit();
}


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


// Définition de la variable $template
$template = '../templates/docteur';

// Inclusion du fichier base.phtml
include '../public/base.phtml';
