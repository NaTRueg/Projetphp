<?php


// Démarrage de la session
session_start();

// Inclusion de init
require_once '../app/init.php';


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

// Initialisation des variables
$medecins = [];

//trier les docteurs
// récupérer les valeurs des menus déroulants
$ville_id = isset($_POST['ville']) ? $_POST['ville'] : '';
$specialite_id = isset($_POST['specialite']) ? $_POST['specialite'] : '';

// construire la requête SQL en fonction des valeurs sélectionnées
$sql = "SELECT medecins.*, specialites.nom as specialite, villes.nom as ville FROM medecins
        JOIN specialites ON medecins.specialite_id = specialites.id
        JOIN villes ON medecins.ville_id = villes.id";

if (!empty($ville_id) && !empty($specialite_id)) {
    $sql .= " WHERE medecins.ville_id = $ville_id AND medecins.specialite_id = $specialite_id";
} elseif (!empty($ville_id)) {
    $sql .= " WHERE medecins.ville_id = $ville_id";
} elseif (!empty($specialite_id)) {
    $sql .= " WHERE medecins.specialite_id = $specialite_id";
}

// exécuter la requête SQL
$stmt = $pdo->query($sql);
$medecins = $stmt->fetchAll(PDO::FETCH_ASSOC);





// Définition de la variable $template
$template = '../templates/docteur';

// Inclusion du fichier base.phtml
include '../templates/base.phtml';
