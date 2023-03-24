<?php
// Démarrage de la session
session_start();

// Redirige vers la page d'accueil si la session n'est pas active
if (!isset($_SESSION['user_id'])) {
    header('Location: Accueil');
    exit;
}

// Inclusion de la configuration et des fonctions
require_once 'config.php';
require 'fonction.php';

// Connexion à la base de données
$pdo = getPdoConnection();

// Redirection vers le formulaire de rendez-vous si la date et l'heure n'ont pas été sélectionnées
if (!isset($_SESSION['date']) || !isset($_SESSION['heure'])) {
    header('Location: rdv.php');
    exit;
}

// Récupération des villes
$villes = $pdo->query("SELECT * FROM villes")->fetchAll(PDO::FETCH_ASSOC);

// Récupération des spécialités
$specialites = $pdo->query("SELECT * FROM specialites")->fetchAll(PDO::FETCH_ASSOC);

// Vérification des données du formulaire de sélection
if (isset($_POST['ville'], $_POST['specialite'], $_POST['medecin_id'])) {
    $ville_id = $_POST['ville'];
    $specialite_id = $_POST['specialite'];
    $medecin_id = $_POST['medecin_id'];
    $date = $_SESSION['date'];
    $heure = $_SESSION['heure'];

    // Vérification de la disponibilité du médecin à la date et heure choisies
    $query = "SELECT * FROM medecins WHERE ville_id = :ville_id AND specialite_id = :specialite_id AND id = :medecin_id AND NOT EXISTS (SELECT * FROM rendez_vous WHERE medecin_id = :medecin_id AND date = :date AND heure = :heure)";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':ville_id', $ville_id);
    $stmt->bindValue(':specialite_id', $specialite_id);
    $stmt->bindValue(':medecin_id', $medecin_id);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':heure', $heure);
    $stmt->execute();
    $medecin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($medecin) {
        $utilisateur_id = $_SESSION['user_id'];

        // Insertion des informations de rendez-vous dans la table
        $query = "INSERT INTO rendez_vous (heure, date, utilisateur_id, medecin_id) VALUES (:heure, :date, :utilisateur_id, :medecin_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':heure', $heure);
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':utilisateur_id', $utilisateur_id);
        $stmt->bindValue(':medecin_id', $medecin_id);
        $stmt->execute();

        // Redirection vers la page de confirmation
        header('Location: bravo.php');
        exit;
    } else {
        $error = "Le médecin sélectionné n'est pas disponible à la date et l'heure choisies.";
    }
}

// Affichage : inclusion du template
$template = 'Confirmation';
include 'templates/base.phtml';
?>
