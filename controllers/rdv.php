<?php
// Démarrage de la session
session_start();


$utilisateur_id = $_SESSION['user_id'];


// Redirection vers la page d'accueil si la session n'est pas active
if (!isset($_SESSION['user_id'])) {
    header('Location: Accueil');
    exit;
}

// Inclusion de la config
require_once '../app/config.php';

// Inclusion des dépendances
require '../lib/fonction.php';



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

// Traitement du formulaire de rendez-vous
$errors = array();
if (isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $specialite_id = filter_input(INPUT_POST, 'specialite_id', FILTER_VALIDATE_INT);
    $ville_id = filter_input(INPUT_POST, 'ville_id', FILTER_VALIDATE_INT);
    $date = filter_input(INPUT_POST, 'date');
    $heure = filter_input(INPUT_POST, 'heure');


    // Validation des données du formulaire
    if (!$specialite_id) {
        $errors['specialite_id'] = "Veuillez sélectionner une spécialité.";
    }
    if (!$ville_id) {
        $errors['ville_id'] = "Veuillez sélectionner une ville.";
    }
    if (!$date) {
        $errors['date'] = "Veuillez saisir une date valide.";
    }
    if (!$heure) {
        $errors['heure'] = "Veuillez saisir une heure valide.";
    }

    // Récupération des médecins correspondant aux critères de spécialité, ville, date et heure
    if (empty($errors)) {
        $sql = "SELECT * FROM medecins WHERE specialite_id = :specialite_id AND ville_id = :ville_id
            AND id NOT IN (SELECT medecin_id FROM rendez_vous WHERE date = :date
            AND heure = :heure)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':specialite_id', $specialite_id, PDO::PARAM_INT);
        $stmt->bindValue(':ville_id', $ville_id, PDO::PARAM_INT);
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':heure', $heure);
        $stmt->execute();
        $medecins = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Redirection vers le formulaire de sélection du médecin s'il y a des médecins correspondants
        if (!empty($medecins)) {
            $_SESSION['date'] = $date;
            $_SESSION['heure'] = $heure;
            $_SESSION['specialite_id'] = $specialite_id;
            $_SESSION['ville_id'] = $ville_id;
            $_SESSION['medecins'] = $medecins;

            // Redirection vers la page de confirmation
            header('Location: Confirmation');
            exit;
        } else {
            $errors['medecin_id'] = "Aucun médecin correspondant n'a été trouvé.";
        }
    }
}



// Définition de la variable $template
$template = '../templates/rdv';

// Inclusion du fichier base.phtml
include '../public/base.phtml';